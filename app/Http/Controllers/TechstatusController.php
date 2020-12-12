<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Validator;

class TechstatusController extends Controller
{
  // function check car status
  public function fnTechcarstatus(Request $req)
  {
    $repairbill = DB::table('repairbill')->orderBy('rpbid', 'desc')->get();
    $techcarstatus = DB::table('techcarstatus')->join('repairbill', 'repairbill.rpbid', '=', 'techcarstatus.rpbid')
    ->join('receivecars', 'receivecars.rcsid', '=', 'repairbill.rcsid')->join('cars', 'cars.carid', '=', 'receivecars.carid')
    ->select('cars.license','techcarstatus.*')->orderBy('techcarstatus.tcsid', 'desc')->paginate(30);
    $i = 1;
    return view('manage/technical/carstatus')->with('repairbill', $repairbill)->with('techcarstatus', $techcarstatus)->with('i', $i);
  }

  // function get car data from receive
  public function fnGetreceivedata(Request $req)
  {
    $rpbid = $req->rpbid;
    $rcsdata = DB::table('repairbill')->join('receivecars', 'receivecars.rcsid', '=', 'repairbill.rcsid')
    ->join('cars', 'cars.carid', '=', 'receivecars.carid')->where('repairbill.rpbid', '=', $rpbid)
    ->select('cars.license','receivecars.date_receive','receivecars.time_receive')->get();
    foreach($rcsdata as $rcs){
      $license = $rcs->license;
      $date_in = $rcs->date_receive;
      $time_in = $rcs->time_receive;
    }
    $data = array('license'=>$license,'date_in'=>$date_in,'time_in'=>$time_in);
    echo json_encode($data);
  }

  // function insert new car status
  public function fnIntechcarsdata(Request $req)
  {
    $this->validate($req, [
      'rpbid' => 'required'
    ]);

    $datainsert = array(
      'rpbid'=>$req->input('rpbid'),
      'date_in'=>$req->input('date_in'),
      'time_in'=>$req->input('time_in'),
      'status'=>"1",
      'remark'=>$req->input('remark'),
      'created_at' => date('Y-m-d H:i:s')
    );
    DB::table('techcarstatus')->insert($datainsert);
    return redirect('techcarstatus')->with('success', 'Insert successfully!');
  }

  // function update date out of car
  public function fnUpdateDateout(Request $req)
  {
    $dateupdate = array('date_out'=>$req->input('date_out'), 'updated_at'=>date('Y-m-d H:i:s'));
    DB::table('techcarstatus')->where('tcsid', $req->input('editdate_out'))->update($dateupdate);
    return redirect('techcarstatus')->with('success', 'Update Date out success');
  }

  // function update date out of car
  public function fnUpdateTimeout(Request $req)
  {
    $dateupdate = array('time_out'=>$req->input('time_out'), 'updated_at' => date('Y-m-d H:i:s'));
    DB::table('techcarstatus')->where('tcsid', $req->input('edittime_out'))->update($dateupdate);
    return redirect('techcarstatus')->with('success', 'Update Date out success');
  }

  // function update status of car
  public function fnUpdateStatus(Request $req)
  {
    $dataupdate = array('status'=>$req->input('status'),'updated_at'=>date('Y-m-d H:i:s'));
    DB::table('techcarstatus')->where('tcsid', $req->input('statusid'))->update($dataupdate);
    return redirect('techcarstatus')->with('success', 'Update car status success');
  }

  // function delete car status data
  public function fnDelCarStatus($tcsid)
  {
    DB::table('techcarstatus')->where('tcsid', $tcsid)->delete();
    return redirect('techcarstatus')->with('success', 'Delete car status success');
  }
}
