<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Icons & Fonts -->
    <link rel="stylesheet" href="{{ asset('src/fa/css/all.css') }}">


    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/twel.min.css'])
    <script src="//unpkg.com/alpinejs" defer></script>

    @livewireStyles
</head>

<body x-init x-cloak class=" bg-center bg-cover bg-no-repeat bg-fixed " style="background-image: url({{env('CARNE_FONDO')}})">
    <div class="hidden" id="loading">
        <x-loading></x-loading>
    </div>
    <div class="sticky top-0 z-30 bg-white">
        @include('includes.navbar')
        @isset($secondbar)
            @include('includes.secondbar')
        @endisset

    </div>
    <main class="p-4 bg-white bg-opacity-90 ">
        <livewire:carts.cart-preview />
        {{ $slot }}
    </main>
    @livewireScripts
    @stack('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        // localStorage.clear();
      
    </script>
</body>

</html>
