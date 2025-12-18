@extends('layouts.penginapan')
@section('content')
    <div class="max-w-6xl mx-auto px-4 py-10 space-y-6">
        <h1 class="text-2xl font-semibold">My Reservation</h1>
        @forelse ($reservations as $reservation)
            @php
                $isCompleted = \Carbon\Carbon::parse($reservation->check_out)->isPast();
            @endphp
            <div class="flex gap-4 border rounded-xl p-4">
                <img
                    src="{{ asset('storage/' . $reservation->listings->coverImage->image_path) }}"
                    class="w-32 h-24 object-cover rounded-lg"
                >
                <div class="flex-1">
                    <h2 class="font-semibold">
                        {{ $reservation->listings->title }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        {{ $reservation->check_in->format('j M') }} → {{ $reservation->check_out->format('j M Y') }}
                    </p>
                    <p class="mt-1 font-medium">
                        Rp{{ number_format($reservation->total_price, 2, ',', '.') }}
                    </p>
                    {{-- Status badge --}}
                    <span class="inline-block mt-2 px-3 py-1 text-xs rounded-full
                        @if($reservation->payment_status === 'pending') bg-yellow-100 text-yellow-700
                        @elseif($reservation->payment_status === 'paid') bg-green-100 text-green-700
                        @elseif($reservation->payment_status === 'cancelled') bg-red-100 text-red-700
                        @endif
                    ">
                        {{ ucfirst($reservation->payment_status) }}
                    </span>
                </div>
                {{-- Actions --}}
                <div class="flex flex-col justify-between items-end">
                    {{-- Pay --}}
                    @if($reservation->payment_status === 'pending')
                        <button
                            class="px-4 py-2 bg-black text-white rounded-lg"
                            onclick="window.snap.pay('{{ $reservation->snap_token }}')"
                        >
                            Pay Now
                        </button>
                    @endif
                    {{-- Cancel --}}
                    @if(
                        in_array($reservation->payment_status, ['pending', 'paid']) &&
                        \Carbon\Carbon::parse($reservation->check_in)->isFuture()
                    )
                        <form action="{{ route('reservation.cancel', $reservation->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="text-sm text-red-500 mt-2">
                                Cancel
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-gray-500">Belum ada reservasi.</p>
        @endforelse

    </div>
@endsection