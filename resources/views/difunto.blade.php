@extends('master')

@section('title')

    <h2 style="color: white; font-weight: bold; margin-left:10px; ">Difuntos</h2>
@endsection

@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">

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

                    <form>

                        <div class="row">
                            <section class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">


                                <div class="row">
                                    <div class="col col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Difunto</label>
                                            <input type="text" class="form-control" id="inputWarning">
                                        </div>
                                    </div>
                                    <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Sexo</label>
                                            <select class="form-control" id="select">
                                                <option>Hombre</option>
                                                <option>Mujer</option>

                                            </select></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Código</label>
                                            <input type="text" class="form-control" id="inputWarning">
                                        </div>
                                    </div>

                                    <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Fecha</label>
                                            <input type="text" class="form-control" id="inputWarning">
                                        </div>
                                    </div>

                                    <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3">
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


    <a href="{{ URL::route('alta-difunto') }}">
        <button class="btn btn-warning btn-raised">Añadir difunto</button>
    </a>


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
                                <th>Cod</th>
                                <th>Difunto</th>
                                <th>Fecha defuncion</th>
                                <th>Localidad</th>
                                <th>Sexo</th>
                                <th>Extraer</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($difuntos as $difunto)
                                <tr class="difunto{{$difunto->id}} ">

                                    <td>{{$difunto->id}}</td>
                                    <td>{{$difunto->nom_difunto}}</td>
                                    <td style="width: 100px">{{$difunto->fec_fall_difunto}}</td>
                                    <td>{{$difunto->pob_difunto}}</td>
                                    <td style="width: 100px; text-align: center"><span>@if($difunto->sex_difunto == 1)
                                                Mujer
                                            @else
                                                Hombre
                                            @endif</span></td>
                                    <td width="210px"><select>
                                            <option>Documento para el juzgado</option>
                                        </select>

                                        <div>
                                            <a href="{{ URL::route('pdfjuzgado') }}" style="margin-right: 10px"><i
                                                        class="fa fa-print fa-lg fa-border"></i></a>
                                            <a style="margin-right: 10px"><i class="fa fa-eye  fa-lg fa-border"></i></a>
                                            <a style="margin-right: 10px"><i
                                                        class="fa fa-floppy-o  fa-lg fa-border"></i></a>
                                            <a style="margin-right: 10px"><i
                                                        class="fa fa-envelope-o  fa-lg fa-border"></i></a>
                                        </div>
                                    </td>
                                    <td style="width: 100px">
                                        <div style="float: right">
                                            <a data-toggle="tooltip" title="Editar" onclick="alert('hola')" style="margin-right: 10px; color:#03A9F4;"><i
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

        var count = "{{ $total }}"; //variable para contar el total de franquicias y mostrar en relacion con el nº de paginas
        var paginas = 0;
        if (count % 10 != 0) {
            paginas = Math.floor(count / 10) + 1;
        } else {
            paginas = count / 10; //4 es el número de items que queremos que aparezcan.
        }
        $(document).ready(function () {

            $('.paginacion').bootpag({
                total: paginas,
                page: 1,
                maxVisible: 3,
                leaps: true,
                firstLastUse: true,
                first: '?',
                last: '?',
                wrapClass: 'pagination',
                activeClass: 'active',
                disabledClass: 'disabled',
                nextClass: 'next',
                prevClass: 'prev',
                lastClass: 'last',
                firstClass: 'first'

            }).on("page", function (event, num) {

                var ruta = "";

                var html = "";

                $.ajax({

                    type: "get",
                    url: ruta,
                    data: {page: num},
                    dataType: "html",
                    error: function () {
                        //$('#loading').show();
                        alert("Error en la petición");
                    },
                    success: function (data) {

                        $(".noticias").html(data)

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
