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
    <a href="{{ URL::route('nuevo-difunto') }}"><button class="btn btn-primary btn-raised" style="background-color: #ad1457">Añadir difunto</button></a>


    <div class="row" style="margin-top: 1%">

        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="panel panel-default">
                <div class="panel-heading">Difuntos registrados en el sistema</div>
                <div class="panel-body">

                    <table class="table table-bordered table-responsive">
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
                        <tr>
                            <td>cell is row 0, column 0</td>
                            <td>cell is row 0, column 1</td>
                            <td>cell is row 0, column 2</td>
                            <td>cell is row 0, column 3</td>
                            <td>cell is row 0, column 4</td>
                            <td>cell is row 0, column 5</td>
                            <td>cell is row 0, column 6</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="paginacion" style="float: right"> Paginacion </div>
    </div>
    </div>


@endsection