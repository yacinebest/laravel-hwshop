<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Hwshop</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">


        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/frontend/navbar.css') }}" rel="stylesheet">
        <link href="{{ asset('css/frontend/footer.css') }}" rel="stylesheet">
        <link href="{{ asset('css/frontend/cart.css') }}" rel="stylesheet">

        @yield('links')

    </head>
    <body>
        <div id='app'>
            @include('frontend.layouts.navbars.navbar')
            <div class="main-content">

                {{-- <div class="main-content" style="height: 1000px;">

                </div> --}}
                @yield('content')
            </div>

            @include('frontend.layouts.footers.footer')

        </div>


        @stack('js')
        <script src="{{ asset('js/app.js') }}"></script>

        <script src="{{ asset('js/frontend/navigationbar.js') }}"></script>
        <!-- show cart-->
        <script src="{{ asset('js/frontend/cart.js') }}"></script>

        @yield('scripts')
    </body>
</html>
