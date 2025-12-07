<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Facility;
use App\Models\ListingImage;
use App\Models\Listings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenginapanController extends Controller
{
    public function create() {
        $categories = Category::all();

        $facilities = Facility::all();

        return view('forms.form-penginapan', ['categories' => $categories, 'facilities' => $facilities]);
    }

    public function store() {
        // $request->validate([
        //     'title' => ['required', 'min:5'],
        //     'description' => ['required'],
        //     'room_count' => ['required'],
        //     'guest_count' => ['required'],
        //     'bathroom_count' => ['required'],
        //     'location_value' => ['required'],
        //     'category' => ['required'],
        //     'facilities' => ['array', 'required'],
        //     'price' => ['required']
        // ]);

        // $listings = Listings::create([
        //     'title' => request('title'),
        //     'category_id' => request('category'),
        //     'description' => request('description'),
        //     'room_count' => request('room_count'),
        //     'room_status' => request('room_count'),
        //     'guest_count' => request('guest_count'),
        //     'bathroom_count' => request('bathroom_count'),
        //     'location_value' => request('location_value'),
        //     'price' => request('price'),
        //     'user_id' => Auth::id()
        // ]);

        // // handle facilities
        // if(request()->filled('facilities')) {
        //     $listings->facilities()->sync(request()->facilities);
        // }

        // // handle image
        // if(request()->hasFile('images')) {
        //     foreach(request()->file('images') as $index => $image) {
        //         $path = $image->store('listings', 'public');

        //         ListingImage::create([
        //             'listing_id' => $listings['id'],
        //             'image_path' => $path,
        //             'isCover' => $index === 0, // image pertama
        //             'isKamar' => $index === 1  // image kedua
        //         ]);
        //     }
        // }

        dd(request()->all());

        // return redirect()->route('listings.index')
        // ->with('success', 'Penginapan berhasil ditambahkan');
    }
    
    public function edit() {
        return;
    }
    
    public function update() {
        return;
    }
    
    public function delete() {
        return;
    }
}
