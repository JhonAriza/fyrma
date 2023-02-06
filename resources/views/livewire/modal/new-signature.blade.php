<div>
    <x-jet-dialog-modal wire:model="open" wire:loading maxWidth="md" class="roun">

        <x-slot name="title">Nueva Firma</x-slot>
        <div> </div>
        <x-slot name="content" class="bg-light-blue-100">
            <div class="wrapper text-center">

                <div class="container ml-8 ">
                    <table class="relative   ">
                        <thead>
                            <tr>
                                <th class="border-t-4 border-l-4  px-2 py-4"> </th>
                                <th class="px-8 py-9"> </th>
                                <th class="px-8 py-9"> </th>
                                <th class="border-t-4 border-r-4 px-2 py-4 "> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="px-9 py-6"> </th>
                                <th class="px-8 py-6"> </th>
                                <th class="px-8 py-6"> </th>
                                <th class="px-9 py-6"> </th>
                            </tr>
                            <tr>
                                <td class="border-b-4 border-l-4 px-2 py-4"> </td>
                                <td class="px-8 py-9"> </td>
                                <td class="px-8 py-9"> </td>
                                <td class="border-b-4 border-r-4 px-2 py9 "> </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <canvas id="signature-pad" class="absolute signature-pad border-black text-center" width=260
                    height=180></canvas>
            </div>

            <div class="flex justify-center">
                <x-jet-button type="button" class="bg-indigo-400 rounded-full py-3 pl-6 mr-6  mt-5" id="clear">
                    Limpiar
                </x-jet-button>

                <x-jet-button type="button" class="bg-indigo-400  rounded-full py-3 mt-5 ml-4" id="save"
                    wire:click="savesignature">
                    Generar
                </x-jet-button>
            </div>
        </x-slot>

        <x-slot name="footer" class="bg-white">

        </x-slot>
    </x-jet-dialog-modal>

</div>

@push('css')
    <style>
        canvas {

            padding: 0;
            margin: auto;
            display: block;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin-top: 65px;
        }

        .mb-6.bg-white.rounded-lg.overflow-hidden.shadow-xl.transform.transition-all.sm\:w-full.sm\:max-w-md.sm\:mx-auto {
            color: rgb(8, 8, 4);
            border-radius: 50px;
            width: 380px;
            margin-top: 80px;


        }

        .bg-gray-100 {

            background-color: white;
        }

        .text-lg {
            text-align: center;
            color: #7f8ae7;
            font-size: x-large;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

    <script>
        var canvas = document.querySelector("canvas");
        var signaturePad = new SignaturePad(canvas);
        document.getElementById('clear').addEventListener('click', function() {
            signaturePad.clear();
        });
        document.getElementById('save').addEventListener('click', function() {
                var b64 = signaturePad.toDataURL({
                    pixelRatio: 3
                });
                @this.set('signature', b64);
            },
            false
        );

        Livewire.on('opened', function(message) {
            signaturePad.clear();
        })

        Livewire.on('save_signature', function(message) {
            Swal.fire(
                'Good job!',
                message,
                'success'
            )
        });
    </script>
@endpush
