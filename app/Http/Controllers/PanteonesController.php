<?php

namespace App\Http\Controllers;

use App\model\Difunto;
use App\model\NichosPanteones;
use App\model\VPanteones;
use Illuminate\Http\Request;
use App\Http\Requests;

class PanteonesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $Qdisponibles = VPanteones::whereNull('titular_id')->groupby('parcela_id');
        $Qnodisponibles = VPanteones::whereNotNull('titular_id')->groupby('parcela_id');


        $td = count($Qdisponibles->get()); // total de panteones disponibles
        $tnd = count($Qnodisponibles->get()); // total de panteones no disponibles

        $disponibles = $Qdisponibles->take(10)->get();
        $nodisponibles = $Qnodisponibles->take(10)->get();


        $tab = 1; // tab activa
        $search = 0; // busqueda inactica

        return view('panteones', compact('nodisponibles','disponibles','tab','search','td','tnd'));



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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        dd($id);
        return view('modificar-panteon');
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

    public function busqueda(Request $request){

        $titular = $request->input('titular');
        $calle = $request->input('calle');
        $numero = $request->input('numero');
        $activo = $request->input('activa'); // tab activa
        $dni = $request->input('dni');
        $search = 1; //busqueda activa


        if ($activo == 1) {


            $Qdisponibles = VPanteones::where(function ($Qdisponibles) {

               $Qdisponibles->whereNull('titular_id');

            })->where(function ($Qdisponibles) use ($calle, $numero) {

                if ($calle != '') $Qdisponibles->where('calle', 'like', "%$calle%");
                if ($numero != '') $Qdisponibles->where('numero', $numero);
            });


            $td = count($Qdisponibles->get()); //total con respecto a la busqueda

            $disponibles = $Qdisponibles->groupby('parcela_id')->take(10)->get();
            $tab = 1; //se debe activar el tab 1

            return view('panteones', compact('disponibles', 'td', 'tab', 'search', 'titular', 'calle', 'numero'));


        } else {


            $Qnodisponibles = VPanteones::where(function ($Qnodisponibles) {


                $Qnodisponibles->whereNotNull('titular_id');

            })->where(function ($Qnodisponibles) use ($titular, $calle, $numero,$dni) {

                if ($titular != '') $Qnodisponibles->where('nombre_titular', 'like', "%$titular%");
                if ($calle != '') $Qnodisponibles->where('calle', 'like', "%$calle%");
                if ($numero != '') $Qnodisponibles->where('numero', $numero);
                if ($dni != '') $Qnodisponibles->where('dni_titular', 'like', "%$dni%");

            });

            $tab = 2; // se debe activar el tab 2
            $tnd = count($Qnodisponibles->get());
            $nodisponibles = $Qnodisponibles->groupby('parcela_id')->take(10)->get();

            return view('panteones', compact('nodisponibles', 'tnd', 'tab', 'search', 'titular', 'calle', 'numero','dni'));

        }
    }


    public function paginateDisponibles(Request $request)
    {

        $disponibles = VPanteones::whereNull('titular_id')->skip(10 * ($request->input('page') - 1))->groupby('parcela_id')->take(10)->get();

        foreach ($disponibles as $disponible) {

            $ruta = route('modificar-panteones', [$disponible->parcela_id]);

            echo '<tr>';
            echo '<td> Calle: <span style = "font-weight: bold">' . $disponible->calle . ',</span >
                       Numero, <span style = "font-weight: bold" >' . $disponible->numero . '</span > </td >';

            echo "<td > <a href ='$ruta' ><i class='fa fa-lg fa-pencil-square-o' ></i> Editar parcela</a></td ></tr >";

        }
        //
    }

    public function paginateNoDisponibles(Request $request){

        $Nodisponibles = VPanteones::whereNotNull('titular_id')->skip(10 * ($request->input('page') - 1))->groupby('parcela_id')->take(10)->get();

        foreach ($Nodisponibles as $Nodisponible) {

            $ruta = route('modificar-panteones', [$Nodisponible->parcela_id]);
            $ruta2 = route('nichos-panteones',[$Nodisponible->parcela_id]);


            echo '<tr>';
            echo '<td>' . $Nodisponible->nombre_titular . '</td>';
            echo '<td>' . $Nodisponible->dni_titular . '</td>';
            echo '<td> Calle: <span style = "font-weight: bold">' . $Nodisponible->calle . ',</span >
                       Numero, <span style = "font-weight: bold" >' . $Nodisponible->numero . '</span > </td >';

            echo "<td> <a title='Modificar Parcela' href ='$ruta' ><i class='fa fa-lg fa-pencil-square-o'></i>  Modificar Parcela </a>";
            echo "<a title='Ver Nicho' href ='$ruta2'><i class='fa fa-lg fa-search'></i> Ver nichos</a>";
            echo "</td></tr>";

        }


    }

    public function paginateDisponiblesBusqueda(Request $request)
    {

        $calle = $request->input('calle');
        $numero = $request->input('numero');
        $page = $request->input('page');


        $Qdisponibles = VPanteones::where(function ($Qdisponibles) {

            $Qdisponibles->whereNull('titular_id');

        })->where(function ($Qdisponibles) use ($calle, $numero) {

            if ($calle != '') $Qdisponibles->where('calle', 'like', "%$calle%");
            if ($numero != '') $Qdisponibles->where('numero', $numero);
        });


        $disponibles = $Qdisponibles->skip(10 * ($page - 1))->groupby('parcela_id')->take(10)->get();

        foreach ($disponibles as $disponible) {

            $ruta = route('modificar-panteones', [$disponible->parcela_id]);

            echo '<tr>';

            echo '<td> Calle: <span style = "font-weight: bold">' . $disponible->calle . ',</span >
                       Numero, <span style = "font-weight: bold" >' . $disponible->numero . '</span > </td >';


            echo "<td > <a href ='$ruta' ><i class='fa fa-lg fa-pencil-square-o' ></i ></a ></td ></tr >";


        }
    }

    public function paginateNoDisponiblesBusqueda(Request $request){

        $titular = $request->input('titular');
        $calle = $request->input('calle');
        $numero = $request->input('numero');
        $dni = $request->input('dni');
        $page = $request->input('page');

        $Qnodisponibles = VPanteones::where(function ($Qnodisponibles) {

            $Qnodisponibles->whereNotNull('titular_id');


        })->where(function ($Qnodisponibles) use ($titular, $calle, $numero,$dni) {

            if ($titular != '') $Qnodisponibles->where('nombre_titular', 'like', "%$titular%");
            if ($calle != '') $Qnodisponibles->where('calle', 'like', "%$calle%");
            if ($numero != '') $Qnodisponibles->where('numero', $numero);
            if ($dni != '') $Qnodisponibles->where('dni_titular', 'like', "%$dni%");
        });

        $Nodisponibles = $Qnodisponibles->skip(10 * ($page - 1))->groupby('parcela_id')->take(10)->get();


        foreach ($Nodisponibles as $Nodisponible) {

            $ruta = route('modificar-panteones', [$Nodisponible->parcela_id]);
            $ruta2 = route('nichos-panteones',[$Nodisponible->parcela_id]);


            echo '<tr>';
            echo '<td>' . $Nodisponible->nombre_titular . '</td>';
            echo '<td>' . $Nodisponible->dni_titular . '</td>';
            echo '<td> Calle: <span style = "font-weight: bold">' . $Nodisponible->calle . ',</span >
                       Numero, <span style = "font-weight: bold" >' . $Nodisponible->numero . '</span > </td >';

            echo "<td> <a title='Modificar Parcela' href ='$ruta' ><i class='fa fa-lg fa-pencil-square-o'></i>  Modificar Parcela </a>";
            echo "<a title='Ver Nicho' href ='$ruta2'><i class='fa fa-lg fa-search'></i> Ver nichos</a>";
            echo "</td></tr>";

        }


    }

    public function nichosPanteones($id){


        $nichos = NichosPanteones::where('parcela_id',$id);
        $td = count($nichos->get());

        $disponibles = $nichos->take(10)->get();
        return view('nichospanteones',compact('disponibles','td','id'));
    }


    /**
     * @param Request $request
     */

    public function paginateNichosPanteones(Request $request){

        $id = $request->input('id');
        $disponibles = NichosPanteones::where('parcela_id',$id)->skip(10 * ($request->input('page') - 1))->take(10)->get();

        foreach ($disponibles as $disponible) {

            $ruta = route('ver-difuntos-nicho-panteon', [$disponible->nicho]);

            echo '<tr>';
            echo '<td> Altura, <span style = "font-weight: bold">' . $disponible->altura . ',</span >
                       Numero, <span style = "font-weight: bold" >' . $disponible->numero_nicho . '</span > </td >';

            echo "<td > <a href ='$ruta' ><i class='fa fa-lg fa-search' ></i > Ver difuntos</a> </td ></tr >";

        }
    }

    public function verDifuntosNicho($id){

        $disponibles = Difunto::where('GC_NICHOS_id',$id)->get();

        return view('difunto-nicho-panteon',compact('disponibles','id'));

    }
}
