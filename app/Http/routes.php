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

Route::group(['prefix' => '/'], function()
{

    Route::get('/', ['as' => 'home', function() {

        return view('home');
    }]);

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

//
Route::get('altaCalle',  ['as' => 'altaCalle', 'uses' => 'callesController@create']);

Route::post('borrarCalle',  ['as' => 'borrarCalle', 'uses' => 'callesController@delete']);

Route::get('editarCalle',  ['as' => 'editarCalle', 'uses' => 'callesController@edit']);

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

