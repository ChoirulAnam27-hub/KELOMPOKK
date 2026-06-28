<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Booking Lapangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Info Lapangan --}}
                    <div class="mb-8 p-5 bg-gray-50 dark:bg-gray-700 rounded-xl border border-gray-200 dark:border-gray-600 flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-2xl shadow-md shrink-0">
                            {{ substr($court->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $court->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $court->floor_type }}</p>
                            <p class="text-blue-600 dark:text-blue-400 font-semibold mt-1">Rp {{ number_format($court->price_per_hour, 0, ',', '.') }} / jam</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('bookings.store') }}" id="bookingForm" class="space-y-6">
                        @csrf
                        <input type="hidden" name="court_id" value="{{ $court->id }}">

                        {{-- Tanggal --}}
                        <div>
                            <x-input-label for="date" :value="__('Tanggal Main')" />
                            <x-text-input id="date" class="block mt-1 w-full" type="date" name="date"
                                :value="old('date', date('Y-m-d'))" required onchange="calculatePrice()" />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>

                        {{-- Jam Mulai & Selesai --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="start_time" :value="__('Jam Mulai')" />
                                <x-text-input id="start_time" class="block mt-1 w-full" type="time" name="start_time"
                                    :value="old('start_time')" required onchange="calculatePrice()" />
                                <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="end_time" :value="__('Jam Selesai')" />
                                <x-text-input id="end_time" class="block mt-1 w-full" type="time" name="end_time"
                                    :value="old('end_time')" required onchange="calculatePrice()" />
                                <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Ringkasan Harga --}}
                        <div id="price-summary" class="hidden p-5 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-700">
                            <h4 class="font-semibold text-blue-800 dark:text-blue-300 mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M4 19h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                Ringkasan Biaya
                            </h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                    <span>Durasi</span>
                                    <span id="duration-text" class="font-medium">-</span>
                                </div>
                                <div class="flex justify-between text-gray-800 dark:text-gray-200 text-base font-bold border-t border-blue-200 dark:border-blue-700 pt-2 mt-2">
                                    <span>Total</span>
                                    <span id="total-price-text">-</span>
                                </div>
                            </div>
                        </div>

                        {{-- Pilihan Pembayaran --}}
                        <div>
                            <x-input-label :value="__('Metode Pembayaran')" />
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-3 mt-1">Semua pembayaran dilakukan secara tunai saat tiba di lapangan.</p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                {{-- DP 50% --}}
                                <label for="payment_dp" class="relative flex cursor-pointer">
                                    <input type="radio" id="payment_dp" name="payment_type" value="dp"
                                        class="sr-only peer" {{ old('payment_type') === 'dp' ? 'checked' : '' }} onchange="updatePaymentSummary()" required>
                                    <div class="w-full p-4 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 peer-checked:border-yellow-500 peer-checked:bg-yellow-50 dark:peer-checked:bg-yellow-900/20 transition-all duration-200">
                                        <div class="flex items-start gap-3">
                                            <div class="w-8 h-8 rounded-full bg-yellow-100 dark:bg-yellow-900/40 flex items-center justify-center shrink-0 mt-0.5">
                                                <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-900 dark:text-white">Bayar DP 50%</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Bayar separuh saat datang, sisa dilunasi sebelum main.</p>
                                                <p id="dp-amount" class="text-sm font-bold text-yellow-600 dark:text-yellow-400 mt-2">DP: -</p>
                                                <p id="dp-remaining" class="text-xs text-gray-400">Sisa: -</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                {{-- Lunas --}}
                                <label for="payment_lunas" class="relative flex cursor-pointer">
                                    <input type="radio" id="payment_lunas" name="payment_type" value="lunas"
                                        class="sr-only peer" {{ old('payment_type', 'lunas') === 'lunas' ? 'checked' : '' }} onchange="updatePaymentSummary()" required>
                                    <div class="w-full p-4 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 peer-checked:border-green-500 peer-checked:bg-green-50 dark:peer-checked:bg-green-900/20 transition-all duration-200">
                                        <div class="flex items-start gap-3">
                                            <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/40 flex items-center justify-center shrink-0 mt-0.5">
                                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-900 dark:text-white">Bayar Lunas</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Bayar penuh saat tiba di lapangan. Tidak ada sisa.</p>
                                                <p id="lunas-amount" class="text-sm font-bold text-green-600 dark:text-green-400 mt-2">Total: -</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('payment_type')" class="mt-2" />
                        </div>

                        {{-- Ringkasan Pembayaran --}}
                        <div id="payment-summary" class="hidden p-4 rounded-xl border-2 border-dashed border-gray-200 dark:border-gray-600">
                            <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Yang harus dibayar saat datang:</p>
                            <p id="pay-now-amount" class="text-2xl font-bold text-gray-900 dark:text-white">-</p>
                            <p id="pay-later-note" class="text-xs text-gray-400 mt-1"></p>
                        </div>

                        <div class="flex items-center justify-end pt-2">
                            <a href="/" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 underline text-sm mr-4">Batal</a>
                            <x-primary-button id="submit-btn">
                                {{ __('Konfirmasi Booking') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const pricePerHour = {{ $court->price_per_hour }};

        function formatRupiah(amount) {
            return 'Rp ' + Math.round(amount).toLocaleString('id-ID');
        }

        function calculatePrice() {
            const startTime = document.getElementById('start_time').value;
            const endTime   = document.getElementById('end_time').value;

            if (!startTime || !endTime) return;

            const [sh, sm] = startTime.split(':').map(Number);
            const [eh, em] = endTime.split(':').map(Number);
            const startMinutes = sh * 60 + sm;
            const endMinutes   = eh * 60 + em;

            if (endMinutes <= startMinutes) return;

            const durationMin  = endMinutes - startMinutes;
            const durationHour = durationMin / 60;
            const totalPrice   = pricePerHour * durationHour;

            const h = Math.floor(durationMin / 60);
            const m = durationMin % 60;
            document.getElementById('duration-text').textContent = (h > 0 ? h + ' jam ' : '') + (m > 0 ? m + ' menit' : '');
            document.getElementById('total-price-text').textContent = formatRupiah(totalPrice);
            document.getElementById('dp-amount').textContent    = 'DP: ' + formatRupiah(totalPrice * 0.5);
            document.getElementById('dp-remaining').textContent = 'Sisa: ' + formatRupiah(totalPrice * 0.5);
            document.getElementById('lunas-amount').textContent = 'Total: ' + formatRupiah(totalPrice);

            document.getElementById('price-summary').classList.remove('hidden');
            updatePaymentSummary();
        }

        function updatePaymentSummary() {
            const startTime = document.getElementById('start_time').value;
            const endTime   = document.getElementById('end_time').value;
            if (!startTime || !endTime) return;

            const [sh, sm] = startTime.split(':').map(Number);
            const [eh, em] = endTime.split(':').map(Number);
            const durationHour = ((eh * 60 + em) - (sh * 60 + sm)) / 60;
            const totalPrice   = pricePerHour * durationHour;

            const isDp = document.getElementById('payment_dp').checked;
            const payNow = isDp ? totalPrice * 0.5 : totalPrice;
            const payLater = isDp ? totalPrice * 0.5 : 0;

            document.getElementById('pay-now-amount').textContent = formatRupiah(payNow);
            document.getElementById('pay-later-note').textContent = isDp
                ? 'Sisa ' + formatRupiah(payLater) + ' dibayar saat sebelum main di tempat.'
                : 'Pembayaran lunas. Tidak ada sisa tagihan.';
            document.getElementById('payment-summary').classList.remove('hidden');
        }

        // Run on load if there are old values
        window.addEventListener('load', calculatePrice);
    </script>
</x-app-layout>
