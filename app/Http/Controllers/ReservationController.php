<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use App\Models\Reservation;
use App\Services\MidtransService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Notification;

class ReservationController extends Controller
{
    public function test($id) {
        $listings = Listings::findOrFail($id);
        [$checkIn, $checkOut] = explode(' to ', request('date_range'));

        $checkIn = Carbon::parse($checkIn);
        $checkOut = Carbon::parse($checkOut);

        $nights = $checkIn->diffInDays($checkOut);
        $total_price = $listings->price * $nights;

        dd([$checkIn, $checkOut, $nights, $total_price]);
    }

    public function index() {
        $reservations = Reservation::where('user_id', Auth::id())
        ->orderByRaw("FIELD(payment_status, 'pending', 'paid', 'cancelled')")
        ->orderBy('check_in', 'asc')
        ->get();

        return view('menus.reservation', ['reservations' => $reservations]);
    }

    public function checkout($id) {
        $reservation = Reservation::find($id);

        $snapToken = $reservation->snap_token;

        $days = Carbon::parse($reservation->check_in)->diffInDays($reservation->check_out);
        $price = 'Rp' . number_format($reservation->listings->price, 2, ',', '.');
        $total = 'Rp' . number_format($reservation->total_price, 2, ',', '.');

        return view('listings.checkout', [
            'snapToken' => $snapToken, 
            'reservation' => $reservation, 
            'days' => $days, 
            'price' => $price,
            'total' => $total
        ]);
    }

    public function store($id) {
        $listings = Listings::findOrFail($id);

        [$checkIn, $checkOut] = explode(' to ', request('date_range'));
        
        $tanggal_check_in = $checkIn;
        $tanggal_check_out = $checkOut;
        
        if($tanggal_check_in >= $tanggal_check_out) {
            return back()->withErrors('Tanggal tidak valid');
        }

        // cek bentrok
        $isReserved = Reservation::where('listings_id', $listings->id)
        ->whereIn('payment_status', ['pending', 'paid'])->where(function ($query) use ($tanggal_check_in, $tanggal_check_out) {
            $query->where('check_in', '<', $tanggal_check_out)->where('check_out', '>', $tanggal_check_in);
        })->exists();

        if($isReserved) {
            return back()->withErrors('Tanggal sudah dibooking');
        }

        // hitung harga/mlm
        $checkIn = Carbon::parse($checkIn);
        $checkOut = Carbon::parse($checkOut);

        $days = Carbon::parse($checkIn)->diffInDays($checkOut);
        $total = $listings->price * $days;

        //simpen reservasi
        $reservation = Reservation::create([
            'listings_id' => $listings->id,
            'user_id' => Auth::id(),
            'check_in' => $tanggal_check_in,
            'check_out' => $tanggal_check_out,
            'total_price' => $total,
            'guest_count' => request()->guest_count,
            'payment_status' => 'pending'
        ]);

        $orderId = 'ORDER-' . $reservation->id . '-' . time();

        $reservation->update([
            'order_id' => $orderId
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $total
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email
            ]
        ];

        $snapToken = (new MidtransService)->generateSnapToken($params);

        $reservation->update([
            'snap_token' => $snapToken
        ]);

        return redirect(route('xdashboard'));
    }

    // yg ini alternatif 
    public function callback() {
        $orderId = request()->order_id;
        $transaction = request()->transaction_status;

        $reservation = Reservation::where('order_id', $orderId)->first();

        if(!$reservation) return;

        if($transaction == 'capture' || $transaction == 'settlement') {
            $reservation->update(['payment_status' => 'success']);
        } elseif ($transaction == 'deny' || $transaction == 'expire') {
            $reservation->update(['payment_status' => 'failed']);
        }

        return response()->json(['message' => 'OK']);
    }

    // main callback
    public function handle() {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');

        $notification = new Notification();

        $orderId = $notification->order_id;
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;

        $reservation = Reservation::where('order_id', $orderId)->first();

        if(!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        if($status === 'capture') {
            if($type === 'credit_card' && $fraud === 'challenge') {
                $reservation->update(['payment_status' => 'pending']);
            } else {
                $reservation->update(['payment_status' => 'paid']);
            }
        } elseif ($status === 'settlement') {
            $reservation->update(['payemnt_status' => 'paid']);
        } elseif ($status === 'pending') {
            $reservation->update(['payment_status' => 'pending']);
        } elseif (in_array($status, ['deny', 'expire', 'cancel'])) {
            $reservation->update(['payment_status' => 'failed']);
        }

        return response()->json(['message' => 'OK']);
    }

    public function cancel($id) {
        $reservation = Reservation::findOrFail($id);

        if($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        if(!in_array($reservation->payment_status, ['pending', 'paid'])) {
            return back()->withErrors('Booking tidak dapat dibatalkan');
        }

        if(Carbon::parse($reservation->check_in)->isPast()) {
            return back()->withErrors('Reservasi sudah berjalan');
        }

        $reservation->update([
            'payment_status' => 'cancelled'
        ]);
        
        return back()->with('success', 'Reservasi berhasil dibatalkan');
    }
}
