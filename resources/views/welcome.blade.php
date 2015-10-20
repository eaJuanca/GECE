<!DOCTYPE html>
<html>
    <head>
        <title>Gestión Cementerio</title>


        <!-- Includes CSS comunes a todas las interfaces -->

        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/css/material.min.css') }}" rel="stylesheet">

        <!-- Fin include comunes -->

        @yield('css')

    </head>

    <body>
        <div class="container">
            <div class="row"></div>
            <div class="row"></div>
        </div>
    </body>
    <script src="{{ URL::asset('assets/js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/material.js') }}"></script>
    <script src="{{ URL::asset('assets/js/material.js') }}"></script>
    <script src="{{ URL::asset('assets/js/ripples.js') }}"></script>


    <script type="text/javascript">
        $.material.init();
    </script>


</html>
