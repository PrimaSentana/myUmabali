@extends('layouts.penginapan')
@section('content')
    <div class="max-w-5xl mx-auto px-4 py-10 space-y-8">

        {{-- Header --}}
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold">
                Booking Detail
            </h1>

            <span class="px-4 py-1 text-sm rounded-full
                @if($reservation->payment_status === 'paid') bg-green-100 text-green-700
                @elseif($reservation->payment_status === 'pending') bg-yellow-100 text-yellow-700
                @elseif($reservation->payment_status === 'cancelled') bg-red-100 text-red-700
                @endif
            ">
                {{ ucfirst($reservation->payment_status) }}
            </span>
        </div>

        {{-- Listing Info --}}
        <div class="flex gap-6 border rounded-xl p-6">
            <img
                src="{{ asset('storage/' . $reservation->listings->coverImage->image_path)}}"
                class="w-48 h-32 object-cover rounded-lg"
            >

            <div>
                <h2 class="text-lg font-semibold">
                    {{ $reservation->listings->title }}
                </h2>

                <p class="text-gray-500 text-sm">
                    {{ $reservation->listings->location_value }}
                </p>
            </div>
        </div>

        {{-- Booking Info --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="border rounded-xl p-6 space-y-3">
                <h3 class="font-semibold">Guest</h3>
                <p>{{ $reservation->user->name }}</p>
                <p class="text-sm text-gray-500">{{ $reservation->user->email }}</p>
            </div>

            <div class="border rounded-xl p-6 space-y-3">
                <h3 class="font-semibold">Stay</h3>
                <p>Check-in: <strong>{{ $reservation->check_in }}</strong></p>
                <p>Check-out: <strong>{{ $reservation->check_out }}</strong></p>
            </div>

            <div class="border rounded-xl p-6 space-y-3">
                <h3 class="font-semibold">Payment</h3>
                <p>Total: <strong>Rp {{ number_format($reservation->total_price, 2, '.', ',') }}</strong></p>
                <p>Status: {{ ucfirst($reservation->payment_status) }}</p>
            </div>

        </div>

        {{-- Back --}}
        <a
            href="{{ route('booking.my') }}"
            class="inline-block text-sm text-gray-600 hover:underline"
        >
            ← Back to Incoming Bookings
        </a>

    </div>
@endsection