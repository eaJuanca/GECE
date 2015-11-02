<?php

namespace App\Http\Controllers;

use App\model\infoRecibos;
use App\model\Nicho;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class recibosController extends Controller
{
    /**
     * Display a listing of the resource
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('recibos');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function listar(Request $r){

        $page = $r->input('page');

        //tenemos que sacar una lista de nichos en función a los parámetros de la petición.
        if($r->input('corriente') != null) {


        }else {
            //buscamos todos los nichos que tengan facturas pendientes es decir fecha fin < al año de hoy.
            $hoy = Carbon::now();
            $nichos = DB::table('inforecibos')
                ->select('id', 'idtitular', 'idnicho', 'idparcela', 'iddifunto', 'inicio', (DB::raw('max(fin) as fin')),
                    'serie', 'numero', 'pendiente', 'nicho_numero', 'altura', 'nombre_titular', 'parcela_numero', 'nicho_calle',
                    'parcela_calle')->where('fin', '>', $hoy->year)->groupBy('idnicho')->skip(10 * ($page - 1))->take(10)->get();

            for ($i = 0; $i < count($nichos); $i++) {

                echo '  <tr class="nicho' . $nichos[$i]->nicho_calle . '">';
                echo '<td >' .  $nichos[$i]->altura . ' </td >';
                echo '<td >' .  $nichos[$i]->nicho_numero . ' </td >';
                echo '<td >' .  $nichos[$i]->parcela_numero . ' </td >';
                echo '<td >' .  $nichos[$i]->parcela_calle . ' </td >';

                echo '<td style = "width: 100px" > <div style = "float: right" >
                            <a data - toggle = "tooltip" title = "Editar" onclick = "" style = "margin-right: 10px; color:#03A9F4;" >
                            <i class="fa fa-pencil-square-o  fa-lg fa-border" ></i ></a >
                        </div >
                    </td >
                </tr >';

            }

        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
