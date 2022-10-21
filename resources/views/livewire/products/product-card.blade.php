<div class="relative w-full  md:w-[14rem] xl:w-[22rem] mx-auto" x-init x-data="{ showPrice: false }">
    <div class="relative w-full md:[14rem] xl:w-[22rem] h-[15rem] xl:h-[18rem] mx-auto bg-white rounded-lg overflow-hidden border-[0.35px] border-primary p-2  card"
        @click.away="showPrice= false">

        {{-- Discount label --}}
        @if ($prod->stock->discount != '0.00%')
            <div class="flex  items-center absolute top-2 right-2 text-green-600">
                <span class=" text-sm font-bold">{{ $prod->stock->discount }}</span>
                <span class="ml-1 far fa-tag text-xs"></span>
            </div>
        @endif

        {{-- Product Image --}}
        <img class="h-28 w-28 xl:w-32 xl:h-32 mx-auto rounded-full transition-all ease-linear duration-300 hover:scale-110 transform"
            src="{{ $prod->image }}" alt="">

        {{-- Product name & category out box --}}
        <h1
            class="mt-6 font-bold text-lg xl:text-2xl  w-full overflow-hidden overflow-ellipsis whitespace-nowrap text-primary">
            {{ $prod->name }} </h1>
        <h1 class="text-right font-bold text-lg xl:text-xl  w-full overflow-hidden overflow-ellipsis whitespace-nowrap">
            {{ optional($prod->category)->name }}</h1>

        {{-- Producto price and shopping button out box --}}
        @if ($prod->stock->discount == '0.00%')
            <span x-on:click="showPrice = true"
                class="text-green-600 cursor-pointer text-xl xl:text-4xl bottom-2 left-2 absolute font-bold ">{{ $prod->stock->formatted_price }}</span>
        @else
            <div class="flex justify-between w-3/5 absolute bottom-2 left-2 items-center">
                <span x-on:click="showPrice = true"
                    class="text-green-600 cursor-pointer text-xl xl:text-4xl   font-bold ">{{ $prod->stock->formatted_special }}</span>
                <span x-on:click="showPrice = true"
                    class="text-gray-500 cursor-pointer line-through text-base xl:text-lg font-bold ">{{ $prod->stock->formatted_price }}</span>
            </div>
        @endif
        <button x-on:click="showPrice = true" wire:click="addProductToCart" class="button_cart">
            <span
                class="text-green-600 cursor-pointer text-xl xl:text-4xl fas fa-cart-plus bottom-2 right-2 absolute"></span>
        </button>

        {{-- Box details initial hidden --}}
        <div class="absolute left-0 w-full  bg-white py-2.5 px-2 shadow-[0px -3px 10px 0px] transition-all ease-linear duration-300  content "
            :class="showPrice ? 'bottom-0' : '-bottom-[50%]'">
            <div class="flex justify-between">
                <div class="">
                    <span
                        class="text-[22px] xl:text-[28px]  font-[500] md:font-[600]">{{ strtok($prod->name, ' ') }}</span>
                    <p
                        class="text-gray-700 text-[17px] font-[400] xl:text-[20px] xl:font-[500] overflow-hidden overflow-ellipsis whitespace-nowrap">
                        {{ substr($prod->name, strpos(trim($prod->name), ' ') + 1) }}</p>
                </div>
                <div class="text-primary text-xl font-bold">{{ $prod->stock->formatted_price }}</div>
            </div>

            {{-- Shopping controls --}}
            <div
                class="flex mt-5 items-center justify-between text-white bg-primary px-2 py-1 rounded-md select-none buttons">
                <span wire:click="subCant" class="fas fa-minus text-sm cursor-pointer"></span>
                <input type="number" wire:model.defer="cant" wire:keydown.enter="addProductToCart"
                    id="{{ uniqid() }}"
                    class="bg-transparent font-semibold text-sm text-center focus:outline-none input-cart">
                <span wire:click="addCant" class="fas fa-plus text-sm cursor-pointer"></span>
            </div>
        </div>
    </div>

</div>
