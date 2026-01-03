@props(['id','image_path', 'title', 'price', 'isRelated'])


    <div {{ $attributes->merge(['class' => 'rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition bg-white w-55 cursor-pointer']) }}>
        <div class="relative">
            <a href="/penginapan/{{ $id }}">
                <img src="{{ asset('storage/' . $image_path)}}" alt="{{ $title }}" class="h-48 w-full object-cover">
                {{-- favorite --}}
                @if($isRelated)
                    <form action="{{ route('listings.xfavorite', $id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="listings_id" value="{{ $id }}">
                        <button type="submit" class="group absolute top-2 left-2 bg-[#eb4c60] w-20 transition text-white text-sm font-semibold px-2 py-1 rounded-md shadow hover:bg-white hover:text-black">
                            <span class="block group-hover:hidden">Favorited</span>
                            <span class="hidden group-hover:block">Cancel</span>
                        </button>
                    </form>
                @else
                    @auth
                        <form action="{{ route('listings.favorite', $id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="listings_id" value="{{ $id }}">
                            <button type="submit" class="group absolute top-2 left-2 bg-white w-32 hover:bg-[#eb4c60] transition hover:text-white active:bg-[#e72842] text-sm font-semibold px-2 py-1 rounded-md shadow">
                                <span class="block group-hover:hidden">Add to favorite</span>
                                <span class="hidden group-hover:block">Favorite</span>
                            </button>
                        </form>
                    @endauth
                    @guest
                        <a href="/login">
                            <input type="hidden" name="listings_id" value="{{ $id }}">
                            <button type="submit" class="group absolute top-2 left-2 bg-white w-32 hover:bg-[#eb4c60] transition hover:text-white active:bg-[#e72842] text-sm font-semibold px-2 py-1 rounded-md shadow">
                                <span class="block group-hover:hidden">Add to favorite</span>
                                <span class="hidden group-hover:block">Favorite</span>
                            </button>
                        </a>
                    @endguest
                @endif
            </a>
        </div>
            
        <div class="p-3">
            <h3 class="font-semibold text-gray-800 text-sm">{{ Str::limit($title, 30) }}</h3>
            <p class="text-gray-600 text-sm">{{ number_format($price, 2, ',', '.') }} untuk 1 malam</p>
            {{-- <p class="text-gray-500 text-xs mt-1">★ {{ $rating }}</p> --}}
        </div>
    </div>
