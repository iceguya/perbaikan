{{-- Salin dan tempel seluruh file ini ke resources/views/user/requests/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Permintaan Servis Saya
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Perangkat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($requests as $request)
                                    <tr>
                                        <td class="px-6 py-4">#{{ $request->id }}</td>
                                        <td class="px-6 py-4">{{ $request->device_type }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full capitalize 
                                                @if($request->status == 'completed') bg-green-100 text-green-800
                                                @elseif($request->status == 'in_progress') bg-blue-100 text-blue-800
                                                @elseif($request->status == 'pending_payment') bg-purple-100 text-purple-800
                                                @else bg-yellow-100 text-yellow-800 @endif">
                                                {{ str_replace('_', ' ', $request->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($request->status == 'pending_payment')
                                                <a href="{{ route('user.payments.create', $request->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Bayar Sekarang</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Anda belum memiliki riwayat permintaan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>