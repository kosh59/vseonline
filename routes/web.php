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
Auth::routes();


    Route::get('/dashboard', function() {
        return 'Добро пожаловать, Менеджер проекта';
    });


Route::view('/','frontpage');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/mypage', 'PageController@index')->name('mypage');
    Route::post('/page', 'PageController@update')->name('page_update');

    Route::post('/link/add', 'LinkController@store')->name('link_add');
    Route::put('/link/{link}', 'LinkController@update')->name('link_update');
    Route::delete('/link/{link}', 'LinkController@destroy')->name('link_delete');
    Route::get('/stat/{link}', 'LinkController@stat');
});
/**
 * Переадресация по короткой ссылке
 */
Route::get('/link/{link}', 'LinkController@redirect');

Route::get('/{page}', 'PageController@show');
