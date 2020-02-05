<?php

Auth::routes();

Route::view('/','frontpage');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/mypage', 'PageController@index')->name('mypage');
    Route::post('/mypage', 'PageController@update')->name('page_update');
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
