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
            <a href="javascript:void(0)" class="btn btn-default btn-fab mdi-content-add mdi-action-grade"></a>
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

@endsection

<script src="{{ URL::asset('assets/js/jquery-2.1.4.min.js') }}"></script>


<script src="{{URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="//cdn.datatables.net/responsive/1.0.6/js/dataTables.responsive.min.js"></script>



<script type="text/javascript">

    $(document).ready(function(){

        $('#example').DataTable();


    });
</script>

