<div>
    <x-jet-dialog-modal wire:model="open" wire:loading>
        <x-slot name="title">Tracking Contrato</x-slot>

        <x-slot name="content">
            <div class="mb-4 overflow-y-auto max-h-80">
                @if ($show)
                    <div class="w-full">
                        <div class="bg-white shadow-lg rounded-lg w-full">
                            <div class="py-3 text-sm">
                                @foreach ($trackings as $track)
                                    <a
                                        class="flex justify-start cursor-pointer text-gray-700 hover:text-blue-400 hover:bg-blue-100 rounded-md px-2 py-2 my-2">
                                        <span class="bg-green-400 h-2 w-2 m-2 rounded-full"></span>
                                        <div class="flex-grow font-medium px-2">{{ $track->owner }} {{ $track->type }} {{ $track->value }}</div>
                                        <div class="text-sm font-normal text-gray-500 tracking-wide text-right">{{ \Carbon\Carbon::parse($track->created_at)->format('d/m/Y H:i:s') }}</div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="w-full">
                        <div class="bg-white shadow-md rounded-lg w-full">
                            <div class="py-3 text-sm">
                                <div
                                    class="flex justify-start cursor-pointer text-gray-700 hover:text-blue-400 hover:bg-blue-100 rounded-md px-2 py-2 my-2">
                                    <span class="bg-gray-400 h-2 w-2 m-2 rounded-full"></span>
                                    <div class="flex-grow font-medium px-2">Sin Datos que Mostrar</div>
                                    <div class="text-sm font-normal text-gray-500 tracking-wide">
                                        {{ \Carbon\Carbon::now()->format('d/m/Y') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button type="button" class="bg-blue-500 flex-right" wire:click="$set('open',false)">
                Cerrar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
