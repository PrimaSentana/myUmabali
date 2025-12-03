@extends('layouts.penginapan')
@section('content')
    <div class="container mx-auto px-4 py-8 text-[#1b1b18]">

    <!-- Judul -->
    <h1 class="text-xl font-medium mb-4">{{ $list['title'] }}, Kamar untuk 2 orang</h1>

    <!-- Bagian Foto -->
    <div class="grid grid-cols-3 gap-2 h-128 rounded-xl overflow-hidden">
    <!-- Gambar besar -->
        <div class="col-span-2 h-full bg-gray-200 rounded-left-xl overflow-hidden">
            <img src="{{ $list['image'] }}" alt="{{ $list['title'] }}" class="w-full h-full object-cover">
        </div>

        <!-- Gambar kecil di kanan -->
        <div class="grid grid-rows-2 gap-2">
            <div class="h-64 bg-gray-200 rounded-xl overflow-visible">
                <img src="{{ $list['image'] }}" alt="{{ $list['title'] }}" class="w-full h-full object-cover">
            </div>
            <div class="h-64 bg-gray-200 rounded-xl overflow-visible">
                <img src="{{ $list['image'] }}" alt="{{ $list['title'] }}" class="w-full h-full object-cover">
            </div>
        </div>
    </div>


    {{-- <button class="text-sm mt-2 underline text-gray-500">Tampilkan semua foto</button> --}}

    <div class="flex flex-col md:flex-row gap-8 mt-8">

        <!-- Kolom kiri -->
        <div class="md:w-2/3 space-y-6">

            <p class="text-gray-600">
                Seluruh serviced {{ $list['title'] }}, Bali<br>
                2 tamu • 1 kamar tidur • 1 kamar mandi
            </p>

            <div class="flex items-center gap-4 border-b pb-4">
                <div class="w-12 h-12 bg-gray-300 rounded-full"></div>
                <div>
                    <p class="font-medium">Tuan Rumah: DirgaNtara1</p>
                    <p class="text-sm text-gray-500">HostTeladan: Tuan rumah selama 3 tahun</p>
                </div>
            </div>

            <div>
                <h2 class="text-lg font-semibold my-4">Deskripsi</h2>
                <div class="rounded-lg w-180 flex items-center justify-center">
                    <h2>{{ $list['description'] }}</h2>
                </div>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-2">Kamar Anda</h2>
                <div class="bg-gray-200 rounded-lg h-70 w-180 flex items-center justify-center text-gray-500">
                    <img src="{{ $list['image'] }}" alt="{{ $list['title'] }}" class="w-full h-full object-cover rounded-lg">
                </div>
                <p class="text-sm text-gray-600 mt-2">1 tempat tidur</p>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-2">Fasilitas yang ditawarkan</h2>
                <div class="grid grid-cols-2 gap-y-2">
                    <p>• Pemandangan cakrawala kota</p>
                    <p>• Microwave</p>
                    <p>• Wifi</p>
                    <p>• Dapur</p>
                    <p>• AC Sentral</p>
                    <p>• Area kerja khusus</p>
                </div>
                {{-- <button class="mt-3 text-sm text-gray-500 underline">Tampilkan ke-12 fasilitas</button> --}}
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-2">Lokasi penginapan</h2>
                <p class="text-sm text-gray-600 mb-3">Kuta, Kabupaten Badung, Indonesia</p>
                <div class="bg-gray-200 h-64 flex items-center justify-center text-gray-500 rounded-xl">MAPS</div>
            </div>
        </div>

        <!-- Kolom kanan (Card harga) -->
        <div class="md:w-1/3">
            <div class="border rounded-xl shadow-md p-5 sticky top-24">
                <p class="text-xl font-semibold">{{ $list['price'] }} <span class="text-sm font-normal text-gray-500">/ malam</span></p>

                <div class="mt-4 border rounded-lg divide-y">
                    <div class="grid grid-cols-2 text-sm">
                        <div class="p-2">
                            <label class="block text-gray-500">CHECK-IN</label>
                            <p class="font-medium">12/10/2025</p>
                        </div>
                        <div class="p-2 border-l">
                            <label class="block text-gray-500">CHECK-OUT</label>
                            <p class="font-medium">13/10/2025</p>
                        </div>
                    </div>
                    <div class="p-2">
                        <label class="block text-gray-500 text-sm">TAMU</label>
                        <select class="w-full border-none text-sm font-medium focus:ring-0">
                            <option>1 Tamu</option>
                            <option>2 Tamu</option>
                        </select>
                    </div>
                </div>

                <button class="mt-4 w-full bg-[#E91E63] text-white py-3 rounded-lg font-medium hover:bg-[#d81b60] transition">
                    Pesan
                </button>
                <p class="text-center text-xs text-gray-500 mt-2">Anda belum dikenakan biaya</p>
            </div>
        </div>
    </div>
</div>
@endsection