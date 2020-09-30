<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, DB, Validator;
use Illuminate\Support\Str;

class TechrepairController extends Controller
{
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
}
