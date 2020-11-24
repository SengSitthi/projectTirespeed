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
////////////////////////////////// START INVOICE ////////////////////////////////
// route show new invoice page
Route::get('/newinvoice', 'AccInvoiceController@fnNewInvoice')->name('newinvoice');
// route show quotation detail
Route::post('/getQuotationdt', 'AccInvoiceController@fnGetQuotationdt');
// route insert new invoice
Route::post('/insertnewinvoice', 'AccInvoiceController@fnInsertNewInvoice')->name('insertnewinvoice');
// route to show invoice list
Route::get('/invoicelist', 'AccInvoiceController@fnInvoicelist')->name('invoicelist');
// route to print invoice bill
Route::get('/printinvoice/{invoiceid}', 'AccInvoiceController@fnPrintInvoicebill');
// route to load invoice data to update form
Route::post('/invoicetoEdit', 'AccInvoiceController@fnInvoicetoEdit');
// route to update invoice data
Route::post('/updateInvoice', 'AccInvoiceController@fnUpdateInvoice')->name('updateInvoice');
// route to search invoice data
Route::post('/searchInvoice', 'AccInvoiceController@fnSearchInvoice');
// route to get invoice detail list to show
Route::post('/getinvoice_detail', 'AccInvoiceController@fnGetinvoice_detail');
// route to delete invoice data
Route::get('/deleteInvoice/{invoiceid}', 'AccInvoiceController@fnDeleteInvoice');

/////////////////////////////////// END INVOICE /////////////////////////////////

////////////////////////////////// START COMPANY /////////////////////////////////
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
/////////////////////////////////// END COMPANY ////////////////////////////////////