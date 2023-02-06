<div>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900 p-4">Documento</h3>
                <p class="mt-1 text-sm text-gray-600 px-4">
                    Informacion general del documento recibido
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-3 sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Enviado Por:
                            </label>
                            <label class="block text-sm font-medium text-gray-700 mt-1 font-bold">
                                {{ $document->sender->name }}
                            </label>
                            <label class="block text-sm font-medium text-gray-700 mt-1 font-bold">
                                {{ $document->sender->email }}
                            </label>
                        </div>
                        <div class="col-span-3 sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Fecha y Hora:
                            </label>
                            <label class="block text-sm font-medium text-gray-700 mt-1 font-bold">
                                {{ \Carbon\Carbon::parse($document->created_at)->format('d/m/Y h:i:s') }}
                            </label>
                        </div>
                        <div class="col-span-3 sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Estado Documento:
                            </label>
                            <label class="block text-sm font-medium text-gray-700 mt-1 font-bold">
                                {{ json_decode($document->status)->status }}
                            </label>
                        </div>
                        @if ($document->document->customer_pdf)
                            <div class="col-span-3 sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Contrato
                                </label>
                                <label class="block text-sm font-medium text-gray-700 mt-1 font-bold">
                                    <a href="data:application/pdf;base64,{{ $document->document->customer_pdf }}"
                                        type="button"
                                        download="{{ $document->email_client }}{{ \Carbon\Carbon::parse($document->created_at)->format('Y-m-d') }}.pdf"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Descargar
                                    </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 p-4">Personal</h3>
                    <p class="mt-1 text-sm text-gray-600 px-4">
                        Mi Participacion
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Rol:
                                </label>
                                <label class="block text-sm font-medium text-gray-700 mt-1 font-bold">
                                    {{ $participante->rol_name }}
                                </label>
                            </div>
                            <div class="col-span-3 sm:col-span-2 mt-1">
                                <label class="block text-sm font-medium text-gray-700">
                                    Estado:
                                </label>
                                <label class="block text-sm font-medium text-gray-700 mt-1 font-bold">
                                    {{ $participante->status }}
                                </label>
                            </div>
                            @if (($participante->status === 'Pendiente' && $participante->rol == 1) || ($participante->status === 'Leido' && $participante->rol == 1))
                                @if ($document->document->customer_url)
                                    <div class="col-span-3 sm:col-span-2 mt-1">
                                        <a href="{{ url($urlSign) }}"
                                            type="button"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Firmar
                                        </a>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

    @if($attachmentsExists)
        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 p-4">Anexos</h3>
                        <p class="mt-1 text-sm text-gray-600 px-4">
                            Documentos Anexos
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                            <div class="grid grid-cols-2 gap-6">
                                @livewire('shared.attachment-component', ['contract_id' => $contract_id])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 p-4">Tracking</h3>
                    <p class="mt-1 text-sm text-gray-600 px-4">
                        Seguimiento del Documento
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-6 overflow-y-auto max-h-72">
                                @foreach ($document->trackings as $track)
                                    <div class="flex justify-start text-gray-700 rounded-md px-2 py-2 my-2">
                                        <span class="bg-green-400 h-2 w-2 m-2 rounded-full"></span>
                                        <div class="flex-grow text-sm px-2">{{ $track->owner }}
                                            {{ $track->type }} {{ $track->value }}</div>
                                        <div class="text-sm font-normal text-gray-500 tracking-wide text-right">
                                            {{ \Carbon\Carbon::parse($track->created_at)->format('d/m/Y H:i:s') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>@push('js')
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
