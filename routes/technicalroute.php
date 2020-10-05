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