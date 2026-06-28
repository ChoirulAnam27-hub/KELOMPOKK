<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Kelola Booking User (Admin)') }}
            </h2>
            <a href="{{ route('admin.courts.index') }}" class="text-sm text-indigo-400 hover:text-indigo-300 underline">
                ← Kelola Lapangan
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Filter Tabs --}}
            <div class="flex gap-2 flex-wrap">
                @foreach(['all' => 'Semua', 'pending' => 'Pending', 'confirmed' => 'Dikonfirmasi', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $key => $label)
                    <a href="{{ route('admin.bookings.index', ['status' => $key]) }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200
                              {{ $status === $key
                                  ? 'bg-indigo-600 text-white shadow-md'
                                  : 'bg-white dark:bg-gray-700 text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if($bookings->isEmpty())
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada data booking.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th class="px-4 py-3">Tgl Booking</th>
                                        <th class="px-4 py-3">User</th>
                                        <th class="px-4 py-3">Lapangan</th>
                                        <th class="px-4 py-3">Jadwal Main</th>
                                        <th class="px-4 py-3">Total</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Ubah Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($bookings as $booking)
                                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                            <td class="px-4 py-4 text-xs">
                                                {{ $booking->created_at->format('d M Y') }}<br>
                                                <span class="text-gray-400">{{ $booking->created_at->format('H:i') }}</span>
                                            </td>
                                            <td class="px-4 py-4">
                                                <p class="font-medium text-gray-900 dark:text-white">{{ $booking->user->name }}</p>
                                                <p class="text-xs text-gray-400">{{ $booking->user->email }}</p>
                                            </td>
                                            <td class="px-4 py-4 font-medium text-gray-900 dark:text-white">
                                                {{ $booking->court->name }}
                                            </td>
                                            <td class="px-4 py-4">
                                                <p class="font-semibold text-gray-800 dark:text-gray-200">{{ \Carbon\Carbon::parse($booking->date)->format('d M Y') }}</p>
                                                <p class="text-xs text-gray-400">
                                                    {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} – {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}
                                                </p>
                                            </td>
                                            <td class="px-4 py-4 font-bold text-indigo-600 dark:text-indigo-400">
                                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-4">
                                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full
                                                    @if($booking->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400
                                                    @elseif($booking->status === 'confirmed') bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400
                                                    @elseif($booking->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                                                    @else bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 @endif">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-4">
                                                <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST" class="flex items-center gap-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" class="text-xs border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 py-1.5">
                                                        <option value="pending"    {{ $booking->status === 'pending'   ? 'selected' : '' }}>Pending</option>
                                                        <option value="confirmed"  {{ $booking->status === 'confirmed'  ? 'selected' : '' }}>Konfirmasi</option>
                                                        <option value="completed"  {{ $booking->status === 'completed'  ? 'selected' : '' }}>Selesai</option>
                                                        <option value="cancelled"  {{ $booking->status === 'cancelled'  ? 'selected' : '' }}>Batalkan</option>
                                                    </select>
                                                    <button type="submit" class="px-2 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs rounded-md transition-colors">
                                                        Simpan
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-6">
                            {{ $bookings->appends(['status' => $status])->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
