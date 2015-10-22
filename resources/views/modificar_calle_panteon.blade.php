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

        <div class="row">

            <form class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="form-group">
                    <label for="inputFile" class="col-lg-2 ">Nombre</label>
                    <div class="col-lg-10">
                        <input type="text" name="nombre" class="form-control" id="inputNombre" value="{{$calle->nombre}}" placeholder="Nombre de la calle" required>
                    </div>
                </div>

                <button class="btn btn-success btn-raised pull-right">Modificar nombre</button>

            </form>
        </div>

        <div class="row">
            @foreach($parcelas as $parcela)


                <div class="col-xs-12 col-md-12 col-lg-4 text-center">
                    <form id="{{"parcela" . $parcela->id}}">

                        <div class="form-group">

                            <label for="inputFile" class="col-lg-2 ">Número</label>
                            <div class="col-lg-10">
                                <input type="text" name="nombre" class="form-control" id="inputNombre" value="{{$parcela->numero}}" placeholder="Nombre de la calle" required>
                            </div>

                            <label for="inputFile" class="col-lg-2 ">Tamaño</label>
                            <div class="col-lg-10">
                                <input type="text" name="nombre" class="form-control" id="inputNombre" value="{{$parcela->tamanyo}}" placeholder="Nombre de la calle" required>
                            </div>

                            <div class="row">
                                <label class="col-lg-2 margin">Tramadas</label>
                                <div class="col-lg-9">

                                    <select class="form-control" id="tramadas" name="tramadas">

                                        <?php

                                            $indice = 0;

                                            if(count($tramadas[$indice][1]) > 0){

                                                for($i = 1; $i <= 9 ; $i++){

                                                    if($i == count($tramadas[$indice][1]))
                                                        echo " <option selected>  " . $i . "</option>";
                                                    else
                                                        echo " <option>  " . $i . "</option>";
                                                }

                                                $indice++;
                                            }else{

                                            }

                                        ?>
                                    </select>

                                </div>
                            </div>

                        </div>

                        <button class="btn btn-success btn-raised pull-right" onclick="modificar('{{$parcela->id}}')">Modificar parcela</button>

                    </form>
                </div>
            @endforeach
        </div>

    </div>
</div>


@endsection

@section('js')

<script type="text/javascript">

    function modificar(id){




    }


    //Nada más cargar la vista obtemos el nº de tramadas que tiene la calle y el nicho
    var actualTramdas = $("#tramadas").val();
    var actualNichos = $("#tramada1").val();
    var iguales = true;

    $(document).ready(function () {


        var token = "{{ csrf_token()}}";

        var tramadas = $("#tramadas").val();

        //Desocultamos el numero de inputs que se cargen en el selected
        mostrarInputs(1,tramadas);

        $(".n_nichos").css("display",'block');

        $('#tramadas').on("change",function(){

            if($.isNumeric(this.value)){

                //Al cambiar ocultamos todas
                ocultarInputs(1,9);

                //hacemos visible lo de nº de nichos
                $(".n_nichos").css("display",'block');

                mostrarInputs(1,this.value);

                //$(".inputs").html(imprimir);
            }else{
                $(".n_nichos").css("display",'none');
            }

        });


        function ocultarInputs(inicio, fin){

            for(var i = inicio; i <= fin; i++) {
                $('#tramada' + i)[0].setAttribute("type", "hidden");
            }
        }

        function mostrarInputs(inicio, fin){

            for(var i = inicio; i <= fin; i++) {

                $('#tramada' + i)[0].setAttribute("type", "text");
            }
        }

        $("#editar-calle").submit(function(e){

            //obtenemos el num de tramadas que queremos insertar demás para comprobar si es mayor
            //que el valor actual.
            var tramadas = $("#tramadas").val();

            //Comprobamos también los nichos si coinciden y son mayor que el actual.
            var nichos = $('#tramada' + 1).val();

            comprobarNichos(tramadas);

            if(parseInt(tramadas) > 0 && parseInt(tramadas) <= 9 && ( (tramadas > actualTramdas && iguales) || (nichos > actualNichos && iguales) ) ) {

                e.preventDefault();

                $.ajax({
                    type: "GET",
                    url: "{{ URL::route('editarCalle') }}",
                    data: $("#editar-calle").serialize() + "&idCalle={{$calle->id}}",
                    dataType: "html",
                    error: function () {
                        alert("entra en error");
                    },
                    success: function (data) {

                        Lobibox.notify('success', {
                            title: 'Calle añadida',
                            showClass: 'flipInX',
                            delay: 3000,
                            delayIndicator: false,
                            position: 'bottom left'
                        });

                        location.reload();
                    }
                });
            }else
            {
                alert("Selecciona un nº de tramadas mayor al que ya hay");
            }
        });

        //Comprobamos si el nº de los nichos ha cambiado y si es en todos igual
        function comprobarNichos(fin){

            i = 2;

            while(iguales && i <= fin)
            {
                if( $('#tramada' + 1).val() !=  $('#tramada' + i).val())
                {
                    iguales = false;
                }

                i++;
            }
            /*for(var i = inicio; i <= fin; i++) {
             if( $('#tramada' + 1).val() !=  $('#tramada' + i).val()){
             iguales = false;
             }
             }*/
        }

    });

    /**
     * Comentario cambios
     */
</script>

@endsection




