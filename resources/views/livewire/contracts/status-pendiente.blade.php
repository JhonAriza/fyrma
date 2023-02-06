<div>
    <x-errors></x-errors>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-2">
            <div class="m-5 sm:px-0 shadow-sm">
                <p class=" text-sm font-bold text-left px-4 py-1">
                    {{ $contract->document_name }}
                </p>
                <p class=" text-sm text-left px-4 py-1">
                    Estado del Documento: {{ json_decode($contract->status)->status }}
                </p>
                @if (json_decode($contract->status)->status != "Rechazado")
                    <p class=" text-sm text-left px-4 py-1">
                        Mi Estado: {{ json_decode($contract->owner_status)->status }}
                    </p>                    
                @endif
            <!-- se agrega componente de etiquetas -->
              @livewire('shared.tags', ['contract_id' => $contract_id])
            </div>
            @livewire('components.show-html', ['contract_id' => $contract_id])
        </div>
        <div class="mt-5 md:mt-50 md:col-span-1 pr-5">
            @if ($show_comments)
                 @livewire('components.comments' , ['owner_contract' => $contract->owner])
            @endif
            <div x-data="{ opened_option: 0 }" class="@if (!$show_comments) show @else hidden @endif">
                <div class="w-full bg-white p-3 text-center mx-auto border mb-3 rounded-md">
                    <div class="max-w-2xl mx-auto bg-white rounded">
                        <h2>
                            <button type="button" @click="opened_option = opened_option == 0 ? null : 0"
                                class="flex items-center focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 justify-between p-5 w-full font-medium border border-gray-200 dark:border-gray-700 border-b-0 text-left text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                                <span>Blindajes Documento</span>
                            </button>
                        </h2>
                        <div x-show="opened_option==0">
                            <div class="m-2 pb-4">
                                @foreach (json_decode($contract->shields) as $item)
                                    <label class="flex items-center mt-3">
                                        {{ App\Models\Shields::name($item) }}
                                    </label>
                                @endforeach
                            </div>
                            @if (!json_decode($contract->owner_status)->signed)
                                @if (json_decode($contract->status)->status != "Rechazado")
                                    <div class="m-2">
                                        <div class="flex items-center mb-4">
                                            <input type="checkbox" wire:model="signtogenerate"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Firmar</label>
                                        </div>
                                        @if ($signtogenerate)
                                            <div class="m-2">
                                                <label
                                                    class="block text-sm font-medium text-gray-900 dark:text-gray-300 text-left">Titulo</label>
                                                <input type="text"
                                                    class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    wire:model="miparticipacion">
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
                            @endif
                        </div>
                        <h2>
                            <button type="button" @click="opened_option = opened_option == 1 ? null : 1"
                                class="flex items-center focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 justify-between p-5 w-full font-medium border border-gray-200 dark:border-gray-700 border-b-0 text-left text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                                <span>Participantes {{ count($participantes) }}</span>
                            </button>
                        </h2>
                        <div x-show="opened_option==1">
                            <div class="py-2 border border-gray-200 dark:border-gray-700 border-b-0" x-data="{ opened_tab: null }">
                                    @foreach ($participantes as $participante)
                                    <div class="m-2">
                                        <div class="mb-2 p-2 w-full bg-white rounded-lg shadow-xl w-full">
                                            <div class="m-2">
                                                <label
                                                    class="block text-sm font-medium text-gray-700 text-left">{{ $participante['nombre'] }}</label>
                                            </div>
                                            <div class="m-2">
                                                <label
                                                    class="block text-sm font-medium text-gray-700 text-left">{{ $participante['correo'] }}</label>
                                            </div>
                                            <div class="m-2">
                                                <label class="block text-sm font-medium text-gray-700 text-left"><b> Estado:</b>
                                                    {{ $participante['status'] }}</label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @if(count($attachmentBorrador) > 0)
                            <h2>
                                <button type="button" @click="opened_option = opened_option == 2 ? null : 2"
                                    class="flex items-center focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 justify-between p-5 w-full font-medium border border-gray-200 dark:border-gray-700 border-b-0 text-left text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                                    <span>Anexos {{ count($attachmentBorrador) }}</span>
                                </button>
                            </h2>
                            <div x-show="opened_option==2">
                                <div class="py-2 border border-gray-200 dark:border-gray-700 border-b-0" x-data="{ opened_tab: null }">
                                    @livewire('shared.attachment-component', ['contract_id' => $contract_id])
                                </div>
                            </div>
                        @endif
                        <h2>
                            <button type="button" @click="opened_option = opened_option == 3 ? null : 3"
                                class="flex items-center focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 justify-between p-5 w-full font-medium border border-gray-200 dark:border-gray-700 border-b-0 text-left text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                                <span>Firma Digital</span>
                            </button>
                        </h2>
                        <div x-show="opened_option==3">
                            <div class="m-2">
                                @if (!Auth::user()->signature)
                                    <label class="block text-sm font-medium text-gray-700 text-center mt-2">Aun no
                                        posees
                                        una Firma Digital, genera una.</label>
                                    <div class="flex justify-center">
                                        <button
                                            class="flex items-center gap-4 text-sm px-3 py-2 rounded-lg bg-gradient-to-tr from-light-blue-500 to-light-blue-700 text-white shadow-md"
                                            wire:click="newsignature">Generar</button>
                                    </div>
                                @else
                                    <div class="mx-5 my-3">
                                        <img src="{{ Auth::user()->signature->signature }}" alt="mysign"
                                            class="border-2" />
                                    </div>
                                    <div class="flex justify-center">
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

        Livewire.on('saveAttachment', function(id) {
            var file = document.getElementById("filesAttachments." + id).files[0];
            getBase64(file).then(
                data => Livewire.emit('save_attachment', id, data)
            ).catch(err => Livewire.emit('save_attachment', id, null))
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
