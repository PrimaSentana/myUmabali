@extends('layouts.home')
@section('content')
    <div>
        <h2 class="text-2xl font-bold mb-6">Popular homes</h2>
        <div class="flex flex-wrap gap-4">
            @auth
                @foreach($listings as $listing)
                    <x-home-card 
                        :id="$listing->id"
                        :image_path="$listing->coverImage->image_path"
                        :title="$listing->title" 
                        :price="$listing->price"
                        :isRelated="$user->favorites()->where('listings_id', $listing->id)->exists()"
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
                    />
                @endforeach
            @endguest
        </div>
    </div>
@endsection