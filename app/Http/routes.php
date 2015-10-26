<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::group(['prefix' => '/'], function()
{

    Route::get('/', ['uses' => 'WebController@home']);

    Route::get('home', ['as' => 'home', 'uses' => 'WebController@home']);

    Route::get('calles', ['as' => 'calles', 'uses' => 'callesController@index']);

    Route::get('difunto', ['as' => 'difunto', 'uses' => 'WebController@DifuntoIndex']);
    Route::post('difuntosJSON', ['as' => 'difuntosJSON', 'uses' => 'WebController@DifuntosJSON']);


    Route::get('alta-difunto', ['as' => 'alta-difunto', function()
    {
        return view('alta_difunto');
    }]);

    //A�adir un difunto desde la vista nicho
    Route::get('alta-difunto-{nichoid}', ['as' => 'alta-difunto-nicho', 'uses' => 'DifuntoController@DifuntoNicho']);

    Route::get('nichos', ['as' => 'nichos','uses' => 'NichoController@index']);


    Route::get('modificar-nicho-{id}', ['as' => 'modificar-nichos', function($id){
        $controller = App::make(\App\Http\Controllers\NichoController::class);
        return $controller->callAction('indexModify', array('tipo' => $id));
    }]);


});

//Gestión Calles
Route::get('altaCalle',  ['as' => 'altaCalle', 'uses' => 'callesController@create']);

Route::post('borrarCalle',  ['as' => 'borrarCalle', 'uses' => 'callesController@delete']);

Route::get('ultimoPanteon', ['as' => 'ultimoPanteon', 'uses' => 'callesController@ultimoPanteon']);

Route::get('editarCalle',  ['as' => 'editarCalle', 'uses' => 'callesController@edit']);
//porque no va por post??????
Route::get('editarNombre', ['as' => 'editarNombre', 'uses' => 'callesController@editarNombre']);

Route::get('editarParcela', ['as' => 'editarParcela', 'uses' => 'callesController@editarParcelas']);
//Fin gestión calles ///



//Alta usuarios
Route::get('usuarios',  ['as' => 'usuarios', 'uses' => 'altaUsuarioController@index']);

Route::get('nueva_alta',  ['as' => 'nueva_alta', 'uses' => 'altaUsuarioController@create']);

//Parte tarifas
Route::get('tarifas',  ['as' => 'tarifas', 'uses' => 'tarifasController@index']);
//no se porqué no va post
Route::get('cp_parcelas',  ['as' => 'cp_parcelas', 'uses' => 'tarifasController@cp_parcelas']);

Route::get('cp_nichos',  ['as' => 'cp_nichos', 'uses' => 'tarifasController@cp_nichos']);

Route::get('ct_parcelas',  ['as' => 'ct_parcelas', 'uses' => 'tarifasController@ct_parcelas']);

Route::get('ct_nichos',  ['as' => 'ct_nichos', 'uses' => 'tarifasController@ct_nichos']);

Route::get('m_parcelas',  ['as' => 'm_parcelas', 'uses' => 'tarifasController@m_parcelas']);

Route::get('m_nichos',  ['as' => 'm_nichos', 'uses' => 'tarifasController@m_nichos']);


//Fin parte tarifas

Route::post('editar-nicho',  ['as' => 'editar-nicho', 'uses' => 'NichoController@edit']);

Route::post('nuevo-difunto' ,  ['as' => 'nuevo-difunto', 'uses' => 'DifuntoController@store']);

Route::get('pdfjuzgado', ['as' => 'pdfjuzgado', 'uses' => 'PdfController@invoice']);


//Paginacion dedicado al apartado de los nichos disponibles
Route::post('paginateDisponibles', ['as' => 'paginateDisponibles', 'uses' => 'NichoController@paginateDisponibles']);

//Paginacion dedicado al apartado de los nichos NO disponibles
Route::post('paginateNoDisponibles', ['as' => 'paginateNoDisponibles', 'uses' => 'NichoController@paginateNoDisponibles']);

//Paginacion dedicado al apartado de los nichos disponibles cuando es una busqueda
Route::post('paginateDisponiblesBusqueda', ['as' => 'paginateDisponiblesBusqueda', 'uses' => 'NichoController@paginateDisponiblesBusqueda']);

//Paginacion dedicado al apartado de los nichos NO disponibles cuando es una busqueda
Route::post('paginateNoDisponiblesBusqueda', ['as' => 'paginateNoDisponiblesBusqueda', 'uses' => 'NichoController@paginateNoDisponiblesBusqueda']);

//busqueda de nichos a traves del formulario
Route::post('busquedaNichos', ['as' => 'busquedaNichos', 'uses' => 'NichoController@busquedaNicho']);

//paginacion de los difuntos en el sistema
Route::post('paginateDifunto', ['as' => 'paginateDifunto', 'uses' => 'DifuntoController@paginateDifunto']);

//Resultados de busqueda difuntos
Route::post('BusquedaDifunto', ['as' => 'BusquedaDifunto', 'uses' => 'DifuntoController@busqueda']);

//Resultados de busqueda difuntos paginados en la busqueda
Route::post('paginateBusquedaDifunto', ['as' => 'paginateBusquedaDifunto', 'uses' => 'DifuntoController@busquedaPaginada']);

//eliminar difunto
Route::post('EliminarDifunto', ['as' => 'EliminarDifunto', 'uses' => 'DifuntoController@destroy']);

//modificar difunto
Route::get('modificar-difunto-{id}', ['as' => 'modificar-difunto', function($id){
    $controller = App::make(\App\Http\Controllers\DifuntoController::class);
    return $controller->callAction('edit', array('tipo' => $id));
}]);

//modificar calle
Route::get('modificar-calle-{id}', ['as' => 'modificar-calle', function($id){
    $controller = App::make(\App\Http\Controllers\callesController::class);
    return $controller->callAction('editarView', array('tipo' => $id));
}]);



Route::post('ModifyDifunto', ['as' => 'ModifyDifunto', 'uses' => 'DifuntoController@update']);

Route::post('getData', ['as' => 'getData', 'uses' => 'NichoController@getData']);

Route::post('autocompletarTitular', ['as' => 'autocompletarTitular', 'uses' => 'TitularController@get']);


//para la modal
Route::post('autocompletarTitulares', ['as' => 'autocompletarTitulares', 'uses' => 'TitularController@getForModal']);


Route::get('login', ['as' => 'login', function()
{
    return view('login');

}]);

//Apartados nichos
Route::get('panteones', ['as' => 'panteones', 'uses' => 'panteonesController@index']);



// Validamos los datos de inicio de sesión PARA LA ADMINISTRACION
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['as' =>'auth/login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth/logout', 'uses' => 'LogController@logout']);


Route::resource('log','LogController');


