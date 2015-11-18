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
use App\model\Titular;
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
        $numTramadas = intval($r->input("num_tramadas"));
        //creamos el objeto calle pero no con all porque tiene otros campos que son de tramda
        $calle = new Calle();

        if($r->input("tipo_calle") == 1){

            //Si tipo calle es 1 guardamos la calle

            if($numTramadas > 0)
            {
                //Insertar tramadas y calle

                $calle->nombre = $r->input("nombre");
                $calle->num_tramadas = $numTramadas;
                $calle->tipo_calle = $r->input("tipo_calle");
                $calle->save();

                //Acto seguido guardamos las tramadas con el nº de nichos.
                $totalNichos = 0;

                for($i = 1; $i <= $numTramadas; $i++) {

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
                    $this->guardarNichos($numTramadas * $numNichos,$tramada->id,$i,$numTramadas,1);

                }


                //Una vez sumado el total de los nichos actualizamos la calle insertada
                $updateCalle = Calle::find($calle->id);
                $updateCalle->total = $totalNichos;
                $updateCalle->save();

            }
        }else{
            //Sino guardamos las parcelas/panteones

            $panteon = new Panteon();

            if($r->input('iexistente') != ""){
                //Si se ha seleccionado una calle existente entramos aquí.
                /*$parcela = new Parcela(); //creamos 1 objeto parcela porque sólo vamos a dar de alta 1
                $parcela->GC_CALLE_id = $r->input('iexistente');
                $parcela->save();*/

                //Obtenemos el id de la calle existente
                $updateCalle = Calle::find($r->input('iexistente'));
                $updateCalle->num_panteones = (int) Calle::where('id' , '=' , $r->input('iexistente'))->get(array("num_panteones"))[0]->num_panteones + 1;
                $updateCalle->save();

                //Insertamos la parcela
                $this->guardarParcelaIndividual($updateCalle->id,$r);

            }else{
                //Si se ha creado una calle de panteones.

                //damos de alta la nueva calle
                $calle->nombre = $r->input("nombre");
                $calle->num_tramadas = 0;//de momento a 0
                $calle->tipo_calle = $r->input("tipo_calle");
                $calle->save();

                //Insertamos las parcelas en la nueva calle
                $this->guardarParcelas($r->input("num_parcelas"),$calle->id,$r);

                //Aumentamos el numero de parcelas
                $updateCalle = Calle::find($calle->id);
                $updateCalle->num_panteones = (int) $r->input('num_parcelas');
                $updateCalle->save();

            }

        }

    }

    /**
     * Esta funcion guarda de manera correlativa una serie de nichos.
     * @param int $numNichosTramada es el número de nichos que hay en cada tramada.
     * @param int $idTramada es el id de la tramada en la que se ubican los nichos
     */

    function guardarNichos($numNichosTramada,$idTramada,$inicio,$incremento,$tipo){


        for($i = $inicio; $i <= $numNichosTramada;  $i+=$incremento){
            //Creamos el objeto nicho.
            $nicho = new Nicho();
            $nicho->GC_Tramada_id = $idTramada;
            $nicho->numero = $i;
            $nicho->tipo = $tipo;
            $nicho->save();

        }
    }

    function guardarParcelaIndividual($idCalle,$r){

            //Creamos el objeto parcela.
            $parcela = new Parcela();

            //Asignamos los atributos a la parcela/panteon
            $parcela->numero = $r->input("numero");
            $parcela->tamanyo = $r->input("tam_ind");
            $parcela->GC_CALLE_id = $idCalle;
            $parcela->save();

            //Comprobamos si hemos insertado tramadas en la parcela individual
             $tramadasParcela = $r->input("tramadas_parcela");

            if($tramadasParcela > 0){

                //asignamos las tramadas a la parcela
                for($i = 1; $i <= $tramadasParcela  ; $i++)
                {
                    //Creamos un objeto tramada
                    $tramada = new Tramada();

                    //obtemos los parámetros del objeto request
                    $numNichos = $r->input("tramada". $i ."_ind");

                    //Asignamos las propiedades del objeto
                    $tramada->tramada = $i;
                    $tramada->nichos = $numNichos;
                    $tramada->GC_PARCELA_id = $parcela->id;
                    $tramada->save();

                    //Guardamos los x nichos de la tramada $i
                    $this->guardarNichos($tramadasParcela * $numNichos,$tramada->id,$i,$tramadasParcela,2);
                }
            }
    }

    function guardarParcelas($numeroParcelas,$idCalle,$r){


        for($i = 1; $i <= $numeroParcelas; $i++){

            //Creamos el objeto parcela.
            $parcela = new Parcela();

            //Asignamos los atributos a la parcela/panteon
            $parcela->numero = $i;
            $parcela->tamanyo = $r->input("parcela". $i);
            $parcela->GC_CALLE_id = $idCalle;
            $parcela->save();

            //Comprobamos si se han creado tramadas para cada parcela
            $tramadasParcela = $r->input("tram_parc_" . $i);

            if($tramadasParcela > 0) {

                //asignamos las tramadas para cada parcela
                for ($j = 1; $j <= $tramadasParcela; $j++) {

                    //Creamos un objeto tramada
                    $tramada = new Tramada();

                    //obtemos los parámetros del objeto request
                    $numNichos = $r->input("tramada" . $j . "_p" . $i);

                    //Asignamos las propiedades del objeto
                    $tramada->tramada = $j;
                    $tramada->nichos = $numNichos;
                    $tramada->GC_PARCELA_id = $parcela->id;
                    $tramada->save();

                    //Guardamos los x nichos de la tramada $i
                    $this->guardarNichos($tramadasParcela * $numNichos, $tramada->id, $j, $tramadasParcela,2);

                }
            }
        }
    }

    /**
     * @param Request $r funcion para borrar una calle normal o de panteones
     */
    function delete(Request $r){

        //1º saber ver que tipo de calle es si es panteon o calle normal

        if($r->input('tipo') == 1){
            //es calle normal

            //2º obtenemos  tramadas de esta calle.

            $Tramdas = Tramada::where('GC_CALLE_id', '=', $r->input('id'))->get();

            foreach($Tramdas as $id){

            //3º borramos los nichos que están en esa tramada.
                Nicho::where('GC_Tramada_id' , '=' , $id->id)->delete();
            }
            //4º borramos las tramadas

            Tramada::where('GC_CALLE_id', '=', $r->input('id'))->delete();

            //5º borramos la calle

            Calle::find($r->input('id'))->delete();

        }else{
            //es panteon

            //2º Obtenemos los parcelas/panteones que hay en la calle

            $parcelas = parcela::where('GC_CALLE_id' , '=' , $r->input('id'))->get();

            foreach ($parcelas as $parcela){

                //3º obtenemos las tramadas de cada parcela

                $tramadas = Tramada::where('GC_PARCELA_id', '=' , $parcela->id)->get();

                foreach($tramadas as $tramada){

                    //4º borramos los nichos
                    Nicho::where('GC_Tramada_id' , '=' , $tramada->id)->delete();

                    //5º borramos la tramada
                       Tramada::find($tramada->id)->delete();

                }

                //6º borramos las parcelas
                Parcela::find($parcela->id)->delete();
            }

            //7º borramos la calle
            Calle::find($r->input('id'))->delete();
        }
    }

    /**
     * Función que devuelve una vistra u otra con los parametros necesarios para modificar o calle
     * o panteones
     * @param $idCalle es el id de la calle a editar
     * @return View es la vista a devolver.
     */
    function editarView($idCalle){

        $calle = Calle::find($idCalle);


        if($calle->tipo_calle == 1)
        {
            //Obtenemos las tramadas de la calle
            $tramadas = Tramada::where('GC_CALLE_id' , "=", $idCalle)->get();

            return view('modificar_calle_nichos',compact('calle','tramadas'));

        }else{

            //Obtenemos las parcelas de la calle panteon.
            $parcelas = Parcela::where('GC_CALLE_id' , "=", $idCalle)->get();

            //Obtenemos las tramadas de cada parcela para pasarlas a la vista.
            $tramadas = array();
            $titulares = array();

            foreach($parcelas as $parcela){

                $tramada = Tramada::where('GC_PARCELA_id', '=' , $parcela->id)->get();

                if($parcela->GC_TITULAR_id != null) {
                    $titular = Titular::where('id', '=', $parcela->GC_TITULAR_id)->get(['nombre_titular', 'dni_titular']);
                    $elemento1 = array($parcela->id, $titular[0]);
                    array_push($titulares, $elemento1);
                }

                $elemento = array($parcela->id, $tramada);

                array_push($tramadas,$elemento);
            }

            return view('modificar_calle_panteon',compact('calle','parcelas','tramadas','titulares'));
        }

    }

    /**
     * Función para modificar las calles tanto en nº de tramadas como de nichos.
     * @param Request $r es la petición ajax con los valores a cambiar en la calle.
     */
    function edit(Request $r){

        //Obtenemos el id de la calle a editar y le cambiamos el nombre
        $calle = Calle::find($r->input('idCalle'));
        $calle->nombre = $r->input('nombre');
        $calle->save();

        $updateCalle = Calle::find($calle->id);

        //obtemos el número de tramadas
        $numTramadas = $r->input('tramadas');

        //obtemos el número de nichos para la primera tramada porque las demas deben ser igual
        $numNichos = $r->input("tramada1");

        //Obtenemos las tramadas que tiene esa calle para ver si son las mismas o se añadido otra.
        $countTramadas = Tramada::where('GC_CALLE_id' , '=',$r->input('idCalle'))->get();

        //Obtenemos el numero de nichos que hay en tramada 1 de esta calle en concreto para saber si
        //se pretede añadir más, pero primero debemos ver si tienen alguna tramada antes
        if(!$countTramadas->isEmpty()){
            $countNichos = Nicho::where("GC_Tramada_id", '=', $countTramadas[0]->id)->count();
        }

        //Si no se han añadido tramadas sólamente comprobamos si se han añadido nichos o las dos.
        if($numTramadas == count($countTramadas)){

            $this->aumentarNichos($r,$calle->id,$updateCalle);
        }

        //Si se han añadido tramadas y nichos
        elseif( (count($countTramadas) < $numTramadas) && ($countNichos < $numNichos)){

            $this->aumentarTramadas($r,$numTramadas,$updateCalle,$countNichos);

            $this->aumentarNichos($r,$calle->id,$updateCalle);

        }
        else {

            $this->aumentarTramadas($r,$numTramadas,$updateCalle,$numNichos);
        }
    }

    function aumentarNichos($r,$id,$updateCalle){

        $countTramadas = Tramada::where('GC_CALLE_id' , '=',$r->input('idCalle'))->get();

        //Obtenemos la última tramada de esta calle para averiguar luego el id del ultimo nicho
        $ultimaTramada = $countTramadas[count($countTramadas) - 1];


        //Cogemos el último nicho insertado en la última tramada de esta calle para saber por dónde empezar a incrementar de nuevo.
        $ultimoNicho = Nicho::where("GC_Tramada_id", '=', $ultimaTramada->id)
                ->orderBy('id','desc')->first()->numero +1;

        $totalNichos = 0;

        for ($i = 1; $i <= count($countTramadas); $i++) {

            //Obtenemos tramada existente
            $tramada = Tramada::where('GC_CALLE_id', '=', $r->input('idCalle'))
                                ->where('tramada', '=', $r->input('tra') . $i)->get();

            $tramada = $tramada[0];

            //obtemos el número de nichos de cada tramada
            $numNichos = $r->input("tramada" . $i);

            //Actualizamos las propiedades del objeto tramada
            $tramada->nichos = $numNichos;
            $tramada->GC_CALLE_id = $id;
            $tramada->save();

            //Para actualizar luego el atributo total nicho del objeto calle
            $totalNichos += $numNichos;

            $this->guardarNichos(count($countTramadas) * $numNichos, $tramada->id, (int) $ultimoNicho,count($countTramadas),1);
            $ultimoNicho++;
        }


        //Una vez sumado el total de los nichos actualizamos la calle insertada
        $updateCalle->total = $totalNichos;
        $updateCalle->save();
    }

    function aumentarTramadas($r,$numTramadas,$updateCalle,$numNichos){

        $totalNichos = 0;

        for($i = 1; $i <= $numTramadas; $i++) {

            //Creamos un objeto tramada y comprobamos si existe esa tramada o tenemos que crearla
            $tramada = Tramada::where('GC_CALLE_id' , '=',$r->input('idCalle'))
                                ->where('tramada' , '=', $r->input('tra') . $i)->get();

            if($tramada->isEmpty()) {

                $tramada = new Tramada();
                $tramada->tramada = $i;
                $updateCalle->num_tramadas += 1;

            }else{
                $tramada = $tramada[0];
            }


            //Asignamos las propiedades del objeto
            $tramada->nichos = $numNichos;
            $tramada->GC_CALLE_id = $r->input('idCalle');
            $totalNichos += $numNichos;
            $tramada->save();

            $this->updateNichos($numTramadas * $numNichos,$tramada->id, $i ,$numTramadas,1);
        }


        //Una vez sumado el total de los nichos actualizamos la calle insertada
        $updateCalle->total = $totalNichos;
        $updateCalle->save();

    }

    function updateNichos($numNichosTramada,$idTramada,$inicio,$incremento,$tipo){

        $nichos = Nicho::where("GC_Tramada_id" , "=", $idTramada)->get();
        $posicion = 0;

        for($i = $inicio; $i <= $numNichosTramada;  $i+=$incremento) {

            if(!$nichos->isEmpty()) {
                //Hacemos update de los ids de la cada tramada.
                if ($nichos[$posicion] != null) {

                    $updateNicho = Nicho::where("id", "=", $nichos[$posicion]->id)->get();
                    $updateNicho[0]->numero = $i;
                    $updateNicho[0]->save();

                } else {

                    //Creamos el objeto nicho.
                    $nicho = new Nicho();
                    $nicho->GC_Tramada_id = $idTramada;
                    $nicho->numero = $i;
                    $nicho->tipo = $tipo;
                    $nicho->save();
                }
            }else{

                //Creamos el objeto nicho.
                $nicho = new Nicho();
                $nicho->GC_Tramada_id = $idTramada;
                $nicho->numero = $i;
                $nicho->tipo = $tipo;
                $nicho->save();
            }
            $posicion++;
        }
    }

    /**
     * función para editar las parcelas.
     * @param Request $r es la petición ajax con los datos del form
     */
    function editarParcelas(Request $r){

        //Obtenemos la parcela a actualizar
        $parcela = Parcela::find($r->input('idParcela'));
        //y actualizamos sus valores de numero y tamaño
        $parcela->numero = $r->input("numero");
        $parcela->tamanyo = $r->input("tamanyo");
        //Actualizamos la parcela en la BD
        $parcela->save();
        //Obtenemos el valor del input.
        $numTramadas = $r->input("tramadas");

        //Obtenemos las tramadas que tiene esa parcela para ver si son las mismas o se han añadido más.
        $countTramadas = Tramada::where('GC_PARCELA_id' , '=',$r->input('idParcela'))->get();

        //obtemos el número de nichos para la primera tramada por ejemplo porque las demas deben ser igual
        $numNichos = $r->input("tramada1_p".$r->input("idParcela"));

        //Obtenemos el numero de nichos que hay en tramada 1 de esta calle en concreto para saber si
        //se pretede añadir más

        if(!$countTramadas->isEmpty()){
            $countNichos = Nicho::where("GC_Tramada_id", '=', $countTramadas[0]->id)->count();
        }else{
            $countNichos = 0;
        }

        //Ahora actualizamos el número de tramadas y nichos.
        if($numTramadas == count($countTramadas)){

            $this->aumentarNichosParcela($r,$numNichos);
        }

        //Si se han añadido tramadas y nichos
        elseif( (count($countTramadas) < $numTramadas) && ($countNichos < $numNichos)){

            $this->aumentarTramadasPacela($r,$numTramadas,$countNichos);
            $this->aumentarNichosParcela($r,$numNichos);

        }
        else {
            $this->aumentarTramadasPacela($r,$numTramadas,$numNichos);
        }

    }

    function aumentarNichosParcela($r,$numNichos){

        $countTramadas = Tramada::where('GC_PARCELA_id' , '=',$r->input('idParcela'))->get();

        //Obtenemos la última tramada de esta calle para averiguar luego el id del ultimo nicho
        $ultimaTramada = $countTramadas[count($countTramadas) - 1];

        if($ultimaTramada != null){

            //Cogemos el último nicho insertado en la última tramada de esta parcela para saber por dónde empezar a
            // incrementar de nuevo en caso de que tenga alguna tramada la parcela.
            $ultimoNicho = Nicho::where("GC_Tramada_id", '=', $ultimaTramada->id)
                            ->orderBy('id','desc')->first();

            //Si $ultimoNicho es distinto de null cogemos su id
            if($ultimoNicho != null){
                $ultimoNicho = $ultimoNicho->numero +1;
            }else{
                $ultimoNicho = 1;
            }

        }
        else{
            $ultimoNicho = 1;
        }

        for ($i = 1; $i <= count($countTramadas); $i++) {

            //Obtenemos tramada existente
            $tramada = Tramada::where('GC_PARCELA_id', '=', $r->input('idParcela'))
                                ->where('tramada', '=', $r->input('tra') . $i)->get();

            $tramada = $tramada[0];

            //Actualizamos las propiedades del objeto tramada
            $tramada->nichos = $numNichos;
            $tramada->GC_PARCELA_id = $r->input('idParcela');
            $tramada->save();

            $this->guardarNichos(count($countTramadas) * $numNichos, $tramada->id, (int) $ultimoNicho,count($countTramadas),2);
            $ultimoNicho++;
        }

    }

    /**
     * Función para aumentar las tramadas de las parcelas a la hora de eidarlas
     * @param $r es la peticion ajax
     * @param $numTramadas es el nº de tramadas que va a alcanzar la parcela
     * @param $numNichos es el nº de nichos que va a alcanzar la tramada.
     */
    function aumentarTramadasPacela($r,$numTramadas,$numNichos){


        for($i = 1; $i <= $numTramadas; $i++) {

            //Creamos un objeto tramada y comprobamos si existe esa tramada o tenemos que crearla
            $tramada = Tramada::where('GC_PARCELA_id' , '=',$r->input('idParcela'))
                    ->where('tramada' , '=', $r->input('tra') . $i)->get();



            if($tramada->isEmpty()) {

                $tramada = new Tramada();
                $tramada->tramada = $i;

            }else{
                $tramada = $tramada[0];
            }


            //Asignamos las propiedades del objeto
            $tramada->nichos = $numNichos;
            $tramada->GC_PARCELA_id = $r->input('idParcela');
            $tramada->save();

            $this->updateNichos($numTramadas * $numNichos,$tramada->id, $i ,$numTramadas,2);
        }
    }

    /**
     * Devuelve un entero con el último numero de panteones insertado para una calle de panteones
     */
    function  ultimoPanteon(Request $r){
        $calle = Calle::find($r->input("id"));
        return $calle->num_panteones;
    }

    /**
     * Función para cambiar el nombre a la calle de los panteones
     * @param Request $r es la peticion ajax con los valores.
     */
    function editarNombre(Request $r){
        $calle = Calle::find($r->input("idCalle"));
        $calle->nombre = $r->input("nombre");
        $calle->save();
    }
}

