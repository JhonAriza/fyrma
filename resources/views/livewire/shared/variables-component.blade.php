<div>
    @if($show)
        <div class="relative">
            <label for="floating_text" class="text-sm text-gray-500">Agregar Variables</label>
            <input type="text" class="block py-2.5 pr-20 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" wire:model.defer="new_var" wire:keydown.enter="add">
            <a class="text-white absolute right-2.5 bottom-2 items-center gap-4 px-4 py-3 rounded-lg bg-gradient-to-tr from-light-blue-500 to-light-blue-700 shadow-md fas fa-plus hover:bg-light-blue-700 hover:shadow-lg-light-blue cursor-pointer" wire:click="add"
        ></a>
        </div>
        @if ($errors->any())
            <div class="p-4 my-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
    @endif
    <div class="bg-white max-h-72 overflow-auto mt-4 ">
        <p class="mt-2 text-sm text-gray-500">
            Arrastre las variables al editor
        </p>
        <ul class="flex flex-wrap p-4 contacts " >
            @foreach ($list as $key => $item)
            <li class="w-full flex-shrink my-2 flex ">
                <a class="p-name block rounded-md bg-gray-200 flex justify-center items-center {{ ($show) ? 'w-4/5' : 'w-full' }} " href="#"> {{ $item }}</a>
                @if($show )
                    <button class="w-1/5 ml-1 rounded-md fas fa-times items-center gap-4 text-sm px-1 py-1 bg-gradient-to-tr bg-red-500 text-white shadow-md hover:shadow-lg-light-blue disabled:opacity-50"  
                    wire:loading.attr="disabled" wire:click="remove('{{ $key }}')"
                    ></a>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>