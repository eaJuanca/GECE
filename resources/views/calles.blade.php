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
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 79px;">Panteones</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 28px;">Tipo</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 71px;">Acciones</th>
                </tr>
                </thead>

                <tbody>

                <div class="paginacion" style="float: right"></div>

                @if(!$calles->isEmpty())

                    @foreach($calles as $calle)

                        <tr role="row" class="odd">
                            <td class="sorting_1">{{$calle->id}}</td>
                            <td>{{$calle->nombre}}</td>
                            <td>{{$calle->num_tramadas}}</td>
                            <td>{{$calle->total}}</td>
                            <td>{{$calle->panteones}}</td>
                                @if($calle->tipo_calle == 1)
                                    <td>Calle</td>
                                @else
                                    <td>Panteón</td>
                                @endif
                            <td>
                                <a href="{{URL::to('modificar-calle-'. $calle->id)}}" data-toggle="tooltip" title="Editar" onclick="" style="margin-right: 10px; color:#03A9F4;" >
                                    <i class="fa fa-pencil-square-o  fa-lg fa-border" ></i >
                                </a>
                                <a class="borrar" data-toggle="tooltip" title=Borrar" style="margin-right: 10px; color:#F44336" onclick="borrar('{{$calle->id}}','{{$calle->tipo_calle}}')">
                                    <i class="fa fa-eraser  fa-lg fa-border " ></i >
                                </a>

                            </td>

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
                                    <input type="text" name="nombre" class="form-control" id="inputNombre" placeholder="Nombre de la calle" required>
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

                            <div class="form-group existente" style="display: none;">
                                <label for="select" class="col-lg-3">Calle Existente</label>
                                <div class="col-lg-9">
                                    <select class="form-control iexistente" id="iexistente" name="iexistente">
                                        <option value="-1">- Selecciona la calle -</option>
                                        @if(!$calles->isEmpty())

                                            @foreach($calles as $calle)

                                                <option value='{{$calle->id}}'>{{$calle->nombre}}</option>

                                            @endforeach
                                        @endif

                                    </select>
                                </div>
                            </div>

                            <div class="form-group numero" style="display: none">
                                <label for="inputFile" class="col-lg-2 ">Número</label>
                                <div class="col-lg-10">
                                    <input type="hidden" name="numero" class="form-control inumero" id="inputNumero" placeholder="Número de panteón" required>
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


                                <div class="n_parcelas" style="display: none;">

                                    <!-- Parcela 1 -->
                                    <div class="form-group" id="parcela1" style="display: none;">
                                        <label class="col-lg-12">Configuración parcela 1:</label>
                                        <hr>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tamaño parcela 1</label>
                                            <input type="hidden" class='col-lg-3 i1' name='parcela1' placeholder='Tamaño parcela' required>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tramadas parcela 1</label>
                                            <div class="col-lg-7">
                                                <select class="form-control" id="tram_parc_1" name="tram_parc_1">
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

                                        <div class="row" hidden>
                                            <label for="select" class="col-lg-5 margin">Nº nichos tramada parcela 1</label>
                                            <div class="row col-lg-9 inputs">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group n_nichos_p1" style="display: none;">
                                        <label for="select" class="col-lg-4">Nº Nichos tramada parcela 1</label>
                                        <div class="row col-lg-8 inputs">
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada1_p1' id='tramada1_p1' placeholder='Tramada1' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada2_p1' id='tramada2_p1' placeholder='Tramada 2' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada3_p1' id='tramada3_p1' placeholder='Tramada 3' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada4_p1' id='tramada4_p1' placeholder='Tramada 4' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada5_p1' id='tramada5_p1' placeholder='Tramada 5' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada6_p1' id='tramada6_p1' placeholder='Tramada 6' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada7_p1' id='tramada7_p1' placeholder='Tramada 7' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada8_p1' id='tramada8_p1' placeholder='Tramada 8' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada9_p1' id='tramada9_p1' placeholder='Tramada 9' required>
                                        </div>
                                    </div>

                                    <!-- Fin parcela 1 -->

                                    <!-- Parcela 2 -->

                                    <div class="form-group" id="parcela2" style="display: none;">
                                        <label class="col-lg-12">Configuración parcela 2:</label>
                                        <hr>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tamaño parcela 2</label>
                                            <input type="hidden" class='col-lg-3 i2' name='parcela2' placeholder='Tamaño parcela' required>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tramadas parcela 2</label>
                                            <div class="col-lg-7">
                                                <select class="form-control" id="tram_parc_2" name="tram_parc_2">
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

                                        <div class="row" hidden>
                                            <label for="select" class="col-lg-5 margin">Nº nichos tramada parcela 2</label>
                                            <div class="row col-lg-9 inputs">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group n_nichos_p2" style="display: none;">
                                        <label for="select" class="col-lg-4">Nº Nichos tramada parcela 2</label>
                                        <div class="row col-lg-8 inputs">
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada1_p2' id='tramada1_p2' placeholder='Tramada1' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada2_p2' id='tramada2_p2' placeholder='Tramada 2' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada3_p2' id='tramada3_p2' placeholder='Tramada 3' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada4_p2' id='tramada4_p2' placeholder='Tramada 4' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada5_p2' id='tramada5_p2' placeholder='Tramada 5' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada6_p2' id='tramada6_p2' placeholder='Tramada 6' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada7_p2' id='tramada7_p2' placeholder='Tramada 7' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada8_p2' id='tramada8_p2' placeholder='Tramada 8' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada9_p2' id='tramada9_p2' placeholder='Tramada 9' required>
                                        </div>
                                    </div>

                                    <!-- Fin Parcela 2 -->

                                    <!-- Parcela 3 -->

                                    <div class="form-group" id="parcela3" style="display: none;">
                                        <label class="col-lg-12">Configuración parcela 3:</label>
                                        <hr>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tamaño parcela 3</label>
                                            <input type="hidden" class='col-lg-3 i3' name='parcela3' placeholder='Tamaño parcela' required>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tramadas parcela 3</label>
                                            <div class="col-lg-7">
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

                                        <div class="row" hidden>
                                            <label for="select" class="col-lg-5 margin">Nº nichos tramada parcela 3</label>
                                            <div class="row col-lg-9 inputs">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group n_nichos_p3" style="display: none;">
                                        <label for="select" class="col-lg-4">Nº Nichos tramada parcela 3</label>
                                        <div class="row col-lg-8 inputs">
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada1_p3' id='tramada1_p3' placeholder='Tramada1' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada2_p3' id='tramada2_p3' placeholder='Tramada 2' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada3_p3' id='tramada3_p3' placeholder='Tramada 3' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada4_p3' id='tramada4_p3' placeholder='Tramada 4' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada5_p3' id='tramada5_p3' placeholder='Tramada 5' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada6_p3' id='tramada6_p3' placeholder='Tramada 6' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada7_p3' id='tramada7_p3' placeholder='Tramada 7' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada8_p3' id='tramada8_p3' placeholder='Tramada 8' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada9_p3' id='tramada9_p3' placeholder='Tramada 9' required>
                                        </div>
                                    </div>

                                    <!-- Fin parcela 3 -->

                                    <!-- Parcela 4 -->

                                    <div class="form-group" id="parcela4" style="display: none;">
                                        <label class="col-lg-12">Configuración parcela 4:</label>
                                        <hr>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tamaño parcela 4</label>
                                            <input type="hidden" class='col-lg-3 i4' name='parcela4' placeholder='Tamaño parcela' required>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tramadas parcela 4</label>
                                            <div class="col-lg-7">
                                                <select class="form-control" id="tram_parc_4" name="tram_parc_4">
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

                                        <div class="row" hidden>
                                            <label for="select" class="col-lg-5 margin">Nº nichos tramada parcela 4</label>
                                            <div class="row col-lg-9 inputs">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group n_nichos_p4" style="display: none;">
                                        <label for="select" class="col-lg-4">Nº Nichos tramada parcela 4</label>
                                        <div class="row col-lg-8 inputs">
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada1_p4' id='tramada1_p4' placeholder='Tramada1' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada2_p4' id='tramada2_p4' placeholder='Tramada 2' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada3_p4' id='tramada3_p4' placeholder='Tramada 3' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada4_p4' id='tramada4_p4' placeholder='Tramada 4' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada5_p4' id='tramada5_p4' placeholder='Tramada 5' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada6_p4' id='tramada6_p4' placeholder='Tramada 6' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada7_p4' id='tramada7_p4' placeholder='Tramada 7' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada8_p4' id='tramada8_p4' placeholder='Tramada 8' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada9_p4' id='tramada9_p4' placeholder='Tramada 9' required>
                                        </div>
                                    </div>

                                    <!-- Fin parcela 4 -->

                                    <!-- Parcela 5 -->

                                    <div class="form-group" id="parcela5" style="display: none;">
                                        <label class="col-lg-12">Configuración parcela 5:</label>
                                        <hr>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tamaño parcela 5</label>
                                            <input type="hidden" class='col-lg-3 i5' name='parcela5' placeholder='Tamaño parcela' required>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tramadas parcela 5</label>
                                            <div class="col-lg-7">
                                                <select class="form-control" id="tram_parc_5" name="tram_parc_5">
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

                                        <div class="row" hidden>
                                            <label for="select" class="col-lg-5 margin">Nº nichos tramada parcela 5</label>
                                            <div class="row col-lg-9 inputs">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group n_nichos_p5" style="display: none;">
                                        <label for="select" class="col-lg-4">Nº Nichos tramada parcela 5</label>
                                        <div class="row col-lg-8 inputs">
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada1_p5' id='tramada1_p5' placeholder='Tramada1' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada2_p5' id='tramada2_p5' placeholder='Tramada 2' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada3_p5' id='tramada3_p5' placeholder='Tramada 3' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada4_p5' id='tramada4_p5' placeholder='Tramada 4' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada5_p5' id='tramada5_p5' placeholder='Tramada 5' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada6_p5' id='tramada6_p5' placeholder='Tramada 6' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada7_p5' id='tramada7_p5' placeholder='Tramada 7' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada8_p5' id='tramada8_p5' placeholder='Tramada 8' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada9_p5' id='tramada9_p5' placeholder='Tramada 9' required>
                                        </div>
                                    </div>

                                    <!-- Fin parcela 5 -->

                                    <!-- Parcela 6 -->
                                    <div class="form-group" id="parcela6" style="display: none;">
                                        <label class="col-lg-12">Configuración parcela 6:</label>
                                        <hr>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tamaño parcela 6</label>
                                            <input type="hidden" class='col-lg-3 i6' name='parcela6' placeholder='Tamaño parcela' required>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tramadas parcela 6</label>
                                            <div class="col-lg-7">
                                                <select class="form-control" id="tram_parc_6" name="tram_parc_6">
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

                                        <div class="row" hidden>
                                            <label for="select" class="col-lg-5 margin">Nº nichos tramada parcela 6</label>
                                            <div class="row col-lg-9 inputs">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group n_nichos_p6" style="display: none;">
                                        <label for="select" class="col-lg-4">Nº Nichos tramada parcela 6</label>
                                        <div class="row col-lg-8 inputs">
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada1_p6' id='tramada1_p6' placeholder='Tramada1' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada2_p6' id='tramada2_p6' placeholder='Tramada 2' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada3_p6' id='tramada3_p6' placeholder='Tramada 3' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada4_p6' id='tramada4_p6' placeholder='Tramada 4' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada5_p6' id='tramada5_p6' placeholder='Tramada 5' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada6_p6' id='tramada6_p6' placeholder='Tramada 6' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada7_p6' id='tramada7_p6' placeholder='Tramada 7' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada8_p6' id='tramada8_p6' placeholder='Tramada 8' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada9_p6' id='tramada9_p6' placeholder='Tramada 9' required>
                                        </div>
                                    </div>

                                    <!-- Fin parcela 6 -->

                                    <!-- Parcela 7 -->

                                    <div class="form-group" id="parcela7" style="display: none;">
                                        <label class="col-lg-12">Configuración parcela 7:</label>
                                        <hr>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tamaño parcela 7</label>
                                            <input type="hidden" class='col-lg-3 i7' name='parcela7' placeholder='Tamaño parcela' required>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tramadas parcela 7</label>
                                            <div class="col-lg-7">
                                                <select class="form-control" id="tram_parc_7" name="tram_parc_7">
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

                                        <div class="row" hidden>
                                            <label for="select" class="col-lg-5 margin">Nº nichos tramada parcela 7</label>
                                            <div class="row col-lg-9 inputs">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group n_nichos_p7" style="display: none;">
                                        <label for="select" class="col-lg-4">Nº Nichos tramada parcela 7</label>
                                        <div class="row col-lg-8 inputs">
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada1_p7' id='tramada1_p7' placeholder='Tramada1' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada2_p7' id='tramada2_p7' placeholder='Tramada 2' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada3_p7' id='tramada3_p7' placeholder='Tramada 3' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada4_p7' id='tramada4_p7' placeholder='Tramada 4' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada5_p7' id='tramada5_p7' placeholder='Tramada 5' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada6_p7' id='tramada6_p7' placeholder='Tramada 6' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada7_p7' id='tramada7_p7' placeholder='Tramada 7' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada8_p7' id='tramada8_p7' placeholder='Tramada 8' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada9_p7' id='tramada9_p7' placeholder='Tramada 9' required>
                                        </div>
                                    </div>

                                    <!-- Fin parcela 7 -->

                                    <!-- Parcela 8 -->


                                    <div class="form-group" id="parcela8" style="display: none;">
                                        <label class="col-lg-12">Configuración parcela 8:</label>
                                        <hr>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tamaño parcela 8</label>
                                            <input type="hidden" class='col-lg-3 i8' name='parcela8' placeholder='Tamaño parcela' required>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tramadas parcela 8</label>
                                            <div class="col-lg-7">
                                                <select class="form-control" id="tram_parc_8" name="tram_parc_8">
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

                                        <div class="row" hidden>
                                            <label for="select" class="col-lg-5 margin">Nº nichos tramada parcela 8</label>
                                            <div class="row col-lg-9 inputs">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group n_nichos_p8" style="display: none;">
                                        <label for="select" class="col-lg-4">Nº Nichos tramada parcela 8</label>
                                        <div class="row col-lg-8 inputs">
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada1_p8' id='tramada1_p8' placeholder='Tramada1' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada2_p8' id='tramada2_p8' placeholder='Tramada 2' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada3_p8' id='tramada3_p8' placeholder='Tramada 3' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada4_p8' id='tramada4_p8' placeholder='Tramada 4' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada5_p8' id='tramada5_p8' placeholder='Tramada 5' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada6_p8' id='tramada6_p8' placeholder='Tramada 6' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada7_p8' id='tramada7_p8' placeholder='Tramada 7' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada8_p8' id='tramada8_p8' placeholder='Tramada 8' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada9_p8' id='tramada9_p8' placeholder='Tramada 9' required>
                                        </div>
                                    </div>

                                    <!-- Fin parcela 8 -->

                                    <!-- Parcela 9 -->

                                    <div class="form-group" id="parcela9" style="display: none;">
                                        <label class="col-lg-12">Configuración parcela 9:</label>
                                        <hr>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tamaño parcela 9</label>
                                            <input type="hidden" class='col-lg-3 i9' name='parcela9' placeholder='Tamaño parcela' required>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tramadas parcela 9</label>
                                            <div class="col-lg-7">
                                                <select class="form-control" id="tram_parc_9" name="tram_parc_9">
                                                    <option>- ¿Cuántas ttramadas tiene la parcela? -</option>
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
                                            <label for="select" class="col-lg-5 margin">Nº nichos tramada parcela 9</label>
                                            <div class="row col-lg-9 inputs">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group n_nichos_p9" style="display: none;">
                                        <label for="select" class="col-lg-4">Nº Nichos tramada parcela 9</label>
                                        <div class="row col-lg-8 inputs">
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada1_p9' id='tramada1_p9' placeholder='Tramada1' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada2_p9' id='tramada2_p9' placeholder='Tramada 2' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada3_p9' id='tramada3_p9' placeholder='Tramada 3' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada4_p9' id='tramada4_p9' placeholder='Tramada 4' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada5_p9' id='tramada5_p9' placeholder='Tramada 5' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada6_p9' id='tramada6_p9' placeholder='Tramada 6' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada7_p9' id='tramada7_p9' placeholder='Tramada 7' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada8_p9' id='tramada8_p9' placeholder='Tramada 8' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada9_p9' id='tramada9_p9' placeholder='Tramada 9' required>
                                        </div>
                                    </div>

                                    <!-- Fin parcela 9 -->

                                    <!-- Parcela 10 -->

                                    <div class="form-group" id="parcela10" style="display: none;">
                                        <label class="col-lg-12">Configuración parcela 10:</label>
                                        <hr>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tamaño parcela 10</label>
                                            <input type="hidden" class='col-lg-3 i10' name='parcela10' placeholder='Tamaño parcela' required>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <label class="col-lg-4 margin">Tramadas parcela 10</label>
                                            <div class="col-lg-7">
                                                <select class="form-control" id="tram_parc_10" name="tram_parc_10">
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

                                        <div class="row" hidden>
                                            <label for="select" class="col-lg-5 margin">Nº nichos tramada parcela 10</label>
                                            <div class="row col-lg-9 inputs">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group n_nichos_p10" style="display: none;">
                                        <label for="select" class="col-lg-4">Nº Nichos tramada parcela 10</label>
                                        <div class="row col-lg-8 inputs">
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada1_p10' id='tramada1_p10' placeholder='Tramada1' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada2_p10' id='tramada2_p10' placeholder='Tramada 2' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada3_p10' id='tramada3_p10' placeholder='Tramada 3' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada4_p10' id='tramada4_p10' placeholder='Tramada 4' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada5_p10' id='tramada5_p10' placeholder='Tramada 5' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada6_p10' id='tramada6_p10' placeholder='Tramada 6' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada7_p10' id='tramada7_p10' placeholder='Tramada 7' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada8_p10' id='tramada8_p10' placeholder='Tramada 8' required>
                                            <input type='hidden' class='col-lg-3 t_margin' name='tramada9_p10' id='tramada9_p10' placeholder='Tramada 9' required>
                                        </div>
                                    </div>

                                    <!-- Fin parcerla 10 -->


                                </div>
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

    function borrar(idCalle,tipoCalle,e){

        $(document).ajaxStop($.unblockUI);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ URL::route('borrarCalle') }}",
            data: {id : idCalle, tipo: tipoCalle},
            dataType: "html",
            success: function (data) {

                Lobibox.notify('success', {
                    title: 'Calle añadida',
                    showClass: 'flipInX',
                    delay: 3000,
                    delayIndicator: false,
                    position: 'bottom left'
                });

                location.reload();
            },
            error: function () {

                Lobibox.notify('error', {
                    title: 'No se ha podido borrar la calle',
                    showClass: 'flipInX',
                    delay: 3000,
                    delayIndicator: false,

                    position: 'bottom left',
                    msg: 'Compruebe la conexión a internet'
                });
            }
        });
    }



    $(document).ready(function(){

        $(document).ajaxStop($.unblockUI);


        $.material.init();

        $('#example').DataTable();

        /*$(".borrar").on('click',function(e){
            alert("entra");
        });*/



        //Function para recorrer array
        function recorrerArray(value, index, ar){
            value.setAttribute('type','hidden');
        }

        /*
            Función ajax para dar de alta una calle
         */
        $("#form-alta").submit(function(e){

            //obtenemos el num de tramadas
            var tramadas = $("#tramadas").val();
            var parcelas = $("#parcelas").val()

            if(parseInt(tramadas) > 0 && parseInt(tramadas) <= 9 || parseInt(parcelas) > 0 && parseInt(parcelas)) {

                e.preventDefault();

                $.ajax({
                    type: "GET",
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

                //Ocultamos la parte de las parcelas e inputs
                $(".parte_parcelas").css("display",'none');
                $(".parte_tramadas").css("display",'block');

                //Ocultamos el input del numero
                $(".numero").css("display",'none');
                $(".inumero")[0].setAttribute('type','hidden');

                //Ocultamos el select de calle existente
                $(".existente").css("display",'none');

                //hacemos que el inputNombre sea required
                $("#inputNombre").setAttribute("required","");

            }else{
                //si es pantenon aqui
                $(".parte_parcelas").css("display",'block');
                $(".parte_tramadas").css("display",'none');

                //Mostramos el input del numero
                $(".numero").css("display",'block');
                $(".inumero")[0].setAttribute('type','text');


                //Mostramos el select de calle existente
                $(".existente").css("display",'block');
                //hacemos que el input nombre no se necesario
                $("#inputNombre")[0].removeAttribute("required");

                //Si cambiamos de un tipo a otro hay que ocultar todos los inputs que había antes
                var inputs = $(".n_nichos").find('input');

                for(var i = 0; i < inputs.length; i++ ){
                    inputs[i].setAttribute('type','hidden');
                }
                //////

            }
        });

        /*
        *   Función para imprimir los tamaños de las parcelas.
        */

        $('#parcelas').on("change",function() {

            if($.isNumeric(this.value)){

                //Al cambiar ocultamos todas para más comidad, estén o no visible
                for(var i = 1; i <= 10; i++)
                    {
                        $('#parcela'+i).css("display", "none");

                        //ocultamos los inputs visibles
                        var input = $(".n_parcelas").find(".i"+i);
                        input[0].setAttribute("type", "hidden");

                    }

                    //hacemos visible lo de nº de parcelas
                    $(".n_parcelas").css("display",'block');


                    for(var i = 1; i <= this.value; i++)
                    {
                        $('#parcela'+i).css("display", "block");

                        //Hacemos visibles todos los inputs de parcela i

                        var input = $(".n_parcelas").find(".i"+i);
                        input[0].setAttribute("type", "text");

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
                    $('#tramada'+i)[0].setAttribute("type", "hidden");
                }

                //hacemos visible lo de nº de nichos
                $(".n_nichos").css("display",'block');

                for(var i = 1; i <= this.value; i++)
                {
                    $('#tramada'+i)[0].setAttribute("type", "text");
                }

                //$(".inputs").html(imprimir);
            }else{
                $(".n_nichos").css("display",'none');
            }

        });

        //Craemos eventos para todas los select de las tramadas de las parcelas de la 1 a la 10
        $('#tram_parc_1').on("change",function() {
            mostrarTramadas(this.value,1);
        });

        $('#tram_parc_2').on("change",function() {
            mostrarTramadas(this.value,2);
        });

        $('#tram_parc_3').on("change",function() {
            mostrarTramadas(this.value,3);
        });

        $('#tram_parc_4').on("change",function() {
            mostrarTramadas(this.value,4);
        });

        $('#tram_parc_5').on("change",function() {
            mostrarTramadas(this.value,5);
        });

        $('#tram_parc_6').on("change",function() {
            mostrarTramadas(this.value,6);
        });

        $('#tram_parc_7').on("change",function() {
            mostrarTramadas(this.value,7);
        });

        $('#tram_parc_8').on("change",function() {
            mostrarTramadas(this.value,8);
        });

        $('#tram_parc_9').on("change",function() {
            mostrarTramadas(this.value,9);
        });

        $('#tram_parc_10').on("change",function() {
            mostrarTramadas(this.value,10);
        });


        function mostrarTramadas(value,parcela){

            if($.isNumeric(value)){

                //Al cambiar ocultamos todas las tramadas de la parcela "parcela"
                for(var i = 1; i <= 9; i++)
                {
                    $('#tramada' + i + '_p'+ parcela)[0].setAttribute("type", "hidden");
                }

                //hacemos visible lo de nº de nichos
                $(".n_nichos_p" + parcela ).css("display",'block');

                for(var i = 1; i <= value; i++)
                {
                    $('#tramada' + i + '_p'+ parcela)[0].setAttribute("type", "text");
                }

            }else{

                //Al cambiar ocultamos todas las tramadas de la parcela "parcela"
                for(var i = 1; i <= 9; i++)
                {
                    $('#tramada' + i + '_p'+ parcela)[0].setAttribute("type", "hidden");
                }

                $(".n_nichos_p" + parcela).css("display",'none');
            }

        }


    });
    /**
     * Comentario cambios
     */
</script>

@endsection