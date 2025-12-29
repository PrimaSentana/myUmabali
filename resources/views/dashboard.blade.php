<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <x-summary-card title="Total Balance">
                    Rp{{ number_format($user->balance->balance, 2, ',', '.') }}
                </x-summary-card>

                <x-summary-card title="Total Listings">
                    {{ $totalListings }}
                </x-summary-card>

                <x-summary-card title="Total Bookings">
                    {{ $totalBookings }}
                </x-summary-card>

                <x-summary-card title="Paid Bookings">
                    {{ $completedBookings }}
                </x-summary-card>
            </div>

            <div class="bg-white rounded-xl shadow p-6 mb-8">
                <h2 class="text-lg font-semibold mb-4">Incoming Bookings</h2>

                <table class="w-full text-sm">
                    <thead class="text-gray-500 border-b">
                        <tr>
                            <th class="py-2 text-left">Listing</th>
                            <th class="text-left">Guest</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total 10{{ '%' }} fee</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($incomingBookings as $booking)
                            <tr class="border-b">
                                <td class="py-2">{{ $booking->listings->title }}</td>
                                <td>{{ $booking->user->name }}</td>
                                <td class="text-center">{{ $booking->check_in->format('j M') }} → {{ $booking->check_out->format('j M Y') }}</td>
                                <td class="text-center">
                                    <span class="px-2 py-1 rounded text-xs
                                        {{ $booking->payment_status === 'paid' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                                        {{ ucfirst($booking->payment_status) }}
                                    </span>
                                </td>
                                <td class="text-center">Rp{{ number_format($booking->total_price) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-400">
                                    No bookings yet
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Top Listings</h2>

                <ul class="space-y-3">
                    @foreach ($topListings as $listing)
                        <li class="flex justify-between">
                            <span>{{ $listing->title }}</span>
                            <span class="text-gray-500">
                                {{ $listing->reservations_count }} bookings
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
