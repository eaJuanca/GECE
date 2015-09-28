<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 26/8/15
 * Time: 18:03
 */
namespace App\Http\Controllers;


use App\model\Calle;
use App\model\Nicho;
use App\model\Tramada;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpSpec\CodeGenerator\TemplateRenderer;
use Prophecy\Call\Call;


class callesController extends Controller {


    private $calles = null;

    public function __construct()
    {
        $this->calles = Calle::all();
        View::share('calles',$this->calles);
    }

    public function index(){

        return view('calles');

    }

    function create(Request $r)
    {
        $tramadas = intval($r->input("num_tramadas"));


        if($tramadas > 0)
        {
            //Insertar tramadas y calle

            //creamos el objeto calle pero no con all porque tiene otros campos que son de tramda
            $calle = new Calle();

            $calle->nombre = $r->input("nombre");
            $calle->num_tramadas = $tramadas;
            $calle->tipo_calle = $r->input("tipo_calle");
            $calle->save();

            //Acto seguido guardamos las tramadas con el nº de nichos.
            $totalNichos = 0;

            for($i = 1; $i <= $tramadas; $i++) {

                //Creamos un objeto tramada
                $tramada = new Tramada();

                //obtemos los parámetros del objeto request
                $numNichos = $r->input("tramada".$i);

                //Asignamos las propiedades del objeto
                $tramada->tramada = $i;
                $tramada->nichos = $numNichos;
                $tramada->GC_CALLE_id = $calle->id;
                $totalNichos += $numNichos;
                $tramada->save();

                //Guardamos los x nichos de la tramada $i
                $this->guardarNichos($numNichos,$tramada->id);

            }


            //Una vez sumado el total de los nichos actualizamos la calle insertada
            $updateCalle = Calle::find($calle->id);
            $updateCalle->total = $totalNichos;
            $updateCalle->save();

        }else{

            //guardamos sólo la parte de la calle
            $calle = new Calle($r->all());
            $calle->save();
        }
    }

    /**
     * Esta funcion guarda de manera correlativa una serie de nichos.
     * @param int $numNichosTramada es el número de nichos que hay en cada tramada.
     * @param int $idTramada es el id de la tramada en la que se ubican los nichos
     */

    function guardarNichos($numNichosTramada,$idTramada){

        for($i = 1; $i <= $numNichosTramada; $i++){

            //Creamos el objeto nicho.
            $nicho = new Nicho();

            $nicho->GC_Tramada_id = $idTramada;
            $nicho->numero = $i;
            $nicho->save();

        }

    }
}

