@extends('layouts.penginapan')
@section('content')
    <div class="flex justify-center p-6 min-h-36 space-x-5">
        <div class="mt-2 mr-2">
            <a href="{{ route('reservation.my') }}" class="text-lg font-bold hover:underline ">
                <img src="{{ asset('images/arrow-left1.svg' ) }}" alt="arrow-back" class="w-6 h-auto">
            </a>
        </div>
        <div class="w-full max-w-md bg-white border border-gray-200 rounded-3xl p-6 shadow-sm">
            
            <div class="flex gap-4 mb-6">
                <img src="{{ asset('storage/' . $reservation->listings->coverImage->image_path) }}" alt="Room Image" class="border w-24 h-24 object-cover rounded-xl">
                <div class="flex flex-col justify-center">
                    <h2 class="text-lg font-bold leading-tight text-gray-800">
                        {{ $reservation->listings->title }}
                    </h2>
                    <div class="flex items-center mt-1 text-sm text-gray-600">
                        <span class="mr-1">★</span>
                        {{-- <span class="font-medium">4,84</span> --}}
                        {{-- <span class="mx-1">(258)</span> --}}
                        <span class="mx-1 text-gray-300">•</span>
                        <span>Pilihan tamu</span>
                    </div>
                </div>
            </div>

            {{-- <hr class="border-gray-100 mb-6"> --}}

            {{-- <div class="mb-6">
                <h3 class="font-bold text-gray-800">Pembatalan gratis</h3>
                <p class="text-sm text-gray-600 mt-1">
                    Bila membatalkan sebelum 28 Januari, Anda akan mendapatkan pengembalian uang penuh.
                </p>
                <a href="#" class="text-sm font-bold underline mt-1 block">Kebijakan lengkap</a>
            </div> --}}

            <hr class="border-gray-100 mb-6">

            <div class="space-y-6 mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-gray-800">Tanggal</h3>
                        <p class="text-sm text-gray-600">{{ $reservation->check_in->format('j M') . ' - ' . $reservation->check_out->format('j M Y') }}</p>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-gray-800">Tamu</h3>
                        <p class="text-sm text-gray-600">1 dewasa</p>
                    </div>
                </div>
            </div>

            <hr class="border-gray-100 mb-6">

            <div class="space-y-3">
                <h3 class="font-bold text-gray-800 mb-4">Perincian harga</h3>
                
                <div class="flex justify-between text-gray-600">
                    <div class="text-sm">
                        {{ $days }} malam x {{ $price }}
                    </div>
                    <div class="text-right">
                        <span class="text-gray-800 font-medium">{{ $total }}</span>
                    </div>
                </div>
            </div>

            <hr class="border-gray-100 my-6">

            <div class="flex justify-between items-center">
                <div class="flex flex-col">
                    <span class="font-bold text-gray-800 text-lg">Total <span class="underline underline-offset-4">IDR</span></span>
                </div>
                <span class="text-xl font-bold text-gray-800">{{ $total }}</span>
            </div>

            <div>
                <div>
                    <button id="pay-button" class="mt-4 w-full bg-[#E91E63] text-white py-3 rounded-lg font-medium hover:bg-[#d81b60] transition">
                        Pesan
                    </button>
                </div>
            </div>

        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.client_key') }}">
    </script>

    <script>
    document.getElementById('pay-button').addEventListener('click', function () {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                console.log(result);
            },
            onPending: function(result){
                console.log(result);
            },
            onError: function(result){
                console.log(result);
            }
        });
    });
    </script>
@endsection



