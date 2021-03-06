<?php

namespace App\Http\Controllers;

use App\model\Factura;
use App\model\infoRecibos;
use App\model\Nicho;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Collection;
use App\model\Tm_nichos;
use App\model\Iva2;
use App;
use App\model\Tramada;
use App\model\Tm_parcelas;
use App\model\Parcela;
use App\model\Titular;

class recibosController extends Controller
{
    /**
     * Display a listing of the resource
     * @return \Illuminate\Http\Response
     */

    private $nuevaFactura;

    public function index()
    {
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
        $numero = $r->input('numbuscar');
        $page = $r->input('page');

        //tenemos que sacar una lista de nichos en función a los parámetros de la petición,
        //si esta al corriente en los pagos o no.
        if($r->input('corriente') != null) {
            //buscamos todos los nichos que no tengan facturas pendientes incluso estén adelantados  es decir fecha fin => al año de hoy.
            $hoy = Carbon::now();
            $nichos = infoRecibos::where('fin', '>', $hoy->year)
                ->where(function ($nichos) use ($titular, $calle, $dni, $numero) {
                    if ($titular != '') $nichos->where('nombre_titular', 'like', "%$titular%");

                    if ($calle != '') $nichos->where('calle', 'like', "%$calle%");

                    if ($numero != '') {
                            $nichos->where('numero_nicho', 'like', "%$numero%");
                            $nichos->orWhere('parcela', 'like', "%$numero%");
                    }

                    if ($dni != '') $nichos->where('dni_titular', 'like', "%$dni%");

                })->paginate(10);
        }else {
            //buscamos todos los nichos que tengan facturas pendientes es decir fecha fin < al año de hoy.
            $hoy = Carbon::now();
            $nichos = infoRecibos::where('fin', '<=', $hoy->year)
                ->where(function ($nichos) use ($titular, $calle, $dni,$numero) {
                    if($titular != '') $nichos->where('nombre_titular', 'like', "%$titular%");

                    if ($calle != '') $nichos->where('calle', 'like', "%$calle%");

                    if ($numero != '') {
                        $nichos->where('numero_nicho', 'like', "%$numero%");
                        $nichos->orWhere('parcela', 'like', "%$numero%");
                    }
                    if($dni != '') $nichos->where('dni_titular', 'like', "%$dni%");

                })->paginate(10);
        }

        if(count($nichos) != 0 && count($nichos) > 30)
        {
            return 1;
        }else if(count($nichos) == 0) {
            return 0;
        }else{
            return view('renders.recibos',compact('nichos'));
        }

    }

    function update(Request $r){

        //Obtenemos los parámetros de la petición
        $id = $r->input('id');
        $tipo = $r->input('tipo');
        $hoy = Carbon::now();

        //obtenemos la fecha inicio y fin de los años que se pretende pagar
        $inicio = new Carbon($r->input('inicio'));
        $fin = new Carbon($r->input('fin'));

        //obtenemos el iva para calculos
        $iva = Iva2::first()->tipo;

        //inicializamos el objeto factura
        $this->nuevaFactura = new Factura();

        //Asignamos atributos a nuevaFactura para ello obtenemos dato de infoRecibos
        $nicho = infoRecibos::find($id);

        $this->nuevaFactura->idtitular = $nicho->idtitular;
        $this->nuevaFactura->iddifunto = $nicho->iddifunto;
        $this->nuevaFactura->serie = $tipo;
        $this->nuevaFactura->pendiente = 1;//las ponemos así por defecto?
        $this->nuevaFactura->pagada = 0;//las ponemos así por defecto?
        $this->nuevaFactura->inicio = $r->input('inicio');
        $this->nuevaFactura->fin = $r->input('fin');


        if($tipo == 'N'){

            //Si es de un nicho el recibo que vamos a imprimir.
            $this->nuevaFactura->idnicho = $nicho->idnicho;
            $this->nuevaFactura->calle = $nicho->calle;
            $this->nuevaFactura->tramada = $nicho->tramada;
            $this->nuevaFactura->numero_nicho = $nicho->numero_nicho;

            //Obtenemos el titular de este nicho
            $titularinfo= Titular::find($nicho->idtitular);

            //Obtenemos el nicho
            $nichoinfo = Nicho::find($nicho->idnicho);

            //Obtenemos el nº de la serie que le corresponde
            $numero = Factura::where('serie','N')->whereYear('inicio','=',$hoy->year)->max('numero');

            $this->nuevaFactura->numero = $numero + 1;

            //Calculamos la  base total para la tarifa de mantenimiento nichos
            $tarifa = Tm_nichos::first();

            $precio = $tarifa->tarifa * ($fin->year - $inicio->year);
            $this->nuevaFactura->base = $precio;
            $this->nuevaFactura->iva = $precio * ($iva/100);
            $this->nuevaFactura->total = $precio + ($precio * ($iva/100));

        }else {

            $this->nuevaFactura->idparcela = $nicho->idparcela;
            $this->nuevaFactura->calle = $nicho->calle;
            $this->nuevaFactura->parcela = $nicho->parcela;

            //obtenemos el titular de esta parcela
            $titularinfo = Titular::find($nicho->idtitular);

            //Obtenemos la parcela
            $nichoinfo = Parcela::find($nicho->idparcela);

            //Obtenemos el nº de la serie que le corresponde
            $numero = Factura::where('serie', 'M')->whereYear('inicio', '=', $hoy->year)->max('numero');
            $this->nuevaFactura->numero = $numero + 1;

            //Buscamos el precio de mantenimiento de la parcela en tarifas que depende del tipo de nicho
            //si está construido o no, para saberlo comprobamos si tiene alguna tramada
            $tramadas = Tramada::where('GC_PARCELA_id', '=' , $nicho->idparcela)->get();

            $tamanyo = $nicho->metros_parcela;
            $this->nuevaFactura->metros_parcela = $tamanyo;
            //si tiene tramadas está construida por lo tanto tarifa 2
            if(count($tramadas) > 0){
                $tipo = 2;
                $tarifa = Tm_parcelas::find(2);
                //obtenemos el tamanyo de la parcela
                $numNichos = count($tramadas) * $tramadas[0]->nichos;
                $precio = ($numNichos * $tarifa->tarifa) * ($fin->year - $inicio->year);
            }else {
                //Sino la tarifa 1
                $tipo = 1;
                $tarifa = Tm_parcelas::find(1);
                //obtenemos el tamanyo de la parcela
                $precio = ($tamanyo * $tarifa->tarifa) * ($fin->year - $inicio->year);
            }
        }

        //Titular
        $this->nuevaFactura->nombre_titular = $titularinfo->nombre_titular;
        $this->nuevaFactura->dni_titular = $titularinfo->dni_titular;
        $this->nuevaFactura->domicilio_del_titular = $titularinfo->dom_titular;
        $this->nuevaFactura->cp_titular = $titularinfo->cp_titular;
        $this->nuevaFactura->poblacion_titular = $titularinfo->pob_titular;
        $this->nuevaFactura->provincia_titular = $titularinfo->pro_titular;

        //facturado
        $this->nuevaFactura->nombre_facturado = $nichoinfo->nom_facturado;
        $this->nuevaFactura->dni_facturado = $nichoinfo->dni_facturado;
        $this->nuevaFactura->domicilio_facturado = $nichoinfo->dir_facturado;
        $this->nuevaFactura->dni_facturado = $nichoinfo->nom_facturado;
        $this->nuevaFactura->cp_facturado = $nichoinfo->cp_facturado;
        $this->nuevaFactura->poblacion_facturado = $nichoinfo->pob_facturado;
        $this->nuevaFactura->provincia_facturado = $nichoinfo->pro_facturado;

        //Asiganamos datos monetarios a la factura.
        $this->nuevaFactura->base = $precio;
        $this->nuevaFactura->iva = $precio * ($iva/100);
        $this->nuevaFactura->total = $precio + ($precio * ($iva/100));
        $this->nuevaFactura->save();


        if($tipo == 'N'){
            //Generamos los pdfs para imprimir el recibo del nicho
            echo '<a type="button" class="btn btn-success" style="background-color: #009688;" href="/pdfmantenimientoNicho-'.$this->nuevaFactura->id.'">Visualizar y descargar Recibo</a>';
            echo '<a type="button" class="btn btn-success download" style="background-color: #009688;" href="/ipdfmantenimientoNicho-'.$this->nuevaFactura->id.'">Descargar directamente</a>';
        }else {
            //Generamos los enlaces para los pdfs de las parcelas
            echo '<a type="button" class="btn btn-success" style="background-color: #009688;" href="/pdfmantenimientoParcela-' . $this->nuevaFactura->id . '">Visualizar y descargar Recibo</a>';
            echo '<a type="button" class="btn btn-success download" style="background-color: #009688;" href="/ipdfmantenimientoParcela-' . $this->nuevaFactura->id . '">Descargar directamente</a>';
        }

    }


    public function  getNichoFin(Request $r){
        $id = $r->input('id');
        $nicho = infoRecibos::where('id' , '=' ,$id)->get()[0];
        return $nicho->fin;
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
