<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Reviews;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($id) {
        $reservation = Reservation::findOrFail($id);
        abort_if(
            $reservation->user_id !== Auth::id() ||
            $reservation->payment_status !== 'paid' || 
            $reservation->review,
            403
        );

        return view('review.create', ['reservation' => $reservation]);
    }

    public function store($id) {
        $reservation = Reservation::findOrFail($id);
        abort_if(
            $reservation->user_id !== Auth::id() ||
            $reservation->payment_status !== 'paid' || 
            $reservation->review,
            403
        );

        $validated = request()->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000']
        ]);

        Reviews::create([
            'user_id' => Auth::id(),
            'listings_id' => $reservation->listings_id,
            'reservation_id' => $reservation->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null
        ]);

        Notification::make()
        ->title('Berhasil')
        ->body('Terima kasih atas ulasan anda!')
        ->success()
        ->send();

        return redirect(route('reservation.my'))->with('success', 'Thanks for your review!');
    }
}
