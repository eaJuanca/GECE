@extends('master')

@section('title')
    <h2 style="color: white; font-weight: bold; margin-left:10px; "> Gestión de tarifas </h2>
    <p class="pull-right"><a href="{{ URL::previous() }}" class="btn btn-md btn-material-orange back fa fa-reply"></a></p>

@endsection


@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('datepickersandbox/css/bootstrap-datepicker3.min.css') }}">
    <style>


        .labelo{

            margin-top: 13px;
        }
    </style>

@endsection

@section('contenido')


    <div class="panel panel-info" style="margin-top: 20px">
        <div class="panel-heading">
            <h3 class="panel-title" style="color: white">
                Tarifa de Cesión a perpetuidad
            </h3>
        </div>
        <div class="panel-body">

            <form id="form_pp">

                <div class="row col-lg-5 col-md-5 col-sd-12 col-sm-6">

                    <h3 class="text-center" style="font-weight: bold">Parcela</h3>
                    <br>

                    <div class="form-group nombre">
                        <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label class="control-label" for="inputWarning">Tarifa por m2:</label>
                            <input type="number" name="cp_parcela" class="form-control cp_parcela" placeholder="{!! $Tcp_parcelas->tarifa !!}" required>
                        </div>
                        <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label class="control-label" for="inputWarning">Código:</label>
                            <input type="text" name="cp_parcela_cod" class="form-control cp_parcela_cod" placeholder="{!! $Tcp_parcelas->codigo !!}" required>
                        </div>
                    </div>
                    <button class="btn btn-success btn-raised pull-right">Modificar</button>

                </div>
            </form>

            <form id="form_pn">

                <div class="col col-lg-6 col-md-6 col-md-12 col-sm-12 col-lg-offset-1 col-md-offset-1">


                    <h3 class="text-center" style="font-weight: bold">Nicho</h3>
                    <br>

                    @for($i = 0 ; $i < count($Tcp_nichos); $i++)
                        <div class="row form-group nombre" style="margin-left: 0px">
                            <label class="col col-lg-2 labelo ">Altura{{$i+1}}:</label>
                            <div class="col col-lg-4">
                                <input type="number" name="cp_nicho{!!$i!!}" class="form-control cp_nicho" placeholder="{!! $Tcp_nichos[$i]->tarifa !!}" required>
                            </div>
                            <label class="col col-lg-2 labelo ">Código:</label>
                            <div class="col col-lg-4">
                                <input type="text" name="cp_nicho{!!$i!!}_cod" class="form-control cp_nicho_cod" placeholder="{!! $Tcp_nichos[$i]->codigo !!}" required>
                            </div>
                        </div>
                    @endfor

                    <button class="btn btn-success btn-raised pull-right">Modificar</button>

                </div>
            </form>

        </div>
    </div>

    <div class="panel panel-info" style="margin-top: 20px">
        <div class="panel-heading">
            <h3 class="panel-title" style="color: white">
                Tarifa de Cesión temporal
            </h3>
        </div>
        <div class="panel-body">


            <form id="from_tn">

                <div class="row col-lg-6 col-md-6 col-sd-12 col-sm-6">


                    <h3 class="text-center" style="font-weight: bold">Nicho</h3>
                    <br>

                    <div class="form-group nombre">
                        <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label class="control-label" for="inputWarning">Tarifa:</label>
                            <input type="number" name="ct_nicho" class="form-control ct_nicho" placeholder="{!! $Tct_nichos->tarifa !!}" required>
                        </div>
                        <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label class="control-label" for="inputWarning">Código:</label>
                            <input type="text" name="ct_nicho_cod" class="form-control cp_parcela_cod" placeholder="{!! $Tct_nichos->codigo !!}" required>
                        </div>
                    </div>
                    <button class="btn btn-success btn-raised pull-right">Modificar</button>

                </div>

            </form>

        </div>
    </div>

    <div class="panel panel-info" style="margin-top: 20px">
        <div class="panel-heading">
            <h3 class="panel-title" style="color: white">
                Tarifa de Mantenimiento
            </h3>
        </div>
        <div class="panel-body">

            <form id="form_tmp">

                <div class="row col-lg-5 col-md-5 col-xs-12 col-sm-12">
                    <h3 class="text-center" style="font-weight: bold">Parcela</h3>

                    <br>

                    <div class="row form-group nombre">
                        <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="control-label" for="inputWarning">Tarifa sin construir (m2):</label>
                            <input type="number" name="m_parcela0" class="form-control m_parcela" placeholder="{!! $Tm_parcelas[0]->tarifa !!}" required>
                        </div>
                        <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="control-label" for="inputWarning">Código:</label>
                            <input type="text" name="m_parcela0_cod" class="form-control m_parcela_cod" placeholder="{!! $Tm_parcelas[0]->codigo !!}" required>
                        </div>
                    </div>

                    <div class="row form-group nombre">
                        <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="control-label" for="inputWarning">Tarifa construida:</label>
                            <input type="number" name="m_parcela1" class="form-control m_parcela" placeholder="{!! $Tm_parcelas[1]->tarifa !!}" required>
                        </div>
                        <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="control-label" for="inputWarning">Código:</label>
                            <input type="text" name="m_parcela1_cod" class="form-control m_parcela_cod" placeholder="{!! $Tm_parcelas[1]->codigo !!}" required>
                        </div>
                    </div>
                    <button class="btn btn-success btn-raised pull-right">Modificar</button>

                </div>
            </form>

            <form id="from_tmn">

                <div class="row col-lg-6 col-md-6 col-sd-12 col-sm-6 col-lg-offset-1 col-md-offset-1">


                    <h3 class="text-center" style="font-weight: bold">Nicho</h3>
                    <br>

                    <div class="form-group nombre">
                        <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="control-label" for="inputWarning">Tarifa:</label>
                            <input type="number" name="m_nicho" class="form-control m_nicho" placeholder="{!! $Tm_nichos->tarifa !!}" required>
                        </div>
                        <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="control-label" for="inputWarning">Código:</label>
                            <input type="text" name="m_nicho_cod" class="form-control m_nicho_cod" placeholder="{!! $Tm_nichos->codigo !!}" required>
                        </div>
                    </div>

                    <button class="btn btn-success btn-raised pull-right">Modificar</button>

                </div>
            </form>

        </div>
    </div>

    <div class="panel panel-info" style="margin-top: 20px">
        <div class="panel-body">

            <form id="from_iva">

                <div class="row col-lg-6 col-md-6 col-sd-12 col-sm-6">

                    <h3 class="text-center" style="font-weight: bold">IVA</h3>
                    <br>

                    <div class="form-group nombre">
                        <label for="inputFile" class="col-lg-2 labelo">% IVA:</label>
                        <div class="col-lg-10">
                            @if($iva != null)
                                <input type="number" min="0" name="iva" class="form-control m_nicho" value="{!! $iva->tipo !!}" required>
                            @else
                                <input type="number" min="0" name="iva" class="form-control m_nicho" placeholder="valor iva" required>
                            @endif
                        </div>
                    </div>
                    <button class="btn btn-success btn-raised pull-right">Modificar</button>

                </div>
            </form>

        </div>
    </div>

    <div class="panel panel-info" style="margin-top: 20px">
        <div class="panel-heading">
            <h3 class="panel-title" style="color: white">
                Servicios
            </h3>
        </div>
        <div class="panel-body">


            <table class="table table-bordered table-hover table-condensed" cellspacing="10" cellpadding="10">
                <thead>
                <tr>
                    <th>Código.</th>
                    <th>Concepto</th>
                    <th>Importe €</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody class="tdisponibles">


                @foreach($servicios as $servicio)

                    <tr id="servicio{{$servicio->id}}">
                        <td> {{$servicio->codigo}}</td>
                        <td> {{$servicio->concepto}}</td>
                        <td> {{$servicio->importe}}</td>
                        <td><a onclick="borrarServicio({{$servicio->id}})"> <button class="btn btn-warning btn-xs" id="borrarservicio">Borrar <i class="fa fa-trash"></i></button></a></td>

                    </tr>

                @endforeach

                </tbody>
                <tfoot>

                <tr>
                    <td> <input style="margin: 10px" type="text" id="codigo"></td>
                    <td> <input style="margin: 10px" type="text" id="concepto"></td>
                    <td> <input style="margin: 10px" type="number" id="importe" min="0"></td>
                    <td> <button class="btn btn-success btn-xs" id="nuevoservicio">Añadir</button></td>

                </tr>
                </tfoot>


            </table>
        </div>
    </div>

@endsection

@section('js')

    <script type="text/javascript">


        function borrarServicio(id){


            $.ajax({
                type: "GET",
                url: "{{ URL::route('borrar_servicio') }}",
                data: {id: id},
                dataType: "html",
                error: function () {
                    alert("No se ha podido borrar el servicio");
                },
                success: function (data) {

                    Lobibox.notify('success', {
                        title: 'Servicio borrado',
                        showClass: 'flipInX',
                        delay: 3000,
                        delayIndicator: false,
                        position: 'bottom left',
                        icon: 'fa fa-thumbs-up'


                    });

                    $("#servicio"+id).hide(300);

                }
            });
        }


        $(document).ready(function () {


            $("#nuevoservicio").on("click", function(event){

                var codigo = $("#codigo").val();
                var concepto = $("#concepto").val();
                var importe = $("#importe").val();

                $.ajax({
                    type: "GET",
                    url: "{{ URL::route('nuevo_servicio') }}",
                    data: {codigo: codigo, concepto: concepto, importe: importe},
                    dataType: "html",
                    error: function () {
                        alert("No se ha podido añadir el servicio");
                    },
                    success: function (data) {

                        Lobibox.notify('success', {
                            title: 'Servicio añadido',
                            showClass: 'flipInX',
                            delay: 3000,
                            delayIndicator: false,
                            position: 'bottom left',
                            icon: 'fa fa-thumbs-up'


                        });

                        $('.tdisponibles').append("<tr id='servicio"+data+"'><td>"+ codigo +"</td><td>"+ concepto +"</td><td>"+ importe +"</td><td><a onclick='borrarServicio("+data+")'> <button class='btn btn-warning btn-xs' id='borrarservicio'>Borrar <i class='fa fa-trash'></i></button></a></td></tr>");

                        $("#codigo").val('');
                        $("#concepto").val('');
                        $("#importe").val('');
                        // location.reload();
                    }
                });

            });

            var token = "{{ csrf_token()}}";

            $("#form_pp").submit(function (e) {

                e.preventDefault();

                $.ajax({
                    type: "GET",
                    url: "{{ URL::route('cp_parcelas') }}",
                    data: $("#form_pp").serialize(),
                    dataType: "html",
                    error: function () {
                        alert("entra en error");
                    },
                    success: function (data) {

                        Lobibox.notify('success', {
                            title: 'Tarifa modificada',
                            showClass: 'flipInX',
                            delay: 3000,
                            delayIndicator: false,
                            position: 'bottom left',
                            icon: 'fa fa-thumbs-up'


                        });

                       // location.reload();
                    }
                });

            });

            $("#form_pn").submit(function (e) {

                e.preventDefault();

                $.ajax({
                    type: "GET",
                    url: "{{ URL::route('cp_nichos') }}",
                    data: $("#form_pn").serialize(),
                    dataType: "html",
                    error: function () {
                        alert("entra en error");
                    },
                    success: function (data) {

                        Lobibox.notify('success', {
                            title: 'Tarifa modificada',
                            showClass: 'flipInX',
                            delay: 3000,
                            delayIndicator: false,
                            position: 'bottom left',
                            icon: 'fa fa-thumbs-up'


                        });

                        //location.reload();
                    }
                });

            });

            $("#from_tn").submit(function (e) {

                    e.preventDefault();

                    $.ajax({
                        type: "GET",
                        url: "{{ URL::route('ct_nichos') }}",
                        data: $("#from_tn").serialize(),
                        dataType: "html",
                        error: function () {
                            alert("entra en error");
                        },
                        success: function (data) {

                            Lobibox.notify('success', {
                                title: 'Tarifa modificada',
                                showClass: 'flipInX',
                                delay: 3000,
                                delayIndicator: false,
                                position: 'bottom left',
                                icon: 'fa fa-thumbs-up'


                            });

                            //location.reload();
                        }
                    });

                });

            $("#form_tmp").submit(function (e) {

                e.preventDefault();

                $.ajax({
                    type: "GET",
                    url: "{{ URL::route('m_parcelas') }}",
                    data: $("#form_tmp").serialize(),
                    dataType: "html",
                    error: function () {
                        alert("entra en error");
                    },
                    success: function (data) {

                        Lobibox.notify('success', {
                            title: 'Tarifa modificada',
                            showClass: 'flipInX',
                            delay: 3000,
                            delayIndicator: false,
                            position: 'bottom left',
                            icon: 'fa fa-thumbs-up'


                        });

                       // location.reload();
                    }
                });

            });


            $("#from_tmn").submit(function (e) {

                    e.preventDefault();

                    $.ajax({
                        type: "GET",
                        url: "{{ URL::route('m_nichos') }}",
                        data: $("#from_tmn").serialize(),
                        dataType: "html",
                        error: function () {
                            alert("entra en error");
                        },
                        success: function (data) {

                            Lobibox.notify('success', {
                                title: 'Tarifa modificada',
                                showClass: 'flipInX',
                                delay: 3000,
                                delayIndicator: false,
                                position: 'bottom left',
                                icon: 'fa fa-thumbs-up'


                            });

                           // location.reload();
                        }
                    });

                });


            $("#from_iva").submit(function (e) {

                    e.preventDefault();

                    $.ajax({
                        type: "GET",
                        url: "{{ URL::route('m_iva') }}",
                        data: $("#from_iva").serialize(),
                        dataType: "html",
                        error: function () {
                            alert("entra en error");
                        },
                        success: function (data) {

                            Lobibox.notify('success', {
                                title: 'Iva modificado',
                                showClass: 'flipInX',
                                delay: 3000,
                                delayIndicator: false,
                                position: 'bottom left',
                                icon: 'fa fa-thumbs-up'


                            });

                           // location.reload();
                        }
                    });

                });


        });

    </script>

@endsection




