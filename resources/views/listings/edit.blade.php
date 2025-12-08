@extends('layouts.form')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <div class="bg-white rounded-2xl shadow-sm p-8 border-2 border-slate-500">
        <h1 class="text-4xl font-semibold text-gray-800 mb-1">
            Upload Penginapan
        </h1>
        <p class="text-gray-500 mb-8">
            Lengkapi detail penginapan kamu seperti di Airbnb
        </p>

        <form method="POST" action="{{ route('listings.update', $listings) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PATCH')
            {{-- title --}}
            <div>
                <label class="block text-lg font-medium text-gray-700 mb-1">
                    Judul Penginapan
                </label>
                <input
                    type="text"
                    name="title"
                    placeholder="Contoh: Villa dengan view sawah di Ubud"
                    class="w-full rounded-xl border-gray-300 focus:border-rose-500 focus:ring-rose-500"
                    required
                    value="{{ old('title', $listings->title) }}"
                >
                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- description --}}
            <div>
                <label class="block text-lg font-medium text-gray-700 mb-1">
                    Deskripsi
                </label>
                <textarea
                    name="description"
                    rows="4"
                    placeholder="Ceritakan keunikan penginapan kamu..."
                    class="w-full rounded-xl border-gray-300 focus:border-rose-500 focus:ring-rose-500"
                    required
                >{{ old('description', $listings->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- room count --}}
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-lg font-medium text-gray-700 mb-1">
                        Kamar Tidur
                    </label>
                    <input
                        type="number"
                        name="room_count"
                        min="1"
                        class="w-full rounded-xl border-gray-300 focus:ring-rose-500 focus:border-rose-500"
                        required
                        value="{{ old('room_count', $listings->room_count) }}"
                    >
                    @error('room_count')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-lg font-medium text-gray-700 mb-1">
                        Kamar Mandi
                    </label>
                    <input
                        type="number"
                        name="bathroom_count"
                        min="1"
                        class="w-full rounded-xl border-gray-300 focus:ring-rose-500 focus:border-rose-500"
                        required
                        value="{{ old('bathroom_count', $listings->bathroom_count) }}"
                    >
                    @error('bathroom_count')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-lg font-medium text-gray-700 mb-1">
                        Tamu
                    </label>
                    <input
                        type="number"
                        name="guest_count"
                        min="1"
                        class="w-full rounded-xl border-gray-300 focus:ring-rose-500 focus:border-rose-500"
                        required
                        value="{{ old('guest_count', $listings->guest_count) }}"
                    >
                    @error('guest_count')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- lokasi --}}
            <div>
                <label class="block text-lg font-medium text-gray-700 mb-1">
                    Alamat Lengkap
                </label>
                <input
                    type="text"
                    name="location_value"
                    class="w-full rounded-xl border-gray-300 focus:ring-rose-500 focus:border-rose-500"
                    required
                    value="{{ old('location_value', $listings->location_value) }}"
                >
                </input>
                @error('location_value')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- map --}}
            <div>
                <label class="block text-lg font-medium text-gray-700 mb-1">
                    Tentukan lokasi penginapan anda
                </label>
                <div class="relative z-0 overflow-hidden rounded-xl">
                    <div id="map" class="w-full h-[400px]"></div>
                </div>
                <p class="text-xs text-gray-500 mt-2">
                    Klik peta atau geser pin untuk menentukan lokasi
                </p>
                <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $listings->latitude) }}">
                <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $listings->longitude) }}">
                @error('latitude')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
                @error('longitude')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- categories --}}
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-1">
                    Kategori mana yang paling menggambarkan tempat Anda?
                </h2>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-4">
                    @foreach ($categories as $category)
                        <label class="cursor-pointer">
                            <input
                                type="radio"
                                name="category"
                                value="{{ $category->id }}"
                                class="peer hidden"
                                required
                                {{ old('category', $listings->category_id) == $category->id ? 'checked' : '' }}
                            >

                            <div
                                class="border rounded-xl p-5 text-center
                                    peer-checked:border-rose-500
                                    peer-checked:ring-2 peer-checked:ring-rose-500
                                    hover:border-gray-400 transition"
                            >
                                <div class="text-3xl mb-2 flex flex-col items-center justify-center">
                                    <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->title }}" class="w-12">
                                </div>
                                <p class="font-medium text-gray-700">
                                    {{ $category->title }}
                                </p>
                            </div>
                        </label>
                    @endforeach
                    @error('category')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- facilities --}}
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-1">
                    Fasilitas yang tersedia
                </h2>
                <p class="text-sm text-gray-500">
                    Bisa pilih lebih dari satu
                </p>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-4">
                    @foreach ($facilities as $facility)
                        <label class="cursor-pointer">
                            <input
                                type="checkbox"
                                name="facilities[]"
                                value="{{ $facility->id }}"
                                class="peer hidden"
                                @checked(
                                    in_array(
                                        $facility->id,
                                        old('facilities', $listings->facilities->pluck('id')->toArray())
                                    )
                                )
                            >

                            <div
                                class="border rounded-xl p-5 flex flex-col items-center text-center
                                    peer-checked:border-rose-500
                                    peer-checked:ring-2 peer-checked:ring-rose-500
                                    hover:border-gray-400 transition"
                            >
                                <div class="text-3xl mb-2">
                                    <img src="{{ asset('storage/' . $facility->image_path) }}" alt="{{ $facility->title }}" class="w-12">
                                </div>
                                <p class="font-medium text-gray-700">
                                    {{ $facility->title }}
                                </p>
                            </div>
                        </label>
                    @endforeach
                </div>
                @error('facilities')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>


            {{-- images --}}
            <div>
                <label class="block text-lg font-medium text-gray-700 mb-2">
                    Foto Penginapan
                </label>

                <input
                    id="images"
                    type="file"
                    name="images[]"
                    multiple
                    accept="image/*"
                    class="block w-full text-lg text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-lg file:font-medium file:bg-rose-50 file:text-rose-600 hover:file:bg-rose-100"
                >

                <p class="text-lg text-gray-400 mt-1">
                    Upload beberapa foto. Foto pertama otomatis jadi cover.
                </p>
                @error('images')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                {{-- preview --}}
                <div id="image-preview" class="grid grid-cols-3 gap-4 mt-4">
                    @foreach ($listings->images as $image)
                        <div class="relative image-item" data-existing="true" data-id="{{ $image->id }}">
                            <img src="{{ asset('storage/' . $image->image_path) }}" class=" w-full h-32 object-cover rounded-lg">
                            <button type="button" class="remove-image text-white font-bold absolute top-2 right-2 rounded-full w-7 h-7">
                                ✕
                            </button>
                        </div>
                    @endforeach
                </div>

                <input type="hidden" name="removed_images" id="removed-images">
            </div>


            {{-- price --}}
            <div>
                <label class="block text-lg font-medium text-gray-700 mb-1">
                    Harga per malam (Rp)
                </label>
                <input
                    type="number"
                    name="price"
                    placeholder="Contoh: 750000"
                    class="w-full rounded-xl border-gray-300 focus:ring-rose-500 focus:border-rose-500"
                    value="{{ old('price', $listings->price) }}"
                >
                @error('price')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-rose-500 hover:bg-rose-600 text-white font-medium py-3 rounded-xl transition">
                Simpan Penginapan
            </button>
        </form>
    </div>
</div>
@endsection