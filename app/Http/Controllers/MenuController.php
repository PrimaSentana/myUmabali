<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function favorite() {
        $user = User::find(Auth::id());
        $listings = $user->favorites;
        return view('menus.favorite', ['listings' => $listings, 'user' => $user]);
    }

    public function penginapan() {
        $listings = Listings::where('user_id', Auth::id())->get();
        $user = User::find(Auth::id());
        return view('menus.penginapan', ['listings' => $listings, 'user' => $user]);
    }
}
