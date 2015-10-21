<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 26/8/15
 * Time: 18:03
 */
namespace App\Http\Controllers;




use App\User;
use Illuminate\Http\Request;


class altaUsuarioController extends Controller
{

    public function __construct()
    {

    }

    public function index(){
        return view("nueva_alta");
    }

    public function create(Request $r){

        //Creamos un nuevo usuario
        $usuario = new User();
        $usuario->name = $r->input("nombre");
        $usuario->email = $r->input("email");
        $usuario->password = bcrypt($r->input("password"));
        $usuario->rol = $r->input("rol");


        if($r->input("pnichos") != null)
        {
            $usuario->nichos = 1;
        }

        if($r->input("ppanteones") != null)
        {
            $usuario->panteones = 1;
        }

        if($r->input("pcalles") != null)
        {
            $usuario->calle = 1;
        }

        if($r->input("pdifuntos") != null)
        {
            $usuario->difuntos = 1;
        }

        if($r->input("precibos") != null)
        {
            $usuario->recibos = 1;
        }

        if($r->input("pfacturas") != null)
        {
            $usuario->facturas = 1;
        }

        if($r->input("ptarifas") != null)
        {
            $usuario->tarifas = 1;
        }

        if($r->input("plibro") != null)
        {
            $usuario->libro_registros = 1;
        }

        if($r->input("pusuarios") != null)
        {
            $usuario->usuarios = 1;
        }

        $usuario->save();

    }

}