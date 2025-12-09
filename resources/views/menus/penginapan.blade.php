@extends('layouts.home')
@section('content')
    <div>
        <div class="ml-2">
            <h1 class="text-4xl font-medium ">Penginapan</h1>
            <p>Daftar penginapan anda!</p>
        </div>
        <div class="flex flex-wrap gap-8 mt-4">
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