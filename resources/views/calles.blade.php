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

                    <tr role="row" class="odd">
                        <td class="sorting_1">1</td>
                        <td>Calle San Antonio</td>
                        <td>1</td>
                        <td>2</td>
                        <td>Panteón</td>
                        <td>Acciones</td>
                    </tr>

                    <tr role="row" class="even">
                        <td class="sorting_1">2</td>
                        <td>Calle sal si puedes</td>
                        <td>2</td>
                        <td>4</td>
                        <td>Panteón</td>
                        <td>Acciones</td>
                    </tr>

                    <tr role="row" class="odd">
                        <td class="sorting_1">3</td>
                        <td>Calle Dr. Fleming</td>
                        <td>4</td>
                        <td>4</td>
                        <td>Panteón</td>
                        <td>Acciones</td>
                    </tr>
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
                    <form class="form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputFile" class="col-lg-2 ">Nombre</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputEmail" placeholder="Nombre de la calle">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-5">¿Es un panteón o una Capilla?</label>
                                <div class="col-lg-7">
                                    <div class="radio radio-primary">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                                                Ninguno
                                        </label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                                Panteón
                                        </label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                                Capilla
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="select" class="col-lg-2">Tramada</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="select">
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
                                <label for="select" class="col-lg-2">Nº nichos</label>
                                <div class="row col-lg-10 inputs">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- FIN MODAL ALTA CALLE-->

@endsection

<script src="{{ URL::asset('assets/js/jquery-2.1.4.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="//cdn.datatables.net/responsive/1.0.6/js/dataTables.responsive.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){

        $.material.init();
            $('#example').DataTable();

            $('#select').on("change",function(){

                if($.isNumeric(this.value)){
                    $(".inputs").html('');

                    //hacemos visible lo de nº de nichos
                    $(".n_nichos").css("display",'block');

                    var imprimir = "";

                    for(var i = 1; i <= this.value; i++)
                    {
                        imprimir += "<input type='text' class='col-lg-3 t_margin' id='tramada " + i + " ' placeholder='Tramada "+ i +"'>"

                    }

                    $(".inputs").html(imprimir);
                }else{
                    $(".n_nichos").css("display",'none');
                }

            });



    });

</script>

