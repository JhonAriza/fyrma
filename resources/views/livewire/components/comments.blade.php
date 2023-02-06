<div>
    <div class="w-full mx-auto text-gray-700 scroll-p-0  rounded ">
        <div class="head flex border p-3 bg-indigo-100 rounded-t">
            <div class="title px-2 font-semibold text-lg">Comentarios</div>
            <div class="count border p-1 px-2 font-semibold bg-blue-500 text-white rounded-full text-xs font-mono">
                {{ count($coments) }}</div>
            <div class="buttons ml-auto flex text-xs">
                <div class="btn p-1 px-2 border-2 cursor-pointer rounded-full font-bold hover:bg-blue-400"
                    wire:click="$emit('hide_comments')">X
                </div>
            </div>
        </div>
        <div class="  body border overflow-y-auto h-96">
            <div class="messages">
                @if (count($coments) > 0)
                    @foreach ($coments as $item)
                        @if ($item->owner != $owner_contract)
                            <div x-data="{ open: false }"
                                class="  msg p-2 border-red-500 flex text-sm shadow-sm text-gray-600 hover:bg-gray-100">
                                <div class=" name  font-medium mr-2 text-blue-600 ">
                                    {{ $item->user->name }}
                                    <br>
                                    <div x-show="open" class="time text-xs text-gray-600 font-thin flex-none ml-auto">
                                        {{ $item->created_at->diffForHumans(\Carbon\Carbon::now()) }}
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div x-on:click="open = !open"
                                    class="cursor-pointer border-2 border-red-200  pt-0.5 pb-0.5 pr-2 pl-2  rounded-lg  text-black my-auto m-2">
                                    {{ $item->message }}
                                </div>
                            </div>
                        @else
                            <div x-data="{ open: false }"
                                class="  msg p-2 border-blue-500 flex text-sm shadow-sm text-gray-600 hover:bg-gray-100">
                                <div class="name font-medium mr-2 text-green-600 ">
                                    {{ $item->user->name }}
                                    <br>
                                    <div x-show="open" class="time text-xs text-gray-600 font-thin flex-none ml-auto">
                                        {{ $item->created_at->diffForHumans(\Carbon\Carbon::now()) }}
                                    </div>

                                </div>
                                <br>
                                <br>
                                <div x-on:click="open = !open"
                                    class="cursor-pointer border-2 border-blue-200  pt-0.5 pb-0.5 pr-2 pl-2  rounded-lg  text-black my-auto m-2">
                                    {{ $item->message }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="msg px-4 py-4 border-blue-500 flex text-sm shadow-sm text-gray-600 hover:bg-gray-100">
                        <div class="text my-auto mr-2">Sin Comentarios</div>
                    </div>
                @endif
            </div>
        </div>

        <div class="p-3 flex text-sm border text-gray-400">
            <div class="relative w-full">
                <input type="text"
                    class="block p-4 w-full text-sm text-gray-900 bg-gray-50 pt-2 pb-2 pr-2 pl-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Escribe un mensaje..." required wire:keydown.enter="add_comment"
                    wire:model.defer="message">
                <button type="button"
                    class="absolute right-1.5 bottom-0.5 rounded-lg text-sm px-2 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 bg-gradient-to-tr from-light-blue-500 to-light-blue-700 text-white shadow-md         fas fa-plus"
                    wire:click="add_comment"></button>
            </div>
            <x-jet-input-error for="message"></x-jet-input-error>
        </div>
    </div>
</div>
