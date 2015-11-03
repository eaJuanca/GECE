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


        <tr>
            @if($f->serie=="N")
                <td>Manteminiento Nicho</td>
                <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                <td>{{$f->inicio}}</td>
                <td>{{$f->fin}}</td>
                <td>{{$f->nombre_titular}}</td>
                <td>{{$f->dni_titular}}</td>
                <td> <a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button> </a> <br></td>

            @elseif($f->serie=='D')

                <td>Cesión a perpetuidad</td>
                <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                <td>{{$f->inicio}}</td>
                <td>{{$f->fin}}</td>
                <td>{{$f->nombre_titular}}</td>
                <td>{{$f->dni_titular}}</td>
                <td> <a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button> </a> <br></td>

            @elseif($f->serie=='E')

                <td>Enterramiento</td>
                <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                <td>{{$f->inicio}}</td>
                <td>{{$f->fin}}</td>
                <td>{{$f->nombre_titular}}</td>
                <td>{{$f->dni_titular}}</td>
                <td> <a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button> </a><a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-success btn-xs">Modificar</button> </a> <br></td>

            @elseif($f->serie=='T')

                <td>Cesión Temporal</td>
                <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                <td>{{$f->inicio}}</td>
                <td>{{$f->fin}}</td>
                <td>{{$f->nombre_titular}}</td>
                <td>{{$f->dni_titular}}</td>
                <td> <a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button> </a><a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-success btn-xs">Modificar</button> </a> <br></td>

            @elseif($f->serie=='M')

                <td>Mantenimiento Panteon</td>
                <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                <td>{{$f->inicio}}</td>
                <td>{{$f->fin}}</td>
                <td>{{$f->nombre_titular}}</td>
                <td>{{$f->dni_titular}}</td>
                <td> <a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button></a> <br></td>

            @elseif($f->serie=='P')

                <td>Cesión Panteón</td>
                <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                <td>{{$f->inicio}}</td>
                <td>{{$f->fin}}</td>
                <td>{{$f->nombre_titular}}</td>
                <td>{{$f->dni_titular}}</td>
                <td> <a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button></a> <br></td>

            @else

                <td>??</td>
                <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                <td>{{$f->inicio}}</td>
                <td>{{$f->fin}}</td>
                <td>{{$f->nombre_titular}}</td>
                <td>{{$f->dni_titular}}</td>
                <td> <a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button></a> <br></td>
            @endif
        </tr>

    @endforeach


    </tbody>
</table>

<div class="pull-right paginacion">
    {!! $facturas->render() !!}
</div>