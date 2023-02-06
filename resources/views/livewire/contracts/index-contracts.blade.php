<div>
    @livewire('modal.show-tracking')
    <x-table :search="true" name="Documentos" :new="false">
        @if ($contracts->count())
        @else
        <div class="px-4 py-4">
            No existen registros 
        </div>
    @endif

    @if ($contracts->hasPages())
        <div class="px-6 py-4">
            {{ $contracts->links() }}
        </div>
    @endif

            <table class="items-center w-full bg-transparent border-collapse">
                <thead class="bg-indigo-200">
                    <tr>
                       
                        <th
                            class="bg-morado-fyrmalo px-2 text-white align-middle border-b border-solid border-gray-200 py-3 text-sm whitespace-nowrap font-light text-center">
                            Fecha Creado</th>
                        <th
                            class=" bg-morado-claro px-2 text-white align-middle border-b border-solid border-gray-200 py-3 text-sm whitespace-nowrap font-light text-center">
                            Nombre Documento</th>
                        <th
                            class="bg-morado-fyrmalo px-2 text-white align-middle border-b border-solid border-gray-200 py-3 text-sm whitespace-nowrap font-light text-center">
                            Estado</th>
                        <th
                            class="bg-morado-claro px-2 text-white align-middle border-b border-solid border-gray-200 py-3 text-sm whitespace-nowrap font-light text-center">
                            Participantes</th>
                        <th
                            class="bg-morado-fyrmalo px-2 text-white align-middle border-b border-solid border-gray-200 py-3 text-sm whitespace-nowrap font-light text-center">
                            Edicion</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($contracts as $contract)
                        <tr>
                           
                            <td
                                class="border-b border-gray-200 align-middle font-light text-gris-fyrmalo text-sm-fyrmalo whitespace-nowrap px-2 py-4 text-center">
                                {{ \Carbon\Carbon::parse($contract->created_at)->format('d/m/Y') }}
                            </td>
                            <td
                                class="border-b  border-gray-200 align-middle font-light text-gris-fyrmalo text-sm-fyrmalo whitespace-nowrap px-2 py-4 text-center">
                                <div class="ml-10 w-60 h-12 truncate">      {{ $contract->document_name }}</div>
                           
                            </td>
                            <td
                                class="border-b border-gray-200 align-middle font-light text-gris-fyrmalo text-sm-fyrmalo whitespace-nowrap px-2 py-4 text-center">
                                {{ json_decode($contract->status)->status }}
                            </td>
                            <td
                                class="border-b border-gray-200 align-middle font-light text-sm-fyrmalo whitespace-nowrap px-2 py-4 text-center">
                                <div class='has-tooltip bg-azul-claro text-white inline-flex px-4 py-2 rounded-full'>
                                    <span
                                        class='tooltip rounded w-auto shadow-lg p-1 bg-gray-800 text-white -mt-10 ml-5 py-5 px-10 '>
                                        @foreach (json_decode($contract->participants) as $participant)
                                            <label
                                                class="block text-sm font-medium text-white text-left ">{{ $participant->correo }}</label>
                                            <label class="block text-sm font-medium text-white text-center">Estado:
                                                {{ $participant->status }}</label>
                                        @endforeach
                                    </span>
                                    {{ count(json_decode($contract->participants)) }}
                                </div>
                            </td>
                            <td
                                class="border-b border-gray-200 align-middle font-light whitespace-nowrap px-2 py-4 text-center">
                                {{-- <x-tooltip icon="fa fa-tasks  rounded-full bg-gradient-to-tr from-light-blue-500 px-4
                                 to-light-blue-700 text-white shadow-md hover:bg-light-blue-700 hover:shadow-lg-light-blue 
                                 text-sm"
                                    wire:click="tracking({{ $contract->id }})" wire:loading.attr="disabled"
                                    wire:target="tracking">
                                    Tracking
                                </x-tooltip> --}}
                               
                                <x-tooltip url="contracts.status" param="{{ $contract->id }}" icon="fa fa-file-alt">
                                    Estatus
                                </x-tooltip>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
      
    </x-table>

</div>

{{-- @push('css')
    <style>
        .tooltip {
            visibility: hidden;
            position: fixed;
        }

        .has-tooltip:hover .tooltip {
            visibility: visible;
            z-index: 100;
        }

    </style>
@endpush --}}

 