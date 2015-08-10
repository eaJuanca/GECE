<!DOCTYPE html>
<html>
<head>
    <title>Gestión Cementerio</title>


    <!-- Includes CSS comunes a todas las interfaces -->

    <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/material.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Fin include comunes -->

    @yield('css')

</head>

<body>

<div class="container well-material-teal">

    <!-- Include de la cabezera-->

    @include('extras.header')

    <!-- fin include cabecera -->

    <!-- Seccion contenido -->

    @yield('contenido')

    <!-- fin seccion contendio -->

</div>
</body>

    <!-- Includes comunes Jquery -->

        <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('assets/js/material.js') }}"></script>
        <script src="{{ URL::asset('assets/js/material.js') }}"></script>
        <script src="{{ URL::asset('assets/js/ripples.js') }}"></script>

    <!-- Fin includes comunes Jquery-- >
        @yield('jquery')


    <script type="text/javascript">

    </script>

</html>
