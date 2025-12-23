<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
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
}
