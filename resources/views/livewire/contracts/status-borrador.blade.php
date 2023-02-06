<div>
    <x-errors></x-errors>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-2">
            <div class="m-5 sm:px-0 shadow-sm">
                {{ $contract->document_name }}
                <p class=" text-sm text-left px-4 py-1">
                    Estado del Documento: {{ json_decode($contract->status)->status }}
                </p>
                <p class=" text-sm text-left px-4 py-1">
                    Mi Estado: {{ json_decode($contract->owner_status)->status }}
                </p>
                @livewire('shared.tags', ['contract_id' => $contract_id])
            </div>
            <div>

            </div>
            @livewire('components.show-html', ['contract_id' => $contract_id])
        </div>
        <div class="mt-5 md:mt-0 md:col-span-1 pr-5">
            @if ($show_comments)
            @livewire('components.comments' , ['owner_contract' => $contract->owner])
            @endif
            <div x-data="{ opened_option: null }" class="@if (!$show_comments) show @else hidden @endif">
                <div class="w-full bg-white p-3 text-center mx-auto border mb-3 rounded-md">
                    <div class="max-w-2xl mx-auto bg-white rounded">
                        <div>
                            <h2>
                                <button type="button" @click="opened_option = opened_option == 0 ? null : 0"
                                    class="flex items-center focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 justify-between p-5 w-full font-medium border border-gray-200 dark:border-gray-700 border-b-0 text-left text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                                    <span>Blindajes Documento</span>
                                </button>
                            </h2>
                            <div x-show="opened_option==0">
                                <div class="m-2 border-b-2">
                                    @foreach (App\Models\Shields::all() as $item)
                                        <div class="flex items-center mb-4">
                                            <input type="checkbox" wire:model="selectedShields" value="{{ $item->id }}"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $item->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @if (!json_decode($contract->owner_status)->signed)
                                    <div class="m-2">
                                        <div class="flex items-center mb-4">
                                            <input type="checkbox" wire:model="signtogenerate"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Firmar</label>
                                        </div>
                                        @if ($signtogenerate)
                                            <div class="m-2">
                                                <label
                                                    class="block text-sm font-medium text-gray-900 dark:text-gray-300 text-left">Titulo</label>
                                                <input type="text"
                                                    class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="miparticipacion">
                                                <div class="flex justify-center mt-2">
                                                    <button
                                                        class="flex items-center gap-4 text-sm px-3 py-2 rounded-lg bg-gradient-to-tr from-light-blue-500 to-light-blue-700 text-white shadow-md"
                                                        wire:click="$emit('validatesignature')"
                                                        wire:loading.attr="disabled">Firmar</button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <h2>
                                <div type="button" @click="opened_option = opened_option == 1 ? null : 1"
                                    class="flex items-center focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 justify-between p-5 w-full font-medium border border-gray-200 dark:border-gray-700 border-b-0 text-left text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                                    <span>Participantes {{ count($participantes) }}</span>
                            </div>
                            </h2>
                            <div x-show="opened_option==1">
                                <div class="py-2 border border-gray-200 dark:border-gray-700 border-b-0"
                                    x-data="{ opened_tab: null }">
                                    @foreach ($participantes as $key => $participante)
                                        <div class="m-2">
                                            <div class="flex justify-center rounded-lg text-sm text-left" role="group">
                                                <button
                                                    @click="opened_tab = opened_tab == {{ $key }} ? null : {{ $key }}"
                                                    class="flex items-center gap-4 text-sm font-light px-3 py-2 rounded-lg bg-gradient-to-tr from-light-blue-500 to-light-blue-700 text-white shadow-md">
                                                    {{ $participante['nombre'] == '' ? 'Participante ' . ($loop->index + 1) : $participante['nombre'] }}
                                                </button>

                                                @if (count($participantes) > 1)
                                                    <button
                                                        class="bg-red-600 text-white hover:bg-red-400 border border border-white-500 rounded-lg px-4 py-2 mx-0 fas fa-trash-alt"
                                                        wire:click="remover_participante({{ $loop->index }})"></button>
                                                @endif
                                            </div>
                                            <div x-show="opened_tab=={{ $key }}"
                                                class="mb-2 pb-2 w-full bg-white rounded-lg shadow-xl w-full">
                                                <div class="m-1">
                                                    <label
                                                        class="block text-sm font-medium text-gray-900 dark:text-gray-300 text-left">Nombre</label>
                                                    <input type="text"
                                                        class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        wire:model="participantes.{{ $loop->index }}.nombre">
                                                </div>
                                                <div class="m-1">
                                                    <label
                                                        class="block text-sm font-medium text-gray-900 dark:text-gray-300 text-left">Correo</label>
                                                    <input type="text"
                                                        class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        wire:model="participantes.{{ $loop->index }}.correo">
                                                </div>
                                                <div class="m-1">
                                                    <label
                                                        class="block text-sm font-medium text-gray-900 dark:text-gray-300 text-left">Rol</label>
                                                    <select id="small"
                                                        class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        wire:model.defer="participantes.{{ $loop->index }}.rol">
                                                        <option value="" selected>Seleccione</option>
                                                        @foreach ($rols as $rol)
                                                            <option value="{{ $rol->id }}">{{ $rol->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="m-1">
                                                    <label
                                                        class="block text-sm font-medium text-gray-900 dark:text-gray-300 text-left">Titulo</label>
                                                    <input type="text"
                                                        class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        wire:model="participantes.{{ $loop->index }}.titulo">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if (count($participantes) < 5)
                                        <div class="m-2">
                                            <div class="flex justify-center">
                                                <div @click="opened_tab = null"
                                                    class="cursor-pointer flex items-center gap-4 text-sm px-3 py-2 rounded-lg bg-gradient-to-tr from-light-blue-500 to-light-blue-700 text-white shadow-md fas fa-plus"
                                                    wire:click="nuevo_participante"></div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <h2>
                                <button type="button" @click="opened_option = opened_option == 2 ? null : 2"
                                    class="flex items-center focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 justify-between p-5 w-full font-medium border border-gray-200 dark:border-gray-700 border-b-0 text-left text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                                    <span>Anexos {{ count($attachmentBorrador) }}</span>
                                </button>
                            </h2>
                            <div x-show="opened_option==2">
    <div class="py-2 border border-gray-200 dark:border-gray-700 border-b-0"
        x-data="{ opened_tab: null }">
        @foreach ($attachmentBorrador as $key => $attachment)
            <div class="m-2">
                <div class="flex justify-center rounded-lg text-sm text-left" role="group">
                    <button
                    @click="opened_tab = opened_tab == {{ $key }} ? null : {{ $key }}"
                        class="flex items-center gap-4 text-sm font-light px-3 py-2 rounded-lg bg-gradient-to-tr from-light-blue-500 to-light-blue-700 text-white shadow-md">
                        {{ $attachment['attachmentdocument_name'] == '' ? 'Anexo ' . ($loop->index + 1) : $attachment['attachmentdocument_name'] }}     
                    </button>
                        <button
                            class="bg-red-600 text-white hover:bg-red-400 border border border-white-500 rounded-lg px-4 py-2 mx-0 fas fa-trash-alt"
                            wire:click="remover_anexo({{ $loop->index }})">
                        </button>
                  
                </div>
                <div x-show="opened_tab=={{ $key }}"
                    class="mb-2 pb-2 w-full bg-white rounded-lg shadow-xl w-full">
                    <div class="m-1">
                        <label
                            class="block text-sm font-medium text-gray-900 dark:text-gray-300 text-left">Nombre</label>
                        <input type="text"
                            class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            wire:model="attachmentBorrador.{{ $loop->index }}.attachmentdocument_name">
                    </div>

                    <div class="m-1">
                        <label
                            class="block text-sm font-medium text-gray-900 dark:text-gray-300 text-left">Rol</label>
                        <select id="small"
                            class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            wire:model="attachmentBorrador.{{ $loop->index }}.allowed_types_id">
                            <option value="" selected>Seleccione</option>
                            @foreach ($allowedTypes as $type)
                                <option value="{{ $type->id }}">
                                    {{ $type->value }}
                                </option>
                            @endforeach
                           
                        </select>
                    </div>
                    <div class="m-1">
                        <label
                            class="block text-sm font-medium text-gray-900 dark:text-gray-300 text-left">Comentario</label>
                        <textarea
                            class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            wire:model="attachmentBorrador.{{ $loop->index }}.comment"></textarea>
                    </div>
                                   </div>
            </div>
        @endforeach
        @if (count($attachmentBorrador) <= 5)
            <div class="m-2">
                <div class="flex justify-center">
                    <div @click="opened_tab = null"
                        class="cursor-pointer flex items-center gap-4 text-sm px-3 py-2 rounded-lg bg-gradient-to-tr from-light-blue-500 to-light-blue-700 text-white shadow-md fas fa-plus"
                        wire:click="nuevo_anexo"></div>
                </div>
            </div>
        @endif
    </div>
</div>

                            <h2>
                                <button type="button" @click="opened_option = opened_option == 3 ? null : 3"
                                    class="flex items-center focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 justify-between p-5 w-full font-medium border border-gray-200 dark:border-gray-700 border-b-0 text-left text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                                    <span>Firma Digital</span>
                                </button>
                            </h2>
                            <div x-show="opened_option==3">
                                <div class="m-2 border-b-2">
                                    @if (!Auth::user()->signature)
                                        <label class="block text-sm font-medium text-gray-700 text-center mt-2">Aun no
                                            posees
                                            una Firma Digital, genera una.</label>
                                        <div class="flex justify-center mb-2">
                                            <button
                                                class="flex items-center gap-4 text-sm px-3 py-2 rounded-lg bg-gradient-to-tr from-light-blue-500 to-light-blue-700 text-white shadow-md"
                                                wire:click="newsignature">Generar</button>
                                        </div>
                                    @else
                                        <div class="mx-5 my-3">
                                            <img src="{{ Auth::user()->signature->signature }}" alt="mysign"
                                                class="border-2" />
                                        </div>
                                        <div class="flex justify-center mb-2">
                                            <button
                                                class="flex items-center gap-4 text-sm px-3 py-2 rounded-lg bg-gradient-to-tr from-light-blue-500 to-light-blue-700 text-white shadow-md"
                                                wire:click="newsignature">Generar Nueva</button>
                                        </div>
                                    @endif
                                    @livewire('modal.new-signature')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-2 mt-3 flex justify-center">
                    <button
                        class="flex items-center gap-4 text-sm px-3 py-2 rounded-lg bg-gradient-to-tr from-light-blue-500 to-light-blue-700 text-white shadow-md"
                        wire:loading.attr="disabled"
                        wire:click="notificateContract">Notificar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/decoupled-document/ckeditor.js"></script>
    <script>
        Livewire.on('save_success', function(message) {
            Swal.fire(
                'Good job!',
                message,
                'success'
            )
        });

        Livewire.on('validatesignature', function() {
            Livewire.emit('validate');
        })

        Livewire.on('generatesignature', function() {
            var table = document.getElementById("tablesignatures");
            var inserted = false;
            var htmlVar = '<img src="[firma]" style="width: 45mm;margin-left: auto;margin-right: auto;"/>&nbsp;[nombre]&nbsp;[titulo]';
            for (var i = 0; i < table.rows.length; i++) {
                if(!table.rows[i].cells[0].innerHTML) {
                    table.rows[i].cells[0].innerHTML = htmlVar;
                    inserted = true;
                    break;
                } else if(!table.rows[i].cells[1].innerHTML) {
                    table.rows[i].cells[1].innerHTML = htmlVar;
                    inserted = true;
                    break;
                }
            }
            if(!inserted) {
                var row = table.insertRow();
                var cell = row.insertCell();
                var cell2 = row.insertCell();
                cell.innerHTML = htmlVar;
            }
            @this.set('signaturestable', document.getElementById("htmlsignatures").innerHTML.trim());
            Livewire.emit('signtogenerate');
        })
    </script>
@endpush
