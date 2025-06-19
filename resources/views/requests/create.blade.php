<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Permintaan Servis Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    {{-- PERBAIKAN PADA BARIS DI BAWAH INI --}}
                    <form method="POST" action="{{ route('user.requests.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="device_type" :value="__('Jenis Perangkat')" />
                            <x-text-input id="device_type" class="block mt-1 w-full" type="text" name="device_type" :value="old('device_type')" required autofocus placeholder="Contoh: Laptop, Smartphone, Televisi" />
                            <x-input-error :messages="$errors->get('device_type')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="brand" :value="__('Merek')" />
                            <x-text-input id="brand" class="block mt-1 w-full" type="text" name="brand" :value="old('brand')" placeholder="Contoh: Samsung, Dell, Apple (Opsional)" />
                            <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="model_number" :value="__('Nomor Model / Seri')" />
                            <x-text-input id="model_number" class="block mt-1 w-full" type="text" name="model_number" :value="old('model_number')" placeholder="Contoh: Galaxy S21, Inspiron 14, A2337 (Opsional)" />
                            <x-input-error :messages="$errors->get('model_number')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Jelaskan Keluhan atau Kerusakan Anda')" />
                            <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="5" required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Kirim Permintaan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>