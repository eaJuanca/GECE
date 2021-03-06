<!DOCTYPE html>
<html>
<head>
    <title>Gestión Cementerio</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Includes CSS comunes a todas las interfaces -->

    <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/material.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ URL::asset('lolibox/dist/css/LobiBox.min.css') }}">
    <!-- CSS for steps wizzard -->


    <!-- Fin include comunes -->

    @yield('css')

    <style>
        html, body {
            height: 100%;
        }

        .container{
            min-height: 100%;

        }
    </style>

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

<script src="{{ URL::asset('assets/js/jquery-2.1.4.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/material.js') }}"></script>
<script src="{{ URL::asset('assets/js/ripples.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.validate.js') }}"></script>
<script src="{{ URL::asset('assets/js/validacionNif.js') }}"></script>

<!-- <script type="text/javascript" src=" {{ URL::asset('DataTables/datatables.min.js')}}"></script> -->

<script src="{{ URL::asset('lolibox/dist/js/lobibox.min.js') }}"></script>
<script src="{{ asset('datepickersandbox/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('datepickersandbox/locales/bootstrap-datepicker.es.min.js') }}"></script>

<!-- JS for steps wizzard -->

<!---- Fin JS for steps wizzard-->


<!-- Fin includes comunes Jquery-->
@yield('jquery')
@yield('js')
</html>
