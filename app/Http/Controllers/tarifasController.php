<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 26/8/15
 * Time: 18:03
 */
namespace App\Http\Controllers;


use App\model\Tm_nichos;
use App\model\Tm_parcelas;
use App\model\Tcp_parcelas2;
use App\model\Tcp_nichos;
use App\model\Tct_nichos;
use App\model\Tct_parcelas;
use App\model\Iva2 as Iva;
use App\model\TarifaServicios;
use Illuminate\Http\Request;


class tarifasController extends Controller{

    public function __construct()
    {

    }

    function index(){

        $Tcp_parcelas = Tcp_parcelas2::first();
        $Tcp_nichos = Tcp_nichos::all();
        $Tct_nichos = Tct_nichos::first();
        $Tm_parcelas = Tm_parcelas::all();
        $Tm_nichos = Tm_nichos::first();
        $iva = Iva::first();


        $servicios = TarifaServicios::where('tipo',0)->get();


        return view("tarifas", compact("Tcp_parcelas","Tcp_nichos","Tct_parcelas","Tct_nichos","Tm_parcelas","Tm_nichos","iva","servicios"));
    }
    /*
     * funcion para dar de alta la tarifa de cesion temporar de las parcelas o actualizarla
     */
    function cp_parcelas(Request $r){

        //Si ya esta la tarifa dada de alta la actualizamos.
        $tarifa = Tcp_parcelas2::firstOrFail();
        $tarifa->tarifa = $r->input("cp_parcela");
        $tarifa->codigo = $r->input("cp_parcela_cod");
        $tarifa->save();

    }

    /*
    * funcion para dar de alta la tarifa de cesion perpetuidad de las parcelas o actualizarla
    */
    function cp_nichos(Request $r){

        $countTarifa =  Tcp_nichos::count();
        //Actualizamos las tarifas porque ya están creadas en la bd desde el principo
        for ($i = 0 ; $i < $countTarifa; $i++) {
            $tarifa = Tcp_nichos::find($i+1);
            $tarifa->tarifa = $r->input("cp_nicho" . $i);
            $tarifa->codigo = $r->input("cp_nicho" . $i . "_cod");
            $tarifa->save();
        }
    }
    /*
    * Funcion para obtener el valor de la tarifa de cesion temporal de las parcelas
    */
    function ctv_parcelas()
    {
        $tarifa = Tct_parcelas::firstOrFail();
        return $tarifa->tarifa;
    }

    /*
     * Función para dar de alta la tarifa cesion temporal de los nichos
     */
    function ct_nichos(Request $r)
    {
        $countTarifa =  Tct_nichos::count();

        //ya esta la tarifa dada de alta la actualizamos.

        $tarifa = Tct_nichos::firstOrFail();
        $tarifa->tarifa = $r->input("ct_nicho");
        $tarifa->codigo = $r->input("ct_nicho_cod");
        $tarifa->save();

    }

    /*
    * Función para obtener el valor de la tarifa de cesion temporal de los nichos
    */
    function ctv_nichos()
    {
        $tarifa = Tct_nichos::firstOrFail();
        return $tarifa->tarifa;
    }


    /*
    * Función para dar de alta las tarifa de mantenimiento de las parcelas
    * hay dos tipos la del cod 1 que es por metro cuadrado (parcela sin nichos)
    * cod 2 que es por nº de nichos
    */
    function m_parcelas(Request $r)
    {
        $countTarifa =  Tm_parcelas::count();

        for($i = 0; $i < $countTarifa; $i++)
        {
            $tarifa = Tm_parcelas::find($i+1);
            $tarifa->tarifa = $r->input("m_parcela". $i);
            $tarifa->codigo = $r->input("m_parcela". $i . "_cod");
            $tarifa->save();
        }
    }

    /*
    * Función para obtener el valor de la tarifa de cesion temporal de los nichos
    */
    function mv_parcelas()
    {
        $tarifa = Tm_parcelas::firstOrFail();
        return $tarifa->tarifa;
    }


    /*
    * Función para dar de alta la tarifa cesion temporal de los nichos
    */
    function m_nichos(Request $r)
    {
        $countTarifa =  Tm_nichos::count();

        //ya esta la tarifa dada de alta la actualizamos.

        $tarifa = Tm_nichos::firstOrFail();
        $tarifa->tarifa = $r->input("m_nicho");
        $tarifa->codigo = $r->input("m_nicho_cod");
        $tarifa->save();
    }


    function m_iva(Request $r)
    {
        $countIva =  Iva::count();

        //Si ya esta la tarifa dada de alta la actualizamos.
        if($countIva == 1){

            $iva = Iva::firstOrFail();
            $iva->tipo = $r->input("iva");
            $iva->save();

        }else{

            //sino la creamos
            $iva = new Iva();
            $iva->tipo = $r->input("iva");
            $iva->save();
        }
    }

    /*
    * Función para obtener el valor de la tarifa de cesion temporal de los nichos
    */
    function mv_nichos()
    {
        $tarifa = Tm_nichos::firstOrFail();
        return $tarifa->tarifa;
    }

    function nuevoservicio(Request $r)
    {
        $servicio = new TarifaServicios();
        $servicio->concepto = $r->input('concepto');
        $servicio->codigo = $r->input('codigo');
        $servicio->importe = $r->input('importe');
        $servicio->tipo = 0; //TARIFA PREDEFINIDA - LAS QUE CREAS TU PA SIEMPRE

        $servicio->save();

        echo $servicio->id;
    }

    public function delete(Request $r){

        $id = $r->input('id');
        $servicio = TarifaServicios::find($id);
        $servicio->tipo = 1;
        $servicio->save();
    }

}