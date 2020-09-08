<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Validator, Response;
use Illuminate\Support\Str;

class AppointController extends Controller
{
    //function get customer type to show on pie chart
    public function fnloadTypeCus()
    {
        $month = date('Y-m');
        // $data2 = array();
        $normal = count(DB::table('appointmentview')->where('ap_date', 'like', '%'.$month.'%')->where('tcusid', '=', '1')->get());
        $company = count(DB::table('appointmentview')->where('ap_date', 'like', '%'.$month.'%')->where('tcusid', '=', '2')->get());
        $regiment = count(DB::table('appointmentview')->where('ap_date', 'like', '%'.$month.'%')->where('tcusid', '=', '3')->get());
        $organize = count(DB::table('appointmentview')->where('ap_date', 'like', '%'.$month.'%')->where('tcusid', '=', '4')->get());
        $embassy = count(DB::table('appointmentview')->where('ap_date', 'like', '%'.$month.'%')->where('tcusid', '=', '5')->get());
        $data = array(
            array("y"=>$company,"label"=>"ລູກ​ຄ້າ​​ບໍ​ລິ​ສັດ", "indexLabelFontFamily"=>"Phetsarath OT"),
            array("y"=>$normal,"label"=>"ລູກ​ຄ້າ​ທົ່ວ​ໄປ", "indexLabelFontFamily"=>"Phetsarath OT"),
            array("y"=>$regiment,"label"=>"ຫ້ອງ​ການ​ລັດ", "indexLabelFontFamily"=>"Phetsarath OT"),
            array("y"=>$organize,"label"=>"ອົງ​ການ​ຈ​ັດ​ຕັ້ງ​ສາ​ກົນ", "indexLabelFontFamily"=>"Phetsarath OT"),
            array("y"=>$embassy,"label"=>"ສະ​ຖານ​ທູດ", "indexLabelFontFamily"=>"Phetsarath OT"));
        // array_push($data2, $data);
        echo json_encode($data);
    }

    // function get customer amount to show on column chart
    public function fnloadCusofMonth()
    {
        $year = date('Y');
        $events = array();
        // $tomonth = array("ມັງ​ກອນ","ກຸມ​ພາ","ມີ​ນາ","ເມ​ສາ","ພຶດ​ສະ​ພາ","ມີ​ຖຸ​ນາ","ກໍ​​ລະ​ກົດ","ສິງ​ຫາ","ກັນ​ຍາ","ຕຸ​ລາ","ພະ​ຈິກ","ທັນ​ວາ");
        for ($i = 1; $i <= 12; $i++){
            if(strlen($i) == 1){
                $a = '0'.$i;
                $month = DB::table('appointmentview')->where('ap_date', 'LIKE', '%'.$year.'-'.$a.'%')->get();
                $countrow = count($month);
            }else{
                $a = $i;
                $month = DB::table('appointmentview')->where('ap_date', 'LIKE', '%'.$year.'-'.$a.'%')->get();
                $countrow = count($month);
            }
            $event = array("label"=>"ເດືອນ ".$i, "y"=>$countrow, "indexLabelFontFamily"=>"Phetsarath OT");
            array_push($events, $event);
        }
        echo json_encode($events);
    }


    // function to first page of appointment process
    public function index(){
      $newcustomertoday = date('Y-m-d');
      $todaynewcustomer = DB::table('customers')->where('created_at', 'like', '%'.$newcustomertoday.'%')->get();
      $newcustomermonth = date('Y-m');
      $monthnewcustomer = DB::table('customers')->where('created_at', 'like', '%'.$newcustomermonth.'%')->get();
      return view('manage/crm/index')->with('todaynewcustomer', $todaynewcustomer)->with('monthnewcustomer', $monthnewcustomer);
    }

    // function show new appointment page
    public function fnNewAppointment(){
        $customers = DB::table('customers')->orderBy('cusid', 'desc')->take(1)->get();
        foreach ($customers as $data) {
            $customer = $data->cusid;
        }
        if(count($customers) > 0){
            $substr = Str::substr($customer, 3);
            $sum = (int)$substr + 1;
            $cus = strlen($sum);
            if($cus == 1){
                $cusid = "00".$sum;
            }elseif($cus == "2"){
                $cusid = "0".$sum;
            }else{
                $cusid = $sum;
            }
        }else{
            $cusid = "001";
        }
        $cars = DB::table('cars')->orderBy('carid', 'desc')->take(1)->get();
        foreach ($cars as $row) {
            $car = $row->carid;
        }
        if(count($cars) > 0){
            $substr = Str::substr($car, 1);
            $sum = (int)$substr + 1;
            $ca = strlen($sum);
            if($ca == 1){
                $carid = "C000".$sum;
            }elseif($ca == 2){
                $carid = "C00".$sum;
            }elseif($ca == 3){
                $carid = "C0".$sum;
            }else{
                $carid = $sum;
            }
        }else{
            $carid = "C0001";
        }
        $brands = DB::table('brands')->orderBy('brandname', 'asc')->get();
        $province = DB::table('provinces')->get();
        $typecus = DB::table('typecuses')->get();
        return view('manage/crm/newappoint')->with('province', $province)
                                            ->with('typecus', $typecus)
                                            ->with('cusid', $cusid)
                                            ->with('carid', $carid)
                                            ->with('brands', $brands);
    }

    // function printappoint bill
    public function fnInnewappoint(Request $req){
        $this->validate($req, [
            // check customer data not empty
            'disid' => 'required','proid' => 'required','tcusid' => 'required',
            // check customer's car data not empty
            'brandid' => 'required',
            // check repair list to repair
            'repair' => 'required',
            // check appointment time and date
            'ap_time' => 'required','ap_time' => 'required'
        ]);
        // customer data
        $cusid = $req->input('cusid');$cusname = $req->input('cusname');$lastname = $req->input('lastname');
        $village = $req->input('village');$proid = $req->input('proid');
        $disid = $req->input('disid');$mobile = $req->input('mobile');$phone = $req->input('phone');
        $occupation = $req->input('occupation');$workaddress = $req->input('workadd');$status = $req->input('status');
        $tcusid = $req->input('tcusid');
        // car data
        $carid = $req->input('carid');$license = $req->input('license');
        $brandid = $req->input('brandid');$model = $req->input('model');$madeyear = $req->input('madeyear');
        $color = $req->input('color');$distance = $req->input('distance');$motor = $req->input('motor');
        // list repair data
        $repair = $req->input('repair');
        // appointment time and date
        $ap_time = $req->input('ap_time');$ap_date = $req->input('ap_date');

        $customdata = array(
            'cusid' => $cusid,'name'=>$cusname,'lastname'=>$lastname,'village'=>$village,'proid'=>$proid,
            'disid'=>$disid,'mobile'=>$mobile,'phone'=>$phone,'occupation'=>$occupation,'workaddress'=>$workaddress,'tcusid'=>$tcusid,
            'status'=>$status,'created_at'=>date('Y-m-d H:i:s')
        );

        if($madeyear == ""){
            $cardata = array(
                'carid'=>$carid,'license'=>$license,'brandid'=>$brandid,'model'=>$model,'color'=>$color,
                'distance'=>$distance,'motor'=>$motor,'cusid'=>$cusid,'created_at'=>date('Y-m-d H:i:s')
            );
        }else{
            $cardata = array(
                'carid'=>$carid,'license'=>$license,'brandid'=>$brandid,'model'=>$model,'madeyear'=>$madeyear,
                'color'=>$color,'distance'=>$distance,'motor'=>$motor,'cusid'=>$cusid,'created_at'=>date('Y-m-d H:i:s')
            );
        }
        
        $lstatus = 0;
        for($i=0; $i<count($repair); $i++){
            $listdata =array(
                'cusid' => $cusid,'carid' => $carid,'list' => $repair[$i],
                'datelist' => $ap_date,'status' => $lstatus,'created_at'=>date('Y-m-d H:i:s')
            );
            $inlist[] = $listdata;
        }

        $appdata = array(
            'cusid'=>$cusid,'carid'=>$carid,'ap_time'=>$ap_time,'ap_date'=>$ap_date,'created_at'=>date('Y-m-d H:i:s')
        );

        $appbill = array('cusid'=>$cusid,'carid'=>$carid,'ap_date'=>$ap_date,'created_at'=>date('Y-m-d H:i:s'));
        // command insert data
        DB::table('customers')->insert($customdata);
        DB::table('cars')->insert($cardata);
        DB::table('repair')->insert($inlist);
        DB::table('appointments')->insert($appdata);
        DB::table('appointmentbill')->insert($appbill);

        $customers = DB::table('customdata')->where('cusid', $cusid)->get();
        $cardata = DB::table('cardata')->where('carid', $carid)->get();
        $listdata = DB::table('repair')->where('cusid', $cusid)->where('carid', $carid)->where('datelist', $ap_date)->get();
        $appointment = DB::table('appointments')->where('cusid', $cusid)->where('carid', $carid)->where('ap_date', $ap_date)->get();
        $billid = DB::table('appointmentbill')->where('cusid', $cusid)->where('carid', $carid)->where('ap_date', $ap_date)->get();
        return view('manage/crm/appbill')->with('customers', $customers)
                                         ->with('cardata', $cardata)
                                         ->with('listdata', $listdata)
                                         ->with('appointment', $appointment)
                                         ->with('billid', $billid);
    }

    /// function to show add new appointment of old customer
    public function fnOldAppointment(){
        $cars = DB::table('cars')->orderBy('carid', 'desc')->take(1)->get();
        foreach ($cars as $row) {
            $car = $row->carid;
        }
        if(count($cars) > 0){
            $substr = Str::substr($car, 1);
            $sum = (int)$substr + 1;
            $ca = strlen($sum);
            if($ca == 1){
                $carid = "C000".$sum;
            }elseif($ca == 2){
                $carid = "C00".$sum;
            }elseif($ca == 3){
                $carid = "C0".$sum;
            }else{
                $carid = $sum;
            }
        }else{
            $carid = "C0001";
        }
        $brands = DB::table('brands')->orderBy('brandname', 'asc')->get();
        $customers = DB::table('customers')->get();
        return view('manage/crm/oldappoint')->with('customers', $customers)
                                            ->with('brands', $brands)
                                            ->with('carid', $carid);
    }

    /// function to load car data by customer id
    public function fnloadCars(Request $req){
        if($req->ajax()){
            $result = '';
            $query = $req->get('query');
            $cars = DB::table('cars')->where('cusid', $query)->get();
            if(count($cars) > 0){
                    $result .='
                    <option value="">***** ເລືອກ​ລົດ​ລ​ູກ​ຄ້າ *****</option>
                    <option value="newcar">ເພີ່ມ​ລົດ​ໃໝ່</option>';
                foreach($cars as $row){
                    $result .='
                        <option value="'.$row->carid.'">'.$row->license.'</option>
                    ';
                }
            }else{
                $result .='<option value="">*** ກະ​ລຸ​ນາເລືອກ​ເຈົ້າ​ຂອງ​ລົດກ່ອນ ***</option>';
            }
            $data = array('result' => $result);
            echo json_encode($data);
        }
    }

    // function to insert new appointment old customer
    public function fnInappoldcus(Request $req){
        if($req->input('selectcar') == "newcar"){
            $this->validate($req, [
                'cusid' => 'required',
                'carid' => 'required',
                'license' => 'required',
                'brandid' => 'required',
                'model' => 'required',
                'color' => 'required',
                'distance' => 'required',
                'motor' => 'required',
                'repair' => 'required',
                'ap_time' => 'required',
                'ap_date' => 'required'
            ]);
            $custatus = "ເຄີຍ";
            $cusid = $req->input('cusid');
            $carid = $req->input('carid');$license = $req->input('license');
            $brandid = $req->input('brandid');$model = $req->input('model');$madeyear = $req->input('madeyear');$color = $req->input('color');
            $distance = $req->input('distance');$motor = $req->input('motor');
            
            $repair = $req->input('repair');

            $ap_time = $req->input('ap_time');
            $ap_date = $req->input('ap_date');
            
            $cuseditstatus = array('status' => $custatus);

            $cardata = array(
                'carid'=>$carid,'license'=>$license,'brandid'=>$brandid,'model'=>$model,'madeyear'=>$madeyear,
                'color'=>$color,'distance'=>$distance,'motor'=>$motor,'cusid'=>$cusid,'created_at'=>date('Y-m-d H:i:s')
            );

            $lstatus = 0;
            for($i=0; $i<count($repair); $i++){
                $listdata =array(
                    'cusid' => $cusid,'carid' => $carid,'list' => $repair[$i],
                    'datelist' => $ap_date,'status' => $lstatus,'created_at' => date('Y-m-d H:i:s')
                );
                $inlist[] = $listdata;
            }

            $appdata = array(
                'cusid'=>$cusid,'carid'=>$carid,'ap_time'=>$ap_time,'ap_date'=>$ap_date,'created_at' => date('Y-m-d H:i:s')
            );
    
            $appbill = array('cusid'=>$cusid,'carid'=>$carid,'ap_date'=>$ap_date,'created_at' => date('Y-m-d H:i:s'));

            DB::table('customers')->where('cusid', $cusid)->update($cuseditstatus);
            DB::table('cars')->insert($cardata);
            DB::table('repair')->insert($inlist);
            DB::table('appointments')->insert($appdata);
            DB::table('appointmentbill')->insert($appbill);

            $customers = DB::table('customdata')->where('cusid', $cusid)->get();
            $cardata = DB::table('cardata')->where('carid', $carid)->get();
            $listdata = DB::table('repair')->where('cusid', $cusid)->where('carid', $carid)->where('datelist', $ap_date)->get();
            $appointment = DB::table('appointments')->where('cusid', $cusid)->where('carid', $carid)->where('ap_date', $ap_date)->get();
            $billid = DB::table('appointmentbill')->where('cusid', $cusid)->where('carid', $carid)->where('ap_date', $ap_date)->get();
            return view('manage/crm/appbill')->with('customers', $customers)
                                            ->with('cardata', $cardata)
                                            ->with('listdata', $listdata)
                                            ->with('appointment', $appointment)
                                            ->with('billid', $billid);

        }else{
            $this->validate($req, [
                'cusid' => 'required',
                'selectcar' => 'required',
                'repair' => 'required',
                'ap_time' => 'required',
                'ap_date' => 'required'
            ]);
            $custatus = "ເຄີຍ";
            $cusid = $req->input('cusid');
            $carid = $req->input('selectcar');
            $repair = $req->input('repair');

            $ap_time = $req->input('ap_time');
            $ap_date = $req->input('ap_date');

            $cuseditstatus = array('status' => $custatus);

            $lstatus = 0;
            for($i=0; $i<count($repair); $i++){
                $listdata =array(
                    'cusid' => $cusid,'carid' => $carid,'list' => $repair[$i],
                    'datelist' => $ap_date,'status' => $lstatus,'created_at' => date('Y-m-d H:i:s')
                );
                $inlist[] = $listdata;
            }
            $appdata = array(
                'cusid'=>$cusid,'carid'=>$carid,'ap_time'=>$ap_time,'ap_date'=>$ap_date,'created_at' => date('Y-m-d H:i:s')
            );
    
            $appbill = array('cusid'=>$cusid,'carid'=>$carid,'ap_date'=>$ap_date,'created_at' => date('Y-m-d H:i:s'));

            DB::table('customers')->where('cusid', $cusid)->update($cuseditstatus);
            DB::table('repair')->insert($inlist);
            DB::table('appointments')->insert($appdata);
            DB::table('appointmentbill')->insert($appbill);

            $customers = DB::table('customdata')->where('cusid', $cusid)->get();
            $cardata = DB::table('cardata')->where('carid', $carid)->get();
            $listdata = DB::table('repair')->where('cusid', $cusid)->where('carid', $carid)->where('datelist', $ap_date)->get();
            $appointment = DB::table('appointments')->where('cusid', $cusid)->where('carid', $carid)->where('ap_date', $ap_date)->orderBy('apid', 'desc')->take(1)->get();
            $billid = DB::table('appointmentbill')->where('cusid', $cusid)->where('carid', $carid)->where('ap_date', $ap_date)->get();
            return view('manage/crm/appbill')->with('customers', $customers)
                                            ->with('cardata', $cardata)
                                            ->with('listdata', $listdata)
                                            ->with('appointment', $appointment)
                                            ->with('billid', $billid);
        }
    }

    /// function show appointment today
    public function fnAppointmentToday()
    {  
        $date = date('Y-m-d');
        // $date = date('2020-02-01');
        $appointtoday = DB::table('appointtoday')->where('ap_date', $date)->paginate(20);
        return view('manage/crm/aptoday')->with('appointtoday', $appointtoday);
    }

    /// function show appointment other data of today
    public function fnloadOtherData($carid)
    {
        $date = date('Y-m-d');
        $cars = DB::table('cars')
        ->join('brands', 'brands.brandid', '=', 'cars.brandid')
        ->where('carid', '=', $carid)
        ->select('cars.carid','cars.license','brands.brandname','cars.model','cars.madeyear','cars.color','cars.distance','cars.motor')
        ->get();
        $repair = DB::table('repair')->where('carid', '=', $carid)->where('datelist', '=', $date)->get();
        $result = '';
        //  
        if(count($cars) > 0 && count($repair) > 0){
            foreach($cars as $car){
                $result .= '
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <h5>ລະ​ຫັດ​ລົດ: <b>'.$car->carid.'</b></h5>
                                <h5>ປ້າຍ​ລົດ: <b>'.$car->license.'</b></h5>
                            </div>
                            <div class="col-md-3">
                                <h5>ຍີ່​ຫໍ້​ລົດ: <b>'.$car->brandname.'</b></h5>
                                <h5>ລຸ້ນ: <b>'.$car->model.'</b></h5>
                            </div>
                            <div class="col-md-3">
                                <h5>ປີ​ຜະ​ລິດ: <b>'.$car->madeyear.'</b></h5>
                                <h5>ສີລົດ: <b>'.$car->color.'</b></h5>
                            </div>
                            <div class="col-md-3">
                                <h5>​ເລກ​ກົງ​ເຕີ: <b>'.$car->distance.'</b></h5>
                                <h5>ປະ​ເພດ​ເຄື່ອງ​ຈັກ: <b>'.$car->motor.'</b></h5>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            }
            $result .='
            <div class="row">
                <div class="col-md-12">
                    <h4 class="modal-title" id="myExtraLargeModalLabel"><i class="mdi mdi-car"></i> <b>ລາຍ​ການ​ສ້ອມ</b></h4>
                    <ul>';
            foreach($repair as $rp){
                $result .= '
                            <li>'.$rp->list.'</li>
                ';
            }
            $result .= '
                    </ul>
                </div>
            </div>
            ';
        }else{
            $result .= '
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-center">ບໍ່​ມີ​ຂໍ້​ມູນ</h4>
                </div>
            </div>
            ';
        }
        $data = array('result'=>$result);
        echo json_encode($data);
    }

    //function show appointment this month
    public function fnAppointmentMonth()
    {
        $date = date('Y-m');
        $appointmonth = DB::table('appointtoday')->where('ap_date', 'like', '%'.$date.'%')->paginate(20);
        return view('manage/crm/apmonth')->with('appointmonth', $appointmonth);
    }
    public function fnLoadApmonth($carid)
    {
        $date = date('Y-m');
        $cars = DB::table('cars')
        ->join('brands', 'brands.brandid', '=', 'cars.brandid')
        ->where('carid', '=', $carid)
        ->select('cars.carid','cars.license','brands.brandname','cars.model','cars.madeyear','cars.color','cars.distance','cars.motor')
        ->get();
        $repair = DB::table('repair')->where('carid', '=', $carid)->where('datelist', 'like', '%'.$date.'%')->get();
        $result = '';
        //  
        if(count($cars) > 0 && count($repair) > 0){
            foreach($cars as $car){
                $result .= '
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <h5>ລະ​ຫັດ​ລົດ: <b>'.$car->carid.'</b></h5>
                                <h5>ປ້າຍ​ລົດ: <b>'.$car->license.'</b></h5>
                            </div>
                            <div class="col-md-3">
                                <h5>ຍີ່​ຫໍ້​ລົດ: <b>'.$car->brandname.'</b></h5>
                                <h5>ລຸ້ນ: <b>'.$car->model.'</b></h5>
                            </div>
                            <div class="col-md-3">
                                <h5>ປີ​ຜະ​ລິດ: <b>'.$car->madeyear.'</b></h5>
                                <h5>ສີລົດ: <b>'.$car->color.'</b></h5>
                            </div>
                            <div class="col-md-3">
                                <h5>​ເລກ​ກົງ​ເຕີ: <b>'.$car->distance.'</b></h5>
                                <h5>ປະ​ເພດ​ເຄື່ອງ​ຈັກ: <b>'.$car->motor.'</b></h5>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            }
            $result .='
            <div class="row">
                <div class="col-md-12">
                    <h4 class="modal-title" id="myExtraLargeModalLabel"><i class="mdi mdi-car"></i> <b>ລາຍ​ການ​ສ້ອມ</b></h4>
                    <ul>';
            foreach($repair as $rp){
                $result .= '
                            <li>'.$rp->list.'</li>
                ';
            }
            $result .= '
                    </ul>
                </div>
            </div>
            ';
        }else{
            $result .= '
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-center">ບໍ່​ມີ​ຂໍ້​ມູນ</h4>
                </div>
            </div>
            ';
        }
        $data = array('result'=>$result);
        echo json_encode($data);
    }
    ///////////////////// show count customer appointment /////////////////////
    public function fnshowCountApp(Request $req)
    {
        $today = date('Y-m-d');
        $month = date('Y-m');
        $counttoday = count(DB::table('appointmentview')->where('ap_date', $today)->get());
        $countmonth = count(DB::table('appointmentview')->where('ap_date', 'like', '%'.$month.'%')->get());
        $countcompany = count(DB::table('appointmentview')->where('ap_date', 'like', '%'.$month.'%')->where('tcusname', 'like', '%ບໍ​ລິ​ສັດ%')->get());
        $countother = count(DB::table('appointmentview')->where('ap_date', 'like', '%'.$month.'%')->whereNotIn('tcusid', [2])->get());
        $data = array('counttoday' => $counttoday, 'countmonth' => $countmonth, 'countcompany' => $countcompany, 'countother'=>$countother);
        return json_encode($data);
    }
}