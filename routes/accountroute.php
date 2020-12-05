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
////////////////////////////////// START DASHBOARD //////////////////////////////
// route to show dashboard page
Route::get('/account_dashboard', 'AccountController@index')->name('account_dashboard');
// route to show invoice and receipt chart
Route::post('/invoice_receipt_chart', 'AccountController@fnInvRecChart');
////////////////////////////////// END DASHBOARD ////////////////////////////////

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

/////////////////////////////////// START RECEIPT //////////////////////////////////
// new receipt page
Route::get('/newreceipt', 'ReceiptController@index')->name('newreceipt');
// route to load invoice data
Route::post('/loadInvoicedata', 'ReceiptController@fnLoadInvoicedata');
// route to insert new receipt
Route::post('/innewreceipt', 'ReceiptController@fnInNewreceipt')->name('innewreceipt');
// route to show receipt list page
Route::get('/receiptlist', 'ReceiptController@fnReceiptlist')->name('receiptlist');
// route to print receipt bill
Route::get('/printreceipt/{receiptid}', 'ReceiptController@fnPrintReceipt');
//route to load receipt detail to show on modal
Route::post('/loadReceiptdetail', 'ReceiptController@fnLoadReceiptdetail');
//route to load receipt data to edit form
Route::post('/getreceipt', 'ReceiptController@fnGetreceipt');
// route to update receipt data
Route::post('/updateReceipt', 'ReceiptController@fnUpdateReceipt')->name('updateReceipt');
// route to delete receipt data
Route::post('/deleteReceipt/{receiptid}', 'ReceiptController@fnDeleteReceipt');
// route to search receipt data
Route::post('/searchReceipt', 'ReceiptController@fnSearchReceipt');
//////////////////////////////////// END RECEIPT ///////////////////////////////////

/////////////////////////////////// START SUMMARY ACCOUNT ///////////////////////////////
// route to show summary page
Route::get('/account_summary', 'AccountSumController@index')->name('account_summary');
// route to search summary account
Route::post('/searchsummary', 'AccountSumController@fnSearchsummary')->name('searchsummary');
///////////////////////////////////// END SUMMARY ACCOUNT ///////////////////////////////