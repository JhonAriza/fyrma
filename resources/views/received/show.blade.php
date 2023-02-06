<x-app-layout>
    <x-slot name="header">
        Contrato
    </x-slot>

    <div class="md:ml-64">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('received.show-document', [ 'contract_id' => $contract_id, 'ip' => $ip ])
            </div>
        </div>
    </div>
</x-app-layout>
