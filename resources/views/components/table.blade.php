@props(['new', 'search', 'route', 'name'])

<div class="h-auto mt-10">
    <div class="container mx-auto max-w-full">
        <div class="grid grid-cols-1 mb-16">
            <div class="w-full bg-white  overflow-hdden shadow-lg">
                <div class="bg-white   -mt-10 mb-2   text-white grid items-center w-full h-14 py-4 px-8 ">
                    <div class="flex items-center">
                        <h2 class="text-white -mt-36 -ml-2  text-2xl font-extrabold">{{ $name }}</h2>
                        @if ($search)
                            <div
                                class="-ml-20 lg:max-w-sm sm:w-full flex items-center bg-gray-400 bg-opacity-20   px-3 rounded-full ">
                                <span class=" text-gray-600 text-xl  fas fa-search"></span><input placeholder="Buscar"
                                    wire:model="search"
                                    class="bg-transparent border-none text-sm leading-snug text-gray-600 w-full font-normal placeholder-gray-900 placeholder-opacity-50 focus:outline-none focus:ring-0">
                            </div>
                        @endif
                        @if ($new)
                            <a href="{{ $route }}"
                                class="flex ml-60 gap-1 font-bold outline-none uppercase tracking-wider focus:outline-none focus:shadow-none transition-all duration-300 rounded-full py-1 px-5 text-sm leading-normal text-white bg-light-blue-500 hover:bg-light-blue-700 focus:bg-light-blue-400 active:bg-light-blue-800 shadow-md-light-blue hover:shadow-lg-light-blue fas fa-plus">
                            </a>
                        @endif
                    </div>
                </div>
                <div>
                    <div class="overflow-x-auto">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
