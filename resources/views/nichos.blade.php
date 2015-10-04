@extends('master')

@section('title') <h2 style="color: white; font-weight: bold; margin-left:10px; "> Nichos </h2> @endsection

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

    <div class="row" style="margin-top: 2%">

        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="panel panel-default">
                <div class="panel-heading">Formulario de busqueda</div>
                <div class="panel-body">

                    <form method="POST" action="{{URL::route('busquedaNichos')}}">

                        <div class="row">
                            <section class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <input type="hidden"  id="activa" name="activa" value="1">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">


                                <div class="row">
                                    <div  id="titular" class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Nombre de titular</label>
                                            <input type="text" class="form-control" name="titular" value="<?php if(isset($titular)) echo $titular; else $titular=''; ?>">
                                        </div>
                                    </div>

                                    <div id="difunto" class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Nombre del difunto</label>
                                            <input type="text" class="form-control"  name="difunto" value="<?php if(isset($difunto)) echo $difunto; else $difunto=''; ?>">
                                        </div>
                                    </div>

                                </div>



                                <div class="row">
                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Nombre de calle</label>
                                            <input type="text" class="form-control" name="calle" value="<?php if(isset($calle)) echo $calle;  else $calle='';?>">
                                        </div>
                                    </div>


                                    <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Numero de calle</label>
                                            <input type="text" class="form-control" name="numero" value="<?php if(isset($numero)) echo $numero; else $numero=''; ?>">
                                        </div>
                                    </div>

                                    <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <br>
                                            <button type="submit" class="btn btn-primary btn-raised">Buscar</button>
                                            <a id='search' href="{{URL::route('nichos')}}" class="btn btn-danger btn-raised" style="visibility: hidden">Terminar</a>
                                        </div>
                                    </div>

                                </div>

                                <div class="row" id="nota" style="display: none">
                                    <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <span style="font-weight: bold; font-size: 16px">A continuacion se muestran los resultados de busqueda. Pulse <span style="color: red">terminar</span> para finalizar</span>

                                        </div>
                                </div>

                            </section>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <ul id="myTab" class="nav nav-tabs" style="margin-bottom: 15px;">
        <li class="active button1"><a href="#home" data-toggle="tab"><button id="button1" class="btn btn-warning btn-raised button1"><span class="bold">Nichos disponibles (<?php if(isset($td)) echo $td; else $td=0 ?>)</span></button></a></li>
        <li class="button2"><a href="#profile" data-toggle="tab"><button  id="button2" class="btn btn-warning disabled button2"><span class="bold">Nichos no disponibles (<?php if(isset($tnd)) echo $tnd; else $tnd=0 ?>)</span></button></a></li>
    </ul>

    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="home">
            <div class="row" style="margin-top: 1%">

                <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="panel panel-default">
                        <div class="panel-heading"><span style="font-weight: bold">Difuntos registrados en el sistema</span>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover" cellspacing="10" cellpadding="10">
                                    <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Cod.</th>
                                        <th>Datos del nicho</th>
                                        <th>Tarifa</th>
                                        <th>Banco</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody class="tdisponibles">

                                    <?php if(isset($disponibles)) { ?>

                                    @foreach($disponibles as $disponible)

                                        <tr>
                                            <td> {{$disponible->tipo}}</td>
                                            <td> {{$disponible->id}}</td>
                                            <td> Calle: <span style="font-weight: bold">{{$disponible->nombre_calle}}, </span>
                                                 Altura, <span style="font-weight: bold">{{$disponible->altura}} </span>
                                                 Numero <span style="font-weight: bold">{{$disponible->numero}} </span> </td>
                                            <td> {{$disponible->tarifa}}</td>
                                            <td>
                                                @if($disponible->banco == null)
                                                    <i class="fa fa-lg fa-times" style="color:red"></i>
                                                @else
                                                   {{$disponible->banco}}
                                                @endif
                                            </td>
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
        <div class="tab-pane fade" id="profile">
            <div class="row" style="margin-top: 1%">

                <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="panel panel-default">
                        <div class="panel-heading"><span style="font-weight: bold">Difuntos registrados en el sistema</span>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover" cellspacing="10" cellpadding="10">
                                    <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Cod.</th>
                                        <th>Titular</th>
                                        <th>Telefono</th>
                                        <th>Calle</th>
                                        <th>Tarifa</th>
                                        <th>Banco</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody class="tndisponibles">

                                    <?php if(isset($nodisponibles)) { ?>

                                    @foreach($nodisponibles as $nodisponible)

                                        <tr>
                                            <td> {{$nodisponible->tipo}}</td>
                                            <td> {{$nodisponible->id}}</td>
                                            <td> {{$nodisponible->nombre_titular}}</td>
                                            <td> {{$nodisponible->telefono}}</td>
                                            <td> Calle: <span style="font-weight: bold">{{$nodisponible->nombre_calle}}, </span>
                                                Altura, <span style="font-weight: bold">{{$nodisponible->altura}} </span>
                                                Numero <span style="font-weight: bold">{{$nodisponible->numero}} </span> </td>
                                            <td>
                                                @if($nodisponible->banco == null)
                                                    <i class="fa fa-lg fa-times" style="color:red"></i>
                                                @else
                                                    {{$nodisponible->banco}}
                                                @endif
                                            </td>
                                            <td> {{$nodisponible->tarifa}}</td>

                                            <td> <a title="Modificar Nicho" href="{{ route('modificar-nichos',[$nodisponible->id])}}"><i class="fa fa-lg fa-pencil-square-o"></i></a>
                                                 <a title="Ver Nicho" data-toggle="modal" data-target="#complete-dialog" onclick='modal({{$nodisponible->id}})'><i class="fa fa-lg fa-search"></i></a>
                                                 <a title="A�adir Difunto" href="{{ route('alta-difunto-nicho',[$nodisponible->id])}}"><i class="fa fa-lg fa-user-plus"></i></a>
                                            </td>

                                        </tr>

                                        @endforeach

                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="paginacion2" style="float: right"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="complete-dialog" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Condiciones</h4>
                </div>
                <div class="modal-body">

                    <p id="cargando">Espere...</p>
                    <p id="modalfras1" style="font-size: 20px; display: none">No se puede enterrar mas difuntos en este nicho</p>

                    <p id="modalfras2" style="font-size: 20px; display: none; color: green">Se cumplen las condiciones para enterrar un nuevo difunto </p> <br>

                    <span id="modalfras3" style="font-weight: bold; color: red ; display: none" > Se ha llegado al total de difuntos por nicho</span> <br>

                    <span  id="modalfras4" style="font-weight: bold;  color: red; display: none"> No han pasado 4 años desde la ultima inhumacion</span>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">Cerrar</button>
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

        var count = "{{$td}}"; //variable para contar el total de franquicias y mostrar en relacion con el n� de paginas
        var paginas = 0;
        if (count % 10 != 0) {
            paginas = Math.floor(count / 10) + 1;
        } else {
            paginas = count / 10; //4 es el n�mero de items que queremos que aparezcan.
        }

        var count2 = "{{$tnd}}"; //variable para contar el total de franquicias y mostrar en relacion con el n� de paginas
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


            if(search == 1){ $('#search').css('visibility','visible');$('#nota').css('display','block'); }

            if(tab==2) {

                $('#myTab a[href="#profile"]').tab('show');// Select tab by name
                $("#button2").removeClass('disabled'); $("#button1").addClass('disabled'); $('#activa').val(2);

                $("#titular").show();
                $("#difunto").show();

            }else{

                $("#titular").hide();
                $("#difunto").hide();
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
                    data = { page: num, titular: titular, difunto: difunto, numero: numero, calle: calle };
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
                    data = { page: num, titular: titular, difunto: difunto, numero: numero, calle: calle };
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

        $(".button2").click(function(){ $("#button2").removeClass('disabled'); $("#button1").addClass('disabled'); $('#activa').val(2); $("#titular").show(); $("#difunto").show();  });
        $(".button1").click(function(){ $("#button1").removeClass('disabled'); $("#button2").addClass('disabled'); $('#activa').val(1);  $("#titular").hide(); $("#difunto").hide(); });



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
