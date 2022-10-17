<div>
    <form action="" wire:submit.prevent="search">
        <div
            class="relative pl-4 transition-all ease-linear duration-75 border-gray-200 focus-within:border-primary active:border-primary rounded-xl bg-gray-200 focus:bg-white  border shadow-lg">
            <button>
                <span class="fas fa-search text-gray-400 hover:text-primary cursor-pointer"></span>
            </button>
            <input type="search" wire:model.debounce.500ms="search" list="searchList"
                class=" px-2 md:px-4 text-sm md:text-base w-[10.5rem] md:w-96  py-2  focus:outline-none placeholder:font-bold placeholder:text-gray-400 bg-transparent text-black  focus:ring-0"
                placeholder="Buscar producto">
            @if ($search && strlen($search) > 2)
                <datalist id="searchList">
                    @foreach ($names as $name)
                        <option value="{{ $name }}">
                    @endforeach
                </datalist>
            @endif
        </div>
    </form>
</div>
