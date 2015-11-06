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
use App;
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
                    if($dni != '') {
                        $nichos->where('nicho_dni', 'like', "%$dni%");
                        $nichos->oRwhere('parcela_dni', 'like', "%$dni%");
                    }
                })->groupBy('idnicho')->paginate(10);//->skip(10 * ($page - 1))->take(10)->get();//->paginate(10)

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
                    if($dni != '') {
                        $nichos->where('nicho_dni', 'like', "%$dni%");
                        $nichos->oRwhere('parcela_dni', 'like', "%$dni%");
                    }

                })->groupBy('idnicho')->paginate(10);//->skip(10 * ($page - 1))->take(10)->get();//->paginate(10)
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

        if($tipo == 'N'){
            $this->nuevaFactura->idnicho = $nicho->idnicho;
            //Obtenemos el nº de la serie que le corresponde
            $numero = Factura::where('serie','N')->whereYear('inicio','=',$hoy->year)->max('numero');

        }else {
            $this->nuevaFactura->idparcela = $nicho->idparcela;
            //Obtenemos el nº de la serie que le corresponde
            $numero = Factura::where('serie', 'M')->whereYear('inicio', '=', $hoy->year)->max('numero');

        }

        $this->nuevaFactura->iddifunto = $nicho->iddifunto;
        $this->nuevaFactura->serie = $tipo;
        $this->nuevaFactura->numero = $numero + 1;
        $this->nuevaFactura->pendiente = 1;//las ponemos así por defecto?
        $this->nuevaFactura->pagada = 0;//las ponemos así por defecto?
        $this->nuevaFactura->inicio = $r->input('inicio');
        $this->nuevaFactura->fin = $r->input('fin');
        $this->nuevaFactura->save();

        //Generamos el pdf????
        //View::make('recibos')->nest('child','pdf.pdfmantenimiento');

        echo '<a type="button" class="btn btn-success" style="background-color: #009688;" href="/pdfmantenimiento-'.$this->nuevaFactura->id.'">Visualizar y descargar Recibo</a>';
        echo '<a type="button" class="btn btn-success download" style="background-color: #009688;" href="/ipdfmantenimiento-'.$this->nuevaFactura->id.'">Descargar directamente</a>';

        //Descargamos el recibo automáticamente por si acaso.
        //$controller = App::make(PdfFacturasGenerator2::class);
        //$controller->callAction('imprimirFacturamanteniminento', array('id' => $this->nuevaFactura->id));
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
