<?php

namespace App\Http\Controllers;

use App\model\infoRecibos;
use App\model\Difunto;
use App\model\InfoNicho;
use App\model\Iva2;
use App\model\Nicho;
use App\model\Parcela;
use App\model\Tcp_parcelas2;
use App\model\Tcp_nichos;
use App\model\Tct_nichos;
use App\model\Titular;
use App\model\Tm_nichos;
use App\model\Tm_parcelas;
use App\model\Tramada;
use App\model\Factura;
use App\model\VFacturasLineas;
use App\model\VLinea;
use App\model\VPanteones;
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
        $facturas = VFacturasLineas::orderBy('id', 'DESC')->groupby('id')->paginate(10);
        $search = false;
        return View::make('facturacion', compact('facturas', 'search'));
    }


    /**
     * Paginacion de facturas
     * @return mixed
     */
    public function paginate()
    {

        $facturas = VFacturasLineas::orderBy('id', 'DESC')->groupby('id')->paginate(10);
        return view('renders.facturas', compact('facturas'));
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function busqueda(Request $request)
    {

        $titular = $request->input('titular');
        $difunto = $request->input('difunto');
        $dni = $request->input('dni');
        $calle = $request->input('calle');
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        $concepto = $request->input('concepto');


        $search = true;
        $facturas = VFacturasLineas::orderBy('id', 'DESC')->where(function ($facturas) use ($titular, $difunto, $dni, $calle, $desde, $hasta, $concepto) {

            if ($titular != "") $facturas->where('nombre_titular', 'like', "%$titular%");
            if ($difunto != "") $facturas->where('nom_difunto', 'like', "%$difunto%");
            if ($dni != "") $facturas->where('dni_titular', 'like', "%$dni%");
            if ($calle != "") $facturas->where('calle', 'like', "%$calle%");
            if ($concepto != "") $facturas->where('concepto', 'like', "%$concepto%");

            if ($desde != "" && $hasta != "") {

                $facturas->whereBetween('inicio', array($desde, $hasta));

            } else if ($desde != "") {

                $facturas->where('inicio', '>=', $desde);
            } else if ($hasta != "") {
                $facturas->where('inicio', '<=', $hasta);
            }

        })->groupby('id')->paginate(10);

        if ($request->ajax()) {

            return view('renders.facturas', compact('facturas'));
        } else {
            return View::make('facturacion', compact('facturas', 'search', 'titular', 'difunto', 'dni', 'calle', 'desde', 'hasta', 'concepto'));
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
     * @param  \Illuminate\Http\Request $request
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
    public function show($idnicho)
    {
        //$factura = Factura::where('idnicho', $idnicho)->where('serie', '!=', 'E')->orderBy('id', 'ASC')->take(3)->get();
        //$factura2 = Factura::where('idnicho', $idnicho)->where('serie', 'E')->orderBy('id', 'DESC')->take(1)->get();
        //$factura = $factura->merge($factura2);

        $escritura = true;
        $hoy = Carbon::now();

        $factura = Factura::where('idnicho', $idnicho)->where('created_at',substr($hoy,0,10))->orderBy('id', 'ASC')->get();

        return view('facturasProcesoNichos', compact('factura', 'idnicho','escritura'));
    }


    /**
     * @param $idnicho
     * @return \Illuminate\View\View
     */
    public function showParcela($idparcela)
    {

        $escritura = false;
        $factura = Factura::where('idnicho', $idparcela)->where('serie', '!=', 'E')->orderBy('id', 'ASC')->take(3)->get();
        $factura2 = Factura::where('idnicho', $idparcela)->where('serie', 'E')->orderBy('id', 'DESC')->take(1)->get();
        $factura = $factura->merge($factura2);

        return view('facturasProcesoNichos', compact('factura','idparcela','escritura'));
    }


    //Factura rapida cuando compras una parcela
    public function compraParcela($idparcela)
    {

        $escritura = true;
        $factura = Factura::where('idparcela', $idparcela)->where('serie', 'P')->take(1)->get();
        return view('facturasProcesoNichos', compact('factura','idparcela','escritura'));


    }


    /**
     * facturas de libre creacion L
     * @param $id
     */
    public function facturalibre($nicho)
    {

        $titular = Nicho::find($nicho)->GC_TITULAR_id;

        //fecha de hoy
        $hoy = Carbon::now();
        $iva = Iva2::first();
        $iva = $iva->tipo;
        $info = InfoNicho::find($nicho);
        $precio = Tcp_nichos::find($info->altura)->get()[0];
        $precio = $precio->tarifa;


        //obtener el numero de factura maximo
        $numero = Factura::where('serie', 'L')->whereYear('created_at', '=', $hoy->year)->max('numero');


        $titularinfo = Titular::find($titular);
        $nichoinfo = Nicho::find($nicho);

        $factura = new Factura();
        $factura->numero = $numero + 1;
        $factura->inicio = $hoy;
        $factura->fin = $hoy;
        $factura->idnicho = $nicho;
        $factura->serie = 'L';
        $factura->idtitular = $titular;
        $factura->base = $precio;
        $factura->iva = $precio * (($iva / 100));
        $factura->total = $precio * (1 + ($iva / 100));

        //nuevos campos

        $factura->tipo_adquisicion = 0;
        $factura->calle = $info->nombre_calle;
        $factura->tramada = $info->altura;
        $factura->numero_nicho = $info->numero;

        //titular
        $factura->nombre_titular = $titularinfo->nombre_titular;
        $factura->dni_titular = $titularinfo->dni_titular;
        $factura->domicilio_del_titular = $titularinfo->dom_titular;
        $factura->cp_titular = $titularinfo->cp_titular;
        $factura->poblacion_titular = $titularinfo->pob_titular;
        $factura->provincia_titular = $titularinfo->pro_titular;

        //facturado
        $factura->nombre_facturado = $nichoinfo->nom_facturado;
        $factura->dni_facturado = $nichoinfo->nif_facturado;
        $factura->domicilio_facturado = $nichoinfo->dir_facturado;
        $factura->cp_facturado = $nichoinfo->cp_facturado;
        $factura->poblacion_facturado = $nichoinfo->pob_facturado;
        $factura->provincia_facturado = $nichoinfo->pro_facturado;

        $factura->cesion = $nichoinfo->cesion;


        $factura->save();

        //$this->Mantenimiento1Nicho($nicho, $titular, $nichoinfo, $titularinfo, $info);

        $f = Factura::find($factura->id);
        $servicios = TarifaServicios::where('tipo', 0)->get();
        $lineas = VLinea::where('factura', $factura->id)->get();

        $tramada = null;

        if ($f->idparcela != null) {
            //si es una parcela obtenemos el id de la tramada
            $nicho = Nicho::find($f->idnicho);
            $numero = $nicho->numero;
            $tramada = Tramada::find($nicho->GC_Tramada_id)->tramada;
        } else {
            $tramada = $f->tramada;
            $numero = $f->numero_nicho;
        }

        $libre = 1;
        //crear una vista
        return view('modificar_factura', compact('f', 'servicios', 'lineas', 'numero', 'tramada','libre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $f = Factura::find($id);
        $servicios = TarifaServicios::where('tipo', 0)->get();
        $lineas = VLinea::where('factura', $id)->get();

        $tramada = null;

        if ($f->idparcela != null) {
            //si es una parcela obtenemos el id de la tramada
            $nicho = Nicho::find($f->idnicho);
            $numero = $nicho->numero;
            $tramada = Tramada::find($nicho->GC_Tramada_id)->tramada;
        } else {
            $tramada = $f->tramada;
            $numero = $f->numero_nicho;
        }

        $libre = 0;
        //crear una vista
        return view('modificar_factura', compact('f', 'servicios', 'lineas', 'numero', 'tramada','libre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        Factura::find($id)->delete();
    }

    public function facturaEnterramiento($nicho, $difunto, $titular, $parcela)
    {
        $factura = NEW Factura();

        $hoy = Carbon::now();

        $titularinfo = Titular::find($titular);
        $nichoinfo = Nicho::find($nicho);
        $odifunto = Difunto::find($difunto);


        $factura->idtitular = $titular;
        $factura->iddifunto = $difunto;
        $factura->idnicho = $nicho;
        $factura->idparcela = $parcela;
        $factura->serie = 'E';
        $factura->inicio = $hoy;
        $factura->fin = $hoy;
        $numero = Factura::where('serie', 'E')->whereYear('created_at', '=', $hoy->year)->max('numero');
        $factura->numero = $numero + 1;

        //nuevos campos

        $factura->tipo_adquisicion = 0;


        if ($parcela == null) {

            $info = InfoNicho::find($nicho);
            $factura->calle = $info->nombre_calle;
            $factura->tramada = $info->altura;
            $factura->numero_nicho = $info->numero;
            $factura->nombre_difunto = $odifunto->nom_difunto;
            $factura->cesion = $nichoinfo->cesion;


        } else {

            $info = VPanteones::where('parcela_id', $parcela)->first();
            $tramada = Tramada::find($nichoinfo->GC_Tramada_id)->tramada;
            $difunto = Difunto::find($difunto);
            $factura->calle = $info->calle;
            $factura->nombre_difunto = $odifunto->nom_difunto;
            $factura->numero_nicho = $info->numero;
            $factura->tramada = $tramada;
            $factura->parcela = $info->numero;
            $nichoinfo = Parcela::find($parcela);

        }


        //titular
        $factura->nombre_titular = $titularinfo->nombre_titular;
        $factura->dni_titular = $titularinfo->dni_titular;
        $factura->domicilio_del_titular = $titularinfo->dom_titular;
        $factura->cp_titular = $titularinfo->cp_titular;
        $factura->poblacion_titular = $titularinfo->pob_titular;
        $factura->provincia_titular = $titularinfo->pro_titular;

        //facturado
        $factura->nombre_facturado = $nichoinfo->nom_facturado;
        $factura->dni_facturado = $nichoinfo->nif_facturado;
        $factura->domicilio_facturado = $nichoinfo->dir_facturado;

        $factura->cp_facturado = $nichoinfo->cp_facturado;
        $factura->poblacion_facturado = $nichoinfo->pob_facturado;
        $factura->provincia_facturado = $nichoinfo->pro_facturado;

        //difunto

        $factura->save();

        //Generamos también la factura de mantenimiento desde último año que se pago
    }


    public function facturaCesion($titular, $nicho, $cesion)
    {

        if ($cesion == 0) {
            $this->facturaCesionPerpetua($titular, $nicho);
        } else if ($cesion == 1) {
            $this->facturaCesionTemporal($titular, $nicho);
        }
    }


    public function facturaCesionPerpetua($titular, $nicho)
    {

        //fecha de hoy
        $hoy = Carbon::now();
        $iva = Iva2::first();
        $iva = $iva->tipo;
        $info = InfoNicho::find($nicho);
        $precio = Tcp_nichos::find($info->altura)->get()[0];
        $precio = $precio->tarifa;


        //busco si hay una factura de un nicho para la serie D, osea si alguna vez se ha generado una factura
        $aux = Factura::where('idnicho', $nicho)->where('serie', 'D')->first();

        //obtener el numero de factura maximo
        $numero = Factura::where('serie', 'D')->whereYear('created_at', '=', $hoy->year)->max('numero');


        //valores que se establecen solo una vez
        if ($aux == null) {

            $titularinfo = Titular::find($titular);
            $nichoinfo = Nicho::find($nicho);

            $factura = new Factura();
            $factura->numero = $numero + 1;
            $factura->inicio = $hoy;
            $factura->fin = $hoy;
            $factura->idnicho = $nicho;
            $factura->serie = 'D';
            $factura->idtitular = $titular;
            $factura->base = $precio;
            $factura->iva = $precio * (($iva / 100));
            $factura->total = $precio * (1 + ($iva / 100));

            //nuevos campos

            $factura->tipo_adquisicion = 0;
            $factura->calle = $info->nombre_calle;
            $factura->tramada = $info->altura;
            $factura->numero_nicho = $info->numero;

            //titular
            $factura->nombre_titular = $titularinfo->nombre_titular;
            $factura->dni_titular = $titularinfo->dni_titular;
            $factura->domicilio_del_titular = $titularinfo->dom_titular;
            $factura->cp_titular = $titularinfo->cp_titular;
            $factura->poblacion_titular = $titularinfo->pob_titular;
            $factura->provincia_titular = $titularinfo->pro_titular;

            //facturado
            $factura->nombre_facturado = $nichoinfo->nom_facturado;
            $factura->dni_facturado = $nichoinfo->nif_facturado;
            $factura->domicilio_facturado = $nichoinfo->dir_facturado;
            $factura->cp_facturado = $nichoinfo->cp_facturado;
            $factura->poblacion_facturado = $nichoinfo->pob_facturado;
            $factura->provincia_facturado = $nichoinfo->pro_facturado;

            $factura->cesion = $nichoinfo->cesion;


            $factura->save();

            //$this->Mantenimiento1Nicho($nicho, $titular, $nichoinfo, $titularinfo, $info);
        }
    }


    /*
     * Función para generar la factura de cesión de perpetuidad de la parcela comprada.
     */

    public function facturaCesionTemporal($titular, $nicho)
    {

        //fecha de hoy
        $hoy = Carbon::now();

        //busco si hay una factura de un nicho para la serie D, osea si alguna vez se ha generado una factura
        $aux = Factura::where('idnicho', $nicho)->where('serie', 'T')->first();

        //obtener el numero de factura maximo
        $numero = Factura::where('serie', 'T')->whereYear('created_at', '=', $hoy->year)->max('numero');

        $iva = Iva2::first();
        $iva = $iva->tipo;

        $precio = Tct_nichos::first();
        $precio = $precio->tarifa;

        //valores que se establecen solo una vez
        if ($aux == null) {

            $titularinfo = Titular::find($titular);
            $nichoinfo = Nicho::find($nicho);
            $info = InfoNicho::find($nicho);


            $factura = new Factura();
            $factura->numero = $numero + 1;
            $factura->inicio = $hoy;
            $factura->fin = $hoy;
            $factura->idnicho = $nicho;
            $factura->serie = 'T';
            $factura->idtitular = $titular;
            $factura->base = $precio;
            $factura->iva = $precio * (($iva / 100));
            $factura->total = $precio * (1 + ($iva / 100));

            //nuevos campos

            $factura->tipo_adquisicion = 0;
            $factura->calle = $info->nombre_calle;
            $factura->tramada = $info->altura;
            $factura->numero_nicho = $info->numero;
            $factura->cesion = $nichoinfo->cesion;


            //titular
            $factura->nombre_titular = $titularinfo->nombre_titular;
            $factura->dni_titular = $titularinfo->dni_titular;
            $factura->domicilio_del_titular = $titularinfo->dom_titular;
            $factura->cp_titular = $titularinfo->cp_titular;
            $factura->poblacion_titular = $titularinfo->pob_titular;
            $factura->provincia_titular = $titularinfo->pro_titular;

            //facturado
            $factura->nombre_facturado = $nichoinfo->nom_facturado;
            $factura->dni_facturado = $nichoinfo->nif_facturado;
            $factura->domicilio_facturado = $nichoinfo->dir_facturado;
            $factura->cp_facturado = $nichoinfo->cp_facturado;
            $factura->poblacion_facturado = $nichoinfo->pob_facturado;
            $factura->provincia_facturado = $nichoinfo->pro_facturado;
            $factura->cesion = 1;

            $factura->save();

            //$this->Mantenimiento1Nicho($nicho, $titular, $nichoinfo, $titularinfo, $info);

        }
    }

    public function Mantenimiento5Nicho($nicho, $titular)
    {

        $hoy = Carbon::now();
        //Cogemos el ultimo año pagado en factura de esta parcela
        $ultimo = infoRecibos::where('idnicho', '=', $nicho)->groupBy('idparcela')->get(['fin'])[0]->fin;
        $ultimo = Carbon::create($ultimo, 1, 1, 0, 0);
        $fin = new Carbon($ultimo);

        //En la parcela si enterramos en 2015 y luego en 2016 no se puede generar 5 años más debería
        //calcularse si la diferencia es menor que 5 y si es así incrementar hasta 5
        if ($fin->year > $hoy->year) {
            $diferencia = (5 - ($fin->year - $hoy->year));
        } else {
            $diferencia = (5 + ($hoy->year - $fin->year));
        }

        if ($diferencia > 0) {

            $iva = Iva2::first();
            $iva = $iva->tipo;
            $precio = Tm_nichos::first();
            $precio = $precio->tarifa;
            $precio = $precio * $diferencia;

            $titularinfo = Titular::find($titular);
            $nichoinfo = Nicho::find($nicho);
            $info = InfoNicho::find($nicho);

            $factura = new Factura();
            $numero = Factura::where('serie', 'N')->whereYear('created_at', '=', $hoy->year)->max('numero');
            $factura->numero = $numero + 1;
            $factura->inicio = $ultimo;
            $factura->fin = $fin->addYears($diferencia);
            $factura->idnicho = $nicho;
            $factura->serie = 'N';
            $factura->idtitular = $titular;
            $factura->base = $precio;
            $factura->iva = $precio * (($iva / 100));
            $factura->total = $precio * (1 + ($iva / 100));

            //nuevos campos

            $factura->tipo_adquisicion = 0;
            $factura->calle = $info->nombre_calle;
            $factura->tramada = $info->altura;
            $factura->numero_nicho = $info->numero;
            $factura->cesion = $nichoinfo->cesion;


            //titular
            $factura->nombre_titular = $titularinfo->nombre_titular;
            $factura->dni_titular = $titularinfo->dni_titular;
            $factura->domicilio_del_titular = $titularinfo->dom_titular;
            $factura->cp_titular = $titularinfo->cp_titular;
            $factura->poblacion_titular = $titularinfo->pob_titular;
            $factura->provincia_titular = $titularinfo->pro_titular;

            //facturado
            $factura->nombre_facturado = $nichoinfo->nom_facturado;
            $factura->dni_facturado = $nichoinfo->nif_facturado;
            $factura->domicilio_facturado = $nichoinfo->dir_facturado;
            $factura->cp_facturado = $nichoinfo->cp_facturado;
            $factura->poblacion_facturado = $nichoinfo->pob_facturado;
            $factura->provincia_facturado = $nichoinfo->pro_facturado;

            $factura->save();
        }

    }

    public function fcpP($titular, $parcela)
    {
        //fecha de hoy
        $hoy = Carbon::now();

        //busco si hay una factura de una parcela para la serie P, osea si alguna vez se ha generado una factura
        $aux = Factura::where('idparcela', $parcela)->where('serie', 'P')->first();

        //obtener el numero de factura maximo
        //$numero = Factura::where('serie','P')->whereYear('inicio','=',$hoy->year)->max('numero');
        $numero = Factura::where('serie', 'P')->whereYear('created_at', '=', $hoy->year)->max('numero');

        //Obtener el tamanyo de la parcela
        $tamanyo = Parcela::where('id', $parcela)->get()[0]->tamanyo;

        $tarifa = Tcp_parcelas2::first();

        $iva = Iva2::first()->tipo;

        $precio = $tarifa->tarifa * $tamanyo;

        //valores que se establecen solo una vez
        if ($aux == null) {

            $titularinfo = Titular::find($titular);
            $infoparcela = Parcela::find($parcela);
            $infopanteon = VPanteones::where('parcela_id', $parcela)->first();

            $factura = new Factura();
            $factura->numero = $numero + 1;
            $factura->inicio = $hoy;
            $factura->fin = $hoy;
            $factura->idparcela = $parcela;
            $factura->serie = 'P';
            $factura->idtitular = $titular;
            $factura->base = $precio;
            $factura->iva = $precio * ($iva / 100);
            $factura->total = $precio + ($precio * ($iva / 100));

            //nuevos campos

            $factura->tipo_adquisicion = 1;
            $factura->calle = $infopanteon->calle;
            $factura->parcela = $infopanteon->numero;
            $factura->metros_parcela = $infopanteon->tamanyo;
            $factura->cesion = 0;


            //titular
            $factura->nombre_titular = $titularinfo->nombre_titular;
            $factura->dni_titular = $titularinfo->dni_titular;
            $factura->domicilio_del_titular = $titularinfo->dom_titular;
            $factura->cp_titular = $titularinfo->cp_titular;
            $factura->poblacion_titular = $titularinfo->pob_titular;
            $factura->provincia_titular = $titularinfo->pro_titular;

            //facturado
            $factura->nombre_facturado = $infoparcela->nom_facturado;
            $factura->dni_facturado = $infoparcela->nif_facturado;
            $factura->domicilio_facturado = $infoparcela->dir_facturado;
            $factura->cp_facturado = $infoparcela->cp_facturado;
            $factura->poblacion_facturado = $infoparcela->pob_facturado;
            $factura->provincia_facturado = $infoparcela->pro_facturado;
            $factura->cesion = 0;


            $factura->save();

            //$this->Mantenimiento1Parcela($parcela, $titular);
        }
    }

    public function Mantenimiento5Parcela($parcela, $titular, $idnicho)
    {

        $hoy = Carbon::now();
        //Cogemos el ultimo año pagado en factura de esta parcela
        $ultimo = infoRecibos::where('idparcela', '=', $parcela)->groupBy('idparcela')->get(['fin'])[0]->fin;
        $ultimo = Carbon::create($ultimo, 1, 1, 0, 0);
        $fin = new Carbon($ultimo);

        //En la parcela si enterramos en 2015 y luego en 2016 no se puede generar 5 años más debería
        //calcularse si la diferencia es menor que 5 y si es así incrementar hasta 5
        if ($fin->year > $hoy->year) {
            $diferencia = (5 - ($fin->year - $hoy->year));
        } else {
            $diferencia = (5 + ($hoy->year - $fin->year));
        }

        if ($diferencia > 0) {

            $iva = Iva2::first()->tipo;
            $tarifa = Tm_parcelas::find(2);
            //Obtener el nº de nichos de la parcela, se supone que está construida
            $tramadas = Tramada::where('GC_PARCELA_id', '=', $parcela)->get();
            $numNichos = count($tramadas) * $tramadas[0]->nichos;
            $precio = $tarifa->tarifa * $numNichos;

            $titularinfo = Titular::find($titular);
            $infoparcela = Parcela::find($parcela);
            $infopanteon = VPanteones::where('parcela_id', $parcela)->first();


            $factura = new Factura();
            $numero = Factura::where('serie', 'M')->whereYear('created_at', '=', $hoy->year)->max('numero');
            //también hay que poner el idnicho de esta factura porque estamos enterrando en un nicho
            $factura->idnicho = $idnicho;
            $factura->numero = $numero + 1;
            $factura->inicio = $ultimo;
            $factura->fin = $fin->addYears($diferencia);
            $factura->idparcela = $parcela;
            $factura->serie = 'M';
            $factura->idtitular = $titular;
            $factura->base = $precio * $diferencia;
            $factura->iva = ($precio * $diferencia) * ($iva / 100);
            $factura->total = ($precio * $diferencia) * (1 + ($iva / 100));

            //nuevos campo

            $factura->calle = $infopanteon->calle;
            $factura->parcela = $infopanteon->numero;
            $factura->metros_parcela = $infopanteon->tamanyo;
            $factura->cesion = $infopanteon->cesion;


            //titular
            $factura->nombre_titular = $titularinfo->nombre_titular;
            $factura->dni_titular = $titularinfo->dni_titular;
            $factura->domicilio_del_titular = $titularinfo->dom_titular;
            $factura->cp_titular = $titularinfo->cp_titular;
            $factura->poblacion_titular = $titularinfo->pob_titular;
            $factura->provincia_titular = $titularinfo->pro_titular;

            //facturado
            $factura->nombre_facturado = $infoparcela->nom_facturado;
            $factura->dni_facturado = $infoparcela->nif_facturado;
            $factura->domicilio_facturado = $infoparcela->dir_facturado;
            $factura->cp_facturado = $infoparcela->cp_facturado;
            $factura->poblacion_facturado = $infoparcela->pob_facturado;
            $factura->provincia_facturado = $infoparcela->pro_facturado;

            $factura->save();
        }
    }
}
