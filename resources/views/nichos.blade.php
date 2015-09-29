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

        .active span{

            font-weight: bold;
            font-size: 16px;
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
                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Nombre de titular</label>
                                            <input type="text" class="form-control" id="inputWarning">
                                        </div>
                                    </div>

                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Nombre del difunto</label>
                                            <input type="text" class="form-control" id="inputWarning">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Nombre de calle</label>
                                            <input type="text" class="form-control" id="inputWarning">
                                        </div>
                                    </div>


                                    <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputWarning">Numero de calle</label>
                                            <input type="text" class="form-control" id="inputWarning">
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
    <ul class="nav nav-tabs" style="margin-bottom: 15px; background-color: #00BCD4;">
        <li class="active"><a href="#home" data-toggle="tab"><span>Nichos disponibles (1222)</span></a></li>
        <li><a href="#profile" data-toggle="tab"><span>Nichos no disponibles (3234)</span></a></li>
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

                                <table class="table table-bordered table-hover table-condensed" cellspacing="0" cellpadding="0">
                                    <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Cód.</th>
                                        <th>Datos del nicho</th>
                                        <th>Tarifa</th>
                                        <th>Banco</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($nichos as $nicho)

                                        <tr>
                                            <td> {{$nicho->tipo}}</td>
                                            <td> {{$nicho->id}}</td>
                                            <td> {{$nicho->id}}</td>
                                            <td> {{$nicho->id}}</td>
                                            <td> {{$nicho->id}}</td>
                                            <td> <a><i class="fa fa-lg fa-pencil-square-o"></i></a></td>

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

                                <table class="table table-bordered table-hover table-condensed" cellspacing="0" cellpadding="0">
                                    <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Cód.</th>
                                        <th>Datos del nicho</th>
                                        <th>Tarifa</th>
                                        <th>Banco</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($nichos as $nicho)

                                        <tr>
                                            <td> {{$nicho->tipo}}</td>
                                            <td> {{$nicho->id}}</td>
                                            <td> {{$nicho->id}}</td>
                                            <td> {{$nicho->id}}</td>
                                            <td> {{$nicho->id}}</td>
                                            <td> <a><i class="fa fa-lg fa-pencil-square-o"></i></a></td>

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

    <script type="text/javascript">

        var count = "{{1 }}"; //variable para contar el total de franquicias y mostrar en relacion con el nº de paginas
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
