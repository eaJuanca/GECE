<?php

namespace App\Http\Controllers;

use App\model\InfoNicho;
use App\model\Iva2;
use App\model\Parcela;
use App\model\Tcp_parcelas2;
use App\model\Tcp_nichos;
use App\model\Tct_nichos;
use App\model\Tm_nichos;
use App\model\Tm_parcelas;
use App\model\VFacturas;
use App\model\Factura;
use App\model\VLinea;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\model\VFacturasP;
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
        $facturas = VFacturas::orderBy('id','DESC')->paginate(10);
        $search = false;
        return View::make('facturacion',compact('facturas','search'));
    }


    /**
     * Paginacion de facturas
     * @return mixed
     */
    public function paginate(){

        $facturas = VFacturas::orderBy('id','DESC')->paginate(10);
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
        $facturas = VFacturas::orderBy('id','DESC')->where(function($facturas) use ($titular, $difunto, $dni, $calle, $desde, $hasta){

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

        $factura = Factura::where('idnicho',$idnicho)->where('serie','!=','E')->orderBy('id','ASC')->take(3)->get();
        $factura2 = Factura::where('idnicho',$idnicho)->where('serie','E')->orderBy('id','DESC')->take(1)->get();
        $factura = $factura->merge($factura2);
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

    public function facturaEnterramiento($nicho,$difunto,$titular,$parcela)
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

        $iva = Iva2::first();
        $iva = $iva->tipo;
        $info = InfoNicho::find($nicho);
        $precio = Tcp_nichos::find($info->altura)->get()[0];
        $precio =  $precio->tarifa;


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
            $factura->base = $precio;
            $factura->iva = $precio*(($iva/100));
            $factura->total = $precio*(1+($iva/100));
            $factura->save();

            $this->Mantenimiento5Nicho($nicho, $titular);

        }
    }


    /*
     * Función para generar la factura de cesión de perpetuidad de la parcela comprada.
     */

    public function Mantenimiento5Nicho($nicho, $titular){

        $hoy = Carbon::now();
        $man = Carbon::now();
        $man->addYears(5);

        $diff = $hoy->diffInYears($man);

        $iva = Iva2::first();
        $iva = $iva->tipo;
        $precio = Tm_nichos::first();
        $precio =  $precio->tarifa;
        $precio = $precio*$diff;



        $factura = new Factura();
        $numero = Factura::where('serie','N')->whereYear('inicio','=',$hoy->year)->max('numero');
        $factura->numero = $numero+1;
        $factura->inicio = $hoy;
        $factura->fin = $man;
        $factura->idnicho = $nicho;
        $factura->serie = 'N';
        $factura->idtitular = $titular;
        $factura->base = $precio;
        $factura->iva = $precio*(($iva/100));
        $factura->total = $precio*(1+($iva/100));
        $factura->save();

    }

    public function facturaCesionTemporal($titular, $nicho){


        //fecha de hoy
        $hoy = Carbon::now();

        //busco si hay una factura de un nicho para la serie D, osea si alguna vez se ha generado una factura
        $aux = Factura::where('idnicho',$nicho)->where('serie','T')->first();

        //obtener el numero de factura maximo
        $numero = Factura::where('serie','T')->whereYear('inicio','=',$hoy->year)->max('numero');

        $iva = Iva2::first();
        $iva = $iva->tipo;

        $precio = Tct_nichos::first();
        $precio =  $precio->tarifa;

        //valores que se establecen solo una vez
        if($aux == null) {

            $factura = new Factura();
            $factura->numero = $numero+1;
            $factura->inicio = $hoy;
            $factura->fin = $hoy;
            $factura->idnicho = $nicho;
            $factura->serie = 'T';
            $factura->idtitular = $titular;
            $factura->base = $precio;
            $factura->iva = $precio*(($iva/100));
            $factura->total = $precio*(1+($iva/100));

            $factura->save();

            $this->Mantenimiento5Nicho($nicho, $titular);

        }
    }

    public function fcpP($titular, $parcela){

        //fecha de hoy
        $hoy = Carbon::now();

        //busco si hay una factura de una parcela para la serie P, osea si alguna vez se ha generado una factura
        $aux = VFacturasP::where('idparcela',$parcela)->where('serie','P')->first();

        //obtener el numero de factura maximo
        //$numero = Factura::where('serie','P')->whereYear('inicio','=',$hoy->year)->max('numero');
        $numero = VFacturasP::where('serie','P')->whereYear('inicio','=',$hoy->year)->max('numero');

        //Obtener el tamanyo de la parcela
        $tamanyo = Parcela::where('id',$parcela)->get()[0]->tamanyo;

        $tarifa = Tcp_parcelas2::first();

        $iva = Iva2::first()->tipo;

        $precio = $tarifa->tarifa * $tamanyo;

        //valores que se establecen solo una vez
        if($aux == null) {

            $factura = new Factura();
            $factura->numero = $numero+1;
            $factura->inicio = $hoy;
            $factura->fin = $hoy;
            $factura->idparcela = $parcela;
            $factura->serie = 'P';
            $factura->idtitular = $titular;
            $factura->base = $precio;
            $factura->iva = $iva;
            $factura->total = $precio + ($precio * ($iva/100));
            $factura->save();

            $this->Mantenimiento1Parcela($parcela, $titular);
        }
    }

    public function Mantenimiento1Parcela($parcela, $titular){

        $hoy = Carbon::now();
        $man = Carbon::now();


        $iva = Iva2::first()->tipo;
        $tarifa = Tm_parcelas::find(1);
        //Obtener el tamanyo de la parcela
        $tamanyo = Parcela::where('id',$parcela)->get()[0]->tamanyo;
        $precio = $tarifa->tarifa * $tamanyo;

        $factura = new Factura();
        $numero = Factura::where('serie','M')->whereYear('inicio','=',$hoy->year)->max('numero');
        $factura->numero = $numero+1;
        $factura->inicio = $hoy;
        $factura->fin = $man->addYears(1);
        $factura->idparcela = $parcela;
        $factura->serie = 'M';
        $factura->idtitular = $titular;
        $factura->base = $precio;
        $factura->iva = $iva;
        $factura->total = $precio + ($precio * $iva/100);
        $factura->save();

    }
}
