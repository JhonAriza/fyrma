<div>
    <button class="flex gap-2 font-light group-hover:text-indigo-500 text-white px-4 py-3 items-center"
        wire:click="$set('show', true)">
        <svg width="49" height="49" viewBox="0 0 49 49" xmlns="http://www.w3.org/2000/svg">
            <path d="M2.933 29.3289H21.163V48.8589C21.1559 49.2423 21.2252 49.6234 21.367 49.9797C21.5088 50.3361 21.7202 50.6605 21.9889 50.9342C22.2575 51.2079 22.578 51.4253 22.9317 51.5737C23.2853 51.7221 23.665 51.7986 24.0485 51.7986C24.432 51.7986 24.8117 51.7221 25.1653 51.5737C25.519 51.4253 25.8395 51.2079 26.1081 50.9342C26.3768 50.6605 26.5882 50.3361 26.73 49.9797C26.8718 49.6234 26.9411 49.2423 26.934 48.8589V29.3289H45.162C45.9399 29.3289 46.6859 29.0199 47.2359 28.4698C47.786 27.9198 48.095 27.1738 48.095 26.3959C48.095 25.618 47.786 24.8719 47.2359 24.3219C46.6859 23.7719 45.9399 23.4629 45.162 23.4629H26.933V3.93286C26.9401 3.54941 26.8708 3.16835 26.729 2.81201C26.5872 2.45567 26.3758 2.13124 26.1071 1.85754C25.8385 1.58385 25.518 1.36643 25.1643 1.21802C24.8107 1.06961 24.431 0.993164 24.0475 0.993164C23.664 0.993164 23.2843 1.06961 22.9307 1.21802C22.577 1.36643 22.2565 1.58385 21.9879 1.85754C21.7192 2.13124 21.5078 2.45567 21.366 2.81201C21.2242 3.16835 21.1549 3.54941 21.162 3.93286V23.4629H2.933C2.15512 23.4629 1.4091 23.7719 0.859055 24.3219C0.30901 24.8719 0 25.618 0 26.3959C0 27.1738 0.30901 27.9198 0.859055 28.4698C1.4091 29.0199 2.15512 29.3289 2.933 29.3289V29.3289Z"/>
        </svg>            
        <span class=" text-2xl leading-none"></span>Nuevo
    </button>
    <x-jet-dialog-modal wire:model="show" wire:loading maxWidth="md">
        <x-slot name="title">Nuevo +</x-slot>
        <x-slot name="content">
            <div class="mb-4 overflow-y-auto max-h-80">
                <div class="w-full">
                    <div class="bg-white shadow-lg rounded-lg w-full">
                        <div class="text-sm">
                            <a href="{{ route('contracts.create', 'blank') }}"
                                class="flex justify-start cursor-pointer text-gray-700 hover:text-blue-400 hover:bg-bluerounded-md p-2">
                                <span class="bg-green-400 h-2 w-2 m-2 rounded-full"></span>
                                <div class="flex-grow font-medium px-2">Nuevo documento en blanco</div>
                            </a>                            
                            <div class="relative w-2/3 px-2 my-2">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-4 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" wire:model='search'>
                            </div>
                            @if(count($urls) > 0)
                                @foreach ($urls as $url)
                                    <a href="{{ $url['route'] }}"
                                        class="flex justify-start cursor-pointer text-gray-700 hover:text-blue-400 hover:bg-bluerounded-md p-2">
                                        <span class="bg-green-400 h-2 w-2 m-2 rounded-full"></span>
                                        <div class="flex-grow font-medium px-2">{{ $url['name'] }}</div>
                                    </a>
                                @endforeach
                            @else
                                <div class="flex-grow font-medium p-2">No se encontraron resultados</div>
                                <a href="{{ route('templates.create') }}"
                                    class="flex justify-start cursor-pointer text-gray-700 hover:text-blue-400 hover:bg-bluerounded-md p-2">
                                    <span class="bg-green-400 h-2 w-2 m-2 rounded-full"></span>
                                    <div class="flex-grow font-medium px-2">Crear Plantilla Nueva</div>
                                </a>                                
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button type="button" class="flex items-center gap-4 text-sm px-3 py-2 rounded-lg bg-gradient-to-tr from-light-blue-500 to-light-blue-700 text-white shadow-md" wire:click="$set('show', false)">
                Cerrar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
