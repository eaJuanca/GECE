<table class="table table-bordered table-hover table-condensed" cellspacing="0" cellpadding="0" style="font-size: small">

    <thead>
    <tr>
        <th>Calle</th>
        <th>Altura</th>
        <th>Nº nicho</th>
        <th>Nº parcela</th>
        <th>Titular</th>
        <th>Domicilio</th>
        <th>DNI</th>
        <th>Acción</th>
    </tr>
    </thead>

    <tbody class="nichos">
    @foreach($nichos as $nicho)

        <tr id="nicho{!!$nicho->id!!}">
                <td> {{$nicho->calle}}          </td>
        @if($nicho->idnicho != null)
                <td> {{$nicho->tramada}}        </td>
                <td> {{$nicho->numero_nicho}}   </td>
                <td>                            </td>
        @else
                <td>                            </td>
                <td>                            </td>
                <td> {{$nicho->parcela}}        </td>
        @endif
                <td> {{$nicho->nombre_titular}} </td>
                <td> {{$nicho->domicilio}}      </td>
                <td> {{$nicho->dni_titular}}    </td>

        @if($nicho->idnicho != null)
            <td style = "width: 100px">
                <div>
                    <button onclick="cargar('{!!$nicho->id!!}' ,'N')" style="margin-right: 10px; color:#03A9F4">
                        <i class="fa fa-chevron-circle-left  fa-lg fa-border"></i >
                    </button>
                </div>
            </td>
        </tr>
        @else
            <td style = "width: 100px">
                <div>
                    <button onclick="cargar('{!!$nicho->id!!}' ,'M')" style="margin-right: 10px; color:#03A9F4">
                        <i class="fa fa-chevron-circle-left  fa-lg fa-border"></i >
                    </button>
                </div>
            </td>
        </tr>
        @endif
    @endforeach

    </tbody>
</table>

<div class="pull-right paginacion">
    {!! $nichos->render() !!}
</div>

