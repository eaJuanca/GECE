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
use App\Http\Controllers\PdfFacturasGenerator2;

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
        $domicilio = $r->input('domiciliobuscar');
        $page = $r->input('page');

        //tenemos que sacar una lista de nichos en función a los parámetros de la petición,
        //si esta al corriente en los pagos o no.
        if($r->input('corriente') != null) {
            //buscamos todos los nichos que no tengan facturas pendientes incluso estén adelantados  es decir fecha fin => al año de hoy.
            $hoy = Carbon::now();
            $nichos = infoRecibos::where('fin', '>=', $hoy->year)
                ->where(function ($nichos) use ($titular,$calle,$dni,$domicilio) {
                    if($titular != '') {
                        $nichos->where('panteon_titular', 'like', "%$titular%");
                        $nichos->oRwhere('nicho_titular', 'like', "%$titular%");
                    }
                    if($calle != '' ) {
                        $nichos->where('parcela_calle', 'like', "%$calle%");
                        $nichos->oRwhere('nicho_calle', 'like', "%$calle%");
                    }
                    if($domicilio != '') $nichos->where('domicilio' , 'like', "%$domicilio%");
                    if($dni != '') {
                        $nichos->where('nicho_dni', 'like', "%$dni%");
                        $nichos->oRwhere('parcela_dni', 'like', "%$dni%");
                    }
                })->paginate(10);//->skip(10 * ($page - 1))->take(10)->get();//->paginate(10)
        }else {

            //buscamos todos los nichos que tengan facturas pendientes es decir fecha fin < al año de hoy.
            $hoy = Carbon::now();
            $nichos = infoRecibos::where('fin', '<', $hoy->year)
                ->where(function ($nichos) use ($titular, $calle, $dni,$domicilio) {
                    if($titular != '') {
                        $nichos->where('panteon_titular', 'like', "%$titular%");
                        $nichos->oRwhere('nicho_titular', 'like', "%$titular%");
                    }
                    if ($calle != '') {
                        $nichos->where('parcela_calle', 'like', "%$calle%");
                        $nichos->oRwhere('nicho_calle', 'like', "%$calle%");
                    }
                    if ($dni != '') {
                        $nichos->where('nicho_dni', 'like', "%$dni%");
                        $nichos->oRwhere('parcela_dni', 'like', "%$dni%");
                    }
                    if($dni != '') {
                        $nichos->where('nicho_dni', 'like', "%$dni%");
                        $nichos->oRwhere('parcela_dni', 'like', "%$dni%");
                    }
                    if($domicilio != '') $nichos->where('domicilio' , 'like', "%$domicilio%");
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

        //Cremos la nueva factura con los datos necesarios que tenemos del nicho que se ha seleccionado
        $nicho = infoRecibos::where('id' , '=' ,$id)->get()[0];

        //inicializamos el objeto factura
        $this->nuevaFactura = new Factura();

        //Asignamos atributos a nuevaFactura;
        $this->nuevaFactura->idtitular = $nicho->idtitular;

        $this->nuevaFactura->iddifunto = $nicho->iddifunto;
        $this->nuevaFactura->serie = $tipo;
        $this->nuevaFactura->pendiente = 1;//las ponemos así por defecto?
        $this->nuevaFactura->pagada = 0;//las ponemos así por defecto?
        $this->nuevaFactura->inicio = $r->input('inicio');
        $this->nuevaFactura->fin = $r->input('fin');

        //obtenemos la fecha inicio y fin de los años que se pretende pagar
        $inicio = new Carbon($r->input('inicio'));
        $fin = new Carbon($r->input('fin'));

        if($tipo == 'N'){

            //Si es de un nicho el recibo que vamos a imprimir.
            $this->nuevaFactura->idnicho = $nicho->idnicho;
            //Obtenemos el nº de la serie que le corresponde
            $numero = Factura::where('serie','N')->whereYear('inicio','=',$hoy->year)->max('numero');
            $this->nuevaFactura->numero = $numero + 1;
            //Calculamos la  base total
            $tarifa = Tm_nichos::first();
            $precio = $tarifa->tarifa * ($fin->year - $inicio->year);

        }else {
            $this->nuevaFactura->idparcela = $nicho->idparcela;
            //Obtenemos el nº de la serie que le corresponde
            $numero = Factura::where('serie', 'M')->whereYear('inicio', '=', $hoy->year)->max('numero');
            $this->nuevaFactura->numero = $numero + 1;

            //Buscamos el precio de mantenimiento de la parcela en tarifas que depende del tipo de nicho
            //si está construido o no, para saberlo comprobamos si tiene alguna tramada
            $tramadas = Tramada::where('GC_PARCELA_id', '=' , $nicho->idparcela)->get();

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
                $tamanyio = Parcela::find($nicho->idparcela)->tamanyo;
                $precio = ($tamanyio * $tarifa->tarifa) * ($fin->year - $inicio->year);

            }
        }


        $iva = Iva2::first()->tipo;
        $this->nuevaFactura->iva = $iva;
        $this->nuevaFactura->base = $precio;
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
