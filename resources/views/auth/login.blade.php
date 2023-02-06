@php
$nav_links = [
    [
        'name' => 'Login',
        'route' => route('login'),
        'active' => request()->is('login'),
        'icon' => 'fab fa-dashcube',
    ],
    [
        'name' => 'Registro',
        'route' => route('register'),
        'active' => request()->routeIs('register'),
        'icon' => 'fas fa-archive',
    ],
];
@endphp

<x-guest-layout>
    <div class="root">
        <nav class="flex flex-wrap items-center justify-between p-5 pb-0">
            <div class="container max-w-7xl px-4 mx-auto flex flex-wrap items-center justify-between">
                <div class="lg:flex flex-grow items-center">
                    <ul class="flex flex-row list-none ml-auto">
                        <div class="flex z-50 flex-row">
                            @foreach ($nav_links as $nav_link)
                                <li class="rounded-lg mb-4">
                                    <x-jet-nav-link href="{{ $nav_link['route'] }}" :active="$nav_link['active']"
                                        :icon="$nav_link['icon']">
                                        {{ $nav_link['name'] }}
                                    </x-jet-nav-link>
                                </li>
                            @endforeach
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
        <x-jet-authentication-card>
            <x-slot name="logo">

            </x-slot>

            <x-jet-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <div class="w-full bg-white rounded-xl overflow-hdden shadow-md p-4 border-2">
                <div
                    class="bg-gradient-to-tr from-light-blue-500 to-light-blue-700 -mt-10 mb-4 rounded-xl text-white grid items-center w-full h-24 py-4 px-8 justify-center shadow-lg-light-blue">
                    <h1 class="text-white text-2xl font-serif font-bold leading-normal mt-0 mb-2"
                        style="margin-bottom: 0px;">Login</h1>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="p-4">
                        <div class="mb-12 px-4 bg-bb">
                            <div class="w-full relative h-11">
                                <span type="email"
                                    class="material-icons p-0 text-gray-600 text-opacity-60 border-none absolute top-1/2 right-0 transform -translate-y-1/2 text-2xl far fa-envelope"></span>
                                <input id="email" name="email" :value="old('email')" type="email"
                                    class="w-full h-full text-gray-800 leading-normal shadow-none outline-none focus:outline-none focus:ring-0 focus:text-gray-800 pl-0 pr-7 mt-input-light-blue-500 mt-input bg-transparent border border-none">
                                <label
                                    class="text-gray-500 absolute left-0 -top-0.5 w-full h-full border-gray-300 pointer-events-none border border-t-0 border-l-0 border-r-0 border-b-1">
                                    <span class="absolute -top-4 transition-all duration-300">Email</span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-12 px-4 bg-bb">
                            <div class="w-full relative h-11">
                                <span type="email"
                                    class="material-icons p-0 text-gray-600 text-opacity-60 border-none absolute top-1/2 right-0 transform -translate-y-1/2 text-2xl fas fa-lock"></span>
                                <input id="password" type="password" name="password" required
                                    class="w-full h-full text-gray-800 leading-normal shadow-none outline-none focus:outline-none focus:ring-0 focus:text-gray-800 pl-0 pr-7 mt-input-light-blue-500 mt-input bg-transparent border border-none"
                                    autocomplete="current-password">
                                <label
                                    class="text-gray-500 absolute left-0 -top-0.5 w-full h-full border-gray-300 pointer-events-none border border-t-0 border-l-0 border-r-0 border-b-1">
                                    <span class="absolute -top-4 transition-all duration-300">Password</span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-4 px-4">
                            <div class="flex items-center">
                                <label for="remember_me" class="flex items-center cursor-pointer text-gray-400 select-none transition-all duration-300">
                                    <x-jet-checkbox id="remember_me" name="remember"/>
                                    <span class="flex items-center cursor-pointer text-gray-400 select-none transition-all duration-300">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4"><div class="flex justify-center bg-bb">
                        <button class="flex items-center justify-center gap-1 font-bold outline-none uppercase tracking-wider focus:outline-none focus:shadow-none transition-all border-2 duration-300 rounded-lg py-3 px-7 text-sm leading-relaxed bg-transparent text-light-blue-500 hover:bg-light-blue-50 hover:text-light-blue-700 hover:bg-light-blue-50 active:bg-light-blue-100" style="position: relative; overflow: hidden;">Login</button></div></div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </x-jet-authentication-card>
    </div>
</x-guest-layout>
