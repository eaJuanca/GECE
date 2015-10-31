<?php

namespace App\Http\Controllers;

use App\model\Factura;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class FacturacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('facturacion');
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
     * @param $idnicho
     * @return \Illuminate\View\View
     */
    public function show($idnicho) {

        $factura = Factura::where('idnicho',$idnicho)->where('serie','D')->first();
        $factura= $factura->id;
        return view('facturasProcesoNichos',compact('factura'));
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

    public function facturaEnterramiento($nicho,$difunto,$titular,$parcela = null)
    {
        $factura = NEW Factura();

        $factura->idtitular = $titular;
        $factura->iddifunto = $difunto;
        $factura->idnicho = $nicho;
        $factura->idparcela = $parcela;
        $factura->tipo = 1;

        $factura->save();


    }

    public function facturaCesionPerpetura($titular, $nicho){


        //fecha de hoy
        $hoy = Carbon::now();

        //busco si hay una factura de un nicho para la serie D, osea si alguna vez se ha generado una factura
        $aux = Factura::where('idnicho',$nicho)->where('serie','D')->first();

        //obtener el numero de factura maximo
        $numero = Factura::where('serie','D')->whereYear('inicio','=',$hoy->year)->max('numero');

        //hay que generar o no las facturas de mantenimiento
        $fmantenimiento = false;



        //valores que se establecen solo una vez
        if($aux == null) {

            $factura = new Factura();
            $factura->numero = $numero+1;
            $factura->inicio = $hoy;
            $factura->idnicho = $nicho;
            $factura->serie = 'D';
            $fmantenimiento = true;

        }
        else {
            $factura = $aux;
        }

        //el titular puede cambiar
        $factura->idtitular = $titular;

        $factura->save();


        if($fmantenimiento){

            //generar facturas de mantenimiento
        }

    }
}
