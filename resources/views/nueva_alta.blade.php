@extends('master')

@section('title')
    <h2 style="color: white; font-weight: bold; margin-left:10px; "> Gestión de altas </h2>
    <p class="pull-right"><a href="{{ URL::previous() }}" class="btn btn-md btn-material-orange back fa fa-reply"></a></p>

@endsection


@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('datepickersandbox/css/bootstrap-datepicker3.min.css') }}">


@endsection

@section('contenido')

        <div class="col-lg-4 col-lg-offset-4">
            <div class="panel panel-info" style="margin-top: 20px">
                <div class="panel-heading">
                    <h3 class="panel-title text-center" style="color: white">
                            Formulario nueva alta
                    </h3>
                </div>
                <div class="panel-body">
                    <form id="form_alta">

                        <div class="col-lg-12">

                            <div class="form-group">
                                <div class="col-lg-12">
                                    <input type="text" name="nombre" class="form-control nombre" placeholder="Nombre Usuario" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-12">
                                    <input type="email" name="email" class="form-control" placeholder="Email Usuario" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-12">
                                    <input type="password" name="password" class="form-control password" placeholder="Contraseña Usuario" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-12">
                                    <input type="password" name="repassword" class="form-control repassword" placeholder="Repite Contraseña" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col col-lg-12">
                                    <div class="radio radio-primary">
                                        <label>
                                            <input name="rol" type="radio" class="rol" value="0" checked=""><span class="circle"></span><span class="check"></span>
                                                Administrador
                                        </label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <label>
                                            <input name="rol" type="radio" class="rol" value="1"><span class="circle"></span><span class="check"></span>
                                                Normal
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col col-lg-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="pnichos" name="pnichos"><span class="checkbox-material"><span class="check"></span></span> <span style="font-weight: bold;">Módulo Nichos</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col col-lg-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="ppanteones" name="ppanteones"><span class="checkbox-material"><span class="check"></span></span> <span style="font-weight: bold;">Módulo Panteones</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col col-lg-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="pcalles" name="pcalles"><span class="checkbox-material"><span class="check"></span></span> <span style="font-weight: bold;">Módulo Calles</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col col-lg-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="pdifuntos" name="pdifuntos"><span class="checkbox-material"><span class="check"></span></span> <span style="font-weight: bold;">Módulo Difuntos</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col col-lg-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="pfacturas" name="pfacturas"><span class="checkbox-material"><span class="check"></span></span> <span style="font-weight: bold;">Módulo Facturas</span>
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col col-lg-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="precibos" name="precibos"><span class="checkbox-material"><span class="check"></span></span> <span style="font-weight: bold;">Módulo Recibos</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col col-lg-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="ptarifas" name="ptarifas"><span class="checkbox-material"><span class="check"></span></span> <span style="font-weight: bold;">Módulo Tarifas</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col col-lg-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="plibro" name="plibro"><span class="checkbox-material"><span class="check"></span></span> <span style="font-weight: bold;">Módulo Libro de registros</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col col-lg-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="pusuarios" name="pusuarios"><span class="checkbox-material"><span class="check"></span></span> <span style="font-weight: bold;">Módulo Alta Usuarios</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-success btn-raised pull-right">Crear</button>

                        </div>

                    </form>
                </div>
            </div>
        </div>


@endsection

@section('js')

    <script type="text/javascript">

        $(document).ready(function () {

            var token = "{{ csrf_token()}}";

            $("#form_alta").submit(function (e) {

                //Comprobamos que las contraseñas coinciden primero

                var pass = $(".password").val();
                var repass = $(".repassword").val();


                if(pass == repass){

                e.preventDefault();

                    $.ajax({
                        type: "GET",
                        url: "{{ URL::route('nueva_alta') }}",
                        data: $("#form_alta").serialize(),
                        dataType: "html",
                        error: function () {
                            Lobibox.notify('error', {
                                title: 'No se ha podido crear el usuario',
                                showClass: 'flipInX',
                                delay: 3000,
                                delayIndicator: false,

                                position: 'bottom left',
                                msg: 'Compruebe la conexión a internet'
                            });
                        },
                        success: function (data) {

                            Lobibox.notify('success', {
                                title: 'Usuario creado',
                                showClass: 'flipInX',
                                delay: 3000,
                                delayIndicator: false,
                                position: 'bottom left'
                            });

                            location.reload();
                        }
                    });


                }else{
                    alert("Las contraseñas no coinciden")
                }
            });
        });

    </script>

@endsection




