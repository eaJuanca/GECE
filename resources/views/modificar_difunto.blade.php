@extends('master')

@section('title')
    <h2 style="color: white; font-weight: bold; margin-left:10px; ">Modificar Difunto</h2>
    <p class="pull-right"><a href="{{ URL::previous() }}" class="btn btn-md btn-material-orange back fa fa-reply"></a>
    </p>

@endsection


@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen"
          href="{{ asset('datepickersandbox/css/bootstrap-datepicker3.min.css') }}">


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
                            <input type="text" class="form-control" name="nom_difunto" tabindex="1" required
                                   value="{{ $difunto->nom_difunto }}">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Domicilio habitual</label>
                            <input type="text" class="form-control" tabindex="2" name="dom_difunto"
                                   value="{{ $difunto->dom_difunto }}">
                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Poblacion</label>
                                    <input type="text" class="form-control" tabindex="3" name="pob_difunto"
                                           value="{{ $difunto->pob_difunto}}">
                                </div>
                            </div>
                            <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Sexo</label>
                                    <select class="form-control" tabindex="4" name="sex_difunto">
                                        <option value="0">Hombre</option>
                                        <option value="1" @if($difunto->sex_difunto == 1)selected @endif>Mujer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Edad</label>
                                    <input type="text" class="form-control" tabindex="5" name="eda_difunto"
                                           value="{{ $difunto->eda_difunto }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">DNI</label>
                                    <input type="text" class="form-control" tabindex="6" name="dni_difunto"
                                           value="{{ $difunto->dni_difunto }}">
                                </div>
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Parroquia</label>
                                    <select type="text" class="form-control" tabindex="7" name="parroquia_difunto">
                                        <option></option>
                                        <option @if($difunto->parroquia_difunto == "Purísima") selected @endif>
                                            Purísima
                                        </option>
                                        <option @if($difunto->parroquia_difunto == "San José") selected @endif>San
                                            José
                                        </option>
                                        <option @if($difunto->parroquia_difunto == "Niño Jesús") selected @endif>Niño
                                            Jesús
                                        </option>
                                        <option @if($difunto->parroquia_difunto == "San Juan Bautista") selected @endif>
                                            San Juan Bautista
                                        </option>
                                        <option @if($difunto->parroquia_difunto == "Otra") selected @endif>Otra</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Estado civil</label>
                                    <select type="text" class="form-control" name="est_difunto">
                                        <option value="1" @if($difunto->est_difunto==1) selected @endif >Soltero
                                        </option>
                                        <option value="2" @if($difunto->est_difunto==2) selected @endif>Casado</option>
                                        <option value="3" @if($difunto->est_difunto==3) selected @endif>Divorciado
                                        </option>
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
                                    <input required type="text" class="form-control fecha_inh" tabindex="13"
                                           name="fec_inh_difunto" value="{{ $difunto->fec_inh_difunto }}">
                                </div>
                            </div>

                            <div class="col col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Tipo</label>
                                    <select class="form-control" name="tip_inh_difunto" tabindex="14" required>
                                        <option @if($difunto->tip_inh_difunto == "Restos cadávéricos") selected @endif>Restos cadávéricos</option>
                                        <option @if($difunto->tip_inh_difunto == "Restos incinerados") selected @endif>Restos incinerados</option>
                                        <option @if($difunto->tip_inh_difunto == "Restos") selected @endif>Restos</option>
                                        <option @if($difunto->tip_inh_difunto == "Otros restos") selected @endif>Otros restos</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Expediente</label>
                                    <input type="text" class="form-control" tabindex="15" name="exp_inh_difunto"
                                           value="{{ $difunto->exp_inh_difunto }}">
                                </div>
                            </div>

                        </div>

                        <h3 style="font-weight: bold">Datos funeraria</h3>
                        <br>


                        <div class="row">
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">

                                    <label class="control-label" for="inputWarning">Nombre</label>
                                    <input type="text" class="form-control" tabindex="22" name="nom_emp_funeraria"
                                           value="{{ $difunto->nom_emp_funeraria }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">

                                    <label class="control-label" for="inputWarning">CIF</label>
                                    <input type="text" class="form-control" tabindex="23" name="cif_emp_funeraria"
                                           value="{{ $difunto->cif_emp_funeraria }}">
                                </div>
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label class="control-label" for="inputWarning">CP</label>
                                <input type="numeric" class="form-control" tabindex="24" name="cp_emp_funeraria"
                                       value="{{ $difunto->cp_emp_funeraria }}">
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label class="control-label" for="inputWarning">Provicina</label>
                                <input type="numeric" class="form-control" tabindex="25" name="pro_emp_funeraria"
                                       value="{{ $difunto->pro_emp_funeraria }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">

                                    <label class="control-label" for="inputWarning">Población</label>
                                    <input type="text" class="form-control" tabindex="26" name="pob_emp_funeraria"
                                           value="{{ $difunto->pob_emp_funeraria }}">
                                </div>
                            </div>

                            <div class="col col-lg-8 col-md-6 col-sm-12 col-xs-12">
                                <label class="control-label" for="inputWarning">Domicilio</label>
                                <input type="numeric" class="form-control" tabindex="27" name="dom_emp_funeraria"
                                       value="{{ $difunto->dom_emp_funeraria }}">
                            </div>

                        </div>


                    </section>

                    <section class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <h3 style="font-weight: bold">Fallecimiento</h3>
                        <br>


                        <div class="row">
                            <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Fecha</label>
                                    <input type="text" class="form-control fecha_inh" name="fec_fall_difunto"
                                           tabindex="8" required value="{{ $difunto->fec_fall_difunto }}">
                                </div>
                            </div>

                            <div class="col col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Lugar</label>
                                    <input type="text" class="form-control" tabindex="9" name="lug_fall_difunto"
                                           value="{{ $difunto->lug_fall_difunto }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Causa</label>
                            <input type="text" class="form-control" tabindex="10" name="cau_fall_difunto"
                                   value="{{ $difunto->cau_fall_difunto }}">
                        </div>

                        <div class="row">
                            <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Medico nº</label>
                                    <input type="text" class="form-control" tabindex="11" name="med_difunto"
                                           value="{{ $difunto->med_difunto }}">
                                </div>
                            </div>

                            <div class="col col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Localidad</label>
                                    <input type="text" class="form-control" tabindex="12" name="loc_fall_difunto"
                                           value="{{ $difunto->loc_fall_difunto }}">
                                </div>
                            </div>
                        </div>

                        <h3 style="font-weight: bold">Solicitante inhumación</h3>
                        <br>

                        <div class="row">
                            <div class="col col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Apellidos, nombre</label>
                                    <input type="text" class="form-control" tabindex="16" name="nom_sol_difunto"
                                           value="{{ $difunto->nom_sol_difunto }}">
                                </div>
                            </div>
                            <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label class="control-label" for="inputWarning">Parentesco con difunto</label>
                                <input type="text" class="form-control" tabindex="17" name="par_sol_difunto"
                                       value="{{ $difunto->par_sol_difunto }}">
                            </div>

                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Domicilio</label>
                                    <input type="text" class="form-control" tabindex="18" name="dom_sol_difunto"
                                           value="{{ $difunto->dom_sol_difunto }}">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Localidad</label>
                                    <input type="text" class="form-control" tabindex="19" name="loc_sol_difunto"
                                           value="{{ $difunto->loc_sol_difunto }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">DNI</label>
                                    <input type="text" class="form-control" tabindex="20" name="dni_sol_difunto"
                                           value="{{ $difunto->dni_sol_difunto }}">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Telefono</label>
                                    <input type="text" class="form-control" tabindex="21" name="tel_sol_difunto"
                                           value="{{ $difunto->tel_sol_difunto }}">
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
                            <textarea class="form-control" tabindex="28"
                                      name="obs_difunto">{{$difunto->obs_difunto}}</textarea>
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
                            msg: 'Compruebe la conexion a internet',
                            icon: 'fa fa-thumbs-up'

                        });
                    },
                    success: function (data) {

                        Lobibox.notify('success', {
                            title: 'Difunto modificado',
                            showClass: 'flipInX',
                            delay: 3000,
                            delayIndicator: false,
                            position: 'bottom left',
                            icon: 'fa fa-thumbs-up'

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




