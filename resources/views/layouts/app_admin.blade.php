<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="Vilmar">
    <meta name="author" content="Vilmar">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link rel="icon" type="image/png" href="{{ url()->asset('assets/images/fav.png')}}">

    <link rel="preconnect" href="{{ url()->asset('assets/fonts.googleapis.com/index.html')}}">
    <link rel="preconnect" href="{{ url()->asset('assets/fonts.gstatic.com/index.html')}}" crossorigin>
    <link
        href="{{ url()->asset('assets/fonts.googleapis.com/css25e50.css?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap')}}"
        rel="stylesheet">
    <link href='{{ url()->asset('assets/vendor/unicons-2.0.1/css/unicons.css')}}' rel='stylesheet'>
    <link href="{{ url()->asset('assets/css/style.css')}}" rel="stylesheet">
    
    <link href="{{ url()->asset('assets/css/vertical-responsive-menu.min.css')}}" rel="stylesheet">
    <link href="{{ url()->asset('assets/css/analytics.css')}}" rel="stylesheet">
    
    <link href="{{ url()->asset('assets/css/responsive.css')}}" rel="stylesheet">
    <link href="{{ url()->asset('assets/css/night-mode.css')}}" rel="stylesheet">

    <link href="{{ url()->asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{ url()->asset('assets/vendor/OwlCarousel/assets/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{ url()->asset('assets/vendor/OwlCarousel/assets/owl.theme.default.min.css')}}" rel="stylesheet">
    <link href="{{ url()->asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ url()->asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{ url()->asset('assets/css/customs.css')}}" rel="stylesheet">
    
    
    <link href="{{ url()->asset('assets/vendor/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{ url()->asset('assets/vendor/chartist-plugin-tooltip/dist/chartist-plugin-tooltip.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ url()->asset('assets/datatables.min.css')}}"/>
    

    @stack('styles')

    @notifyCss
</head>

<body class="d-flex flex-column h-100">

    @include('layouts.partials.header')

    <x:notify-messages />

    @yield('content')
    
    @include('layouts.partials.footer')

    
    
    <script src="{{ url()->asset('assets/js/vertical-responsive-menu.min.js')}}"></script>
    <script src="{{ url()->asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    
    
    <script src="{{ url()->asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ url()->asset('assets/vendor/OwlCarousel/owl.carousel.js')}}"></script>
    <script src="{{ url()->asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    
    
    <script src="{{ url()->asset('assets/vendor/chartist/dist/chartist.min.js')}}"></script>
    <script src="{{ url()->asset('assets/vendor/chartist-plugin-tooltip/dist/chartist-plugin-tooltip.min.js')}}"></script>
    

    
    <script src="{{ url()->asset('assets/js/custom.js')}}"></script>
    <script src="{{ url()->asset('assets/js/night-mode.js')}}"></script>
    <script src="{{ url()->asset('assets/js/customs.js')}}"></script>

    <script type="text/javascript" src="{{ url()->asset('assets/datatables.min.js')}}"></script>

    @stack('scripts')

    @notifyJs
</body>

</html>