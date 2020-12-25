<?php
///////////////////////////////////// START TECHNICAL DASHBOARD ///////////////////////////////////
// show technical dashboard
Route::get('/technic_dashboard', 'TechrepairController@fnDashboard')->name('technic_dashboard');
// load technical data to show on chart
Route::post('/loadtechchart', 'TechrepairController@fnLoadtechchart');
///////////////////////////////////// END TECHNICAL DASHBOARD /////////////////////////////////////

///////////////////////////////////// SETTING ROUTE ///////////////////////////////////////////////

////////////////////////////////////////// START UNIT REPAIR //////////////////////////////////////
// function mange unit repair page
Route::get('/unitrepairs', 'TechrepairController@fnUnitRepairs')->name('unitrepairs');
// function get unit repair data to show
Route::post('/showunitrepair', 'TechrepairController@fnShowUnitrepair');
// function insert new unit repair
Route::post('/addnewunitrp', 'TechrepairController@fnAddnewUnitrp');
// get data to edit
Route::post('/getUnitrpID', 'TechrepairController@fngetUnitrpid');
// function update unit repair
Route::post('/updateUnitrp', 'TechrepairController@fnUpdateUnitrp');
// function delete unit repair
Route::post('/deleteUnitrp', 'TechrepairController@fnDeleteUnitrp');
////////////////////////////////////////// END UNIT REPAIR ////////////////////////////////////////

////////////////////////////////////////// START MANAGE TYPE CARS /////////////////////////////////
// show manage page view
Route::get('/managetypecars', 'TechrepairController@fnManageTypecar');
// function load type of car to show
Route::post('/showtypecars', 'TechrepairController@fnShowTypecars');
// function add new type car data
Route::post('/insertnewtypecar', 'TechrepairController@fnInsertTypecar');
// function get type data to edit
Route::post('/getTypecardata', 'TechrepairController@fngetTypecar');
// function update type car data
Route::post('/updateTypecar', 'TechrepairController@fnUpdateTypecar');
// function delete type car data
Route::post('/deleteTypecus', 'TechrepairController@fnDeltypecus');
////////////////////////////////////////// END MANAGE TYPE CARS ///////////////////////////////////

////////////////////////////////////////// START WAGES REPAIR /////////////////////////////////////
//function show insert wages form page
Route::get('/wagenew', 'WageController@index')->name('wagenew');
// function insert new wages
Route::post('/insertwage', 'WageController@fnInsertWage')->name('insertwage');
// function show list wages
Route::get('/wagelist', 'WageController@fnWagelist')->name('wagelist');
// route get wage data to edit form
Route::post('/getWagedata', 'WageController@fnGetWagedata');
// route to update wage data
Route::post('/updateWages', 'WageController@fnUpdateWages')->name('updateWages');
// route to delete wage data
Route::get('/deletewage/{wageid}', 'WageController@fnDeleteWages');
// route to search wage data
Route::post('/searchWagedata', 'WageController@fnSearchWage');
////////////////////////////////////////// END WAGES REPAIR ///////////////////////////////////////

////////////////////////////////////////// START REPAIR BILL //////////////////////////////////////
// route to show new repair bill
Route::get('/repairbillnew', 'RepairbillController@index')->name('repairbillnew');
// route get spare name to on repair bill
Route::post('/getsparename', 'RepairbillController@fnGetSparename');
// route get wage data to on repair bill
Route::post('/getwagedata', 'RepairbillController@fnGetwagedata');
// route to insert new repair bill
Route::post('/insertnewrpbill', 'RepairbillController@fnInsertnewrpbill')->name('insertnewrpbill');
// route show repair bill list
Route::get('/repairbill_list', 'RepairbillController@fnRpbillList')->name('repairbill_list');
// route print repair bill
Route::get('/printrpbill/{rpbid}', 'RepairbillController@fnPrintrpbill');
// route to get repair bill detail table to show
Route::post('/getShowrpbdetail', 'RepairbillController@fnGetShowrpbdetail');
// route to add new list to rpb detail
Route::post('/addnewrpblist', 'RepairbillController@fnAddnewrplist');
// route to delete list on rpb detail
Route::post('/delrpblistdata', 'RepairbillController@fnDelrpblistdata');
// route to get repair bill data to edit
Route::post('/geteditrpbdata', 'RepairbillController@fnGeteditrpbdata');
// route to update repair bill date
Route::post('/updateRpbdate', 'RepairbillController@fnUpdateRpbdate');
// route to delete repair bill
Route::get('/deleterpbdata/{rpbid}', 'RepairbillController@fnDeleterpb');
// route to search repair bill
Route::post('/searchrepairbill', 'RepairbillController@fnSearchrpb');
////////////////////////////////////////// END REPAIR BILL ////////////////////////////////////////

////////////////////////////////////////// START CAR STATUS ///////////////////////////////////////
// list car status page
Route::get('/techcarstatus', 'TechstatusController@fnTechcarstatus')->name('techcarstatus');
//route for get car data from receive car form
Route::post('/getreceivedata', 'TechstatusController@fnGetreceivedata');
// route to insert new car status
Route::post('/intechcarstatus', 'TechstatusController@fnIntechcarsdata');
// route to update date out
Route::post('/updateDateout', 'TechstatusController@fnUpdateDateout')->name('updateDateout');
//route to update time out
Route::post('/updateTimeout', 'TechstatusController@fnUpdateTimeout')->name('updateTimeout');
// route to udpate status
Route::post('/updateStatus', 'TechstatusController@fnUpdateStatus')->name('updateStatus');
// route to delete car status data
Route::get('/deleteCarstatus/{tcsid}', 'TechstatusController@fnDelCarStatus');
////////////////////////////////////////// END CAR STATUS /////////////////////////////////////////