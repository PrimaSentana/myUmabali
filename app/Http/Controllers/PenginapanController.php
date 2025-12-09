<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Facility;
use App\Models\ListingImage;
use App\Models\Listings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class PenginapanController extends Controller
{
    public function test() { //ngetest azahhh
        dd(request()->all());
    }
    public function index() {
        $listings = Listings::all();
        return view('xdashboard', ['listings' => $listings]);
    }
    
    public function create() {
        $categories = Category::all();

        $facilities = Facility::all();

        return view('listings.create', ['categories' => $categories, 'facilities' => $facilities]);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => ['required', 'min:5'],
            'description' => ['required'],
            'room_count' => ['required'],
            'guest_count' => ['required'],
            'bathroom_count' => ['required'],
            'location_value' => ['required'],
            'category' => ['required'],
            'facilities' => ['array', 'required', 'min:1'],
            'images' => ['array'],
            'price' => ['required'],
        ]);

        $listings = Listings::create([
            'title' => request('title'),
            'category_id' => request('category'),
            'description' => request('description'),
            'room_count' => request('room_count'),
            'room_status' => request('room_count'),
            'guest_count' => request('guest_count'),
            'bathroom_count' => request('bathroom_count'),
            'location_value' => request('location_value'),
            'price' => request('price'),
            'latitude' => request('latitude'),
            'longitude' => request('longitude'),
            'user_id' => Auth::id()
        ]);

        // handle facilities
        if(request()->filled('facilities')) {
            $listings->facilities()->sync(request()->facilities);
        }

        // handle image
        if(request()->hasFile('images')) {
            foreach(request()->file('images') as $index => $image) {
                $path = $image->store('listings', 'public');

                ListingImage::create([
                    'listings_id' => $listings['id'],
                    'image_path' => $path,
                    'isCover' => $index === 0, // image pertama
                    'isKamar' => $index === 1  // image kedua
                ]);
            }
        }


        return redirect()->route('xdashboard')
        ->with('success', 'Penginapan berhasil ditambahkan');
    }
    
    public function show($id){
        $listings = Listings::find($id);
        $images = $listings->images()
        ->where('isCover', false)
        ->get();
        $facilities = $listings->facilities()->get();

        return view('listings.show', ['listings' => $listings, 'images' => $images, 'facilities' => $facilities]);
    }

    public function edit(Listings $listings) {
        $this->authorize('update', $listings);

        $categories = Category::all();
        $facilities = Facility::all();

        return view('listings.edit', ['listings' => $listings, 'categories' => $categories, 'facilities' => $facilities]);
    }
    
    public function update($id) {
        // $this->authorize('update', $listings);

        $listings = Listings::findOrFail($id);

        request()->validate([
            'title' => ['required', 'min:5'],
            'description' => ['required'],
            'room_count' => ['required'],
            'guest_count' => ['required'],
            'bathroom_count' => ['required'],
            'location_value' => ['required'],
            'category' => ['required'],
            'facilities' => ['array', 'required', 'min:1'],
            'images' => ['array'],
            'price' => ['required'],
        ]);

        $listings->update([
            'title' => request('title'),
            'category_id' => request('category'),
            'description' => request('description'),
            'room_count' => request('room_count'),
            'room_status' => request('room_count'),
            'guest_count' => request('guest_count'),
            'bathroom_count' => request('bathroom_count'),
            'location_value' => request('location_value'),
            'price' => request('price'),
            'latitude' => request('latitude'),
            'longitude' => request('longitude'),
            'user_id' => Auth::id()
        ]);

        if(request()->filled('facilities')) {
            $listings->facilities()->sync(request()->facilities);
        }

        if (request()->filled('removed_images')) {
            $ids = json_decode(request()->removed_images, true);

            $images = ListingImage::whereIn('id', $ids)->get();

            foreach ($images as $image) {
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            }
        }

        if (request()->hasFile('images')) {
            foreach (request()->file('images') as $index => $file) {
                $path = $file->store('listings', 'public');

                $listings->images()->create([
                    'image_path' => $path,
                    'isCover' => false,
                    'isKamar' => $index === 0 || $index === 1,
                ]);
            }
        }

        return redirect(route('listings.show', $listings->id));
    }
    
    public function destroy($id) {
        $listings = Listings::findOrFail($id);
        
        foreach ($listings->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        $listings->facilities()->detach();
        $listings->delete();

        return redirect(route('xdashboard'));
    }
}
