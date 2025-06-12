<x-guest-layout>
    <!-- Kiri: Logo dan Info -->
    <div class="md:w-1/2 bg-gradient-to-br from-indigo-500 to-purple-600 text-white p-10 flex flex-col justify-center items-center text-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 mb-6">
        <h2 class="text-2xl font-bold">Reset Password</h2>
        <p class="text-sm">Enter your new password below</p>
    </div>

    <!-- Kanan: Form Reset -->
    <div class="md:w-1/2 p-8 sm:p-10 flex flex-col justify-center">
        <h2 class="text-3xl font-bold text-indigo-600 mb-1">Reset Password</h2>
        <p class="text-sm text-gray-500 mb-6">Please enter your email and new password</p>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
            @csrf

            <!-- Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="w-full mt-1" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="w-full mt-1" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="w-full mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>

            <!-- Tombol -->
            <div>
                <x-primary-button class="w-full justify-center">
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
