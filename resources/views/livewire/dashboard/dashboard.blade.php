<div>
    <div class="pt-10 md:px-4 border-dashed border-b-4 border-white">
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4">
            <div class="px-4 mb-6">
                <div class="w-full bg-white rounded-xl overflow-hdden shadow-md p-4">
                    <img class="-mt-14 -ml-4 w-24 p-4" src="{{ URL::asset('/img/1.svg') }}">
                    <div class="w-full  max-w-full flex-grow flex-1 text-right">
                        <h5 class="-mt-10 text-gray-500 font-light tracking-wide text-1xl"><b> No Firmados</b>
                        </h5>
                        <span class="text-4xl text-gray-900 justify-center">5</span>
                    </div>
                    <span class="font-light whitespace-nowrap ">el ultimo mes</span>

                </div>
            </div>

            <div class="px-4 mb-6">
                <div class="w-full bg-white rounded-xl overflow-hdden shadow-md p-4">
                    <img class="-mt-14 -ml-4 w-24 p-4" src="{{ URL::asset('/img/2.svg') }}   ">
                    <div class="w-full  max-w-full flex-grow flex-1   text-right">
                        <h5 class="-mt-10 text-gray-500 font-light tracking-wide   text-1xl"> Enviados </h5>
                        <span class="text-4xl text-gray-900 justify-center">5</span>
                    </div>
                    <span class="font-light whitespace-nowrap">el ultimo mes</span>
                </div>
            </div>

            <div class="px-4 mb-6">
                <div class="w-full bg-white rounded-xl overflow-hdden shadow-md p-4">
                    <img class="-mt-14 -ml-4 w-24 p-4" src="{{ URL::asset('/img/3.svg') }}">
                    <div class="w-full  max-w-full flex-grow flex-1   text-right">
                        <h5 class="-mt-10 text-gray-500 font-light tracking-wide   text-1xl"> borradores</h5>
                        <span class="text-4xl text-gray-900 justify-center">5</span>
                    </div>
                    <span class="font-light whitespace-nowrap">el ultimo mes</span>
                </div>
            </div>

            <div class="px-4 mb-6">
                <div class="w-full bg-white rounded-xl overflow-hdden shadow-md p-4">
                    <img class=" w-16 p-4 -ml-4 -mt-10" src="{{ URL::asset('/img/4.svg') }}">
                    <div class="w-44  flex-grow  justify-items-start  text-sm">
                        Seleccione el rango de fecha que decea visualizar
                    </div>
                    <span class="font-light whitespace-nowrap  text-blue-400 hover:text-blue-400 hover:bg-blue-100">el
                        ultimo mes</span>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-6 md:px-4 h-auto">
        <div class="grid grid-cols-1 lg:grid-cols-1 xl:grid-cols-4 pl-4 sm:pl-0">
            <div class="px-4 mb-6">
                <div class="w-full bg-white rounded-xl overflow-hdden shadow-md">
                    <div class="w-full max-w-full flex-grow flex-1 text-center py-4 bg-morado-fyrmalo rounded-t-xl text-white">
                        <span class="text-xl font-semibold justify-center">Historial ultimos meses</span>
                    </div>
                    <div class=" relative w-full max-w-full text-center py-2" x-data="{ opened_tab: null }">
                        @foreach ($eventos as $name => $event)
                            <button class="align-middle text-gray-500 font-light text-sm border-b-2 py-2"
                            @click="opened_tab = opened_tab == {{ $name }} ? null : {{ $name }}"> 
                                <div class="grid gap-2 grid-cols-4 mx-2 items-center">
                                    <div class="text-2xl">{{ Carbon\Carbon::parse($name)->format('d') }}</div>
                                    <div class="text-xl col-span-2">{{ Carbon\Carbon::parse($name)->format('F Y') }}</div>
                                    <span :class="{ ' fa-chevron-right ': opened_tab != {{ $name }}, ' fa-chevron-down ': opened_tab == {{ $name }} }" class="fas text-2xl"></span>
                                </div>
                            </button>
                        
                            <div x-show="opened_tab=={{ $name }}"
                                class="ml-56 -mt-28   mb-2 pb-2 w-96 max-w flex-col bg-white  h-full overflow-y-auto">
                                @foreach ($event as $item)
                                <div class="">

                                    <div class="bg-gray-200 " x-data="{open: false }">



                                        
                                    <button  x-on:click="open = !open"> 
                                        <div class="fas fa-plus white-INDIGO-600 bg-white w-96 max-w p-2 text-sm">{{ Carbon\Carbon::parse($name)->format('d F Y') }}   </div>
                      
                                          
                                        </button>
                                    <nav class=" ml-20 w-60" x-show="open">
                                        <div class="bg-azul-claro absolute -rotate-90 -ml-20"> {{  $item['date']->format('h:i') }}</div>
                                    <div class="col-span-4">{{ $item['title'] }} : {{ $item['description'] }} </div>
                                
                                </nav>
                                </div>
                                </div>
                                    
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="px-4 mb-6 col-span-3 hidden sm:block">
                <div class="bg-blue-500 ">
                    <div class="container mx-auto max-w-full">
                        <div class="bg-indigo-500  justify-center">calendario </div>
                        @livewire('dashboard.calendar' , ['eventos' => $eventos])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
