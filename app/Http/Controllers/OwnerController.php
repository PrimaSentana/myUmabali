<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function index() {
        $reservations = Reservation::with([
            'listings.images' => function($q) {
                $q->where('isCover', true);
            },
            'user'
        ])
        ->whereHas('listings', function($q) {
            $q->where('user_id', Auth::id());
        })
        ->orderByRaw("FIELD(payment_status, 'paid', 'pending', 'cancelled')")
        ->orderBy('check_in', 'asc')
        ->get();

        return view('menus.booking', ['reservations' => $reservations]);
    }

    public function show(Reservation $reservation) {
        if($reservation->listings->user_id !== Auth::id()) {
            abort(403);
        }

        $reservation->load([
            'listings.images',
            'user'
        ]);

        return view('menus.booking-show', ['reservation' => $reservation]);
    }

    public function summary() {
        $user = User::findOrFail(Auth::id());
        
        $totalListings = $user->listings()->count();

        $totalBookings = Reservation::whereHas('listings', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->count();

        $completedBookings = Reservation::whereHas('listings', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->where('payment_status', 'completed')->count();

        $incomingBookings = Reservation::with(['listings', 'user'])
        ->whereHas('listings', fn($q) => $q->where('user_id', $user->id))
        ->latest()
        ->take(5)
        ->get();

        $topListings = Listings::withCount('reservations')
        ->where('user_id', $user->id)
        ->orderByDesc('reservations_count')
        ->take(5)
        ->get();

        return view('dashboard', compact(['user', 'completedBookings', 'incomingBookings', 'topListings', 'totalBookings', 'totalListings']));
    }
}
