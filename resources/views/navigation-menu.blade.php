@php
$nav_links = [
    [
        'name' => 'Dashboard',
        'route' => route('dashboard'),
        'active' => request()->is('dashboard'),
        'icon' => 'dashboard',
    ],
    [
        'name' => 'Recibidos',
        'route' => route('received.index'),
        'active' => request()->routeIs('received.*'),
        'icon' => 'recibidos',
    ],
    [
        'name' => 'Documentos',
        'route' => route('contracts.index'),
        'active' => request()->routeIs('contracts.*'),
        'icon' => 'documentos',
    ],
    [
        'name' => 'Plantillas',
        'route' => route('templates.index'),
        'active' => request()->routeIs('templates.*'),
        'icon' => 'plantillas',
    ],
];
@endphp

<div>
<div x-data="{ open: false }">
    <nav class="bg-morado-fyrmalo md:w-4/5 main-container">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-4 md:px-6 py-2.5">
            <span class="hidden md:block" id="titulo-dashboard">
            </span>
            <div class="md:hidden"><button @click="open = true"
                    class="flex items-center justify-center gap-1 font-bold outline-none uppercase tracking-wider focus:outline-none focus:shadow-none transition-all duration-300 rounded-full w-12 h-12 p-0 grid place-items-center text-sm leading-relaxed bg-transparent"
                    style="position: relative; overflow: hidden;">
                    <span class="text-white text-2xl leading-none fas fa-bars"></span></button>

                <div :class="{ '-left-72': !open, 'left-72': open }"
                    class="absolute top-2 md:hidden z-50 transition-all duration-300"><button @click="open = false"
                        class="false flex items-center justify-center gap-1 font-bold outline-none uppercase tracking-wider focus:outline-none focus:shadow-none transition-all duration-300 rounded-full w-12 h-12 p-0 grid place-items-center text-sm leading-relaxed bg-transparent"
                        style="position: relative; overflow: hidden;"><span
                            class="fas fa-times-circle text-white text-2xl leading-none"></span></button></div>
            </div>
            <div class="flex flex-wrap">
                    <a href="{{ route('profile.show') }}" active="{{ request()->routeIs('profile.*') }}">
                        <img class="w-56 mr-5" src="{{ URL::asset('/img/profile.svg') }} ">
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                    this.closest('form').submit();">
                            <img class="w-15" src="{{ URL::asset('/img/logout.svg') }} ">
                        </a>
                    </form>
            </div>
        </div>
    </nav>
    <div :class="{ '-left-72': !open, 'left-0': open }" class="flex flex-col bg-morado-fyrmalo md:w-1/5 h-screen fixed top-0 md:left-0 z-10 transition-all duration-300">
        <div class="flex-col items-stretch flex-nowrap px-0 relative">
            <div class="flex bg-white justify-center h-56">
                <img class="w-72 px-5 md:w-2/3" src="{{ URL::asset('/img/logo.svg') }} ">
            </div>

            <div class="flex flex-col">
                <hr class="min-w-full">
                <ul class="flex-col min-w-full flex list-none mt-1">

                    <li class="mb-2 w-full justify-center flex group hover:bg-white">
                        @livewire('auth.access-new-document')
                    </li>
                    @foreach ($nav_links as $nav_link)
                        <li class="group mb-2 w-full justify-center flex hover:bg-white">
                            <x-jet-nav-link href="{{ $nav_link['route'] }}" :active="$nav_link['active']" :icon="$nav_link['icon']">
                                {{ $nav_link['name'] }}
                            </x-jet-nav-link>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <a class="flex-col flex mt-10   rounded-full text-black w-auto bg-white h-20 justify-center items-center max-w-sm hadow-lg shadow-indigo-500/40" href="#">
            <div class="flex px-2 justify-center gap-3 text-md items-center max-w-sm text-2xl text-fyrmalo font-bold leading-6">
                Conoce nuestro <br> tutorial de uso
                <img class="w-11 h-12 " src="{{ URL::asset('/img/play.gif') }} ">
            </div>
        </a>
    </div>
</div></div>
