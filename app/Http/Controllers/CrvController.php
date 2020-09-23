<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Validator, Auth;
use Illuminate\Support\Str;

class CrvController extends Controller
{
  // show crv new page
  public function index()
  {
    $sqlrc = DB::table('receivecars')->select('rcsid')->orderBy('rcsid', 'desc')->take(1)->get();  
    // $rcid = "RCS0000001";
    if(count($sqlrc) > 0){
      foreach($sqlrc as $rc){
        $rcsid = $rc->rcsid;
      }
      $string = Str::substr($rcsid, 3, 10);
      $sum = (int)$string + 1;
      if(strlen($sum) == 1){
        $num = "000000".$sum;
      }elseif(strlen($sum) == 2){
        $num = "00000".$sum;
      }elseif(strlen($sum) == 3){
        $num = "0000".$sum;
      }elseif(strlen($sum) == 4){
        $num = "000".$sum;
      }elseif(strlen($sum) == 5){
        $num = "00".$sum;
      }elseif(strlen($sum) == 6){
        $num = "0".$sum;
      }else{
        $num = $sum;
      }
    }else{
      $num = "0000001";
    }
    $id = "RCS".$num;
    $customers = DB::table('customers')->get();
    return view('manage/crm/crvnew')->with('rcsid', $id)
                                    ->with('customers', $customers);
  }

  public function fnInsertrcs(Request $req)
  {
    $this->validate($req, [
      'cusid' => 'required',
      'carid' => 'required'
    ]);

    $indata = array(
      'rcsid' => $req->input('rcsid'),'cusid' => $req->input('cusid'),'carid' => $req->input('carid'),'date_receive' => $req->input('date_receive'),
      'time_receive' => $req->input('time_receive'),'meter' => $req->input('meter'),'type_car' => $req->input('type_car'),'gear' => $req->input('gear'),
      'leveloil' => $req->input('leveloil'),'front' => $req->input('front'),'front_remark' => $req->input('front_remark'),'left' => $req->input('left'),
      'left_remark' => $req->input('left_remark'),'right' => $req->input('right'),'right_remark' => $req->input('right_remark'),'back' => $req->input('back'),
      'back_remark' => $req->input('back_remark'),'wheels' => $req->input('wheels'),'wheels_remark' => $req->input('wheels_remark'),'seats' => $req->input('seats'),
      'seats_remark' => $req->input('seats_remark'),'doors' => $req->input('doors'),'doors_remark' => $req->input('doors_remark'),'mirror' => $req->input('mirror'),
      'mirror_remark' => $req->input('mirror_remark'),'sound' => $req->input('sound'),'sound_remark' => $req->input('sound_remark'),'meter_display' => $req->input('meter_display'),
      'meterdis_remark' => $req->input('meterdis_remark'),'accessories' => $req->input('accessories'),'accessories_remark' => $req->input('accessories_remak'),'valuables' => $req->input('valuables'),
      'valuables_remark' => $req->input('valuables_remark'),'check33' => $req->input('check33'),'maintenance' => $req->input('maintenance'),'maintenance_list' => $req->input('maintenance_list'),
      'repairs' => $req->input('repairs'),'tire_service' => $req->input('tire_service'),'tire_detail' => $req->input('tire_detail'),'created_at' => date('Y-m-d H:i:s')
    );
    if($req->input('repairlist') == "" || count($req->input('repairlist')) < 0){
      DB::table('receivecars')->insert($indata);
    }else{
      for($i=0; $i<count($req->input('repairlist')); $i++){
        $list = array(
          'rcsid' => $req->input('rcsid'),
          'rcs_list' => $req->input('repairlist')[$i],
          'status' => 1,
          'created_at' => date('Y-m-d H:i:s')
        );
        $inlist = $list;
      }
      DB::table('receivecars')->insert($indata);
      DB::table('receivecars_detail')->insert($inlist);
    }
    

    $showdata = DB::table('receivecars')
    ->join('customers', 'customers.cusid', '=', 'receivecars.cusid')
    ->join('cars', 'cars.carid', '=', 'receivecars.carid')
    ->join('districts', 'districts.disid', '=', 'customers.disid')
    ->join('provinces', 'provinces.proid', '=', 'customers.proid')
    ->join('typecuses', 'typecuses.tcusid', '=', 'customers.tcusid')
    ->join('brands', 'brands.brandid', '=', 'cars.brandid')
    ->where('receivecars.rcsid','=', $req->input('rcsid'))
    ->select('receivecars.*','customers.*','cars.*','typecuses.*','brands.*','districts.*','provinces.*')->get();
    $showdetail = DB::table('receivecars_detail')->where('rcsid', $req->input('rcsid'))->get();
    $i = 1;
    $url = "crvnew";
    return view('manage/crm/crvprint')->with('showdata', $showdata)->with('showdetail', $showdetail)->with('url', $url)->with('i', $i);
  }
}
