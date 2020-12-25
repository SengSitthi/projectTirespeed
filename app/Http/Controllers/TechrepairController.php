<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, DB, Validator;
use Illuminate\Support\Str;

class TechrepairController extends Controller
{
///////////////////////////////////////////////////////////////// units repair //////////////////////////////////////////////////////////////
  // function first unitrepair page
  public function fnUnitRepairs()
  {
    return view('manage/technical/unitrepairs');
  }

  // function get unitrepair page
  public function fnShowUnitrepair()
  {
    $result = "";
    $i = 1;
    $sqlunitrp = DB::table('unitrepairs')->orderBy('unitrpid', 'desc')->get();
    if(count($sqlunitrp) > 0){
      foreach($sqlunitrp as $unitrp){
        $result .= '
        <tr class="text-center">
          <td>'.$i++.'</td>
          <td>'.$unitrp->unitrpname.'</td>
          <td>
            <button class="btn btn-primary" type="button" id="btnEditUnitrp" value="'.$unitrp->unitrpid.'"><i class="mdi mdi-grease-pencil"></i></button>
          </td>
          <td>
            <button class="btn btn-danger" type="button" id="btnDelUnitrp" value="'.$unitrp->unitrpid.'"><i class="mdi mdi-trash-can"></i></button>
          </td>
        </tr>
        ';
      }
    }else{
      $result .= '
        <tr>
          <td colspan="4" class="text-center"><h3>ບໍ່​ມີ​ຂໍ້​ມູນ​ໃນ​ລະ​ບົບ</h3></td>
        </tr>
      ';
    }
    $data  = array('result'=>$result);
    echo json_encode($data);
  }

  // function insert new unit repair
  public function fnAddnewUnitrp(Request $req)
  {
    $newrepairs = array('unitrpname'=>$req->unitrpname,'created_at'=>date('Y-m-d H:i:s'));
    DB::table('unitrepairs')->insert($newrepairs);
    $data = "ການ​ເພີ່ມ​ລາຍ​ການ​ໃໝ່ສຳ​ເລັດ!";
    echo json_encode($data);
  }

  // funciton get unit data to edit
  public function fngetUnitrpid(Request $req)
  {
    $unitrpid = $req->unitrpid;
    $sqlgetunitrp = DB::table('unitrepairs')->where('unitrpid', $unitrpid)->get();
    foreach($sqlgetunitrp as $gurp){
      $unitrpname = $gurp->unitrpname;
    }
    $data = array('unitrpname'=>$unitrpname);
    echo json_encode($data);
  }

  // function update unit repair
  public function fnUpdateUnitrp(Request $req)
  {
    $unitrpid = $req->unitrpid;
    $unitrpname = $req->unitrpname;
    $dataupdate = array('unitrpname' => $unitrpname, 'updated_at' => date('Y-m-d H:i:s'));
    DB::table('unitrepairs')->where('unitrpid', $unitrpid)->update($dataupdate);
    $data = "ການ​ແກ້​ໄຂ​ຂໍ້​ມູນ​ສຳ​ເລັດ";
    echo json_encode($data);
  }

  // function delete unit repair
  public function fnDeleteUnitrp(Request $req)
  {
    $unitrpid = $req->unitrpid;
    DB::table('unitrepairs')->where('unitrpid', $unitrpid)->delete();
    $data = "ການ​ລົບ​ຂໍ້​ມູນ​ສຳ​ເລັດ!";
    echo json_encode($data);
  }

////////////////////////////////////////////// manage type cars //////////////////////////////////////
  // function show manage type car page
  public function fnManageTypecar()
  {
    return view('manage/technical/typecars');
  }

  // function show type of car
  public function fnShowTypecars(Request $req)
  {
    $result = "";
    $sqltypecars = DB::table('typecars')->orderBy('tcarid', 'desc')->get();
    $i = 1;
    if(count($sqltypecars) > 0){
      foreach($sqltypecars as $stc){
        $result .= '
        <tr class="text-center">
          <td>'.$i++.'</td>
          <td>'.$stc->tcarname.'</td>
          <td>
            <button class="btn btn-primary btn-sm" type="button" id="btnEditTC" value="'.$stc->tcarid.'"><i class="mdi mdi-grease-pencil"></i></button>
          </td>
          <td>
            <button class="btn btn-danger btn-sm" type="button" id="btnDelTC" value="'.$stc->tcarid.'"><i class="mdi mdi-trash-can"></i></button>
          </td>
        </tr>
        ';
      }
    }else{
      $result .= '<tr><td colspan="4" class="text-center">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ໃນ​ລະ​ບົບ!</td></tr>';
    }
    $data = array('result'=>$result);
    echo json_encode($data);
  }

  // function insert new type car
  public function fnInsertTypecar(Request $req)
  {
    $tcarname = $req->tcarname;
    $insertdata = array('tcarname'=>$tcarname, 'created_at'=>date('Y-m-d H:i:s'));
    DB::table('typecars')->insert($insertdata);
    $data = "ການ​ບັນ​ທຶກ​ສຳ​ເລັດ";
    echo json_encode($data);
  }

  // function get type data to edit form
  public function fngetTypecar(Request $req)
  {
    $tcarid = $req->tcarid;
    $gettcarid = DB::table('typecars')->where('tcarid', $tcarid)->get();
    foreach($gettcarid as $gtc){
      $tcarname = $gtc->tcarname;
    }
    $data = array('tcarname' => $tcarname);
    echo json_encode($data);
  }

  // function update type of car
  public function fnUpdateTypecar(Request $req)
  {
    $tcarid = $req->tcarid;
    $dataupdate = array('tcarname'=>$req->tcarname, 'updated_at'=>date('Y-m-d H:i:s'));
    DB::table('typecars')->where('tcarid', $tcarid)->update($dataupdate);
    $data = "ການ​ແກ້​ໄຂ​ຂໍ້​ມູນ​ສ​ຳ​ເລັດ!";
    echo json_encode($data);
  }

  // function delete type of car
  public function fnDeltypecus(Request $req)
  {
    $tcarid = $req->tcarid;
    DB::table('typecars')->where('tcarid', $tcarid)->delete();
    $data = "ການ​ລຶບ​ຂໍ້​ມູນ​ສຳ​ເລັດ!";
    echo json_encode($data);
  }

  //////////////////////////// TECHNICAL DASHBOARD ////////////////////////////
  public function fnDashboard(Request $req)
  {
    $today = date('Y-m-d');
    $monday = date('Y-m-d', strtotime('Monday this week'));
    $saturday = date('Y-m-d', strtotime('Saturday this week'));
    $waitrepairtoday = count(DB::table('techcarstatus')->where('status', 1)->where('date_in', $today)->get());
    $waitrepairweek = count(DB::table('techcarstatus')->whereBetween('status', 1)->where('date_in', [$monday, $saturday])->get());
    $waitsparetoday = count(DB::table('techcarstatus')->where('status', 2)->where('date_in', $today)->get());
    $waitspareweek = count(DB::table('techcarstatus')->whereBetween('status', 2)->where('date_in', [$monday, $saturday])->get());
    $repairingtoday = count(DB::table('techcarstatus')->where('status', 3)->where('date_in', $today)->get());
    $repairingweek = count(DB::table('techcarstatus')->whereBetween('status', 3)->where('date_in', [$monday, $saturday])->get());
    $successtoday = count(DB::table('techcarstatus')->where('status', 4)->where('date_in', $today)->get());
    $successweek = count(DB::table('techcarstatus')->whereBetween('status', 4)->where('date_in', [$monday, $saturday])->get());
    $sendtoday = count(DB::table('techcarstatus')->where('status', 5)->where('date_in', $today)->get());
    $sendweek = count(DB::table('techcarstatus')->whereBetween('status', 5)->where('date_in', [$monday, $saturday])->get());
    return view('manage/technical/index')->with('waitrepairtoday', $waitrepairtoday)->with('waitrepairweek', $waitrepairweek)->with('waitsparetoday', $waitsparetoday)
    ->with('waitspareweek', $waitspareweek)->with('repairingtoday', $repairingtoday)->with('repairingweek', $repairingweek)->with('successtoday', $successtoday)
    ->with('successweek', $successweek)->with('sendtoday', $sendtoday)->with('sendweek', $sendweek);
  }

  // function load technical data to show on chart
  public function fnLoadtechchart(Request $req)
  {
    // waitrepair month count
    $jan_waitrepair = count(DB::table('techcarstatus')->where('status', 1)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of January')), date('Y-m-d', strtotime('Last day of January'))])->get());
    $feb_waitrepair = count(DB::table('techcarstatus')->where('status', 1)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of February')), date('Y-m-d', strtotime('Last day of February'))])->get());
    $mar_waitrepair = count(DB::table('techcarstatus')->where('status', 1)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of March')), date('Y-m-d', strtotime('Last day of March'))])->get());
    $apr_waitrepair = count(DB::table('techcarstatus')->where('status', 1)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of April')), date('Y-m-d', strtotime('Last day of April'))])->get());
    $may_waitrepair = count(DB::table('techcarstatus')->where('status', 1)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of May')), date('Y-m-d', strtotime('Last day of May'))])->get());
    $jun_waitrepair = count(DB::table('techcarstatus')->where('status', 1)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of June')), date('Y-m-d', strtotime('Last day of June'))])->get());
    $jul_waitrepair = count(DB::table('techcarstatus')->where('status', 1)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of July')), date('Y-m-d', strtotime('Last day of July'))])->get());
    $aug_waitrepair = count(DB::table('techcarstatus')->where('status', 1)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of August')), date('Y-m-d', strtotime('Last day of August'))])->get());
    $sep_waitrepair = count(DB::table('techcarstatus')->where('status', 1)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of September')), date('Y-m-d', strtotime('Last day of September'))])->get());
    $oct_waitrepair = count(DB::table('techcarstatus')->where('status', 1)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of October')), date('Y-m-d', strtotime('Last day of October'))])->get());
    $nov_waitrepair = count(DB::table('techcarstatus')->where('status', 1)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of November')), date('Y-m-d', strtotime('Last day of November'))])->get());
    $dec_waitrepair = count(DB::table('techcarstatus')->where('status', 1)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of December')), date('Y-m-d', strtotime('Last day of December'))])->get());
    $waitrepair = array($jan_waitrepair,$feb_waitrepair,$mar_waitrepair,$apr_waitrepair,$may_waitrepair,$jun_waitrepair,$jul_waitrepair,$aug_waitrepair,$sep_waitrepair,$oct_waitrepair,$nov_waitrepair,$dec_waitrepair);

    // waitspare month count
    $jan_waitspare = count(DB::table('techcarstatus')->where('status', 2)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of January')), date('Y-m-d', strtotime('Last day of January'))])->get());
    $feb_waitspare = count(DB::table('techcarstatus')->where('status', 2)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of February')), date('Y-m-d', strtotime('Last day of February'))])->get());
    $mar_waitspare = count(DB::table('techcarstatus')->where('status', 2)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of March')), date('Y-m-d', strtotime('Last day of March'))])->get());
    $apr_waitspare = count(DB::table('techcarstatus')->where('status', 2)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of April')), date('Y-m-d', strtotime('Last day of April'))])->get());
    $may_waitspare = count(DB::table('techcarstatus')->where('status', 2)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of May')), date('Y-m-d', strtotime('Last day of May'))])->get());
    $jun_waitspare = count(DB::table('techcarstatus')->where('status', 2)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of June')), date('Y-m-d', strtotime('Last day of June'))])->get());
    $jul_waitspare = count(DB::table('techcarstatus')->where('status', 2)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of July')), date('Y-m-d', strtotime('Last day of July'))])->get());
    $aug_waitspare = count(DB::table('techcarstatus')->where('status', 2)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of August')), date('Y-m-d', strtotime('Last day of August'))])->get());
    $sep_waitspare = count(DB::table('techcarstatus')->where('status', 2)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of September')), date('Y-m-d', strtotime('Last day of September'))])->get());
    $oct_waitspare = count(DB::table('techcarstatus')->where('status', 2)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of October')), date('Y-m-d', strtotime('Last day of October'))])->get());
    $nov_waitspare = count(DB::table('techcarstatus')->where('status', 2)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of November')), date('Y-m-d', strtotime('Last day of November'))])->get());
    $dec_waitspare = count(DB::table('techcarstatus')->where('status', 2)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of December')), date('Y-m-d', strtotime('Last day of December'))])->get());
    $waitspare = array($jan_waitspare,$feb_waitspare,$mar_waitspare,$apr_waitspare,$may_waitspare,$jun_waitspare,$jul_waitspare,$aug_waitspare,$sep_waitspare,$oct_waitspare,$nov_waitspare,$dec_waitspare);

    // repairing month count
    $jan_repairing = count(DB::table('techcarstatus')->where('status', 3)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of January')), date('Y-m-d', strtotime('Last day of January'))])->get());
    $feb_repairing = count(DB::table('techcarstatus')->where('status', 3)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of February')), date('Y-m-d', strtotime('Last day of February'))])->get());
    $mar_repairing = count(DB::table('techcarstatus')->where('status', 3)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of March')), date('Y-m-d', strtotime('Last day of March'))])->get());
    $apr_repairing = count(DB::table('techcarstatus')->where('status', 3)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of April')), date('Y-m-d', strtotime('Last day of April'))])->get());
    $may_repairing = count(DB::table('techcarstatus')->where('status', 3)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of May')), date('Y-m-d', strtotime('Last day of May'))])->get());
    $jun_repairing = count(DB::table('techcarstatus')->where('status', 3)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of June')), date('Y-m-d', strtotime('Last day of June'))])->get());
    $jul_repairing = count(DB::table('techcarstatus')->where('status', 3)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of July')), date('Y-m-d', strtotime('Last day of July'))])->get());
    $aug_repairing = count(DB::table('techcarstatus')->where('status', 3)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of August')), date('Y-m-d', strtotime('Last day of August'))])->get());
    $sep_repairing = count(DB::table('techcarstatus')->where('status', 3)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of September')), date('Y-m-d', strtotime('Last day of September'))])->get());
    $oct_repairing = count(DB::table('techcarstatus')->where('status', 3)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of October')), date('Y-m-d', strtotime('Last day of October'))])->get());
    $nov_repairing = count(DB::table('techcarstatus')->where('status', 3)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of November')), date('Y-m-d', strtotime('Last day of November'))])->get());
    $dec_repairing = count(DB::table('techcarstatus')->where('status', 3)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of December')), date('Y-m-d', strtotime('Last day of December'))])->get());
    $repairing = array($jan_repairing,$feb_repairing,$mar_repairing,$apr_repairing,$may_repairing,$jun_repairing,$jul_repairing,$aug_repairing,$sep_repairing,$oct_repairing,$nov_repairing,$dec_repairing);

    // success month count
    $jan_success = count(DB::table('techcarstatus')->where('status', 4)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of January')), date('Y-m-d', strtotime('Last day of January'))])->get());
    $feb_success = count(DB::table('techcarstatus')->where('status', 4)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of February')), date('Y-m-d', strtotime('Last day of February'))])->get());
    $mar_success = count(DB::table('techcarstatus')->where('status', 4)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of March')), date('Y-m-d', strtotime('Last day of March'))])->get());
    $apr_success = count(DB::table('techcarstatus')->where('status', 4)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of April')), date('Y-m-d', strtotime('Last day of April'))])->get());
    $may_success = count(DB::table('techcarstatus')->where('status', 4)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of May')), date('Y-m-d', strtotime('Last day of May'))])->get());
    $jun_success = count(DB::table('techcarstatus')->where('status', 4)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of June')), date('Y-m-d', strtotime('Last day of June'))])->get());
    $jul_success = count(DB::table('techcarstatus')->where('status', 4)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of July')), date('Y-m-d', strtotime('Last day of July'))])->get());
    $aug_success = count(DB::table('techcarstatus')->where('status', 4)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of August')), date('Y-m-d', strtotime('Last day of August'))])->get());
    $sep_success = count(DB::table('techcarstatus')->where('status', 4)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of September')), date('Y-m-d', strtotime('Last day of September'))])->get());
    $oct_success = count(DB::table('techcarstatus')->where('status', 4)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of October')), date('Y-m-d', strtotime('Last day of October'))])->get());
    $nov_success = count(DB::table('techcarstatus')->where('status', 4)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of November')), date('Y-m-d', strtotime('Last day of November'))])->get());
    $dec_success = count(DB::table('techcarstatus')->where('status', 4)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of December')), date('Y-m-d', strtotime('Last day of December'))])->get());
    $success = array($jan_success,$feb_success,$mar_success,$apr_success,$may_success,$jun_success,$jul_success,$aug_success,$sep_success,$oct_success,$nov_success,$dec_success);

    // send month count
    $jan_send = count(DB::table('techcarstatus')->where('status', 5)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of January')), date('Y-m-d', strtotime('Last day of January'))])->get());
    $feb_send = count(DB::table('techcarstatus')->where('status', 5)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of February')), date('Y-m-d', strtotime('Last day of February'))])->get());
    $mar_send = count(DB::table('techcarstatus')->where('status', 5)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of March')), date('Y-m-d', strtotime('Last day of March'))])->get());
    $apr_send = count(DB::table('techcarstatus')->where('status', 5)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of April')), date('Y-m-d', strtotime('Last day of April'))])->get());
    $may_send = count(DB::table('techcarstatus')->where('status', 5)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of May')), date('Y-m-d', strtotime('Last day of May'))])->get());
    $jun_send = count(DB::table('techcarstatus')->where('status', 5)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of June')), date('Y-m-d', strtotime('Last day of June'))])->get());
    $jul_send = count(DB::table('techcarstatus')->where('status', 5)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of July')), date('Y-m-d', strtotime('Last day of July'))])->get());
    $aug_send = count(DB::table('techcarstatus')->where('status', 5)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of August')), date('Y-m-d', strtotime('Last day of August'))])->get());
    $sep_send = count(DB::table('techcarstatus')->where('status', 5)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of September')), date('Y-m-d', strtotime('Last day of September'))])->get());
    $oct_send = count(DB::table('techcarstatus')->where('status', 5)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of October')), date('Y-m-d', strtotime('Last day of October'))])->get());
    $nov_send = count(DB::table('techcarstatus')->where('status', 5)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of November')), date('Y-m-d', strtotime('Last day of November'))])->get());
    $dec_send = count(DB::table('techcarstatus')->where('status', 5)->whereBetween('date_in', [date('Y-m-d', strtotime('First day of December')), date('Y-m-d', strtotime('Last day of December'))])->get());
    $send = array($jan_send,$feb_send,$mar_send,$apr_send,$may_send,$jun_send,$jul_send,$aug_send,$sep_send,$oct_send,$nov_send,$dec_send);

    $data = array('waitrepair'=>$waitrepair,'waitspare'=>$waitspare,'repairing'=>$repairing,'success'=>$success,'send'=>$send);

    echo json_encode($data);
  }
}
