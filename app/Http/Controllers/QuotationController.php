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

    
    $customers = DB::table('customers')->orderBy('name', 'asc')->get();
    return view('/manage/crm/quotationnew')->with('customers', $customers)->with('qtid', $qtid);
  }

  // function get car data by cusid
  public function fnGetCuscar(Request $req)
  {
    $result = "";
    $customers = DB::table('cars')->where('cusid', $req->cusid)->get();
    if(count($customers) > 0){
      $result = '<option value="">ເລືອກ​ລົດ​ລູ​ກ​ຄ້າ</option>';
      foreach ($customers as $cus) {
        $result .= '<option value="'.$cus->carid.'">'.$cus->license.'</option>';
      }
    }else{
      $result .= '<option value="">ຍັງ​ບໍ່​ມີ​ລົດ​ຂອງ​ລູກ​ຄ້າ​ຄົນ​ນີ້</option>';
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
      'cusid' => 'required',
      'carid' => 'required'
    ]);
    
    $quotationdata = array(
      'qtid' => $req->input('qtid'),
      'cusid' => $req->input('cusid'),'carid' => $req->input('carid'),
      'part' => $req->input('part'),'checkin_date' => $req->input('checkin_date'),
      'checkin_time' => $req->input('checkin_time'),'checkout_date' => $req->input('checkout_date'),
      'checkout_time' => $req->input('checkout_time'),'expire_date' => $req->input('expire_date'),
      'credit_day' => $req->input('credit_day'),'instance' => $req->input('instance'),
      'receive_bill' => $req->input('receive_bill'),'document_date' => $req->input('document_date'),
      'created_at' => date('Y-m-d')
    );
    $sparesid = $req->input('sparesid');
    for ($i=0; $i < count($sparesid); $i++) {
      $qtdetaildata = array(
        'qtid' => $req->input('qtid'),
        'sparesid' => $req->input('sparesid')[$i],
        'qty' => $req->input('qty')[$i],
        'price' => $req->input('price')[$i],
        'wages' => $req->input('wages')[$i],
        'total' => $req->input('total')[$i],
        'status' => "0",
        'created_at' => date('Y-m-d')
      );
      $detaildata[] = $qtdetaildata;
    }
    $checkrow = DB::table('quotations')->where('qtid', $req->input('qtid'))->get();
    if(count($checkrow) > 0){
      return back()->with('qtidalready', 'ລະ​ຫັດ​ນີ້​ມີ​ໃນ​ລະ​ບົບ​ແລ້ວ');
    }else{
      DB::table('quotations')->insert($quotationdata);
      DB::table('qt_details')->insert($detaildata);
      $quotations = DB::table('quotations')
      ->join('customers', 'customers.cusid', '=', 'quotations.cusid')
      ->join('cars', 'cars.carid', '=', 'quotations.carid')
      ->join('brands', 'brands.brandid', '=', 'cars.brandid')
      ->join('districts', 'districts.disid', '=', 'customers.disid')
      ->join('provinces', 'provinces.proid', '=', 'customers.proid')
      ->where('quotations.qtid', '=', $req->input('qtid'))->where('quotations.cusid', '=', $req->input('cusid'))->where('quotations.carid', '=', $req->input('carid'))
      ->select('quotations.*','customers.*','cars.*','brands.brandname','districts.disname','provinces.proname')
      ->get();
      $quodetail = DB::table('qt_details')
      ->join('spares', 'spares.sparesid', '=', 'qt_details.sparesid')
      ->join('unitspare', 'unitspare.unitid', '=', 'spares.unitid')
      ->where('qt_details.qtid', '=', $req->input('qtid'))
      ->select('qt_details.*','spares.sparesid','spares.sparesname','unitspare.unitname')->get();
      $sumwages = DB::table('qt_details')->where('qtid', $req->input('qtid'))->sum('wages');
      $sumtotal = DB::table('qt_details')->where('qtid', $req->input('qtid'))->sum('total');
      $no = 1;
      $url = "quotationnew";
      return view('/manage/crm/quotationprint')->with('quotations', $quotations)->with('quodetail',$quodetail)
      ->with('sumwages', $sumwages)->with('sumtotal', $sumtotal)->with('no', $no)->with('url', $url);
    }

  }

  public function fnQTList(Request $req)
  {
    $quotations = DB::table('quotations')
    ->join('customers', 'customers.cusid', '=', 'quotations.cusid')
    ->join('cars', 'cars.carid', '=', 'quotations.carid')
    ->select('quotations.*','customers.*','cars.*')
    ->orderBy('qtid', 'desc')->paginate(35);
    $customers = DB::table('customers')->get();
    return view('/manage/crm/quotationlist')->with('quotations', $quotations)->with('customers', $customers);
  }

  public function fnPrintQuotation($qtid)
  {
    $quotations = DB::table('quotations')
      ->join('customers', 'customers.cusid', '=', 'quotations.cusid')
      ->join('cars', 'cars.carid', '=', 'quotations.carid')
      ->join('brands', 'brands.brandid', '=', 'cars.brandid')
      ->join('districts', 'districts.disid', '=', 'customers.disid')
      ->join('provinces', 'provinces.proid', '=', 'customers.proid')
      ->where('quotations.qtid', '=', $qtid)
      ->select('quotations.*','customers.*','cars.*','brands.brandname','districts.disname','provinces.proname')
      ->get();
      $quodetail = DB::table('qt_details')
      ->join('spares', 'spares.sparesid', '=', 'qt_details.sparesid')
      ->join('unitspare', 'unitspare.unitid', '=', 'spares.unitid')
      ->where('qt_details.qtid', '=', $qtid)
      ->select('qt_details.*','spares.sparesid','spares.sparesname','unitspare.unitname')->get();
      $sumwages = DB::table('qt_details')->where('qtid', $qtid)->sum('wages');
      $sumtotal = DB::table('qt_details')->where('qtid', $qtid)->sum('total');
      $no = 1;
      $url = "quotationlist";
      return view('/manage/crm/quotationprint')->with('quotations', $quotations)->with('quodetail',$quodetail)
      ->with('sumwages', $sumwages)->with('sumtotal', $sumtotal)->with('no', $no)->with('url', $url);
  }
  
  // function get quotation detail to table on modal
  public function fnModalloadQT(Request $req)
  {
    $result = "";
    $qtid = $req->qtid;
    $qtdetail = DB::table('qt_details')
    ->join('spares', 'spares.sparesid', '=', 'qt_details.sparesid')
    ->join('unitspare', 'unitspare.unitid', '=', 'spares.unitid')
    ->where('qt_details.qtid', '=', $qtid)
    ->select('qt_details.*','spares.sparesid','spares.sparesname','unitspare.unitname')->get();
    $i = 1;
    if(count($qtdetail) > 0){
      foreach ($qtdetail as $qtdt) {
        $result .= '
        <tr>
          <td class="text-center">'.$i++.'</td>
          <td>'.$qtdt->sparesid.'</td>
          <td>'.$qtdt->sparesname.'</td>
          <td class="text-center">'.$qtdt->unitname.'</td>
          <td class="text-center">'.$qtdt->qty.'</td>
          <td class="text-right">'.number_format($qtdt->price).'</td>
          <td class="text-right">'.number_format($qtdt->total).'</td>
          <td class="text-right">'.number_format($qtdt->wages).'</td>
          <td class="text-center">
            <button class="btn btn-danger" type="button" id="btnTrash" value="'.$qtdt->qtdetailid.'"><i class="mdi mdi-trash-can"></i></button>
          </td>
        </tr>
        ';
      }
    }else{
      $result .= '<tr><td colspan="9"><h4 class="text-center">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ລາຍ​ການ​ຂອງ​ໃບ​ສະ​ເໜີ​ບິນ​ນີ້ '.$qtid.'</h4></td></tr>';
    }
    $data = array('result'=>$result);
    echo json_encode($data);
  }

  // function insert new spares data to quotation detail
  public function fnInsertQtdetaildata(Request $req)
  {
    $checkrow = DB::table('qt_details')->where('qtid', $req->qtid)->where('sparesid', $req->sparesid)->get();
    if(count($checkrow) > 0){
      foreach($checkrow as $row){
        $qty = $row->qty;
        $total = $row->total;
        $wages = $row->wages;
      }
      $dataupdate = array('qty'=>(int)$qty+(int)$req->qty,'wages'=>$req->wages, 'total' => (int)$total+(int)$req->total,'updated_at'=>date('Y-m-d'));
      DB::table('qt_details')->where('qtid', $req->qtid)->where('sparesid', $req->sparesid)->update($dataupdate);
    }else{
      $datainsert = array('qtid'=>$req->qtid,'sparesid'=>$req->sparesid,'qty'=>$req->qty,'price'=>$req->price,'wages'=>$req->wages,'total'=>$req->total,'status'=>"0",'created_at'=>date('Y-m-d'));
      DB::table('qt_details')->insert($datainsert);
    }
    $data = "ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ";
    echo json_encode($data);
  }

  public function fnTrashQtlist(Request $req)
  {
    $qtdetailid = $req->qtdetailid;
    DB::table('qt_details')->where('qtdetailid', $qtdetailid)->delete();
    $data = "ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ";
    echo json_encode($data);
  }

  public function fnloadQuotations(Request $req)
  {
    $qtid = $req->qtid;
    $quotations = DB::table('quotations')->where('qtid', $qtid)->get();
    foreach ($quotations as $quot) {
      $cusid = $quot->cusid;
      $carid = $quot->carid;
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
      'cusid' => $cusid,'carid' => $carid,'part' => $part,'checkin_date' => $checkin_date,'checkin_time' => $checkin_time,'checkout_date' => $checkout_date,'checkout_time' => $checkout_time,
      'expire_date' => $expire_date,'credit_day' => $credit_day,'instance' => $instance,'receive_bill' => $receive_bill,'document_date' => $document_date,
    );
    echo json_encode($qttdata);
  }

  // function update quotation data
  public function fnUpdatequotations(Request $req)
  {
    $this->validate($req, [
      'cusid' => 'required',
      'carid' => 'required'
    ]);

    $qtid = $req->input('editqtid');
    $dataupdate = array(
      'cusid' => $req->input('cusid'),'carid' => $req->input('carid'),'part' => $req->input('part'),'checkin_date' => $req->input('checkin_date'),
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
    $style = $req->style;
    $datasearch = $req->datasearch;
    if($style == "txtsearchdate"){
      $sqlquotation = DB::table('quotations')
      ->join('customers', 'customers.cusid', '=', 'quotations.cusid')
      ->join('cars', 'cars.carid', '=', 'quotations.carid')
      ->where('quotations.document_date', 'like', '%'.$datasearch.'%')
      ->select('quotations.*','customers.*','cars.*')
      ->orderBy('qtid', 'desc')->get();
    }elseif($style == "txtsearchid"){
      $sqlquotation = DB::table('quotations')
      ->join('customers', 'customers.cusid', '=', 'quotations.cusid')
      ->join('cars', 'cars.carid', '=', 'quotations.carid')
      ->where('quotations.qtid', '=', $datasearch)
      ->select('quotations.*','customers.*','cars.*')
      ->orderBy('qtid', 'desc')->get();
    }elseif($style == "txtsearchname"){
      $sqlquotation = DB::table('quotations')
      ->join('customers', 'customers.cusid', '=', 'quotations.cusid')
      ->join('cars', 'cars.carid', '=', 'quotations.carid')
      ->where('customers.name', 'like', '%'.$datasearch.'%')
      ->select('quotations.*','customers.*','cars.*')
      ->orderBy('qtid', 'desc')->get();
    }else{
      $sqlquotation = DB::table('quotations')
      ->join('customers', 'customers.cusid', '=', 'quotations.cusid')
      ->join('cars', 'cars.carid', '=', 'quotations.carid')
      ->where('quotations.document_date', 'like', '%'.$datasearch.'%')
      ->select('quotations.*','customers.*','cars.*')
      ->orderBy('qtid', 'desc')->get();
    }
    if(count($sqlquotation) > 0){
      foreach($sqlquotation as $squot){
        $result .='
        <tr>
        <td>'.$squot->qtid.'</td>
        <td>'.$squot->name.' ('.$squot->workaddress.')</td>
        <td>'.$squot->license.'</td>
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
