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
                <p>Previsualización</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
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

                            <div class="col col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="nombrebuscar">Nombre y apellidos</label>
                                    <input type="text" required id="nombrebuscar" class="form-control" name="nombrebuscar">
                                </div>
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="col col-lg-12">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="corriente" name="corriente"><span class="checkbox-material"><span class="check"></span></span> <span style="font-weight: bold;">Al corriente</span>
                                            </label>
                                        </div>
                                    </div>
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
                                    <button type="submit" id="botonbuscar" class="btn btn-success">
                                        <i class="fa fa-search"></i>
                                    </button>

                                </div>
                            </div>

                        </div>

                    <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="panel panel-default">
                            <div class="panel-heading"><span style="font-weight: bold">Listado de nichos</span>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">

                                    <table class="table table-bordered table-hover table-condensed" cellspacing="0" cellpadding="0">
                                        <thead>
                                        <tr>
                                            <th>Cod</th>
                                            <th>Difunto</th>
                                            <th>Fecha defunción</th>
                                            <th>Localidad</th>
                                            <th>Sexo</th>
                                            <th>Nicho</th>
                                        </tr>
                                        </thead>
                                        <tbody class="difuntos">
                                    </table>
                                </div>
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
                    <h3> Step 2</h3>
                    <div class="form-group">
                        <label class="control-label">Company Name</label>
                        <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Company Address</label>
                        <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address"  />
                    </div>
                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-3">
            <div class="col-xs-6 col-md-offset-3">
                <div class="col-md-12">
                    <h3> Step 2</h3>
                    <div class="form-group">
                        <label class="control-label">Company Name</label>
                        <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Company Address</label>
                        <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address"  />
                    </div>
                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-4">
            <div class="col-xs-6 col-md-offset-3">
                <div class="col-md-12">
                    <h3> Step 3</h3>
                    <button class="btn btn-success btn-lg pull-right" type="submit">Generar</button>
                </div>
            </div>
        </div>
    </form>
    </div>

@endsection

@section('js')

    <script type="text/javascript">

        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
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

                        console.log(data);
                    },
                    error: function () {

                    }
                });

            });
        });

    </script>

    <!--comentario -_>

@endsection




