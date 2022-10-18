<div class="relative w-full  md:max-w-[14rem] mx-auto" x-init x-data="{ showPrice: false }">
    <div class="relative w-full md:w-[14rem] h-[15rem] mx-auto bg-white rounded-lg overflow-hidden shadow-lg p-2  card"
        @click.away="showPrice= false">
        <img class="h-28 w-28 mx-auto rounded-full transition-all ease-linear duration-300 hover:scale-110 transform"
            src="{{ $prod->image }}" alt="">
        <h1 class="mt-6 font-bold text-lg w-full overflow-hidden overflow-ellipsis whitespace-nowrap text-primary">
            {{ $prod->name }} </h1>
        <h1 class="text-right font-bold text-lg w-full overflow-hidden overflow-ellipsis whitespace-nowrap">
            {{ optional($prod->category)->name }}</h1>
            <span x-on:click="showPrice = true"
            class="text-green-600 cursor-pointer text-xl bottom-2 left-2 absolute font-bold ">{{ $prod->stock->formatted_price }}</span>
            <button x-on:click="showPrice = true" wire:click="addProductToCart" class="button_cart">
                <span class="text-green-600 cursor-pointer text-xl fas fa-cart-plus bottom-2 right-2 absolute"></span>
            </button>
        <div class="absolute left-0 w-full  bg-white py-2.5 px-2 shadow-[0px -3px 10px 0px] transition-all ease-linear duration-300  content "
            :class="showPrice ? 'bottom-0' : '-bottom-[50%]'">
            <div class="flex justify-between">
                <div class="">
                    <span class="text-[22px] font-[500]">{{ strtok($prod->name, ' ') }}</span>
                    <p class="text-gray-700 text[17px] font-[400] overflow-hidden overflow-ellipsis whitespace-nowrap">
                        {{ substr($prod->name, strpos(trim($prod->name), ' ') + 1) }}</p>
                </div>
                <div class="text-primary text-xl font-bold">{{ $prod->stock->formatted_price }}</div>
            </div>
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
