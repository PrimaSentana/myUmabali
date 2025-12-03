@extends('layouts.home')
@section('content')
    <div>
        <h2 class="text-2xl font-bold mb-6">Popular homes in Badung ></h2>
            <div class="flex flex-wrap gap-6">
                @foreach($listings as $list)
                    <x-home-card 
                        :id="$list['id']"
                        :image="$list['image']" 
                        :title="$list['title']" 
                        :price="$list['price']" 
                        {{-- :rating="$home['rating']" --}}
                    />
                @endforeach
            </div>
    </div>

    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-6">Popular Home in Ubud ></h2>
            <div class="flex flex-wrap gap-6">
                @foreach($listings as $list)
                    <x-home-card 
                        :id="$list['id']"
                        :image="$list['image']" 
                        :title="$list['title']" 
                        :price="$list['price']" 
                        {{-- :rating="$home['rating']" --}}
                    />
                @endforeach
            </div>
    </div>
@endsection