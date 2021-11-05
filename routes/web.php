<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatosPersona;
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
//esto es un comentario

Route::view('/','home')->name('home');
Route::view('acerca-de','about')->name('about');
Route::get('blog','BlogController@index')->name('blog.index');
Route::get('blog/{post:slug}','BlogController@show')->name('blog.show');
Route::view('contactos','contact')->name('contact');
Route::get('Datos-de','DatosPersona@second')->name('personas.second');
