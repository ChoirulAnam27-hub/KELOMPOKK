<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Kelola Lapangan (Admin)') }}
            </h2>
            <div class="flex gap-3">
                <a href="{{ route('admin.bookings.index') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                    📋 Kelola Booking
                </a>
                <a href="{{ route('admin.courts.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                    + Tambah Lapangan
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    @if($courts->isEmpty())
                        <div class="text-center py-8 text-gray-500">
                            Belum ada data lapangan.
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Foto</th>
                                        <th scope="col" class="px-6 py-3">Nama Lapangan</th>
                                        <th scope="col" class="px-6 py-3">Jenis Lantai</th>
                                        <th scope="col" class="px-6 py-3">Harga / Jam</th>
                                        <th scope="col" class="px-6 py-3">Lokasi</th>
                                        <th scope="col" class="px-6 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($courts as $court)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4">
                                                @if($court->photo)
                                                    <img src="{{ Storage::url($court->photo) }}" alt="{{ $court->name }}" class="w-16 h-12 object-cover rounded">
                                                @else
                                                    <span class="text-xs text-gray-400">No Image</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $court->name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $court->floor_type }}
                                            </td>
                                            <td class="px-6 py-4">
                                                Rp {{ number_format($court->price_per_hour, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($court->location)
                                                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $court->location }}</span>
                                                @else
                                                    <span class="text-xs text-gray-400 italic">Belum diisi</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 flex gap-4">
                                                <a href="{{ route('admin.courts.edit', $court->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 underline">Edit</a>
                                                <form action="{{ route('admin.courts.destroy', $court->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus lapangan ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-500 dark:hover:text-red-400 underline">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
