<div class="w-full lg:w-60 h-full py-2 px-4 md:p-4 relative shadow-md rounded-md bg-white">
    <div
        class="px-2 py-1 bg-gray-50 top-0 right-0  left-0 flex justify-between text-xs text-primary font-bold rounded-lg  absolute">
        <span class="font-bold text-sm">{{ optional($prod->category)->name }}</span>
        @if ($prod->stock->discount != '0.00%')
            <div class="flex space-x-1 items-center text-green-600 ">
                <span class="fas fa-badge-percent text-base"></span>
                <span>{{ $prod->stock->discount }}</span>
            </div>
        @endif
    </div>
    <a href="{{ route('products.show', $prod->id) }}">
        <div class="w-full  h-36 bg-center bg-80% mb-4 bg-clip-content p-4 bg-no-repeat"
            style="background-image: url({{ $prod->image }})">

        </div>
    </a>
    <div class="flex flex-col space-y-1 mb-4">
        <span class="font-semibold text-base">
            @if ($prod->stock->discount != '0.00%')
                <div class="flex space-x-2">
                    <span>{{ $prod->stock->formatted_special }}</span>
                    <span class="line-through text-gray-400">{{ $prod->stock->formatted_price }}</span>
                </div>
            @else
                {{ $prod->stock->formatted_price }}
            @endif
        </span>
        <span class="font-semibold text-gray-600 text-sm">
            {{ ellipsis($prod->name, 28) }}
        </span>
    </div>
    <div class="">
        <div class="flex items-center justify-between text-white bg-primary px-2 py-1 rounded-md select-none">
            <span wire:click="subCant" class="fas fa-minus text-sm cursor-pointer"></span>
            <input type="number" wire:model.defer="cant" wire:keydown.enter="addProductToCart"
                id="{{ uniqid() }}" class="bg-transparent font-semibold text-sm text-center focus:outline-none">
            <span wire:click="addCant" class="fas fa-plus text-sm cursor-pointer"></span>
        </div>
    </div>

</div>
