<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, DB, Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ReceiveController extends Controller
{
  // show receive page
  public function fnReceiveSpare()
  {
    $sqlreceiveid = DB::table('receive')->select('receiveid')->orderBy('receiveid', 'desc')->take(1)->get();
    foreach($sqlreceiveid as $sreid){
      $id = $sreid->receiveid;
    }
    if(count($sqlreceiveid) > 0){
      // $id = "RE00001.2020";
      $strstring = Str::substr($id, 2, 8);
      $sum = (int)$strstring + 1;
      $reid = strlen($sum);
      if($reid == 1){
        $receiveid = "0000".$sum;
      }else if($reid == 2){
        $receiveid = "000".$sum;
      }else if($reid == 3){
        $receiveid = "00".$sum;
      }else if($reid == 4){
        $receiveid = "0".$sum;
      }else{
        $receiveid = $sum;
      }
    }else{
      $receiveid = "00001";
    }
    $sqlorderid = DB::table('order')->get();
    return view('manage/stocker/receive')->with('receiveid', $receiveid)
                                        ->with('orderid', $sqlorderid);
  }

  // function search spares from orderdetail by orderid
  public function fnSearchOrderlist(Request $req)
  {
    $orderid = $req->orderid;
    $sparesid = $req->sparesid;
    
    $sqlspares = DB::table('orderdetail')
    ->join('brandspares', 'brandspares.brandspareid', '=', 'orderdetail.brandspareid')
    ->join('unitspare', 'unitspare.unitid', '=', 'orderdetail.unitid')
    ->where('orderid', $orderid)->where('sparesid', $sparesid)
    ->select('orderdetail.*','brandspares.*','unitspare.*')
    ->get();
    if(count($sqlspares) > 0){
      foreach($sqlspares as $sp){
        $sparesname = $sp->sparesname;
        $brandspareid = $sp->brandspareid;
        $brandsparename = $sp->brandsparename;
        $model = $sp->model;
        $madeyear = $sp->madeyear;
        $unitid = $sp->unitid;
        $unitname = $sp->unitname;
      }
    }else{
      $sparesname = "ບໍ່​ມີ​ຂໍ​້​ມູນ";
      $brandspareid = "ບໍ່​ມີ​ຂໍ​້​ມູນ";
      $brandsparename = "ບໍ່​ມີ​ຂໍ​້​ມູນ";
      $model = "ບໍ່​ມີ​ຂໍ​້​ມູນ";
      $madeyear = "ບໍ່​ມີ​ຂໍ​້​ມູນ";
      $unitid = "ບໍ່​ມີ​ຂໍ​້​ມູນ";
      $unitname = "ບໍ່​ມີ​ຂໍ​້​ມູນ";
    }
    $data = array(
      'sparesname' => $sparesname,
      'brandspareid' => $brandspareid,
      'brandsparename' => $brandsparename,
      'model' => $model,
      'madeyear' => $madeyear,
      'unitid' => $unitid,
      'unitname' => $unitname
    );
    echo json_encode($data);
  }

  // function insert receive data
  public function fnReceiveSpares(Request $req)
  {
    $this->validate($req, [
      'filepdf' => 'required|mimes:pdf|max:4096',
    ]);
    $filename = time().'.'.$req->file('filepdf')->getClientOriginalExtension();
    $invoicenum = $req->input('invoicenum');
    if($invoicenum == ""){
      $invoice = "ບໍ່​ມີ";
    }else{
      $invoice = $req->input('invoicenum');
    }
    if($req->input('receive_date') == ""){
      $receivedate = date('Y-m-d');
    }else{
      $receivedate = $req->input('receive_date');
    }
    $receivedata = array(
      'receiveid' => $req->input('receiveid'),
      'userreceive' => $req->input('username'),
      'receivedate' => $receivedate,
      'invoicenum' => $invoice,
      'orderid' => $req->input('orderid'),
      'sendername' => $req->input('sendername'),
      'filepdf' => $filename,
      'created_at' => date('Y-m-d')
    );
    $req->file('filepdf')->move(public_path('/stockfiles'), $filename);
    DB::table('receive')->insert($receivedata);
    $sparesid = $req->input('sparesid');
    for ($i=0; $i < count($sparesid); $i++) { 
      $receivedetail = array(
        'receiveid' => $req->input('receiveid'),
        'sparesid' => $req->input('sparesid')[$i],
        'sparesname' => $req->input('sparesname')[$i],
        'brandspareid' => $req->input('brandspareid')[$i],
        'model' => $req->input('model')[$i],
        'madeyear' => $req->input('madeyear')[$i],
        'receiveqty' => $req->input('receiveqty')[$i],
        'receiveprice' => $req->input('price')[$i],
        'unitid' => $req->input('unitid')[$i],
        'receivetotal' => $req->input('total')[$i],
        'remark' => $req->input('remark')[$i],
        'created_at' => date('Y-m-d') 
      );
      $inreceivedetail[] = $receivedetail;
    }
    DB::table('receivedetail')->insert($inreceivedetail);
    $receives = DB::table('receive')->where('receiveid', $req->input('receiveid'))->get();
    $receivedetail = DB::table('receivedetail')
    ->join('unitspare', 'unitspare.unitid', '=', 'receivedetail.unitid')
    ->where('receivedetail.receiveid', '=', $req->input('receiveid'))
    ->select('receivedetail.*','unitspare.*')->get();
    $url = "receive";
    $i = 1;
    $count = count($receivedetail);
    return view('manage/stocker/receiveprint')->with('receives', $receives)
                                              ->with('receivedetail', $receivedetail)
                                              ->with('url', $url)
                                              ->with('i', $i)
                                              ->with('count', $count);
  }

  // receive list page
  public function fnReceiveList()
  {
    $receives = DB::table('receive')->orderBy('receiveid', 'desc')->paginate(20);
    $count = count($receives);
    return view('manage/stocker/receivelist')->with('receives', $receives)
                                             ->with('count', $count);
  }

  // function show receive list detail by receive id
  public function fnLoadReceivedetail(Request $req)
  {
    $result = "";
    $receiveid = $req->receiveid;
    $sqlreceivedetail = DB::table('receivedetail')
    ->join('brandspares','brandspares.brandspareid', '=', 'receivedetail.brandspareid')
    ->join('unitspare', 'unitspare.unitid', '=', 'receivedetail.unitid')
    ->where('receivedetail.receiveid', '=', $receiveid)
    ->select('receivedetail.*','brandspares.*','unitspare.*')->get();
    $i = 1;
    if(count($sqlreceivedetail) > 0){
      foreach ($sqlreceivedetail as $redt) {
        $result .= '
        <tr>
          <td>'.$i++.'</td>
          <td>'.$redt->sparesid.'</td>
          <td>'.$redt->sparesname.'</td>
          <td>'.$redt->brandsparename.'</td>
          <td>'.$redt->model.'</td>
          <td>'.$redt->madeyear.'</td>
          <td>'.$redt->receiveqty.'</td>
          <td>'.number_format($redt->receiveprice).'</td>
          <td>'.$redt->unitname.'</td>
          <td>'.number_format($redt->receivetotal).'</td>
          <td>'.$redt->remark.'</td>
          <td class="text-center">
            <button class="btn btn-danger" type="button" id="btnTrash" value="'.$redt->receivedetailid.'"><i class="mdi mdi-trash-can-outline"></i></button>
          </td>
        </tr>
        ';
      }
    }else{
      $result .= '
      <tr>
        <td clospan="11">
          <h5 classt="text-center">ບໍ່​ມີ​ຂໍ້​ມູນ​ລາຍ​ການ​ຮັບ</h4>
        </td>
      </tr>
      ';
    }
    $data = array(
      'result' => $result,
      'count' => count($sqlreceivedetail)
    );
    echo json_encode($data);
  }

  public function fnInsertNewReceive(Request $req)
  {
    $checknew = DB::table('receivedetail')->where('receiveid', $req->receiveid)->where('sparesid', $req->sparesid)->get();
    if(count($checknew) > 0){
      foreach($checknew as $cn){
        $receiveqty = $cn->receiveqty;
        $receivetotal = $cn->receivetotal;
      }
      $qty = array('receiveqty' => (int)$receiveqty + (int)$req->receiveqty, 'receivetotal' => (int)$receivetotal + (int)$req->total, 'remark' => $req->remark, 'updated_at' => date('Y-m-d H:i:s'));
      DB::table('receivedetail')->where('receiveid', $req->receiveid)->where('sparesid', $req->sparesid)->update($qty);
    }else{
      $innew = array(
        'receiveid' => $req->receiveid,
        'sparesid' => $req->sparesid,
        'sparesname' => $req->sparesname,
        'brandspareid' => $req->brandspareid,
        'model' => $req->model,
        'madeyear' => $req->madeyear,
        'receiveqty' => $req->receiveqty,
        'receiveprice' => $req->price,
        'unitid' => $req->unitid,
        'receivetotal' => $req->total,
        'remark' => $req->remark,
        'created_at' => date('Y-m-d H:i:s')
      );
      DB::table('receivedetail')->insert($innew);
    }
    $data = "ການ​ເພີ່ມ​ສຳ​ເລັດ!";
    echo json_encode($data);
  }

  // function delete receive list by id
  public function fnDeleteReceivedt(Request $req)
  {
    $receivedetailid = $req->receivedetailid;
    DB::table('receivedetail')->where('receivedetailid', $receivedetailid)->delete();
    $data = "ການ​ລົບ​ສຳ​ເລັດ";
    echo json_encode($data);
  }

  // function get receive data to edit
  public function fnGetreceivedata(Request $req)
  {
    $receiveid = $req->receiveid;
    $sqlreceivedt = DB::table('receive')->where('receiveid', $receiveid)->get();
    foreach ($sqlreceivedt as $rcdt) {
      $receivedate = $rcdt->receivedate;
      $invoicenum = $rcdt->invoicenum;
      $sendername = $rcdt->sendername;
    }
    $data = array(
      'receivedate' => $receivedate,
      'invoicenum' => $invoicenum,
      'sendername' => $sendername,
    );
    echo json_encode($data);
  }

  // funcion update receive data
  public function fnUpdateReceive(Request $req)
  {
    if($req->file('filepdf') == ""){   
      $dataupdate = array(
        'invoicenum' => $req->input('invoicenum'),
        'receivedate' => $req->input('receive_date'),
        'sendername' => $req->input('sendername'),
        'updated_at' => date('Y-m-d H:m:s')
      );
    }else{
      $this->validate($req, [
        'filepdf' => 'mimes:pdf|max:4096'
      ]);
      $filename = time().'.'.$req->file('filepdf')->getClientOriginalExtension();
      $oldfile = DB::table('receive')->where('receiveid', $req->input('updatereceiveid'))->get();
      if(count($oldfile) > 0 ){
        foreach($oldfile as $oldf){
          $filepdf = $oldf->filepdf;
        }
        $filepath = public_path('stockfiles/'.$filepdf);
        if(File::exists($filepath)){
          unlink($filepath);
        }
        $req->file('filepdf')->move(public_path('/stockfiles'), $filename);
      }

      $dataupdate = array(
        'invoicenum' => $req->input('invoicenum'),
        'receivedate' => $req->input('receive_date'),
        'sendername' => $req->input('sendername'),
        'filepdf' => $filename,
        'updated_at' => date('Y-m-d H:m:s')
      );
    }
    DB::table('receive')->where('receiveid', $req->input('updatereceiveid'))->update($dataupdate);
    return redirect('receivelist')->with('success', 'Update success');
  }

  // function delete receive data
  public function fnDeleteReceive($receiveid)
  {
    $filepdf = DB::table('receive')->where('receiveid', $receiveid)->select('filepdf');
    DB::table('receive')->where('receiveid', $receiveid)->delete();
    return redirect('receivelist')->with('success', 'Delete success');
  }

  // function receive print
  public function fnReceivePrint($receiveid)
  {
    $receives = DB::table('receive')->where('receiveid', $receiveid)->get();
    $receivedetail = DB::table('receivedetail')
    ->join('unitspare', 'unitspare.unitid', '=', 'receivedetail.unitid')
    ->where('receivedetail.receiveid', '=', $receiveid)
    ->select('receivedetail.*','unitspare.*')->get();
    $url = "receivelist";
    $i = 1;
    $count = count($receivedetail);
    return view('manage/stocker/receiveprint')->with('receives', $receives)
                                              ->with('receivedetail', $receivedetail)
                                              ->with('url', $url)
                                              ->with('i', $i)
                                              ->with('count', $count);
  }

  // function search receive data
  public function fnSearchReceive(Request $req)
  {
    $datasearch = $req->datasearch;
    $result = "";
    $sqlsearch = DB::table('receive')->where('receiveid', 'like', '%'.$datasearch.'%')->orWhere('orderid', 'like', '%'.$datasearch.'%')->get();
    if(count($sqlsearch) > 0){
      foreach ($sqlsearch as $sr) {
        $result .= '
        <tr>
          <td>'.$sr->receiveid.'</td>
          <td>'.$sr->orderid.'</td>
          <td>'.$sr->invoicenum.'</td>
          <td>'.$sr->receivedate.'</td>
          <td>'.$sr->userreceive.'</td>
          <td>
            <a class="btn btn-primary" href="/receiveprint/'.$sr->receiveid.'"><i class="mdi mdi-printer"></i></a>
          </td>
          <td>'.$sr->sendername.'</td>
          <td>
            <div class="btn-group dropleft">
              <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <i class="mdi mdi-dots-horizontal"></i>
              </button>
              <div class="dropdown-menu">
                <button class="dropdown-item" type="button" id="btnShowreceivelist" value="'.$sr->receiveid.$sr->orderid.'"><i class="mdi mdi-clipboard-list"></i>ລາຍ​ການ​ຮັບ​ເຂົ້າ</button>
                <button class="dropdown-item" type="button" id="btnEditReceive" value="'.$sr->receiveid.'"><i class="mdi mdi-playlist-edit"></i>​ແກ້​ໄຂຂໍ້​ມູນ​ຮັບ​ເຂົ້າ</button>
                <button class="dropdown-item" type="button" id="btnDelete" value="'.$sr->receiveid.'"><i class="mdi mdi-delete"></i>​ລົບຂໍ້​ມູນ​ຮັບ​ເຂົ້າ</button>
              </div>
            </div>
          </td>
        </tr>
        ';
      }
    }else{
      $result .= '
      <td colspan="7">
        <h5 class="text-danger text-center">ບໍ່​ມີ​ຂໍ້​ມູນ​ທີ່​ທ່ານ​ຄົ້ນ​ຫາ</h5>
      </td>
      ';
    }
    $data = array('result' => $result);
    echo json_encode($data);
  }

}