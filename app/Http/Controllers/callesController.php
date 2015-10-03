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
use App\model\Panteon;
use App\model\Parcela;
use App\model\Tramada;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;



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

    /**
     * Función para dar de alta las calles o panteones
     * @param Request $r la peticion enviada del form
     */
    function create(Request $r)
    {
        $tramadas = intval($r->input("num_tramadas"));
        //creamos el objeto calle pero no con all porque tiene otros campos que son de tramda
        $calle = new Calle();

        if($r->input("tipo_calle") == 1){

            //Si tipo calle es 1 guardamos la calle

            if($tramadas > 0)
            {
                //Insertar tramadas y calle

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
        }else{
            //Sino guardamos un panteon

            $panteon = new Panteon();

            $panteon->numero = ($r->input('numero'));

            if($r->input('iexistente') != -1){
                //Si se ha seleccionado una calle existente entramos aquí.
                $panteon->GC_CALLE_id = $r->input('iexistente');
                $panteon->save();

                //Insertamos parcelas
                $this->guardarParcelas($r->input("num_parcelas"),$panteon->id,$r);

            }else{
                //Si se ha creado el panteon en una nueva calle

                //damos de alta la nueva calle
                $calle->nombre = $r->input("nombre");
                $calle->num_tramadas = 0;//de momento a 0
                $calle->tipo_calle = $r->input("tipo_calle");
                $calle->save();

                //cogemos el id de la calle que se acaba de insertar
                $panteon->GC_CALLE_id = $calle->id;
                $panteon->save();

                //Insertamos parcelas
                $this->guardarParcelas($r->input("num_parcelas"),$panteon->id,$r);
            }


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

    function guardarParcelas($numeroParcelas,$idPanteon,$r){

        for($i = 1; $i <= $numeroParcelas; $i++){

            //Creamos el objeto nicho.
            $parcela = new Parcela();

            $parcela->tamanyo = $r->input("parcela". $i);
            $parcela->GC_PANTEON_id = $idPanteon;
            $parcela->save();

            //asignamos las tramadas para cada parcela

            for($j = 1; $j <= $r->input("tram_parc_".$i); $j++)
            {

                //Creamos un objeto tramada
                $tramada = new Tramada();

                //obtemos los parámetros del objeto request
                $numNichos = $r->input("tramada". $j . "_p" . $i);

                //Asignamos las propiedades del objeto
                $tramada->tramada = $i;
                $tramada->nichos = $numNichos;
                $tramada->GC_PARCELA_id = $parcela->id;
                $tramada->save();

                //Guardamos los x nichos de la tramada $i
                $this->guardarNichos($numNichos,$tramada->id);

            }

        }
    }

}

