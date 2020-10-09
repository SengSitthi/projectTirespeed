<?php
///////////////////////////////////// SETTING ROUTE ///////////////////////////////////////////////

//////////////////////////////////////// START REPAIR NO ID ///////////////////////////////////////
// add new rpno
Route::get('/addnewrepairid', 'TechrepairController@index')->name('addnewrepairid');
// get spare by type spare id
Route::post('/gettypesparedt', 'TechrepairController@fnGettypeSparedt');
// insert new rpno
Route::post('/insertnewrpno', 'TechrepairController@fnInsertnewrpno')->name('insertnewrpno');
// show list rpno
Route::get('/rpnoidlist', 'TechrepairController@fnRpnoidlist')->name('rpnoidlist');
// function show rpnoid
Route::post('/getrpnodata', 'TechrepairController@fnGetrpnodata');
// function update repair no data
Route::post('/updaterpnodata', 'TechrepairController@fnUpdaterpnodata');
// function delete repair no data
Route::get('/deleteRpnoid/{rpnoid}', 'TechrepairController@fnDeleterpnoid');
// function search repair no data
Route::post('/searchRpnoid', 'TechrepairController@fnSearchRpnoid');
////////////////////////////////////////// END REPAIR NO ID ///////////////////////////////////////

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