@extends('master')

@section('title')

    <h2 style="color: white; font-weight: bold; margin-left:10px; ">Editar factura </h2>
@endsection

@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('datepickersandbox/css/bootstrap-datepicker3.min.css') }}">


    <style>

        a:hover{
            cursor: pointer;
        }
        span{
            font-weight: bold;

        }
    </style>

@endsection

@section('contenido')

    <br>
    <div class="row" style="margin-top: 1%">

        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="panel panel-info">

                <?php

                $aux = $f->numero;
                $aux = strlen($aux);
                $aux = 5- $aux;
                ?>
                <div class="panel-heading"><span style="font-weight: bold">Factura {{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}  </span>
                </div>
                <div class="panel-body">



                    <div class="row">
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12"><span>Factura nº: </span> {{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}} <br> <span>Fecha:</span> {{$f->inicio}} </div>
                            <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12"><span>Datos del nicho</span> <br> <span>Titular: </span> {{$f->nombre_titular}}<br> <span>Calle: </span> {{$f->calle}}<span> <br>Numero: </span> {{$f->nicho_numero}}<span> <br>Tramada: </span> {{$f->tramada}}<br> <br> <span>Difunto: </span> {{$f->nom_difunto}}</div>
                            <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12"><span>Datos de facturación </span><br><span>Nombre y apellidos: </span> {{$f->nom_facturado}} <br><span>NIF/CIF: </span> {{$f->nif_facturado}}<br><span>Domicilio: </span> {{$f->dir_facturado}} <br> {{$f->cp_facturado}}<br>{{$f->pob_facturado}}/{{$f->pro_facturado}}</div>
                        </div>


                        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
                    </div>

                    <br>
                    <hr>
                    <br>

                    <div class="row">


                        <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">


                            <div class="form-group">
                                <label class="control-label" for="servicios">Servicios preestablecidos</label>
                                <select class="form-control" name="servicios" id="servicios">
                                    @foreach($servicios as $servicio)
                                        <option value="{{$servicio->id}}" data-price="{{$servicio->importe}}" data-codigo="{{$servicio->codigo}}" id="servicio{{$servicio->id}}">{{$servicio->concepto}}</option>
                                    @endforeach

                                </select></div>

                        </div>

                        <div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <button type="button" class="btn btn-info add">Añadir</button>

                        </div>
                    </div>


                    <br>
                    <div class="row">


                        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">


                            <div class="table-responsive">

                                <table class="table table-bordered table-hover table-condensed" cellspacing="10" cellpadding="10">
                                    <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Concepto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Acciones</th>

                                    </tr>
                                    </thead>
                                    <tbody class="facturas">


                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <th style="border-color: transparent"></th>
                                        <th style="border-color: transparent"></th>
                                        <th style="text-align: right; border-bottom-color: transparent">Base</th>
                                        <th style="text-align: right" id="base"></th>
                                        <th></th>

                                    </tr><tr>
                                        <th style="border-color: transparent"></th>
                                        <th style="border-color: transparent"></th>
                                        <th style="text-align: right; border-bottom-color: transparent">IVA 21%</th>
                                        <th style="text-align: right" id="iva"></th>
                                        <th></th>

                                    </tr><tr>
                                        <th style="border-color: transparent"></th>
                                        <th style="border-color: transparent"></th>
                                        <th style="text-align: right; border-bottom-color: transparent">Total Factura</th>
                                        <th style="text-align: right" id="total"></th>
                                        <th><button class="btn btn-warning">Cerrar Factura</button></th>

                                    </tr>
                                    </tfoot>

                                    <tfoot>
                                    <tr>
                                        <th><input style="margin: 10px" type="text" id="codigo"></th>
                                        <th><input style="margin: 10px" type="text" id="concepto"></th>
                                        <th><input class="cantidad" style="margin: 10px" type="number" min="0" value="1"></th>
                                        <th><input style="margin: 10px" type="text" id="precio"></th>
                                        <th><button type="button" class="btn btn-success btn-xs addd">Añadir</button></th>

                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                      </div>
            </div>
        </div>
    </div>


@endsection

@section('jquery')

    <script type="text/javascript">

        $(document).ready(function(){


            $('.add').on('click',function(){

                var value = $('#servicios').val();

                if(value != null) {
                    var servicio = $('#servicio' + value);

                    var price = servicio.attr("data-price");
                    var codigo = servicio.attr("data-codigo");
                    var concepto = servicio.text();
                    servicio.remove();

                    $('.facturas').append("<tr><td>"+codigo+"</td><td>"+concepto+"</td><td><input id='cantidad' type='number' min='1' value='1'></td><td class='asumar'>"+price+"</td><td><a><button type='button' class='btn btn-danger btn-xs'>Quitar</button></a></td></tr>");

                    recalcular();
                }
            });


            $('.addd').on('click',function(){

                var codigo = $('#codigo').val();
                var concepto = $('#concepto').val();
                var cantidad = $('.cantidad').val();
                var price = $('#precio').val();

                if(price != "") $('.facturas').append("<tr><td>"+codigo+"</td><td>"+concepto+"</td><td><input id='cantidad' type='number' min='1' value='"+cantidad+"'></td><td class='asumar'>"+price+"</td><td><a><button type='button' class='btn btn-danger btn-xs'>Quitar</button></a></td></tr>");
                recalcular();


            });


            $("tbody").on('change', 'input#cantidad',function(){
                recalcular();
            });

        });

        function recalcular (){

            var total = 0.00;
            $('.asumar').each(function(){

                var c = $(this).parent(1).children(1).children(1).val();
                total += (parseFloat($(this).text()))*c;

            });

            $('#base').text(total.toFixed(2) + " €");
            $('#iva').text((total*0.21).toFixed(2) + " €");
            $('#total').text((total*1.21).toFixed(2) + " €");

        }

    </script>


@endsection
