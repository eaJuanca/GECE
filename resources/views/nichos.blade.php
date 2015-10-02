@extends('master')

@section('title')

    <h2 style="color: white; font-weight: bold; margin-left:10px; "> Nichos </h2>
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
                <div class="panel-heading">Formulario de busqueda</div>
                <div class="panel-body">

                    <form method="POST" action="{{URL::route('busquedaNichos')}}">

                        <div class="row">
                            <section class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <input type="hidden"  id="activa" name="activa" value="1">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">


                                <div class="row">
                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Nombre de titular</label>
                                            <input type="text" class="form-control" name="titular">
                                        </div>
                                    </div>

                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Nombre del difunto</label>
                                            <input type="text" class="form-control" name="difunto">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Nombre de calle</label>
                                            <input type="text" class="form-control" name="nombrecalle">
                                        </div>
                                    </div>


                                    <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Numero de calle</label>
                                            <input type="text" class="form-control" name="numero">
                                        </div>
                                    </div>

                                    <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <br>
                                            <button class="btn btn-primary btn-raised">Buscar</button>
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
        <li class="active button1"><a href="#home" data-toggle="tab"><button id="button1" class="btn btn-warning btn-raised button1"><span class="bold">Nichos disponibles ({{$td}})</span></button></a></li>
        <li class="button2"><a href="#profile" data-toggle="tab"><button  id="button2" class="btn btn-warning disabled button2"><span class="bold">Nichos no disponibles ({{$tnd}})</span></button></a></li>
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
                                        <th>Expediente</th>
                                        <th>Banco</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($nodisponibles as $nodisponible)

                                        <tr>
                                            <td> {{$nodisponible->tipo}}</td>
                                            <td> {{$nodisponible->id}}</td>
                                            <td> {{$nodisponible->nombre_titular}}</td>
                                            <td> {{$nodisponible->telefono}}</td>
                                            <td> {{$nodisponible->expediente}}</td>
                                            <td>
                                                @if($nodisponible->banco == null)
                                                    <i class="fa fa-lg fa-times" style="color:red"></i>
                                                @else
                                                    {{$nodisponible->banco}}
                                                @endif
                                            </td>
                                            <td> <a href="{{ route('modificar-nichos',[$nodisponible->id])}}"><i class="fa fa-lg fa-pencil-square-o"></i></a></td>

                                        </tr>

                                        @endforeach


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

    <script>
        $(".button2").click(function(){ $("#button2").removeClass('disabled'); $("#button1").addClass('disabled'); $('#activa').val(2); });
        $(".button1").click(function(){ $("#button1").removeClass('disabled'); $("#button2").addClass('disabled'); $('#activa').val(1);});
    </script>

    <script type="text/javascript">



        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
        });

        var count = "{{$td}}"; //variable para contar el total de franquicias y mostrar en relacion con el nº de paginas
        var paginas = 0;
        if (count % 10 != 0) {
            paginas = Math.floor(count / 10) + 1;
        } else {
            paginas = count / 10; //4 es el número de items que queremos que aparezcan.
        }
        $(document).ready(function () {

            var tab = "{{$tab}}";

            if(tab==2) {
                $('#myTab a[href="#profile"]').tab('show');// Select tab by name
                $("#button2").removeClass('disabled'); $("#button1").addClass('disabled'); $('#activa').val(2);
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

                var ruta = "{{ URL::route('paginateDisponibles') }}";

                //variable de conexion, para cancelar las conexiones anteriores antes de lanzar otra
                var httpR;

                $.ajax({

                    type: "post",
                    url: ruta,
                    data: {page: num},
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
                        //$('#loading').show();
                        alert("Error en la petición");
                    },
                    success: function (data) {
                        $(".tdisponibles").html(data);
                    }
                });
            });
        });

    </script>

    <script>

        function borrar(id) {

            if (confirm(' ¿Realmente desea borrar el difunto con id ' + id + '?')) {
                $(".difunto" + id).hide();
            }
        }
    </script>

@endsection
