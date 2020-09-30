<?php
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