<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Validator, Auth;
use Illuminate\Support\Str;

class RepairbillController extends Controller
{
  public function index()
  {
    $repairbill = DB::table('repairbill')->select('rpbid')->orderBy('rpbid', 'desc')->take(1)->get();
    if(count($repairbill) > 0){
      // $rpbid = "RP00000001";
      foreach($repairbill as $rpb){
        $repairbillid = $rpb->rpbid;
      }
      $strstring = Str::substr($repairbillid, 2, 10);
      $sum = (int)$strstring + 1;
      if(strlen($sum) == 1){
        $num = "0000000".$sum;
      }else if($sum == 2){
        $num = "000000".$sum;
      }else if($sum == 3){
        $num = "00000".$sum;
      }else if($sum == 4){
        $num = "0000".$sum;
      }else if($sum == 5){
        $num = "000".$sum;
      }else if($sum == 6){
        $num = "00".$sum;
      }else if($sum == 7){
        $num = "0".$sum;
      }else if($sum == 5){
        $num = $sum;
      }
    }else{
      $num = "00000001";
    }
    $rpbid = "RP".$num;
    $receivecars = DB::table('receivecars')->orderBy('rcsid', 'desc')->get();
    return view('manage/technical/repairbillnew')->with('rpbid', $rpbid)->with('receivecars', $receivecars);
  }

  // function show repair
  public function fnGetSparename(Request $req)
  {
    $textsearch = $req->textsearch;
    $datasearch = DB::table('repairsno')->join('spares', 'spares.sparesid', '=', 'repairsno.sparesid')
    ->where('repairsno.rpnoid', 'like', '%'.$textsearch.'%')->select('spares.sparesname')->get();
    if(count($datasearch) > 0){
      foreach($datasearch as $dts){
        $sparesname = $dts->sparesname;
      }
    }else{
      $sparesname = "ບໍ່​ມີ​ລາຍ​ນີ້ໃນ​ລະ​ບົບ!";
    }
    $data = array('sparesname'=>$sparesname);
    echo json_encode($data);
  }

  // function show repair
  public function fnGetwagedata(Request $req)
  {
    $textsearch = $req->textsearch;
    $datasearch = DB::table('wages')->join('unitrepairs', 'unitrepairs.unitrpid', '=', 'unitrepairs.unitrpid')
                                    ->where('wages.wageid', 'like', '%'.$textsearch.'%')
                                    ->select('wages.*','unitrepairs.*')->get();
    if(count($datasearch) > 0){
      foreach($datasearch as $dts){
        $wagename = $dts->wagename;
        $unitrpname = $dts->unitrpname;
      }
    }else{
      $wagename = "ບໍ່​ມີ​ຂໍ້​ມູນ​ນີ້​ໃນ​ລະ​ບົບ!";
      $unitrpname = "ບໍ່​ມີ​ຂໍ້​ມູນ​ນີ້​ໃນ​ລະ​ບົບ!";
    }
    $data = array('wagename'=>$wagename, 'unitrpname'=>$unitrpname);
    echo json_encode($data);
  }

  // function insert new rpbill
  public function fnInsertnewrpbill(Request $req)
  {
    $this->validate($req, [
      'rcsid' => 'required'
    ]);

    $rpbdata = array(
      'rpbid' => $req->input('rpbid'),
      'rcsid' => $req->input('rcsid'),
      'rpbdate' => $req->input('rpbdate'),
      'created_at' => date('Y-m-d H:i:s')
    );

    $rpnoid = $req->input('rpnoid');
    for ($i=0; $i < count($rpnoid); $i++){
      $rpbdetaildata = array(
        'rpbid' => $req->input('rpbid'),
        'rpnoid' => $req->input('rpnoid')[$i],
        'useqty' => $req->input('useqty')[$i],
        'wageid' => $req->input('wageid')[$i],
        'created_at' => date('Y-m-d')
      );
      $detaildata[] = $rpbdetaildata;
    }
    $checkrow = DB::table('repairbill')->where('rpbid', $req->input('rpbid'))->get();
    if(count($checkrow) > 0){
      return back()->with('already_rpbid', 'This id has already!');
    }else{
      DB::table('repairbill')->insert($rpbdata);
      DB::table('repairbill_detail')->insert($detaildata);
      $rpbpersonaldata = DB::table('repairbill')
      ->join('receivecars', 'receivecars.rcsid', '=', 'repairbill.rcsid')
      ->join('customers', 'customers.cusid', '=', 'receivecars.cusid')->join('districts', 'districts.disid', '=', 'customers.disid')->join('provinces', 'provinces.proid', '=', 'customers.proid')
      ->join('cars', 'cars.carid', '=', 'cars.carid')->join('brands', 'brands.brandid', '=', 'cars.brandid')
      ->where('repairbill.rpbid', '=', $req->input('rpbid'))
      ->select('repairbill.*', 'receivecars.*', 'customers.*', 'cars.*','districts.disname','provinces.proname','brands.brandname')->take(1)->get();
      
      $spares = DB::table('repairbill_detail')->join('repairsno', 'repairsno.rpnoid', '=', 'repairbill_detail.rpnoid')
      ->join('spares', 'spares.sparesid', '=', 'repairsno.sparesid')->join('unitspare', 'unitspare.unitid', '=', 'spares.unitid')
      ->where('repairbill_detail.rpbid', '=', $req->input('rpbid'))
      ->select('repairsno.rpnoid','spares.*','unitspare.unitname','repairbill_detail.useqty')->get();
      
      $wages = DB::table('wages')->join('repairbill_detail', 'repairbill_detail.wageid', '=', 'wages.wageid')
      ->join('typecars', 'typecars.tcarid', '=', 'wages.tcarid')
      ->where('repairbill_detail.rpbid', '=', $req->input('rpbid'))->select('wages.*','typecars.tcarname')->get();
      $no = 1;
      $no1 = 1;
      $link = "repairbillnew";
      return view('manage/technical/repairbillprint')->with('rpbpersonaldata', $rpbpersonaldata)->with('spares', $spares)
      ->with('wages', $wages)->with('no', $no)->with('no1', $no1)->with('link', $link);
    }
  }

  public function fnRpbillList(Request $req)
  {
    $receivecars = DB::table('receivecars')->orderBy('rcsid', 'desc')->get();
    $rpbills = DB::table('repairbill')->orderBy('rpbid', 'desc')->paginate(30);
    return view('manage/technical/repairbilllist')->with('rpbills', $rpbills)->with('receivecars', $receivecars);
  }

  // function print repair bill
  public function fnPrintrpbill($rpbid)
  {
    $rpbpersonaldata = DB::table('repairbill')
      ->join('receivecars', 'receivecars.rcsid', '=', 'repairbill.rcsid')
      ->join('customers', 'customers.cusid', '=', 'receivecars.cusid')->join('districts', 'districts.disid', '=', 'customers.disid')->join('provinces', 'provinces.proid', '=', 'customers.proid')
      ->join('cars', 'cars.carid', '=', 'cars.carid')->join('brands', 'brands.brandid', '=', 'cars.brandid')
      ->where('repairbill.rpbid', '=', $rpbid)
      ->select('repairbill.*', 'receivecars.*', 'customers.*', 'cars.*','districts.disname','provinces.proname','brands.brandname')->take(1)->get();
      
      $spares = DB::table('repairbill_detail')->join('repairsno', 'repairsno.rpnoid', '=', 'repairbill_detail.rpnoid')
      ->join('spares', 'spares.sparesid', '=', 'repairsno.sparesid')->join('unitspare', 'unitspare.unitid', '=', 'spares.unitid')
      ->where('repairbill_detail.rpbid', '=', $rpbid)
      ->select('repairsno.rpnoid','spares.*','unitspare.unitname','repairbill_detail.useqty')->get();
      
      $wages = DB::table('wages')->join('repairbill_detail', 'repairbill_detail.wageid', '=', 'wages.wageid')
      ->join('typecars', 'typecars.tcarid', '=', 'wages.tcarid')
      ->where('repairbill_detail.rpbid', '=', $rpbid)->select('wages.*','typecars.tcarname')->get();
      $no = 1;
      $no1 = 1;
      $link = "repairbill_list";
      return view('manage/technical/repairbillprint')->with('rpbpersonaldata', $rpbpersonaldata)->with('spares', $spares)
      ->with('wages', $wages)->with('no', $no)->with('no1', $no1)->with('link', $link);
  }

  // function get show repairbill detail table to show on modal
  public function fnGetShowrpbdetail(Request $req)
  {
    $rpbid = $req->rpbid;
    $result = "";
    $rpbdt = DB::table('repairbill_detail')->join('repairsno', 'repairsno.rpnoid', '=', 'repairbill_detail.rpnoid')
                                           ->join('spares', 'spares.sparesid', '=', 'repairsno.sparesid')
                                           ->join('wages', 'wages.wageid', '=', 'repairbill_detail.wageid')
                                           ->join('unitrepairs', 'unitrepairs.unitrpid', '=', 'wages.unitrpid')
                                           ->where('repairbill_detail.rpbid', '=', $rpbid)
                                           ->select('repairbill_detail.rpbdtid','repairsno.rpnoid','spares.sparesname','repairbill_detail.useqty','wages.wageid','wages.wagename','unitrepairs.unitrpname')
                                           ->get();
    if(count($rpbdt) > 0){
      foreach ($rpbdt as $rdt) {
        $result .= '
        <tr>
          <td>'.$rdt->rpnoid.'</td>
          <td>'.$rdt->sparesname.'</td>
          <td>'.$rdt->useqty.'</td>
          <td>'.$rdt->wageid.'</td>
          <td>'.$rdt->wagename.'</td>
          <td>'.$rdt->unitrpname.'</td>
          <td>
            <button class="btn btn-danger btn-sm" type="button" id="btnTrashlist" value="'.$rdt->rpbdtid.'"><i class="mdi mdi-trash-can"></i></button>
          </td>
        </tr>
        ';
      }
    }else{
      $result .= '<tr><td colspan="7" class="text-center"><h4>ຍັງ​ບໍ່​ມີ​ລາຍ​ການ​ໃນ​ລະ​ບົບ!</h4></td></tr>';
    }
    $data = array('result' => $result);
    echo json_encode($data);
  }

  // function add new rpb detail
  public function fnAddnewrplist(Request $req)
  {
    // $rpbid = $req->rpbid;
    $addnewlist = array(
      'rpbid' => $req->rpbid,
      'rpnoid' => $req->rpnoid,
      'useqty' => $req->useqty,
      'wageid' => $req->wageid,
      'created_at' => date('Y-m-d H:i:s')
    );
    DB::table('repairbill_detail')->insert($addnewlist);
    $data = "ການ​ເພີ່ມ​ລາຍ​ການ​ໃໝ່​ສຳ​ເລັດ!";
    echo json_encode($data);
  }

  // function delete rpbdetail data
  public function fnDelrpblistdata(Request $req)
  {
    $rpbdtid = $req->rpbdtid;
    DB::table('repairbill_detail')->where('rpbdtid', $rpbdtid)->delete();
    $data = "ການ​ລົບ​ລາຍ​ການສຳ​ເລັດ";
    echo json_encode($data);
  }

  // function get rpb data to edit
  public function fnGeteditrpbdata(Request $req)
  {
    $rpbid = $req->rpbid;
    $rpbdt = DB::table('repairbill')->where('rpbid', $rpbid)->get();
    foreach($rpbdt as $rpb){
      $rcsid = $rpb->rcsid;
      $rpbdate = $rpb->rpbdate;
    }
    $data = array(
      'rcsid' => $rcsid,
      'rpbdate' => $rpbdate
    );
    echo json_encode($data);
  }

  // function update repair bill date
  public function fnUpdateRpbdate(Request $req)
  {
    $dataupdate = array('rpbdate' => $req->input('rpbdate'), 'updated_at' => date('Y-m-d H:i:s'));
    DB::table('repairbill')->where('rpbid', $req->input('rpbid1'))->update($dataupdate);
    return redirect('repairbill_list')->with('success', 'Update successfully!');
  }

  // function delete repair bill data
  public function fnDeleterpb($rpbid)
  {
    DB::table('repairbill')->where('rpbid', $rpbid)->delete();
    return redirect('repairbill_list')->with('success', 'Delete successfully!');
  }

  // function search rpb data
  public function fnSearchrpb(Request $req)
  {
    $result = "";
    $textsearch = $req->textsearch;
    $datasearch = DB::table('repairbill')->where('rpbid', 'like', '%'.$textsearch.'%')->orWhere('rcsid', 'like', '%'.$textsearch.'%')->orWhere('rpbdate', 'like', '%'.$textsearch.'%')->get();
    if(count($datasearch) > 0){
      foreach($datasearch as $ds){
        $result .= '
        <tr>
          <td>'.$ds->rpbid.'</td>
          <td>'.$ds->rcsid.'</td>
          <td>'.$ds->rpbdate.'</td>
          <td class="text-center">
            <a href="/printrpbill/'.$ds->rpbid.'" class="btn btn-primary btn-sm"><i class="mdi mdi-printer"></i></a>
          </td>
          <td><button class="btn btn-primary btn-sm" type="button" id="btnEditList" value="'.$ds->rpbid.'"><i class="mdi mdi-file-document-edit"></i></button></td>
          <td class="text-center">
            <div class="btn-group dropleft">
              <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-dots-horizontal"></i>
              </button>
              <div class="dropdown-menu">
                <button class="dropdown-item" id="btnEditrpb" value="'.$ds->rpbid.'"><i class="mdi mdi-pen"></i> ແກ້​ໄຂ​ວັນ​ທີ່</button>
                <button class="dropdown-item" id="btnTrashrpb" value="'.$ds->rpbid.'"><i class="mdi mdi-trash-can-outline"></i> ລຶບ</a>
              </div>
            </div>
          </td>
        </tr>
        ';
      }
    }else{
      $result .= '
      <tr>
        <td colspan="6">
          <h4 class="text-center">ບໍ່​ມີ​ຂໍ້​ມູນ​ໃບ​ເປີດ​ງານ​ສ້ອມ​ໃນ​ລະ​ບົບ</h4>
        </td>
      </tr>';
    }
    $data = array('result' => $result);
    echo json_encode($data);
  }
}
