<?php

namespace App\Http\Controllers;

use App\model\Factura;
use App\model\infoRecibos;
use App\model\Nicho;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use PhpParser\Node\Expr\Cast\Object_;

class recibosController extends Controller
{
    /**
     * Display a listing of the resource
     * @return \Illuminate\Http\Response
     */

    private $nuevaFactura;

    public function index()
    {

        //inicializamos el objeto factura
        $this->nuevaFactura = new Factura();

        $nichos = new Collection();
        return view('recibos',compact('nichos'));
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

        $titular = $r->input('nombrebuscar');
        $calle = $r->input('callebuscar');
        $dni = $r->input('dnibuscar');
        $domicilio = $r->input('domiciliobuscar');
        $page = $r->input('page');

        //tenemos que sacar una lista de nichos en función a los parámetros de la petición,
        //si esta al corriente en los pagos o no.
        if($r->input('corriente') != null) {
            //buscamos todos los nichos que no tengan facturas pendientes incluso estén adelantados  es decir fecha fin => al año de hoy.
            $hoy = Carbon::now();
            $nichos = DB::table('inforecibos')
                ->select('id', 'idtitular', 'idnicho', 'idparcela', 'iddifunto', 'inicio', (DB::raw('max(fin) as fin')),
                    'serie', 'numero', 'pendiente', 'nicho_numero', 'altura', 'nombre_titular', 'parcela_numero', 'nicho_calle',
                    'parcela_calle','nicho_dni','parcela_dni','domicilio')->where('fin', '>=', $hoy->year)
                ->where(function ($nichos) use ($titular,$calle,$dni,$domicilio) {
                    if($titular != '') $nichos->where('nombre_titular', 'like', "%$titular%");
                    if($calle != '' ) {
                        $nichos->where('parcela_calle', 'like', "%$calle%");
                        $nichos->oRwhere('nicho_calle', 'like', "%$calle%");
                    }
                    if($domicilio != '') $nichos->where('domicilio' , 'like', "%$domicilio%");

                })->groupBy('idnicho')->skip(10 * ($page - 1))->take(10)->get();//->paginate(10)

        }else {

            //buscamos todos los nichos que tengan facturas pendientes es decir fecha fin < al año de hoy.
            $hoy = Carbon::now();
            $nichos = DB::table('inforecibos')
                ->select('id', 'idtitular', 'idnicho', 'idparcela', 'iddifunto', 'inicio', (DB::raw('max(fin) as fin')),
                    'serie', 'numero', 'pendiente', 'nicho_numero', 'altura', 'nombre_titular', 'parcela_numero', 'nicho_calle',
                    'parcela_calle', 'nicho_dni', 'parcela_dni')->where('fin', '<', $hoy->year)
                ->where(function ($nichos) use ($titular, $calle, $dni) {
                    if ($titular != '') $nichos->where('nombre_titular', 'like', "%$titular%");
                    if ($calle != '') {
                        $nichos->where('parcela_calle', 'like', "%$calle%");
                        $nichos->oRwhere('nicho_calle', 'like', "%$calle%");
                    }
                    if ($dni != '') {
                        $nichos->where('nicho_dni', 'like', "%$dni%");
                        $nichos->oRwhere('parcela_dni', 'like', "%$dni%");
                    }
                })->groupBy('idnicho')->skip(10 * ($page - 1))->take(10)->get();//->paginate(10)
        }

        for ($i = 0; $i < count($nichos); $i++) {

            echo '<tr id="nicho'.$nichos[$i]->id .'">';
            echo '<td >' .  $nichos[$i]->nicho_calle . ' </td >';
            echo '<td >' .  $nichos[$i]->altura. ' </td >';
            echo '<td >' .  $nichos[$i]->nicho_numero . ' </td >';
            echo '<td >' .  $nichos[$i]->parcela_calle . ' </td >';
            echo '<td >' .  $nichos[$i]->nombre_titular . ' </td >';
            echo '<td >' .  $nichos[$i]->domicilio . ' </td >';
            if($nichos[$i]->nicho_dni != null) {
                echo '<td >' . $nichos[$i]->nicho_dni . ' </td >';
                echo '<td style = "width: 100px" > <div>
                        <a onclick ="cargar(' . $nichos[$i]->id . ')" style = "margin-right: 10px; color:#03A9F4;" >
                        <i class="fa fa-chevron-circle-left  fa-lg fa-border"></i ></a >
                    </div >
                </td >
            </tr >';
            }else{
                echo '<td >' . $nichos[$i]->parcela_dni . ' </td >';
                echo '<td style = "width: 100px" > <div>
                        <a onclick ="cargar(' . $nichos[$i]->id .')" style = "margin-right: 10px; color:#03A9F4;" >
                        <i class="fa fa-chevron-circle-left  fa-lg fa-border"></i ></a >
                    </div >
                </td >
            </tr >';
            }



        }
    }

    function getNicho(Request $r){

        //Cremos la nueva factura con los datos necesarios que tenemos del nicho que
        //se ha seleccionado
        $nicho = infoRecibos::where('id' , '=' ,$r->input('id'))->get();

        //Asignamos atributos a nuevaFactura;
        $this->nuevaFactura->idnicho = $nicho->idnicho;

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
