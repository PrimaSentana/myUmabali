<script>
    window.listingLocation = {
        lat: {{ $listings->latitude }},
        lng: {{ $listings->longitude }},
    };
</script>

@extends('layouts.penginapan')
@section('content')
    <div class="container mx-auto px-4 py-8 text-[#1b1b18]">

    <div class="flex justify-between items-center">
        <h1 class="text-xl font-medium mb-4">{{ $listings->title }}, Kamar untuk {{ $listings->guest_count }} orang</h1>
        <div class="flex gap-8 mr-8">
            @can('update', $listings)
                <a href="{{ route('listings.edit', $listings) }}" class="text-slate-700 font-medium hover:underline">Edit</a>
            @endcan

            @can('delete', $listings)
                <button type="button" onclick="openModal('delete-listing-{{ $listings->id }}')" class="text-red-600 hover:underline font-medium">Delete</button>
                <x-delete-modal
                    :id="'delete-listing-' . $listings->id"
                    :action="route('listings.destroy', $listings->id)"
                    title="Hapus penginapan?"
                    message="Penginapan ini akan dihapus permanen dan tidak bisa dikembalikan."
                />
            @endcan
        </div>
    </div>

    {{-- tmpt photo --}}
    <div 
        class="grid grid-cols-3 gap-2 h-128 rounded-xl overflow-hidden relative"
        x-data="{ showGallery: false }"
        x-init="$watch('showGallery', value => document.body.classList.toggle('overflow-hidden', value))"
    >
        <div class="col-span-2 h-full bg-gray-200 rounded-left-xl overflow-hidden">
            <img src="{{ asset('storage/' . $listings->coverImage->image_path) }}" alt="{{ $listings->title }}" class="w-full h-full object-cover">
        </div>

        <div class="grid grid-rows-2 gap-2">
            @foreach ($images as $image)
                <div class="h-full bg-gray-200 rounded-xl overflow-visible">
                    <img src="{{ asset('storage/' . $image->image_path)}}" alt="{{ $listings->title }}" class="w-full h-full object-cover">
                </div>
            @endforeach
        </div>
        <button 
            class="text-sm font-medium border border-black bg-white p-2 rounded-lg transition-colors duration-300 absolute bottom-2 right-2 hover:bg-black hover:text-white"
            @click="showGallery = true"
        >
            <div class="flex gap-2">
                <div class="group">
                    <svg 
                        width="20" 
                        height="20" 
                        viewBox="0 0 20 20" 
                        fill="none" 
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <mask id="mask0_65_429" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="20" height="20">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H19.953V19.9539H0V0Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask0_65_429)">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.651 1.5C3.13 1.5 1.5 3.229 1.5 5.904V14.05C1.5 16.726 3.13 18.454 5.651 18.454H14.297C16.822 18.454 18.453 16.726 18.453 14.05V5.904C18.455 4.541 18.039 3.403 17.251 2.614C16.523 1.885 15.504 1.5 14.302 1.5H5.651ZM14.297 19.954H5.651C2.271 19.954 0 17.581 0 14.05V5.904C0 2.373 2.271 0 5.651 0H14.302C15.91 0 17.297 0.537 18.312 1.554C19.373 2.616 19.955 4.161 19.953 5.905V14.05C19.953 17.581 17.68 19.954 14.297 19.954Z" fill="currentColor"/>
                        </g>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.85574 5.68945C6.25174 5.68945 5.76074 6.18045 5.76074 6.78545C5.76074 7.38945 6.25174 7.88045 6.85674 7.88045C7.46074 7.88045 7.95274 7.38945 7.95274 6.78645C7.95174 6.18145 7.45974 5.69045 6.85574 5.68945ZM6.85674 9.38045C5.42474 9.38045 4.26074 8.21645 4.26074 6.78545C4.26074 5.35345 5.42474 4.18945 6.85674 4.18945C8.28774 4.19045 9.45174 5.35445 9.45274 6.78445V6.78545C9.45274 8.21645 8.28874 9.38045 6.85674 9.38045Z" fill="currentColor"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.74893 18.1113C1.62493 18.1113 1.49893 18.0803 1.38293 18.0153C1.02093 17.8123 0.893934 17.3553 1.09593 16.9943C1.15593 16.8863 2.59093 14.3493 4.16993 13.0493C5.42193 12.0193 6.76993 12.5853 7.85593 13.0423C8.49493 13.3113 9.09893 13.5653 9.67893 13.5653C10.2109 13.5653 10.8779 12.6253 11.4679 11.7963C12.2869 10.6403 13.2169 9.33228 14.5789 9.33228C16.7489 9.33228 18.6219 11.2683 19.6289 12.3083L19.7449 12.4283C20.0329 12.7253 20.0259 13.2003 19.7289 13.4893C19.4339 13.7783 18.9589 13.7713 18.6689 13.4733L18.5509 13.3513C17.6989 12.4703 16.1129 10.8323 14.5789 10.8323C13.9909 10.8323 13.3009 11.8053 12.6899 12.6643C11.8519 13.8443 10.9849 15.0653 9.67893 15.0653C8.79593 15.0653 7.98693 14.7253 7.27393 14.4243C6.13993 13.9463 5.62593 13.7933 5.12293 14.2073C3.75893 15.3313 2.41693 17.7053 2.40393 17.7283C2.26693 17.9733 2.01193 18.1113 1.74893 18.1113Z" fill="currentColor"/>
                    </svg>
                </div>
                <div class="hidden md:block lg:block">
                    Tampilkan semua foto
                </div>
            </div>
        </button>

        <div 
            x-show="showGallery" 
            x-transition.opacity.duration.300ms
            @keydown.escape.window="showGallery = false"
            class="fixed inset-0 z-50 bg-black/50 overflow-y-auto backdrop-blur-xl"
            style="display: none;"
        >
            <div class="sticky top-0 z-10 px-4 py-4 flex justify-between items-center">
                <button 
                    @click="showGallery = false" 
                    class="p-2 hover:bg-white hover:text-black text-white rounded-full transition"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <div class="w-10"></div>
            </div>
            <div class="max-w-7xl mx-auto px-4 py-8">
                <div class="columns-2xs md:columns-2 gap-4 space-y-4">
                    @foreach($listings->images as $image)
                        <div class="break-inside-avoid">
                            <img 
                                src="{{ asset('storage/' . $image->image_path) }}" 
                                alt="Foto Listing" 
                                class="w-full rounded-lg hover:brightness-90 transition"
                                loading="lazy"
                            >
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-8 mt-8">
        <div class="md:w-2/3 space-y-6">

            <p class="text-gray-600">
                Seluruh serviced {{ $listings->title }}, {{ $listings->location_value }}<br>
                {{ $listings->guest_count }} tamu • {{ $listings->room_count }} kamar tidur • {{ $listings->bathroom_count }} kamar mandi
            </p>

            <div class="flex items-center gap-4 border-b pb-4">
                <div class="object-cover rounded-full">
                    <img src="{{ asset('storage/' . $listings->user->images) }}" alt="profile" class="object-cover rounded-full w-12 h-12">
                </div>
                <div>
                    <p class="font-medium">Tuan Rumah: {{ $listings->user->name }}</p>
                    <p class="text-sm text-gray-500">Host Teladan: Tuan rumah selama {{ $listings->user->listings->first()->created_at->locale('id')->diffForHumans() }}</p>
                </div>
            </div>

            <div>
                <h2 class="text-lg font-semibold my-4">Deskripsi</h2>
                <div class="rounded-lg w-180 flex items-center">
                    <h2>{{ $listings->description }}</h2>
                </div>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-2">Kamar Anda</h2>
                <div class="bg-gray-200 rounded-lg h-64 w-180 flex items-center justify-center text-gray-500">
                    <img src="{{ asset('storage/' . $listings->kamarImage->image_path) }}" alt="{{ $listings->title }}" class="w-full h-full object-cover rounded-lg">
                </div>
                <p class="text-sm text-gray-600 mt-2">{{ $listings->room_count }} tempat tidur</p>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-2">Fasilitas yang ditawarkan</h2>
                <div class="grid grid-cols-2 gap-y-2">
                    @foreach ($facilities as $facility)
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('storage/' . $facility->image_path) }}" alt="{{ $facility->title }}" class="w-6 h-6">
                            <p>{{ $facility->title }}</p>
                        </div>
                    @endforeach
                </div>
                {{-- <button class="mt-3 text-sm text-gray-500 underline">Tampilkan ke-12 fasilitas</button> --}}
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-2">Lokasi penginapan</h2>
                <p class="text-sm text-gray-600 mb-3">{{ $listings->location_value }}</p>
                <div id="preview-map" class="w-full h-96 rounded-xl border"></div>
                <div class="mt-2">
                    <a
                        href="https://www.google.com/maps?q={{ $listings->latitude }},{{ $listings->longitude }}"
                        target="_blank"
                        class="text-sm text-airbnb underline"
                        >
                        Lihat di Google Maps
                    </a>
                </div>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-2">Review</h2>
            </div>
        </div>

        @auth
            @if ($listings->user->id === $user->id)
                
            @else
                <div class="md:w-1/3">
                    <form action="/reservation/{{ $listings->id }}" method="POST">
                        @csrf
                        <div class="border rounded-xl shadow-md p-5 sticky top-24">
                            <p class="text-xl font-semibold">Rp{{ number_format($listings->price, 2, ',', '.')}} <span class="text-sm font-normal text-gray-500">untuk 1 malam</span></p>
                            <div class="mt-4 border rounded-lg divide-y">
                                <div class="p-2">
                                    <label id="check-in" class="block text-gray-600">Pilih Tanggal Menginap</label>
                                    <input required type="text" id="date_range" name="date_range" class="w-full border mt-2 rounded-lg px-3 py-2" placeholder="Pilih tanggal">
                                </div>
                                <div class="p-2">
                                    <label id="guest_count" class="block text-gray-600">Tamu</label>
                                    <input required type="number" min="1" max="{{ $listings->guest_count }}" name="guest_count" class="w-full border mt-2 rounded-lg px-3 py-2" placeholder="Jumlah tamu">
                                    <p class="text-sm mt-2 text-gray-500">Maksimal {{ $listings->guest_count }} tamu</p>
                                </div>
                            </div>

                            <button type="submit" class="mt-4 w-full bg-[#E91E63] text-white py-3 rounded-lg font-medium hover:bg-[#d81b60] transition">
                                Pesan
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        @endauth
        @guest
            <div class="md:w-1/3">
                <form action="/reservation/{{ $listings->id }}" method="POST">
                    @csrf
                    <div class="border rounded-xl shadow-md p-5 sticky top-24">
                        <p class="text-xl font-semibold">Rp{{ number_format($listings->price, 2, ',', '.')}} <span class="text-sm font-normal text-gray-500">untuk 1 malam</span></p>
                        <div class="mt-4 border rounded-lg divide-y">
                            <div class="p-2">
                                <label id="check-in" class="block text-gray-600">Pilih Tanggal Menginap</label>
                                <input required type="text" id="date_range" name="date_range" class="w-full border mt-2 rounded-lg px-3 py-2" placeholder="Pilih tanggal">
                            </div>
                            <div class="p-2">
                                <label id="guest_count" class="block text-gray-600">Tamu</label>
                                <input required type="number" min="1" max="{{ $listings->guest_count }}" name="guest_count" class="w-full border mt-2 rounded-lg px-3 py-2" placeholder="Jumlah tamu">
                                <p class="text-sm mt-2 text-gray-500">Maksimal {{ $listings->guest_count }} tamu</p>
                            </div>
                        </div>
                        <button type="submit" class="mt-4 w-full bg-[#E91E63] text-white py-3 rounded-lg font-medium hover:bg-[#d81b60] transition">
                            Pesan
                        </button>
                    </div>
                </form>
            </div>
        @endguest

        
    </div>
</div>
@endsection