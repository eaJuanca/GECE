@extends('master')

@section('title')
    <h2 style="color: white; font-weight: bold; margin-left:10px; ">Modificar Difunto</h2>
@endsection


@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('datepickersandbox/css/bootstrap-datepicker3.min.css') }}">


@endsection

@section('contenido')

    <div class="panel panel-info" style="margin-top: 20px">
        <div class="panel-heading">
            <h3 class="panel-title" style="color: white">Cumplimentacion datos difunto</h3>
        </div>
        <div class="panel-body">

            <form id="modificar-difunto">

                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                <input type="hidden" name="id" value="{{ $difunto->id }}">

                <div class="row">
                    <section class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <h3 style="font-weight: bold">Difunto</h3>
                        <br>

                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Nombre y apellidos del difunto</label>
                            <input type="text" class="form-control" name="nom_difunto" required value="{{$difunto->nom_difunto}}">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Domicilio habitual</label>
                            <input type="text" class="form-control" name="dom_difunto" value="{{ $difunto->dom_difunto }}">
                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Poblacion</label>
                                    <input type="text" class="form-control" name="pob_difunto" value="{{ $difunto->pob_difunto }}">
                                </div>
                            </div>
                            <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Sexo</label>
                                    <select class="form-control" name="sex_difunto">
                                        <option value="0">Hombre</option>
                                        <option value="1" <?php if($difunto->sex_difunto==1) echo 'selected' ?> >Mujer</option>

                                    </select></div>
                            </div>
                            <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Edad</label>
                                    <input type="text" class="form-control" name="eda_difunto" value="{{ $difunto->eda_difunto }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">DNI</label>
                                    <input type="text" class="form-control" name="dni_difunto" value="{{ $difunto->dni_difunto }}">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Estado civil</label>

                                    <select type="text" class="form-control" name="est_difunto">
                                        <option value="1" @if($difunto->est_difunto==1) selected @endif >Soltero</option>
                                        <option value="2" @if($difunto->est_difunto==2) selected @endif>Casado</option>
                                        <option value="3" @if($difunto->est_difunto==3) selected @endif>Divorciado</option>
                                        <option value="4" @if($difunto->est_difunto==4) selected @endif>Otro</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <h3 style="font-weight: bold">Inhumación</h3>
                        <br>

                        <div class="row">
                            <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Fecha</label>
                                    <input type="text" class="form-control fecha_inh" name="fec_inh_difunto" value="{{ $difunto->fec_inh_difunto}}">
                                </div>
                            </div>

                            <div class="col col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Tipo</label>
                                    <input type="text" class="form-control" name="tip_inh_difunto" value="{{ $difunto->tip_inh_difunto }}">
                                </div>
                            </div>

                            <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Expediente</label>
                                    <input type="text" class="form-control" name="exp_inh_difunto" value="{{ $difunto->exp_inh_difunto }}">
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Empresa funeraria</label>
                            <input type="text" class="form-control" name="fun_inh_difunto" value="{{ $difunto->fun_inh_difunto }}">
                        </div>


                    </section>

                    <section class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <h3 style="font-weight: bold">Fallecimiento</h3>
                        <br>


                        <div class="row">
                            <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Fecha</label>
                                    <input type="text" class="form-control fecha_inh" name="fec_fall_difunto" value="{{ $difunto->fec_fall_difunto }}">
                                </div>
                            </div>

                            <div class="col col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Lugar</label>
                                    <input type="text" class="form-control" name="lug_fall_difunto" value="{{ $difunto->lug_fall_difunto }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Causa</label>
                            <input type="text" class="form-control" name="cau_fall_difunto" value="{{ $difunto->cau_fall_difunto }}">
                        </div>

                        <div class="row">
                            <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Médico nº</la1bel>
                                    <input type="text" class="form-control" name="med_difunto" value="{{ $difunto->med_difunto }}">
                                </div>
                            </div>

                            <div class="col col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Localidad</label>
                                    <input type="text" class="form-control" name="loc_fall_difunto" value="{{ $difunto->loc_fall_difunto }}">
                                </div>
                            </div>
                        </div>

                        <h3 style="font-weight: bold">Solicitante inhumación</h3>
                        <br>

                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Apellidos, nombre</label>
                            <input type="text" class="form-control" name="nom_sol_difunto" value="{{ $difunto->nom_sol_difunto }}">
                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Domicilio</label>
                                    <input type="text" class="form-control" name="dom_sol_difunto" value="{{ $difunto->dom_sol_difunto }}">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Localidad</label>
                                    <input type="text" class="form-control" name="loc_sol_difunto" value="{{ $difunto->loc_sol_difunto }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">DNI</label>
                                    <input type="text" class="form-control" name="dni_sol_difunto" value="{{ $difunto->dni_sol_difunto }}">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Teléfono</label>
                                    <input type="text" class="form-control" name="tel_sol_difunto" value="{{ $difunto->tel_sol_difunto}}">
                                </div>
                            </div>
                        </div>

                    </section>


                </div>

                <div class="row">

                    <section class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h3>Observaciones</h3>
                        <br>


                        <div class="form-group">
                            <textarea class="form-control" name="obs_difunto">{{$difunto->obs_difunto}}</textarea>
                        </div>
                    </section>
                </div>

                <button class="btn btn-success btn-raised">Modificar difunto</button>
            </form>
        </div>
    </div>

@endsection

@section('js')

    <script type="text/javascript">



        $('.fecha_inh').datepicker({

            format: "yyyy-mm-dd",
            language: "es",
            multidate: false,
            autoclose: true,
            todayHighlight: true
        });


        $(document).ready(function () {


            var token = "{{ csrf_token()}}";

            $('#modificar-difunto').submit(function (e) {

                e.preventDefault();

                $.ajax({

                    type: "POST",
                    url: "{{ URL::route('ModifyDifunto') }}",
                    data: $('#modificar-difunto').serialize(),
                    dataType: "html",
                    error: function () {

                        Lobibox.notify('error', {
                            title: 'No se ha podido modificar el difunto',
                            showClass: 'flipInX',
                            delay: 3000,
                            delayIndicator: false,

                            position: 'bottom left',
                            msg: 'Compruebe la conexion a internet'
                        });
                    },
                    success: function (data) {

                        Lobibox.notify('success', {
                            title: 'Difunto modificado',
                            showClass: 'flipInX',
                            delay: 3000,
                            delayIndicator: false,
                            position: 'bottom left'
                        });
                    }
                });
            });
        });

        /**
         * Comentario cambios
         */
    </script>

@endsection




