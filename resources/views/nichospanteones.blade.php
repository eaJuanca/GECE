@extends('master')

@section('title') <h2 style="color: white; font-weight: bold; margin-left:10px; "> Nichos Panteones </h2>

<p class="pull-right"><a href="{{ URL::route('home') }}" class="btn btn-md btn-material-orange back glyphicon glyphicon glyphicon-arrow-left"></a></p>

@endsection

@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">

    <style>

        a:hover{
            cursor: pointer;
        }


        .disabled{

            cursor: pointer !important;
        }

        .bold{
            color: white;
            font-size: 12px;
        }


    </style>

@endsection

@section('contenido')

    <br>

    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="home">
            <div class="row" style="margin-top: 1%">

                <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="panel panel-default">
                        <div class="panel-heading"><span style="font-weight: bold">Difuntos en el panteon</span>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover" cellspacing="10" cellpadding="10">
                                    <thead>
                                    <tr>
                                        <th>Datos del nicho</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody class="tdisponibles">

                                    <?php if(isset($disponibles)) { ?>

                                    @foreach($disponibles as $disponible)

                                        <tr>
                                            <td> {{$disponible->id}}</td>
                                            <td> {{$disponible->tipo}}</td>
                                            <td> Calle: <span style="font-weight: bold">{{$disponible->nombre_calle}}, </span>
                                                Altura, <span style="font-weight: bold">{{$disponible->altura}} </span>
                                                Numero <span style="font-weight: bold">{{$disponible->numero}} </span> </td>

                                            <td> <a href="{{ route('modificar-nichos',[$disponible->id])}}"><i class="fa fa-lg fa-pencil-square-o"></i></a></td>

                                        </tr>

                                    @endforeach

                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="paginacion" style="float: right"></div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('jquery')
    <script src="{{ asset('assets/js/bootpag.min.js') }}"></script>


    <script type="text/javascript">

        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        var count = "{{$td}}"; //variable para contar el total de franquicias y mostrar en relacion con el n? de paginas
        var paginas = 0;
        if (count % 10 != 0) {
            paginas = Math.floor(count / 10) + 1;
        } else {
            paginas = count / 10; //4 es el n?mero de items que queremos que aparezcan.
        }

        var count2 = "{{$tnd}}"; //variable para contar el total de franquicias y mostrar en relacion con el n? de paginas
        var paginas2 = 0;
        if (count2 % 10 != 0) {
            paginas2 = Math.floor(count2 / 10) + 1;
        } else {
            paginas2 = count2 / 10; //4 es el número de items que queremos que aparezcan.
        }

        var tab = "{{$tab}}";
        var search = "{{$search}}";

        if(search == 1){
            if(tab==1){
                $('.button2').hide();
            }
            else{
                $('.button1').hide();
            }
        }

        $(document).ready(function () {


            var titular = "{{$titular}}";
            var difunto = "{{$difunto}}";
            var numero = "{{$numero}}";
            var calle = "{{$calle}}";
            var dni = "{{$dni}}";
            var tramada = "{{$tramada}}";


            if(search == 1){ $('#search').css('visibility','visible');$('#nota').css('display','block'); }

            if(tab==2) {

                $('#myTab a[href="#profile"]').tab('show');// Select tab by name
                $("#button2").removeClass('disabled'); $("#button1").addClass('disabled'); $('#activa').val(2);

                $("#titular").show();
                $("#difunto").show();
                $("#dnibuscar").show();

            }else{

                $("#titular").hide();
                $("#difunto").hide();
                $("#dnibuscar").hide();
            }

            $('.paginacion').bootpag({
                total: paginas,
                page: 1,
                maxVisible: 5,
                leaps: true,
                firstLastUse: true,
                first: 'Primero',
                last: 'Ultimo',
                wrapClass: 'pagination',
                activeClass: 'active',
                disabledClass: 'disabled',
                nextClass: 'next',
                prevClass: 'prev',
                lastClass: 'last',
                firstClass: 'first'

            }).on("page", function (event, num) {

                var ruta = "";
                var data = "";

                //si no es una busqueda paginamos to-do

                if(search==0) {

                    ruta = "{{ URL::route('paginateDisponibles') }}";
                    data = {page: num};
                }

                //si es una busqueda, paginamos los resultados
                else{

                    ruta = "{{ URL::route('paginateDisponiblesBusqueda') }}";
                    data = { page: num, tramada:tramada, numero: numero, calle: calle };
                }

                //variable de conexion, para cancelar las conexiones anteriores antes de lanzar otra
                var httpR;

                $.ajax({

                    type: "post",
                    url: ruta,
                    data: data,
                    dataType: "html",

                    beforeSend: function(data2){
                        /*httpR es la variable global donde guardamos la conexion*/
                        if(httpR){
                            /*Si habia alguna conexion anterior, la cancelamos*/
                            httpR.abort();
                        }
                        /*Guardamos la nueva conexion*/
                        httpR = data2;
                    },
                    error: function () {
                        alert("Error en la petición");
                    },
                    success: function (data) {

                        $(".tdisponibles").html(data);


                    }
                });
            });


            $('.paginacion2').bootpag({
                total: paginas2,
                page: 1,
                maxVisible: 5,
                leaps: true,
                firstLastUse: true,
                first: 'Primero',
                last: 'Ultimo',
                wrapClass: 'pagination',
                activeClass: 'active',
                disabledClass: 'disabled',
                nextClass: 'next',
                prevClass: 'prev',
                lastClass: 'last',
                firstClass: 'first'

            }).on("page", function (event, num) {



                var ruta = "";
                var data = "";

                //si no es una busqueda paginamos to-do

                if(search==0) {

                    data = {page: num};
                    ruta = "{{ URL::route('paginateNoDisponibles') }}";
                }

                //si es una busqueda, paginamos los resultados
                else{

                    ruta = "{{ URL::route('paginateNoDisponiblesBusqueda') }}";
                    data = { page: num, titular: titular, difunto: difunto, numero: numero, calle: calle, dni: dni, tramada: tramada };
                }

                //variable de conexion, para cancelar las conexiones anteriores antes de lanzar otra
                var httpR;

                $.ajax({

                    type: "post",
                    url: ruta,
                    data: data,
                    dataType: "html",

                    beforeSend: function(data2){
                        /*httpR es la variable global donde guardamos la conexion*/
                        if(httpR){
                            /*Si habia alguna conexion anterior, la cancelamos*/
                            httpR.abort();
                        }
                        /*Guardamos la nueva conexion*/
                        httpR = data2;
                    },

                    error: function () {
                        alert("Error en la petición");
                    },

                    success: function (data) {
                        $(".tndisponibles").html(data);
                    }
                });
            });
        });

        $(".button2").click(function(){ $("#button2").removeClass('disabled'); $("#button1").addClass('disabled'); $('#activa').val(2); $("#titular").show(); $("#difunto").show(); $("#dnibuscar").show();  });
        $(".button1").click(function(){ $("#button1").removeClass('disabled'); $("#button2").addClass('disabled'); $('#activa').val(1);  $("#titular").hide(); $("#difunto").hide(); $("#dnibuscar").hide(); });



    </script>

    <script>

        function borrar(id) {

            if (confirm('Realmente desea borrar el difunto con id ' + id + '?')) {
                $(".difunto" + id).hide();
            }
        }

        function modal(id){

            var httpR;

            $.ajax({

                type: "post",
                url: "{{ URL::route('getData') }}",
                data: {id: id},
                dataType: "json",

                beforeSend: function(data2){
                    /*httpR es la variable global donde guardamos la conexion*/
                    if(httpR){
                        /*Si habia alguna conexion anterior, la cancelamos*/
                        httpR.abort();
                    }
                    /*Guardamos la nueva conexion*/
                    httpR = data2;
                },
                error: function () {
                    alert("Error en la petición");
                },
                success: function (data) {

                    $('#cargando').hide();

                    var total = data['total'];
                    var fecha = data['fecha'];
                    var cumplefecha = data['cumplefecha'];
                    var cumpletotal = data['cumpletotal'];

                    if(!cumplefecha || !cumpletotal){ $('#modalfras1').css('display','block'); }
                    if(cumplefecha && cumpletotal){ $('#modalfras2').css('display','block'); }
                    if(!cumpletotal){ $('#modalfras3').css('display','block'); }
                    if(!cumplefecha){ $('#modalfras4').css('display','block'); }

                }
            });
        }

        $('#complete-dialog').on('hidden.bs.modal', function () {

            $('#modalfras1').css('display','none');
            $('#modalfras2').css('display','none');
            $('#modalfras3').css('display','none');
            $('#modalfras4').css('display','none');
            $('#cargando').show();

        })

        /**
         * Comentario cambios
         *
         *
         */
    </script>

@endsection
