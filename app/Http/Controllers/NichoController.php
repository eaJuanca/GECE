<?php

namespace App\Http\Controllers;

use App\model\InfoNicho;
use App\model\Nicho;
use Illuminate\Http\Request;
use App\Http\Requests;
use Mockery\Exception;

class NichoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $Qdisponibles = InfoNicho::where('nombre_titular', null)->orWhere('nombre_titular', '');
        $Qnodisponibles = InfoNicho::where('nombre_titular', 'not', null)->orWhere('nombre_titular', '!=', '');

        $disponibles = $Qdisponibles->take(10)->get();
        $nodisponibles = $Qnodisponibles->take(10)->get();

        $td = $Qdisponibles->count();
        $tnd = $Qnodisponibles->count();

        $tab = 1;


        return view('nichos', compact('disponibles', 'nodisponibles', 'td', 'tnd','tab'));

        //
    }

    public function indexModify($id) {

        $nicho = Nicho::find($id);
        $info = InfoNicho::find($id);
        return view('modificar-nicho', compact('id', 'nicho', 'info'));

    }

    public function paginateDisponibles(Request $request)
    {

        $disponibles = InfoNicho::where('nombre_titular', null)->orWhere('nombre_titular', '')->skip(10 * ($request->input('page') - 1))->take(10)->get();

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

    public function busquedaNicho(Request $request)
    {


        $titular = $request->input('titular');
        $difunto = $request->input('difunto');
        $calle = $request->input('nombrecalle');
        $numero = $request->input('numero');
        $activo = $request->input('activa');

        if ($activo == 1) {


            $Qdisponibles = InfoNicho::where(function ($Qdisponibles) {

                $Qdisponibles->where('nombre_titular', null);
                $Qdisponibles->orWhere('nombre_titular', '');

            })->where(function ($Qdisponibles) use ($titular, $calle, $numero) {

                if ($calle != '') $Qdisponibles->where('nombre_calle', 'like', "%$calle%");
                if ($numero != '') $Qdisponibles->where('numero', $numero);
            });

            $Qnodisponibles = InfoNicho::where('nombre_titular', 'not', null)->orWhere('nombre_titular', '!=', '');

            $tab = 1;

        } else {

            $Qdisponibles = InfoNicho::where('nombre_titular', null)->orWhere('nombre_titular', '');

            $Qnodisponibles = InfoNicho::where(function ($Qnodisponibles) {

                $Qnodisponibles->where('nombre_titular','not', null);
                $Qnodisponibles->orWhere('nombre_titular','!=', '');

            })->where(function ($Qnodisponibles) use ($titular, $calle, $numero) {

                if ($titular != '') $Qnodisponibles->where('nombre_titular', 'like', "%$titular%");
                if ($calle != '') $Qnodisponibles->where('nombre_calle', 'like', "%$calle%");
                if ($numero != '') $Qnodisponibles->where('numero', $numero);
            });

            $tab = 2;
        }

        $disponibles = $Qdisponibles->take(10)->get();
        $nodisponibles = $Qnodisponibles->take(10)->get();

        $td = $Qdisponibles->count();
        $tnd = $Qnodisponibles->count();



        return view('nichos', compact('disponibles', 'nodisponibles', 'td', 'tnd','tab'));


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
     * Show the form for editing the specified resource.
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

}
