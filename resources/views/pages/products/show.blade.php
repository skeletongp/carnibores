<x-app>
    @slot('secondbar')
        @include('includes.secondbar')
    @endslot
    <!-- Jumbotron -->
    <div class="p-12 text-center relative overflow-hidden bg-center bg-no-repeat bg-cover rounded-lg"
        style="background-image: url({{ $product->image }}); height: 400px;
">
        <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed"
            style="background-color: rgba(0, 0, 0, 0.6)">
            <div class="flex flex-col space-y-2 justify-center items-center h-full">
                <div class="text-white">
                    <img src="{{ env('LOGO_URL') }}" alt="" class="w-52 md:w-72  mx-auto mb-4">
                    <h4 class="font-semibold text-xl lg:text-2xl mb-6">{{$product->name}} - {{$product->stock->formatted_price}}</h4>
                    <a class="inline-block px-7 py-3 mb-1 border-2 border-gray-200 text-gray-200 font-medium text-sm leading-snug uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out"
                        href="{{ route('products.index',['search'=>$product->name]) }}" role="button" data-mdb-ripple="true"
                        data-mdb-ripple-color="light">Explora Otros Productos</a>
                </div>
            </div>
        </div>
    </div>
    <div class="p-4">
        <h1 class="text-center pt-4 md:pt-6 uppercase text-xl lg:text-4xl font-bold text-primary">Productos relacionados</h1>
    </div>
    <div class="grid w-max mx-auto grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-2 md:gap-4 lg:gap-6">
        @forelse ($relateds as $produ)
            <livewire:products.product-card :product="$produ" :key="$produ['id']" />

        @empty
            <div class="flex flex-col items-center justify-center w-full h-64 md:col-span-2 lg:col-span-4 xl:col-span-4">
                <h1 class="text-xl md:text-2xl text-center font-bold text-gray-500">
                    No hay productos que coincidan con tu búsqueda
                </h1>
        @endforelse

    </div>
    <!-- Jumbotron -->
</x-app>
