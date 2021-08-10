<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'api'], function () use ($router) {

	$router->post('register','AuthController@create');
	$router->get('test','AuthController@test');
	
	//auth
    $router->post('login', 'AuthController@login');

	$router->get('/getObat', 'ObatController@get');
	$router->post('/addObat', 'ObatController@add');
	$router->post('/updateObat/{id}', 'ObatController@update');
	$router->get('/detailObat/{id}', 'ObatController@detail');
	$router->get('/deleteObat/{id}', 'ObatController@delete');

	$router->get('/getApoteker', 'ApotekerController@get');
	$router->post('/addApoteker', 'ApotekerController@add');
	$router->post('/updateApoteker/{id}', 'ApotekerController@update');
	$router->get('/detailApoteker/{id}', 'ApotekerController@detail');
	$router->get('/deleteApoteker/{id}', 'ApotekerController@delete');

	$router->get('/getTransaksi', 'TransaksiController@get');
	$router->post('/addTransaksi', 'TransaksiController@add');
	$router->post('/updateTransaksi/{id}', 'TransaksiController@update');
	$router->get('/detailTransaksi/{id}', 'TransaksiController@detail');
	$router->get('/deleteTransaksi/{id}', 'TransaksiController@delete');

	$router->get('/getLaporan', 'LaporanController@get');

});
