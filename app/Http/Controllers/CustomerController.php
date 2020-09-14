<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Validator, DB;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    // show form insert new customer
  public function index()
  {
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
    return view('/manage/crm/newcustomer')->with('province', $province)
    ->with('typecus', $typecus)
    ->with('cusid', $cusid)
    ->with('carid', $carid)
    ->with('brands', $brands);
  }

  // function insert new customer
  public function fnInsertNewCus(Request $req)
  {
    $this->validate($req, [
      'proid' => 'required',
      'disid' => 'required',
      'tcusid' => 'required',
      'brandid' => 'required',
      'motor' => 'required'
    ]);

    // dd($req->all());
    $cusdata = array(
      'cusid' => $req->input('cusid'),'name' => $req->input('cusname'),
      'lastname' => $req->input('lastname'),'village' => $req->input('village'),
      'disid' => $req->input('disid'),'proid' => $req->input('proid'),
      'mobile' => $req->input('mobile'),'phone' => $req->input('phone'),
      'occupation' => $req->input('occupation'),'workaddress' => $req->input('workadd'),
      'tcusid' => $req->input('tcusid'),'status' => $req->input('status'),
      'created_at' => date('Y-m-d H:i:s')
    );

    $cardata = array(
      'carid' => $req->input('carid'),'license' => $req->input('license'),
      'motornum' => $req->input('motornum'), 'bodynum' => $req->input('bodynum'),
      'brandid' => $req->input('brandid'),'model' => $req->input('model'),
      'madeyear' => $req->input('madeyear'),'color' => $req->input('color'),
      'distance' => $req->input('distance'),'motor' => $req->input('motor'),
      'cusid' => $req->input('cusid'),'created_at' => date('Y-m-d H:i:s')
    );

    $checkcustomer = DB::table('customers')->where('cusid', $req->input('cusid'))->get();
    $checkcar = DB::table('cars')->where('carid', $req->input('carid'))->get();
    if(count($checkcustomer) > 0){
      return back()->with('alreadycus', 'ລະ​ຫັດລູກ​ຄ້າ​ຄົນ​ນີ້​ມີ​ໃນ​ລະ​ບົບ​ແລ້ວ');
    }else{
      if(count($checkcar) > 0){
        return back()->with('alreadycar', 'ລະຫັດ​ລົດ​ຂອງ​ລູກ​ຄ້າ​ແມ່ນ​ມີ​ໃນ​ລະ​ບົບ​ແລ້ວ');
      }else{
        // insert new customer
        DB::table('customers')->insert($cusdata);
        // insert new car
        DB::table('cars')->insert($cardata);
        return redirect('newcustomer')->with('success', 'ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ!');
      }
    }
  }

  // function insert new car of old customers
  public function fnNewcarOldcus()
  {
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
    $customers = DB::table('customers')->get();
    $brands = DB::table('brands')->orderBy('brandname', 'asc')->get();
    return view('/manage/crm/newcustomoldcus')->with('carid', $carid)->with('brands', $brands)->with('customers', $customers);
  }

  // function insert new car of old customer
  public function fnInsertNewcaroldcus(Request $req)
  {
    $this->validate($req, [
      'brandid' => 'required',
      'motor' => 'required',
      'cusid' => 'required'
    ]);
    $cardata = array(
      'carid' => $req->input('carid'),'license' => $req->input('license'),
      'brandid' => $req->input('brandid'),'model' => $req->input('model'),
      'madeyear' => $req->input('madeyear'),'color' => $req->input('color'),
      'distance' => $req->input('distance'),'motor' => $req->input('motor'),
      'cusid' => $req->input('cusid'),'created_at' => date('Y-m-d H:i:s')
    );
    $checkcar = DB::table('cars')->where('carid', $req->input('carid'))->get();
    if(count($checkcar) > 0){
      return back()->with('alreadycar', 'ລະຫັດ​ລົດ​ຂອງ​ລູກ​ຄ້າ​ແມ່ນ​ມີ​ໃນ​ລະ​ບົບ​ແລ້ວ');
    }else{
      // insert new car
      DB::table('cars')->insert($cardata);
      return redirect('newcaroldcus')->with('success', 'ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ!');
    }
  }

  // customer list show page
  public function fnCustomerlist()
  {
    $customerlist = DB::table('customers')
    ->join('cars', 'cars.cusid', '=', 'customers.cusid')
    ->join('provinces', 'provinces.proid', '=', 'customers.proid')
    ->join('districts', 'districts.disid', '=', 'customers.disid')
    ->join('typecuses', 'typecuses.tcusid', '=', 'customers.tcusid')
    ->select('customers.*','cars.*','provinces.proname','districts.disname','typecuses.tcusname')
    ->orderBy('customers.cusid', 'desc')->paginate(30);
    return view('manage/crm/customerlist')->with('customerlist', $customerlist);
  }

  // get car data
  public function fnCarsdata(Request $req, $carid)
  {
    $date = date('Y-m');
    $cars = DB::table('cars')
    ->join('brands', 'brands.brandid', '=', 'cars.brandid')
    ->where('cars.carid', '=', $carid)
    ->select('cars.carid','cars.license','brands.brandname','cars.model','cars.madeyear','cars.color','cars.distance','cars.motor')
    ->get();
    $result = '';
    //  
    if(count($cars) > 0){
      foreach($cars as $car){
        $result .= '
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <h5>ເລກ​ຈັກ: <b>'.$car->carid.'</b></h5>
                  <h5>ເລ​ກ​ຖ​ັງ: <b>'.$car->license.'</b></h5>
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
}
