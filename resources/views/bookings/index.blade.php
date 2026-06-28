<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Booking Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center gap-2">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if($bookings->isEmpty())
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            <p class="text-gray-500 dark:text-gray-400 mb-4 text-lg">Kamu belum memiliki riwayat booking.</p>
                            <a href="/" class="px-6 py-3 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition font-medium">Booking Sekarang</a>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($bookings as $booking)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-5 hover:border-indigo-400 dark:hover:border-indigo-500 transition-all duration-200">
                                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">

                                        {{-- Info Lapangan & Jadwal --}}
                                        <div class="flex-grow">
                                            <div class="flex items-center gap-2 mb-2">
                                                {{-- Status Booking --}}
                                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full
                                                    @if($booking->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400
                                                    @elseif($booking->status === 'confirmed') bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400
                                                    @elseif($booking->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                                                    @else bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 @endif">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                                {{-- Status Bayar --}}
                                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full
                                                    @if(($booking->payment_status ?? 'unpaid') === 'paid') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                                                    @elseif(($booking->payment_status ?? 'unpaid') === 'dp_paid') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400
                                                    @else bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400 @endif">
                                                    @if(($booking->payment_status ?? 'unpaid') === 'paid') ✅ Lunas
                                                    @elseif(($booking->payment_status ?? 'unpaid') === 'dp_paid') 💰 DP 50%
                                                    @else ⏳ Belum Bayar @endif
                                                </span>
                                            </div>

                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $booking->court->name }}</h3>
                                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                <span>📅 {{ \Carbon\Carbon::parse($booking->date)->translatedFormat('d F Y') }}</span>
                                                <span>🕐 {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} – {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</span>
                                            </div>
                                        </div>

                                        {{-- Info Pembayaran --}}
                                        <div class="shrink-0 text-right">
                                            <p class="text-xs text-gray-400 mb-1">Total Tagihan</p>
                                            <p class="text-xl font-bold text-indigo-600 dark:text-indigo-400">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>

                                            @if(isset($booking->payment_type))
                                                <div class="mt-2 text-xs text-gray-500 dark:text-gray-400 space-y-0.5">
                                                    @if($booking->payment_type === 'dp')
                                                        <p>DP dibayar: <span class="font-semibold text-yellow-600 dark:text-yellow-400">Rp {{ number_format($booking->amount_paid, 0, ',', '.') }}</span></p>
                                                        @if($booking->remaining_payment > 0)
                                                            <p>Sisa bayar di tempat: <span class="font-semibold text-red-500">Rp {{ number_format($booking->remaining_payment, 0, ',', '.') }}</span></p>
                                                        @endif
                                                    @else
                                                        <p>Bayar lunas di tempat: <span class="font-semibold text-green-600 dark:text-green-400">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span></p>
                                                    @endif
                                                </div>
                                            @endif

                                            <p class="text-xs text-gray-400 mt-2">Dipesan {{ $booking->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
