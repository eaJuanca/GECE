@extends('master')

@section('title')
    <h2 style="color: white; font-weight: bold; margin-left:10px; "> Recibos </h2>
@endsection

@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('datepickersandbox/css/bootstrap-datepicker3.min.css') }}">

@endsection

@section('contenido')


@endsection

@section('js')

    <script type="text/javascript">

        $(document).ready(function () {

            var token = "{{ csrf_token()}}";

            $("#form_alta").submit(function (e) {

                //Comprobamos que las contraseñas coinciden primero

                var pass = $(".password").val();
                var repass = $(".repassword").val();


                if(pass == repass){

                    e.preventDefault();

                    $.ajax({
                        type: "GET",
                        url: "{{ URL::route('nueva_alta') }}",
                        data: $("#form_alta").serialize(),
                        dataType: "html",
                        error: function () {
                            Lobibox.notify('error', {
                                title: 'No se ha podido crear el usuario',
                                showClass: 'flipInX',
                                delay: 3000,
                                delayIndicator: false,

                                position: 'bottom left',
                                msg: 'Compruebe la conexión a internet'
                            });
                        },
                        success: function (data) {

                            Lobibox.notify('success', {
                                title: 'Usuario creado',
                                showClass: 'flipInX',
                                delay: 3000,
                                delayIndicator: false,
                                position: 'bottom left'
                            });

                            location.reload();
                        }
                    });


                }else{
                    alert("Las contraseñas no coinciden")
                }
            });
        });

    </script>

@endsection




