@extends('master')

@section('title') <h2 style="color: white; font-weight: bold; margin-left:10px; "> Nichos Panteones </h2>

<p class="pull-right"><a href="{{ URL::previous() }}" class="btn btn-md btn-material-orange back fa fa-reply"></a></p>

@endsection

@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">

    <style>

        a:hover{
            cursor: pointer;
        }


        .disabled{

            cursor: pointer !important;
        }

        .bold{
            color: white;
            font-size: 12px;
        }


    </style>

@endsection

@section('contenido')

    <br>

    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="home">
            <div class="row" style="margin-top: 1%">

                <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="panel panel-default">
                        <div class="panel-heading"><span style="font-weight: bold">Nichos en este panteon</span>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover" cellspacing="10" cellpadding="10">
                                    <thead>
                                    <tr>
                                        <th>Datos del nicho</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody class="tdisponibles">

                                    <?php if(isset($disponibles)) { ?>

                                    @foreach($disponibles as $disponible)

                                        <tr>
                                            <td id="{!!$disponible->nicho!!}" >
                                                Altura, <span style="font-weight: bold">{{$disponible->altura}} </span>
                                                Numero <span style="font-weight: bold">{{$disponible->numero_nicho}} </span> </td>

                                            <td> <a href="{{ route('ver-difuntos-nicho-panteon',[$disponible->nicho])}}"><i class="fa fa-lg fa-search"></i> Ver difuntos</a></td>

                                        </tr>

                                    @endforeach

                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="paginacion" style="float: right"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="difunto-dialog" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p>E dolore commodo, id anim aute sint cupidatat eu est anim tamen ad possumus,
                        legam officia firmissimum. Eram deserunt domesticarum, iis ita praetermissum,
                        nam aliquip quo probant, incididunt et occaecat an nam enim exquisitaque a
                        nescius velit admodum, non ad cohaerescant, probant o nulla tempor. Aute aut te
                        quis arbitror ubi ne aliqua consequat aliquip. Ad sunt laborum senserit, de do
                        quem possumus. Sint tractavissent cupidatat aute possumus ita elit ad cupidatat.
                        Arbitror ab fabulas o eu e veniam pariatur. Non voluptate comprehenderit ad nisi
                        id voluptate. Quis distinguantur quibusdam quae mentitum o si minim illum nisi
                        mandaremus.</p>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('jquery')

    <script src="{{ asset('assets/js/bootpag.min.js') }}"></script>


    <script type="text/javascript">

        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        var count = "{{$td}}"; //variable para contar el total de franquicias y mostrar en relacion con el n? de paginas
        var paginas = 0;
        if (count % 10 != 0) {
            paginas = Math.floor(count / 10) + 1;
        } else {
            paginas = count / 10; //4 es el n?mero de items que queremos que aparezcan.
        }




        $(document).ready(function () {

            var id = "{{$id}}";


            $('.paginacion').bootpag({
                total: paginas,
                page: 1,
                maxVisible: 5,
                leaps: true,
                firstLastUse: true,
                first: 'Primero',
                last: 'Ultimo',
                wrapClass: 'pagination',
                activeClass: 'active',
                disabledClass: 'disabled',
                nextClass: 'next',
                prevClass: 'prev',
                lastClass: 'last',
                firstClass: 'first'

            }).on("page", function (event, num) {


                    var ruta = "{{ URL::route('paginateNichosPanteones') }}";
                    var data = {page: num, id: id};



                //variable de conexion, para cancelar las conexiones anteriores antes de lanzar otra
                var httpR;

                $.ajax({

                    type: "post",
                    url: ruta,
                    data: data,
                    dataType: "html",

                    beforeSend: function (data2) {
                        /*httpR es la variable global donde guardamos la conexion*/
                        if (httpR) {
                            /*Si habia alguna conexion anterior, la cancelamos*/
                            httpR.abort();
                        }
                        /*Guardamos la nueva conexion*/
                        httpR = data2;
                    },
                    error: function () {
                        alert("Error en la petición");
                    },
                    success: function (data) {

                        $(".tdisponibles").html(data);


                    }
                });
            });

            //Evento para cada tr de la tabla cuando pasamos por encima
            $(".table td").dblclick(function(e)
            {
                var id = this.getAttribute('id');
                //peticion ajax para ver los difuntos

                if(id != null) {
                    $.ajax({

                        type: 'post',
                        url: "{{ URL::route('difuntosNichos') }}",
                        data: {id: id},
                        dataType: "html",
                        error: function () {
                            alert("Error en la petición");
                        },
                        success: function (data) {

                            $(".modal-body").html(data);
                            $('#difunto-dialog').modal('show');
                        }
                    });
                }

            })

        });

    </script>

@endsection
