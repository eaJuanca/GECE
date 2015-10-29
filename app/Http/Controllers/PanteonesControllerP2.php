<?php

namespace App\Http\Controllers;

use App\model\Parcela;
use App\model\VPanteones;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\Titular;

class PanteonesControllerP2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function indexModify($id){
        //obtenemos que no tienen titular primero
        //$parcela = VPanteones::where('parcela_id' ,'=',$id)
        // ->where('titular_id', '=', null)->get();

        $parcela = Parcela::find($id);
        //obtenemos informacion de la vista creada para panteones o parcelas
        $infoParcela = VPanteones::where('parcela_id', '=', $parcela->id )->get()[0];
        //obtenemos los datos del titular
        $titular = Titular::findOrNew($parcela->GC_TITULAR_id);

        return view('modificar-panteon', compact('parcela','titular','infoParcela'));
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
    public function edit(Request $request)
    {
        $idtitular = $request->input('idtitular'); //id titular


        if($idtitular == ''){

            $titular = new Titular($request->only('nombre_titular','responsable','dom_titular','cp_titular','pob_titular','exp_titular','dni_titular','tel_titular','ema_titular'));
            $idtitular = $titular->insertGetId($titular->attributesToArray());

        }
        else{

            $titularA = new Titular($request->only('nombre_titular','responsable','dom_titular','cp_titular','pob_titular','exp_titular','dni_titular','tel_titular','ema_titular'));
            $titular = Titular::find($idtitular);
            $titular->update($titularA->attributesToArray());
            $idtitular = $request->input('idtitular'); //id titular

        }

        $parcelaU = new parcela($request->except('nombre_titular','responsable','dom_titular','cp_titular','pob_titular','exp_titular','dni_titular','tel_titular','ema_titular'));
        $parcela = Parcela::find($request->input('idparcela'));
        $parcelaU->GC_TITULAR_id = $idtitular;
        $parcela->update($parcelaU->attributesToArray());
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
}
