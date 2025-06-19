<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen & Penugasan Order
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
             @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Daftar Permintaan Masuk</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelanggan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keluhan</th>
                                    {{-- KOLOM BARU DITAMBAHKAN DI SINI --}}
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto Kerusakan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($requests as $serviceRequest)
                                    <tr>
                                        <td class="px-6 py-4">#{{ $serviceRequest->id }}</td>
                                        <td class="px-6 py-4">{{ $serviceRequest->user->name ?? 'User Dihapus' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            <p class="font-bold">{{ $serviceRequest->device_type }}</p>
                                            <p>{{ Str::limit($serviceRequest->description, 50) }}</p>
                                        </td>
                                        {{-- ISI UNTUK KOLOM FOTO KERUSAKAN --}}
                                        <td class="px-6 py-4 text-sm font-medium">
                                            @if($serviceRequest->damage_photo_path)
                                                <a href="{{ Storage::url($serviceRequest->damage_photo_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">
                                                    Lihat Foto
                                                </a>
                                            @else
                                                <span>-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full capitalize
                                                @if($serviceRequest->status == 'submitted') bg-yellow-100 text-yellow-800
                                                @elseif($serviceRequest->status == 'approved') bg-blue-100 text-blue-800
                                                @elseif($serviceRequest->status == 'assigned') bg-green-100 text-green-800
                                                @elseif($serviceRequest->status == 'pending_payment') bg-purple-100 text-purple-800
                                                @elseif($serviceRequest->status == 'completed') bg-gray-100 text-gray-800
                                                @endif">
                                                {{ str_replace('_', ' ', $serviceRequest->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if ($serviceRequest->status === 'submitted')
                                                <form action="{{ route('admin.orders.approve', $serviceRequest) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-green-600 hover:text-green-900">Approve</button>
                                                </form>
                                            @elseif ($serviceRequest->status === 'approved')
                                                <form action="{{ route('admin.orders.assign', $serviceRequest) }}" method="POST">
                                                    @csrf
                                                    <div class="flex items-center space-x-2">
                                                        <select name="technician_id" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm text-sm" required>
                                                            <option value="">Pilih Teknisi</option>
                                                            @foreach ($technicians as $technician)
                                                                <option value="{{ $technician->id }}">{{ $technician->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <button type="submit" class="px-3 py-1 bg-indigo-600 text-white rounded-md text-xs hover:bg-indigo-700">Assign</button>
                                                    </div>
                                                </form>
                                            @elseif ($serviceRequest->status === 'assigned')
                                                <div class="text-sm text-gray-500">
                                                    Ditugaskan ke:<br>
                                                    <span class="font-semibold">{{ $serviceRequest->technician->name ?? 'N/A' }}</span>
                                                </div>
                                            @elseif ($serviceRequest->status === 'pending_payment')
                                                <a href="{{ route('admin.payments.index') }}" class="px-3 py-1 bg-purple-600 text-white rounded-md text-xs hover:bg-purple-700">
                                                    Proses Pembayaran
                                                </a>
                                            @elseif ($serviceRequest->status === 'completed')
                                                <span class="text-sm text-gray-500">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td class="px-6 py-4 text-center" colspan="6">Tidak ada permintaan yang perlu ditangani.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                     <div class="mt-4">
                        {{ $requests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>