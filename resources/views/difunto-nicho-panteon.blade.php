@extends('master')

@section('title') <h2 style="color: white; font-weight: bold; margin-left:10px; "> Difuntos</h2>

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
                        <div class="panel-heading"><span style="font-weight: bold">Difuntos en este nicho</span>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover" cellspacing="10" cellpadding="10">
                                    <thead>
                                    <tr>
                                        <th>Nombre difunto</th>
                                        <th>Fecha Inhumacion</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody class="tdisponibles">

                                    <?php if(isset($disponibles)) { ?>

                                    @foreach($disponibles as $disponible)

                                        <tr>
                                            <td> {{$disponible->nom_difunto}} </td>
                                            <td> {{$disponible->fec_inh_difunto}} </td>

                                            <td> <a href="{{ route('modificar-difunto',[$disponible->id])}}"><i class="fa fa-lg fa-pencil-square-o"></i> Modificar difunto</a></td>

                                        </tr>

                                    @endforeach

                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div>

                            <a href="{{ route('alta-difunto-nicho',[$id])}}"><button type="button" class="btn btn-success">Añadir difunto</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('jquery')

@endsection