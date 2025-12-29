@extends('layouts.penginapan')
@section('content')
    <div class="flex flex-col gap-4 max-w-6xl mx-auto px-4 py-10">

        <h1 class="text-2xl font-semibold">Incoming Booking</h1>

        @forelse ($reservations as $reservation)
            <a href="{{ route('booking.show', $reservation) }}">
                <div class="flex gap-4 border rounded-xl p-4">
                    {{-- Cover --}}
                    <img
                        src="{{ asset('storage/' . $reservation->listings->coverImage->image_path)}}"
                        class="w-32 h-24 object-cover rounded-lg"
                    >
                    {{-- Info --}}
                    <div class="flex-1">
                        <h2 class="font-semibold">
                            {{ $reservation->listings->title }}
                        </h2>

                        <p class="text-sm text-gray-500">
                            Guest: {{ $reservation->user->name }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $reservation->check_in->format('j M') }} → {{ $reservation->check_out->format('j M Y') }}
                        </p>

                        <p class="mt-1 font-medium">
                            Rp {{ number_format($reservation->total_price) }}
                        </p>
                    </div>
                    {{-- Status --}}
                    <div class="flex items-center">
                        <span class="px-3 py-1 text-xs rounded-full
                            @if($reservation->payment_status === 'paid') bg-green-100 text-green-700
                            @elseif($reservation->payment_status === 'pending') bg-yellow-100 text-yellow-700
                            @elseif($reservation->payment_status === 'cancelled') bg-red-100 text-red-700
                            @endif
                        ">
                            {{ ucfirst($reservation->payment_status) }}
                        </span>
                    </div>
                </div>
            </a>
        @empty
            <p class="text-gray-500">Belum ada booking masuk.</p>
        @endforelse

    </div>
@endsection