<?php

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

Route::get('/vacancies/create', 'VacancyController@create')->middleware('auth');
Route::post('/vacancies', 'VacancyController@store')->middleware('auth');
Route::get('/vacancies/{vacancy}', 'VacancyController@show');
Route::get('/vacancies', 'VacancyController@index');
Route::get('/', 'VacancyController@index');

Auth::routes();