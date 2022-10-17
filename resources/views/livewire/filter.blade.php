<div class="flex space-x-2 h-full items-center px-4n select-none">
    <div x-data="{ open: false }" @click.away="open=false">
        <div class="px-4 ">
            <button @click="open = !open"
                class="ml-4 rounded-xl px-4 py-1 flex space-x-2 items-center hover:text-white hover:bg-primary">
                <span class="far fa-sliders-h"></span>
                <span>Filtrar</span>
            </button>

        </div>
        <div class="fixed left-0 top-32 bottom-2 w-48 transition-all duration-300 ease-linear transform  z-10 shadow-xl rounded-xl bg-white"
            :class="open ? 'translate-x-0' : '-translate-x-52'">
            <!-- Component Start -->
            <div class="py-4">
                <h1 class="text-center font-bold text-lg">
                    Filtrar Productos
                </h1>
            </div>
            <div class="flex flex-col w-48">
                <button class="group border-t border-r border-l  focus:outline-none">
                    <div class="flex items-center justify-between h-12 px-3 font-semibold hover:bg-gray-200">
                        <span class="truncate">Categorías</span>
                        <span class="fas fa-chevron-down "></span>
                    </div>
                    <div class="max-h-0 overflow-hidden duration-300 group-focus:max-h-40">
                        @foreach ($categories as $id => $category)
                            <span wire:click="filterCat('{{ $id }}')"
                                class="flex items-center h-8 px-4 text-sm hover:bg-gray-200 {{ in_array($id, $selectedCategories) ? 'text-primary font-bold' : '' }}">
                                {{ $category }}
                            </span>
                        @endforeach
                    </div>
                </button>
                <button class="group border-t border-r border-l  focus:outline-none">
                    <div class="flex items-center justify-between h-12 px-3 font-semibold hover:bg-gray-200">
                        <span class="truncate">Precio</span>
                        <span class="fas fa-chevron-down "></span>
                    </div>
                    <div
                        class="max-h-0 flex flex-col space-y-2 px-3  overflow-hidden duration-300 group-focus:max-h-96 focus-within:max-h-96 text-sm">
                        <div class="flex items-center space-x-2 text-left">
                            <div class="flex flex-col space-y-1">
                                <label for="fromPrice">Desde $</label>
                                <input type="range" min="0" max="500" step="10" id="fromPrice"
                                    wire:model.defer="fromPrice"
                                    class="form-range appearance-none w-full h-6 p-0 bg-transparent focus:outline-none focus:ring-0 focus:shadow-none">
                            </div>
                            <small data-target="fromPrice">
                                {{ $fromPrice }}
                            </small>
                        </div>
                        <div class="flex items-center space-x-2 text-left">
                            <div class="flex flex-col space-y-1">
                                <label for="toPrice">Hasta $</label>
                                <input type="range" min="0" max="500" step="10" id="toPrice"
                                    wire:model.defer="toPrice"
                                    class="form-range appearance-none w-full h-6 p-0 bg-transparent focus:outline-none focus:ring-0 focus:shadow-none">
                            </div>
                            <small data-target="toPrice">
                                {{ $toPrice }}
                            </small>
                        </div>
                        <div
                            class="flex justify-start text-center bg-gray-100 text-primary hover:bg-primary hover:text-gray-100 rounded-lg">
                            <span wire:click="filter" class="w-full px-2 py-1 z-10">
                                Aplicar
                            </span>
                        </div>
                    </div>
                </button>


                <!-- Component End  -->

            </div>
        </div>
    </div>
</div>
