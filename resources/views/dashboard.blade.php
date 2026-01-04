<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <x-summary-card title="Total Balance">
                    Rp{{ number_format($user->balance->balance ?? 0, 2, ',', '.') }}
                </x-summary-card>

                <x-summary-card title="Total Listings">
                    {{ $totalListings }}
                </x-summary-card>

                <x-summary-card title="Total Bookings">
                    {{ $totalBookings }}
                </x-summary-card>

                <x-summary-card title="Completed Bookings">
                    {{ $completedBookings }}
                </x-summary-card>
            </div>

            <div class="bg-white rounded-xl shadow p-6 mb-8 w-full overflow-x-auto">
                <h2 class="text-lg font-semibold mb-4">Incoming Bookings</h2>

                <table class="min-w-[600px] md:w-full text-sm">
                    <thead class="text-gray-500 border-b">
                        <tr>
                            <th class="py-2 text-left whitespace-nowrap">Listing</th>
                            <th class="text-left whitespace-nowrap">Guest</th>
                            <th class="whitespace-nowrap">Date</th>
                            <th class="whitespace-nowrap">Status</th>
                            <th class="whitespace-nowrap">Total 10{{ '%' }} fee</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($incomingBookings as $booking)
                            <tr class="border-b">
                                <td class="py-2 whitespace-nowrap">{{ $booking->listings->title }}</td>
                                <td class="whitespace-nowrap">{{ $booking->user->name }}</td>
                                <td class="text-center whitespace-nowrap">{{ $booking->check_in->format('j M') }} → {{ $booking->check_out->format('j M Y') }}</td>
                                <td class="text-center whitespace-nowrap">
                                    <span class="px-2 py-1 rounded text-xs
                                        {{ $booking->payment_status === 'paid' ? 'bg-green-100 text-green-600' : ($booking->payment_status === 'completed' ? 'bg-blue-100 text-blue-600' : 'bg-yellow-100 text-yellow-600')  }}">
                                        {{ ucfirst($booking->payment_status) }}
                                    </span>
                                </td>
                                <td class="text-center whitespace-nowrap">Rp{{ number_format($booking->total_price - ($booking->total_price * 10 / 100)) }}</td>
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
