<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Facility;
use App\Models\ListingImage;
use App\Models\Listings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wishlist;
use Filament\Notifications\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class PenginapanController extends Controller
{
    public function test() { //ngetest azahhh
        dd(request()->hasFile('image_kamar'), request()->hasFile('image_cover'), request()->hasFile('images'));
    }
    
    public function index(Listings $listings) {
        $listings = Listings::all();
        $user = User::find(Auth::id());
        return view('xdashboard', ['listings' => $listings, 'user' => $user]);
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
            'image_kamar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        if(request()->hasFile('image_kamar')) {
            $path = request()->file('image_kamar')->store('listings', 'public');
            ListingImage::create([
                'listings_id' => $listings['id'],
                'image_path' => $path,
                'isKamar' => true
            ]);
        }

        if(request()->hasFile('image_cover')) {
            $path = request()->file('image_cover')->store('listings', 'public');
            ListingImage::create([
                'listings_id' => $listings['id'],
                'image_path' => $path,
                'isCover' => true
            ]);
        }

        // handle image
        if(request()->hasFile('images')) {
            foreach(request()->file('images') as $index => $image) {
                $path = $image->store('listings', 'public');
                ListingImage::create([
                    'listings_id' => $listings['id'],
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('xdashboard')
        ->with('success', 'Penginapan berhasil ditambahkan');
    }
    
    public function show($id){
        $user = User::find(Auth::id());
        $listings = Listings::find($id);
        $images = $listings->images()
        ->where('isCover', false)
        ->take(2)
        ->get();
        $facilities = $listings->facilities()->get();

        $reviews = $listings->reviews;

        return view('listings.show', ['listings' => $listings, 'images' => $images, 'facilities' => $facilities, 'user' => $user, 'reviews' => $reviews]);
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

    public function favorite() {
        $user = User::find(Auth::id());
        
        if(request()->filled('listings_id')) {
            $user->favorites()->attach(request()->listings_id);
        }

        Notification::make()
        ->title('Berhasil favorite')
        ->color('#27FB6B')
        ->send();

        return redirect()->back();
    }

    public function cancelFavorite() {
        $user = User::find(Auth::id());
        
        if(request()->filled('listings_id')) {
            $user->favorites()->detach(request()->listings_id);
        }

        Notification::make()
        ->title('Berhasil cancel')
        ->color('#FD151B')
        ->send();

        return redirect()->back();
    }

    public function search() {
        $location = request()->location_value;
        if(request()->date_range) {
            [$checkIn, $checkOut] = explode(' to ', request('date_range'));
        } else {
            $checkIn = null;
            $checkOut = null;
        }
        $guest = request()->guest_count;

        $listings = Listings::query()
        ->when($location, function($q) use ($location) {
            $q->where('title', 'like', '%' . $location . '%');
        })
        ->when($guest, function($q) use ($guest) {
            $q->where('guest_count', ">=", $guest);
        })
        ->when($checkIn && $checkOut, function($query) use ($checkIn, $checkOut){
            $query->whereDoesntHave('reservations', function($q) use ($checkIn, $checkOut) {
                $q->whereIn('payment_status', ['paid'])
                ->where(function ($q) use ($checkIn, $checkOut) {
                    $q->where('check_in', '<', $checkOut)
                    ->where('check_out', '>', $checkIn);
                });
            });
        })->get();

        return view('xdashboard', ['listings' => $listings, 'user' => User::find(Auth::id())]);
    }
}
