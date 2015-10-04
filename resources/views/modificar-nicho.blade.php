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

            <form id="editar-nicho">

                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                <input type="hidden" class="form-control" name="id" value="{{$id}}">


                <div class="row">
                    <section class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <h3 style="font-weight: bold">Titular</h3>
                        <br>

                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Apellidos, Nombre</label>
                            <input type="text" class="form-control" value="{{$nicho->nombre_titular}}" name="nombre_titular" required>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Responsable del Nicho</label>
                            <input type="text" class="form-control" value="{{$nicho->responsable}}" name="responsable">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Domicilio</label>
                            <input type="text" class="form-control"value="{{$nicho->dom_titular}}"  name="dom_titular">
                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Codigo postal</label>
                                    <input type="text" class="form-control" value="{{$nicho->cp_titular}}" name="cp_titular">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Poblacion</label>
                                    <input type="text" class="form-control" value="{{$nicho->pob_titular}}" name="pob_titular">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Expediente</label>
                                    <input type="text" class="form-control" value="{{$nicho->exp_titular}}" name="exp_titular">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">DNI</label>
                                    <input type="text" class="form-control" value="{{$nicho->dni_titular}}" name="dni_titular">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Tel�fono</label>
                                    <input type="text" class="form-control" value="{{$nicho->tel_titular}}" name="tel_titular">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Email</label>
                                    <input type="text" class="form-control" value="{{$nicho->ema_titular}}" name="ema_titular">
                                </div>
                            </div>

                        </div>

                        <h3 style="font-weight: bold">Situacion del nicho</h3>
                        <br>

                        <span style="font-weight: bold">Calle:</span><br> <span style="font-weight: bold; color: #1c84c6">{{$info->nombre_calle}}</span> <br><br>
                        <span style="font-weight: bold">Altura</span><br>  <span style="font-weight: bold; color: #1c84c6">{{$info->altura}} </span><br><br>
                        <span style="font-weight: bold">Numero</span><br> <span style="font-weight: bold; color: #1c84c6">{{$info->numero}} </span><br>

                        <br>

                        <div class="sample1">
                            <div class="checkbox">
                                <label>
                                    <input type ="checkbox" class="enterrar"> <span style="font-weight: bold"> Enterrar difunto despues de modificar el nicho</span>
                                </label>
                            </div>
                        </div>

                    </section>

                    <section class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <h3 style="font-weight: bold">Facturado a</h3>
                        <br>


                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Nombre</label>
                            <input type="text" class="form-control" value="{{$nicho->nom_facturado}}" name="nom_facturado">
                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Direccion</label>
                                    <input type="text" class="form-control" value="{{$nicho->dir_facturado}}" name="dir_facturado">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Nif</label>
                                    <input type="text" class="form-control" value="{{$nicho->nif_facturado}}" name="nif_facturado">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Poblacion</label>
                                    <input type="text" class="form-control" value="{{$nicho->pob_facturado}}" name="pob_facturado">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Provincia</label>
                                    <input type="text" class="form-control" value="{{$nicho->pro_facturado}}" name="pro_facturado">

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">C�digo postal</label>
                                    <input type="text" class="form-control" value="{{$nicho->cp_facturado}}" name="cp_facturado">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Telefono</label>
                                    <input type="text" class="form-control" value="{{$nicho->tel_facturado}}" name="tel_facturado">
                                </div>
                            </div>

                        </div>

                        <h3 style="font-weight: bold">Datos bancarios</h3>
                        <br>

                        <div class="row">
                            <div class="col col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">IBAN</label>
                                    <input type="text" class="form-control" value="{{$nicho->iban}}" name="iban">
                                </div>
                            </div>

                            <div class="col col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Banco</label>
                                    <input type="text" class="form-control" value="{{$nicho->banco}}" name="banco">
                                </div>
                            </div>

                            <div class="col col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Sucursal</label>
                                    <input type="text" class="form-control" value="{{$nicho->sucursal}}" name="sucursal">
                                </div>
                            </div>

                            <div class="col col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">DC</label>
                                    <input type="text" class="form-control" value="{{$nicho->dc}}" name="dc">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Cuenta</label>
                                    <input type="text" class="form-control" value="{{$nicho->cuenta}}" name="cuenta">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Plaza</label>
                                    <input type="text" class="form-control" value="{{$nicho->plaza}}" name="plaza">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Titular de la cuenta</label>
                                    <input type="text" class="form-control" value="{{$nicho->titular}}" name="titular">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Observaciones</label>
                                    <textarea type="text" class="form-control" name="observaciones">{{$nicho->observaciones}}</textarea>
                                </div>
                            </div>

                        </div>

                    </section>


                </div>
                <button type="submit" class="btn btn-success btn-raised" id="submit">Modificar nicho</button>
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

            $.material.init();

            $(".enterrar").change(function() {
                if(this.checked) {
                    $('#submit').text('Modificar nicho y enterrar');
                } else{
                    $('#submit').text('Modificar nicho');

                }
            });


            var token = "{{ csrf_token()}}";

            $('#editar-nicho').submit(function (e) {

                e.preventDefault();

                $.ajax({

                    type: "POST",
                    url: "{{ URL::route('editar-nicho') }}",
                    data: $('#editar-nicho').serialize(),
                    dataType: "html",
                    error: function () {

                        Lobibox.notify('error', {
                            title: 'No se ha podido modificar el nicho',
                            showClass: 'flipInX',
                            delay: 3000,
                            delayIndicator: false,

                            position: 'bottom left',
                            msg: 'Compruebe la conexi�n a internet'
                        });
                    },
                    success: function (data) {


                        if( $('.enterrar').is(':checked')){

                            Lobibox.notify('success', {
                                title: 'Nicho modificado correctamente<br>Preparando inhumacion...',
                                showClass: 'flipInX',
                                delay: 3000,
                                delayIndicator: false,
                                position: 'bottom left'
                            });

                            $('#submit').hide();
                            setTimeout(explode, 2000);


                        } else{

                            Lobibox.notify('success', {
                                title: 'Nicho modificado correctamente',
                                showClass: 'flipInX',
                                delay: 3000,
                                delayIndicator: false,
                                position: 'bottom left'
                            });

                        }

                    }
                });
            });
        });

        function explode(){

            window.location.href = "{{ route('alta-difunto-nicho',[$id])}}";
        }
        /**
         * Comentario cambios
         */

    </script>

@endsection




