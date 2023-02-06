<!-- se crea componente reutilizable para los botones -->
 
@props(['url' => null, 'param' => null, 'icon' => null])

<div  class='has-tooltip inline-flex'  {{$attributes}} >
    @if($url)
        @if($param)
            <a href="{{ route($url, ['id' => $param]) }}" type="button" data-tooltip-target="tooltip-default"
                class="{{$icon}} items-center gap-4  font-light px-5 py-1.5 rounded-full bg-gradient-to-tr from-light-blue-500 to-light-blue-700 text-white shadow-md hover:bg-light-blue-700 hover:shadow-lg-light-blue">
            </a>
        @else
            <a href="{{ route($url) }}" type="button" data-tooltip-target="tooltip-default"
                class="{{$icon}}items-center gap-4  font-light px-4   rounded-lg bg-gradient-to-tr from-light-blue-500 to-light-blue-700 text-white shadow-md hover:bg-light-blue-700 hover:shadow-lg-light-blue">
            </a>
        @endif
    @else
        <x-jet-button data-tooltip-target="tooltip-default" type="button" class="bg-blue-500 {{$icon}}">
        </x-jet-button>
    @endif
    <span  class='tooltip rounded w-auto shadow-lg bg-blue-500 text-white -mt-10 -ml-10  py-2 px-3 absolute'>
          {{ $slot }} 
    </span>
</div>