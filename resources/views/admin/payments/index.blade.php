<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen Pembayaran
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
                    <h3 class="text-lg font-semibold mb-4">Daftar Transaksi Pembayaran</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID Servis</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bukti Pembayaran</th> {{-- KOLOM BARU --}}
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($payments as $payment)
                                    <tr>
                                        <td class="px-6 py-4">#{{ $payment->service_request_id }}</td>
                                        <td class="px-6 py-4">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full capitalize {{ $payment->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $payment->status }}
                                            </span>
                                        </td>
                                        {{-- ISI KOLOM BARU --}}
                                        <td class="px-6 py-4">
                                            @if($payment->proof_of_payment_path)
                                                <a href="{{ Storage::url($payment->proof_of_payment_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                                    Lihat Bukti
                                                </a>
                                            @else
                                                <span>Tidak Ada</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($payment->status === 'pending')
                                                <form action="{{ route('admin.payments.approve', $payment->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-sm text-green-600 hover:text-green-900">Approve</button>
                                                </form>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td class="px-6 py-4 text-center" colspan="5">Tidak ada data pembayaran.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>