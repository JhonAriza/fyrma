<x-app-layout>
    <x-slot name="header">
        Editar Plantilla
    </x-slot>

    <div class="md:ml-64">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('templates.edit-templates', [ 'id' => $id ])
            </div>
        </div>
    </div>
</x-app-layout>
