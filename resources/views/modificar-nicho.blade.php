@extends('master')

@section('title')
    <h2 style="color: white; font-weight: bold; margin-left:10px; "> Modificar Nicho </h2>
@endsection


@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('datepickersandbox/css/bootstrap-datepicker3.min.css') }}">


@endsection

@section('contenido')

    <div class="panel panel-info" style="margin-top: 20px">
        <div class="panel-heading">
            <h3 class="panel-title" style="color: white">Cumplimentacion datos del nicho {{$id}}</h3>
        </div>
        <div class="panel-body">

            <form id="nuevo-difunto">

                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                <div class="row">
                    <section class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <h3 style="font-weight: bold">Titular</h3>
                        <br>

                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Apellidos, Nombre</label>
                            <input type="text" class="form-control" name="nom_difunto" required>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Responsable del Nicho</label>
                            <input type="text" class="form-control" name="dom_difunto">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Domicilio</label>
                            <input type="text" class="form-control" name="dom_difunto">
                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Codigo postal</label>
                                    <input type="text" class="form-control" name="pob_difunto">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Poblacion</label>
                                    <input type="text" class="form-control" name="pob_difunto">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Expediente</label>
                                    <input type="text" class="form-control" name="dni_difunto">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">DNI</label>
                                    <input type="text" class="form-control" name="est_difunto">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Teléfono</label>
                                    <input type="text" class="form-control" name="dni_difunto">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Email</label>
                                    <input type="text" class="form-control" name="est_difunto">
                                </div>
                            </div>

                        </div>

                        <h3 style="font-weight: bold">Situacion del nicho</h3>
                        <br>

                    </section>

                    <section class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <h3 style="font-weight: bold">Fcturado a</h3>
                        <br>


                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Nombre</label>
                            <input type="text" class="form-control" name="dom_difunto">
                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Direccion</label>
                                    <input type="text" class="form-control" name="pob_difunto">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Nif</label>
                                    <input type="text" class="form-control" name="pob_difunto">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Poblacion</label>
                                    <input type="text" class="form-control" name="dni_difunto">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Provincia</label>
                                    <input type="text" class="form-control" name="est_difunto">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Código postal</label>
                                    <input type="text" class="form-control" name="dni_difunto">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Telefono</label>
                                    <input type="text" class="form-control" name="est_difunto">
                                </div>
                            </div>

                        </div>

                        <h3 style="font-weight: bold">Datos bancarios</h3>
                        <br>

                        <div class="row">
                            <div class="col col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">IBAN</label>
                                    <input type="text" class="form-control" name="dom_sol_difunto">
                                </div>
                            </div>

                            <div class="col col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Banco</label>
                                    <input type="text" class="form-control" name="loc_sol_difunto">
                                </div>
                            </div>

                            <div class="col col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Sucursal</label>
                                    <input type="text" class="form-control" name="dom_sol_difunto">
                                </div>
                            </div>

                            <div class="col col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">DC</label>
                                    <input type="text" class="form-control" name="loc_sol_difunto">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Cuenta</label>
                                    <input type="text" class="form-control" name="dni_sol_difunto">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Plaza</label>
                                    <input type="text" class="form-control" name="tel_sol_difunto">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Titular de la cuenta</label>
                                    <input type="text" class="form-control" name="dni_sol_difunto">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Observaciones</label>
                                    <textarea type="text" class="form-control" name="dni_sol_difunto"></textarea>
                                </div>
                            </div>

                        </div>

                    </section>


                </div>

                <button class="btn btn-success btn-raised">Modificar nicho</button>
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
                            msg: 'Compruebe la conexi?n a internet'
                        });
                    },
                    success: function (data) {

                        Lobibox.notify('success', {
                            title: 'Difunto a?adido',
                            showClass: 'flipInX',
                            delay: 3000,
                            delayIndicator: false,
                            position: 'bottom left'
                        });
                    }
                });
            });
        });


    </script>

@endsection




