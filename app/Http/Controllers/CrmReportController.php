<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Response, Validator;

class CrmReportController extends Controller
{
    /////////////////////////////////////////// CUSTOMER REPORT //////////////////////////////////
    //function show report Customer
    public function fnReportCus()
    {
        $typecus = DB::table('typecuses')->get();
        return view('manage/crm/reportcus')->with('typecus', $typecus);
    }

    // function load customer to show on table
    public function fnLoadCustomer(Request $req)
    {
        $result = "";
        $query = $req->get('query');
        $customers = DB::table('customdata')->where('tcusid', $query)->get();
        $count = count($customers);
        if($count > 0){
            foreach($customers as $cus){
                $result .= '
                <tr>
                    <td>'.$cus->cusid.'</td>
                    <td>'.$cus->name.'</td>
                    <td>'.$cus->lastname.'</td>
                    <td>'.$cus->village.'</td>
                    <td>'.$cus->disname.'</td>
                    <td>'.$cus->proname.'</td>
                    <td>'.$cus->mobile.'</td>
                    <td>'.$cus->phone.'</td>
                    <td>'.$cus->occupation.'</td>
                    <td>'.$cus->workaddress.'</td>
                    <td>'.$cus->tcusname.'</td>
                    <td>'.$cus->status.'</td>
                </tr>
                ';
            }
        }else{
            $result .= '
            <tr>
                <td class="text-center" colspan="13"><h4>ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ປະ​ເພດ​ລ​ູກ​ຄ້າ​ປະ​ເພດ​ນີ້​ເທື່ອ</h4></td>
            </tr>
            ';
        }
        $data = array('count' => $count, 'result' => $result);
        echo json_encode($data);
    }

    // function print customer report
    public function fnprintCustomer(Request $req)
    {
        $query = $req->input('tcusid');
        $customers = DB::table('customdata')->where('tcusid', $query)->get();
        $count = count($customers);
        return view('manage/crm/printcustomer')->with('customers', $customers)
                                               ->with('count', $count);
    }

    /////////////////////////////////////////// Function Car report////////////////////////
    /// Form report car data page
    public function fnReportCar()
    {
        $brands = DB::table('brands')->orderBy('brandname', 'asc')->get();
        $customers = DB::table('customers')->get();
        return view('manage/crm/reportcar')->with('customers', $customers)                       
                                            ->with('brands', $brands);
    }

    // function load cars data
    public function fnloadAllcars(Request $req)
    {
        $result = "";
        $cardata = DB::table('carandcus')->get();
        $count = count($cardata);
        if($count > 0){
            foreach ($cardata as $row) {
                $result .= '
                <tr>
                  <td>'.$row->carid.'</td>
                  <td>'.$row->license.'</td>
                  <td>'.$row->motornum.'</td>
                  <td>'.$row->bodynum.'</td>
                  <td>'.$row->brandname.'</td>
                  <td>'.$row->model.'</td>
                  <td>'.$row->madeyear.'</td>
                  <td>'.$row->color.'</td>
                  <td>'.$row->distance.'</td>
                  <td>'.$row->motor.'</td>
                  <td>'.$row->cusid.'</td>
                  <td>'.$row->name.' '.$row->lastname.'</td>
                </tr>
                ';
            }
        }else{
            $result .= '
                <tr>
                    <td colspan="10" class="text-center"><h4>ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ລົດ​ໃນ​ລະ​ບົບ</h4></td>
                </tr>
                ';
        }
        $data = array('result'=>$result,'count'=>$count);
        echo json_encode($data);
    }

    public function fnloadCuscars(Request $req)
    {
        $result = "";
        $cusid = $req->cusid;
        $cuscars = DB::table('carandcus')->where('cusid', $cusid)->get();
        $count = count($cuscars);
        if($count > 0){
            foreach ($cuscars as $row) {
                $result .= '
                <tr>
                  <td>'.$row->carid.'</td>
                  <td>'.$row->license.'</td>
                  <td>'.$row->motornum.'</td>
                  <td>'.$row->bodynum.'</td>
                  <td>'.$row->brandname.'</td>
                  <td>'.$row->model.'</td>
                  <td>'.$row->madeyear.'</td>
                  <td>'.$row->color.'</td>
                  <td>'.$row->distance.'</td>
                  <td>'.$row->motor.'</td>
                  <td>'.$row->cusid.'</td>
                  <td>'.$row->name.' '.$row->lastname.'</td>
                </tr>
                ';
            }
        }else{
            $result .= '
                <tr>
                    <td colspan="10" class="text-center"><h4>ຍັງ​ບໍ່​ມີ​ລົດ​ຂອງ​ລູກ​ຄ້າ​ຄົນ​ນີ້​ເທື່ອ</h4></td>
                </tr>
                ';
        }
        
        $data = array('result'=>$result,'count'=>$count);
        echo json_encode($data);
    }

    public function fnloadBrandcar(Request $req)
    {
        $result = "";
        $brandid = $req->brandid;
        $brandcars = DB::table('carandcus')->where('brandid', $brandid)->get();
        $count = count($brandcars);
        if($count > 0){
            foreach ($brandcars as $row) {
                $result .= '
                <tr>
                  <td>'.$row->carid.'</td>
                  <td>'.$row->license.'</td>
                  <td>'.$row->motornum.'</td>
                  <td>'.$row->bodynum.'</td>
                  <td>'.$row->brandname.'</td>
                  <td>'.$row->model.'</td>
                  <td>'.$row->madeyear.'</td>
                  <td>'.$row->color.'</td>
                  <td>'.$row->distance.'</td>
                  <td>'.$row->motor.'</td>
                  <td>'.$row->cusid.'</td>
                  <td>'.$row->name.' '.$row->lastname.'</td>
                </tr>
                ';
            }
        }else{
            $result .= '
                <tr>
                    <td colspan="10" class="text-center"><h4>ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນລົດທີ່​ເປັນ​ຍີ່​ຫໍ້​ນີ້​ເທື່ອ</h4></td>
                </tr>
                ';
        }
        
        $data = array('result'=>$result,'count'=>$count);
        echo json_encode($data);
    }
    //function print car data
    public function fnprintCarReport(Request $req)
    {
        $style = $req->input('reportstyle');
        if($style == "1"){
            $cardata = DB::table('carandcus')->get();
            $count = count($cardata);
        }elseif($style == "2"){
            $cusid = $req->input('cusid');
            $cardata = DB::table('carandcus')->where('cusid', $cusid)->get();
            $count = count($cardata);
        }elseif($style == "3"){
            $brandid = $req->input('brandid');
            $cardata = DB::table('carandcus')->where('brandid', $brandid)->get();
            $count = count($cardata);
        }
        return view('manage/crm/printcars')->with('cardata', $cardata)
                                            ->with('count', $count);
    }

    /////////////////////////////////// FUNCTION REPAIR REPORT ///////////////////////////////
    // report repair data page
    public function fnReportRepair()
    {
        $customers = DB::table('customers')->get();
        return view('manage/crm/reportrepair')->with('customers', $customers);
    }

    // function load car by customer id
    public function fnloadRepairCars(Request $req)
    {
        $result = "";
        $cusid = $req->post('query');
        $cars = DB::table('cars')->where('cusid', $cusid)->get();
        if(count($cars) > 0){
            $result .= '<option value="">***** ເລືອກລົດ *****</option>';
            foreach ($cars as $car) {
                $result .= '
                    <option value="'.$car->carid.'">'.$car->license.'</option>
                ';
            }
        }else{
            $result .= '<option value="">ບໍ່​ມີ​ລົດ​ຂອງ​ລູກ​ຄ້າ​ຄົນ​ນີ້</option>';
        }
        $data = array('result' => $result);
        echo json_encode($data);
    }

    // fucntion load repair date by customer and car data
    public function fnloadRepairDate(Request $req)
    {
        $result = "";
        $cusid = $req->post('cusid');
        $carid = $req->post('carid');
        $date = date('Y-m-d');
        $appointments = DB::table('appointments')->where('cusid', $cusid)->where('carid', $carid)->get();
        if(count($appointments) > 0){
            $result .= '<option value="">***** ເລືອກວັນ​ທີ່ *****</option><option value="'.$date.'">ມື້​ນີ້('.$date.')</option>';
            foreach ($appointments as $ap) {
                $result .= '<option value="'.$ap->ap_date.'">'.$ap->ap_date.'</option>';
            }
        }else{
            $result .= '<option value="">ຍັງ​ບໍ່​ມີ​ການ​ສ້ອມ​ຂ​ອງ​ລູກ​ຄ້າ ແລະ ລົດ​ຄັນ​ນີ້</option>';
        } 
        $data = array('result' => $result);
        echo json_encode($data);
    }

    // function show repair list on table
    public function fnloadRepairData(Request $req)
    {
        $cusid = $req->post('cusid');
        $carid = $req->post('carid');
        $datelist = $req->post('datelist');
        $cusdata = DB::table('customdata')->where('cusid', $cusid)->get();
        $cardata = DB::table('cardata')->where('carid', $carid)->get();
        $repair = DB::table('repair')->where('cusid', $cusid)->where('carid', $carid)->where('datelist', $datelist)->get();
        if(count($cusdata) > 0 && count($cardata) > 0 && count($repair) > 0){
            foreach ($cusdata as $cus) {
                $cusid = $cus->cusid;
                $name = $cus->name;
                $lastname = $cus->lastname;
                $village = $cus->village;
                $disname = $cus->disname;
                $proname = $cus->proname;
            }
            foreach ($cardata as $car) {
                $carid = $car->carid;
                $license = $car->license;
                $brand = $car->brandname;
                $model = $car->model;
            }
            $list = "";
            $i = 1;
            foreach ($repair as $rp) {
                $list .= '<tr>
                            <td>'.$i++.'</td>
                            <td>'.$rp->list.'</td>
                        </tr>';
            }
            $data = array('cusid'=>$cusid,'name'=>$name,'lastname'=>$lastname,'village'=>$village,'disname'=>$disname,'proname'=>$proname,
            'carid'=>$carid,'license'=>$license,'brand'=>$brand,'model'=>$model,'list'=>$list);
        }else{
            $data = array('cusid'=>$cusid,'name'=>"ບໍ່​ມີ​ຂໍ້​ມູນ​",'lastname'=>"ບໍ່​ມີ​ຂໍ້​ມູນ​",'village'=>"ບໍ່​ມີ​ຂໍ້​ມູນ​",'disname'=>"ບໍ່​ມີ​ຂໍ້​ມູນ​",'proname'=>"ບໍ່​ມີ​ຂໍ້​ມູນ​",
            'carid'=>$carid,'license'=>"ບໍ່​ມີ​ຂໍ້​ມູນ",'brand'=>"ບໍ່​ມີ​ຂໍ້​ມູນ",'model'=>"ບໍ່​ມີ​ຂໍ້​ມູນ​",'list'=>"ບໍ່​ມີ​ຂໍ້​ມູນ");
        }
        echo json_encode($data);
    }

    // function print repair report
    public function fnprintRepair(Request $req)
    {
        $this->validate($req, [
            'cusid' => 'required',
            'carid' => 'required',
            'datelist' => 'required'
        ]);
        $cusid = $req->input('cusid');
        $carid = $req->input('carid');
        $datelist = $req->input('datelist');
        $cusdata = DB::table('customdata')->where('cusid', $cusid)->get();
        $cardata = DB::table('cardata')->where('carid', $carid)->get();
        $repair = DB::table('repair')->where('cusid', $cusid)->where('carid', $carid)->where('datelist', $datelist)->get();
        $count = count($repair);
        return view('manage/crm/printrepair')->with('count', $count)
                                             ->with('cusdata', $cusdata)
                                             ->with('cardata', $cardata)
                                             ->with('repair', $repair);
    }

    ////////////////////////////////////////// Appointment report ////////////////////////////////
    // function show report appointment
    public function fnReportAppoint(Request $req)
    {
        $customers = DB::table('customers')->get();
        return view('manage/crm/reportappoint')->with('customers', $customers);
    }

    // function to get appointment today to show on table
    public function fnreportAppToday()
    {
        $today = date('Y-m-d');
        // $today = date('2020-02-01');
        $result = "";
        $apptoday = DB::table('appointmentview')->where('ap_date', $today)->get();
        $count = count($apptoday);
        if ($count > 0) {
            foreach($apptoday as $apm){
                $result .= '
                <tr>
                    <td>'.$apm->ap_date.'</td>
                    <td>'.$apm->ap_time.'</td>
                    <td>'.$apm->cusid.'</td>
                    <td>'.$apm->name.' '.$apm->lastname.'</td>
                    <td>'.$apm->mobile.'</td>
                    <td>'.$apm->carid.'</td>
                    <td>'.$apm->license.'</td>
                    <td>'.$apm->brandname.'</td>
                    <td>'.$apm->model.'</td>
                    <td>'.$apm->madeyear.'</td>
                    <td>'.$apm->color.'</td>
                    <td>'.$apm->distance.'</td>
                    <td>'.$apm->motor.'</td>
                </tr>
                ';
            }
        } else {
            $result .= '
            <tr>
                <td colspan="13" class="text-center">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ນັດ​ໝາຍ​ໃນ​ລະ​ບົບ</td>
            </tr>
            ';
        }
        $data = array('result'=>$result,'count'=>$count);
        echo json_encode($data);
    }

    // function get appointment of this month
    public function fnReportAppMonth()
    {
        $month = date('Y-m');
        // $today = date('2020-02-01');
        $result = "";
        $apptoday = DB::table('appointmentview')->where('ap_date', 'like', '%'.$month.'%')->get();
        $count = count($apptoday);
        if ($count > 0) {
            foreach($apptoday as $apm){
                $result .= '
                <tr>
                    <td>'.$apm->ap_date.'</td>
                    <td>'.$apm->ap_time.'</td>
                    <td>'.$apm->cusid.'</td>
                    <td>'.$apm->name.' '.$apm->lastname.'</td>
                    <td>'.$apm->mobile.'</td>
                    <td>'.$apm->carid.'</td>
                    <td>'.$apm->license.'</td>
                    <td>'.$apm->brandname.'</td>
                    <td>'.$apm->model.'</td>
                    <td>'.$apm->madeyear.'</td>
                    <td>'.$apm->color.'</td>
                    <td>'.$apm->distance.'</td>
                    <td>'.$apm->motor.'</td>
                </tr>
                ';
            }
        } else {
            $result .= '
            <tr>
                <td colspan="13" class="text-center">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ນັດ​ໝາຍ​ໃນ​ລະ​ບົບ</td>
            </tr>
            ';
        }
        $data = array('result'=>$result,'count'=>$count);
        echo json_encode($data);
    }

    // function get appointment by customer id
    public function fnReportAppCus(Request $req)
    {
        $cusid = $req->cusid;
        $result = "";
        $apptoday = DB::table('appointmentview')->where('cusid', $cusid)->get();
        $count = count($apptoday);
        if ($count > 0) {
            foreach($apptoday as $apm){
                $result .= '
                <tr>
                    <td>'.$apm->ap_date.'</td>
                    <td>'.$apm->ap_time.'</td>
                    <td>'.$apm->cusid.'</td>
                    <td>'.$apm->name.' '.$apm->lastname.'</td>
                    <td>'.$apm->mobile.'</td>
                    <td>'.$apm->carid.'</td>
                    <td>'.$apm->license.'</td>
                    <td>'.$apm->brandname.'</td>
                    <td>'.$apm->model.'</td>
                    <td>'.$apm->madeyear.'</td>
                    <td>'.$apm->color.'</td>
                    <td>'.$apm->distance.'</td>
                    <td>'.$apm->motor.'</td>
                </tr>
                ';
            }
        } else {
            $result .= '
            <tr>
                <td colspan="13" class="text-center">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ນັດ​ໝາຍ​ໃນ​ລະ​ບົບ</td>
            </tr>
            ';
        }
        $data = array('result'=>$result,'count'=>$count);
        echo json_encode($data);
    }

    // function get appointment report by month and year
    public function fnReportAppByMonth(Request $req)
    {
        $month = $req->month;
        $year = $req->year;
        $result = "";
        $apptoday = DB::table('appointmentview')->where('ap_date', 'like', '%'.$year.'-'.$month.'%')->get();
        $count = count($apptoday);
        if ($count > 0) {
            foreach($apptoday as $apm){
                $result .= '
                <tr>
                    <td>'.$apm->ap_date.'</td>
                    <td>'.$apm->ap_time.'</td>
                    <td>'.$apm->cusid.'</td>
                    <td>'.$apm->name.' '.$apm->lastname.'</td>
                    <td>'.$apm->mobile.'</td>
                    <td>'.$apm->carid.'</td>
                    <td>'.$apm->license.'</td>
                    <td>'.$apm->brandname.'</td>
                    <td>'.$apm->model.'</td>
                    <td>'.$apm->madeyear.'</td>
                    <td>'.$apm->color.'</td>
                    <td>'.$apm->distance.'</td>
                    <td>'.$apm->motor.'</td>
                </tr>
                ';
            }
        } else {
            $result .= '
            <tr>
                <td colspan="13" class="text-center">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ນັດ​ໝາຍ​ໃນ​ລະ​ບົບ</td>
            </tr>
            ';
        }
        $data = array('result'=>$result,'count'=>$count);
        echo json_encode($data);
    }

    //function print appointment report
    public function fnPrintAppReport(Request $req)
    {
        $style = $req->input('stylereport');
        if($style == "1"){
            $today = date('Y-m-d');
            $appointments = DB::table('appointmentview')->where('ap_date', $today)->get();
            $count = count($appointments);
        }elseif($style == "2"){
            $month = date('Y-m');
            $appointments = DB::table('appointmentview')->where('ap_date', 'like', '%'.$month.'%')->get();
            $count = count($appointments);
        }elseif($style == "3"){
            $cusid = $req->input('cusid');
            $appointments = DB::table('appointmentview')->where('cusid', $cusid)->get();
            $count = count($appointments);
        }elseif($style == "4"){
            $year = $req->input('year');
            $month = $req->input('month');
            $appointments = DB::table('appointmentview')->where('ap_date', 'like', '%'.$year.'-'.$month.'%')->get();
            $count = count($appointments);
        }

        return view('manage/crm/printappoint')->with('appointments', $appointments)
                                       ->with('count', $count);
    }
}
