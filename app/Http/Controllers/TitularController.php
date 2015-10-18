<?php

namespace App\Http\Controllers;

use App\model\Titular;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TitularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function edit($id)
    {
        //
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

    public function get(Request $request)
    {


            $id = $request->input("id");
            $titular = Titular::find($id);


            if ($titular== null) {
                return "error";
            } else {
                return json_encode($titular->attributesToArray());
            }

    }

    public function getForModal(Request $request)
    {

        $nombre = $request->input('nombrebuscar');
        $dni = $request->input('dnibuscar');
        $calle = $request->input('callebuscar');


        $titulares = Titular::where('nombre_titular', 'like', "%$nombre%");

        if ($dni != "") $titulares->where('dni_titular', 'like', "%$dni%");
        if ($calle != "") $titulares->where('dom_titular', 'like', "%$calle%");

        $titulares = $titulares->get();


        echo '<br>';

        if (count($titulares) <= 20 && count($titulares) > 0) {
            echo '<table class="table table-bordered table-hover"><tr>';
            echo '<thead>';
            echo '<th> Nombre';
            echo '</th>';
            echo '<th> Dni';
            echo '</th>';
            echo '<th> Domicilio';
            echo '</th>';
            echo '<th> Cargar';
            echo '</th>';
            echo '</thead></tr>';

            foreach ($titulares as $titular) {

                echo '<tr>';

                echo '<td> ' . $titular->nombre_titular . '</td>';
                echo '<td> ' . $titular->dni_titular . '</td>';
                echo '<td> ' . $titular->dom_titular . '</td>';
                echo '<td> <button type="button" onclick="cargartitularbusqueda(' . $titular->id . ')" class="btn btn-warning btn-xs">Cargar</button></td>';
                echo '</tr>';
            }

            echo '<tbody>';
            echo '</tbody>';
            echo '</table>';

        }else if (count($titulares) == 0){

            echo '<h2>No existen coincidencias para esos parametros de busqueda</h2>';

        }else{
            echo '<h2>Demasiados resultados de busqueda, afine mejor</h2>';

        }
    }

}
