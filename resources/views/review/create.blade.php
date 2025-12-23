@extends('layouts.penginapan')
@section('content')
    <div class="max-w-xl mx-auto py-10">
        <h1 class="text-2xl font-semibold mb-4">Review your stay</h1>
        <div class="mb-6">
            <h2 class="font-medium">{{ $reservation->listings->title }}</h2>
            <p class="text-sm text-gray-500">
                {{ $reservation->check_in->format('j M') }} → {{ $reservation->check_out->format('j M Y') }}
            </p>
        </div>
        <form method="POST" action="{{ route('review.store', $reservation->id) }}">
            @csrf
            {{-- Rating --}}
            <div class="mb-4">
                <label class="block mb-2 font-medium">Rating</label>
                <div id="rating" class="flex gap-1">
                    @for ($i = 1; $i <= 5; $i++)
                        <button type="button"
                            class="star text-3xl text-gray-300"
                            data-value="{{ $i }}">
                            ★
                        </button>
                    @endfor
                </div>

                <input type="hidden" name="rating" id="rating-input" value="{{ old('rating') }}">
                @error('rating')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            {{-- Comment --}}
            <div class="mb-6">
                <label class="block mb-2 font-medium">Comment (optional)</label>
                <textarea name="comment"
                    rows="4"
                    class="w-full border rounded p-3"
                >{{ old('comment') }}</textarea>
            </div>
            <button
                type="submit"
                class="bg-rose-500 hover:bg-rose-600 text-white px-6 py-2 rounded"
            >
                Submit review
            </button>
        </form>
    </div>
    {{-- Rating Script --}}
    <script>
        const stars = document.querySelectorAll('.star');
        const input = document.getElementById('rating-input');

        stars.forEach(star => {
            star.addEventListener('click', () => {
                const value = star.dataset.value;
                input.value = value;

                stars.forEach(s => {
                    s.classList.toggle('text-rose-500', s.dataset.value <= value);
                    s.classList.toggle('text-gray-300', s.dataset.value > value);
                });
            });
        });
    </script>
@endsection