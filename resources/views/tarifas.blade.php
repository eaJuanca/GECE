@extends('master')

@section('title')
    <h2 style="color: white; font-weight: bold; margin-left:10px; "> Gestión de tarifas </h2>
@endsection


@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('datepickersandbox/css/bootstrap-datepicker3.min.css') }}">


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

                <div class="row col-lg-6 col-md-6 col-sd-12 col-sm-6">


                        <h3 class="text-center" style="font-weight: bold">Parcela</h3>
                        <br>

                        <div class="form-group nombre">
                            <label for="inputFile" class="col-lg-2 ">Tarifa:</label>
                            <div class="col-lg-10">
                                <input type="text" name="cp_parcela" class="form-control cp_parcela" placeholder="valor tarifa" required>
                            </div>
                        </div>
                        <button class="btn btn-success btn-raised pull-right">Modificar</button>

                </div>
            </form>

            <form id="form_pn">

                <div class="row col-lg-6 col-md-6 col-sd-12 col-sm-6">


                    <h3 class="text-center" style="font-weight: bold">Nicho</h3>
                    <br>

                    <div class="form-group nombre">
                        <label for="inputFile" class="col-lg-2 ">Tarifa:</label>
                        <div class="col-lg-10">
                            <input type="text" name="cp_nicho" class="form-control cp_nicho" placeholder="valor tarifa" required>
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
                Tarifa de Cesión temporal
            </h3>
        </div>
        <div class="panel-body">

            <form id="form_tp">

                <div class="row col-lg-6 col-md-6 col-sd-12 col-sm-6">


                    <h3 class="text-center" style="font-weight: bold">Parcela</h3>
                    <br>

                    <div class="form-group nombre">
                        <label for="inputFile" class="col-lg-2 ">Tarifa:</label>
                        <div class="col-lg-10">
                            <input type="text" name="ct_parcela" class="form-control ct_parcela" id="inputNombre" placeholder="valor tarifa" required>
                        </div>
                    </div>
                    <button class="btn btn-success btn-raised pull-right">Modificar</button>

                </div>

            </form>

            <form id="from_tn">

                <div class="row col-lg-6 col-md-6 col-sd-12 col-sm-6">


                    <h3 class="text-center" style="font-weight: bold">Nicho</h3>
                    <br>

                    <div class="form-group nombre">
                        <label for="inputFile" class="col-lg-2 ">Tarifa:</label>
                        <div class="col-lg-10">
                            <input type="text" name="ct_nicho" class="form-control ct_nicho" id="inputNombre" placeholder="valor tarifa" required>
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

                <div class="row col-lg-6 col-md-6 col-sd-12 col-sm-6">


                    <h3 class="text-center" style="font-weight: bold">Parcela</h3>
                    <br>

                    <div class="form-group nombre">
                        <label for="inputFile" class="col-lg-2 ">Tarifa:</label>
                        <div class="col-lg-10">
                            <input type="text" name="m_parcela" class="form-control m_parcela" id="inputNombre" placeholder="valor tarifa" required>
                        </div>
                    </div>
                    <button class="btn btn-success btn-raised pull-right">Modificar</button>

                </div>
            </form>

            <form id="from_tmn">

                <div class="row col-lg-6 col-md-6 col-sd-12 col-sm-6">


                    <h3 class="text-center" style="font-weight: bold">Nicho</h3>
                    <br>

                    <div class="form-group nombre">
                        <label for="inputFile" class="col-lg-2 ">Tarifa:</label>
                        <div class="col-lg-10">
                            <input type="text" name="m_nicho" class="form-control m_nicho" id="inputNombre" placeholder="valor tarifa" required>
                        </div>
                    </div>
                    <button class="btn btn-success btn-raised pull-right">Modificar</button>

                </div>
            </form>

        </div>
    </div>



@endsection

@section('js')

    <script type="text/javascript">

        /*
         Obtenemos el valor de la tarifa de cesion de perpetuidad de las parcelas
         */
        $.ajax({
            type: "GET",
            url: "{{ URL::route('cpv_parcelas') }}",
            dataType: "html",
            error: function () {
                alert("entra en error");
            },
            success: function (data) {

                if(data != null) {
                    $(".cp_parcela")[0].setAttribute("placeholder", data);
                }
            }
        });

        $.ajax({
            type: "GET",
            url: "{{ URL::route('cpv_nichos') }}",
            dataType: "html",
            error: function () {
                alert("entra en error");
            },
            success: function (data) {

                if(data != null) {
                    $(".cp_nicho")[0].setAttribute("placeholder", data);
                }
            }

        });

        $.ajax({
            type: "GET",
            url: "{{ URL::route('ctv_parcelas') }}",
            dataType: "html",
            error: function () {
                alert("entra en error");
            },
            success: function (data) {

                if(data != null) {
                    $(".ct_parcela")[0].setAttribute("placeholder", data);
                }
            }

        });


        $.ajax({
            type: "GET",
            url: "{{ URL::route('ctv_nichos') }}",
            dataType: "html",
            error: function () {
                //alert("entra en error");
            },
            success: function (data) {

                if(data != null) {
                    $(".ct_nicho")[0].setAttribute("placeholder", data);
                }
            }

        });


        $.ajax({
            type: "GET",
            url: "{{ URL::route('mv_parcelas') }}",
            dataType: "html",
            error: function () {
                //alert("entra en error");
            },
            success: function (data) {

                if(data != null) {
                    $(".m_parcela")[0].setAttribute("placeholder", data);
                }
            }

        });

        $.ajax({
            type: "GET",
            url: "{{ URL::route('mv_nichos') }}",
            dataType: "html",
            error: function () {
                //alert("entra en error");
            },
            success: function (data) {

                if(data != null) {
                    $(".m_nicho")[0].setAttribute("placeholder", data);
                }
            }

        });

        $(document).ready(function () {

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
                            position: 'bottom left'

                        });

                        location.reload();
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
                            position: 'bottom left'

                        });

                        location.reload();
                    }
                });

            });


            $(document).ready(function () {

                var token = "{{ csrf_token()}}";

                $("#form_tp").submit(function (e) {

                    e.preventDefault();

                    $.ajax({
                        type: "GET",
                        url: "{{ URL::route('ct_parcelas') }}",
                        data: $("#form_tp").serialize(),
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
                                position: 'bottom left'

                            });

                            location.reload();
                        }
                    });

                });
            });


            $(document).ready(function () {

                var token = "{{ csrf_token()}}";

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
                                position: 'bottom left'

                            });

                            location.reload();
                        }
                    });

                });
            });

            $(document).ready(function () {

                var token = "{{ csrf_token()}}";

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
                                position: 'bottom left'

                            });

                            location.reload();
                        }
                    });

                });
            });

        });

    </script>

@endsection




