@extends('master')

@section('title') <h2 style="color: white; font-weight: bold; margin-left:10px; "> Panteones </h2>

<p class="pull-right"><a href="{{ URL::route('home') }}" class="btn btn-md btn-material-orange back fa fa-reply"></a></p>

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

    <div class="row" style="margin-top: 2%">

        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="panel panel-default">
                <div class="panel-heading">Formulario de búsqueda</div>
                <div class="panel-body">

                    <form method="POST" action="{{URL::route('busquedaPanteones')}}">

                        <div class="row">
                            <section class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <input type="hidden"  id="activa" name="activa" value="1">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">


                                <div class="row">
                                    <div  id="titular" class="col col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Nombre de titular</label>
                                            <input type="text" class="form-control" name="titular" value="<?php if(isset($titular)) echo $titular; else $titular=''; ?>">
                                        </div>
                                    </div>

                                    <div  id="dnibuscar" class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Dni</label>
                                            <input type="text" class="form-control" name="dni" value="<?php if(isset($dni)) echo $dni; else $dni=''; ?>">
                                        </div>
                                    </div>

                                </div>


                                <div class="row">



                                    <div class="col col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Nombre de calle</label>
                                            <input type="text" class="form-control" name="calle" value="<?php if(isset($calle)) echo $calle;  else $calle='';?>">
                                        </div>
                                    </div>

                                    <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Número de calle</label>
                                            <input type="text" class="form-control" name="numero" value="<?php if(isset($numero)) echo $numero; else $numero=''; ?>">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col col-lg-10 col-md-10 col-sm-12 col-xs-12" style="margin-top: 20px">

                                        <span id='search' style="font-weight: bold; font-size:16px; visibility: hidden; ">A continuación se muestran los resultados de búsqueda. Pulse <a  href="{{URL::route('panteones')}}" class="btn btn-danger btn-raised btn-xs" style="letter-spacing: 3px">Terminar</a> para finalizar</span>

                                    </div>

                                    <div class="col col-lg-2 col-md-2 col-sm-12 col-xs-12 pull-right">
                                        <div class="form-group">
                                            <br>
                                            <button type="submit" class="btn btn-primary btn-raised">Buscar</button>
                                        </div>
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
        <li class="active button1"><a href="#home" data-toggle="tab"><button id="button1" class="btn btn-warning btn-raised button1"><span class="bold">Parcelas disponibles (<?php if(isset($td)) echo $td; else $td=0 ?>)</span></button></a></li>
        <li class="button2"><a href="#profile" data-toggle="tab"><button  id="button2" class="btn btn-warning disabled button2"><span class="bold">Parcelas no disponibles (<?php if(isset($tnd)) echo $tnd; else $tnd=0 ?>)</span></button></a></li>
    </ul>

    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="home">
            <div class="row" style="margin-top: 1%">

                <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="panel panel-default">
                        <div class="panel-heading"><span style="font-weight: bold">Parcelas registradas en el sistema</span>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover" cellspacing="10" cellpadding="10">
                                    <thead>
                                    <tr>
                                        <th>Datos de las parcelas</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody class="tdisponibles">

                                    <?php if(isset($disponibles)) { ?>

                                    @foreach($disponibles as $disponible)

                                        <tr>

                                            <td> Calle: <span style="font-weight: bold">{{$disponible->calle}}, </span>
                                                 Numero <span style="font-weight: bold">{{$disponible->numero}} </span> </td>

                                            <td> <a href="{{ route('modificar-panteones',[$disponible->parcela_id])}}"><i class="fa fa-lg fa-pencil-square-o"></i> Adquirir Parcela</a> </td>

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
                                        <th>Titular</th>
                                        <th>DNI</th>
                                        <th>Calle</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody class="tndisponibles">

                                    <?php if(isset($nodisponibles)) { ?>

                                    @foreach($nodisponibles as $nodisponible)


                                        <tr>
                                            <td> {{$nodisponible->nombre_titular}}</td>
                                            <td> {{$nodisponible->dni_titular}}</td>
                                            <td> Calle: <span style="font-weight: bold">{{$nodisponible->calle}}, </span>
                                                Numero <span style="font-weight: bold">{{$nodisponible->numero}} </span> </td>

                                            <td>
                                                 <a title="Adquirir Parcela" href="{{ route('modificar-panteones',[$nodisponible->parcela_id])}}"><i class="fa fa-lg fa-pencil-square-o"></i> Modificar Parcela</a>
                                                 <a title="Ver Nichos"       href="{{ route('nichos-panteones',[$nodisponible->parcela_id])}}"><i class="fa fa-lg fa-search"></i> Ver nichos</a>
                                                 <a title="Escritura"       href="{{ route('pdfescrituraParcela',[$nodisponible->parcela_id])}}"><i class="fa fa-lg fa-map-o"></i> Escritura</a>
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
            var numero = "{{$numero}}";
            var calle = "{{$calle}}";
            var dni = "{{$dni}}";


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

                    ruta = "{{ URL::route('PanteonesPaginateDisponibles') }}";
                    data = {page: num};
                 }

                //si es una busqueda, paginamos los resultados
                else{

                    ruta = "{{ URL::route('PanteonesPaginateDisponiblesBusqueda') }}";
                    data = { page: num, numero: numero, calle: calle };
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
                    ruta = "{{ URL::route('PanteonesPaginateNoDisponibles') }}";
                }

                //si es una busqueda, paginamos los resultados
                else{

                    ruta = "{{ URL::route('PanteonesPaginateNoDisponiblesBusqueda') }}";
                    data = { page: num, dni: dni, titular: titular, numero: numero, calle: calle };
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


@endsection
