<div>

    <x-jet-button class="fa fa-search bg-blue-500" wire:click="$set('open', true)"></x-jet-button>

    <x-jet-button type="button" class="fa fa-pencil-alt bg-blue-500">
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">Plantilla N</x-slot>

        <x-slot name="content">
            <div class="mb-4"></div>
        </x-slot>

        <x-slot name="footer">Hola</x-slot>
    </x-jet-dialog-modal>

</div>
