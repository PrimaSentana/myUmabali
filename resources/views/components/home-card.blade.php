@props(['id','image', 'title', 'price'])

<a href="/penginapan/{{ $id }}">
    <div class="rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition bg-white w-55 cursor-pointer">
        <div class="relative">
            <img src="{{ $image }}" alt="{{ $title }}" class="h-48 w-full object-cover">
            <span class="absolute top-2 left-2 bg-white text-sm font-semibold px-2 py-1 rounded-md shadow">Guest favorite</span>
            <button class="absolute top-2 right-2 bg-white rounded-full p-2 shadow">
                <img src="images/heart.png" alt="heart icon" width="20px">
            </button>
        </div>
        <div class="p-3">
            <h3 class="font-semibold text-gray-800 text-sm">{{ $title }}</h3>
            <p class="text-gray-600 text-sm">{{ $price }} untuk 1 malam</p>
            {{-- <p class="text-gray-500 text-xs mt-1">★ {{ $rating }}</p> --}}
        </div>
    </div>
</a>

