<nav class="bg-primary  select-none sticky">
    <div class=" mx-auto px-4" @click.away="showMenu = false" x-data="{ showMenu: false }">
        <div class="flex justify-between">
            <div class="flex space-x-4 lg:space-x-7 w-full justify-between items-center">
                <div>
                    <!-- Website Logo -->
                    <a href="{{ route('home') }}" class="flex items-center py-2 lg:py-4 px-2">
                        <img src="{{ env('LOGO_URL') }}" alt="Logo" class="h-10 lg:h-12 mr-2">
                    </a>
                </div>
                <div class=" ">
                    <livewire:search />
                </div>
                <div class="lg:hidden flex items-center z-30">
                    <button class="outline-none " x-on:click="showMenu = !showMenu">
                        <span x-show="!showMenu" class="fas fa-bars text-xl"></span>
                        <span x-show="showMenu" class="fas fa-times text-xl"></span>
                    </button>
                </div>
                <!-- Primary Navbar items -->
                <div class=" bg-gray-100 lg:bg-transparent top-[4.5rem] rounded-lg lg:rounded-none px-2 lg:px-0 w-44 lg:w-max flex flex-col lg:flex-row lg:items-center space-x-0 space-y-1 lg:space-y-0 lg:space-x-1 fixed lg:relative lg:top-0 right-2   transition ease-linear duration-300"
                    x-bind:class="showMenu ? 'translate-x-0' : 'translate-x-44 lg:translate-x-0'">
                    <a href="{{ route('home') }}"
                        class="py-2 lg:py-4 px-2 font-semibold hover:text-primary transition duration-300  {{ request()->routeIs('home') ? ' text-primary md:text-gray-300 border-b-2 lg:pb-3 border-primary md:border-gray-300 font-semibold' : 'text-gray-500 lg:text-white' }}  ">Home</a>
                    <a href="{{ route('products.index') }}"
                        class="py-2 lg:py-4 px-2  font-semibold hover:text-primary transition duration-300 {{ request()->routeIs('products.*') ? ' text-primary md:text-gray-300 border-b-2 lg:pb-3 border-primary md:border-gray-300 font-semibold' : 'text-gray-500 lg:text-white' }}">Productos</a>
                    <a href=""
                        class="py-2 lg:py-4 px-2 font-semibold hover:text-primary transition duration-300 {{ request()->routeIs('products.offers') ? ' text-primary md:text-gray-300 border-b-2 lg:pb-3 border-primary md:border-gray-300 font-semibold' : 'text-gray-500 lg:text-white' }}">Ofertas</a>
                    <a href=""
                        class="py-2 lg:py-4 px-2 font-semibold hover:text-primary transition duration-300 {{ request()->routeIs('about') ? ' text-primary md:text-gray-300 border-b-2 lg:pb-3 border-primary md:border-gray-300 font-semibold' : 'text-gray-500 lg:text-white' }}">Contactos</a>
                    <div class="w-full h-[1px] bg-primary lg:w-[1px] lg:h-4 lg:bg-gray-100 "></div>
                        @auth
                    <form action="/auth/logout">
                        <button type="submit"
                        class="py-2 lg:py-4 px-2 font-semibold hover:text-primary transition duration-300 {{ request()->routeIs('about') ? ' text-primary md:text-gray-300 border-b-2 lg:pb-3 border-primary md:border-gray-300 font-semibold' : 'text-red-600' }}">Salir</button>
                    </form>
                    @else
                        <livewire:auth.login /> 
                        <livewire:auth.signup/>
                    @endauth
                </div>
            </div>

            <!-- Mobile menu button -->

        </div>
    </div>
    <!-- mobile menu -->


</nav>
