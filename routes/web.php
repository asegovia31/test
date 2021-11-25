<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatosPersona;
use App\Http\Controllers\HomeController;
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


// or


//esto es un comentario
// la ruta con home en esta linea trae los datos de la consulta a public
//HomeController es el controlador y index es la funcion
Route::get('/','HomeController@index')->name('home.index');
Route::get('export/agenda_agrupada/', 'HomeController@export');
Route::get('export/agenda_linea/', 'HomeController@export2');
Route::get('export/agenda_sku/', 'HomeController@export3');
Route::get('export/puertaexpress/', 'HomeController@export4');
Route::view('documentos','documentos')->name('documentos');
Route::view('indexadmin','indexadmin')->name('indexadmin');
Route::match(['get', 'post'],'login','HomeController@indexadmin')->name('login');
Route::view('puertaexpress','puertaexpress')->name('puertaexpress');
Route::view('parametros','parametros')->name('parametros');
Route::view('logout','logout')->name('logout');
Route::view('cuentas_users','cuentas_users')->name('cuentas_users');
Route::match(['get', 'post'],'Parametros_cod','HomeController@Parametros_cod')->name('Parametros_cod');

//Route::get('blog','HomeController@ConsultarPanel')->name('blog');
//Route::view('blog','blog')->name('blog');
//Route::view('/','home')->name('home');
//Route::view('acerca-de','about')->name('about');
//Route::get('blog','BlogController@index')->name('blog.index');
//Route::get('blog/{post:slug}','BlogController@show')->name('blog.show');
//Route::view('contactos','contact')->name('contact');
//Route::get('personas','DatosPersona@second')->name('personas.second');

//Route::get('principal','PanelController@ConsultarPanel')->name('Dashboard');
