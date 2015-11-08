<?php

namespace App\Http\Controllers;

use App\model\Factura;
use App\model\Iva2;
use App\model\LineaFactura;
use App\model\TarifaServicios;
use App\model\VLinea;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LineaController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $lineas = $request->input('lineas');
        $factura = $request->input('factura');


        if($lineas != null) {

            foreach ($lineas as $linea) {

                if($linea[0]==""){

                    $tarifa = new TarifaServicios();
                    $tarifa->concepto = $linea[2];
                    $tarifa->importe = $linea[4];
                    $tarifa->codigo = $linea[1];
                    $tarifa->tipo = 1;

                    $tarifa->save(); // id

                    $l = new LineaFactura();
                    $l->GC_Tarifa_servicios_id = $tarifa->id;
                    $l->GC_Factura_id = $factura;
                    $l->cantidad = $linea[3];
                    $l->save();


                }else{

                    $l = new LineaFactura();
                    $l->GC_Tarifa_servicios_id = $linea[0];
                    $l->GC_Factura_id = $factura;
                    $l->cantidad = $linea[3];
                    $l->save();

                }

                $fac = Factura::find($factura);
                $fac->pendiente = 0;
                $fac->save();
            }

            $iva = Iva2::first();
            $iva = $iva->tipo;

            $aux = VLinea::select(\DB::raw('sum(importe * cantidad) as total'))->where('factura',$factura)->get()[0];
            dd($aux);
            $factura = Factura::find($factura);
            $factura->update(['base' => $total]);
            $factura->update(['iva' => $total*($iva/100)]);
            $factura->update(['total' => $total + ($total*($iva/100))]);
        }

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
        //
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
