{{-- File: resources/views/user/requests/create.blade.php --}}

<x-app-layout>

    <div class="py-12">
        {{-- DIUBAH: max-w-4xl menjadi max-w-7xl agar sama dengan halaman lain --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Mengembalikan warna background form ke putih agar sesuai dengan tema Breeze --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-1">Formulir Keluhan</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                        Silakan isi detail mengenai kerusakan pada perangkat elektronik Anda.
                    </p>

                    <form method="POST" action="{{ route('user.requests.store') }}" class="space-y-6">
                        @csrf
                        
                        {{-- Jenis Alat --}}
                        <div>
                            <x-input-label for="device_type" :value="__('Jenis Alat Elektronik')" />
                            <select id="device_type" name="device_type" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="" disabled selected>-- Pilih Jenis Alat --</option>
                                <option value="Smartphone" @selected(old('device_type') == 'Smartphone')>Smartphone</option>
                                <option value="Laptop" @selected(old('device_type') == 'Laptop')>Laptop</option>
                                <option value="PC / Komputer" @selected(old('device_type') == 'PC / Komputer')>PC / Komputer</option>
                                <option value="Televisi" @selected(old('device_type') == 'Televisi')>Televisi</option>
                                <option value="Kulkas" @selected(old('device_type') == 'Kulkas')>Kulkas</option>
                                <option value="Mesin Cuci" @selected(old('device_type') == 'Mesin Cuci')>Mesin Cuci</option>
                                <option value="Lainnya" @selected(old('device_type') == 'Lainnya')>Lainnya</option>
                            </select>
                            <x-input-error :messages="$errors->get('device_type')" class="mt-2" />
                        </div>

                        {{-- Merk Alat --}}
                        <div>
                            <x-input-label for="brand" :value="__('Merk Alat (Contoh: Samsung, HP, Polytron)')" />
                            <x-text-input id="brand" class="block mt-1 w-full" type="text" name="brand" :value="old('brand')" required />
                            <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                        </div>
                        
                        {{-- Seri / Model --}}
                        <div>
                            <x-input-label for="series" :value="__('Seri / Model (Contoh: Galaxy S21, Pavilion 14). Boleh dikosongi.')" />
                            <x-text-input id="series" class="block mt-1 w-full" type="text" name="series" :value="old('series')" />
                            <x-input-error :messages="$errors->get('series')" class="mt-2" />
                        </div>

                        {{-- Deskripsi Keluhan --}}
                        <div>
                            <x-input-label for="complaint" :value="__('Jelaskan Keluhan atau Kerusakan Anda (Minimal 20 karakter)')" />
                            <textarea id="complaint" name="complaint" rows="5" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('complaint') }}</textarea>
                            <x-input-error :messages="$errors->get('complaint')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
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