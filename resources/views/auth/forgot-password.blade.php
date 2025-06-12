<x-guest-layout>
    <!-- Kiri: Logo dan Info -->
    <div class="md:w-1/2 bg-gradient-to-br from-indigo-500 to-purple-600 text-white p-10 flex flex-col justify-center items-center text-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 mb-6">
        <h2 class="text-2xl font-bold">Forgot Password</h2>
        <p class="text-sm">Don't worry, we’ll help you reset it</p>
    </div>

    <!-- Kanan: Form Forgot -->
    <div class="md:w-1/2 p-8 sm:p-10 flex flex-col justify-center">
        <h2 class="text-3xl font-bold text-indigo-600 mb-1">Forgot your password?</h2>
        <p class="text-sm text-gray-500 mb-6">
            No problem. Just enter your email address below and we will send you a link to reset your password.
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="w-full mt-1" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Tombol -->
            <div>
                <x-primary-button class="w-full justify-center">
                    {{ __('Send Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
