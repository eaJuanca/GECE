<table class="table table-bordered table-hover table-condensed" cellspacing="10" cellpadding="10">
    <thead>
    <tr>
        <th>Factura</th>
        <th>Nº</th>
        <th>Emision</th>
        <th>Duración</th>
        <th>Titular</th>
        <th>Dni</th>
        <th>Acciones</th>

    </tr>
    </thead>
    <tbody class="facturas">


    @foreach($facturas as $f)

        <?php

        $aux = $f->numero;
        $aux = strlen($aux);
        $aux = 5- $aux;
        ?>


        <tr class="factura{{$f->id}}">
            @if($f->serie=="N")
                <td>Manteminiento Nicho</td>
                <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                <td>{{$f->inicio}}</td>
                <td>{{$f->fin}}</td>
                <td>{{$f->nombre_titular}}</td>
                <td>{{$f->dni_titular}}</td>
                <td> <a href="{{ route('pdfmantenimientoNicho',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button> </a> <a onclick="dfactura({{$f->id}})"> <button class="btn btn-warning btn-xs">Eliminar <i class="fa fa-trash fa-lg"></i></button> </a></td>

            @elseif($f->serie=='D')

                <td>Cesión a perpetuidad Nicho</td>
                <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                <td>{{$f->inicio}}</td>
                <td>Perpetuidad</td>
                <td>{{$f->nombre_titular}}</td>
                <td>{{$f->dni_titular}}</td>
                <td> <a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button> </a> <a onclick="dfactura({{$f->id}})"> <button class="btn btn-warning btn-xs">Eliminar <i class="fa fa-trash fa-lg"></i></button> </a></td>

            @elseif($f->serie=='E')

                <td>Enterramiento</td>
                <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                <td>{{$f->inicio}}</td>
                <td>{{$f->fin}}</td>
                <td>{{$f->nombre_titular}}</td>
                <td>{{$f->dni_titular}}</td>
                <td> <a href="{{ route('pdfacturaenterramiento',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button> </a> @if($f->pendiente != 0)<a href="{{ route('modificar-factura',[$f->id])}}"> <button class="btn btn-success btn-xs">Modificar</button> </a>@endif <a onclick="dfactura({{$f->id}})"> <button class="btn btn-warning btn-xs">Eliminar <i class="fa fa-trash fa-lg"></i></button> </a></td>

            @elseif($f->serie=='T')

                <td>Cesión Temporal Nicho</td>
                <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                <td>{{$f->inicio}}</td>
                <td>{{$f->fin}}</td>
                <td>{{$f->nombre_titular}}</td>
                <td>{{$f->dni_titular}}</td>
                <td> <a href="{{ route('pdfacturanichotemporal',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button> </a><a onclick="dfactura({{$f->id}})"> <button class="btn btn-warning btn-xs">Eliminar <i class="fa fa-trash fa-lg"></i></button> </a></td>

            @elseif($f->serie=='M')

                <td>Mantenimiento Panteon</td>
                <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                <td>{{$f->inicio}}</td>
                <td>{{$f->fin}}</td>
                <td>{{$f->nombre_titular}}</td>
                <td>{{$f->dni_titular}}</td>
                <td> <a href="{{ route('pdfmantenimientoParcela',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button></a> <a onclick="dfactura({{$f->id}})"> <button class="btn btn-warning btn-xs">Eliminar <i class="fa fa-trash fa-lg"></i></button> </a></td>

            @elseif($f->serie=='P')

                <td>Cesión perpetuidad Panteón</td>
                <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                <td>{{$f->inicio}}</td>
                <td> Perpetuidad </td>
                <td>{{$f->nombre_titular}}</td>
                <td>{{$f->dni_titular}}</td>
                <td> <a href="{{ route('pdfacturaParcela',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button></a> <a onclick="dfactura({{$f->id}})"> <button class="btn btn-warning btn-xs">Eliminar <i class="fa fa-trash fa-lg"></i></button> </a></td>

            @else

                <td>??</td>
                <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                <td>{{$f->inicio}}</td>
                <td>{{$f->fin}}</td>
                <td>{{$f->nombre_titular}}</td>
                <td>{{$f->dni_titular}}</td>
                <td> <a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button></a> <a onclick="dfactura({{$f->id}})"> <button class="btn btn-warning btn-xs">Eliminar <i class="fa fa-trash fa-lg"></i></button> </a></td>
            @endif
        </tr>

    @endforeach


    </tbody>
</table>

<div class="pull-right paginacion">
    {!! $facturas->render() !!}
</div>