<div>
    <x-errors></x-errors>
    <div class="md:grid md:grid-cols-3 md:gap-6" x-data="{ edit: true }">

        <div class="md:col-span-2 ">
            <div class="m-5 sm:px-0 shadow-sm grid grid-cols-8">

                <div class="sm:col-span-4 col-span-3 relative">
                    <label for="floating_text" class="text-sm text-gray-500 absolute bottom-8">Nombre Documento</label>
                    <input type="text" name="floating_text"
                        class="block py-2.5 px-2 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600"
                        wire:model.defer="name_Document_blank" />
                </div>

                <span class="col-span-3"></span>
                <a @click="edit = ! edit"
                    class="text-white text-center gap-4 px-3 ml-3 py-3 rounded-lg bg-gradient-to-tr from-light-blue-500 to-light-blue-700 shadow-md hover:bg-light-blue-700 hover:shadow-lg-light-blue cursor-pointer text-sm sm:col-span-1 col-span-2">Editar</a>
            </div>
            <div class="m-5 overscroll-auto bg-gray-100 bg-opacity-70 p-5 h-96 rounded-md overflow-y-auto h-96"
                x-show="!edit">
                <p class=" text-sm text-gray-600">
                    {!! Str::replace('[', '<a class="bg-red-200 w-auto inline-block">', Str::replace(']', '</a>', $content)) !!}
                </p>
            </div>
            <div class="m-5" wire:ignore x-show="edit">
                <label for="contenido" class="block text-sm font-medium text-gray-700">
                </label>
                <p class="mt-2 text-sm text-gray-500">
                    No modificar las variables dentro del editor
                </p>
                <div class="mt-1 " wire:ignore>
                    <div class="document-editor " wire:ignore>
                        <div class="document-editor__toolbar" wire:ignore></div>
                        <div class="document-editor__editable-container" wire:ignore>
                            <div class="document-editor__editable" wire:model="content" wire:ignore>
                            </div>
                        </div>
                    </div>
                </div>
                <textarea id="dataloader" class="hidden">{{ $content }}</textarea>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-1">
            <div class="w-full bg-white p-3 text-center mx-auto border mb-3 rounded-md flex flex-col">
                <div x-show="!edit">
                    <div x-data="{ opened_option: null }">
                        <h2>
                            <button type="button" @click="opened_option = opened_option == 0 ? null : 0"
                                class="flex items-center focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 justify-between p-5 w-full font-medium border border-gray-200 dark:border-gray-700 border-b-0 text-left text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                                <span>Variables</span>
                            </button>
                        </h2>
                        <div x-show="opened_option==0">
                            <div class="m-2">
                                <div class="overflow-auto max-h-72 my-2">
                                    @if (count($list) > 0)
                                        @foreach ($list as $var)
                                            <div>
                                                <label
                                                    class="text-sm text-gray-500 text-left flex">{{ $var['key'] }}</label>
                                                <input type="text"
                                                    class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    wire:model="list.{{ $loop->index }}.value"
                                                    wire:change="renderhtml('{{ $var['value'] }}')">
                                            </div>
                                        @endforeach
                                    @else
                                        Sin Variables Disponibles
                                    @endif
                                </div>
                            </div>
                        </div>
                        <h2>
                            <button type="button" @click="opened_option = opened_option == 1 ? null : 1"
                                class="flex items-center focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 justify-between p-5 w-full font-medium border border-gray-200 dark:border-gray-700 border-b-0 text-left text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                                <span>Participantes {{ count($participantes) }}</span>
                            </button>
                        </h2>
                        <div x-show="opened_option==1">
                            <div class="m-2" x-data="{ opened_tab: null }">
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
                                                        <option value="{{ $rol->id }}">
                                                            {{ $rol->name }}
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
                            <div type="button" @click="opened_option = opened_option == 2 ? null : 2"
                                class="flex items-center focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 justify-between p-5 w-full font-medium border border-gray-200 dark:border-gray-700 border-b-0 text-left text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                                <span>Anexos {{ count($annexes) }}</span>
                        </div>
                        </h2>
                        <div x-show="opened_option==2">
                            <div class="m-2" x-data="{ opened_tab: null }">

                                @foreach ($annexes as $key => $attachment)
                                    <div class="m-2">
                                        <div class="flex justify-center rounded-lg text-sm text-left" role="group">
                                            <button
                                                @click="opened_tab = opened_tab == {{ $key }} ? null : {{ $key }}"
                                                class="flex items-center gap-4 text-sm font-light px-3 py-2 rounded-lg bg-gradient-to-tr from-light-blue-500 to-light-blue-700 text-white shadow-md">
                                                {{ $attachment['nombre'] == '' ? 'Anexo ' . ($loop->index + 1) : $attachment['nombre'] }}
                    
                    
                    </button>
                                            <button
                                                class="bg-red-600 text-white hover:bg-red-400 border border border-white-500 rounded-lg px-4 py-2 mx-0 fas fa-trash-alt"
                                                wire:click="remover_anexo({{ $loop->index }})"></button>
                                        </div>

                                        <div x-show="opened_tab=={{ $key }}"
                                            class="mb-2 pb-2 w-full bg-white rounded-lg shadow-xl w-full">
                                            <div class="m-1">

                                                
                                                <label
                                                    class="block text-sm font-medium text-gray-900 dark:text-gray-300 text-left">Nombre</label>
                                                <input type="text"
                                                    class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    wire:model="annexes.{{ $loop->index }}.nombre">
                                            </div>

                                            <div class="m-1">
                                                <label
                                                    class="block text-sm font-medium text-gray-900 dark:text-gray-300 text-left">Tipo</label>
                                                <select
                                                    class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    wire:model="annexes.{{ $loop->index }}.allowed_types_id">
                                                    <option value="" selected>Seleccione</option>
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type->id }}">
                                                            {{ $type->value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="m-1">
                                                <label
                                                    class="block text-sm font-medium text-gray-900 dark:text-gray-300 text-left">comentario</label>
                                                <textarea
                                                    class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    wire:model="annexes.{{ $loop->index }}.comment"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @if (count($annexes) < 5)
                                    <div class="m-2">
                                        <div class="flex justify-center">
                                            <div @click="opened_tab = null"
                                                class=" cursor-pointer flex items-center gap-4 text-sm px-3 py-2 rounded-lg bg-gradient-to-tr from-light-blue-500 to-light-blue-700 text-white shadow-md fas fa-plus"
                                                wire:click="add_anexo"></div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="m-2 mt-3 flex justify-center">
                        <button
                            class="flex items-center gap-4 text-sm px-3 py-2 rounded-lg bg-gradient-to-tr from-light-blue-500 to-light-blue-700 text-white shadow-md"
                            wire:click="save" wire:loading.attr="disabled" wire:target="save"
                            wire:target="genPreview">Generar</button>
                    </div>
                </div>
                <div x-show="edit">
                    <div class="my-4">
                        {{-- componente de que actualiza listas y html --}}
                        @livewire('shared.variables-component', ['list' => $listVars, 'content' => $content])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/decoupled-document/ckeditor.js"></script>
    <script>
        DecoupledEditor
            .create(document.querySelector('.document-editor__editable'), {
                toolbar: {
                    removeItems: ["imageUpload", "uploadImage", "mediaEmbed"]
                }
            })
            .then(editor => {
                editor.setData(document.querySelector('#dataloader').value)

                editor.model.document.on('change:data', () => {
                    @this.set('baseContent', editor.getData());
                    Livewire.emit('editor_content', editor.getData());
                    Livewire.emit('renderhtml');
                })
                const toolbarContainer = document.querySelector('.document-editor__toolbar');

                toolbarContainer.appendChild(editor.ui.view.toolbar.element);

                window.editor = editor;
                document.querySelector('.ck-toolbar').classList.add('ck-reset_all');

                Livewire.on('change', function(data) {
                    editor.setData(data);
                });
            })
            .catch(err => {
                console.error(err);
            });

        const contactsContainer = document.querySelector('.contacts');
        contactsContainer.addEventListener('dragstart', event => {
            const data = "[" + event.target.outerText + "]"
            event.dataTransfer.setData('text/plain', data);
            event.dataTransfer.setData('text/html', data);
        });

        Livewire.on('save_success', function(message) {
            Swal.fire(
                'Good job!',
                message,
                'success'
            ).then(function() {
                window.location = "/contracts";
            });
        });
    </script>
@endpush
