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
                                        <th>Datos del nicho</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody class="tdisponibles">

                                    <?php if(isset($disponibles)) { ?>

                                    @foreach($disponibles as $disponible)

                                        <tr>
                                            <td>
                                                Altura, <span style="font-weight: bold">{{$disponible->altura}} </span>
                                                Numero <span style="font-weight: bold">{{$disponible->numero_nicho}} </span> </td>

                                            <td> <a href="{{ route('ver-difuntos-nicho-panteon',[$disponible->nicho])}}"><i class="fa fa-lg fa-pencil-square-o"></i></a></td>

                                        </tr>

                                    @endforeach

                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('jquery')

@endsection