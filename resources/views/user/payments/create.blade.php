<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pembayaran & Upload Bukti untuk Request #{{ $serviceRequest->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- Inisialisasi Alpine.js untuk mengatur state --}}
                <div x-data="{ paymentMethod: '' }" class="p-8 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900">Detail Permintaan</h3>
                    <p class="mt-1 text-sm text-gray-600">Perangkat: {{ $serviceRequest->device_type }} ({{ $serviceRequest->brand }})</p>

                    {{-- PENTING: enctype untuk memungkinkan upload file --}}
                    <form method="POST" action="{{ route('user.payments.store', $serviceRequest->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-6 border-t pt-6">
                            <p class="text-2xl font-bold">Total Biaya: Rp 250.000</p>
                            <input type="hidden" name="amount" value="250000">

                            {{-- BAGIAN 1: PILIH METODE PEMBAYARAN --}}
                            <div class="mt-6 space-y-4">
                                <fieldset>
                                    <legend class="text-base font-medium text-gray-900">1. Pilih Metode Pembayaran Anda</legend>
                                    <div class="mt-4 space-y-4">
                                        <div class="flex items-center">
                                            <input x-model="paymentMethod" id="transfer_bank" name="payment_method" type="radio" value="Transfer Bank" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500" required>
                                            <label for="transfer_bank" class="ml-3 block text-sm font-medium text-gray-700">Transfer Bank</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input x-model="paymentMethod" id="e-wallet" name="payment_method" type="radio" value="E-wallet" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="e-wallet" class="ml-3 block text-sm font-medium text-gray-700">E-wallet (GoPay, OVO, Dana)</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
                            </div>

                            {{-- BAGIAN 2: TAMPILKAN INSTRUKSI SESUAI PILIHAN --}}
                            <div x-show="paymentMethod === 'Transfer Bank'" x-transition class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                <h4 class="font-semibold text-blue-800">2. Lakukan Pembayaran</h4>
                                <p class="text-sm text-blue-700 mt-2">Silakan transfer ke nomor rekening berikut:</p>
                                <p class="text-lg font-mono font-bold text-gray-800 bg-white p-2 rounded inline-block mt-1">1785330889 (BNI)</p>
                                <p class="text-sm text-blue-700 mt-2">Atas Nama: PT Hirawr Service</p>
                            </div>

                            <div x-show="paymentMethod === 'E-wallet'" x-transition class="mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                                <h4 class="font-semibold text-green-800">2. Lakukan Pembayaran</h4>
                                <p class="text-sm text-green-700 mt-2">Silakan lakukan pembayaran ke nomor berikut:</p>
                                <p class="text-lg font-mono font-bold text-gray-800 bg-white p-2 rounded inline-block mt-1">0851-2488-8911</p>
                                <p class="text-sm text-green-700 mt-2">Atas Nama: Hirawr Store</p>
                            </div>
                            
                            {{-- BAGIAN 3: UPLOAD BUKTI (MUNCUL SETELAH METODE DIPILIH) --}}
                            <div x-show="paymentMethod" x-transition class="mt-6">
                                <div>
                                    <label for="proof_of_payment" class="block text-base font-medium text-gray-900">3. Upload Bukti Pembayaran</label>
                                    <input type="file" name="proof_of_payment" id="proof_of_payment" class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" required>
                                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, JPEG. Maksimal 2MB.</p>
                                    <x-input-error :messages="$errors->get('proof_of_payment')" class="mt-2" />
                                </div>
                            </div>
                            
                            <div x-show="paymentMethod" x-transition class="mt-8">
                                <x-primary-button>
                                    {{ __('Kirim Bukti & Selesaikan Pembayaran') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>