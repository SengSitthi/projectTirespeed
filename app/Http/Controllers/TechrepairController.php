<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, DB, Validator;
use Illuminate\Support\Str;

class TechrepairController extends Controller
{
  ////////////////////////////////////////////////// repair no data /////////////////////////////////////////////
  public function index()
  {
    $typespares = DB::table('typespares')->orderBy('typesparename', 'asc')->get();
    return view('manage/technical/rpnoidnew')->with('typespares', $typespares);
  }

  // function get type spares
  public function fnGettypeSparedt(Request $req)
  {
    $typesparesid = $req->typesparesid;
    $result = "";
    $spares = DB::table('spares')->where('typesparesid', $typesparesid)->get();
    if(count($spares) > 0){
      foreach($spares as $sp){
        $result .= '
          <option value="'.$sp->sparesid.'">'.$sp->sparesname.'</option>
        ';
      }
    }else{
      $result .= '<option value="">ບໍ່​ມີ​ອະ​ໄຫຼ່​ໃນ​ລະ​ບົບ​ສ້ອມ​ນີ້</option>';
    }
    $data = array('result'=>$result);
    echo json_encode($data);
  }

  public function fnInsertnewrpno(Request $req)
  {
    $this->validate($req, [
      'sparesid' => 'required'
    ]);
    if(count(DB::table('repairsno')->where('rpnoid', $req->input('repairid'))->get()) > 0){
      return back()->with('error', 'ID is already!');
    }else{
      $datainsert = array('rpnoid' => $req->input('repairid'), 'sparesid' => $req->input('sparesid'), 'created_at' => date('Y-m-d H:i:s'));
      DB::table('repairsno')->insert($datainsert);
      return redirect('addnewrepairid')->with('success', 'Add new repairno ID success!');
    }
  }

  // function show list rpnoid
  public function fnRpnoidlist()
  {
    $rpnodata = DB::table('repairsno')->join('spares', 'spares.sparesid', '=', 'repairsno.sparesid')
                                     ->select('repairsno.*','spares.*')->orderBy('rpnoid', 'desc')
                                     ->get();
    $typespares = DB::table('typespares')->orderBy('typesparename', 'asc')->get();
    return view('manage/technical/rpnoidlist')->with('rpnodata', $rpnodata)->with('typespares', $typespares);
  }

  // function get data
  public function fnGetrpnodata(Request $req)
  {
    $rpnoid = $req->rpnoid;
    $rpnodata = DB::table('repairsno')
    ->join('spares', 'spares.sparesid', '=', 'repairsno.sparesid')
    ->where('rpnoid', $rpnoid)
    ->select('repairsno.*','spares.typesparesid')->get();
    foreach($rpnodata as $rp){
      $typesparesid = $rp->typesparesid;
      $sparesid = $rp->sparesid;
    }
    $data = array('typesparesid'=>$typesparesid, 'sparesid' => $sparesid);
    echo json_encode($data);
  }

  // function update repair no data
  public function fnUpdaterpnodata(Request $req)
  {
    $this->validate($req, [
      'sparesid' => 'required'
    ]);

    $dataupdate = array('sparesid' => $req->input('sparesid'));
    DB::table('repairsno')->where('rpnoid', $req->input('editrpnoid'))->update($dataupdate);
    return redirect('rpnoidlist')->with('success', 'Update repair no success');
  }

  // function delete rpnoid
  public function fnDeleterpnoid($rpnoid)
  {
    DB::table('repairsno')->where('rpnoid', $rpnoid)->delete();
    return redirect('rpnoidlist')->with('success', 'Delete repair successfully!');
  }

  // function search repairsno data
  public function fnSearchRpnoid(Request $req)
  {
    $result = "";
    $textsearch = $req->textsearch;
    $sqlsearch = DB::table('repairsno')->join('spares', 'spares.sparesid', '=', 'repairsno.sparesid')
      ->where('spares.sparesname', 'like', '%'.$textsearch.'%')->orWhere('repairsno.rpnoid', 'like', '%'.$textsearch.'%')
      ->select('repairsno.*','spares.*')->get();
    if(count($sqlsearch) > 0){
      foreach ($sqlsearch as $ss) {
        $result .= '
        <tr>
          <td>'.$ss->rpnoid.'</td>
          <td>'.$ss->sparesid.'</td>
          <td>'.$ss->sparesname.'</td>
          <td class="text-center">
            <button class="btn btn-primary" type="button" id="btnEdit" value="'.$ss->rpnoid.'"><i class="mdi mdi-grease-pencil"></i></button>
          </td>
          <td class="text-center">
            <button class="btn btn-danger" type="button" id="btnDelete" value="'.$ss->rpnoid.'"><i class="mdi mdi-trash-can"></i></button>
          </td>
        </tr>
        ';
      }
    }else{
      $result .= '
      <tr>
        <td colspan="5">
          <h3 class="text-center">ບໍ່​ມີ​ຂໍ້​ມູນ​ລະ​ຫັດ​ສ້ອມໃນ​ລະ​ບົບ</h3>
        </td>
      </tr>
      ';
    }
    $data = array('result' => $result);
    echo json_encode($data);
  }
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
    return view('manage/technical/index');
  }
}
