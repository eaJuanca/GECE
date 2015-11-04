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


                        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('jquery')

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
                        position: 'bottom left'

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
                            position: 'bottom left'

                        });

                        $('.tdisponibles').append("<tr id='servicio"+data+"'><td>"+ codigo +"</td><td>"+ concepto +"</td><td>"+ importe +"</td><td><a onclick='borrarServicio("+data+")'> <button class='btn btn-warning btn-xs' id='borrarservicio'>Borrar <i class='fa fa-trash'></i></button></a></td></tr>");

                        $("#codigo").val('');
                        $("#concepto").val('');
                        $("#importe").val('');
                        // location.reload();
                    }
                });

            });

            });

    </script>

@endsection
