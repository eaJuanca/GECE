<table class="table table-bordered table-hover" cellspacing="10" cellpadding="10">
    <thead>
    <tr>
        <th>Cod.</th>
        <th>Tipo</th>
        <th>Otra</th>

    </tr>
    </thead>
    <tbody class="tfacturas">

    @foreach($facturas as $factura)

        <tr>
            <td> {{$factura->id}}</td>
            <td> {{$factura->idtitular}}</td>
            <td> <a onclick="alert({{ $factura->id }})"> alert</a></td>


        </tr>

    @endforeach


    </tbody>
</table>
<div class="pull-right paginacion">
    {!!  $facturas->render() !!}
</div>