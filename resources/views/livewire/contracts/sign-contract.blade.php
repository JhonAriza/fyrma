<div>
    <x-errors></x-errors>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        @if (json_decode($document->status)->status != 'Rechazado' || json_decode($document->status)->status != 'Finalizado')
            <div class="md:col-span-2">
                <div class="m-5 sm:px-0 shadow-sm">
                    <p class=" text-sm font-bold text-left px-4 py-1">
                        {{ $document->document_name }}
                    </p>
                    <p class=" text-sm text-left px-4 py-1">
                        Estado del Documento: {{ json_decode($document->status)->status }}
                    </p>
                    <p class=" text-sm text-left px-4 py-1">
                        Mi Estado: {{ json_decode($document->participants)[$id_participant]->status }}
                    </p>
                </div>
                @livewire('shared.tags', ['contract_id' => $contract_id])
                @livewire('components.show-html', ['contract_id' => $document->id])
            </div>
            <div class="mt-5 md:mt-0 md:col-span-1 pr-5">
                @if ($show_comments && json_decode($document->status)->status === 'Pendiente Por Firmar')
                    @livewire('components.comments' , ['owner_contract' => $contract->owner])
                @else
                    <div class="w-full mt-5 bg-white p-3 text-center mx-auto border mb-3 rounded-md">
                        @if ($mystate->status === 'Leido')
                            Bienvenido<label class="inline-flex items-center p-1"> {{ Auth::user()->name }},</label>
                            Seleccione un estado
                            <div class="flex flex-col mt-2 shadow-sm">
                                @foreach ($states as $state)
                                    <label class="inline-flex items-center p-1">
                                        <input type="radio" class="form-radio" wire:model="status"
                                            value="{{ $state }}">
                                        <span class="ml-2">{{ $state }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @if ($status === 'Aceptado')
                                <div class="m-2 text-left">
                                    Al Aceptar se le solicitara lo siguiente:
                                    @foreach (json_decode($document->shields) as $item)
                                        <label class="flex items-center mt-2 pl-5">
                                            {{ App\Models\Shields::name($item) }}
                                        </label>
                                    @endforeach
                                    @if (!json_decode($document->participants)[$id_participant]->signed)
                                        <div class="m-2" x-data="{ show: false }">
                                            <div class="flex justify-center rounded-lg text-sm text-left"
                                                role="group">
                                                <button @click="show = ! show"
                                                    class="bg-blue-600 text-white hover:bg-blue-400 border border-white-500 rounded-lg px-4 py-2 mx-0 w-full text-left mr-1">
                                                    Firma Digital
                                                </button>
                                            </div>
                                            <div x-show="show"
                                                class="mb-2 pb-2 w-full bg-white rounded-lg shadow-xl w-full">
                                                @if (!Auth::user()->signature)
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 text-center mt-2">Aun
                                                        no
                                                        posees
                                                        una Firma Digital, genera una.</label>
                                                    <x-jet-button type="button" class="bg-blue-500 mt-2"
                                                        wire:click="newsignature">
                                                        Generar
                                                    </x-jet-button>
                                                @else
                                                    <div class="mx-5 my-3">
                                                        <img src="{{ Auth::user()->signature->signature }}"
                                                            alt="mysign" class="border-2" />
                                                    </div>
                                                    <x-jet-button type="button" class="bg-blue-500 mt-2"
                                                        wire:click="newsignature">
                                                        Generar Nueva
                                                    </x-jet-button>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    <div>
                                <!--este es el componene donde se invoca adjuntar annexos  -->
                                @livewire('shared.attachment-component', ['contract_id' => $contract_id])
                                @elseif($status === 'Rechazar')
                                    <div class="m-2 text-left">
                                        <p class="mb-1">
                                            Al Rechazar deje en comentario, ya que esta accion no es reversible:
                                        </p>
                                        <textarea class="w-full px-3 mt-1 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4"
                                            wire:model.defer="message"></textarea>
                                        <div>
                                    </div>
                                @endif   <!-- enviar aceptar documento-->
                            @if ($status === 'Aceptado')
                                <x-jet-button type="button" class="bg-blue-500 mt-5"
                                    wire:click="$emit('validatesignature')" wire:loading.attr="disabled">
                                    Enviar
                                </x-jet-button>
                            @elseif($status === 'Rechazar')
                        <!-- enviar para rechazar documento diferente -->
                                <x-jet-button type="button" class="bg-blue-500 mt-5" wire:click="save"
                                    wire:loading.attr="disabled">
                                    Enviar
                                </x-jet-button>
                            @endif
                        @else
                            <div>
                                Recibira una notificacion cuando la parte acepte el documento
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        @elseif (json_decode($document->status)->status === 'En Revision')
            El documento se encuentra En Revision
        @else
            El documento se encuentra Rechazado y no se puede recuperar
        @endif
    </div>
    @livewire('modal.new-signature')

    @push('js')
        <script>
            Livewire.on('save_success', function(message) {
                Swal.fire(
                    'Good job!',
                    message,
                    'success'
                )
            });

            Livewire.on('save_error', function(message) {
                Swal.fire({
                    icon: 'error',
                    title: 'Archivo No Admitido',
                    
                })
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
                Livewire.emit('save');
            })

            Livewire.on('saveAttachment', function(id) {
                console.log(id);
                var file = document.getElementById("filesAttachments." + id).files[0];
                var fileName = file.name;
                var extensionPoint = fileName.substring(fileName.lastIndexOf('.'), fileName.length) || fileName;
                var extension = fileName.substring(fileName.lastIndexOf('.') + 1, fileName.length) || fileName;
                console.log(fileName);
                console.log(extension);
                getBase64(file).then(
                    data => Livewire.emit('save_attachment', id, data, extensionPoint, extension, fileName)
                ).catch(err => Livewire.emit('save_attachment', id, null, null, null, null))
            })

            function getBase64(file) {
                return new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = () => resolve(reader.result);
                    reader.onerror = error => reject(error);
                });
            }
        </script>
    @endpush

</div>
