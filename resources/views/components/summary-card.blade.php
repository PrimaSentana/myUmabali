@props(['title'])

<div class="bg-white rounded-xl shadow p-6">
    <p class="text-sm text-gray-500 mb-1">{{ $title }}</p>
    <p class="text-2xl font-semibold">
        {{ $slot }}
    </p>
</div>
