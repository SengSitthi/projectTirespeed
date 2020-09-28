<?php

/////////////////////////////////////////////////// CRM ////////////////////////////////////////////////////

//////////////////////////////////// START CHART OF CRM ////////////////////////////////////
// Route to get customer type to show on pie chart
Route::get('/loadTypeCus', 'AppointController@fnloadTypeCus');
// Route to get customer amount to show on column chart
Route::get('/loadCusofMonth', 'AppointController@fnloadCusofMonth');
//////////////////////////////////// END CHART OF CRM ////////////////////////////////

//////////////////////////////////// START CUSTOMER'S CAR RECEIVE /////////////////////
// crv new page
Route::get('/crvnew', 'CrvController@index')->name('crmnew');
// insert rcs data
Route::post('/insertrcs', 'CrvController@fnInsertrcs')->name('insertrcs');
// rcs list page
Route::get('/crvlist', 'CrvController@fnCrvlist')->name('crvlist');
// print rcs bill
Route::get('/printRcs/{rcsid}', 'CrvController@fnPrintRcs');
// get receivecars data to edit
Route::post('/getrcsdata', 'CrvController@fnGetrcsdata');
// update receice car data
Route::post('/updateRcs', 'CrvController@fnUpdateRcs')->name('updateRcs');
// show repair list
Route::post('/showlist', 'CrvController@fnShowlist');
// function add new list
Route::post('/addnewrcslist', 'CrvController@fnAddnewRcslist');
// function delete list
Route::post('/delete_rcslist', 'CrvController@fnDeleteRcslist');
// function delete receive car
Route::get('/deleteRcsid/{rcsid}', 'CrvController@fnDeleteRcsid');
//////////////////////////////////// END CUSTOMER'S CAR RECEIVE ///////////////////////

//////////////////////////////////// START QUOTATION /////////////////////////////////
// new quotation page
Route::get('/quotationnew', 'QuotationController@index')->name('quotationnew');
// get car to select by cusid
Route::post('/getCuscar', 'QuotationController@fnGetCuscar');
// get spares data
Route::post('/loadSparetoQT', 'QuotationController@fnloadSparetoQT');
// function insert new quotation
Route::post('/insertnewqt', 'QuotationController@fnInsertNewQT')->name('insertnewqt');
// quotation list
Route::get('/quotationlist', 'QuotationController@fnQTList')->name('listquotation');
// get quotation detail to modal
Route::post('/modalloadQTDetail', 'QuotationController@fnModalloadQT');
// function insert new spare to quotation detail
Route::post('/insertQtdetaildata', 'QuotationController@fnInsertQtdetaildata');
// trash qt_detail list
Route::post('/trashQtlist', 'QuotationController@fnTrashQtlist');
// function edit quotation
Route::post('/loadQuotations', 'QuotationController@fnloadQuotations');
// function update quotation
Route::post('/updatequotations', 'QuotationController@fnUpdatequotations')->name('updatequotations');
// route delete quotation data
Route::get('/deleteQuotation/{qtid}', 'QuotationController@fnDeleteQuo');
// print quotation
Route::get('/printQuotation/{qtid}', 'QuotationController@fnPrintQuotation');
// search quotation data
Route::post('/searchQuotation', 'QuotationController@fnSearchQuotation');
//////////////////////////////////// END QUOTATION ///////////////////////////////////

//////////////////////////////////// NEW CUSTOMER //////////////////////////////////////
// form insert new customer page
Route::get('/newcustomer', 'CustomerController@index')->name('newcustomer');
// insert new customer
Route::post('/innewcustomer', 'CustomerController@fnInsertNewCus')->name('innewcustomer');
// insert new car of old customer page
Route::get('/newcaroldcus', 'CustomerController@fnNewcarOldcus')->name('newcaroldcus');
// insert new car data of old cus
Route::post('/insertNewcaroldcus', 'CustomerController@fnInsertNewcaroldcus')->name('insertNewcaroldcus');

// customer list
Route::get('/customerlist', 'CustomerController@fnCustomerlist')->name('customerlist');
// car data
Route::get('/carsdata/{carid}', 'CustomerController@fnCarsdata');

//////////////////////////////////// END CUSTOMER //////////////////////////////////////

//////////////////////////// START NEW APPOINTMENT ROUTE /////////////////////////
// route to get appointment page
Route::get('/appointment', 'AppointController@index')->name('appointment');
// route to get new appointment page
Route::get('/newapppointment', 'AppointController@fnNewAppointment')->name('newappointment');
Route::post('/innewappoint', 'AppointController@fnInnewappoint')->name('innewappoint');
////////////////////////// END NEW APPOINTMENT ROUTE///////////////////////////

///////////////////////// START NEW APPOINTMENT OLD CUSTOMER //////////////////////
/// ROUTE TO SHOW PAGE
Route::get('/oldappointment', 'AppointController@fnOldAppointment')->name('oldappointment');
/// Route to load car
Route::get('/loadCars', 'AppointController@fnloadCars');
/// Route to add new appointment of old customer
Route::post('/inoldcus', 'AppointController@fnInappoldcus')->name('inoldcus');
// Route to show appointment today
Route::get('/appointmenttoday', 'AppointController@fnAppointmentToday')->name('appointmenttoday');
/// Route to show other data in appointment of today
Route::get('/loadOtherData/{carid}', 'AppointController@fnloadOtherData');
/// Route to show appointment this month
Route::get('/appointmentmonth', 'AppointController@fnAppointmentMonth')->name('appointmentmonth');
/// Route to load appointment month data
Route::get('/loadapmonth/{carid}', 'AppointController@fnLoadApmonth');

////////////////////////////// APPOINTMENT SETTING /////////////////////////////
/// Route show customer setting page
Route::get('/customer_setting', 'ApSettingController@fnCusSetting')->name('customer_setting');
/// Route to search customer data
Route::post('/searchcusbyid', 'ApSettingController@fnSearchcusbyid');
/// Route show customer data
Route::get('/loadcusedit/{cusid}', 'ApSettingController@fnloadCusedit');
/// Route edit customer data
Route::post('/editcustomdata', 'ApSettingController@fnEditCusdata')->name('editcustomdata');
// Route delete customer data
Route::get('/delcustomer/{cusid}', 'ApSettingController@fnDelCusdata');
// Route show page for manage car data
Route::get('/car_setting', 'ApSettingController@fnCarSetting')->name('car_setting');
// search car data for edit
Route::post('/searchcarbylicense', 'ApSettingController@fnSearchcarbylicense');
// Route load car data to edit form
Route::get('/loadCartoEdit/{carid}', 'ApSettingController@fnloadCartoEdit');
// Route update car data
Route::post('/updatecar', 'ApSettingController@fnUpdateCar')->name('updatecar');
// Route delete car data
Route::get('/deleteCar/{carid}', 'ApSettingController@fnDeleteCar');

///////////////////////////// list repair //////////////////////
//route to show repair list 
Route::get('/listrepair', 'ApSettingController@fnListRepair')->name('listrepair');
// route to load car data to list repair page
Route::get('/loadCarsdata', 'ApSettingController@fnloadCarsdata');
// Route to load Appointment to list repair page
Route::get('/loadAppointment', 'ApSettingController@fnloadAppointment');
// Route to load list repair page
Route::get('/loadRepair', 'ApSettingController@fnloadRepair');
// Route to insert new list
Route::post('/insertList', 'ApSettingController@fnInsertList');
// Route to get repair to edit form
Route::get('/loadRepairtoEdit/{repairid}', 'ApSettingController@fnloadRepairtoEdit');
// Route to update list data
Route::post('/updateRepairlist', 'ApSettingController@fnUpdateRepair');
// Route to delete repair data
Route::get('/deleteRepair/{repairid}', 'ApSettingController@fndeleteRepair');
///////////////////////// setting appointment ////////////////////////
// Route to show appointment list page
Route::get('/ap_setting', 'ApSettingController@fnAppointmentSetting')->name('ap_setting');
// Route to get appointment data to edit form
Route::get('/getAppointment/{apid}', 'ApSettingController@fngetAppointment');
// Route to update appointment time and date
Route::post('/updateAppointment', 'ApSettingController@fnUpdateAppointment');
// Route to delete appointment time and date
Route::get('/deleteAppointment/{apid}', 'ApSettingController@fnDeleteAppointment');

///////////////////////////////// Car brand setting /////////////////////////////
// Route to show car brand setting page
Route::get('/brand_setting', 'ApSettingController@fnBrandSetting')->name('brand_setting');
// Route to load brand to show on table
Route::get('/loadBrand', 'ApSettingController@fnloadBrand');
// Route insert new brand
Route::post('/insertNewbrand', 'ApSettingController@fnInsertBrand');
// Route to get brand data to edit form
Route::get('/getBrand/{brandid}', 'ApSettingController@fnGetbrand');
// Route to update brand data
Route::post('/updateBrand', 'ApSettingController@fnUpdateBrand');
// Route to delete brand data
Route::post('/deleteBrand', 'ApSettingController@fnDeleteBrand');

//////////////////////////////////// APPOINTMENT REPORT ///////////////////////////////////

//////////////////////////////////// CUSTOMER REPORT ////////////////////////
/// Route to show customer of appointment
Route::get('/reportcustomer', 'CrmReportController@fnReportCus')->name('reportcustomer');
/// Route to load customer to show on table
Route::get('/loadCustomer', 'CrmReportController@fnLoadCustomer');
// Route to print report customer
Route::post('/printCustomer', 'CrmReportController@fnprintCustomer')->name('printCustomer');

//////////////////////////////////// CARS REPORT ///////////////////////////
/// Route to show car of appointment
Route::get('/reportcars', 'CrmReportController@fnReportCar')->name('reportcars');
/// Route to load car to show on table
Route::get('/loadAllcars', 'CrmReportController@fnloadAllcars')->name('loadAllcars');
// Route to load car by customer id
Route::post('/loadCuscars', 'CrmReportController@fnloadCuscars')->name('loadCuscars');
// Route to load car by brandid
Route::post('/loadBrandcar', 'CrmReportController@fnloadBrandcar')->name('loadBrandcar');
// Route to print report car data
Route::post('/printCarReport', 'CrmReportController@fnprintCarReport')->name('printCarReport');
///////////////////////////////////// REPAIR REPORT ////////////////////////////
// Route to show repair of appointment to report
Route::get('/reportrepair', 'CrmReportController@fnReportRepair')->name('reportrepair');
// Route to load Car by customer to show on select
Route::post('/loadRepairCars', 'CrmReportController@fnloadRepairCars')->name('loadRepairCars');
// Route to load Repair date by customer and car data to show on select
Route::post('/loadRepairDate', 'CrmReportController@fnloadRepairDate')->name('loadRepairDate');
// Route to load Repair data to show on table
Route::post('/loadRepairData', 'CrmReportController@fnloadRepairData')->name('loadRepairData');
// Route to print repair data
Route::post('/printRepair', 'CrmReportController@fnprintRepair')->name('printRepair');

/////////////////////////////// APPOINTMENT REPORT ////////////////////////////////
// Route to show appointment report page
Route::get('/reportAppointment', 'CrmReportController@fnReportAppoint')->name('reportAppointment');
// Route to show appointment today
Route::get('/reportAppointToday', 'CrmReportController@fnreportAppToday');
// Route to show appointment of this month
Route::get('/reportAppointMonth', 'CrmReportController@fnReportAppMonth');
// Route to show appointment by customer id
Route::post('/reportAppCus', 'CrmReportController@fnReportAppCus');
// Route to show appointment by month and year
Route::post('/reportAppByMonth', 'CrmReportController@fnReportAppByMonth');
// Route to print appointment
Route::post('/printAppointment', 'CrmReportController@fnPrintAppReport')->name('printAppointment');

/////////////////////////////////// SHOW APPOINTMENT COUNT CUSTOMER ///////////////////////////////
Route::post('/showCountApp', 'AppointController@fnshowCountApp');
/////////////////////////////////////////////////// CRM ////////////////////////////////////////////////////