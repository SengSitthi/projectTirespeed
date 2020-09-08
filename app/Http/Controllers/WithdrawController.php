<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Validator, Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class WithdrawController extends Controller
{
  /////////////////////////////////////// new With draw page function /////////////////////////////////////////
    // withdraw page
    public function fnWithdraw()
    {
      $sqlwithdraw = DB::table('withdraw')->orderBy('withdrawid', 'desc')->take(1)->get();
      if(count($sqlwithdraw) > 0){
        foreach ($sqlwithdraw as $wd) {
          $id = $wd->withdrawid;
        }

        $strstring = Str::substr($id, 2, 8);
        $sum = (int)$strstring + 1;
        $wdid = strlen($sum);
        if(strlen($sum) == 1){
          $withdrawid = "0000".$sum;
        }else if(strlen($sum) == 2){
          $withdrawid = "000".$sum;
        }else if(strlen($sum) == 3){
          $withdrawid = "00".$sum;
        }else if(strlen($sum) == 4){
          $withdrawid = "0".$sum;
        }else{
          $withdrawid = $sum;
        }
      }else{
        $withdrawid = "00001";
      }
      $customers = DB::table('customers')->get();
      return view('manage/stocker/withdraw')->with('withdrawid', $withdrawid)
                                            ->with('customers', $customers);
    }

    // function search spare add to withdraw list
    public function fnWithdrawspares(Request $req)
    {
      $sparesid = $req->sparesid;
      // select receive qty
      $sqlreceiveqty = DB::table('receivedetail')->select(DB::raw("SUM(receiveqty) as receiveqtyall"))->where('sparesid', $sparesid)->get();
      if(count($sqlreceiveqty) > 0){
        foreach($sqlreceiveqty as $rc){
          $receiveqty = $rc->receiveqtyall;
        }
      }else{
        $receiveqty = 0;
      }

      // select withdraw qty
      $sqlwithdrawqty = DB::table('withdrawdetail')->select(DB::raw("SUM(withdrawqty) as withdrawqtyall"))->where('sparesid', $sparesid)->get();
      if(count($sqlwithdrawqty) > 0){
        foreach($sqlwithdrawqty as $wdqty){
          $withdrawqty = $wdqty->withdrawqtyall;
        }
      }else{
        $withdrawqty = 0;
      }
      $remain = (int)$receiveqty - (int)$withdrawqty;

      $sqlspares = DB::table('spares')
                   ->join('brandspares', 'brandspares.brandspareid', '=', 'spares.brandspareid')
                   ->join('unitspare', 'unitspare.unitid', '=', 'spares.unitid')
                   ->where('spares.sparesid', '=', $sparesid)
                   ->select('spares.*', 'brandspares.*', 'unitspare.*')
                   ->get();
      if(count($sqlspares) > 0){
        foreach($sqlspares as $sp){
          $sparesname = $sp->sparesname;
          $brandspareid = $sp->brandspareid;
          $brandsparename = $sp->brandsparename;
          $model = $sp->model;
          $madeyear = $sp->madeyear;
          $sellprice = $sp->sellprice;
          $unitid = $sp->unitid;
          $unitname = $sp->unitname;
        }
      }else{
        $sparesname = "";
        $brandspareid = "";
        $brandsparename = "";
        $model = "";
        $madeyear = "";
        $sellprice = "";
        $unitid = "";
        $unitname = "";
      }
      $data = array(
        'sparesname' => $sparesname,'brandspareid' => $brandspareid,
        'brandsparename' => $brandsparename,'model' => $model,
        'madeyear' => $madeyear,'sellprice' => $sellprice,
        'unitid' => $unitid,'unitname' => $unitname,
        'remain' => $remain,
      );
      echo json_encode($data);
    }

    // function get customer car
    public function fnLoadcarWithdraw(Request $req)
    {
      $cusid = $req->cusid;
      $result = '';
      $cardata = DB::table('cars')->where('cusid', $cusid)->get();
      if(count($cardata) > 0){
        $result .= '<option value="">ເລືອກ​ລົດ​ລູກ​ຄ້າ</option>';
        foreach($cardata as $car){
          $result .= '
            <option value="'.$car->carid.'">'.$car->license.'</option>
          ';
        }
      }else{
        $result .= '<option value="">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ລົດ​ຂອງ​ລູກ​ຄ້າ​</option>';
      }
      $data = array('result' => $result);
      echo json_encode($data);
    }

    public function fnInsertWithdraw(Request $req)
    {
      $this->validate($req, [
        'cusid' => 'required',
        'carid' => 'required',
        'receivecarfile' => 'required|mimes:pdf|max:4096'
      ]);
      if($req->input('withdrawqty') >= 1){
        $filename = time().'.'.$req->file('receivecarfile')->getClientOriginalExtension();
        $datawithdraw = array(
          'withdrawid' => $req->input('withdrawid'),
          'userwithdraw' => $req->input('userwithdraw'),
          'userrequest' => $req->input('userrequest'),
          'withdrawdate' => $req->input('withdrawdate'),
          'cusid' => $req->input('cusid'),
          'carid' => $req->input('carid'),
          'receivecartitle' => $req->input('receivecartitle'),
          'receivecarfile' => $filename,
          'created_at' => date('Y-m-d')
        );

        $req->file('receivecarfile')->move(public_path('/stockfiles'), $filename);
        DB::table('withdraw')->insert($datawithdraw);

        $sparesid = $req->input('sparesid');
        for($i = 0; $i < count($sparesid); $i++){
          $withdrawdetail = array(
            'withdrawid' => $req->input('withdrawid'),
            'sparesid' => $req->input('sparesid')[$i],
            'sparesname' => $req->input('sparesname')[$i],
            'brandspareid' => $req->input('brandspareid')[$i],
            'model' => $req->input('model')[$i],
            'madeyear' => $req->input('madeyear')[$i],
            'withdrawqty' => $req->input('withdrawqty')[$i],
            'price' => $req->input('price')[$i],
            'unitid' => $req->input('unitid')[$i],
            'total' => $req->input('total')[$i],
            'remark' => $req->input('remark')[$i],
            'created_at' => date('Y-m-d')
          );
          $withdrawdt[] = $withdrawdetail;
        }
        DB::table('withdrawdetail')->insert($withdrawdt);
        $url = "withdraw";
        $withdraw = DB::table('withdraw')
                    ->join('customers', 'customers.cusid', '=', 'withdraw.cusid')
                    ->join('cars', 'cars.carid', '=', 'withdraw.carid')
                    ->join('brands', 'brands.brandid', '=', 'cars.brandid')
                    ->where('withdrawid', $req->input('withdrawid'))
                    ->select('withdraw.*','customers.*','cars.*','brands.*')
                    ->get();
        $withdrawdetail = DB::table('withdrawdetail')
                          ->join('brandspares', 'brandspares.brandspareid', '=', 'withdrawdetail.brandspareid')
                          ->join('unitspare', 'unitspare.unitid', '=', 'withdrawdetail.unitid')
                          ->where('withdrawdetail.withdrawid', '=', $req->input('withdrawid'))
                          ->select('withdrawdetail.*','brandspares.*','unitspare.*')
                          ->get();
        $count = count($withdrawdetail);
        $i = 1;
        return view('manage/stocker/withdrawprint')->with('withdraw', $withdraw)
                                                  ->with('withdrawdetail', $withdrawdetail)
                                                  ->with('count', $count)
                                                  ->with('url', $url)
                                                  ->with('i', $i);
      }else{
        return back()->with('error', 'ກະ​ລຸນາ​ໃສ່​ຈຳ​ນວນ​ທີ່​ຕ້ອງ​ການ​ເບີກ ຫຼື ກວດ​ສະ​ຕ໋ອກ​ອະ​ໄຫຼ່​ທີ່​ຕ້ອງ​ການ​ເບີກ');
      }
    }

/////////////////////////////////////// With draw list page function /////////////////////////////////////////
  // withdraw list page
  public function fnWithdrawlist()
  {
    $withdraws = DB::table('withdraw')
    ->join('customers', 'customers.cusid', '=', 'withdraw.cusid')
    ->join('cars', 'cars.carid', '=', 'withdraw.carid')
    ->select('withdraw.*', 'customers.*', 'cars.*')
    ->orderBy('withdrawid', 'desc')->paginate(20);
    $customers = DB::table('customers')->get();
    return view('manage/stocker/withdrawlist')->with('withdraws', $withdraws)
                                              ->with('customers', $customers);
  }

  // function print withdraw bill
  public function fnWithdrawprint($withdrawid)
  {
    $url = "withdrawlist";
    $withdraw = DB::table('withdraw')
                ->join('customers', 'customers.cusid', '=', 'withdraw.cusid')
                ->join('cars', 'cars.carid', '=', 'withdraw.carid')
                ->join('brands', 'brands.brandid', '=', 'cars.brandid')
                ->where('withdrawid', $withdrawid)
                ->select('withdraw.*','customers.*','cars.*','brands.*')
                ->get();
    $withdrawdetail = DB::table('withdrawdetail')
                      ->join('brandspares', 'brandspares.brandspareid', '=', 'withdrawdetail.brandspareid')
                      ->join('unitspare', 'unitspare.unitid', '=', 'withdrawdetail.unitid')
                      ->where('withdrawdetail.withdrawid', '=', $withdrawid)
                      ->select('withdrawdetail.*','brandspares.*','unitspare.*')
                      ->get();
    $count = count($withdrawdetail);
    $i = 1;
    return view('manage/stocker/withdrawprint')->with('withdraw', $withdraw)
                                                ->with('withdrawdetail', $withdrawdetail)
                                                ->with('count', $count)
                                                ->with('url', $url)
                                                ->with('i', $i);
  }

  // function loadwithdrawlist
  public function fnLoadWithdrawdt(Request $req)
  {
    $withdrawid = $req->withdrawid;
    $result = "";
    $withdrawdetail = DB::table('withdrawdetail')
                        ->join('brandspares', 'brandspares.brandspareid', '=', 'withdrawdetail.brandspareid')
                        ->join('unitspare', 'unitspare.unitid', '=', 'withdrawdetail.unitid')
                        ->where('withdrawdetail.withdrawid', '=', $withdrawid)
                        ->select('withdrawdetail.*','brandspares.*','unitspare.*')
                        ->get();
    if(count($withdrawdetail) > 0){
      $i = 1;
      foreach($withdrawdetail as $wddt){
        $result .= '
        <tr>
          <td>'.$i++.'</td>
          <td>'.$wddt->sparesid.'</td>
          <td>'.$wddt->sparesname.'</td>
          <td>'.$wddt->brandsparename.'</td>
          <td>'.$wddt->model.'</td>
          <td>'.$wddt->madeyear.'</td>
          <td>'.$wddt->withdrawqty.'</td>
          <td>'.$wddt->price.'</td>
          <td>'.$wddt->unitname.'</td>
          <td>'.$wddt->total.'</td>
          <td>'.$wddt->remark.'</td>
          <td>
            <button class="btn btn-danger" type="button" id="btnTrashlist" value="'.$wddt->withdrawdetailid.'"><i class="mdi mdi-trash-can-outline"></i></button>
          </td>
        </tr>
        ';
      }
    }else{
      $result .= '<tr><td colspan="12" class="text-center">ບໍ່​ມີ​ຂ​ໍ້​ມູນ​ລາຍ​ການ​ເບີ​ກ​ໃນ​ລະ​ຫັດ​ບິນ '.$withdrawid.'</td></tr>';
    }
    $data = array('result' => $result);
    echo json_encode($data);
  }

  // function add new spares to withdraw list or update withdraw qty by withdrawid and sparesid
  public function fnAddnewwithdraw(Request $req)
  {
    $withdrawid = $req->withdrawaddid;
    $sparesid = $req->sparesid;
    $checkwddetail = DB::table('withdrawdetail')->where('withdrawid', $withdrawid)->where('sparesid', $sparesid)->get();
    if(count($checkwddetail) >= 1){
      foreach ($checkwddetail as $row) {
        $qty = $row->withdrawqty;
        $total = $row->total;
      }
      $withdrawqty = (int)$qty + (int)$req->withdrawqty;
      $updatedata = array(
        'withdrawqty' => $withdrawqty,
        'total' => (int)$total+ (int)$req->total,
        'updated_at' => date('Y-m-d H:i:s')
      );
      DB::table('withdrawdetail')->where('withdrawid', $withdrawid)->where('sparesid', $sparesid)->update($updatedata);
    }else{
      $innewrow = array(
        'withdrawid' => $req->withdrawaddid,'sparesid' => $req->sparesid,'sparesname' => $req->sparesname,'brandspareid' => $req->brandspareid,
        'model' => $req->model,'madeyear' => $req->madeyear,'withdrawqty' => $req->withdrawqty,'price' => $req->price,
        'unitid' => $req->unitid,'total' => $req->total,'remark' => $req->remark,
      );
      DB::table('withdrawdetail')->insert($innewrow);
    }
    $data = "ການ​ບັນ​ທຶກ​ສຳ​ເລັດ";
    echo json_encode($data);
  }

  // function trash withdraw detail list
  public function fnTrashlist(Request $req)
  {
    $wddtid = $req->wddtid;
    DB::table('withdrawdetail')->where('withdrawdetailid', $wddtid)->delete();
    $data = "ການ​ລຶບ​ສຳ​ເລັດ";
    echo json_encode($data);
  }

  //// function get withdraw data to edit
  public function fnGetWithdrawdata(Request $req)
  {
    $withdrawid = $req->withdrawid;
    $withdraws = DB::table('withdraw')->join('customers', 'customers.cusid', '=', 'withdraw.cusid')->where('withdrawid', $withdrawid)->select('withdraw.*','customers.*')->get();
    foreach($withdraws as $wd){
      $userrequest = $wd->userrequest;
      $withdrawdate = $wd->withdrawdate;
      $cusid = $wd->cusid;
      $name = $wd->name;
      $carid = $wd->carid;
      $receivecartitle = $wd->receivecartitle;
    }
    $data = array(
      'userrequest' => $userrequest,
      'withdrawdate' => $withdrawdate,
      'cusid' => $cusid,
      'cusname' => $name,
      'carid' => $carid,
      'receivecartitle' => $receivecartitle
    );
    echo json_encode($data);
  }

  // function update withdraw id
  public function fnUpdatewithdraw(Request $req)
  {
    if($req->file('receivecarfile') == null){
      $dataupdate = array(
        'userrequest' => $req->input('userrequest'),
        'withdrawdate' => $req->input('withdrawdate'),
        'cusid' => $req->input('cusid'),
        'carid' => $req->input('carid'),
        'receivecartitle' => $req->input('receivecartitle')
      );
    }else{
      $filename = time().'.'.$req->file('receivecarfile')->getClientOriginalExtension();
      $checkfile = DB::table('withdraw')->where('withdrawid', $req->input('withdrawid'))->get();
      if(count($checkfile) >= 1){
        foreach($checkfile as $cfile){
          $recevicefile = $cfile->receivecarfile;
        }
        $path = public_path('stockfiles/'.$recevicefile);
        if(File::exists($path)){
          unlink($path);
        }
      }
      $dataupdate = array(
        'userrequest' => $req->input('userrequest'),
        'withdrawdate' => $req->input('withdrawdate'),
        'cusid' => $req->input('cusid'),
        'carid' => $req->input('carid'),
        'receivecartitle' => $req->input('receivecartitle'),
        'receivecarfile' => $filename
      );
      
    $req->file('receivecarfile')->move(public_path('/stockfiles'), $filename);
    }
    DB::table('withdraw')->where('withdrawid', $req->input('withdrawid'))->update($dataupdate);
    return redirect('withdrawlist')->with('success', 'ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ');
  }

  // function delete withdrawid
  public function fnDeletewithdraw($withdrawid)
  {
    $checkfile = DB::table('withdraw')->where('withdrawid', $withdrawid)->get();
    if(count($checkfile) >= 1){
      foreach($checkfile as $cfile){
        $recevicefile = $cfile->receivecarfile;
      }
      $path = public_path('stockfiles/'.$recevicefile);
      if(File::exists($path)){
        unlink($path);
      }
    }
    DB::table('withdraw')->where('withdrawid', $withdrawid)->delete();
    return redirect('withdrawlist')->with('success', 'ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ');
  }

  // funtion search withdraw
  public function fnSearchwithdraw(Request $req)
  {
    $wdsearch = $req->wdsearch;
    $result = "";
    $withdraws = DB::table('withdraw')
    ->join('customers', 'customers.cusid', '=', 'withdraw.cusid')
    ->join('cars', 'cars.carid', '=', 'withdraw.carid')
    ->where('withdraw.withdrawid', 'like', '%'.$wdsearch.'%')
    ->select('withdraw.*', 'customers.*', 'cars.*')->get();
    if(count($withdraws) > 0){
      foreach ($withdraws as $wds) {
        $result .= '
        <tr>
          <td>'.$wds->withdrawid.'</td>
          <td>'.$wds->userrequest.'</td>
          <td>'.$wds->receivecartitle.'</td>
          <td>'.$wds->withdrawdate.'</td>
          <td>'.$wds->name.'</td>
          <td>'.$wds->license.'</td>
          <td>'.$wds->userwithdraw.'</td>
          <td>
            <a href="withdrawprint/'.$wds->withdrawid.'" class="btn btn-primary"><i class="mdi mdi-printer"></i></a>
          </td>
          <td>
            <a href="stockfiles/'.$wds->receivecarfile.'" class="btn btn-primary" target="_blank" title="ດາວ​ໂຫຼດ​ເອ​ກະ​ສານ​ຕິດ​ຂັດ"><i class="mdi mdi-download"></i></a>
          </td>
          <td>
            <div class="btn-group dropleft">
              <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-dots-horizontal"></i>
              </button>
              <div class="dropdown-menu">
                <button class="dropdown-item" id="btnDetaillist" value="'.$wds->withdrawid.'"><i class="mdi mdi-format-list-numbered"></i> ລາຍ​ການ​ເບີກ</button>
                  <button class="dropdown-item" id="btnEditdata" value="'.$wds->withdrawid.'"><i class="mdi mdi-pen"></i> ແກ້​ໄຂ​ຂໍ້​ມູນ</button>
                  <button class="dropdown-item" id="btnTrashdata" value="'.$wds->withdrawid.'"><i class="mdi mdi-trash-can-outline"></i> ລຶບ</button>
              </div>
            </div>
          </td>
        </tr>
        ';
      }
    }else{
      $result .= '
      <tr>
        <td colspan="10">
          <h3 class="text-center text-danger">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ການ​ເບີກໃນ​ລະ​ບົບ</h3>
        </td>
      </tr>
      ';
    }
    $data = array('result' => $result);
    echo json_encode($data);
  }
}
