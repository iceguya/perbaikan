<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    
                    {{-- Tampilkan pesan sukses jika ada (misalnya setelah submit form) --}}
                    @if (session('status'))
                        <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/50 text-green-700 dark:text-green-300 rounded-lg">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-semibold">Riwayat Permintaan Servis</h3>
                        <a href="{{ route('user.requests.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Buat Request Baru
                        </a>
                    </div>

                    <div class="mt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="mt-6 space-y-4">
                            {{-- Gunakan @forelse untuk loop data. Jika data kosong, tampilkan pesan @empty --}}
                            @forelse ($requests as $request)
                                <div class="p-4 border dark:border-gray-600 rounded-lg flex justify-between items-start flex-wrap gap-4">
                                    <div>
                                        <p class="font-semibold text-lg text-indigo-600 dark:text-indigo-400">{{ $request->brand }} {{ $request->series_model }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                            {{ $request->device_type }} | Diajukan pada: {{ $request->created_at->format('d F Y, H:i') }}
                                        </p>
                                        <p class="mt-3 text-sm">{{ $request->description }}</p>
                                    </div>
                                    <div class="ml-4 text-right flex-shrink-0">
                                        @php
                                            $statusClass = match($request->status) {
                                                'pending' => 'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                                'processing' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-200',
                                                'completed' => 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-200',
                                                'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-200',
                                                default => '',
                                            };
                                        @endphp
                                        <span class="text-xs font-medium px-3 py-1 rounded-full {{ $statusClass }}">
                                            {{ ucfirst($request->status) }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">Tidak ada permintaan</h3>
                                    <p class="mt-1 text-sm text-gray-500">Anda belum pernah membuat permintaan servis.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>