<div>
    <x-table :search="true" name="Plantillas" :new="true" :route="route('templates.create')">
        @if ($templates->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="bg-morado-fyrmalo px-2 text-white align-middle border-b border-solid border-gray-200 py-3 text-sm whitespace-nowrap font-light text-center">Fecha de Creacion</th>
                        <th class=" bg-morado-claro px-2 text-white align-middle border-b border-solid border-gray-200 py-3 text-sm whitespace-nowrap font-light text-center">Nombres</th>
                        <th class="bg-morado-fyrmalo px-2 text-white align-middle border-b border-solid border-gray-200 py-3 text-sm whitespace-nowrap font-light text-center">Variables detalles</th>
                        <th class=" bg-morado-claro px-2 text-white align-middle border-b border-solid border-gray-200 py-3 text-sm whitespace-nowrap font-light text-center">Edicion</th>
                        <th class="bg-morado-fyrmalo px-2 text-white align-middle border-b border-solid border-gray-200 py-3 text-sm whitespace-nowrap font-light text-center">crear documento</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 ">
                    @foreach ($templates as $template)

                        <tr>
                            <td class="border-b border-gray-200 align-middle font-light text-sm whitespace-nowrap px-2 py-4 text-center">
                                <div class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($template->created_at)->format('d/m/Y') }}
                                </div>
                            </td>
                            <td class="border-b border-gray-200 align-middle font-light text-sm whitespace-nowrap px-2 py-4 text-center">
                                <span
                                    class="px-2 inline-flex text-sm-fyrmalo leading-5  rounded-full  text-gris-fyrmalo">
                                    {{ $template->name }}
                                </span>
                            </td>
                            <td class="border-b h-12  text-ellipsis text-azul-claro  px-2 py-4 text-center">
                                <div class="ml-10 w-60 h-12 truncate">    
                                {{ Str::remove('"', Str::remove('[', Str::remove(']', $template->vars))) }}
                                </div>
                            </td>
                            <td class="border-b border-gray-200 align-middle font-light text-sm whitespace-nowrap px-2 py-4 text-center">                                 
                                <div>
                                    <x-tooltip url="templates.edit" param="{{$template->id}}" icon="fa fa-edit">
                                        Editar plantilla
                                    </x-tooltip>
                                </div>
                            </td>
                            <td class="border-b border-gray-200 align-middle font-light text-sm whitespace-nowrap px-2 py-4 text-center">                                 
                                <div>
                                    <x-tooltip url="contracts.create" param="{{$template->id}}" icon="fas fa-sticky-note">
                                        Generar contrato
                                    </x-tooltip>
                                </div>
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

        @if ($templates->hasPages())
            <div class="px-6 py-4">
                {{ $templates->links() }}
            </div>
        @endif
    </x-table>

</div>
