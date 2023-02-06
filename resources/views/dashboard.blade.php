<x-app-layout>
    <div class="sm:w-4/5 main-container">
        {{-- @livewire('test.email') --}}
        @if (Session::get('denied'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Denegado!</strong>
                <span class="block sm:inline">Accion no permitida.</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                </span>
            </div>
        @endif
        {{-- <h2>FIXME FOR TEST GCP STORAGE</h2>
        @livewire('test-gcp-storage') --}}
        @livewire('dashboard.dashboard')
</x-app-layout>
