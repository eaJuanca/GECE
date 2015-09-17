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

    Route::get('/', function() {

        return view('home');
    });

    Route::get('calles', ['as' => 'calles', function()
    {
        return view('calles');
    }]);

    Route::get('difunto', ['as' => 'difunto', 'uses' => 'WebController@DifuntoIndex']);
    Route::post('difuntosJSON', ['as' => 'difuntosJSON', 'uses' => 'WebController@DifuntosJSON']);


    Route::get('alta-difunto', ['as' => 'alta-difunto', function()
    {
        return view('alta_difunto');
    }]);

});

//
Route::post('altaCalle',  ['as' => 'altaCalle', 'uses' => 'callesController@create']);

Route::post('nuevo-difunto' ,  ['as' => 'nuevo-difunto', 'uses' => 'DifuntoController@store']);

Route::get('pdfjuzgado', ['as' => 'pdfjuzgado', 'uses' => 'PdfController@invoice']);

