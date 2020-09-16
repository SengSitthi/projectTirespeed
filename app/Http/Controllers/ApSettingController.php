<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Response, Validator;

class ApSettingController extends Controller
{
    //////////////////////////////////////////////////////////// customers setting ////////////////////////////////////////////////////
    //function show customer setting
    public function fnCusSetting()
    {
        $customer = DB::table('customdata')->orderBy('cusid', 'desc')->paginate(20);
        $province = DB::table('provinces')->get();
        $typecus = DB::table('typecuses')->get();
        return view('manage/crm/customer')->with('customer', $customer)
                                          ->with('province', $province)
                                          ->with('typecus', $typecus);
    }

    // function load customer data to edit
    public function fnloadCusedit($cusid)
    {
        $customer = DB::table('customers')->where('cusid', $cusid)->get();
        if(count($customer) > 0){
            foreach ($customer as $cus) {
                $id = $cus->cusid;
                $name = $cus->name;
                $lastname = $cus->lastname;
                $village = $cus->village;
                $disid = $cus->disid;
                $proid = $cus->proid; 
                $mobile = $cus->mobile;
                $phone = $cus->phone;
                $occupation = $cus->occupation; 
                $workaddress = $cus->workaddress;
                $tcusid = $cus->tcusid;
                $status = $cus->status;
            }
        }
        $data = array(
            'cusid' =>$id, 'name' =>$name, 'lastname' => $lastname,'village' => $village,'disid' => $disid, 'proid' => $proid,'mobile' => $mobile,
            'phone' => $phone,'occupation' => $occupation,'workaddress' => $workaddress, 'tcusid' => $tcusid,'status' => $status
        );
        echo json_encode($data);
    }

    // function edit customer data
    public function fnEditCusdata(Request $req)
    {
        $this->validate($req, [
            'proid' => 'required',
            'disid' => 'required',
            'tcusid' => 'required'
        ]);

        $editdata = array('name' => $req->input('cusname'),'lastname' => $req->input('lastname'),'village' => $req->input('village'),'disid' => $req->input('disid'),'proid' => $req->input('proid'),'mobile' => $req->input('mobile'),
        'phone' => $req->input('phone'),'occupation' => $req->input('occupation'),'workaddress' => $req->input('workadd'), 'tcusid'=>$req->input('tcusid'),'status'=>$req->input('status'),'updated_at'=>date('Y-m-d H:i:s'));

        DB::table('customers')->where('cusid', $req->input('cusid'))->update($editdata);
        return redirect('customer_setting')->with('success', 'Insert success');
    }
    
    // function download
    public function fnDelCusdata($cusid)
    {
        DB::table('customers')->where('cusid', $cusid)->delete();
        return redirect('customer_setting')->with('success', 'Delete success');
    }
    //////////////////////////////////////////////////////////// Cars setting ////////////////////////////////////////////////////
    /// function show car setting page
    public function fnCarSetting()
    {
        $carandcus = DB::table('carandcus')->paginate(20);
        $brands = DB::table('brands')->orderBy('brandname', 'asc')->get();
        return view('manage/crm/carsetting')->with('carandcus', $carandcus)
                                            ->with('brands', $brands);
    }

    // searkch car by car license
    public function fnSearchcarbylicense(Request $req)
    {
      $result = "";
      $license = $req->license;
      $sqlsearchlicense = DB::table('carandcus')->where('license', 'like', '%'.$license.'%')->get();
      if(count($sqlsearchlicense) > 0){
        foreach ($sqlsearchlicense as $sscl) {
          $result .= '
          <tr>
          <td>'.$sscl->carid.'</td>
          <td>'.$sscl->license.'</td>
          <td>'.$sscl->motornum.'</td>
          <td>'.$sscl->bodynum.'</td>
          <td>'.$sscl->brandname.'</td>
          <td>'.$sscl->model.'</td>
          <td>'.$sscl->madeyear.'</td>
          <td>'.$sscl->color.'</td>
          <td>'.$sscl->distance.'</td>
          <td>'.$sscl->motor.'</td>
          <td>'.$sscl->cusid.'</td>
          <td>'.$sscl->name.' '.$sscl->lastname.'</td>
          <td>
            <div class="btn-group dropleft">
              <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-dots-horizontal"></i>
              </button>
              <div class="dropdown-menu">
                <button class="dropdown-item" id="btnEdit" value="'.$sscl->carid.'"><i class="mdi mdi-car"></i> ແກ້​ໄຂ</button>
                  <a class="dropdown-item" id="btnDel" href="/deleteCar/'.$sscl->carid.'"><i class="mdi mdi-trash-can"></i> ລົບ</a>
              </div>
            </div>
          </td>
        </tr>
          ';
        }
      }else{
        $result .= '
        <tr>
          <td colspan="12" class="text-center"><h4>ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ລົດ​ເທື່ອ</h4></td>
        </tr>
        ';
      }
      $data = array('result' => $result);
      echo json_encode($data);
    }

    /// function get car data to edit form
    public function fnloadCartoEdit($carid)
    {
        $carsql = DB::table('cars')->where('carid', $carid)->get();
        foreach($carsql as $car){
          $id = $car->carid;
          $license = $car->license;
          $motornum = $car->motornum;
          $bodynum = $car->bodynum;
          $brandid = $car->brandid;
          $model = $car->model;
          $madeyear = $car->madeyear;
          $color = $car->color;
          $distance = $car->distance;
          $motor = $car->motor;
        }
        $data = array('id'=> $id,'license'=> $license,'motornum' => $motornum,'bodynum'=>$bodynum,'brandid'=> $brandid,'model'=> $model,
        'madeyear'=> $madeyear,'color'=> $color,'distance'=> $distance,'motor'=> $motor);
        echo json_encode($data);
    }

    // function update car data
    public function fnUpdateCar(Request $req)
    {
        $this->validate($req, [
            'brandid' => 'required'
        ]);
        $carid = $req->input('carid');
        $dataupdate = array(
          'license' => $req->input('license'),
          'motornum' => $req->input('motornum'),
          'bodynum' => $req->input('bodynum'),
          'brandid' => $req->input('brandid'),
          'model' => $req->input('model'),
          'madeyear' => $req->input('madeyear'),
          'color' => $req->input('color'),
          'distance' => $req->input('distance'),
          'motor' => $req->input('motor'),
          'created_at'=>date('Y-m-d H:i:s')
        );
        // echo $carid;
        DB::table('cars')->where('carid', $carid)->update($dataupdate);
        return redirect('car_setting')->with('success', 'Update Success');
    }

    // function delete car
    public function fnDeleteCar($carid)
    {
        DB::table('cars')->where('carid', $carid)->delete();
        return redirect('car_setting')->with('success', 'Update Success');
    }

    //////////////////////////////////////////////////////////// repair list setting ////////////////////////////////////////////////////
    // function show list repair
    public function fnListRepair()
    {
        $customers = DB::table('customers')->get();
        return view('/manage/crm/listrepair')->with('customers', $customers);
    }

    // function get load car data to select in list repair page
    public function fnloadCarsdata(Request $req)
    {
        $result = '';
        $query = $req->get('query');
        $cars = DB::table('cars')->where('cusid', $query)->get();
        if(count($cars) > 0){
                $result .= '<option value="">*** ເລືອກ​ລົດລູກ​ຄ້າ ***</option>';
            foreach ($cars as $car) {
                $result .= '<option value="'.$car->carid.'">'.$car->license.'</option>';
            }
        }else{
            $result .= '<option value="">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ລົດ​ຂອງ​ລູກ​ຄ້າ​ຄົນ​ນີ້</option';
        }
        $data = array('result' => $result);
        echo json_encode($data);
    }

    // function get appointment date to select
    public function fnloadAppointment(Request $req){
        $result = '';
        $carid = $req->get('carid');
        $cusid = $req->get('cusid');
        $appointments = DB::table('appointments')->where('cusid', $cusid)->where('carid', $carid)->get();
        if(count($appointments) > 0){
            $result .= '<option value="">*** ເລືອກ​ວັນ​ທີ່​ນັດ​ໝາຍ ***</option>';
            foreach ($appointments as $app) {
                $result .= '<option value="'.$app->ap_date.'">'.$app->ap_date.'</option>';
            }
        }else{
            $result .= '<option value="">ຍັງ​ບໍ່​ມີ​ການ​ນັດ​ໝາຍ​ລູກ​ຄ້າກັບ​ລົດ​ຄັນ​ນີ້​ເທື​່ອ</option>';
        }
        $data = array('result' => $result);
        echo json_encode($data);
    }

    // function get repair list to show on table
    public function fnloadRepair(Request $req)
    {
        $result = '';
        $cusid = $req->get('cusid');
        $carid = $req->get('carid');
        $datelist = $req->get('datelist');
        $repair = DB::table('repair')->where('cusid', $cusid)->where('carid', $carid)->where('datelist', $datelist)->get();
        if(count($repair) > 0){
            foreach ($repair as $rp) {
                if($rp->status == "0"){
                    $status = "ຍັງ​ບໍ່​ໄດ້​ສ້ອມ​ແປງ";
                }else{
                    $status = "ສ້ອມ​ແປງ​ສຳ​ເລັດ";
                }
                $result .= '
                <tr>
                    <td>'.$rp->list.'</td>
                    <td>'.$status.'</td>
                    <td class="text-center">
                        <div class="btn-group dropleft">
                            <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                            </button>
                            <div class="dropdown-menu">
                                <button class="dropdown-item" id="btnModalAdd"><i class="mdi mdi-tools"></i> ເພີ່ມ​ລາຍ​ການ​ສ້ອມ</button>
                                <button class="dropdown-item" id="btnEdit" value="'.$rp->repairid.'"><i class="mdi mdi-tools"></i> ແກ້​ໄຂລາຍ​ການ​ສ້ອມ</button>
                                <button class="dropdown-item" id="btnDel" value="'.$rp->repairid.'"><i class="mdi mdi-trash-can"></i> ລົບລາຍ​ການ​ສ້ອມ</a>
                            </div>
                        </div>
                    </td>
                </tr>
                ';
            }
        }else{
            $result .= '<tr><td class="text-center"><h4>ຍັງ​ບໍ່​ມີ​ລາຍ​ການ​ສ້ອມ​ລົດ​ຄັນ​ນີ້​ເທື່ອ</h4></td></tr>';
        }
        $data = array('result' => $result);
        echo json_encode($data);
    }

    // function insert new list in list repair page
    public function fnInsertList(Request $req)
    {
        $cusid = $req->cusid;
        $carid = $req->carid;
        $list = $req->list;
        $datelist = $req->datelist;
        $status = $req->status;
        $indata = array('cusid'=>$cusid,'carid'=>$carid,'list'=>$list,'datelist'=>$datelist,'status'=>$status,'created_at'=>date('Y-m-d H:i:s'));
        DB::table('repair')->insert($indata);
        $data = "ການ​ເພີ່ມ​ລາຍ​ການສ້ອມ​ແປງ​ສຳ​ເລັດ";
        echo json_encode($data);
    }

    // function to get data to edit form
    public function fnloadRepairtoEdit($repairid)
    {
        $repair = DB::table('repair')->where('repairid', $repairid)->get();
        foreach ($repair as $rp) {
            $list = $rp->list;
            $status = $rp->status;
        }
        $data = array('list' => $list, 'status' => $status);
        echo json_encode($data);
    }

    // function update repair list
    public function fnUpdateRepair(Request $req)
    {
        $repairid = $req->repairid;
        $list = $req->list;
        $status = $req->status;
        $dataupdate = array('list' => $list, 'status'=>$status,'updated_at'=>date('Y-m-d H:i:s'));
        DB::table('repair')->where('repairid', $repairid)->update($dataupdate);
        $data = 'ການ​ດຳ​ເນີນ​ການ​ແກ້​ໄຂ​ສຳ​ເລັດ';
        echo json_encode($data);
    }

    // function delete repair list
    public function fndeleteRepair($repairid)
    {
        DB::table('repair')->where('repairid', $repairid)->delete();
        $data = 'ການ​ລົບ​ສຳ​ເລັດ';
        echo json_encode($data);
    }
//////////////////////////////////////////////////////////// appointment setting ////////////////////////////////////////////////////
    // function show appointment list
    public function fnAppointmentSetting()
    {
        $appoint = DB::table('appointments')
        ->join('customers', 'customers.cusid', '=', 'appointments.cusid')
        ->join('cars', 'cars.carid', '=', 'appointments.carid')
        ->select('appointments.apid','appointments.ap_date','appointments.ap_time','customers.cusid','customers.name','cars.carid','cars.license')
        ->paginate(20);
        return view('manage/crm/appointsetting')->with('appoint', $appoint);
    }

    // function get data to edit form
    public function fngetAppointment($apid)
    {
        $appointment = DB::table('appointments')->where('apid', $apid)->get();
        foreach ($appointment as $app) {
            $cusid = $app->cusid;
            $carid = $app->carid;
            $time = $app->ap_time;
            $date = $app->ap_date;
        }
        $data = array('time' => $time, 'date' => $date, 'cusid' => $cusid, 'carid' => $carid);
        echo json_encode($data);
    }
    // function update appointment date and time
    public function fnUpdateAppointment(Request $req)
    {
        $apid = $req->input('apid');
        $ap_date = $req->input('ap_date');
        $olddate = $req->input('olddate');
        $ap_time = $req->input('ap_time');
        $cusid = $req->input('cusid');
        $carid = $req->input('carid');
        $repairdate = DB::table('repair')->where('cusid', $cusid)->where('carid', $carid)->where('datelist', $olddate)->get();
        $changerepairdate = array('datelist'=>$ap_date,'updated_at'=>date('Y-m-d H:i:s'));
        foreach ($repairdate as $rp) {
            $repairid = $rp->repairid;
            DB::table('repair')->where('repairid', $repairid)->update($changerepairdate);
        }
        $dataupdate = array('ap_time'=>$ap_time,'ap_date'=>$ap_date,'updated_at'=>date('Y-m-d H:i:s'));
        DB::table('appointments')->where('apid', $apid)->update($dataupdate);
        return redirect('/ap_setting')->with('success', 'Update data success');
    }

    // function delete appointments
    public function fnDeleteAppointment($apid)
    {
        $appoint = DB::table('appointments')->where('apid', $apid)->get();
        foreach($appoint as $ap){
            $cusid = $ap->cusid;
            $carid = $ap->carid;
            $ap_date = $ap->ap_date;
        }

        $sqlrepair = DB::table('repair')->where('cusid', $cusid)->where('carid', $carid)->where('datelist', $ap_date)->get();
        foreach ($sqlrepair as $rp) {
            $repairid = $rp->repairid;
            DB::table('repair')->where('repairid', $repairid)->delete();
        }
        DB::table('appointments')->where('apid', $apid)->delete();
        return redirect('/ap_setting')->with('success', 'Update data success');
    }

    ///////////////////////////////////////////////// Car Brand setting //////////////////////////////////////////////////////
    // function to show car brand setting page
    public function fnBrandSetting()
    {
        return view('manage/crm/brandsetting');
    }
    // function to load brand to show on table
    public function fnloadBrand()
    {
        $result = "";
        $brands = DB::table('brands')->orderBy('brandname', 'asc')->get();
        foreach ($brands as $bd) {
            $result .= '
            <tr>
                <td>'.$bd->brandid.'</td>
                <td>'.$bd->brandname.'</td>
                <td class="text-center">
                    <div class="btn-group dropleft">
                        <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-horizontal"></i>
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item" id="btnEdit" value="'.$bd->brandid.'"><i class="mdi mdi-car"></i> ແກ້​ໄຂ</button>
                            <button class="dropdown-item" id="btnDel" value="'.$bd->brandid.'"><i class="mdi mdi-trash-can"></i> ລົບ</button>
                        </div>
                    </div>
                </td>
            </tr>
            ';
        }
        $data = array('result' => $result);
        echo json_encode($data);
    }

    // function inser new brand
    public function fnInsertBrand(Request $req)
    {
        $datainsert = array('brandname' => $req->brandname,'created_at'=>date('Y-m-d H:i:s'));
        DB::table('brands')->insert($datainsert);
        $data = 'ການ​ເພີ່ມ​ຂໍ້​ມູນ​ສຳ​ເລັດ';
        echo json_encode($data);
    }

    // function get brand
    public function fnGetbrand($brandid)
    {
        $brands = DB::table('brands')->where('brandid', $brandid)->get();
        foreach ($brands as $bd) {
            $bid = $bd->brandid;
            $bname = $bd->brandname;
        }
        $data = array('bid' => $bid, 'bname' => $bname);
        echo json_encode($data);
    }

    // function update brand
    public function fnUpdateBrand(Request $req)
    {
        $brandid = $req->brandid;
        $brandname = $req->brandname;
        $brandupdate = array('brandname' => $brandname,'updated_at'=>date('Y-m-d H:i:s'));
        DB::table('brands')->where('brandid', $brandid)->update($brandupdate);
        $data = "ການ​ແກ້​ໄຂ​ຂໍ້​ມູນ​ຍີ່​ຫ​ໍ້​ສຳ​ເລັດ";
        echo json_encode($data);
    }
    // function delete brand data
    public function fnDeleteBrand(Request $req)
    {
        $brandid = $req->brandid;
        DB::table('brands')->where('brandid', $brandid)->delete();
        $data = "ການ​ລົບ​ຍີ່​ຫໍ້​ລົດ​ສຳ​ເລັດ";
        echo json_encode($data);
    }
}
