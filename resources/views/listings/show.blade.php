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
    <div class="grid grid-cols-3 gap-2 h-128 rounded-xl overflow-hidden">
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
    </div>


    {{-- <button class="text-sm mt-2 underline text-gray-500">Tampilkan semua foto</button> --}}

    <div class="flex flex-col md:flex-row gap-8 mt-8">

        <!-- kiri -->
        <div class="md:w-2/3 space-y-6">

            <p class="text-gray-600">
                Seluruh serviced {{ $listings->title }}, {{ $listings->location_value }}<br>
                {{ $listings->guest_count }} tamu • {{ $listings->room_count }} kamar tidur • {{ $listings->bathroom_count }} kamar mandi
            </p>

            <div class="flex items-center gap-4 border-b pb-4">
                <div class="w-12 h-12 rounded-full">
                    <img src="{{ asset('storage/' . $listings->user->images) }}" alt="profile" class="rounded-full">
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