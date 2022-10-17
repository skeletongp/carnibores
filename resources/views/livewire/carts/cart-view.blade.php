    <div class="w-full absolute z-10 left-0 h-full overflow-x-hidden transform translate-x-0 transition ease-in-out duration-700"
        id="checkout">

        <div class="flex items-end lg:flex-row flex-col justify-end" id="cart">

            <div class="lg:w-96 md:w-8/12 w-full bg-gray-100  h-full">
                <div
                    class="flex flex-col lg:h-screen h-auto lg:px-8 md:px-7 px-4 lg:py-20 md:py-10 py-6 justify-between overflow-y-hidden">
                    <p class="lg:text-4xl text-3xl font-black leading-4 text-primary">Resumen</p>
                    <div class="overflow-y-auto pr-2 bg-white" id="orderDiv">
                        @forelse ($products as $product)
                            <div class="flex items-center justify-between pt-2">
                                <div class="w-16 h-16 md:w-24 md:h-24  bg-center bg-80% bg-no-repeat"
                                    style="background-image: url({{ $product['image'] }})">
                                </div>
                                <div class="flex w-full flex-col space-y-2">
                                    <span class="font-bold text-sm">{{ $product['name'] }}</span>
                                    <div class="flex justify-between font-bold">
                                        <span
                                            class="text-xs text-secondary">{{ $product['cant'] . ' ' . $product['stock']['unit']['symbol'] }}</span>
                                        <span class="text-sm text-green-600">$
                                            {{ formatNumber($product['cant'] * $product['stock']['special']) }}</span>
                                        <button class="remove" onclick="removeItemFromCart('{{ $product['code'] }}')">
                                            <span class="fas fa-times text-red-500 cursor-pointer "></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @empty
                            <div class="py-8 text-xl text-gray-500 font-bold">
                                <p class="text-center">No hay productos en el carrito</p>
                            </div>
                        @endforelse


                    </div>
                    <div>
                        <div class="flex items-center pb-6 justify-between lg:pt-5 pt-20">
                            <p class="text-2xl leading-normal text-gray-800 dark:text-white">Total</p>
                            <p class="text-2xl font-bold leading-normal text-right text-gray-800 dark:text-white">
                                ${{ $total }}</p>
                        </div>
                        <div class="flex space-x-2 items-center">
                            @auth
                                <button onclick="orderImage()"
                                    class="text-base leading-none  py-3 bg-green-600 border-white border focus:outline-none focus:ring-0  hover:text-gray-200 hover:bg-green-500 text-white  w-2/3 font-bold uppercase rounded-md">
                                    <span class="fas fa-check-circle "></span>
                                    <span>Confirmar</span>
                                </button>
                            @else
                                <livewire:auth.login />
                            @endauth

                            <button onclick="emptyCart()"
                                class="text-base leading-none  py-3 bg-red-600 border-white border focus:outline-none  focus:ring-0 text-white hover:text-gray-200 hover:bg-red-500 w-1/3 font-bold uppercase rounded-md">
                                <span class="fas fa-trash-alt  "></span>
                                <span>Vaciar</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function removeItemFromCart(item) {
                const id = item;

                //Remove item with index id from localStorage cart
                let cart = JSON.parse(localStorage.getItem('cart'));
                delete cart[id];
                localStorage.setItem('cart', JSON.stringify(cart));

                //update the cart on Livewire
                Livewire.emit('updatedCart', cart);
                Livewire.emit('alert', 'Producto Removido');

            }

            function emptyCart() {
                localStorage.removeItem('cart');
                Livewire.emit('updatedCart', {});
                Livewire.emit('alert', 'Carrito Vacío', null, 'center');
            }

            function tryConfirm(dataUrl) {
                Swal.fire({
                    title: 'Confirmar',
                    html: `<input type="text" id="name" class="swal2-input !w-48" placeholder="Nombre">
                            <input type="number" id="phone" class="swal2-input !w-48" placeholder="No. Celular">`,
                    confirmButtonText: 'Confirmar',
                    focusConfirm: false,
                    preConfirm: () => {
                        const name = Swal.getPopup().querySelector('#name').value
                        const phone = Swal.getPopup().querySelector('#phone').value
                        if (!name || !phone) {
                            Swal.showValidationMessage(`Por favor, llene los campos`)
                        }
                        return {
                            name: name,
                            phone: phone
                        }
                    }
                }).then((result) => {
                    let cart = JSON.parse(localStorage.getItem('cart'));
                    let imageUrl = dataUrl;
                    Livewire.emit('confirmShopping', result.value, cart, imageUrl);
                })

            }

            async function orderImage() {
                $('#loading').toggleClass('hidden');
                setTimeout(() => {
                    htmlToImage
                        .toJpeg(document.getElementById("orderDiv"))
                        .then(function(dataUrl) {
                            $('#loading').toggleClass('hidden');
                            return dataUrl;
                        }).then(function(dataUrl) {
                            tryConfirm(dataUrl);

                        });
                }, 1000);

            }
        </script>
    </div>
