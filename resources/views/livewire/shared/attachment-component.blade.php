<div>
    @if ($owner)
        <div class="grid grid-cols-2 gap-6">
            @foreach ($attachments as $attachment)
                <div class="col-span-3 sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700"><b> Anexo:</b>
                        {{ $attachment['attachmentdocument_name'] }}
                    </label>
                    <label class="block text-sm font-medium text-gray-700 mt-1 font-bold">{{ $attachment['participant'] }}
                    </label>
                    <label class="block text-sm font-medium text-gray-700"><b>Estado:</b>
                        @if (!$attachment['attachmentdocument_document'] && !$attachment['status'])
                            Pendiente por Subir
                        @elseif($attachment['attachmentdocument_document'] && !$attachment['status'])
                            Pendiente por Revision
                        @else
                            Aprobado
                        @endif
                    </label>

                    @if ($attachment['attachmentdocument_document'])
                        <label class="block text-sm font-medium text-gray-700"> Descargar
                            <a class="bg-red-600 text-white hover:bg-red-400 border border border-white-500 rounded-lg px-4 py-2 mx-0 fas fa-download"
                                href="{{ $attachment['attachmentdocument_document'] }}"
                                download="{{ $attachment['attachment_filename'] }}"></a>
                            <!-- remplazo la concatenacion con el nombre del nuevo campo con attachment_filename que tiene el nombre guardado -->
                        </label>
                        <div class="hidden sm:block" aria-hidden="true">
                            <div class="py-1">
                                <div class="border-t border-gray-200"></div>
                            </div>
                        </div>
                        @if ($attachment['attachmentdocument_document'] && !$attachment['status'])
                            <button
                                class="bg-green-600 text-white hover:bg-green-400 border border border-white-500 rounded-lg px-4 py-2 mx-0 fas fa-check"
                                wire:click="validateAttachment(true, {{ $attachment['id'] }})"></button>
                            <button>
                                <button
                                    class="bg-red-600 text-white hover:bg-red-400 border border border-white-500 rounded-lg px-4 py-2 mx-0 fas fa-ban"
                                    wire:click="validateAttachment(false, {{ $attachment['id'] }})"></button>
                        @endif
                    @endif 
                    <div class="hidden sm:block" aria-hidden="true">
                        <div class="py-1">
                            <div class="border-t border-gray-200"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        @if (count($attachments) > 0)
            <div class="grid grid-cols-1 gap-18">
                <div>Tambien debe anexar lo siguiente:</div>
                @foreach ($attachments as $attachment)
                    <div class="col-span-3 sm:col-span-2" x-data="{ show: false }">
                        <div class="flex justify-center rounded-lg text-sm text-left" role="group">
                            <button @click="show = ! show"
                                class="bg-blue-600 text-white hover:bg-blue-400 border border-white-500 rounded-lg px-4 py-2 mx-0 w-full text-left mr-1">
                                {{ $attachment['attachmentdocument_name'] }}
                            </button>
                        </div>
                        <div x-show="show" class="col-span-3 sm:col-span-2 mt-1">
                            @if ($attachment['attachmentdocument_document'] && !$attachment['status'])
                                Documento enviado para revision
                            @elseif ($attachment['attachmentdocument_document'] && $attachment['status'])
                                Documento Aprobado
                            @else
                                <label class="flex items-center mt-2 pl-5">
                                    {{ $attachment['comment'] }}
                                </label>
                                <input
                                    class="form-control block w-full px-2 py-1 text-sm font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    id="filesAttachments.{{ $loop->index }}" type="file"
                                    accept="{{ $attachment->FileExtension->accept }}">
                                <x-jet-button type="button" class="bg-blue-500 mt-5"
                                    wire:click="$emit('saveAttachment','{{ $loop->index }}')"
                                    wire:loading.attr="disabled">
                                    Enviar annexos
                                </x-jet-button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
</div>

