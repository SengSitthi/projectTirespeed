<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Validator, Auth;
use Illuminate\Support\Str;

class QuotationController extends Controller
{
  // index page
  public function index()
  {
    $quotation = DB::table('quotations')->select('qtid')->orderBy('qtid', 'desc')->take(1)->get();
    // $quotationid = "QT00001-".date('m.Y');
    if(count($quotation) > 0){
      foreach($quotation as $qt){
        $quotationid = $qt->qtid;
      }
      $strstring = Str::substr($quotationid, 2, 5);
      $sum = (int)$strstring + 1;
      if(strlen($sum) == 1){
        $num = "0000".$sum;
      }else if(strlen($sum) == 2){
        $num = "000".$sum;
      }else if(strlen($sum) == 3){
        $num = "00".$sum;
      }else if(strlen($sum) == 4){
        $num = "0".$sum;
      }else{
        $num = $sum;
      }
    }else{
      $num = "00001";
    }
    $qtid = "QT".$num."-".date('m.Y');

    
    $repairbill = DB::table('repairbill')->orderBy('rpbid', 'desc')->get();
    return view('/manage/crm/quotationnew')->with('repairbill', $repairbill)->with('qtid', $qtid);
  }

  // function get repair bill data to show quotation table list
  public function fnGetrpbdetaildata(Request $req)
  {
    $result = "";
    $rpbid = $req->rpbid;
    $rpbdetail = DB::table('repairbill_detail')
    ->join('spares', 'spares.rpnoid', '=', 'repairbill_detail.rpnoid')
    ->join('unitspare', 'unitspare.unitid', '=', 'spares.unitid')
    ->join('wages', 'wages.wageid', '=', 'repairbill_detail.wageid')
    ->where('repairbill_detail.rpbid', '=', $rpbid)
    ->select('spares.rpnoid','spares.sparesname','unitspare.unitname','repairbill_detail.useqty','spares.sellprice','wages.*')->get();
    foreach($rpbdetail as $rpbd){
      $result .= '
      <tr>
        <td>
          <input class="form-control" type="text" name="rpnoid[]" value="'.$rpbd->rpnoid.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="sparename" value="'.$rpbd->sparesname.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="unitspare" value="'.$rpbd->unitname.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="qty[]" value="'.$rpbd->useqty.'" readonly>
        </td>
        <td>
          <input type="hidden" name="price[]" value="'.$rpbd->sellprice.'">
          <input class="form-control" type="text" name="showprice" value="'.number_format($rpbd->sellprice).'" readonly>
        </td>
        <td>
          <input type="hidden" name="total[]" value="'.$rpbd->sellprice * $rpbd->useqty.'" readonly>
          <input class="form-control" type="text" name="showtotal" value="'.number_format($rpbd->sellprice * $rpbd->useqty).'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="wageid[]" value="'.$rpbd->wageid.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="wagename" value="'.$rpbd->wagename.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="wagecost" value="'.number_format($rpbd->cost).'" readonly>
        </td>
      </tr>
      ';
    }
    $data = array('result' => $result);
    echo json_encode($data);
  }

  // function get spare data
  public function fnloadSparetoQT(Request $req)
  {
    $sparesdata = DB::table('spares')
    ->join('unitspare', 'unitspare.unitid', '=', 'spares.unitid')
    ->where('spares.sparesid', '=', $req->sparesid)
    ->select('spares.*','unitspare.*')
    ->get();
    if(count($sparesdata) > 0)
      foreach($sparesdata as $spd){
        $sparesname = $spd->sparesname;
        $sellprice = $spd->sellprice;
        $unitname = $spd->unitname;
      }
    else{
      $sparesname = "ບໍ່​ມີ​ຂໍ້​ມູນ";
      $sellprice = "ບໍ່​ມີ​ຂໍ້​ມູນ";
      $unitname = "ບໍ່​ມີ​ຂໍ້​ມູນ";
    }
    $data = array('sparesname' => $sparesname, 'sellprice' => $sellprice, 'unitname' => $unitname);
    echo json_encode($data);
  }

  // function insert new quotation
  public function fnInsertNewQT(Request $req)
  {
    $this->validate($req, [
      'rpbid' => 'required'
    ]);
    
    $quotationdata = array(
      'qtid' => $req->input('qtid'),'rpbid' => $req->input('rpbid'),
      'part' => $req->input('part'),'checkin_date' => $req->input('checkin_date'),
      'checkin_time' => $req->input('checkin_time'),'checkout_date' => $req->input('checkout_date'),
      'checkout_time' => $req->input('checkout_time'),'expire_date' => $req->input('expire_date'),
      'credit_day' => $req->input('credit_day'),'instance' => $req->input('instance'),
      'receive_bill' => $req->input('receive_bill'),'document_date' => $req->input('document_date'),
      'created_at' => date('Y-m-d H:i:s')
    );
    $rpnoid = $req->input('rpnoid');
    for ($i=0; $i < count($rpnoid); $i++) {
      $qtdetaildata = array(
        'qtid' => $req->input('qtid'),
        'rpnoid' => $req->input('rpnoid')[$i],
        'qty' => $req->input('qty')[$i],
        'price' => $req->input('price')[$i],
        'wageid' => $req->input('wageid')[$i],
        'total' => $req->input('total')[$i],
        'status' => "0",
        'created_at' => date('Y-m-d H:i:s')
      );
      $detaildata[] = $qtdetaildata;
    }
    $checkrow = DB::table('quotations')->where('qtid', $req->input('qtid'))->get();
    if(count($checkrow) > 0){
      return back()->with('qtidalready', 'ລະ​ຫັດ​ນີ້​ມີ​ໃນ​ລະ​ບົບ​ແລ້ວ');
    }else{
      DB::table('quotations')->insert($quotationdata);
      DB::table('quotations_detail')->insert($detaildata);
      $quotations = DB::table('quotations')
      ->join('repairbill', 'repairbill.rpbid', '=', 'quotations.rpbid')
      ->join('receivecars', 'receivecars.rcsid', '=', 'repairbill.rcsid')
      ->join('customers', 'customers.cusid', '=', 'receivecars.cusid')
      ->join('cars', 'cars.carid', '=', 'receivecars.carid')
      ->join('brands', 'brands.brandid', '=', 'cars.brandid')
      ->join('districts', 'districts.disid', '=', 'customers.disid')
      ->join('provinces', 'provinces.proid', '=', 'customers.proid')
      ->where('quotations.qtid', '=', $req->input('qtid'))
      ->select('quotations.*','customers.*','cars.*','brands.brandname','districts.disname','provinces.proname')
      ->get();
      
      $quodetail = DB::table('quotations_detail')
      ->join('spares', 'spares.rpnoid', '=', 'quotations_detail.rpnoid')
      ->join('unitspare', 'unitspare.unitid', '=', 'spares.unitid')
      ->where('quotations_detail.qtid', '=', $req->input('qtid'))->whereNotIn('quotations_detail.rpnoid', ['CHECK000'])
      ->select('quotations_detail.*','spares.rpnoid','spares.sparesid','spares.sparesname','unitspare.unitname')->get();

      $wagelist = DB::table('quotations_detail')
      ->join('wages', 'wages.wageid', '=', 'quotations_detail.wageid')
      ->join('typecars', 'typecars.tcarid', '=', 'wages.tcarid')
      ->join('unitrepairs', 'unitrepairs.unitrpid', '=', 'wages.unitrpid')
      ->where('quotations_detail.qtid', '=', $req->input('qtid'))
      ->select('wages.*','typecars.tcarname','unitrepairs.unitrpname')->get();

      $sumwages = DB::table('quotations_detail')
      ->join('wages', 'wages.wageid', '=', 'quotations_detail.wageid')
      ->where('quotations_detail.qtid', $req->input('qtid'))->sum('wages.cost');
      $sumtotal = DB::table('quotations_detail')->where('qtid', $req->input('qtid'))->sum('total');
      $no = 1;
      $w = 1;
      $url = "quotationnew";
      return view('/manage/crm/quotationprint')->with('quotations', $quotations)->with('quodetail',$quodetail)
      ->with('sumwages', $sumwages)->with('sumtotal', $sumtotal)->with('no', $no)->with('url', $url)
      ->with('w', $w)->with('wagelist', $wagelist);
    }

  }

  public function fnQTList(Request $req)
  {
    $repairbill = DB::table('repairbill')->orderBy('rpbid', 'desc')->get();
    $quotations = DB::table('quotations')->orderBy('qtid', 'desc')->paginate(35);
    return view('/manage/crm/quotationlist')->with('quotations', $quotations)->with('repairbill', $repairbill);
  }

  public function fnPrintQuotation($qtid)
  {
    $quotations = DB::table('quotations')
      ->join('repairbill', 'repairbill.rpbid', '=', 'quotations.rpbid')
      ->join('receivecars', 'receivecars.rcsid', '=', 'repairbill.rcsid')
      ->join('customers', 'customers.cusid', '=', 'receivecars.cusid')
      ->join('cars', 'cars.carid', '=', 'receivecars.carid')
      ->join('brands', 'brands.brandid', '=', 'cars.brandid')
      ->join('districts', 'districts.disid', '=', 'customers.disid')
      ->join('provinces', 'provinces.proid', '=', 'customers.proid')
      ->where('quotations.qtid', '=', $qtid)
      ->select('quotations.*','customers.*','cars.*','brands.brandname','districts.disname','provinces.proname')
      ->get();
      
      $quodetail = DB::table('quotations_detail')
      ->join('spares', 'spares.rpnoid', '=', 'quotations_detail.rpnoid')
      ->join('unitspare', 'unitspare.unitid', '=', 'spares.unitid')
      ->where('quotations_detail.qtid', '=', $qtid)->whereNotIn('quotations_detail.rpnoid', ['CHECK000'])
      ->select('quotations_detail.*','spares.rpnoid','spares.sparesid','spares.sparesname','unitspare.unitname')->get();

      $wagelist = DB::table('quotations_detail')
      ->join('wages', 'wages.wageid', '=', 'quotations_detail.wageid')
      ->join('typecars', 'typecars.tcarid', '=', 'wages.tcarid')
      ->join('unitrepairs', 'unitrepairs.unitrpid', '=', 'wages.unitrpid')
      ->where('quotations_detail.qtid', '=', $qtid)
      ->select('wages.*','typecars.tcarname','unitrepairs.unitrpname')->get();

      $sumwages = DB::table('quotations_detail')
      ->join('wages', 'wages.wageid', '=', 'quotations_detail.wageid')
      ->where('quotations_detail.qtid', $qtid)->sum('wages.cost');
      $sumtotal = DB::table('quotations_detail')->where('qtid', $qtid)->sum('total');
      $no = 1;
      $w = 1;
      $url = "quotationnew";
      return view('/manage/crm/quotationprint')->with('quotations', $quotations)->with('quodetail',$quodetail)
      ->with('sumwages', $sumwages)->with('sumtotal', $sumtotal)->with('no', $no)->with('url', $url)
      ->with('w', $w)->with('wagelist', $wagelist);
  }

  // function get data to show on quotation detail modal
  public function fnQtdetaildata(Request $req)
  {
    $result = "";
    $qtid = $req->qtid;
    $qtdtdata = DB::table('quotations_detail')->join('spares', 'spares.rpnoid', '=', 'quotations_detail.rpnoid')
                                              ->join('wages', 'wages.wageid', '=', 'quotations_detail.wageid')
                                              ->where('quotations_detail.qtid', '=', $qtid)
                                              ->select('quotations_detail.*','spares.sparesname','wages.*')->get();
                                              // ->whereNotIn('quotations_detail.rpnoid', ['CHECK000'])
    foreach($qtdtdata as $qdt){
      if($qdt->status == "0"){
        $status = "ຍັງ​ບໍ່​ໄດ້​ອະ​ນຸ​ມັດ";
        $statustext = "";
        $value = 1;
      }else{
        $status = "ອະ​ນຸ​ມັດ";
        $statustext = "checked";
        $value = 0;
      }
      $result .= '
      <tr>
        <td>
          <input class="form-control" type="text" name="rpnoid" value="'.$qdt->rpnoid.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="sparesname" value="'.$qdt->sparesname.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="qty" value="'.$qdt->qty.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="price" value="'.$qdt->price.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="total" value="'.$qdt->total.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="wageid" value="'.$qdt->wageid.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="wagename" value="'.$qdt->wagename.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="status" value="'.$status.'" readonly>
        </td>
        <td class="text-center">
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input confirm" id="'.$qdt->qtdetailid.'" name="confirm[]" value="'.$value.'" '.$statustext.'>
            <label class="custom-control-label" for="'.$qdt->qtdetailid.'"></label>
          </div>
        </td>
      </tr>
      ';
    }
    $data = array('result' => $result);
    echo json_encode($data);
  }

  // function confirm quotation list
  public function fnUpdatestatus(Request $req)
  {
    $status = $req->status;
    $qtdetailid = $req->qtdetailid;
    $updatestatus = array('status' => $status);
    DB::table('quotations_detail')->where('qtdetailid', $qtdetailid)->update($updatestatus);
    $data = "ການ​ອັບ​ເດດ​ສ​ະ​ຖາ​ນະ​ສຳ​ເລັດ";
    echo json_encode($data);
  }

  public function fnloadQuotations(Request $req)
  {
    $qtid = $req->qtid;
    $quotations = DB::table('quotations')->where('qtid', $qtid)->get();
    foreach ($quotations as $quot) {
      $rpbid = $quot->rpbid;
      $part = $quot->part;
      $checkin_date = $quot->checkin_date;
      $checkin_time = $quot->checkin_time;
      $checkout_date = $quot->checkout_date;
      $checkout_time = $quot->checkout_time;
      $expire_date = $quot->expire_date;
      $credit_day = $quot->credit_day;
      $instance = $quot->instance;
      $receive_bill = $quot->receive_bill;
      $document_date = $quot->document_date;
    }

    $qttdata = array(
      'rpbid' => $rpbid,'part' => $part,'checkin_date' => $checkin_date,'checkin_time' => $checkin_time,'checkout_date' => $checkout_date,'checkout_time' => $checkout_time,
      'expire_date' => $expire_date,'credit_day' => $credit_day,'instance' => $instance,'receive_bill' => $receive_bill,'document_date' => $document_date,
    );
    echo json_encode($qttdata);
  }

  // function update quotation data
  public function fnUpdatequotations(Request $req)
  {
    $qtid = $req->input('qtid');
    $dataupdate = array(
      'rpbid' => $req->input('rpbid'),'part' => $req->input('part'),'checkin_date' => $req->input('checkin_date'),
      'checkin_time' => $req->input('checkin_time'),'checkout_date' => $req->input('checkout_date'),'checkout_time' => $req->input('checkout_time'),'expire_date' => $req->input('expire_date'),
      'credit_day' => $req->input('credit_day'),'instance' => $req->input('instance'),'receive_bill' => $req->input('receive_bill'),'document_date' => $req->input('document_date'),
    );

    DB::table('quotations')->where('qtid', $qtid)->update($dataupdate);
    return redirect('quotationlist')->with('success', 'Update data successfuly');
  }

  // function search quotation
  public function fnSearchQuotation(Request $req)
  {
    $result = "";
    $datasearch = $req->datasearch;
    $sqlquotation = DB::table('quotations')->where('qtid', 'like', '%'.$datasearch.'%')->orWhere('rpbid', 'like', '%'.$datasearch.'%')
    ->orWhere('document_date', 'like', '%'.$datasearch.'%')->get();
    if(count($sqlquotation) > 0){
      foreach($sqlquotation as $squot){
        $result .='
        <tr>
        <td>'.$squot->qtid.'</td>
        <td>'.$squot->rpbid.'</td>
        <td>'.$squot->part.'</td>
        <td>'.$squot->checkin_date.' '.$squot->checkin_time.'</td>
        <td>'.$squot->checkout_date.' '.$squot->checkout_time.'</td>
        <td>'.$squot->document_date.'</td>
        <td>'.$squot->expire_date.'</td>
        <td>'.$squot->credit_day.'</td>
        <td>'.$squot->instance.'</td>
        <td>'.$squot->receive_bill.'</td>
        <td>
          <a href="/printQuotation/'.$squot->qtid.'" class="btn btn-primary btn-sm"><i class="mdi mdi-printer"></i></a>
        </td>
        <td>
          <div class="btn-group dropleft">
            <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="mdi mdi-dots-horizontal"></i>
            </button>
            <div class="dropdown-menu">
              <button class="dropdown-item" id="btnDetaillist" value="'.$squot->qtid.'"><i class="mdi mdi-format-list-numbered"></i> ລາຍ​ການ​ສະ​ເໜີ</button>
              <button class="dropdown-item" id="btnEditQT" value="'.$squot->qtid.'"><i class="mdi mdi-pen"></i> ແກ້​ໄຂ​ຂໍ້​ມູນ</button>
              <button class="dropdown-item" id="btnTrashdata" value="'.$squot->qtid.'"><i class="mdi mdi-trash-can-outline"></i> ລຶບ</a>
            </div>
          </div>
        </td>
      </tr>
        ';
      }
    }else{
      $result .= '<tr><td colspan="13"><h4 class="text-center">ບໍ່​ມີ​ຂໍ້​ມູນ​ທີ່​ຕົງ​ກັບ​ທ່ານ​ຄົ້ນ​ຫາ</h4></td></tr>';
    }
    $data = array('result'=>$result);

    echo json_encode($data);
  }

  // function delete quotation
  public function fnDeleteQuo($qtid)
  {
    DB::table('quotations')->where('qtid', $qtid)->delete();
    return redirect('quotationlist')->with('success', 'Update data successfuly');
  }
}
