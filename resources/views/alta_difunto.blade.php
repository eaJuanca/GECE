@extends('master')

@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">

@endsection

@section('contenido')

    <div class="panel panel-info" style="margin-top: 20px">
        <div class="panel-heading">
            <h3 class="panel-title" style="color: white">Modificar datos del difunto</h3>
        </div>
        <div class="panel-body">

            <form id="nuevo-difunto">

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
                                        <option>Hombre</option>
                                        <option>Mujer</option>

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
                                    <input type="text" class="form-control" name="est_difunto">
                                </div>
                            </div>

                        </div>

                        <h3 style="font-weight: bold">Inhumacion</h3>
                        <br>

                        <div class="row">
                            <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Fecha</label>
                                    <input type="text" class="form-control" name="fec_inh_difunto">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
                                    <input type="text" class="form-control" name="fec_fall_difunto">
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
                                    <label class="control-label" for="inputWarning">Medico nº</label>
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

                        <h3 style="font-weight: bold">Solicitante inhumacion</h3>
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


                <button class="btn btn-success btn-raised">Añadir nuevo difunto</button>
                <button class="btn btn-danger btn-raised">Cancelar</button>
            </form>
        </div>
    </div>

@endsection

@section('js')

<script type="text/javascript">


    $(document).ready(function() {

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
                        title: 'No se ha podido crear la categoria',
                        showClass: 'flipInX',
                        delay: 3000,
                        delayIndicator: false,

                        position: 'bottom left',
                        msg: 'Compruebe la conexión a internet o si la categoría ya existe'
                    });
                },
                success: function (data) {

                    Lobibox.notify('success', {
                        title: 'Categoría creada con éxito',
                        showClass: 'flipInX',
                        delay: 3000,
                        delayIndicator: false,

                        position: 'bottom left',
                        msg: 'Mas categorías, mas dinero!'
                    });
                }
            });


        });

    });


</script>

@endsection




