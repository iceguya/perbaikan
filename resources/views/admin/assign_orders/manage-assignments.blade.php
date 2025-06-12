<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen Penugasan Permintaan Layanan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Daftar Permintaan Menunggu Penugasan</h3>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Permintaan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diajukan Oleh</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Tugaskan</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($requestsToAssign as $requestItem) {{-- UBAH VARIABEL DARI $order JADI $requestItem --}}
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $requestItem->id }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            <div class="line-clamp-2 max-w-xs">{{ $requestItem->description }}</div>
                                            <div class="text-xs text-gray-500">
                                                Alat: {{ $requestItem->device_type ?? 'N/A' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($requestItem->status === 'pending' || $requestItem->status === 'new' || $requestItem->status === 'submitted') bg-yellow-100 text-yellow-800
                                                @elseif($requestItem->status === 'assigned') bg-blue-100 text-blue-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $requestItem->status)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $requestItem->user->name ?? 'Pengguna Tidak Dikenal' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            @if($requestItem->assignedToUser)
                                                <span class="text-gray-500">Ditugaskan ke: {{ $requestItem->assignedToUser->name }}</span>
                                            @else
                                                <form action="{{ route('admin.assign_orders.assign', $requestItem->id) }}" method="POST" class="flex items-center">
                                                    @csrf
                                                    <select name="technician_id" class="block w-full py-1 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                        <option value="">Pilih Teknisi</option>
                                                        @foreach($technicians as $technician)
                                                            <option value="{{ $technician->id }}">{{ $technician->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <button type="submit" class="ml-2 px-3 py-1 bg-indigo-600 text-white rounded-md text-xs hover:bg-indigo-700">Tugaskan</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500" colspan="5">Tidak ada permintaan yang perlu ditugaskan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $requestsToAssign->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>