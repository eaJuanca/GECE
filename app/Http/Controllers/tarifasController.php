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
use App\model\Tcp_parcelas;
use App\model\Tcp_nichos;
use App\model\Tct_nichos;
use App\model\Tct_parcelas;
use Illuminate\Http\Request;


class tarifasController extends Controller{

    function index(){
       return view("tarifas");
    }
    /*
     * funcion para dar de alta la tarifa de cesion temporar de las parcelas o actualizarla
     */
    function cp_parcelas(Request $r){


        $countTarifa =  Tcp_parcelas::count();


        //Si ya esta la tarifa dada de alta la actualizamos.
        if($countTarifa == 1){

            $tarifa = Tcp_parcelas::firstOrFail();
            $tarifa->tarifa = $r->input("cp_parcela");
            $tarifa->save();

        }else{

            //sino la creamos
            $tarifa = new Tcp_parcelas();
            $tarifa->tarifa = $r->input("cp_parcela");
            $tarifa->save();
        }
    }

    /*
     * Funcion para obtener el valor de la tarifa de cesion temporal de las parcelas
     */
    function cpv_parcelas()
    {
        $tarifa = Tcp_parcelas::firstOrFail();
        return $tarifa->tarifa;
    }

    /*
    * funcion para dar de alta la tarifa de cesion perpetuidad de las parcelas o actualizarla
    */
    function cp_nichos(Request $r){

        $countTarifa =  Tcp_nichos::count();


        //Si ya esta la tarifa dada de alta la actualizamos.
        if($countTarifa == 1){

            $tarifa = Tcp_nichos::firstOrFail();
            $tarifa->tarifa = $r->input("cp_nicho");
            $tarifa->save();

        }else{

            //sino la creamos
            $tarifa = new Tcp_nichos();
            $tarifa->tarifa = $r->input("cp_nicho");
            $tarifa->save();
        }
    }

    /*
    * Funcion para obtener el valor de la tarifa de cesion temporal de los nichos
    */
    function cpv_nichos()
    {
        $tarifa = Tcp_nichos::firstOrFail();
        return $tarifa->tarifa;
    }

    /*
     * Funcion para dar de alta la tarifa cesion temporal de las parcelas
     */
    function ct_parcelas(Request $r)
    {
        $countTarifa =  Tct_parcelas::count();

        //Si ya esta la tarifa dada de alta la actualizamos.
        if($countTarifa == 1){

            $tarifa = Tct_parcelas::firstOrFail();
            $tarifa->tarifa = $r->input("ct_parcela");
            $tarifa->save();

        }else{

            //sino la creamos
            $tarifa = new Tct_parcelas();
            $tarifa->tarifa = $r->input("ct_parcela");
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

        //Si ya esta la tarifa dada de alta la actualizamos.
        if($countTarifa == 1){

            $tarifa = Tct_nichos::firstOrFail();
            $tarifa->tarifa = $r->input("ct_nicho");
            $tarifa->save();

        }else{

            //sino la creamos
            $tarifa = new Tct_nichos();
            $tarifa->tarifa = $r->input("ct_nicho");
            $tarifa->save();
        }
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
    * Función para dar de alta la tarifa cesion temporal de los nichos
    */
    function m_parcelas(Request $r)
    {
        $countTarifa =  Tm_parcelas::count();

        //Si ya esta la tarifa dada de alta la actualizamos.
        if($countTarifa == 1){

            $tarifa = Tm_parcelas::firstOrFail();
            $tarifa->tarifa = $r->input("m_parcela");
            $tarifa->save();

        }else{

            //sino la creamos
            $tarifa = new Tm_parcelas();
            $tarifa->tarifa = $r->input("m_parcela");
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

        //Si ya esta la tarifa dada de alta la actualizamos.
        if($countTarifa == 1){

            $tarifa = Tm_nichos::firstOrFail();
            $tarifa->tarifa = $r->input("m_nicho");
            $tarifa->save();

        }else{

            //sino la creamos
            $tarifa = new Tm_nichos();
            $tarifa->tarifa = $r->input("m_nicho");
            $tarifa->save();
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
}