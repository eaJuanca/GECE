@extends('master')

@section('css')

    <link href="//cdn.datatables.net/responsive/1.0.6/js/dataTables.responsive.min.js" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">

@endsection

@section('contenido')

    </br>

    <div class="row well" style="margin: 0">
        <div class="col col-xs-2 col-sm-2 col-md-1 col-lg-1">
            <button class="btn btn-default btn-fab mdi-content-add mdi-action-grade" data-toggle="modal" data-target="#altaCalle"></button>
        </div>
        <div class="col col-xs-10 col-sm-10 col-md-11 col-lg-11">
            <h3>Añadir calle</h3>
        </div>

    </div>

    </br>
    <div class="panel panel-primary">
        <div class="panel-heading gc_Pheading">
            <legend>Calles del cementerio</legend>
        </div>
        <div class="panel-body">
            <table id="example" class=" responsive table-striped table-hover " cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
                <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending" style="width: 75px;">Cód</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Last name: activate to sort column ascending" style="width: 74px;">Nombre</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 171px;">Tramadas</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 79px;">Nichos</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 28px;">Tipo</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 71px;">Acciones</th>
                </tr>
                </thead>

                <tbody>

                @if(!$calles->isEmpty())

                    @foreach($calles as $calle)

                        <tr role="row" class="odd">
                            <td class="sorting_1">{{$calle->id}}</td>
                            <td>{{$calle->nombre}}</td>
                            <td>{{$calle->num_tramadas}}</td>
                            <td>{{$calle->total}}</td>
                                @if($calle->tipo_calle == 1)
                                    <td>Calle</td>
                                @else
                                    <td>Panteón</td>
                                @endif
                            <td>Acciones</td>
                        </tr>

                    @endforeach
                @endif

                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL ALTA CALLE -->
    <div class="modal fade" id="altaCalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nueva Calle del Cementerio Parroquial</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="form-alta">

                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                        <fieldset>
                            <div class="form-group">
                                <label for="inputFile" class="col-lg-2 ">Nombre</label>
                                <div class="col-lg-10">
                                    <input type="text" name="nombre" class="form-control" id="inputEmail" placeholder="Nombre de la calle" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-5">¿Es un panteón o una Capilla?</label>
                                <div class="col-lg-7">
                                    <div class="radio radio-primary">
                                        <label>
                                            <input id="tipo1" name="tipo_calle" type="radio" name="optionsRadios" class="tipo" value="1" checked>
                                                Calle
                                        </label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <label>
                                            <input id="tipo2" name="tipo_calle" type="radio" name="optionsRadios" class="tipo" value="2">
                                                Panteón/Capilla
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="parte_parcelas" style="display: none;">
                                <div class="form-group parcelas" >
                                    <label for="select" class="col-lg-2">Parcelas</label>
                                    <div class="col-lg-10">
                                        <select class="form-control parcelas" id="parcelas" name="num_parcelas">
                                            <option>- ¿Cuántas parcelas tiene el panteón? -</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                            <option>9</option>
                                            <option>10</option>
                                        </select>
                                    </div>
                                </div>


                                <!--<div class="n_parcelas" style="display: none;">

                                    <div class="form-group" id="parcela1">
                                        <label class="col-lg-12">Configuración parcela 1:</label>
                                        <hr>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tamaño parcela 1</label>
                                            <input class='col-lg-3' name='parcela2' placeholder='Tamaño parcela' required>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tramadas parcela 1</label>
                                            <div class="col-lg-7">
                                                <select class="form-control" id="tram_parc_1" name="tram_parc_1">
                                                    <option>- ¿Cuántas parcelas tiene el panteón? -</option>
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

                                        <div class="row" hidden>
                                            <label for="select" class="col-lg-5 margin">Nº nichos tramada parcela 1</label>
                                            <div class="row col-lg-9 inputs">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-lg-9 inputs">

                                        <input type='hidden' class='col-lg-3 t_margin' name='parcela2' id='parcela2' placeholder='Parcela 2' required>
                                        <input type='hidden' class='col-lg-3 t_margin' name='parcela3' id='parcela3' placeholder='Parcela 3' required>
                                        <input type='hidden' class='col-lg-3 t_margin' name='parcela4' id='parcela4' placeholder='Parcela 4' required>
                                        <input type='hidden' class='col-lg-3 t_margin' name='parcela5' id='parcela5' placeholder='Parcela 5' required>
                                        <input type='hidden' class='col-lg-3 t_margin' name='parcela6' id='parcela6' placeholder='Parcela 6' required>
                                        <input type='hidden' class='col-lg-3 t_margin' name='parcela7' id='parcela7' placeholder='Parcela 7' required>
                                        <input type='hidden' class='col-lg-3 t_margin' name='parcela8' id='parcela8' placeholder='Parcela 8' required>
                                        <input type='hidden' class='col-lg-3 t_margin' name='parcela9' id='parcela9' placeholder='Parcela 9' required>
                                        <input type='hidden' class='col-lg-3 t_margin' name='parcela10' id='parcela10' placeholder='Parcela 10' required>
                                    </div>
                                </div>-->
                            </div>


                            <div class="parte_tramadas">
                                <div class="form-group">
                                    <label for="select" class="col-lg-2">Altura</label>
                                    <div class="col-lg-10">
                                        <select class="form-control" id="tramadas" name="num_tramadas">
                                            <option>- Selecciona número de tramadas -</option>
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
                                <div class="form-group n_nichos" >
                                    <label for="select" class="col-lg-3">Nº nichos por tramada</label>
                                    <div class="row col-lg-9 inputs">
                                        <input type='hidden' class='col-lg-3 t_margin' name='tramada1' id='tramada1' placeholder='Tramada 1' required>
                                        <input type='hidden' class='col-lg-3 t_margin' name='tramada2' id='tramada2' placeholder='Tramada 2' required>
                                        <input type='hidden' class='col-lg-3 t_margin' name='tramada3' id='tramada3' placeholder='Tramada 3' required>
                                        <input type='hidden' class='col-lg-3 t_margin' name='tramada4' id='tramada4' placeholder='Tramada 4' required>
                                        <input type='hidden' class='col-lg-3 t_margin' name='tramada5' id='tramada5' placeholder='Tramada 5' required>
                                        <input type='hidden' class='col-lg-3 t_margin' name='tramada6' id='tramada6' placeholder='Tramada 6' required>
                                        <input type='hidden' class='col-lg-3 t_margin' name='tramada7' id='tramada7' placeholder='Tramada 7' required>
                                        <input type='hidden' class='col-lg-3 t_margin' name='tramada8' id='tramada8' placeholder='Tramada 8' required>
                                        <input type='hidden' class='col-lg-3 t_margin' name='tramada9' id='tramada9' placeholder='Tramada 9' required>
                                    </div>
                                </div>
                            </div>
                        </fieldset>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- FIN MODAL ALTA CALLE-->

@endsection

@section('jquery')


<script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/bootstrapvalidator/bootstrapValidator.min.js') }}"></script>
<script src="//cdn.datatables.net/responsive/1.0.6/js/dataTables.responsive.min.js"></script>



<script type="text/javascript">


    $(document).ready(function(){

        $(document).ajaxStop($.unblockUI);


        $.material.init();

        $('#example').DataTable();

        /*
            Función ajax para dar de alta una calle
         */
        $("#form-alta").submit(function(e){

            //obtenemos el num de tramadas
            var tramadas = $("#tramadas").val();

            if(parseInt(tramadas) > 0 && parseInt(tramadas) <= 9) {

                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ URL::route('altaCalle') }}",
                    data: $("#form-alta").serialize(),
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
                alert("Selecciona nº de tramdas");
            }

        });


        /*
            Función para imprimir una parte u otra del form en funcion del tipo de calle
        */
        $(".tipo").on("change",function(){

            if($('#tipo1').is(':checked')){
                //si es calle entramos aquí

                //Ocultamos la parte de las parcelas
                $(".parte_parcelas").css("display",'none');
                $(".parte_tramadas").css("display",'block');
                //Al cambiar ocultamos todas

            }else{
                //si es pantenon aqui
                $(".parte_parcelas").css("display",'block');
                $(".parte_tramadas").css("display",'none');
            }
        });

        /*
            Función para imprimir los tamaños de las parcelas.
        */

        $('#parcelas').on("change",function() {

            if($.isNumeric(this.value)){


                    //Al cambiar ocultamos todas

                    for(var i = 1; i <= 10; i++)
                    {
                        //imprimir += "<input type='text' class='col-lg-3 t_margin' name='tramada" + i + " ' id='tramada" + i + " ' placeholder='Tramada "+ i +"' required>"

                        $('#parcela'+i)[0].setAttribute("type", "hidden");
                    }

                    //hacemos visible lo de nº de parcelas
                    $(".n_parcelas").css("display",'block');

                    //var imprimir = "";

                    for(var i = 1; i <= this.value; i++)
                    {
                        //imprimir += "<input type='text' class='col-lg-3 t_margin' name='tramada" + i + " ' id='tramada" + i + " ' placeholder='Tramada "+ i +"' required>"

                        $('#parcela'+i)[0].setAttribute("type", "text");
                    }

                    //$(".inputs").html(imprimir);
                }else{

                    $(".n_parcelas").css("display",'none');
                }

        });

        /*
         Función para imprimir las tramadas
         */
        $('#tramadas').on("change",function(){

            if($.isNumeric(this.value)){

                //Al cambiar ocultamos todas

                for(var i = 1; i <= 9; i++)
                {
                    //imprimir += "<input type='text' class='col-lg-3 t_margin' name='tramada" + i + " ' id='tramada" + i + " ' placeholder='Tramada "+ i +"' required>"

                    $('#tramada'+i)[0].setAttribute("type", "hidden");
                }

                //hacemos visible lo de nº de nichos
                $(".n_nichos").css("display",'block');

                //var imprimir = "";

                for(var i = 1; i <= this.value; i++)
                {
                    //imprimir += "<input type='text' class='col-lg-3 t_margin' name='tramada" + i + " ' id='tramada" + i + " ' placeholder='Tramada "+ i +"' required>"

                    $('#tramada'+i)[0].setAttribute("type", "text");
                }

                //$(".inputs").html(imprimir);
            }else{
                $(".n_nichos").css("display",'none');
            }

        });


        $('#tram_parc_1').on("change",function() {
            alert("entra");
        });



    });

</script>

@endsection