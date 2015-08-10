@extends('master')

@section('css')
    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">
@endsection

@section('contenido')
    <div class="row" >
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <hr>
            <div class="well">
                <div class="alert alert-material-orange text-center">
                    <i class="mdi-action-account-balance gc_icons"></i>
                </div>
                <p class="text-center gc_title"><strong>NICHOS</strong></p>
                <p class="text-center text_hidden">Módulo para la gestión de nichos</p>
                <p class="text-center btn_hidden"><button class="btn btn-md btn-material-orange">Entrar</button></p>
                <p class="text-center btn_show">
                    <button class="btn btn-md btn-material-orange">
                        <i class="glyphicon glyphicon-share-alt"></i>
                    </button>
                </p>
            </div>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <hr>
            <div class="well">
                <div class="alert alert-material-amber text-center">
                    <img src="{{ asset('street.png') }}" width="41"/>
                </div>
                <p class="text-center gc_title"><strong>CALLES</strong></p>
                <p class="text-center text_hidden">Módulo para la gestión de nichos</p>
                <p class="text-center btn_hidden"><a href="{{ URL::route('calles') }}" class="btn btn-md btn-material-amber">Entrar</a></p>
                <p class="text-center btn_show">
                    <button class="btn btn-md btn-material-amber">
                        <i class="glyphicon glyphicon-share-alt"></i>
                    </button>
                </p>
            </div>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <hr>
            <div class="well">
                <div class="alert text-center" style="background-color:#FFECB3">
                    <img src="{{ asset('coffin.png') }}" width="42"/>
                </div>
                <p class="text-center gc_title"><strong>DIFUNTOS</strong></p>
                <p class="text-center text_hidden">Módulo para la gestión de difuntos</p>
                <p class="text-center btn_hidden"><button class="btn btn-md" style="background-color:#FFECB3">Entrar</button></p>
                <p class="text-center btn_show">
                    <button class="btn btn-md" style="background-color:#FFECB3">
                        <i class="glyphicon glyphicon-share-alt"></i>
                    </button>
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <hr>
            <div class="well">
                <div class="alert text-center" style="background-color:#0097A7">
                    <i class="glyphicon glyphicon-euro gc_icons"></i>
                </div>
                <p class="text-center gc_title"><strong>FACTURACION</strong></p>
                <p class="text-center text_hidden">Módulo para la facturación</p>
                <p class="text-center btn_hidden"><button class="btn btn-md" style="background-color:#0097A7">Entrar</button></p>
                <p class="text-center btn_show">
                    <button class="btn btn-md" style="background-color:#0097A7">
                        <i class="glyphicon glyphicon-share-alt"></i>
                    </button>
                </p>
            </div>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <hr>
            <div class="well">
                <div class="alert alert-material-cyan text-center">
                    <i class="mdi-image-style gc_icons"></i>
                </div>
                <p class="text-center gc_title"><strong>TARIFAS</strong></p>
                <p class="text-center text_hidden">Módulo para la gestión de tarifas</p>
                <p class="text-center btn_hidden"><button class="btn btn-md btn-material-cyan">Entrar</button></p>
                <p class="text-center btn_show">
                    <button class="btn btn-md btn-material-cyan">
                        <i class="glyphicon glyphicon-share-alt"></i>
                    </button>
                </p>
            </div>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <hr>
            <div class="well">
                <div class="alert alert-material-amber text-center" style="background-color:#B2EBF2">
                    <i class="mdi-maps-local-library gc_icons"></i>
                </div>
                <p class="text-center gc_title"><strong>LIBRO DE REGISTROS</strong></p>
                <p class="text-center text_hidden">Módulo para libro de registros</p>
                <p class="text-center btn_hidden"><button class="btn btn-md" style="background-color:#B2EBF2">Entrar</button></p>
                <p class="text-center btn_show">
                    <button class="btn btn-md" style="background-color:#B2EBF2">
                        <i class="glyphicon glyphicon-share-alt"></i>
                    </button>
                </p>
            </div>
        </div>

    </div>
@endsection