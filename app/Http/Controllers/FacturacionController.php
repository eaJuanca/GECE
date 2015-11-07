<?php

namespace App\Http\Controllers;

use App\model\LineaFactura;
use App\model\VFacturas;
use App\model\Factura;
use App\model\VLinea;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;
use App\model\TarifaServicios;

class FacturacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facturas = VFacturas::paginate(10);
        $search = false;
        return View::make('facturacion',compact('facturas','search'));
    }


    /**
     * Paginacion de facturas
     * @return mixed
     */
    public function paginate(){

        $facturas = VFacturas::paginate(10);
        return view('renders.facturas',compact('facturas'));
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function busqueda(Request $request){

        $titular = $request->input('titular');
        $difunto = $request->input('difunto');
        $dni = $request->input('dni');
        $calle = $request->input('calle');
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');


        $search = true;
        $facturas = VFacturas::where(function($facturas) use ($titular, $difunto, $dni, $calle, $desde, $hasta){

            if($titular != "") $facturas->where('nombre_titular','like',"%$titular%");
            if($difunto != "") $facturas->where('nom_difunto','like',"%$difunto%");
            if($dni != "") $facturas->where('dni_titular','like',"%$dni%");
            if($calle != "") $facturas->where('calle','like',"%$calle%");

            if($desde != "" && $hasta != ""){

                $facturas->whereBetween('inicio', array($desde, $hasta));

            }else if($desde != ""){

                $facturas->where('inicio','>=',$desde);
            } else if($hasta != ""){
                $facturas->where('inicio','<=', $hasta);
            }

        })->paginate(10);

        if($request->ajax()){

            return view('renders.facturas',compact('facturas'));
        }
        else{
            return View::make('facturacion',compact('facturas','search','titular','difunto','dni','calle','desde','hasta'));
        }
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

        $factura = Factura::where('idnicho',$idnicho)->orderBy('serie')->get();
        return view('facturasProcesoNichos',compact('factura'));
    }


    /**
     * @param $idnicho
     * @return \Illuminate\View\View
     */
    public function showParcela($idparcela) {

        $factura = Factura::where('idparcela',$idparcela)->orderBy('serie')->get();
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

        $f = VFacturas::find($id);
        $servicios = TarifaServicios::all();
        $lineas = VLinea::where('factura',$id)->get();

       //crear una vista

        return view('modificar_factura',compact('f','servicios','lineas'));
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

        $hoy = Carbon::now();

        $factura->idtitular = $titular;
        $factura->iddifunto = $difunto;
        $factura->idnicho = $nicho;
        $factura->idparcela = $parcela;
        $factura->serie = 'E';
        $factura->inicio = $hoy;
        $factura->fin = $hoy;
        $numero = Factura::where('serie','E')->whereYear('inicio','=',$hoy->year)->max('numero');
        $factura->numero = $numero+1;

        $factura->save();
    }


    public function facturaCesion($titular, $nicho, $cesion){

        if($cesion == 0){ $this->facturaCesionPerpetua($titular,$nicho);}
        else if ($cesion==1){ $this->facturaCesionTemporal($titular,$nicho);}
    }


    public function facturaCesionPerpetua($titular, $nicho){


        //fecha de hoy
        $hoy = Carbon::now();

        //busco si hay una factura de un nicho para la serie D, osea si alguna vez se ha generado una factura
        $aux = Factura::where('idnicho',$nicho)->where('serie','D')->first();

        //obtener el numero de factura maximo
        $numero = Factura::where('serie','D')->whereYear('inicio','=',$hoy->year)->max('numero');


        //valores que se establecen solo una vez
        if($aux == null) {

            $factura = new Factura();
            $factura->numero = $numero+1;
            $factura->inicio = $hoy;
            $factura->fin = $hoy;
            $factura->idnicho = $nicho;
            $factura->serie = 'D';
            $factura->idtitular = $titular;
            $factura->save();

            $this->Mantenimiento5Nicho($nicho, $titular);

        }
    }


    public function fcpP($titular, $parcela){

        //fecha de hoy
        $hoy = Carbon::now();

        //busco si hay una factura de una parcela para la serie P, osea si alguna vez se ha generado una factura
        $aux = Factura::where('idnicho',$parcela)->where('serie','P')->first();

        //obtener el numero de factura maximo
        $numero = Factura::where('serie','P')->whereYear('inicio','=',$hoy->year)->max('numero');


        //valores que se establecen solo una vez
        if($aux == null) {

            $factura = new Factura();
            $factura->numero = $numero+1;
            $factura->inicio = $hoy;
            $factura->fin = $hoy;
            $factura->idparcela = $parcela;
            $factura->serie = 'P';
            $factura->idtitular = $titular;
            $factura->save();

            //$this->Mantenimiento5Nicho($nicho, $titular);
        }
    }


    public function facturaCesionTemporal($titular, $nicho){


        //fecha de hoy
        $hoy = Carbon::now();

        //busco si hay una factura de un nicho para la serie D, osea si alguna vez se ha generado una factura
        $aux = Factura::where('idnicho',$nicho)->where('serie','T')->first();

        //obtener el numero de factura maximo
        $numero = Factura::where('serie','T')->whereYear('inicio','=',$hoy->year)->max('numero');


        //valores que se establecen solo una vez
        if($aux == null) {

            $factura = new Factura();
            $factura->numero = $numero+1;
            $factura->inicio = $hoy;
            $factura->fin = $hoy;
            $factura->idnicho = $nicho;
            $factura->serie = 'T';
            $factura->idtitular = $titular;
            $factura->save();

            $this->Mantenimiento5Nicho($nicho, $titular);

        }
    }


    public function Mantenimiento5Nicho($nicho, $titular){

        $hoy = Carbon::now();
        $man = Carbon::now();

        $factura = new Factura();
        $numero = Factura::where('serie','N')->whereYear('inicio','=',$hoy->year)->max('numero');
        $factura->numero = $numero+1;
        $factura->inicio = $hoy;
        $factura->fin = $man->addYears(5);
        $factura->idnicho = $nicho;
        $factura->serie = 'N';
        $factura->idtitular = $titular;
        $factura->save();

    }
}
