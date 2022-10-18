<div x-init x-data="{ open: false }" id="cartFloat">
    <div @click.away="open=false">
        <button @click="open = !open" class="relative">
            <div
                class="w-20 h-8 hover:w-28 hover:h-20 transition-all duration-300 ease-linear rounded-lg overflow-hidden bg-primary flex flex-col space-y-2 px-2 py-2 items-center justify-start fixed z-20 inset-y-1/2 right-2">
                <div class="flex justify-between items-center cart-nav">
                    <span class="fas fa shopping-cart text-white">
                    </span>
                    <span class="text-white font-bold text-sm">
                        {{ $cant . ' items' }}
                    </span>
                </div>
                <div class="bg-white px-3 h-8 w-full py-1 flex items-center justify-center rounded-lg overflow-hidden">
                    <h1 class="text-primary font-bold text-xs text-center">
                        ${{ formatNumber($total) }}
                    </h1>
                </div>
            </div>
        </button>
        <div class="w-5/6 lg:w-96 fixed z-30 top-0 right-0 h-full overflow-x-hidden transform  transition ease-in-out duration-700"
            id="checkout" :class="open ? 'translate-x-0' : 'translate-x-full'">
            <livewire:carts.cart-view />
        </div>


        @push('js')
            <script>
                // localStorage.clear();
                Livewire.on('addProductToCart', function(product, cant) {
                    cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : {};
                    index = product.code;
                    cart[index] = product;
                    localStorage.setItem('cart', JSON.stringify(cart));
                    finalCart = JSON.parse(localStorage.getItem('cart'));
                    Livewire.emit('updatedCart', finalCart);
                    Livewire.emit('alert', 'Producto Añadido');
                });
                
                
            </script>
        @endpush
    </div>

</div>
