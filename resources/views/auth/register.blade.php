<x-guest-layout>
    <!-- Kiri: Logo dan Info -->
    <div class="md:w-1/2 bg-gradient-to-br from-indigo-500 to-purple-600 text-white p-10 flex flex-col justify-center items-center text-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 mb-6">
        <h2 class="text-2xl font-bold">Create Account</h2>
        <p class="text-sm">Join our platform and enjoy the benefits.</p>
    </div>

    <!-- Kanan: Form Register -->
    <div class="md:w-1/2 p-8 sm:p-10 flex flex-col justify-center">
        <h2 class="text-3xl font-bold text-indigo-600 mb-1">Register</h2>
        <p class="text-sm text-gray-500 mb-6">Please fill in your details to create an account</p>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="w-full mt-1" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="w-full mt-1" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="w-full mt-1" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="w-full mt-1" type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>

            <!-- Tombol -->
            <div>
                <x-primary-button class="w-full justify-center">
                    {{ __('Register') }}
                </x-primary-button>
            </div>

            <!-- Sudah punya akun? -->
            <div class="mt-4 text-center text-sm text-gray-600">
                Already registered?
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-medium">
                    Log in here
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
