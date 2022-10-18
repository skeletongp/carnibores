<div>
    
   
    <div class="">
        <!-- Jumbotron -->
        <div class="p-12 max-w-[64rem] mx-auto text-center relative overflow-hidden bg-no-repeat bg-cover rounded-lg"
            style="
    background-image: url({{env('CARNE_FONDO')}});
    height: 400px;
  ">
            <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed"
                style="background-color: rgba(0, 0, 0, 0.6)">
                <div class="flex flex-col space-y-2 justify-center items-center h-full">
                    <img src="{{ env('LOGO_URL') }}" alt="" class="w-44 lg:w-72 z-10 mx-auto">
                    <div class="text-white">
                        <img src="{{ env('LOGO_PATH') }}" alt="" class="w-52 md:w-72  mx-auto mb-4">
                        <h4 class="font-semibold text-xl mb-6">Somos expertos en sabor, calidad y buen precio.</h4>
                        <a class="inline-block px-7 py-3 mb-1 border-2 border-gray-200 text-gray-200 font-medium text-sm leading-snug uppercase rounded-lg hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out"
                            href="{{ route('products.index') }}" role="button" data-mdb-ripple="true"
                            data-mdb-ripple-color="light">Descubre nuestros productos</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumbotron -->

    </div>
    <div class="hidden" wire:loading.class.remove="hidden">
        <x-loading />
    </div>
    <div class="grid max-w-xs md:max-w-4xl lg:max-w-7xl md:w-max mx-auto grid-cols-1 md:grid-cols-2 my-4 lg:grid-cols-4 xl:grid-cols-4 gap-4 lg:gap-6">
        @forelse ($products as $product)
            <livewire:products.product-card :product="$product" :key="$product['id']" />

        @empty
            <div
                class="flex flex-col items-center justify-center w-full h-64 md:col-span-2 lg:col-span-4 xl:col-span-4">
                <h1 class="text-xl md:text-2xl text-center font-bold text-gray-500">
                    No hay productos que coincidan con tu búsqueda
                </h1>
        @endforelse

    </div>
</div>
