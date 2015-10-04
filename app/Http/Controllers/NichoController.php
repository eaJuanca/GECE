<?php

namespace App\Http\Controllers;

use App\model\InfoNicho;
use App\model\Nicho;
use Illuminate\Http\Request;
use App\Http\Requests;
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
    public function index()
    {


        $Qdisponibles = InfoNicho::where('nombre_titular', null)->orWhere('nombre_titular', '')->groupby('id');
        $Qnodisponibles = InfoNicho::where('nombre_titular', 'not', null)->orWhere('nombre_titular', '!=', '')->groupby('id');


        $td = count($Qdisponibles->get()); // total de nichos disponibles
        $tnd = count($Qnodisponibles->get()); // total de nichos no disponibles

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
    public function indexModify($id)
    {

        $nicho = Nicho::find($id);
        $info = InfoNicho::find($id);
        return view('modificar-nicho', compact('id', 'nicho', 'info'));

    }

    /**
     * Pagina los resultados de los nichos disponibles cuando no se está dentro de una busqueda
     * @param Request $request
     */

    public function paginateDisponibles(Request $request)
    {

        $disponibles = InfoNicho::where('nombre_titular', null)->orWhere('nombre_titular', '')->skip(10 * ($request->input('page') - 1))->groupby('id')->take(10)->get();

        foreach ($disponibles as $disponible) {

            $ruta = route('modificar-nichos', [$disponible->id]);

            echo '<tr>';
            echo '<td>' . $disponible->tipo . '</td>';
            echo '<td>' . $disponible->id . '</td>';
            echo '<td> Calle: <span style = "font-weight: bold">' . $disponible->nombre_calle . ',</span >
                       Altura, <span style = "font-weight: bold" >' . $disponible->altura . '</span >
                       Numero, <span style = "font-weight: bold" >' . $disponible->numero . '</span > </td >';

            echo '<td >' . $disponible->tarifa . '</td>';

            echo '<td>';
            if ($disponible->banco == null)
                echo '<i class="fa fa-lg fa-times" style = "color:red" ></i >';
            else echo $disponible->banco . '</td >';

            echo "<td > <a href ='$ruta' ><i class='fa fa-lg fa-pencil-square-o' ></i ></a ></td ></tr >";

        }
        //
    }

    /**
     * @param Request $request
     */

    public function paginateNoDisponibles(Request $request)
    {

        $Nodisponibles = InfoNicho::where('nombre_titular', 'not', null)->orWhere('nombre_titular', '!=', '')->skip(10 * ($request->input('page') - 1))->groupby('id')->take(10)->get();

        foreach ($Nodisponibles as $Nodisponible) {

            $ruta = route('modificar-nichos', [$Nodisponible->id]);
            $ruta2 = route('alta-difunto-nicho',[$Nodisponible->id]);


            echo '<tr>';
            echo '<td>' . $Nodisponible->tipo . '</td>';
            echo '<td>' . $Nodisponible->id . '</td>';
            echo '<td>' . $Nodisponible->nombre_titular . '</td>';
            echo '<td>' . $Nodisponible->telefono . '</td>';
            echo '<td> Calle: <span style = "font-weight: bold">' . $Nodisponible->nombre_calle . ',</span >
                       Altura, <span style = "font-weight: bold" >' . $Nodisponible->altura . '</span >
                       Numero, <span style = "font-weight: bold" >' . $Nodisponible->numero . '</span > </td >';

            echo '<td >' . $Nodisponible->tarifa . '</td>';

            echo '<td>';
            if ($Nodisponible->banco == null)
                echo '<i class="fa fa-lg fa-times" style = "color:red" ></i >';
            else echo $Nodisponible->banco . '</td >';

            echo "<td> <a href ='$ruta' ><i class='fa fa-lg fa-pencil-square-o' ></i ></a >";
            echo "<a title='Ver Nicho' data-toggle='modal' data-target='#complete-dialog' onclick='modal($Nodisponible->id)'><i class='fa fa-lg fa-search'></i></a>";
            echo "<a title='Añadir Difunto' href='$ruta2'><i class='fa fa-lg fa-user-plus'></i></a></td></tr>";

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
        $activo = $request->input('activa'); // tab activa
        $search = 1; //busqueda activa


        if ($activo == 1) {


            $Qdisponibles = InfoNicho::where(function ($Qdisponibles) {

                $Qdisponibles->where('nombre_titular', null);
                $Qdisponibles->orWhere('nombre_titular', '');

            })->where(function ($Qdisponibles) use ($titular, $calle, $numero) {

                if ($calle != '') $Qdisponibles->where('nombre_calle', 'like', "%$calle%");
                if ($numero != '') $Qdisponibles->where('numero', $numero);
            });


            $td = count($Qdisponibles->groupby('id')->get()); //total con respecto a la busqueda

            $disponibles = $Qdisponibles->groupby('id')->take(10)->get();
            $tab = 1; //se debe activar el tab 1

            return view('nichos', compact('disponibles', 'td', 'tab', 'search', 'titular', 'difunto', 'calle', 'numero'));


        } else {


            $Qnodisponibles = InfoNicho::where(function ($Qnodisponibles) {

                $Qnodisponibles->where('nombre_titular', 'not', null);
                $Qnodisponibles->orWhere('nombre_titular', '!=', '');

            })->where(function ($Qnodisponibles) use ($titular, $calle, $numero) {

                if ($titular != '') $Qnodisponibles->where('nombre_titular', 'like', "%$titular%");
                if ($calle != '') $Qnodisponibles->where('nombre_calle', 'like', "%$calle%");
                if ($numero != '') $Qnodisponibles->where('numero', $numero);
            });

            $tab = 2; // se debe activar el tab 2
            $tnd = count($Qnodisponibles->groupby('id')->get());
            $nodisponibles = $Qnodisponibles->groupby('id')->take(10)->get();

            return view('nichos', compact('nodisponibles', 'tnd', 'tab', 'search', 'titular', 'difunto', 'calle', 'numero'));

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
        $page = $request->input('page');


        $Qdisponibles = InfoNicho::where(function ($Qdisponibles) {

            $Qdisponibles->where('nombre_titular', null);
            $Qdisponibles->orWhere('nombre_titular', '');

        })->where(function ($Qdisponibles) use ($calle, $numero) {

            if ($calle != '') $Qdisponibles->where('nombre_calle', 'like', "%$calle%");
            if ($numero != '') $Qdisponibles->where('numero', $numero);
        });


        $disponibles = $Qdisponibles->skip(10 * ($page - 1))->groupby('id')->take(10)->get();

        foreach ($disponibles as $disponible) {

            $ruta = route('modificar-nichos', [$disponible->id]);

            echo '<tr>';
            echo '<td>' . $disponible->tipo . '</td>';
            echo '<td>' . $disponible->id . '</td>';
            echo '<td> Calle: <span style = "font-weight: bold">' . $disponible->nombre_calle . ',</span >
                       Altura, <span style = "font-weight: bold" >' . $disponible->altura . '</span >
                       Numero, <span style = "font-weight: bold" >' . $disponible->numero . '</span > </td >';

            echo '<td >' . $disponible->tarifa . '</td>';

            echo '<td>';
            if ($disponible->banco == null)
                echo '<i class="fa fa-lg fa-times" style = "color:red" ></i >';
            else echo $disponible->banco . '</td >';

            echo "<td > <a href ='$ruta' ><i class='fa fa-lg fa-pencil-square-o' ></i ></a ></td ></tr >";


        }

    }


    public function paginateNoDisponiblesBusqueda(Request $request)
    {

        $titular = $request->input('titular');
        $difunto = $request->input('difunto');
        $calle = $request->input('nombrecalle');
        $numero = $request->input('numero');
        $activo = $request->input('activa'); // tab activa
        $search = 1; //busqueda activa
        $page = $request->input('page');

        $Qnodisponibles = InfoNicho::where(function ($Qnodisponibles) {

            $Qnodisponibles->where('nombre_titular', 'not', null);
            $Qnodisponibles->orWhere('nombre_titular', '!=', '');

        })->where(function ($Qnodisponibles) use ($titular, $calle, $numero) {

            if ($titular != '') $Qnodisponibles->where('nombre_titular', 'like', "%$titular%");
            if ($calle != '') $Qnodisponibles->where('nombre_calle', 'like', "%$calle%");
            if ($numero != '') $Qnodisponibles->where('numero', $numero);
        });

        $Nodisponibles = $Qnodisponibles->skip(10 * ($page - 1))->groupby('id')->take(10)->get();

        foreach ($Nodisponibles as $Nodisponible) {

            $ruta = route('modificar-nichos', [$Nodisponible->id]);
            $ruta2 = route('alta-difunto-nicho',[$Nodisponible->id]);

            echo '<tr>';
            echo '<td>' . $Nodisponible->tipo . '</td>';
            echo '<td>' . $Nodisponible->id . '</td>';
            echo '<td>' . $Nodisponible->nombre_titular . '</td>';
            echo '<td>' . $Nodisponible->telefono . '</td>';
            echo '<td> Calle: <span style = "font-weight: bold">' . $Nodisponible->nombre_calle . ',</span >
                       Altura, <span style = "font-weight: bold" >' . $Nodisponible->altura . '</span >
                       Numero, <span style = "font-weight: bold" >' . $Nodisponible->numero . '</span > </td >';

            echo '<td >' . $Nodisponible->tarifa . '</td>';

            echo '<td>';
            if ($Nodisponible->banco == null)
                echo '<i class="fa fa-lg fa-times" style = "color:red" ></i >';
            else echo $Nodisponible->banco . '</td >';

            echo "<td> <a href ='$ruta' ><i class='fa fa-lg fa-pencil-square-o' ></i ></a >";
            echo "<a title='Ver Nicho' data-toggle='modal' data-target='#complete-dialog' onclick='modal($Nodisponible->id)'><i class='fa fa-lg fa-search'></i></a>";
            echo "<a title='Añadir Difunto' href='$ruta2'><i class='fa fa-lg fa-user-plus'></i></a></td></tr>";

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
    public function edit(Request $request)
    {
        $nichoU = new Nicho($request->all());
        $nicho = Nicho::find($request->input('id'));
        $nicho->update($nichoU->attributesToArray());
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
            $fecha_ultimo->addYears(4);
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

}

/**
 * create view infonicho as select n.id, n.nombre_titular, n.banco, n.tipo, n.numero, n.tel_titular as telefono,
 * n.exp_titular as expediente, t.tramada as altura, c.nombre as nombre_calle, d.nom_difunto from gc_nichos n
 * left join gc_tramada t on n.GC_Tramada_id = t.id left join gc_calle c on t.GC_CALLE_id = c.id
 * left join gc_difuntos d on d.GC_NICHOS_id = n.id
 *
 */
