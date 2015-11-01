@extends('master')

@section('css')
    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">
@endsection

@section('title')

    <h2 style="color: white; font-weight: bold; margin-left:10px; "> Inicio </h2>
@endsection

@section('contenido')

        <div class="row">

            @if(Auth::user()->nichos)
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <hr>
                <div class="well">
                    <div class="alert alert-material-orange text-center">
                        <i class="mdi-action-account-balance gc_icons"></i>
                    </div>
                    <p class="text-center gc_title"><strong>NICHOS</strong></p>
                    <p class="text-center text_hidden">Módulo para la gestión de nichos</p>
                    <p class="text-center btn_hidden"><a href="{{ URL::route('nichos') }}" class="btn btn-md btn-material-orange">Entrar</a></p>
                    <p class="text-center btn_show">
                        <button class="btn btn-md btn-material-orange">
                            <i class="glyphicon glyphicon-share-alt"></i>
                        </button>
                    </p>
                </div>
            </div>
            @endif

            @if(Auth::user()->panteones)
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <hr>
                    <div class="well">
                        <div class="alert alert-material-amber text-center">
                            <img src="{{ asset('street.png') }}" width="41"/>
                        </div>
                        <p class="text-center gc_title"><strong>PANTEONES</strong></p>
                        <p class="text-center text_hidden">Módulo para la gestión de panteones</p>
                        <p class="text-center btn_hidden"><a href="{{ URL::route('panteones') }}" class="btn btn-md btn-material-amber">Entrar</a></p>
                        <p class="text-center btn_show">
                            <button class="btn btn-md btn-material-amber">
                                <i class="glyphicon glyphicon-share-alt"></i>
                            </button>
                        </p>
                    </div>
                </div>
            @endif

            @if(Auth::user()->calle)
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <hr>
                <div class="well">
                    <div class="alert text-center" style="background-color:#FFECB3">
                        <img src="{{ asset('street.png') }}" width="41"/>
                    </div>
                    <p class="text-center gc_title"><strong>CALLES</strong></p>
                    <p class="text-center text_hidden">Módulo para la gestión de nichos</p>
                    <p class="text-center btn_hidden"><a href="{{ URL::route('calles') }}" class="btn btn-md" style="background-color:#FFECB3">Entrar</a></p>
                    <p class="text-center btn_show">
                        <button class="btn btn-md"style="background-color:#FFECB3">
                            <i class="glyphicon glyphicon-share-alt"></i>
                        </button>
                    </p>
                </div>
            </div>
            @endif

            @if(Auth::user()->recibos)
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <hr>
                <div class="well">
                    <div class="alert text-center gc_icons" style="background-color:#0097A7">
                        <i class="glyphicon glyphicon-list-alt"></i>
                    </div>
                    <p class="text-center gc_title"><strong>RECIBOS</strong></p>
                    <p class="text-center text_hidden">Módulo para la impresión de recibos</p>
                    <p class="text-center btn_hidden"><a href="{{ URL::route('recibos') }}" class="btn btn-md" style="background-color:#0097A7">Entrar</a></p>
                    <p class="text-center btn_show">
                        <button class="btn btn-md" style="background-color:#0097A7">
                            <i class="glyphicon glyphicon-share-alt"></i>
                        </button>
                    </p>
                </div>
            </div>
            @endif

            @if(Auth::user()->facturas)
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <hr>
                <div class="well">
                    <div class="alert text-center alert-material-cyan">
                        <i class="glyphicon glyphicon-euro gc_icons"></i>
                    </div>
                    <p class="text-center gc_title"><strong>FACTURACION</strong></p>
                    <p class="text-center text_hidden">Módulo para la facturación</p>
                    <p class="text-center btn_hidden"><a href="{{ URL::route('facturacion') }}" class="btn btn-md" style="background-color:#B2EBF2">Entrar</a></p>
                    <p class="text-center btn_show">
                        <button class="btn btn-md" style="background-color:#0097A7">
                            <i class="glyphicon glyphicon-share-alt"></i>
                        </button>
                    </p>
                </div>
            </div>
            @endif

                @if(Auth::user()->difuntos)
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <hr>
                        <div class="well">
                            <div class="alert text-center" style="background-color:#B2EBF2">
                                <img src="{{ asset('coffin.png') }}" width="42"/>
                            </div>
                            <p class="text-center gc_title"><strong>DIFUNTOS</strong></p>
                            <p class="text-center text_hidden">Módulo para la gestión de difuntos</p>
                            <p class="text-center btn_hidden"><a href="{{ URL::route('difunto') }}" class="btn btn-md" style="background-color:#B2EBF2">Entrar</a></p>
                            <p class="text-center btn_show">
                                <button class="btn btn-md" style="background-color:#B2EBF2">
                                    <i class="glyphicon glyphicon-share-alt"></i>
                                </button>
                            </p>
                        </div>
                    </div>
                @endif

            @if(Auth::user()->tarifas)
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <hr>
                <div class="well">
                    <div class="alert text-center" style="background-color:#5D4037">
                        <i class="mdi-image-style gc_icons"></i>
                    </div>
                    <p class="text-center gc_title"><strong>TARIFAS</strong></p>
                    <p class="text-center text_hidden">Módulo para la gestión de tarifas</p>
                    <p class="text-center btn_hidden"><a href="{{ URL::route('tarifas') }}" class="btn btn-md" style="background-color:#5D4037">Entrar</a></p>
                    <p class="text-center btn_show">
                        <button class="btn btn-md" style="background-color:#5D4037">
                            <i class="glyphicon glyphicon-share-alt"></i>
                        </button>
                    </p>
                </div>
            </div>
            @endif


            @if(Auth::user()->libro_registros)
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <hr>
                    <div class="well">
                        <div class="alert text-center" style="background-color:#795548">
                            <i class="mdi-maps-local-library gc_icons"></i>
                        </div>
                        <p class="text-center gc_title"><strong>LIBRO DE REGISTROS</strong></p>
                        <p class="text-center text_hidden">Módulo para libro de registros</p>
                        <p class="text-center btn_hidden"><button class="btn btn-md" style="background-color:#795548">Entrar</button></p>
                        <p class="text-center btn_show">
                            <button class="btn btn-md" style="background-color:#795548">
                                <i class="glyphicon glyphicon-share-alt"></i>
                            </button>
                        </p>
                    </div>
                </div>
            @endif

            @if(Auth::user()->usuarios)
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <hr>
                    <div class="well">
                        <div class="alert text-center gc_icons" style="background-color:#D7CCC8">
                            <i class="glyphicon glyphicon-user"></i>
                        </div>
                        <p class="text-center gc_title"><strong>ALTA USUARIOS</strong></p>
                        <p class="text-center text_hidden">Módulo para dar de alta nuevos usuarios</p>
                        <p class="text-center btn_hidden"><a href="{{ URL::route('usuarios') }}" class="btn btn-md" style="background-color:#D7CCC8">Entrar</a></p>
                        <p class="text-center btn_show">
                            <button class="btn btn-md" style="background-color:#D7CCC8">
                                <i class="glyphicon glyphicon-share-alt"></i>
                            </button>
                        </p>
                    </div>
                </div>
            @endif

        </div>

@endsection