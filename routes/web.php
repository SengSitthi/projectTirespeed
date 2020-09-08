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

Route::get('/', function () {
    return view('welcome');
});

//////////////////////// START LOGIN /////////////////////////////

Route::get('/login', 'LoginController@index')->name('login');

Route::get('/admin', 'LoginController@adminpage')->name('admin');

Route::post('/check', 'LoginController@checklogin')->name('check');

Route::get('/logout', 'LoginController@fnLogout')->name('logout');

/////////////////////// END LOGIN ////////////////////////////////

////////////////////////// START NOTIFICATION /////////////////////
Route::post('/loadNotification', 'StoreWorkingController@fnLoadNotification');
////////////////////////// END NOTIFICATION ///////////////////////


//////////////////////// START DISTRICT ///////////////////////////

Route::get('/loadDistrict', 'DisController@fnLoadDis')->name('loadDistrict');

//////////////////////// END DISTRICT ////////////////////////////

/////////////////////// START EMPLOYEE //////////////////////////////
Route::get('/employee', 'EmpController@index')->name('employee');
// add employee
Route::post('/insertemp', 'EmpController@fnaddemployee')->name('insertemp');
// employee list page
Route::get('/employee_list', 'EmpController@fnShowempList')->name('employee_list');

// function loadEmployee to show data in table
Route::get('/loadEmployee', 'EmpController@fnloadEmployee')->name('loadEmployee');

// function get employee data to edit form
Route::get('/loadEmpedit/{id}', 'EmpController@fnloadEmpedit')->name('loadEmpedit');
// Route update employee data
Route::put('/updateEmp/{empid}', 'EmpController@fnloadUpdateEmp');
// Route delete employee data
Route::delete('/deleteEmp/{empid}', 'EmpController@fndeleteEmp');
//// route get data to show in myself modal
Route::get('/loadMyself', 'EmpController@fnloadMyself');
/////////////////////// END EMPLOYEE ////////////////////////////////

/////////////////////// START USER //////////////////////////////////
// insert user form
Route::get('/user', 'UserController@index')->name('user');
// get employee to user add
Route::get('/loadEmpData/{empid}', 'UserController@fnloadEmpData');
// route insert user
Route::post('/insertUser', 'UserController@fninsertUser')->name('insertUser');
// route display user list
Route::get('/userlist', 'UserController@fnUserlist')->name('userlist');
// route loaduser list data
Route::get('/loadUserlist', 'UserController@fnloadUserlist')->name('userlist');
// route update password
Route::post('/updatepass/{uid}', 'UserController@fnUpdatepass');
// route get user data to edit form
Route::get('/getUserdata/{uid}', 'UserController@fngetUserdata');
// route update user data
Route::put('/upUserdata/{uid}', 'UserController@fnupUserdata');
// route delete user data
Route::delete('/deleteUser/{uid}', 'UserController@fnDelUser');
/////////////////////// END USER ////////////////////////////////////

////////////////////////// START ROLE AND PERMISSION PAGE //////////////////////
// route index of role permission page
Route::get('/rolespms', 'RolepmsController@index')->name('rolespms');
// route get role to show
Route::get('/loadRoles', 'RolepmsController@fnloadRoles');
// route get permission to show
Route::get('/loadPermission', 'RolepmsController@fnloadPermission');
// route insert role and pms
Route::post('/insertrolepms', 'RolepmsController@fninsertrolepms');
/// route to get role and permission name of user by user id
Route::get('/loadUserrolepms/{uid}', 'RolepmsController@fnloadUserrolepms');
// route to update user role and permission on userlist page
Route::post('/updateRolePms', 'RolepmsController@fnupdateRolePms');
// route to remove role and permission on userlist page
Route::delete('/deleteRolePms/{uid}', 'RolepmsController@fndeleteRolePms');
////////////////////////// END ROLE AND PERMISSION ///////////////////////////