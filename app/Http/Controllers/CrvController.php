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
    // $rcid = "RCS0001";
    if(count($sqlrc) > 0){
      foreach($sqlrc as $rc){
        $rcsid = $rc->rcsid;
      }
      $string = Str::substr($rcsid, 3, 7);
      $sum = (int)$string + 1;
      if(strlen($sum) == 1){
        $num = "000".$sum;
      }elseif(strlen($sum) == 2){
        $num = "00".$sum;
      }elseif(strlen($sum) == 3){
        $num = "0".$sum;
      }else{
        $num = $sum;
      }
    }else{
      $num = "0001";
    }
    $id = "RCS".$num;
    $customers = DB::table('customers')->get();
    return view('manage/crm/crvnew')->with('rcsid', $id)
                                    ->with('customers', $customers);
  }

  // function get car data to selected
  public function fngetCuscar(Request $req)
  {
    $result = "";
    $carsql = DB::table('cars')->where('cusid', $req->cusid)->get();
    if(count($carsql) > 0){
      $result .= '<option value="">*** ເລືອກ​ລົດ​ລູກ​ຄ້າ ***</option>';
      foreach($carsql as $c){
        $result .= '
        <option value="'.$c->carid.'">'.$c->license.'</option>
      ';
      }
    }else{
      $result .= '<option value="">ບໍ່​ມີ​ຂໍ້​ມູນ​ລົດ​ຂອງ​ລູກ​ຄ້າ​ຄົນ​ນີ້</option>';
    }
    $data = array('result' => $result);
    echo json_encode($data);
  }

  public function fnInsertrcs(Request $req)
  {
    $this->validate($req, [
      'cusid' => 'required',
      'carid' => 'required',
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
    
    $repairlist = $req->input('repairlist');
    if($req->input('rp_other') == "yes"){
      for($i=0; $i<count($repairlist); $i++){
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
    }else{
      DB::table('receivecars')->insert($indata);
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

  // function display crvlist page
  public function fnCrvlist()
  {
    $sqlrcs = DB::table('receivecars')
    ->join('customers', 'customers.cusid', '=', 'receivecars.cusid')
    ->join('cars', 'cars.carid', '=', 'receivecars.carid')
    ->select('receivecars.*','customers.*','cars.*')->orderBy('receivecars.rcsid', 'desc')->get();
    $customers = DB::table('customers')->get();
    return view('manage/crm/crvlist')->with('sqlrcs', $sqlrcs)->with('customers', $customers);
  }

  // function print rcs
  public function fnPrintRcs($rcsid)
  {
    $showdata = DB::table('receivecars')
    ->join('customers', 'customers.cusid', '=', 'receivecars.cusid')
    ->join('cars', 'cars.carid', '=', 'receivecars.carid')
    ->join('districts', 'districts.disid', '=', 'customers.disid')
    ->join('provinces', 'provinces.proid', '=', 'customers.proid')
    ->join('typecuses', 'typecuses.tcusid', '=', 'customers.tcusid')
    ->join('brands', 'brands.brandid', '=', 'cars.brandid')
    ->where('receivecars.rcsid','=', $rcsid)
    ->select('receivecars.*','customers.*','cars.*','typecuses.*','brands.*','districts.*','provinces.*')->get();
    $showdetail = DB::table('receivecars_detail')->where('rcsid', $rcsid)->get();
    $i = 1;
    $url = "crvlist";
    return view('manage/crm/crvprint')->with('showdata', $showdata)->with('showdetail', $showdetail)->with('url', $url)->with('i', $i);
  }

  public function fnGetrcsdata(Request $req)
  {
    $rcsid = $req->rcsid;
    $sqlrcsdata = DB::table('receivecars')->where('rcsid', $rcsid)->get();
    foreach($sqlrcsdata as $rcsdt){
      $cusid = $rcsdt->cusid; $carid = $rcsdt->carid; $date_receive = $rcsdt->date_receive; $time_receive = $rcsdt->time_receive; $meter = $rcsdt->meter;
      $type_car = $rcsdt->type_car; $gear = $rcsdt->gear; $leveloil = $rcsdt->leveloil; $front = $rcsdt->front; $front_remark = $rcsdt->front_remark;
      $left = $rcsdt->left; $left_remark = $rcsdt->left_remark; $right = $rcsdt->right; $right_remark = $rcsdt->right_remark; $back = $rcsdt->back;
      $back_remark = $rcsdt->back_remark; $wheels = $rcsdt->wheels; $wheels_remark = $rcsdt->wheels_remark; $seats = $rcsdt->seats; $seats_remark = $rcsdt->seats_remark;
      $doors = $rcsdt->doors; $doors_remark = $rcsdt->doors_remark; $mirror = $rcsdt->mirror; $mirror_remark = $rcsdt->mirror_remark; $sound = $rcsdt->sound;
      $sound_remark = $rcsdt->sound_remark; $meter_display = $rcsdt->meter_display; $meterdis_remark = $rcsdt->meterdis_remark; $accessories = $rcsdt->accessories; $accessories_remark = $rcsdt->accessories_remark;
      $valuables = $rcsdt->valuables; $valuables_remark = $rcsdt->valuables_remark; $check33 = $rcsdt->check33; $maintenance = $rcsdt->maintenance; $maintenance_list = $rcsdt->maintenance_list;
      $repairs = $rcsdt->repairs;$tire_service = $rcsdt->tire_service; $tire_detail = $rcsdt->tire_detail;
    }
    $data = array(
      'cusid' => $cusid,'carid' => $carid,'date_receive' => $date_receive,'time_receive' => $time_receive,'meter' => $meter,'type_car' => $type_car,
      'gear' => $gear,'leveloil' => $leveloil,'front' => $front,'front_remark' => $front_remark,'left' => $left,'left_remark' => $left_remark,
      'right' => $right,'right_remark' => $right_remark,'back' => $back,'back_remark' => $back_remark,'wheels' => $wheels,'wheels_remark' => $wheels_remark,
      'seats' => $seats,'seats_remark' => $seats_remark,'doors' => $doors,'doors_remark' => $doors_remark,'mirror' => $mirror,'mirror_remark' => $mirror_remark,
      'sound' => $sound,'sound_remark' => $sound_remark,'meter_display' => $meter_display,'meterdis_remark' => $meterdis_remark,'accessories' => $accessories,
      'accessories_remark' => $accessories_remark, 'valuables' => $valuables,'valuables_remark' => $valuables_remark,'check33' => $check33,'maintenance' => $maintenance,
      'maintenance_list' => $maintenance_list,'repairs' => $repairs,'tire_service' => $tire_service,'tire_detail' => $tire_detail
    );
    echo json_encode($data);
  }

  // function update receive car
  public function fnUpdateRcs(Request $req)
  {
    $this->validate($req, [
      'cusid' => 'required',
      'carid' => 'required'
    ]);
    $updatedata = array(
      'cusid' => $req->input('cusid'),'carid' => $req->input('carid'),'date_receive' => $req->input('date_receive'),'time_receive' => $req->input('time_receive'),'meter' => $req->input('meter'),'type_car' => $req->input('type_car'),
      'gear' => $req->input('gear'),'leveloil' => $req->input('leveloil'),'front' => $req->input('front'),'front_remark' => $req->input('front_remark'),'left' => $req->input('left'),'left_remark' => $req->input('left_remark'),
      'right' => $req->input('right'),'right_remark' => $req->input('right_remark'),'back' => $req->input('back'),'back_remark' => $req->input('back_remark'),'wheels' => $req->input('wheels'),'wheels_remark' => $req->input('wheels_remark'),
      'seats' => $req->input('seats'),'seats_remark' => $req->input('seats_remark'),'doors' => $req->input('doors'),'doors_remark' => $req->input('doors_remark'),'mirror' => $req->input('mirror'),'mirror_remark' => $req->input('mirror_remark'),
      'sound' => $req->input('sound'),'sound_remark' => $req->input('sound_remark'),'meter_display' => $req->input('meter_display'),'meterdis_remark' => $req->input('meterdis_remark'),'accessories' => $req->input('accessories'),
      'accessories_remark' => $req->input('accessories_remark'),'valuables' => $req->input('valuables'),'valuables_remark' => $req->input('valuables_remark'),'check33' => $req->input('check33'),'maintenance' => $req->input('maintenance'),
      'maintenance_list' => $req->input('maintenance_list'),'repairs' => $req->input('repairs'),'tire_service' => $req->input('tire_service'),'tire_detail' => $req->input('tire_detail'),'updated_at' => date('Y-m-d H:i:s')
    );
    $rcsid = $req->input('checkrcsid');
    DB::table('receivecars')->where('rcsid', $rcsid)->update($updatedata);
    return redirect('crvlist')->with('success', 'Updated data successfuly');
  }

  // function show repair list to rcsid
  public function fnShowlist(Request $req)
  {
    $rcsid = $req->rcsid;
    $result = "";
    $repairlist = DB::table('receivecars_detail')->where('rcsid', $rcsid)->get();
    $i = 1;
    if(count($repairlist) > 0){
      foreach($repairlist as $rpl){
        $result .= '
        <tr>
          <td>'.$i++.'</td>
          <td>'.$rpl->rcs_list.'</td>
          <td class="text-center">
            <button class="btn btn-danger btn-sm" type="button" id="btnDelRcslist" value="'.$rpl->rcs_detailid.'"><i class="mdi mdi-trash-can"></i></button>
          </td>
        </tr>
        ';
      }
    }else{
      $result .= '<tr><td class="text-center" colspan="3">ຍັງ​ບໍ່​ມີ​ລາຍ​ການ​ສະ​ເໜີ​ສ້ອມ</td></tr>';
    }
    $data = array('showlist' => $result);
    echo json_encode($data);
  }

  // function add new repair list
  public function fnAddnewRcslist(Request $req)
  {
    $addnew = array('rcsid' => $req->rcsid, 'rcs_list' => $req->rcs_list);
    DB::table('receivecars_detail')->insert($addnew);
    $data = "ການ​ເພີ່ມ​ລາຍ​ການ​ສ້ອມ​ໃໝ່​ສຳ​ເລັດ!";
    echo json_encode($data); 
  }

  // function delete rcslist
  public function fnDeleteRcslist(Request $req)
  {
    $rcs_detailid = $req->rcs_detailid;
    DB::table('receivecars_detail')->where('rcs_detailid', $rcs_detailid)->delete();
    $data = "ການ​ດຳ​ເນີນ​ການລົບ​ສຳ​ເລັດ!";
    echo json_encode($data);
  }

  // fucntion delete rcs data
  public function fnDeleteRcsid($rcsid)
  {
    DB::table('receivecars')->where('rcsid', $rcsid)->delete();
    return redirect('crvlist')->with('success', 'Deleted Successfully!');
  }
}
