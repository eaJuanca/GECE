@extends('master')

@section('css')
    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">
@endsection

@section('contenido')

    </br>

    <div class="row well" style="margin: 0">
        <div class="col col-xs-2 col-sm-2 col-md-1 col-lg-1">
            <a href="javascript:void(0)" class="btn btn-default btn-fab mdi-content-add mdi-action-grade"></a>
        </div>
        <div class="col col-xs-10 col-sm-10 col-md-11 col-lg-11">
            <h3>Alta de calle</h3>
        </div>

    </div>

    </br>
    <div class="panel panel-primary">
        <div class="panel-heading gc_Pheading">
            <legend>Calles del cementerio</legend>
        </div>
        <div class="panel-body">
            <table class="table table-responsive table-hover ">
                <thead>
                <tr>
                    <th>Cód</th>
                    <th>Nombre</th>
                    <th>Tramadas</th>
                    <th>Nichos</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Calle su madre</td>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                </tr>
                <tr class="info">
                    <td>3</td>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                </tr>
                <tr class="success">
                    <td>4</td>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                </tr>
                <tr class="danger">
                    <td>5</td>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                </tr>
                <tr class="warning">
                    <td>6</td>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                </tr>
                <tr class="active">
                    <td>7</td>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                </tr>
                <tr class="active">
                    <td>7</td>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                </tr>
                <tr class="active">
                    <td>7</td>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>



@endsection