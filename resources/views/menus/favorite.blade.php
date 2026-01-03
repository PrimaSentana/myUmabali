@extends('layouts.penginapan')
@section('content')
    <div>
        <div>
            <h1 class="text-4xl font-medium">Favorite</h1>
            <p>Daftar penginapan favorite anda!</p>
        </div>
        <div class="grid grid-cols-5 gap-4 mt-4">
            @foreach($listings as $listing)
                <x-home-card 
                    :id="$listing->id"
                    :image_path="$listing->coverImage->image_path"
                    :title="$listing->title" 
                    :price="$listing->price"
                    :isRelated="$user->favorites()->where('listings_id', $listing->id)->exists()"
                />
            @endforeach
        </div>
    </div>
@endsection