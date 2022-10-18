<x-app>
    @slot('secondbar')
        @include('includes.secondbar')
    @endslot
   
    <livewire:home-view />
   {{--  <div x-data="map('hola')">
        <div x-ref="map" class="map h-[400px] w-full md:max-w-xl mx-auto border border-slate-300 rounded-md my-4 shadow-lg">
        </div>
    </div> --}}
  
</x-app>
