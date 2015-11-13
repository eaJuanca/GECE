@extends('master')

@section('title')
<h2 style="color: white; font-weight: bold; margin-left:10px; "> Modificar Calle </h2>
<p class="pull-right"><a href="{{ URL::previous() }}" class="btn btn-md btn-material-orange back fa fa-reply"></a></p>

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

            <form  id="nombre_panteones" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

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

            <?php
                $indice = 0;
            ?>

            @foreach($parcelas as $parcela)

                <?php
                  if($indice%3 == 0)
                        echo "<div class='row'>";
                ?>

                <div class="col-xs-12 col-md-12 col-lg-4 text-center">
                    <form id="{!!$parcela->id!!}" class="parcela">

                        <div class="form-group">

                            <label for="inputFile" class="col-lg-2 ">Número</label>
                            <div class="col-lg-10">
                                <input type="text" name="numero" class="form-control" id="inputNombre" value="{{$parcela->numero}}" placeholder="Nombre de la calle" required>
                            </div>

                            <label for="inputFile" class="col-lg-2 ">Tamaño</label>
                            <div class="col-lg-10">
                                <input type="text" name="tamanyo" class="form-control" id="tamanyo" value="{{$parcela->tamanyo}}" placeholder="tamaño" required>
                            </div>

                            <div class="row">
                                <label class="col-lg-2 margin">altura</label>
                                <div class="col-lg-9">

                                    <select class="form-control select" min="{!!count($tramadas[$indice][1])!!}" id="tramparc_{!!$indice+1!!}" name="tramadas">

                                        <?php

                                            if(count($tramadas[$indice][1]) > 0){

                                                for($i = 1; $i <= 9 ; $i++){

                                                    if($i == count($tramadas[$indice][1]))
                                                        echo " <option selected>  " . $i . "</option>";
                                                    elseif($i > count($tramadas[$indice][1]) )
                                                        echo " <option>  " . $i . "</option>";
                                                }


                                            }else{
                                               echo " <option>- ¿Qué altura tiene la parcela? -</option>";

                                                for($i = 1; $i <= 9 ; $i++){
                                                    echo " <option>  " . $i . "</option>";
                                                }

                                            }
                                        ?>

                                    </select>


                                </div>
                            </div>

                        </div>

                        <br>

                        <div class="form-group grupo_nichos_p{!!$indice+1!!}" style="display:none">
                            <label for="select" class="col-lg-12">Nº nichos por tramada</label>
                            <div class="row col-lg-12 inputs col-lg-offset-2">

                                @for($j = 1; $j <= count($tramadas[$indice][1]); $j++)
                                    <input type='number' class='col-lg-3 t_margin tramadav' min="{{$tramadas[$indice][1][0]->nichos}}" name='tramada{!!$j!!}_p{!!$parcela->id!!}' id='tramada{!!$j!!}_p{!!$indice+1!!}' value="{{$tramadas[$indice][1][0]->nichos}}" placeholder='tra-{!!$j!!}' required>
                                    <input type='hidden' name="tra{!!$j!!}" value="{{$tramadas[$indice][1][0]->id}}">
                                @endfor
                                @for($j = count($tramadas[$indice][1])+1; $j <= 9; $j++)
                                    <input type='number' class='col-lg-3 t_margin tramadav'  name='tramada{!!$j!!}_p{!!$parcela->id!!}' id='tramada{!!$j!!}_p{!!$indice+1!!}' placeholder='tra-{!!$j!!}' required>
                                @endfor
                            </div>
                        </div>


                        <button class="btn btn-success btn-raised pull-right">Modificar parcela</button>

                    </form>
                </div>

                    <?php
                        //Incrementamos el indice para imprimir los datos de la siguiente parcela
                        $indice+=1;
                    ?>

                    <?php
                    if($indice%3 == 0)
                        echo "</div>";
                    ?>
            @endforeach
        </div>

    </div>
</div>


@endsection

@section('js')

<script type="text/javascript">

    $(document).ready(function () {

        var idParcelaStatico = 0;

        var tramadas = $("#tramadas").val();

        //Desocultamos los inputs de las tramadas cuyas parcelas tienen valor en ellas.
        var tramadas = "{!!count($tramadas)!!}";

        for( var i = 1; i <= tramadas ; i++){
            //Obtenemos el valor del input que se ha cargado para pasarlo a mostrarTramadas
            var actual = $("#tramparc_" + i).val();
            //llamamos a mostrar tramada para que los muestra pasando como primer el valor del select y la parcela que es
            mostrarTramadas(actual,i);
        }

        $(".n_nichos").css("display",'block');

        $("#nombre_panteones").submit(function(e){

            e.preventDefault()

            $.ajax({
                type: "GET",
                url: "{{ URL::route('editarNombre') }}",
                data: $("#nombre_panteones").serialize() + "&idCalle={{$calle->id}}",
                dataType: "html",
                success: function (data) {

                    alert(data);
                    Lobibox.notify('success', {
                        title: 'Nombre cambiado',
                        showClass: 'flipInX',
                        delay: 3000,
                        delayIndicator: false,
                        position: 'bottom left',
                        icon: 'fa fa-thumbs-up'

                    });

                    location.reload();
                }
            });
        });

        //Creamos x peticiones ajax para asociarlas a las x parcelas
        $(".parcela").submit(function(e){
            //Obtenemos el id de la parcela que se ha editado cuyo formulario se ha hecho submit
            var idParcela = this.getAttribute('id');

            e.preventDefault();

            $.ajax({
                type: "GET",
                url: "{{ URL::route('editarParcela') }}",
                data: $('#'+idParcela).serialize() + "&idParcela="+idParcela,
                dataType: "html",
                error: function () {
                    alert("entra en error");
                },
                success: function (data) {

                    Lobibox.notify('success', {
                        title: 'Parcela modificada',
                        showClass: 'flipInX',
                        delay: 3000,
                        delayIndicator: false,
                        position: 'bottom left',
                        icon: 'fa fa-thumbs-up'

                    });

                    location.reload();
                }
            });
        });


        $(".select").on("change",function() {
            idParcelaStatico = this.getAttribute('id');
            idParcelaStatico = idParcelaStatico.substring(idParcelaStatico.indexOf("_")+1,idParcelaStatico.length);
            mostrarTramadas(this.value,idParcelaStatico);
            var numTramdas = parseInt($("#tramparc_"+idParcelaStatico).val());
            var number = $("#tramada1_p"+idParcelaStatico).val();
            asignarValores(1,numTramdas,number,idParcelaStatico);
        });


        function mostrarTramadas(value,parcela){

            if($.isNumeric(value)){

                //Al cambiar ocultamos todas las tramadas de la parcela "parcela"
                for(var i = 1; i <= 9; i++)
                {
                    $('#tramada' + i + '_p'+ parcela)[0].setAttribute("type", "hidden");
                }

                //hacemos visible lo de nº de nichos
                $(".grupo_nichos_p" + parcela ).css("display",'block');

                for(var i = 1; i <= value; i++)
                {
                    $('#tramada' + i + '_p'+ parcela)[0].setAttribute("type", "number");
                }

            }else{

                //Al cambiar ocultamos todas las tramadas de la parcela "parcela"
                for(var i = 1; i <= 9; i++)
                {
                    $('#tramada' + i + '_p'+ parcela)[0].setAttribute("type", "hidden");
                }

                $(".grupo_nichos_p" + parcela).css("display",'none');
            }
        }

        //Asociamos el evento onchange para que todos cambien si cambia uno
        $(".tramadav").on("change",function(e){
            idParcelaStatico = this.getAttribute('id');
            idParcelaStatico = idParcelaStatico.substring(idParcelaStatico.indexOf("_")+2,idParcelaStatico.length);
            //obtenemos las tramadas
            var numTramdas = parseInt($("#tramparc_"+idParcelaStatico).val());
            asignarValores(1,numTramdas,this.value,idParcelaStatico);
        });

        function asignarValores(inicio, fin,number,parcela){
            for(var i = inicio; i <= fin; i++) {
                $('#tramada' + i + '_p'+ parcela).val(number);
            }
        }

    });

</script>

@endsection




