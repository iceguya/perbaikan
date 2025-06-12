<x-guest-layout>
    <!-- Kiri: Logo dan Info -->
    <div class="md:w-1/2 bg-gradient-to-br from-indigo-500 to-purple-600 text-white p-10 flex flex-col justify-center items-center text-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 mb-6">
        <h2 class="text-2xl font-bold">Hirawr Store and Service</h2>
        <p class="text-sm">Welcome to our platform</p>
    </div>

    <!-- Kanan: Form Login -->
    <div class="md:w-1/2 p-8 sm:p-10 flex flex-col justify-center">
        <h2 class="text-3xl font-bold text-indigo-600 mb-1">Welcome Back</h2>
        <p class="text-sm text-gray-500 mb-6">Please sign in to your account</p>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="w-full mt-1" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="w-full mt-1" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Remember + Lupa -->
            <div class="flex items-center justify-between text-sm">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ml-2">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Tombol -->
            <div>
                <x-primary-button class="w-full justify-center">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

            <!-- Belum punya akun? -->
            <div class="mt-4 text-center text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-medium">
                    Register here
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>