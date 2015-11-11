@extends('master')



@section('title')
    <h2 style="color: white; font-weight: bold; margin-left:10px; ">Nuevo Difunto</h2>
    <p class="pull-right"><a href="{{ URL::previous() }}" class="btn btn-md btn-material-orange back fa fa-reply"></a></p>

@endsection


@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('datepickersandbox/css/bootstrap-datepicker3.min.css') }}">

@endsection

@section('contenido')


    @if(!isset($total))  <?php $total = 0 ?> @endif
    @if(!isset($fecha))  <?php $fecha = 0 ?> @endif
    @if(!isset($cumpletotal))  <?php $cumpletotal = true ?>  @endif
    @if(!isset($cumplefecha))  <?php $cumplefecha = true ?> @endif

    <div class="panel panel-info" style="margin-top: 20px">
        <div class="panel-heading">
            <h3 class="panel-title" style="color: white">
                @if($cumplefecha && $cumpletotal)Cumplimentacion datos difunto
                @else Error en requisitos {{\Illuminate\Support\Facades\Auth::user()->rol}} @endif</h3>
        </div>
        <div class="panel-body">

            @if( (!$cumplefecha || !$cumpletotal) && \Illuminate\Support\Facades\Auth::user()->rol == 1 )

                <div class="row">
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <h4><span class="fa-stack fa-lg"> <i class="fa fa-circle fa-stack-2x"></i> <i class="fa fa-info fa-stack-1x fa-inverse"></i></span> No se cumplen ciertos requisitos para enterrar a un nuevo difunto, contacte con el administrador en caso de dudas </h4><br>

                        @if(!$cumpletotal) <i class="fa fa-exclamation"></i>
                        <span style="font-weight: bold; color: red; font-size: 16px">Hay 4 difuntos en este nicho</span><br>@endif
                        @if(!$cumplefecha)<i class="fa fa-exclamation"></i>
                        <span style="font-weight: bold; color: red; font-size: 16px">No han pasado más de 5 años desde la última inhumación</span>@endif
                    </div>
                </div>

            @else

                @if( (!$cumplefecha || !$cumpletotal))

                    <div class="row">
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            <h4><span class="fa-stack fa-lg"> <i class="fa fa-circle fa-stack-2x"></i> <i class="fa fa-info fa-stack-1x fa-inverse"></i></span> No se cumplen ciertos requisitos para enterrar a un nuevo difunto, como administrador tienes esa posibilidad, aunque necesitas el permiso de sanidad </h4><br>

                            @if(!$cumpletotal) <i class="fa fa-exclamation"></i>
                            <span style="font-weight: bold; color: red; font-size: 16px">Hay 4 difuntos en este nicho</span><br>@endif
                            @if(!$cumplefecha)<i class="fa fa-exclamation"></i>
                            <span style="font-weight: bold; color: red; font-size: 16px">No han pasado más de 5 años desde la última inhumación</span>@endif

                            <hr>
                        </div>
                    </div>
                @endif
               <form id="nuevo-difunto">

                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

               @if(isset($nichoid)) <input type="hidden" name="GC_NICHOS_id" value="{{$nichoid}}">@endif

                <div class="row">
                    <section class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <h3 style="font-weight: bold">Difunto</h3>
                        <br>

                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Nombre y apellidos del difunto</label>
                            <input type="text" class="form-control" name="nom_difunto" required>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Domicilio habitual</label>
                            <input type="text" class="form-control" name="dom_difunto">
                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Poblacion</label>
                                    <input type="text" class="form-control" name="pob_difunto">
                                </div>
                            </div>
                            <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Sexo</label>
                                    <select class="form-control" name="sex_difunto">
                                        <option value="0">Hombre</option>
                                        <option value="1">Mujer</option>

                                    </select></div>
                            </div>
                            <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Edad</label>
                                    <input type="text" class="form-control" name="eda_difunto">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">DNI</label>
                                    <input type="text" class="form-control" name="dni_difunto">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Estado civil</label>
                                    <select type="text" class="form-control" name="est_difunto">
                                        <option value="1">Soltero</option>
                                        <option value="2">Casado</option>
                                        <option value="3">Divorciado</option>
                                        <option value="4">Otro</option>
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
                                    <input required type="text" class="form-control fecha_inh" name="fec_inh_difunto">
                                </div>
                            </div>

                            <div class="col col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Tipo</label>
                                    <input type="text" class="form-control" name="tip_inh_difunto">
                                </div>
                            </div>

                            <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Expediente</label>
                                    <input type="text" class="form-control" name="exp_inh_difunto">
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Empresa funeraria</label>
                            <input type="text" class="form-control" name="emp_funeraria">
                        </div>


                    </section>

                    <section class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <h3 style="font-weight: bold">Fallecimiento</h3>
                        <br>


                        <div class="row">
                            <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Fecha</label>
                                    <input type="text" class="form-control fecha_inh" name="fec_fall_difunto">
                                </div>
                            </div>

                            <div class="col col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Lugar</label>
                                    <input type="text" class="form-control" name="lug_fall_difunto">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Causa</label>
                            <input type="text" class="form-control" name="cau_fall_difunto">
                        </div>

                        <div class="row">
                            <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Medico n�</label>
                                    <input type="text" class="form-control" name="med_difunto">
                                </div>
                            </div>

                            <div class="col col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Localidad</label>
                                    <input type="text" class="form-control" name="loc_fall_difunto">
                                </div>
                            </div>
                        </div>

                        <h3 style="font-weight: bold">Solicitante inhumación</h3>
                        <br>

                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Apellidos, nombre</label>
                            <input type="text" class="form-control" name="nom_sol_difunto">
                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Domicilio</label>
                                    <input type="text" class="form-control" name="dom_sol_difunto">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Localidad</label>
                                    <input type="text" class="form-control" name="loc_sol_difunto">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">DNI</label>
                                    <input type="text" class="form-control" name="dni_sol_difunto">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Telefono</label>
                                    <input type="text" class="form-control" name="tel_sol_difunto">
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
                            <textarea class="form-control" name="obs_difunto"></textarea>
                        </div>
                    </section>
                </div>

                <button class="btn btn-success btn-raised boton21">Añadir nuevo difunto</button>
            </form>
                @endif
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

            $('#nuevo-difunto').submit(function (e) {

                e.preventDefault();

                $.ajax({

                    type: "POST",
                    url: "{{ URL::route('nuevo-difunto') }}",
                    data: $('#nuevo-difunto').serialize(),
                    dataType: "html",
                    error: function () {

                        Lobibox.notify('error', {
                            title: 'No se ha podido añadir el difunto',
                            showClass: 'flipInX',
                            delay: 3000,
                            delayIndicator: false,

                            position: 'bottom left',
                            msg: 'Compruebe la conexi�n a internet'
                        });
                    },
                    success: function (data) {

                        Lobibox.notify('success', {
                            title: 'Difunto añadido<br> Espere...',
                            showClass: 'flipInX',
                            delay: 3000,
                            delayIndicator: false,
                            position: 'bottom left'
                        });

                        $('.boton21').hide();
                        setTimeout(explode, 2000);


                    }
                });
            });
        });

        function explode(){

            window.location.href = "{{ route('show-facturas',[$nichoid])}}";
        }

        /**
         * Comentario cambios
         */

    </script>


@endsection




