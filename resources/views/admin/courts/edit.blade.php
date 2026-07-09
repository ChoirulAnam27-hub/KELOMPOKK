<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Lapangan') }}: {{ $court->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form method="POST" action="{{ route('admin.courts.update', $court->id) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div>
                            <x-input-label for="name" :value="__('Nama Lapangan')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $court->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="floor_type" :value="__('Jenis Lantai')" />
                            <select id="floor_type" name="floor_type" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                @foreach(['Vinyl', 'Sintetis', 'Semen', 'Interlock'] as $type)
                                    <option value="{{ $type }}" {{ old('floor_type', $court->floor_type) == $type ? 'selected' : '' }}>
                                        {{ $type == 'Sintetis' ? 'Rumput Sintetis' : ($type == 'Semen' ? 'Semen / Plester' : $type) }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('floor_type')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="price_per_hour" :value="__('Harga per Jam (Rp)')" />
                            <x-text-input id="price_per_hour" class="block mt-1 w-full" type="number" name="price_per_hour" :value="old('price_per_hour', $court->price_per_hour)" required />
                            <x-input-error :messages="$errors->get('price_per_hour')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="location" :value="__('Lokasi / Alamat')" />
                            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location', $court->location)" placeholder="Cth: Jl. Raya Futsal No. 10, Semarang" />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Masukkan alamat lengkap lokasi lapangan (opsional)</p>
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <!-- Foto Lapangan -->
                        <div>
                            <x-input-label for="photo" :value="__('Foto Lapangan')" />
                            
                            {{-- Tampilkan foto saat ini jika ada --}}
                            @if($court->photo)
                                <div class="mt-2 mb-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Foto saat ini:</p>
                                    <img src="{{ Storage::url($court->photo) }}" alt="{{ $court->name }}" class="max-h-48 rounded-md object-cover">
                                </div>
                            @endif

                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-md hover:border-indigo-400 transition-colors duration-200" id="drop-zone">
                                <div class="space-y-1 text-center">
                                    <div id="preview-container" class="hidden mb-4">
                                        <img id="photo-preview" src="" alt="Preview Baru" class="mx-auto max-h-48 rounded-md object-cover">
                                        <p class="text-xs text-green-500 mt-1">Preview foto baru</p>
                                    </div>
                                    <svg id="upload-icon" class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 dark:text-gray-400 justify-center">
                                        <label for="photo" class="relative cursor-pointer bg-white dark:bg-gray-800 rounded-md font-medium text-indigo-600 hover:text-indigo-500">
                                            <span>{{ $court->photo ? 'Ganti foto' : 'Upload foto' }}</span>
                                            <input id="photo" name="photo" type="file" class="sr-only" accept="image/jpeg,image/png,image/jpg,image/webp" onchange="previewPhoto(this)">
                                        </label>
                                        <p class="pl-1">atau drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, WEBP hingga 2MB</p>
                                    <p id="file-name" class="text-xs text-indigo-500 font-medium hidden"></p>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <a href="{{ route('admin.courts.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline text-sm mr-4">Batal</a>
                            <x-primary-button>
                                {{ __('Update Lapangan') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        function previewPhoto(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('photo-preview').src = e.target.result;
                    document.getElementById('preview-container').classList.remove('hidden');
                    document.getElementById('upload-icon').classList.add('hidden');
                    document.getElementById('file-name').textContent = input.files[0].name;
                    document.getElementById('file-name').classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        const dropZone = document.getElementById('drop-zone');
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900/10');
        });
        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900/10');
        });
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900/10');
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                const input = document.getElementById('photo');
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                input.files = dataTransfer.files;
                previewPhoto(input);
            }
        });
    </script>
</x-app-layout>
