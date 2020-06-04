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

$router->get('/login', 'HomeController@login');
$router->post('/login/auth', 'HomeController@loginPost');
$router->get('/register', 'HomeController@register');
$router->post('/registerPost', 'HomeController@registerPost');
$router->get('/logout', 'HomeController@logout');


// Home
$router->group(['middleware' => 'login.auth'], function () use ($router) {
    $router->get('/', 'HomeController@index');
    $router->get('/home', 'HomeController@index');
});
// Peserta
$router->group(['prefix' => 'peserta', 'middleware' => 'login.auth'], function () use ($router) {
    $router->get('nasional/{jk}', 'PesertaController@nasional');
    $router->get('recurve/{jk}', 'PesertaController@recurve');
    $router->get('compound/{jk}', 'PesertaController@compound');
    $router->get('add', 'PesertaController@create');
    $router->post('add/proses', 'PesertaController@prosesAdd');
    $router->get('edit/{uuid}', 'PesertaController@update');
    $router->get('del/{uuid}', 'PesertaController@del');
    $router->post('edit/proses', 'PesertaController@prosesEdit');
    $router->post('import_excel', 'PesertaController@import_excel');
});
// Ronde
$router->group(['prefix' => 'ronde', 'middleware' => 'login.auth'], function () use ($router) {
    $router->get('/', 'RondeController@index');
    $router->get('add', 'RondeController@create');
    $router->post('add/proses', 'RondeController@prosesAdd');
    $router->get('edit/{uuid}', 'RondeController@update');
    $router->get('del/{id}', 'RondeController@del');
    $router->post('edit/proses', 'RondeController@prosesEdit');
});
// Target
$router->group(['prefix' => 'target', 'middleware' => 'login.auth'], function () use ($router) {
    $router->get('/', 'TargetController@index');
    $router->get('add', 'TargetController@create');
    $router->post('add/proses', 'TargetController@prosesAdd');
    $router->get('edit/{uuid}', 'TargetController@update');
    $router->get('del/{id}', 'TargetController@del');
    $router->get('delall', 'TargetController@delAll');
    $router->post('edit/proses', 'TargetController@prosesEdit');
});
// Panitia
$router->group(['prefix' => 'panitia', 'middleware' => 'login.auth'], function () use ($router) {
    $router->get('/', 'PanitiaController@index');
    $router->get('add', 'PanitiaController@create');
    $router->post('add/proses', 'PanitiaController@prosesAdd');
    $router->get('edit/{uuid}', 'PanitiaController@update');
    $router->get('del/{id}', 'PanitiaController@del');
    $router->get('delall', 'PanitiaController@delAll');
    $router->post('edit/proses', 'PanitiaController@prosesEdit');
});
// Kelas
$router->group(['prefix' => 'kelas', 'middleware' => 'login.auth'], function () use ($router) {
    $router->get('/', 'KelasController@index');
    $router->get('add', 'KelasController@create');
    $router->post('add/proses', 'KelasController@prosesAdd');
    $router->get('edit/{uuid}', 'KelasController@update');
    $router->get('del/{id}', 'KelasController@del');
    $router->get('delall', 'KelasController@delAll');
    $router->post('edit/proses', 'KelasController@updateProses');
});
// Rules
$router->group(['prefix' => 'rules', 'middleware' => 'login.auth'], function () use ($router) {
    $router->get('/', 'RulesController@index');
    $router->get('add', 'RulesController@create');
    $router->post('add/proses', 'RulesController@prosesAdd');
    $router->get('edit/{uuid}', 'RulesController@update');
    $router->get('del/{uuid}', 'RulesController@del');
    $router->get('delall', 'RulesController@delAll');
    $router->post('edit/proses', 'RulesController@prosesEdit');
});
// Artikel
$router->group(['prefix' => 'artikel', 'middleware' => 'login.auth'], function () use ($router) {
    $router->get('/', 'ArtikelController@index');
    $router->get('add', 'ArtikelController@create');
    $router->post('add/proses', 'ArtikelController@prosesAdd');
    $router->get('edit/{uuid}', 'ArtikelController@update');
    $router->get('del/{uuid}', 'ArtikelController@del');
    $router->get('delall', 'ArtikelController@delAll');
    $router->get('detail/{uuid}', 'ArtikelController@show');
    $router->post('edit/proses', 'ArtikelController@updateProses');
});
// Kompetisi
$router->group(['prefix' => 'kompetisi', 'middleware' => 'login.auth'], function () use ($router) {
    $router->get('/', 'KompetisiController@index');
    $router->get('detailkategori/{kat}/{kel}', 'KompetisiController@detailKategori');
    $router->get('add/{kelas}/{jk}/{uuid_kat}/{uuid_rules}/{sesi}', 'KompetisiController@addPeserta');
    $router->get('add/manual/{kelas}/{jk}/{uuid_kat}/{uuid_rules}/1', 'KompetisiController@addPesertaManual');
    $router->get('detail/{nama_babak}/{uuid_rules}', 'KompetisiController@skorDetail');
    $router->post('add/proses', 'KompetisiController@prosesAdd');
    $router->get('edit/{uuid}', 'KompetisiController@update');
    $router->get('del/{uuid}', 'KompetisiController@del');
    $router->get('delall', 'KompetisiController@delAll');
    $router->post('edit/proses', 'KompetisiController@prosesEdit');
    $router->get('gen', 'KompetisiController@generateNoPeserta');
});
// Admin
$router->group(['prefix' => 'admin', 'middleware' => 'login.auth'], function () use ($router) {
    $router->get('/{uuid}', 'AdminController@index');
    $router->post('edit/proses', 'AdminController@prosesEdit');
});
