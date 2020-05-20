<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$router->get('/', 'HomeController@index');
// Peserta
$router->group(['prefix' => 'peserta'], function () use ($router) {
    $router->get('nasional/{jk}', 'PesertaController@nasional');
    $router->get('recurve/{jk}', 'PesertaController@recurve');
    $router->get('compound/{jk}', 'PesertaController@compound');
    $router->get('add', 'PesertaController@create');
    $router->post('add/proses', 'PesertaController@prosesAdd');
    $router->get('edit/{uuid}', 'PesertaController@update');
    $router->get('del/{id}', 'PesertaController@del');
    $router->post('edit/proses', 'PesertaController@prosesEdit');
});
// Ronde
$router->group(['prefix' => 'ronde'], function () use ($router) {
    $router->get('/', 'RondeController@index');
    $router->get('add', 'RondeController@create');
    $router->post('add/proses', 'RondeController@prosesAdd');
    $router->get('edit/{uuid}', 'RondeController@update');
    $router->get('del/{id}', 'RondeController@del');
    $router->post('edit/proses', 'RondeController@prosesEdit');
});
// Target
$router->group(['prefix' => 'target'], function () use ($router) {
    $router->get('/', 'TargetController@index');
    $router->get('add', 'TargetController@create');
    $router->post('add/proses', 'TargetController@prosesAdd');
    $router->get('edit/{uuid}', 'TargetController@update');
    $router->get('del/{id}', 'TargetController@del');
    $router->get('delall', 'TargetController@delAll');
    $router->post('edit/proses', 'TargetController@prosesEdit');
    $router->get('gen', 'TargetController@generateNoPeserta');
});
// Rules
$router->group(['prefix' => 'rules'], function () use ($router) {
    $router->get('/', 'RulesController@index');
    $router->get('add', 'RulesController@create');
    $router->post('add/proses', 'RulesController@prosesAdd');
    $router->get('edit/{uuid}', 'RulesController@update');
    $router->get('del/{uuid}', 'RulesController@del');
    $router->get('delall', 'RulesController@delAll');
    $router->post('edit/proses', 'RulesController@prosesEdit');
});
// Kompetisi
$router->group(['prefix' => 'kompetisi'], function () use ($router) {
    $router->get('/', 'KompetisiController@index');
    $router->get('add/{kelas}/{jk}/{uuid_rules}', 'KompetisiController@addPeserta');
    $router->get('detail/{nama_babak}/{uuid_rules}', 'KompetisiController@skorDetail');
    $router->post('add/proses', 'KompetisiController@prosesAdd');
    $router->get('edit/{uuid}', 'KompetisiController@update');
    $router->get('del/{uuid}', 'KompetisiController@del');
    $router->get('delall', 'KompetisiController@delAll');
    $router->post('edit/proses', 'KompetisiController@prosesEdit');
});
