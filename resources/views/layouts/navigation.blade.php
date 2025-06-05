<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <!-- Navigation untuk Admin -->
                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')">
                            {{ __('Admin Panel') }}
                        </x-nav-link>
                        <x-nav-link href="#">
                            {{ __('Manage Users') }}
                        </x-nav-link>
                        <x-nav-link href="#">
                            {{ __('Reports') }}
                        </x-nav-link>
                    @endif

                    <!-- Navigation untuk Teknisi -->
                    @if(Auth::user()->role === 'teknisi')
                        <x-nav-link :href="route('teknisi.dashboard')" :active="request()->routeIs('teknisi.*')">
                            {{ __('Teknisi Panel') }}
                        </x-nav-link>
                        <x-nav-link href="#">
                            {{ __('Work Orders') }}
                        </x-nav-link>
                        <x-nav-link href="#">
                            {{ __('Equipment') }}
                        </x-nav-link>
                    @endif

                    <!-- Navigation untuk User -->
                    @if(Auth::user()->role === 'user')
                        <x-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.*')">
                            {{ __('My Dashboard') }}
                        </x-nav-link>
                        <x-nav-link href="#">
                            {{ __('Submit Request') }}
                        </x-nav-link>
                        <x-nav-link href="#">
                            {{ __('My Requests') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Role Badge -->
                <div class="px-3 py-1 mr-3 text-xs font-semibold rounded-full 
                    @if(Auth::user()->role === 'admin') 
                        bg-red-100 text-red-800
                    @elseif(Auth::user()->role === 'teknisi') 
                        bg-blue-100 text-blue-800
                    @else 
                        bg-green-100 text-green-800
                    @endif">
                    {{ strtoupper(Auth::user()->role) }}
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Admin-only dropdown items -->
                        @if(Auth::user()->role === 'admin')
                            <x-dropdown-link href="#">
                                {{ __('System Settings') }}
                            </x-dropdown-link>
                            <x-dropdown-link href="#">
                                {{ __('User Management') }}
                            </x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <!-- Responsive Navigation untuk Admin -->
            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')">
                    {{ __('Admin Panel') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#">
                    {{ __('Manage Users') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#">
                    {{ __('Reports') }}
                </x-responsive-nav-link>
            @endif

            <!-- Responsive Navigation untuk Teknisi -->
            @if(Auth::user()->role === 'teknisi')
                <x-responsive-nav-link :href="route('teknisi.dashboard')" :active="request()->routeIs('teknisi.*')">
                    {{ __('Teknisi Panel') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#">
                    {{ __('Work Orders') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#">
                    {{ __('Equipment') }}
                </x-responsive-nav-link>
            @endif

            <!-- Responsive Navigation untuk User -->
            @if(Auth::user()->role === 'user')
                <x-responsive-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.*')">
                    {{ __('My Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#">
                    {{ __('Submit Request') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#">
                    {{ __('My Requests') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                <div class="text-xs text-gray-400 mt-1">Role: {{ strtoupper(Auth::user()->role) }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Admin-only responsive items -->
                @if(Auth::user()->role === 'admin')
                    <x-responsive-nav-link href="#">
                        {{ __('System Settings') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="#">
                        {{ __('User Management') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
