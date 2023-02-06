<div>
    @livewire('modal.show-tracking')
    <x-table :search="true" name="Recibidos" :new="false">
        @if ($recibidos->count())
            <table class="items-center w-full bg-transparent border-collapse">
                <thead>
                    <tr>
                        <th class="px-2 text-white bg-morado-claro border-b border-solid border-gray-200 py-3 text-sm whitespace-nowrap font-light text-center">#</th>
                        <th class="px-2 text-white bg-morado-fyrmalo border-b border-solid border-gray-200 py-3 text-sm whitespace-nowrap font-light text-center">Fecha Creado</th>
                        <th class="px-2 text-white bg-morado-claro border-b border-solid border-gray-200 py-3 text-sm whitespace-nowrap font-light text-center">Remitente</th>
                        <th class="px-2 text-white bg-morado-fyrmalo border-b border-solid border-gray-200 py-3 text-sm whitespace-nowrap font-light text-center">Asunto del Documento</th>
                        <th class="px-2 text-white bg-morado-claro border-b border-solid border-gray-200 py-3 text-sm whitespace-nowrap font-light text-center">Estatus</th>
                        <th class="px-2 text-white bg-morado-fyrmalo border-b border-solid border-gray-200 py-3 text-sm whitespace-nowrap font-light text-center">Edit</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($recibidos as $receive)
                        <tr>
                            <td class="border-b border-gray-200 align-middle font-light text-sm whitespace-nowrap px-2 py-4 text-center">
                                <div class="text-sm text-gray-500">
                                    {{ $loop->index + 1  }}
                                </div>
                            </td>
                            <td class="border-b border-gray-200  text-gris-fyrmalo align-middle font-light text-sm-fyrmalo whitespace-nowrap px-2 py-4 text-center">
                                {{ \Carbon\Carbon::parse($receive->created_at)->format('d/m/Y') }}
                                
                            </td>

                            <td class="border-b border-gray-200 align-middle font-light text-sm whitespace-nowrap px-2 py-4 text-center">
                                <span
                                    class="block px-2 inline-flex text-xs-fyrmalo leading-5 font-semibold rounded-full text-gris-fyrmalo">
                                    {{ $receive->sender->email }}
                                </span>
                                <span
                                    class="block px-2 inline-flex text-xs leading-5 font-semibold rounded-full  text-gris-fyrmalo">
                                    {{ $receive->sender->name }}
                                </span>
                            </td>
                            <td class="border-b border-gray-200 align-middle font-light text-sm whitespace-nowrap px-2 py-4 text-center">
                                {{ $receive->document_name }}
                            </td>
                            <td class="border-b border-gray-200 align-middle font-light text-sm whitespace-nowrap px-2 py-4 text-center">
                                @foreach (json_decode($receive->participants) as $participant)
                                    @if ($participant->correo === Auth::user()->email)
                                    <label class="block text-sm font-medium text-center">
                                        {{ $participant->status }}</label>
                                    @endif
                                @endforeach
                            </td>
                           
                            <td class="border-b border-gray-200 align-middle font-light text-sm whitespace-nowrap px-2 py-4 text-center">
                            <x-tooltip  wire:click="show('{{ $receive->id }}')" wire:loading.attr="disabled"
                                wire:target="show" icon="fa fa-search bg-blue-500"  >
                                Revisar
                            </x-tooltip>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="px-6 py-4">
                No existen registros
            </div>
        @endif

        @if ($recibidos->hasPages())
            <div class="px-6 py-4">
                {{ $recibidos->links() }}
            </div>
        @endif
    </x-table>

</div>
