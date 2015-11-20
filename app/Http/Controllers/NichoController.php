<?php

namespace App\Http\Controllers;

use App\model\InfoNicho;
use App\model\Nicho;
use App\model\Titular;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use App\model\TotalNicho;
use Carbon\Carbon;

class NichoController extends Controller
{
    /**
     * Pagina principal de nichos, con todos los resultados paginados a 10
     * es un mero inicio
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
       $this->middleware('auth');
    }


    public function index()
    {

        $Qdisponibles = InfoNicho::whereNull('GC_TITULAR_id')->where('sintitular',false)->groupby('id');
        $Qnodisponibles = InfoNicho::whereNotNull('GC_TITULAR_id')->oRwhere('sintitular',true)->groupby('id');

        $td = InfoNicho::whereNull('GC_TITULAR_id')->where('sintitular',false)->count(); // total de nichos disponibles
        $tnd = InfoNicho::whereNotNull('GC_TITULAR_id')->oRwhere('sintitular',true)->groupby('id')->get(); // total de nichos no disponibles
        $tnd = $tnd->count();

        $disponibles = $Qdisponibles->take(10)->get();
        $nodisponibles = $Qnodisponibles->take(10)->get();

        $tab = 1; // tab activa
        $search = 0; // busqueda inactica


        return view('nichos', compact('disponibles', 'nodisponibles', 'td', 'tnd', 'tab', 'search'));

        //
    }

    /**
     * Devuelve la pagina inicial para modificar un nicho con el nicho ya cargado
     * @param $id
     * @return \Illuminate\View\View
     */
    public function indexModify($idnicho)
    {

        $nicho = Nicho::find($idnicho);
        $info = InfoNicho::find($idnicho);
        $titular = Titular::findOrNew($nicho->GC_TITULAR_id);


        return view('modificar-nicho', compact('idnicho', 'nicho', 'info','titular'));

    }

    /**
     * Pagina los resultados de los nichos disponibles cuando no se est� dentro de una busqueda
     * @param Request $request
     */

    public function paginateDisponibles(Request $request)
    {

        $disponibles = InfoNicho::whereNull('GC_TITULAR_id')->where('sintitular',false)->skip(10 * ($request->input('page') - 1))->groupby('id')->take(10)->get();

        foreach ($disponibles as $disponible) {

            $ruta = route('modificar-nichos', [$disponible->id]);

            echo '<tr>';
            echo '<td>' . $disponible->id . '</td>';
            echo '<td>' . $disponible->tipo . '</td>';
            echo '<td> Calle: <span style = "font-weight: bold">' . $disponible->nombre_calle . ',</span >
                       Altura, <span style = "font-weight: bold" >' . $disponible->altura . '</span >
                       Numero, <span style = "font-weight: bold" >' . $disponible->numero . '</span > </td >';

            echo "<td > <a href ='$ruta' ><i class='fa fa-lg fa-pencil-square-o' ></i > Adquirir</a ></td ></tr >";

        }
        //
    }

    /**
     * @param Request $request
     */

    public function paginateNoDisponibles(Request $request)
    {

        $Nodisponibles = InfoNicho::whereNotNull('GC_TITULAR_id')->oRwhere('sintitular',true)->skip(10 * ($request->input('page') - 1))->groupby('id')->take(10)->get();

        foreach ($Nodisponibles as $Nodisponible) {

            $ruta = route('modificar-nichos', [$Nodisponible->id]);
            $ruta2 = route('alta-difunto-nicho',[$Nodisponible->id]);
            $ruta3 = route('factura-libre',[$Nodisponible->id]);


            echo '<tr>';
            echo '<td>' . $Nodisponible->id . '</td>';
            echo '<td>' . $Nodisponible->tipo . '</td>';
            echo '<td>' . $Nodisponible->nombre_titular . '</td>';
            echo '<td>' . $Nodisponible->telefono . '</td>';
            echo '<td> Calle: <span style = "font-weight: bold">' . $Nodisponible->nombre_calle . ',</span >
                       Altura, <span style = "font-weight: bold" >' . $Nodisponible->altura . '</span >
                       Numero, <span style = "font-weight: bold" >' . $Nodisponible->numero . '</span > </td >';

            echo "<td> ";
            if(Auth::user()->rol == 0) echo "<a href ='$ruta' ><i class='fa fa-lg fa-pencil-square-o' ></i ></a >";
            echo "<a title='Ver Nicho' data-toggle='modal' data-target='#complete-dialog' onclick='modal($Nodisponible->id)'><i class='fa fa-lg fa-search'></i></a>";
            echo "<a title='Añadir Difunto' href='$ruta2'><i class='fa fa-lg fa-user-plus'></i></a>";
            echo "<a title='Crear factura' href='$ruta3'><i class='fa fa-lg fa-euro'></i></a></td></tr>";

        }

    }


    /**
     * Realiza una busqueda de nichos disponibles o no disponibles en funcion de la tab que habia activada
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function busquedaNicho(Request $request)
    {

        $titular = $request->input('titular');
        $difunto = $request->input('difunto');
        $calle = $request->input('calle');
        $numero = $request->input('numero');
        $tramada = $request->input('tramada');
        $activo = $request->input('activa'); // tab activa
        $dni = $request->input('dni');
        $search = 1; //busqueda activa


        if ($activo == 1) {


            $Qdisponibles = InfoNicho::where(function ($Qdisponibles) {

                $Qdisponibles->whereNull('GC_TITULAR_id');
                $Qdisponibles->where('sintitular',false);


            })->where(function ($Qdisponibles) use ($calle, $numero,$tramada) {

                if ($calle != '') $Qdisponibles->where('nombre_calle', 'like', "%$calle%");
                if ($numero != '') $Qdisponibles->where('numero', $numero);
                if ($tramada != '') $Qdisponibles->where('altura', $tramada);
            });


            $td = count($Qdisponibles->groupby('id')->get()); //total con respecto a la busqueda

            $disponibles = $Qdisponibles->groupby('id')->take(10)->get();
            $tab = 1; //se debe activar el tab 1

            return view('nichos', compact('disponibles', 'td', 'tab', 'search', 'titular', 'difunto', 'calle', 'numero','tramada'));


        } else {


            $Qnodisponibles = InfoNicho::where(function ($Qnodisponibles) {


                $Qnodisponibles->whereNotNull('GC_TITULAR_id');
                $Qnodisponibles->oRwhere('sintitular',true);

            })->where(function ($Qnodisponibles) use ($titular, $calle, $numero, $difunto,$tramada,$dni) {

                if ($titular != '') $Qnodisponibles->where('nombre_titular', 'like', "%$titular%");
                if ($calle != '') $Qnodisponibles->where('nombre_calle', 'like', "%$calle%");
                if ($numero != '') $Qnodisponibles->where('numero', $numero);
                if ($difunto != '') $Qnodisponibles->where('nom_difunto', 'like', "%$difunto%");
                if ($tramada != '') $Qnodisponibles->where('altura', $tramada);
                if ($dni != '') $Qnodisponibles->where('dni_titular', 'like', "%$dni%");

            });

            $tab = 2; // se debe activar el tab 2
            $tnd = count($Qnodisponibles->groupby('id')->get());
            $nodisponibles = $Qnodisponibles->groupby('id')->take(10)->get();

            return view('nichos', compact('nodisponibles', 'tnd', 'tab', 'search', 'titular', 'difunto', 'calle', 'numero','difunto','tramada','dni'));

        }
    }


    /**
     * Pagina los resultados de ua busqueda realizada
     * @param Request $request
     */
    public function paginateDisponiblesBusqueda(Request $request)
    {

        $calle = $request->input('calle');
        $numero = $request->input('numero');
        $tramada = $request->input('tramada');
        $page = $request->input('page');


        $Qdisponibles = InfoNicho::where(function ($Qdisponibles) {

            $Qdisponibles->whereNull('GC_TITULAR_id');
            $Qdisponibles->where('sintitular',false);

        })->where(function ($Qdisponibles) use ($calle, $numero,$tramada) {

            if ($calle != '') $Qdisponibles->where('nombre_calle', 'like', "%$calle%");
            if ($numero != '') $Qdisponibles->where('numero', $numero);
            if ($tramada != '') $Qdisponibles->where('altura', $tramada);

        });


        $disponibles = $Qdisponibles->skip(10 * ($page - 1))->groupby('id')->take(10)->get();

        foreach ($disponibles as $disponible) {

            $ruta = route('modificar-nichos', [$disponible->id]);

            echo '<tr>';
            echo '<td>' . $disponible->id . '</td>';

            echo '<td>' . $disponible->tipo . '</td>';
            echo '<td> Calle: <span style = "font-weight: bold">' . $disponible->nombre_calle . ',</span >
                       Altura, <span style = "font-weight: bold" >' . $disponible->altura . '</span >
                       Numero, <span style = "font-weight: bold" >' . $disponible->numero . '</span > </td >';


            echo "<td > <a href ='$ruta' ><i class='fa fa-lg fa-pencil-square-o' ></i > Adquirir</a ></td ></tr >";


        }

    }


    public function paginateNoDisponiblesBusqueda(Request $request)
    {

        $titular = $request->input('titular');
        $difunto = $request->input('difunto');
        $calle = $request->input('calle');
        $numero = $request->input('numero');
        $tramada = $request->input('tramada');
        $dni = $request->input('dni');
        $page = $request->input('page');

        $Qnodisponibles = InfoNicho::where(function ($Qnodisponibles) {

            $Qnodisponibles->whereNotNull('GC_TITULAR_id');
            $Qnodisponibles->oRwhere('sintitular',true);

        })->where(function ($Qnodisponibles) use ($titular, $calle, $numero,$difunto,$tramada,$dni) {

            if ($titular != '') $Qnodisponibles->where('nombre_titular', 'like', "%$titular%");
            if ($calle != '') $Qnodisponibles->where('nombre_calle', 'like', "%$calle%");
            if ($numero != '') $Qnodisponibles->where('numero', $numero);
            if ($difunto != '') $Qnodisponibles->where('nom_difunto', 'like', "%$difunto%");
            if ($tramada != '') $Qnodisponibles->where('altura', $tramada);
            if ($dni != '') $Qnodisponibles->where('dni_titular', 'like', "%$dni%");
        });

        $Nodisponibles = $Qnodisponibles->skip(10 * ($page - 1))->groupby('id')->take(10)->get();

        foreach ($Nodisponibles as $Nodisponible) {

            $ruta = route('modificar-nichos', [$Nodisponible->id]);
            $ruta2 = route('alta-difunto-nicho',[$Nodisponible->id]);
            $ruta3 = route('factura-libre',[$Nodisponible->id]);


            echo '<tr>';
            echo '<td>' . $Nodisponible->id . '</td>';
            echo '<td>' . $Nodisponible->tipo . '</td>';
            echo '<td>' . $Nodisponible->nombre_titular . '</td>';
            echo '<td>' . $Nodisponible->telefono . '</td>';
            echo '<td> Calle: <span style = "font-weight: bold">' . $Nodisponible->nombre_calle . ',</span >
                       Altura, <span style = "font-weight: bold" >' . $Nodisponible->altura . '</span >
                       Numero, <span style = "font-weight: bold" >' . $Nodisponible->numero . '</span > </td >';

            echo "<td> ";
            if(Auth::user()->rol == 0) echo "<a href ='$ruta' ><i class='fa fa-lg fa-pencil-square-o' ></i ></a >";
            echo "<a title='Ver Nicho' data-toggle='modal' data-target='#complete-dialog' onclick='modal($Nodisponible->id)'><i class='fa fa-lg fa-search'></i></a>";
            echo "<a title='Añadir Difunto' href='$ruta2'><i class='fa fa-lg fa-user-plus'></i></a>";
            echo "<a title='Crear factura' href='$ruta3'><i class='fa fa-lg fa-euro'></i></a></td></tr>";

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
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Modifica el nicho en la base de datos
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request){

        $sintitularbox = $request->input('sintitular');

        $idtitular = $request->input('idtitular'); //id titular

        $sintitular = false;

        if($sintitularbox != null){

            $idtitular = null;
            $sintitular = true;

        }else{

            if($idtitular==''){

                $titular = new Titular($request->only('nombre_titular','responsable','dom_titular','cp_titular','pob_titular','exp_titular','dni_titular','tel_titular','ema_titular','pro_titular'));
                $idtitular = $titular->insertGetId($titular->attributesToArray());
            }
            else{

                $titularA = new Titular($request->only('nombre_titular','responsable','dom_titular','cp_titular','pob_titular','exp_titular','dni_titular','tel_titular','ema_titular','pro_titular'));
                $titular = Titular::find($idtitular);
                $titular->update($titularA->attributesToArray());
                $idtitular = $request->input('idtitular'); //id titular

            }
        }

        $nichoU = new Nicho($request->except('nombre_titular','responsable','dom_titular','cp_titular','pob_titular','exp_titular','dni_titular','tel_titular','ema_titular','pro_titular'));
        $nicho = Nicho::find($request->input('idnicho'));
        $nichoU->GC_TITULAR_id = $idtitular;
        $nichoU->sintitular = $sintitular;
        $nicho->update($nichoU->attributesToArray());

        if($sintitularbox == "on") {


        }else{
            $factura = new FacturacionController();
            $factura->facturaCesion($idtitular, $nicho->id, $nicho->cesion);
        }

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
    public function destroy($id)
    {
        //
    }

    public function getData(Request $request){

        $nichoid = $request->input('id');

        $TN = TotalNicho::where('GC_NICHOS_id',$nichoid)->get();

        $total = 0;
        $fecha = 0;
        $cumplefecha = true;
        $cumpletotal= true;

        if(count($TN) > 0) {

            $total = $TN[0]->total;
            $fecha = $TN[0]->ultimo;

            $fecha_ultimo = new Carbon($fecha);
            $fecha_ultimo->addYears(5);
            $hoy = Carbon::now();

            $cumpletotal = true;
            if ($total >= 4) {
                $cumpletotal = false;
            }

            $cumplefecha = true;
            if ($fecha_ultimo > $hoy) {
                $cumplefecha = false;
            }
        }


        $data['total'] = $total;
        $data['fecha'] = $fecha;
        $data['cumpletotal'] = $cumpletotal;
        $data['cumplefecha'] = $cumplefecha;

        return json_encode($data);
    }

    /**
     * Comentario cambios
     */

}

/**
 * create view infonicho as select n.id, n.nombre_titular, n.banco, n.tipo, n.numero, n.tel_titular as telefono,
 * n.exp_titular as expediente, t.tramada as altura, c.nombre as nombre_calle, d.nom_difunto from gc_nichos n
 * left join gc_tramada t on n.GC_Tramada_id = t.id left join gc_calle c on t.GC_CALLE_id = c.id
 * left join gc_difuntos d on d.GC_NICHOS_id = n.id
 *
 */
