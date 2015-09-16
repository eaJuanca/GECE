@extends('master')

@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">

@endsection

@section('contenido')

    <div class="row" style="margin-top: 1%">

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

    <h3 style="color: white">Difuntos</h3>
    <a href="{{ URL::route('alta-difunto') }}"><button class="btn btn-primary btn-raised" style="background-color: #ad1457">Añadir difunto</button></a>


    <div class="row" style="margin-top: 1%">

        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="panel panel-default">
                <div class="panel-heading"><span style="font-weight: bold">Difuntos registrados en el sistema</span></div>
                <div class="panel-body">

                    <table class="table table-bordered table-difuntos table-responsive display compact" cellspacing="0" width="100%">
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
                        <tr>
                            <td>{{$difunto->id}}</td>
                            <td>{{$difunto->nom_difunto}}</td>
                            <td>{{$difunto->fec_fall_difunto}}</td>
                            <td>{{$difunto->pob_difunto}}</td>
                            <td>@if($difunto->sex_difunto == 1)
                                    Mujer
                                    @else
                                    Hombre
                                @endif</td>
                            <td><select><option>Documento para el juzgado</option></select>
                            <div>
                                <a href="http:\\www.google.es" style="margin-right: 10px"><i class="fa fa-print fa-lg fa-border"></i></a>
                                <a style="margin-right: 10px"><i class="fa fa-eye  fa-lg fa-border"></i></a>
                                <a style="margin-right: 10px"><i class="fa fa-floppy-o  fa-lg fa-border"></i></a>
                                <a style="margin-right: 10px"><i class="fa fa-envelope-o  fa-lg fa-border"></i></a>
                            </div></td>
                            <td> <div style="float: right">
                                    <a style="margin-right: 10px; color:#03A9F4;"><i class="fa fa-pencil-square-o  fa-lg fa-border"></i></a>
                                    <a style="margin-right: 10px; color: #F44336"><i class="fa fa-eraser  fa-lg fa-border "></i></a>
                                </div></td>
                        </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="paginacion" style="float: right"> Paginacion </div>
    </div>
    </div>


@endsection

@section('js')
    <script>

        $('.table-difuntos').DataTable( {
            responsive: true
        } );

    </script>
@endsection