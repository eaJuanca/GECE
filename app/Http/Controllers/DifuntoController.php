<?php

namespace App\Http\Controllers;

use App\model\Difunto;
use App\model\InfoNicho;
use App\model\Nicho;
use App\model\Parcela;
use App\model\Titular;
use App\model\TotalNicho;
use App\model\Tramada;
use App\model\VDifuntos;
use App\model\VPanteones;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;

class DifuntoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('alta_difunto');
    }


    //Añadir un difunto desde la vista nicho

    public function DifuntoNicho($nichoid){

        $TN = TotalNicho::where('GC_NICHOS_id',$nichoid)->get();

        if(count($TN) > 0){;
        $total = $TN[0]->total;
        $fecha = $TN[0]->ultimo;

        $fecha_ultimo = new Carbon($fecha);
        $fecha_ultimo->addYears(4);
        $hoy = Carbon::now();

        $cumpletotal = true;
        if ($total >= 4) {
            $cumpletotal = false;
        }

        $cumplefecha = true;
        if ($fecha_ultimo > $hoy) {
            $cumplefecha = false;
        }


        return view('alta_difunto', compact('nichoid', 'total', 'fecha', 'cumpletotal', 'cumplefecha'));
    }

        return view('alta_difunto', compact('nichoid'));


    }


    public function busqueda(Request $request){

        $difunto = $request->input('difunto');
        $fecha = $request->input('fecha');
        $parroquia = $request->input('parroquia');
        $inhumacion = $request->input('inhumacion');


        $query = VDifuntos::where(function($query) use ($difunto,$fecha, $parroquia, $inhumacion){

            if($difunto!='') $query->where('nombre','like',"%$difunto%");
            if($fecha!='') $query->where('fallecimiento',$fecha);
            if($inhumacion!='') $query->where('inhumacion',$inhumacion);
            if($parroquia!='') $query->where('parroquia_difunto',$parroquia);

        });



        $difuntos = $query->take(10)->get();


        $total = $query->count();

        $search = 1;

        return view('difunto', compact('difuntos','total','difunto','fecha' ,'parroquia','inhumacion','search'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

            $nichoid = $request->input('GC_NICHOS_id');
            $nicho = Nicho::find($nichoid);
            $titular = Titular::find($nicho->GC_TITULAR_id);
            $p = false;

            if($titular == null){

                $tramada = Tramada::find($nicho->GC_Tramada_id);
                $parcela = VPanteones::where('parcela_id',$tramada->GC_PARCELA_id)->get()[0];
                $titular = Titular::find($parcela->titular_id);
                $p = true;

            }

            $difunto = new Difunto($request->all());
            $difunto->save();


            $fc = new FacturacionController();

            if($p){

                $fc->facturaEnterramiento($nicho->id,$difunto->id,$titular->id, $parcela->parcela_id);
                //Generamos también factura de mantenimiento de los años años que se deben hasta hoy + 5
                $fc->Mantenimiento5Parcela($parcela->parcela_id,$titular->id,$nicho->id);

            }else {
                $fc->facturaEnterramiento($nicho->id,$difunto->id,$titular->id, null);
                //Generamos también factura de mantenimimento de los añoas que se deben hasta hoy + 5
                $fc->Mantenimiento5Nicho($nicho->id,$titular->id);
            }



    }


    public function paginateDifunto(Request $request)
    {
        $page = $request->input('page');
        $difuntos = Difunto::skip(10 * ($page - 1))->take(10)->get();

        foreach ($difuntos as $difunto){

            echo'  <tr class="difunto'.$difunto->id.'">';

            echo"<td>{{$difunto->nombre}}</td>
                <td>{{$difunto->fallecimiento}}</td>
                <td>{{$difunto->inhumacion}}</td>
                <td>{{$difunto->edad}}</td>
                <td>{{$difunto->domicilio}}</td>
                <td>{{$difunto->numero}}</td>
                <td>{{$difunto->calle}}</td>
                <td>{{$difunto->parroquia_difunto}}</td>";



            echo '<td style = "width: 100px" > <div style = "float: right" >
                            <a data - toggle = "tooltip" title = "Editar" onclick = "" style = "margin-right: 10px; color:#03A9F4;" >
                            <i class="fa fa-pencil-square-o  fa-lg fa-border" ></i ></a >
                            <a data - toggle = "tooltip" title = "Borrar" style = "margin-right: 10px; color: #F44336"
                               onclick = "borrar('.$difunto->id.')" ><i
                                        class="fa fa-eraser  fa-lg fa-border " ></i ></a >
                        </div >
                    </td >
                </tr >';
       }

    }

    public function busquedaPaginada(Request $request){

        $page = $request->input('page');
        $difunto = $request->input('difunto');
        $fecha = $request->input('fecha');
        $parroquia = $request->input('parroquia');
        $inhumacion = $request->input('inhumacion');


        $query = VDifuntos::where(function($query) use ($difunto,$fecha, $parroquia, $inhumacion){

            if($difunto!='') $query->where('nombre','like',"%$difunto%");
            if($fecha!='') $query->where('fallecimiento',$fecha);
            if($inhumacion!='') $query->where('inhumacion',$inhumacion);
            if($parroquia!='') $query->where('parroquia_difunto',$parroquia);

        });

        $difuntos = $query->skip(10 * ($page - 1))->take(10)->get();

        foreach ($difuntos as $difunto){

            echo'  <tr class="difunto'.$difunto->id.'">';

            echo"<td>{{$difunto->nombre}}</td>
                <td>{{$difunto->fallecimiento}}</td>
                <td>{{$difunto->inhumacion}}</td>
                <td>{{$difunto->edad}}</td>
                <td>{{$difunto->domicilio}}</td>
                <td>{{$difunto->numero}}</td>
                <td>{{$difunto->calle}}</td>
                <td>{{$difunto->parroquia_difunto}}</td>";


            echo '<td style = "width: 100px" > <div style = "float: right" >
                            <a data - toggle = "tooltip" title = "Editar" onclick = "" style = "margin-right: 10px; color:#03A9F4;" >
                            <i class="fa fa-pencil-square-o  fa-lg fa-border" ></i ></a >
                            <a data - toggle = "tooltip" title = "Borrar" style = "margin-right: 10px; color: #F44336"
                               onclick = "borrar('.$difunto->id.')" ><i
                                        class="fa fa-eraser  fa-lg fa-border " ></i ></a >
                        </div >
                    </td >
                </tr >';
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $difunto = Difunto::find($id);
        return view('modificar_difunto',compact('difunto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        $difuntoU = new Difunto($request->all());
        $difunto = Difunto::find($request->input('id'));
        $difunto->update($difuntoU->attributesToArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        Difunto::find($id)->delete();

    }

    /**
     * Comentario cambios
     */

}
