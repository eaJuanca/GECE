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

    Route::get('nichos', ['as' => 'nichos','uses' => 'NichoController@index']);


    Route::get('modificar-nicho-{id}', ['as' => 'modificar-nichos', function($id){
        $controller = App::make(\App\Http\Controllers\NichoController::class);
        return $controller->callAction('indexModify', array('tipo' => $id));
    }]);


});

//
Route::post('altaCalle',  ['as' => 'altaCalle', 'uses' => 'callesController@create']);

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

