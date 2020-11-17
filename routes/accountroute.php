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
// route show new invoice page
Route::get('/newinvoice', 'AccInvoiceController@fnNewInvoice')->name('newinvoice');

///////////////////////////////////// company ////////////////////////////////////
// company page
Route::get('/company', 'AccountController@fnCompany')->name('company');
// load company data
Route::post('/loadCompany', 'AccountController@fnLoadcompany');
// route insert new company
Route::post('/insertnewcompany', 'AccountController@fnInsertCompany');
// route to get data to update
Route::post('/getCompanydata', 'AccountController@fnGetCompany');
// route to update company data
Route::post('/updatecompany', 'AccountController@fnUpdatecompany');
// route to delete company data
Route::post('/delcompanydata', 'AccountController@fnDelCompany');