@extends('master')

@section('title')
    <h2 style="color: white; font-weight: bold; margin-left:10px; "> Modificar Calle </h2>
@endsection


@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('datepickersandbox/css/bootstrap-datepicker3.min.css') }}">


@endsection

@section('contenido')

    <div class="panel panel-info" style="margin-top: 20px">
        <div class="panel-heading">
            <h3 class="panel-title" style="color: white">Modificar datos de la calle: {{$calle->nombre}}</h3>
        </div>
        <div class="panel-body">

            @if($calle->tipo_calle == 1)

                <form id="editar-nicho">

                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                    <input type="hidden" class="form-control" name="id" value="{{$calle->id}}">


                    <div class="row">
                        <section class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">

                            <div class="form-group">
                                <label for="inputFile" class="col-lg-2 ">Nombre</label>
                                <div class="col-lg-10">
                                    <input type="text" name="nombre" class="form-control" id="inputNombre" placeholder="Nombre de la calle" required>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-lg-2 margin">Tramadas</label>
                                <div class="col-lg-9">
                                    <select class="form-control" id="tram_parc_3" name="tram_parc_3">
                                        <option>- ¿Cuántas tramadas tiene la parcela? -</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                    </select>
                                </div>
                            </div>

                            <br>

                        </section>

                    </div>

                    <button class="btn btn-success btn-raised">Modificar calle</button>

                </form>

            @else

                <h1>panteon</h1>

            @endif


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

           /* $('#editar-nicho').submit(function (e) {

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

                        Lobibox.notify('success', {
                            title: 'Nicho modificado correctamente',
                            showClass: 'flipInX',
                            delay: 3000,
                            delayIndicator: false,
                            position: 'bottom left'
                        });
                    }
                });
            });*/
        });


    </script>

@endsection




