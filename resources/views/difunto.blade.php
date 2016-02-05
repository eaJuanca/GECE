@extends('master')

@section('title')

    <h2 style="color: white; font-weight: bold; margin-left:10px; ">Difuntos</h2>
    <p class="pull-right"><a href="{{ URL::previous() }}" class="btn btn-md btn-material-orange back fa fa-reply"></a></p>

@endsection

@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('datepickersandbox/css/bootstrap-datepicker3.min.css') }}">


    <style>

        a:hover{
            cursor: pointer;
        }
    </style>

@endsection

@section('contenido')

    <div class="row" style="margin-top: 2%">

        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="panel panel-default">
                <div class="panel-heading">Formulario de busqueda</div>
                <div class="panel-body">

                    <form method="POST" action="{{URL::route('BusquedaDifunto')}}">

                        <div class="row">
                            <section class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">


                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                                <div class="row">
                                    <div class="col col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Difunto</label>
                                            <input type="text" class="form-control" name="difunto" value="<?php  if(isset($difunto)) echo $difunto; else $difunto="" ?>">
                                        </div>
                                    </div>
                                    <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Parroquia</label>
                                            <select type="text" class="form-control"  name="parroquia">

                                                <?php  if (isset($parroquia)) {} else  $parroquia='' ?>
                                                <option></option>
                                                <option @if($parroquia == "Purísima") selected @endif>Purísima</option>
                                                <option @if($parroquia == "San José") selected @endif>San José</option>
                                                <option @if($parroquia == "Niño Jesús") selected @endif>Niño Jesús</option>
                                                <option @if($parroquia == "San Juan Bautista") selected @endif>San Juan Bautista</option>
                                                <option @if($parroquia == "Otra") selected @endif>Otra</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Fecha inhumacion</label>
                                            <input type="text" class="form-control fecha" name="inhumacion" value="<?php  if(isset($inhumacion)) echo $inhumacion; else $inhumacion='' ?>">
                                        </div>
                                    </div>

                                    <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Fecha defunción</label>
                                            <input type="text" class="form-control fecha" name="fecha" value="<?php  if(isset($fecha)) echo $fecha ; else $fecha=''?>">
                                        </div>
                                    </div>

                                    <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3">
                                        <div class="form-group">
                                            <br>
                                            <button class="btn btn-primary btn-raised">Buscar</button>
                                            <a id='search' href="{{URL::route('difunto')}}" class="btn btn-danger btn-raised" style="visibility: hidden">Terminar</a>

                                        </div>
                                    </div>

                                </div>

                                <div class="row" id="nota" style="display: none">
                                    <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                        <span style="font-weight: bold; font-size: 16px">A continuación se muestran los resultados de búsqueda. Pulse <span style="color: red">terminar</span> para finalizar</span>

                                    </div>
                                </div>

                            </section>
                        </div>
                    </form>

                    <script>
                        var difunto = "{{ $difunto }}";
                        var fecha = "{{ $fecha }}";
                        var parroquia = "{{ $parroquia }}";
                        var inhumacion = "{{ $inhumacion }}";
                    </script>
                </div>
            </div>
        </div>
    </div>


   <!-- <a href="{{ URL::route('alta-difunto') }}">
        <button class="btn btn-warning btn-raised">Añadir difunto</button>
    </a> -->


    <div class="row" style="margin-top: 1%">

        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="panel panel-default">
                <div class="panel-heading"><span style="font-weight: bold">Difuntos registrados en el sistema</span>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">

                        <table class="table table-bordered table-hover table-condensed" cellspacing="0" cellpadding="0">
                            <thead>
                            <tr>
                                <th>Difunto</th>
                                <th>Fecha defunción</th>
                                <th>Fecha inhumación</th>
                                <th>Edad</th>
                                <th>Domicilio</th>
                                <th>Nicho</th>
                                <th>Calle</th>
                                <th>Parroquia</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody class="difuntos">

                            @foreach($difuntos as $difunto)

                                <?php
                                    //formateamos las fechas inhumacion y fallecimiento
                                    $finh = new \Carbon\Carbon($difunto->inhumacion);
                                    $ffall = new \Carbon\Carbon($difunto->fallecimiento);
                                ?>

                                <tr class="difunto{{$difunto->id}} ">

                                    <td>{{$difunto->nombre}}</td>
                                    <td>{{$ffall->format('j-m-Y')}}</td>
                                    <td>{{$finh->format('j-m-Y')}}</td>
                                    <td>{{$difunto->edad}}</td>
                                    <td>{{$difunto->domicilio}}</td>
                                    <td>{{$difunto->numero}}</td>
                                    <td>{{$difunto->calle}}</td>
                                    <td>{{$difunto->parroquia_difunto}}</td>

                                    <td style="width: 100px">
                                        <div style="float: right">
                                            <a data-toggle="tooltip" title="Editar" href="{{ route('modificar-difunto',[$difunto->id])}}" style="margin-right: 10px; color:#03A9F4;"><i
                                                        class="fa fa-pencil-square-o  fa-lg fa-border"></i></a>
                                            <a data-toggle="tooltip" title="Borrar" style="margin-right: 10px; color: #F44336"
                                               onclick="borrar({{$difunto->id}})"><i
                                                        class="fa fa-eraser  fa-lg fa-border "></i></a>
                                        </div>
                                    </td>
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


@endsection

@section('jquery')
    <script src="{{ asset('assets/js/bootpag.min.js') }}"></script>

    <script type="text/javascript">

        var count = "{{ $total }}"; //variable para contar el total de franquicias y mostrar en relacion con el n� de paginas
        var paginas = 0;
        if (count % 10 != 0) {
            paginas = Math.floor(count / 10) + 1;
        } else {
            paginas = count / 10; //4 es el n�mero de items que queremos que aparezcan.
        }

        var search = "{{$search}}";
        if(search == 1){ $('#search').css('visibility','visible');$('#nota').css('display','block'); }


        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });


        $('.fecha').datepicker({

            format: "yyyy-mm-dd",
            language: "es",
            multidate: false,
            autoclose: true,
            todayHighlight: true
        });

        $(document).ready(function () {

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


                var ruta;
                var data;



                if(search==0) {
                    ruta = "{{ URL::route('paginateDifunto') }}";
                    data = {page: num};
                } else{

                    ruta = "{{ URL::route('paginateBusquedaDifunto') }}";
                    data = {page: num, difunto: difunto, fecha: fecha, parrquia: parroquia, inhumacion:inhumacion};
                }


                $.ajax({

                    type: "post",
                    url: ruta,
                    data: data,
                    dataType: "html",
                    error: function () {
                        //$('#loading').show();
                        alert("Error en la peticion");
                    },
                    success: function (data) {

                        $(".difuntos").html(data)

                    }
                });
            });
        });

    </script>

    <script>

        function borrar(id) {

            if (confirm('¿'+'Realmente desea borrar el difunto con id ' + id + '?')) {

                $(".difunto" + id).hide();

                $.ajax({

                    type: "post",
                    url: "{{ URL::route('EliminarDifunto')}}",
                    data: {id: id},
                    dataType: "html",
                    error: function () {
                        //$('#loading').show();
                        alert("Error en la peticion");
                    },
                    success: function (data) {

                    }
                });
            }
        }

        /**
         * Comentario cambios
         */
    </script>

@endsection
