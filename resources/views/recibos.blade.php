<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

@extends('master')

@section('title')
    <h2 style="color: white; font-weight: bold; margin-left:10px; "> Recibos </h2>

@endsection

@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('datepickersandbox/css/bootstrap-datepicker3.min.css') }}">


    <style>
        .stepwizard-step p {
            margin-top: 10px;
        }
        .stepwizard-row {
            display: table-row;
        }
        .stepwizard {
            display: table;
            width: 50%;
            position: relative;
        }
        .stepwizard-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
        }
        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc;
            z-order: 0;
        }
        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }
        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
            margin-top: 0%;
            border: 1px solid transparent;
        }

    </style>

@endsection

@section('contenido')

    <br>
    <div class="well">
        <div class="stepwizard col-md-offset-3">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                <p>Búsqueda</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-default btn-circle btn-personalize" disabled="disabled">2</a>
                <p>Periodo</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p>Generar</p>
            </div>
        </div>
    </div>

        <form id="listarNichos" role="form" action="" method="post">
        <div class="row setup-content" id="step-1">
            <div class="col-xs-6 col-md-offset-3">
                <div class="col-md-12">
                    <h3>  </h3>

                        <div class="row">

                            <div class="col col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="nombrebuscar">Nombre y apellidos</label>
                                    <input type="text" id="nombrebuscar" class="form-control" name="nombrebuscar">
                                </div>
                            </div>

                            <div class="col col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <div class="col col-lg-12">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="corriente" name="corriente"><span class="checkbox-material"><span class="check"></span></span> <span style="font-weight: bold;">Al día</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="dnibuscar">DNI</label>
                                    <input type="text" id="dnibuscar" class="form-control" name="dnibuscar">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="callebuscar">Calle</label>
                                    <input type="text" id="callebuscar" class="form-control" name="callebuscar">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="nombrebuscar">Domicilio titular</label>
                                    <input type="text" id="domiciliobuscar" class="form-control" name="domiciliobuscar">
                                </div>
                            </div>

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group enter">
                                    <label class="control-label" for="nombrebuscar">Selección: </label>
                                    <label id="select"> </label>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <button type="submit" id="botonbuscar" class="btn btn-success">
                                        <i class="fa fa-search"></i>
                                    </button>

                                </div>
                            </div>

                        </div>
                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-2">
            <div class="col-xs-6 col-md-offset-3">
                <div class="col-md-12">
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="inputWarning" >Desde</label>
                            <input type="text" class="form-control fecha_ini" disabled name="fecha_ini" value="2015-11-01">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="inputWarning">Hasta (No incluido)</label>
                            <input required type="text" class="form-control fecha_fin" name="fecha_fin">
                        </div>
                    </div>
                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-3">
            <div class="col-xs-6 col-md-offset-3">
                <div class="col-md-12 enlace text-center">


                </div>
            </div>
        </div>
    </form>

    <div hidden class="row resultados">
        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default" style="font-family: serif">
                <div class="panel-heading"><span style="font-weight: bold">Resultados</span>
                </div>
                <div class="panel-body">
                    <div hidden class="resultados_dialogo text-center" style="color:red; font-size: 20px">

                    </div>

                    <div hidden class="table-responsive resultados_tabla">

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')

    <script type="text/javascript">

        var fechaInicio = null;
        var idNicho = null;
        var tipo = null;

        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        //funcion en la que pasamos un id de parcela o de nicho y el tipo si es parcela o nicho.
        function cargar(id,tip){

            var cadena = "";

            cadena += $("#nicho"+id)[0].children[0].textContent + ", "
            if( $("#nicho" + id)[0].children[2].textContent != ""){
                cadena +=  $("#nicho"+id)[0].children[2].textContent + ", "
            }else{
                cadena +=  $("#nicho"+id)[0].children[3].textContent + ", "
            }
            cadena += $("#nicho"+id)[0].children[4].textContent + ", "
            cadena += $("#nicho"+id)[0].children[6].textContent;

            $("#select").html(cadena);

            idNicho = id;
            tipo = tip;

            //Peticion ajax para ir rellenando los datos de una nueva factura
            $.ajax({
                type: "GET",
                url: "{{ URL::route('getFin') }}",
                data: { id:id},
                dataType: "html",
                success: function (data) {
                    fechaInicio = data;
                },
                error: function () {

                    Lobibox.notify('error', {
                        title: 'No se ha podido cargar los datos del nicho',
                        showClass: 'flipInX',
                        delay: 3000,
                        delayIndicator: false,

                        position: 'bottom left',
                        msg: 'Compruebe la conexión a internet'
                    });
                }
            });
        }



        function actualizar(id,tipo,inicio,fin){
            //Peticion ajax para ir rellenando los datos de una nueva factura
            $.ajax({
                type: "GET",
                url: "{{ URL::route('actualizaFactura') }}",
                data: { id:id, tipo:tipo,inicio:inicio,fin:fin},
                dataType: "html",
                success: function (data) {

                    //Añadimos lo que devuelve la peticion que es un enlace para
                    //visualizar y descargar el recibo.
                $(".enlace").html(data);

                },
                error: function () {

                    Lobibox.notify('error', {
                        title: 'No se ha podido actualizar la fecha',
                        showClass: 'flipInX',
                        delay: 3000,
                        delayIndicator: false,

                        position: 'bottom left',
                        msg: 'Compruebe la conexión a internet'
                    });
                }
            });
        }

        $('.fecha_ini').datepicker({
            format: "yyyy-mm-dd",
            language: "es",
            multidate: false,
            viewMode: "years",
            autoclose: true,
            todayHighlight: true
        });

        $('.fecha_fin').datepicker({
            format: "yyyy-mm-dd",
            language: "es",
            multidate: false,
            viewMode: "years",
            autoclose: true,
            todayHighlight: true
        });

        $(document).ready(function () {


            var navListItems = $('div.setup-panel div a'),
                    allWells = $('.setup-content'),
                    allNextBtn = $('.nextBtn');

            allWells.hide();

            navListItems.click(function (e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                        $item = $(this);

                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-primary').addClass('btn-default');
                    $item.addClass('btn-primary');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });


            allNextBtn.click(function(){
                var curStep = $(this).closest(".setup-content"),
                        curStepBtn = curStep.attr("id"),
                        nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                        curInputs = curStep.find("input[type='text'],input[type='url']"),
                        isValid = true;

                        //para que no se pueda seguir si la peticion ajax no se elige ningún nicho.
                        if(curStepBtn == 'step-1'){

                            if($("#select").text() == " ")
                            {
                                isValid = false;
                            }else{
                                isValid = true;
                                $(".resultados")[0].setAttribute("hidden","");
                                //Al ir al siguiente paso ponemos la fecha que corresponde al la ultima pagada
                                $('.fecha_ini').datepicker('update', new Date(fechaInicio, 0, 1));
                                fechaInicio = parseInt(fechaInicio)+1;
                                $('.fecha_fin').datepicker('update', new Date(fechaInicio, 0, 1));
                            }
                        }

                        //si vamos a pasar al paso 3 hacemos peticion ajax para actualizar la fecha fin de la factura
                        if(curStepBtn == 'step-2'){
                            actualizar(idNicho,tipo,$(".fecha_ini").val(),$(".fecha_fin").val());
                        }

                $(".form-group").removeClass("has-error");
                for(var i=0; i<curInputs.length; i++){
                    if (!curInputs[i].validity.valid){
                        isValid = false;
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                }

                if (isValid)
                    nextStepWizard.removeAttr('disabled').trigger('click');
            });

            $('div.setup-panel div a.btn-primary').trigger('click');



            $("#botonbuscar").on('click',function(e){

                e.preventDefault();

                $.ajax({
                    type: "GET",
                    url: "{{ URL::route('listarNichos') }}",
                    data: $('#listarNichos').serialize(),
                    dataType: "html",
                    success: function (data) {
                        $(".resultados")[0].removeAttribute("hidden");
                        if(data == 0 ){
                            $(".resultados_dialogo")[0].removeAttribute("hidden");
                            $(".resultados_tabla")[0].setAttribute("hidden",'');
                            $(".resultados_dialogo").html("Ningún resultado.");
                        }else if(data == 1) {
                            $(".resultados_dialogo")[0].removeAttribute("hidden");
                            $(".resultados_tabla")[0].setAttribute("hidden",'');
                            $(".resultados_dialogo").html("Hay más de 30 resultados para esta búsqueda por favor especifica más parámetros de búsqueda.");
                        }else{
                            $(".resultados_dialogo")[0].setAttribute("hidden",'');
                            $(".resultados")[0].removeAttribute("hidden");
                            $(".resultados")[0].removeAttribute("hidden");
                            $(".resultados_tabla")[0].removeAttribute("hidden");
                            $(".resultados_tabla").html(data)
                        }
                    },
                    error: function () {
                        Lobibox.notify('error', {
                            title: 'No se ha podido realizar la búsqueda',
                            showClass: 'flipInX',
                            delay: 3000,
                            delayIndicator: false,

                            position: 'bottom left',
                            msg: 'Compruebe la conexión a internet'
                        });
                    }
                });

            });


            $(document).on('click','.pagination a', function(e){

                e.preventDefault();

                var page = $(this).attr('href').split('page=')[1];

                var url;
                var data;

                url = "{{ URL::route('listarNichos') }}";
                data = $('#listarNichos').serialize() + "?page?="+page;

                $.ajax({
                    type: "GET",
                    url: url,
                    data:data,
                    success: function(data){ $('.resultados_tabla').html(data); }

                })
            });




        });


    </script>

    <!--comentario -_>

@endsection




