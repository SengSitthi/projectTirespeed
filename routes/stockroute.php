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

///////////////////////////////////////////////// START STOCKER ////////////////////////////////////////////
///////////////////////////////////// stock dashboard ///////////////////////////////////
Route::get('/stockdashboard', 'StockerController@index')->name('stockdashboard');
// load Spare data to show on chart
Route::post('/loadStockchart', 'StockerController@fnLoadstockchart');

///////////////////////////////////// Spare data page //////////////////////////////////
Route::get('/spares', 'SpareController@fnSpares')->name('spares');
/// list type spare after select type service
Route::post('/selectTypeservice', 'SpareController@fnSelectTypespare');
// list brand spare after select type spare
// Route::post('/selectBrandspare', 'SpareController@fnSelectBrandspare');
// insert spare
Route::post('/insertSpare', 'SpareController@fnInsertspare');
/// spares list page
Route::get('/spareslist', 'SpareController@fnListSpare')->name('spareslist');
// Auto complete
Route::post('/searchsparescomplete', 'SpareController@fnSearchspare');
// show search data route
Route::post('/showsearchdata', 'SpareController@fnShowsearchdata');
// Print barcode
Route::post('/printBarcode', 'SpareController@fnPrintBarcode')->name('printBarcode');
// get spare data to edit
Route::post('/getSparetoedit', 'SpareController@fnGetSparetoEdit');
// update spare data
Route::post('/updateSpare', 'SpareController@fnUpdateSpare')->name('updateSpare');
// delete spare data
Route::get('/deleteSpares/{sparesid}', 'SpareController@fnDeletespare');
// print spare book
Route::get('/sparesbook', 'SpareController@fnSparebook')->name('sparesbook');
// printsparebook
Route::get('/sparesbookprint', 'SpareController@fnSparesbookprint')->name('sparesbookprint');
// load book data from search
Route::post('/loadBookdata', 'SpareController@fnLoadbookdata')->name('loadBookdata');
////////////////////////////////// Start Receive Spares /////////////////////////////////
Route::get('/receive', 'ReceiveController@fnReceiveSpare')->name('receive');
// route search orderspare by orderid
Route::post('/searchOrderlist', 'ReceiveController@fnSearchOrderlist');
// insert spare to receive
Route::post('/receivespares', 'ReceiveController@fnReceiveSpares')->name('receivespares');

////////////////////////////////// List Receive Spares /////////////////////////////////
Route::get('/receivelist', 'ReceiveController@fnReceiveList')->name('receivelist');
// show receive list detail
Route::post('/loadreceivedetail', 'ReceiveController@fnLoadReceivedetail');
// insert new receive on receive list page
Route::post('/insertnewreceive', 'ReceiveController@fnInsertNewReceive');
// delete receive list
Route::post('/deleteReceivedetail', 'ReceiveController@fnDeleteReceivedt');
// get receive data to edit
Route::post('/getreceivedata', 'ReceiveController@fnGetreceivedata');
// update receive data
Route::post('/updateReceive', 'ReceiveController@fnUpdateReceive')->name('updateReceive');
// delete receive
Route::get('/deleteReceive/{receiveid}', 'ReceiveController@fnDeleteReceive');
// print receive bill
Route::get('/receiveprint/{receiveid}', 'ReceiveController@fnReceivePrint');
// search receive data
Route::post('/searchreceivedt', 'ReceiveController@fnSearchReceive');

////////////////////////////////// Order Spares page ///////////////////////////////////
Route::get('/orders', 'OrderController@fnOrder')->name('orders');
// function get data to order
Route::post('/addsparetoOrder', 'OrderController@fnAddsparetoOrder');
// insert order data
Route::post('/insertOrder', 'OrderController@fnInsertOrder')->name('insertOrder');

/////////////////////////// Order spare list page //////////////////////
Route::get('/orderslist', 'OrderController@fnOrderlist')->name('orderslist');
// order print data
Route::get('/orderprint/{orderid}', 'OrderController@fnOrderPrint');
// function load order list to manage order list page
Route::post('/loadOrderList', 'OrderController@fnLoadOrderlist');
// function add order
Route::post('/addOrderlist', 'OrderController@fnAddOrderlist');
// function delete data
Route::post('/deleteOrderlist', 'OrderController@fnDeleteOrderlist');
// function get order data
Route::post('/getOrderdata', 'OrderController@fnGetorderdata');
// function update order data
Route::post('/updateOrder', 'OrderController@fnUpdateOrder')->name('updateOrder');
// function search order
Route::post('/searchOrderdata', 'OrderController@fnSearchOrderData');
// delete order
Route::get('/deleteOrder/{orderid}', 'OrderController@fnDeleteOrderdata');

////////////////////////////////// Withdraw Spare page /////////////////////////////////
Route::get('/withdraw', 'WithdrawController@fnWithdraw')->name('withdraw');
// search spare to withdrew list
Route::post('/withdrawspares', 'WithdrawController@fnWithdrawspares');
// show car by customer id
Route::post('/loadcarwithdraw', 'WithdrawController@fnLoadcarWithdraw');
// insert withdraw
Route::post('/insertWithdraw', 'WithdrawController@fnInsertWithdraw')->name('insertWithdraw');

////////////////////////////// Withdraw list spare page ////////////////////////////////
// withdraw list page
Route::get('/withdrawlist', 'WithdrawController@fnWithdrawlist')->name('withdrawlist');
// withdraw print bill
Route::get('/withdrawprint/{withdrawid}', 'WithdrawController@fnWithdrawprint');
// load withdraw list
Route::post('/loadWithdrawdt', 'WithdrawController@fnLoadWithdrawdt');
// add new spare or update withdraw qty
Route::post('/addnewwithdraw', 'WithdrawController@fnAddnewwithdraw');
// trash spares list withdrawdetail
Route::post('/trashlist', 'WithdrawController@fnTrashlist');
// get withdraw data to edit form
Route::post('/getWithdrawdata', 'WithdrawController@fnGetWithdrawdata');
// update withdraw data
Route::post('/updatewithdraw', 'WithdrawController@fnUpdatewithdraw');
// delete withdraw data
Route::get('/deletewithdraw/{withdrawid}', 'WithdrawController@fnDeletewithdraw');
// search withdraw data
Route::post('/searchwithdrawdata', 'WithdrawController@fnSearchwithdraw');

///////////////////////////////////// Stock summary /////////////////////////////
// summary page
Route::get('/stocksummary', 'StocksummaryController@fnStocksmr')->name('stocksummary');
// summary search
Route::post('/stocksumsearch', 'StocksummaryController@fnStocksumsearch')->name('stocksumsearch');
// print stocksearch
Route::post('/printstocksearch', 'StocksummaryController@fnPrintstocksearch')->name('printstocksearch');


////////////////////////////// Add Supplier page //////////////////////////////////
Route::get('/supplier', 'SupController@fnSupplier')->name('supplier');
// insert supplier
Route::post('/insertSupplier', 'SupController@fnInsertSupplier')->name('insertSupplier');
// select province to show district
Route::post('/selectProvince', 'SupController@fnSelectProvince');

////////////////////////////// Supplier list page ////////////////////////////////
Route::get('/supplierlist', 'SupController@fnSupplierlist')->name('supplierlist');
// function view bank of supplier
Route::post('/viewBank', 'SupController@fnViewbank');
// insert bank data
Route::post('/insertBankdata', 'SupController@fnInsertbank');
// get data to edit
Route::post('/getSupaccountdata', 'SupController@fnGetSupaccount');
// update data
Route::post('/updateSupaccount', 'SupController@fnUpdateSupaccount');
// delete bank data
Route::post('/deletebankdata', 'SupController@fnDeletebank');
// get supplier data to edit
Route::post('/getSupplierdata', 'SupController@fnGetsupplierdata');
// update supplier data
Route::post('/updateSupplier', 'SupController@fnUpdateSupplier')->name('updateSupplier');
// delete supplier
Route::get('/deleteSupplier/{supplierid}', 'SupController@fnDeleteSupplier');
// function search supplier
Route::post('/searchSupplier', 'SupController@fnSearchSupplier');
// search auto complete
Route::post('/searchsupplierAuto', 'SupController@fnSearchSupauto');

///////////////////////////////////// Type service page //////////////////////////////////
Route::get('/typeservice', 'StockerController@fnTypeService')->name('typeservice');
// load data to show
Route::post('/loadtypeservice', 'StockerController@fnLoadtypeservice');
// insert typeservice
Route::post('/insertTypeservice', 'StockerController@fnInsertTypeService');
// get data to update
Route::post('/getTypeservicedata', 'StockerController@fnGetTypeservicedata');
// update type service
Route::post('/updateTypeservice', 'StockerController@fnUpdateTypeservice');
// delete type service
Route::post('/deteleTypeservice', 'StockerController@fnDeleteTypeservice');

////////////////////////////////////// Type spare page /////////////////////////////////////
Route::get('/typespare', 'StockerController@fnTypespare')->name('typespare');
// load type spare data to show on table
Route::post('/loadTypespare', 'StockerController@fnLoadTypespare');
// insert type spare data
Route::post('/insertTypespare', 'StockerController@fnInsertTypespare');
/// get type spare data to edit
Route::post('/gettypespare', 'StockerController@fnGetTypespare');
// update type spare data
Route::post('/updateTypespare', 'StockerController@fnUpdateTypespare');
// detele type spare data
Route::post('/deleteTypespare', 'StockerController@fnDeleteTypespare');

///////////////////////////////////// Type spare page //////////////////////////////////
Route::get('/brandspare', 'StockerController@fnBrandSpare')->name('brandspare');
// load brand spare data to show
Route::post('/loadBrandspare', 'StockerController@fnLoadBrandspare');
// insert brand spare data
Route::post('/insertBrandspare', 'StockerController@fnInsertBrandspare');
// get data to update
Route::post('/getBrandspare', 'StockerController@fnGetBrandspare');
// update brand spare
Route::post('/updateBrandspare', 'StockerController@fnUpdateBrandspare');
// delete brand spare
Route::post('/deleteBrandspare', 'StockerController@fnDeleteBrandspare');

////////////////////////////////////// Unit Spare page ////////////////////////////////
Route::get('/unitspare', 'StockerController@fnUnitspare')->name('unitspare');
// load unit spare data to show
Route::post('/loadUnitspare', 'StockerController@fnLoadUnitspare');
// insert unit spare data
Route::post('/insertUnitspare', 'StockerController@fnInsertUnitspare');
// get data to update
Route::post('/getUnitdata', 'StockerController@fnGetUnitspare');
// update data route
Route::post('/updateUnitspare', 'StockerController@fnUpdateUnitspare');
// delete unit data
Route::post('/deleteUnitspare', 'StockerController@fnDeleteUnitspare');

///////////////////////////////////////////////// END STOCKER ///////////////////////////////////////////////