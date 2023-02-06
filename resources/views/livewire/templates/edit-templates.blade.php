<div>
    <x-errors></x-errors>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-2">
            <div class="m-5" wire:ignore>
                <label for="contenido" class="block text-sm font-medium text-gray-700">
                </label>
                <p class="mt-2 text-sm text-gray-500">
                    No modificar las variables dentro del editor
                </p>
                <div class="mt-1" wire:ignore>
                    <div class="document-editor" wire:ignore>
                        <div class="document-editor__toolbar" wire:ignore></div>
                        <div class="document-editor__editable-container" wire:ignore>
                            <div class="document-editor__editable" wire:model="content" wire:ignore>
                            </div>
                        </div>
                    </div>
                </div>
                <textarea id="dataloader" class="hidden">{{$content}}</textarea>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-1 pr-5">
            <div class="w-full bg-white p-3 text-center mx-auto border mb-3 rounded-md">
                <div class="my-4">
                    <div class="bg-white flex-col items-center">     
                        <label for="floating_text" class="text-sm text-gray-500">Nombre Plantilla</label>
                        <input type="text" name="floating_text" class="block py-2.5 px-2 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" wire:model.defer="name" />
                    </div>
                </div>
                <div class="my-8">
                    {{-- componente de que actualiza listas y html --}}
                    @livewire('shared.variables-component', ['list' => $list, 'content' => $content])
                </div>
                <div class="bg-gray-50 text-right">
                    <button class="items-center gap-4 text-sm font-light px-4 py-3 rounded-lg bg-gradient-to-tr from-light-blue-500 to-light-blue-700 text-white shadow-md hover:bg-light-blue-700 hover:shadow-lg-light-blue" href="#" wire:loading.attr="disabled" wire:target="save" wire:click="save">
                        Guardar
                    </button>
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
                    removeItems:["imageUpload","uploadImage","mediaEmbed"]            
                }
            })
            .then(editor => {
                editor.setData(document.querySelector('#dataloader').value)

                editor.model.document.on('change:data', () => {
                    @this.set('content', editor.getData());
                    Livewire.emit('editor_content', editor.getData());
                })
                const toolbarContainer = document.querySelector('.document-editor__toolbar');

                toolbarContainer.appendChild(editor.ui.view.toolbar.element);

                window.editor = editor;
                document.querySelector('.ck-toolbar').classList.add('ck-reset_all');

                Livewire.on('clean', function() {
                    editor.setData('');
                });

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
            )
        });
    </script>
@endpush
</div>
