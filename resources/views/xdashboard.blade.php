@extends('layouts.penginapan')
@section('content')
    <div class="">
        <h2 class="text-2xl font-bold mb-6">Popular homes</h2>
        <div class="grid grid-flow-col overflow-x-auto auto-cols-[45%] snap-x snap-mandatory md:grid-flow-row md:grid-cols-3 lg:grid-cols-5 gap-4">
            @if ($listings->isNotEmpty())
                @auth
                    @foreach($listings as $listing)
                        <x-home-card 
                            :id="$listing->id"
                            :image_path="$listing->coverImage->image_path"
                            :title="$listing->title" 
                            :price="$listing->price"
                            :isRelated="$user->favorites()->where('listings_id', $listing->id)->exists()"
                            :rating="$listing->reviews()"
                        />
                    @endforeach
                @endauth
                @guest
                    @foreach($listings as $listing)
                        <x-home-card 
                            :id="$listing->id"
                            :image_path="$listing->coverImage->image_path"
                            :title="$listing->title" 
                            :price="$listing->price"
                            :isRelated="false"
                            :rating="$listing->reviews()"
                        />
                    @endforeach
                @endguest
            @else
                <div class="h-96">
                    <h1 class="text-gray-600">Listings Empty</h1>
                    <a href="/" class="text-gray-400 hover:text-gray-500 underline">Reset search</p>
                </div>
            @endif
        </div>
    </div>
@endsection