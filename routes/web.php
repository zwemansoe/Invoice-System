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
//view all invoice 

Route::get('/', function () {
    return redirect('/invoices');
});

Route::get('/invoices','InvoiceController@index');
Route::get('/invoices','InvoiceController@index');

// get 
Route::get('/invoice/','InvoiceController@create');
// post 
Route::post('/invoice/','InvoiceController@store');
// put
Route::put('/invoice/{id}/update','InvoiceController@update');
// edit 
Route::get('/invoice/{id}/update','InvoiceController@edit');
// delete
Route::delete('/invoice/{id}','InvoiceController@destroy');

// PDF 
Route::get('/invoice/{id}/pdf','InvoiceController@pdf');



