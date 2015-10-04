<?php

namespace App\Http\Controllers;

use App\model\Difunto;
use App\model\TotalNicho;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        $codigo = $request->input('codigo');
        $sexo = $request->input('sexo');


        $query = Difunto::where('nom_difunto','!=','')->where(function($query) use ($difunto,$fecha,$codigo,$sexo){

            if($difunto!='') $query->where('nom_difunto','like',"%$difunto%");
            if($fecha!='') $query->where('fec_fall_difunto',$fecha);
            if($codigo!='') $query->where('id',$codigo);
            if($sexo!=2) $query->where('sex_difunto',$sexo);
        });



        $difuntos = $query->take(10)->get();


        $total = $query->count();

        $search = 1;

        return view('difunto', compact('difuntos','total','difunto','fecha','codigo','sexo','search'));

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
        $difunto = new Difunto($request->all());
        $difunto->save();
    }


    public function paginateDifunto(Request $request)
    {
        $page = $request->input('page');
        $difuntos = Difunto::skip(10 * ($page - 1))->take(10)->get();

        foreach ($difuntos as $difunto){

            echo'  <tr class="difunto'.$difunto->id.'">';
            echo '<td >'. $difunto->id.' </td >';
            echo '<td >'.  $difunto->nom_difunto.' </td >';
            echo '<td style = "width: 100px" > '.$difunto->fec_fall_difunto.'</td >';
            echo '<td >'.$difunto->pob_difunto.'</td >';

            echo ' <td style = "width: 100px; text-align: center" ><span >';
                if ($difunto->sex_difunto == 1)
                    echo 'Mujer'; else
                    echo 'Hombre</span ></td >';
            echo '<td>'.$difunto->GC_NICHOS_id.'</td>';



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
        $codigo = $request->input('codigo');
        $sexo = $request->input('sexo');

        $query = Difunto::where('nom_difunto','!=','')->where(function($query) use ($difunto,$fecha,$codigo,$sexo){

            if($difunto!='') $query->where('nom_difunto','like',"%$difunto%");
            if($fecha!='') $query->where('fec_fall_difunto',$fecha);
            if($codigo!='') $query->where('id',$codigo);
            if($sexo!=2) $query->where('sex_difunto',$sexo);
        });

        $difuntos = $query->skip(10 * ($page - 1))->take(10)->get();

        foreach ($difuntos as $difunto){

            echo'  <tr class="difunto'.$difunto->id.'">';
            echo '<td >'. $difunto->id.' </td >';
            echo '<td >'.  $difunto->nom_difunto.' </td >';
            echo '<td style = "width: 100px" > '.$difunto->fec_fall_difunto.'</td >';
            echo '<td >'.$difunto->pob_difunto.'</td >';
            echo ' <td style = "width: 100px; text-align: center" ><span >';
            if ($difunto->sex_difunto == 1)
                echo 'Mujer'; else
                echo 'Hombre</span ></td >';

            echo '<td>'.$difunto->GC_NICHOS_id.'</td>';


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


}
