@extends('master')

@section('title')

        <h2 style="color: white; font-weight: bold; margin-left:10px; "> Modificar Parcela </h2>
        <p class="pull-right"><a href="{{ URL::route('panteones') }}" class="btn btn-md btn-material-orange back glyphicon glyphicon glyphicon-arrow-left"></a></p>

@endsection


@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('datepickersandbox/css/bootstrap-datepicker3.min.css') }}">

@endsection

@section('contenido')


    <div class="panel panel-info" style="margin-top: 20px">
        <div class="panel-heading">
            <h3 class="panel-title" style="color: white">Cumplimentacion datos de la parcela {{$parcela->id}}</h3>
        </div>
        <div class="panel-body">

            <form id="editar-parcela">

                <input name="_method" type="hidden" value="PATCH">

                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                <input type="hidden" class="form-control" name="idparcela" id="idparcela" value="{{$parcela->id}}">

                <div class="row">
                    <section class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <h3 style="font-weight: bold">Titular</h3>
                        <br>

                        <span id="infotitularasignado" @if($parcela->GC_TITULAR_id == null) style="display: none" @endif >Estas editando los datos de un titular existente, si deseas asignar otro titular pulse NUEVO </span>


                        <span @if($parcela->GC_TITULAR_id == null) @else style="display: none" @endif id="infotitularnuevo">Estas añadiendo un nuevo titular a este nicho </span>

                        <div class="row">

                            <div id="infoautocompletado" style="display: none;" class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <span id="h3titular" style="color: red"></span>
                            </div>
                        </div>


                        <input type="hidden" id="idtitular" class="form-control" value="{{$titular->id}}" name="idtitular">

                        <div class="row">

                            <div class="col col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <button style="font-size: 13px!important; align-content: center" type="button" id="nuevotitular" class="btn btn-info btn-xs"> <i class="fa fa-user-plus"></i>
                                         Nuevo </button>
                                </div>
                            </div>

                            <div class="col col-lg-4 col-md-6 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <a title="Ver Nicho" data-toggle="modal" data-target="#complete-dialog">
                                        <button style="font-size: 13px!important;" type="button" class="btn btn-danger btn-xs"><i class="fa fa-align-right"></i>
                                             Autocompletar</button>
                                    </a>
                                </div>
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <button style="font-size: 13px!important;" type="reset" id="recuperar" class="btn btn-success btn-xs"><i class="fa fa-undo"></i> Recuperar</button>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="dni">DNI</label>
                                    <input type="text" id="dni" class="form-control bloqueable" value="{{$titular->dni_titular}}" name="dni_titular">
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label" for="nombreapellidos">Nombre y apellidos</label>
                            <input type="text" placeholder="Nombre apellido1 apellido2" id="nombreapellidos" class="form-control bloqueable" value="{{$titular->nombre_titular}}" name="nombre_titular" required>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="responsable">Responsable del Nicho</label>
                            <input type="text" id="responsable" class="form-control bloqueable" value="{{$titular->responsable}}" name="responsable">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="dom_titular">Domicilio</label>
                            <input type="text" id="dom_titular" class="form-control bloqueable" value="{{$titular->dom_titular}}"  name="dom_titular">
                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="cp_titular">Código postal</label>
                                    <input type="text" id="cp_titular" class="form-control bloqueable" value="{{$titular->cp_titular}}" name="cp_titular">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="pob_titular">Poblacion</label>
                                    <input type="text" id="pob_titular" class="form-control bloqueable" value="{{$titular->pob_titular}}" name="pob_titular">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="tel_titular">Teléfono</label>
                                    <input type="text" id="tel_titular" class="form-control bloqueable" value="{{$titular->tel_titular}}" name="tel_titular">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="ema_titular">Email</label>
                                    <input type="text" id="ema_titular" class="form-control bloqueable" value="{{$titular->ema_titular}}" name="ema_titular">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="exp_titular">Expediente</label>
                                    <input type="text" id="exp_titular" class="form-control bloqueable" value="{{$titular->exp_titular}}" name="exp_titular">
                                </div>
                            </div>

                        </div>


                        <h3 style="font-weight: bold">Situacion de la parcela</h3>
                        <br>
                        <span style="font-weight: bold">Calle:</span><br> <span style="font-weight: bold; color: #1c84c6">{{$infoParcela->calle}}</span> <br><br>
                        <span style="font-weight: bold">Numero</span><br> <span style="font-weight: bold; color: #1c84c6">{{$infoParcela->numero}} </span><br>
                        <br>

                    </section>

                    <section class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <h3 style="font-weight: bold">Facturado a</h3>
                        <br>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <button style="font-size: 11px!important;" type="button" id="copiartitular" class="btn btn-warning button-xs"><i class="fa fa-files-o"></i> Copiar desde Titular</button>
                                </div>
                            </div>
                            </div>

                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Nombre</label>
                            <input type="text" class="form-control" value="{{$parcela->nom_facturado}}" name="nom_facturado">
                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Direccion</label>
                                    <input type="text" class="form-control" value="{{$parcela->dir_facturado}}" name="dir_facturado">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Nif</label>
                                    <input type="text" class="form-control" value="{{$parcela->nif_facturado}}" name="nif_facturado">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Poblacion</label>
                                    <input type="text" class="form-control" value="{{$parcela->pob_facturado}}" name="pob_facturado">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Provincia</label>
                                    <input type="text" class="form-control" value="{{$parcela->pro_facturado}}" name="pro_facturado">

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Código postal</label>
                                    <input type="text" class="form-control" value="{{$parcela->cp_facturado}}" name="cp_facturado">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Teléfono</label>
                                    <input type="text" class="form-control" value="{{$parcela->tel_facturado}}" name="tel_facturado">
                                </div>
                            </div>

                        </div>

                        <h3 style="font-weight: bold">Datos bancarios</h3>
                        <br>

                        <div class="row">
                            <div class="col col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">IBAN</label>
                                    <input type="text" class="form-control" value="{{$parcela->iban}}" name="iban">
                                </div>
                            </div>

                            <div class="col col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Banco</label>
                                    <input type="text" class="form-control" value="{{$parcela->banco}}" name="banco">
                                </div>
                            </div>

                            <div class="col col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Sucursal</label>
                                    <input type="text" class="form-control" value="{{$parcela->sucursal}}" name="sucursal">
                                </div>
                            </div>

                            <div class="col col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">DC</label>
                                    <input type="text" class="form-control" value="{{$parcela->dc}}" name="dc">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Cuenta</label>
                                    <input type="text" class="form-control" value="{{$parcela->cuenta}}" name="cuenta">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Plaza</label>
                                    <input type="text" class="form-control" value="{{$parcela->plaza}}" name="plaza">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Titular de la cuenta</label>
                                    <input type="text" class="form-control" value="{{$parcela->titular}}" name="titular">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Observaciones</label>
                                    <textarea type="text" class="form-control" name="observaciones" rows="3">{{$parcela->observaciones}}</textarea>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Voluntades</label>
                                    <textarea type="text" id="voluntades" class="form-control" name="voluntades" rows="3">{{$parcela->voluntades}}</textarea>
                                </div>
                            </div>

                        </div>

                    </section>


                </div>
                <button type="submit" class="btn btn-success btn-raised" id="submit"><i class="fa fa-pencil-square-o"></i> Modificar parcela</button>
            </form>
        </div>
    </div>


    <div id="complete-dialog" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Busqueda titulares</h4>
                </div>
                <div class="modal-body">

                    <form id="buscartitular">

                        <div class="row">

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="nombrebuscar">Nombre y apellidos</label>
                                    <input type="text" required id="nombrebuscar" class="form-control" name="nombrebuscar">
                                </div>
                            </div>

                            <div class="col col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="callebuscar">Calle</label>
                                    <input type="text" id="callebuscar" class="form-control" name="callebuscar">
                                </div>
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="dnibuscar">DNI</label>
                                    <input type="text" id="dnibuscar" class="form-control" name="dnibuscar">
                                </div>
                            </div>


                        </div>

                        <div class="row">

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12" id="resultadostitulares">

                            </div>

                        </div>

                        <div class="row">

                            <div class="col col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <button type="submit" id="botonbuscar" class="btn btn-success">Buscar</button>

                                </div>
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <button class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                                </div>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')


    <script>
        function cargartitularbusqueda(id){

            $.ajax({

                type: "POST",
                url: "{{ URL::route('autocompletarTitular') }}",
                data: {id: id},
                dataType: "json",
                error: function () {
                },
                success: function (data) {

                    $("#nombreapellidos").val(data['nombre_titular']);
                    $("#responsable").val(data['responsable']);
                    $("#dni").val(data['dni_titular']);
                    $("#dom_titular").val(data['dom_titular']);
                    $("#cp_titular").val(data['cp_titular']);
                    $("#pob_titular").val(data['pob_titular']);
                    $("#tel_titular").val(data['tel_titular']);
                    $("#ema_titular").val(data['ema_titular']);
                    $("#exp_titular").val(data['exp_titular']);
                    $("#idtitular").val(data['id']);

                    $('#infotitularasignado').css('display','block');
                    $('#infotitularnuevo').css('display','none');
                }
            });
        }

    </script>


    <script type="text/javascript">

        var idTitular = "{!!$parcela->GC_TITULAR_id!!}";
        var idParcela = "{!!$parcela->id!!}"


        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        $('.fecha_inh').datepicker({

            format: "yyyy-mm-dd",
            language: "es",
            multidate: false,
            autoclose: true,
            todayHighlight: true
        });

        function reloadMe(){

            window.location.href = "{{ route('show-facturasParcela',[$parcela->id])}}";
        }


        $(document).ready(function () {

            var rol = {{ Auth::user()->rol }}

            $.material.init();

            $('#editar-parcela').submit(function (e) {

                e.preventDefault();

                    $.ajax({

                        type: "GET",
                        url: "{{ URL::route('editar-parcela') }}",
                        data: $('#editar-parcela').serialize(),
                        dataType: "html",
                        error: function () {

                            Lobibox.notify('error', {
                                title: 'No se ha podido modificar la parcela',
                                showClass: 'flipInX',
                                delay: 3000,
                                delayIndicator: false,

                                position: 'bottom left',
                                msg: 'Compruebe la conexión a internet'
                            });
                        },
                        success: function (data) {


                            if ($('.enterrar').is(':checked')) {

                                Lobibox.notify('success', {
                                    title: 'Nicho modificado correctamente<br>Preparando inhumación...',
                                    showClass: 'flipInX',
                                    delay: 3000,
                                    delayIndicator: false,
                                    position: 'bottom left'
                                });

                                $('#submit').hide();
                                setTimeout(explode, 2000);


                            } else {

                                Lobibox.notify('success', {
                                    title: 'Parcela modificada correctamente',
                                    showClass: 'flipInX',
                                    delay: 3000,
                                    delayIndicator: false,
                                    position: 'bottom left'
                                });

                                setTimeout(reloadMe, 2000);
                            }

                        }
                    });
            });

            $('#buscartitular').submit(function (e) {

                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ URL::route('autocompletarTitulares') }}",
                    data: $('#buscartitular').serialize(),
                    dataType: "html",
                    error: function () {

                    },
                    success: function (data) {

                        $('#resultadostitulares').html(data);

                    }
                });


            });


            $('#complete-dialog').on('hidden.bs.modal', function () {

                $('#resultadostitulares').html('');

            });

            function nif(dni) {
                var numero;
                var letX;
                var letra;
                var expresion_regular_dni;

                expresion_regular_dni = /^\d{8}[a-zA-Z]$/;

                if(expresion_regular_dni.test (dni) == true){
                    numero = dni.substr(0,dni.length-1);
                    letX = dni.substr(dni.length-1,1);
                    numero = numero % 23;
                    letra='TRWAGMYFPDXBNJZSQVHLCKET';
                    letra=letra.substring(numero,numero+1);
                    if (letra!=letX.toUpperCase()) {
                        alert('Dni erroneo, la letra del NIF no corresponde');
                        return false;
                    }else{
                        return true;
                    }
                }else{
                    alert('Dni erroneo, formato no válido');
                    return false;
                }
            }

        });

        $("#copiartitular").on("click", function(event){

            $("input[name='nom_facturado']").val($("input[name='nombre_titular']").val());
            $("input[name='dir_facturado']").val($("input[name='dom_titular']").val());
            $("input[name='nif_facturado']").val($("input[name='dni_titular']").val());
            $("input[name='pob_facturado']").val($("input[name='pob_titular']").val());
            //$("input[name='pro_facturado']").val($("input[name='nombre_titular']").val());
            $("input[name='cp_facturado']").val($("input[name='cp_titular']").val());
            $("input[name='tel_facturado']").val($("input[name='tel_titular']").val());

        });

        //controlar la informacion de autocompletado y que la id se vacie
        $("#nuevotitular").on("click", function(event){

            $('#editar-parcela').find('input').each(function() {
                $(this).val('');
            });

            $("#select").val("0");

            $('#infotitularasignado').css('display','none');
            $('#infotitularnuevo').css('display','block');

            //Reasignamos el valor de la parcela proque se ha borrado.
            $("#idparcela").val(idParcela);

        });

        $("#recuperar").on("click", function(event) {

            alert(idTitular);
            if(idTitular == "") {
                $('#infotitularasignado').css('display','none')
                $('#infotitularnuevo').css('display','block');
                $("#idtitular").val("")
                $("idparcela").val(idParcela);

            }else{
                $('#infotitularasignado').css('display','block')
                $('#infotitularnuevo').css('display','none');

                $("#idtitular").val(idTitular)
                $("#idparcela").val(idParcela);

            }


        });

        function explode(){


        }
        /**
         * Comentario cambios
         */

    </script>

@endsection




