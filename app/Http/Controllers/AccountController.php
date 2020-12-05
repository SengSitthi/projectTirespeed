<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Validator, Auth;
use Illuminate\Support\Str;

class AccountController extends Controller
{
  // function dashboard page
  public function index()
  {
    $monday = date('Y-m-d', strtotime('Monday this week'));
    $saturday = date('Y-m-d', strtotime('Saturday this week'));
    // sum total invoice on today
    $invoicetoday = DB::table('invoice_detail')->join('invoice', 'invoice.invoiceid', '=', 'invoice_detail.invoiceid')
    ->where('invoice.invoice_date', '=', date('Y-m-d'))->sum('invoice_detail.total');
    // sum total receipt on today
    $receipttoday = DB::table('receipts_detail')->join('receipts', 'receipts.receiptid', '=', 'receipts_detail.receiptid')
    ->where('receipts.receipt_date', '=', date('Y-m-d'))->sum('receipts_detail.total');
    // sum total invoice on this week
    $invoiceweek = DB::table('invoice_detail')->join('invoice', 'invoice.invoiceid', '=', 'invoice_detail.invoiceid')
    ->whereBetween('invoice.invoice_date', [$monday, $saturday])->sum('invoice_detail.total');
    // sum total receipt on this week
    $receiptweek = DB::table('receipts_detail')->join('receipts', 'receipts.receiptid', '=', 'receipts_detail.receiptid')
    ->whereBetween('receipts.receipt_date', [$monday, $saturday])->sum('receipts_detail.total');
    // sum total invoice on this month
    $invoicemonth = DB::table('invoice_detail')->join('invoice', 'invoice.invoiceid', '=', 'invoice_detail.invoiceid')
    ->where('invoice.invoice_date', '=', '%'.date('Y-m').'%')->sum('invoice_detail.total');
    // sum total receipt on this month
    $receiptmonth = DB::table('receipts_detail')->join('receipts', 'receipts.receiptid', '=', 'receipts_detail.receiptid')
    ->where('receipts.receipt_date', '=', '%'.date('Y-m').'%')->sum('receipts_detail.total');
    // sum total invoice on this year
    $invoiceyear = DB::table('invoice_detail')->join('invoice', 'invoice.invoiceid', '=', 'invoice_detail.invoiceid')
    ->where('invoice.invoice_date', '=', '%'.date('Y').'%')->sum('invoice_detail.total');
    // sum total receipt on this year
    $receiptyear = DB::table('receipts_detail')->join('receipts', 'receipts.receiptid', '=', 'receipts_detail.receiptid')
    ->where('receipts.receipt_date', '=', '%'.date('Y').'%')->sum('receipts_detail.total');
    return view('manage/account/index')->with('invoicetoday', $invoicetoday)->with('receipttoday', $receipttoday)->with('invoiceweek', $invoiceweek)
    ->with('receiptweek', $receiptweek)->with('invoicemonth', $invoicemonth)->with('receiptmonth', $receiptmonth)->with('invoiceyear', $invoiceyear)
    ->with('receiptyear', $receiptyear);
  }

  // function show invoice and receipt chart
  public function fnInvRecChart(Request $req)
  {
    ///////////////////////// invoice //////////////////////////////////////////////////
    // $january = date('Y-m-d', strtotime('Last day of January'));
    $inv_jan = DB::table('invoice_detail')->join('invoice', 'invoice.invoiceid', '=', 'invoice_detail.invoiceid')
    ->whereBetween('invoice.invoice_date', [date('Y-m-d', strtotime('First day of January')), date('Y-m-d', strtotime('Last day of January'))])->sum('invoice_detail.total');
    $inv_feb = DB::table('invoice_detail')->join('invoice', 'invoice.invoiceid', '=', 'invoice_detail.invoiceid')
    ->whereBetween('invoice.invoice_date', [date('Y-m-d', strtotime('First day of February')), date('Y-m-d', strtotime('Last day of February'))])->sum('invoice_detail.total');
    $inv_mar = DB::table('invoice_detail')->join('invoice', 'invoice.invoiceid', '=', 'invoice_detail.invoiceid')
    ->whereBetween('invoice.invoice_date', [date('Y-m-d', strtotime('First day of March')), date('Y-m-d', strtotime('Last day of March'))])->sum('invoice_detail.total');
    $inv_apr = DB::table('invoice_detail')->join('invoice', 'invoice.invoiceid', '=', 'invoice_detail.invoiceid')
    ->whereBetween('invoice.invoice_date', [date('Y-m-d', strtotime('First day of April')), date('Y-m-d', strtotime('Last day of April'))])->sum('invoice_detail.total');
    $inv_may = DB::table('invoice_detail')->join('invoice', 'invoice.invoiceid', '=', 'invoice_detail.invoiceid')
    ->whereBetween('invoice.invoice_date', [date('Y-m-d', strtotime('First day of May')), date('Y-m-d', strtotime('Last day of May'))])->sum('invoice_detail.total');
    $inv_jun = DB::table('invoice_detail')->join('invoice', 'invoice.invoiceid', '=', 'invoice_detail.invoiceid')
    ->whereBetween('invoice.invoice_date', [date('Y-m-d', strtotime('First day of June')), date('Y-m-d', strtotime('Last day of June'))])->sum('invoice_detail.total');
    $inv_jul = DB::table('invoice_detail')->join('invoice', 'invoice.invoiceid', '=', 'invoice_detail.invoiceid')
    ->whereBetween('invoice.invoice_date', [date('Y-m-d', strtotime('First day of July')), date('Y-m-d', strtotime('Last day of July'))])->sum('invoice_detail.total');
    $inv_aug = DB::table('invoice_detail')->join('invoice', 'invoice.invoiceid', '=', 'invoice_detail.invoiceid')
    ->whereBetween('invoice.invoice_date', [date('Y-m-d', strtotime('First day of August')), date('Y-m-d', strtotime('Last day of August'))])->sum('invoice_detail.total');
    $inv_sep = DB::table('invoice_detail')->join('invoice', 'invoice.invoiceid', '=', 'invoice_detail.invoiceid')
    ->whereBetween('invoice.invoice_date', [date('Y-m-d', strtotime('First day of September')), date('Y-m-d', strtotime('Last day of September'))])->sum('invoice_detail.total');
    $inv_oct = DB::table('invoice_detail')->join('invoice', 'invoice.invoiceid', '=', 'invoice_detail.invoiceid')
    ->whereBetween('invoice.invoice_date', [date('Y-m-d', strtotime('First day of October')), date('Y-m-d', strtotime('Last day of October'))])->sum('invoice_detail.total');
    $inv_nov = DB::table('invoice_detail')->join('invoice', 'invoice.invoiceid', '=', 'invoice_detail.invoiceid')
    ->whereBetween('invoice.invoice_date', [date('Y-m-d', strtotime('First day of November')), date('Y-m-d', strtotime('Last day of November'))])->sum('invoice_detail.total');
    $inv_dec = DB::table('invoice_detail')->join('invoice', 'invoice.invoiceid', '=', 'invoice_detail.invoiceid')
    ->whereBetween('invoice.invoice_date', [date('Y-m-d', strtotime('First day of December')), date('Y-m-d', strtotime('Last day of December'))])->sum('invoice_detail.total');
    $invoice = array($inv_jan,$inv_feb,$inv_mar,$inv_apr,$inv_may,$inv_jun,$inv_jul,$inv_aug,$inv_sep,$inv_oct,$inv_nov,$inv_dec);

    ///////////////////////////////////////////// receipt ///////////////////////////////////////////////////
    $rec_jan = DB::table('receipts_detail')->join('receipts', 'receipts.receiptid', '=', 'receipts_detail.receiptid')
    ->whereBetween('receipts.receipt_date', [date('Y-m-d', strtotime('First day of January')), date('Y-m-d', strtotime('Last day of January'))])->sum('receipts_detail.total');
    $rec_feb = DB::table('receipts_detail')->join('receipts', 'receipts.receiptid', '=', 'receipts_detail.receiptid')
    ->whereBetween('receipts.receipt_date', [date('Y-m-d', strtotime('First day of February')), date('Y-m-d', strtotime('Last day of February'))])->sum('receipts_detail.total');
    $rec_mar = DB::table('receipts_detail')->join('receipts', 'receipts.receiptid', '=', 'receipts_detail.receiptid')
    ->whereBetween('receipts.receipt_date', [date('Y-m-d', strtotime('First day of March')), date('Y-m-d', strtotime('Last day of March'))])->sum('receipts_detail.total');
    $rec_apr = DB::table('receipts_detail')->join('receipts', 'receipts.receiptid', '=', 'receipts_detail.receiptid')
    ->whereBetween('receipts.receipt_date', [date('Y-m-d', strtotime('First day of April')), date('Y-m-d', strtotime('Last day of April'))])->sum('receipts_detail.total');
    $rec_may = DB::table('receipts_detail')->join('receipts', 'receipts.receiptid', '=', 'receipts_detail.receiptid')
    ->whereBetween('receipts.receipt_date', [date('Y-m-d', strtotime('First day of May')), date('Y-m-d', strtotime('Last day of May'))])->sum('receipts_detail.total');
    $rec_jun = DB::table('receipts_detail')->join('receipts', 'receipts.receiptid', '=', 'receipts_detail.receiptid')
    ->whereBetween('receipts.receipt_date', [date('Y-m-d', strtotime('First day of June')), date('Y-m-d', strtotime('Last day of June'))])->sum('receipts_detail.total');
    $rec_jul = DB::table('receipts_detail')->join('receipts', 'receipts.receiptid', '=', 'receipts_detail.receiptid')
    ->whereBetween('receipts.receipt_date', [date('Y-m-d', strtotime('First day of July')), date('Y-m-d', strtotime('Last day of July'))])->sum('receipts_detail.total');
    $rec_aug = DB::table('receipts_detail')->join('receipts', 'receipts.receiptid', '=', 'receipts_detail.receiptid')
    ->whereBetween('receipts.receipt_date', [date('Y-m-d', strtotime('First day of August')), date('Y-m-d', strtotime('Last day of August'))])->sum('receipts_detail.total');
    $rec_sep = DB::table('receipts_detail')->join('receipts', 'receipts.receiptid', '=', 'receipts_detail.receiptid')
    ->whereBetween('receipts.receipt_date', [date('Y-m-d', strtotime('First day of September')), date('Y-m-d', strtotime('Last day of September'))])->sum('receipts_detail.total');
    $rec_oct = DB::table('receipts_detail')->join('receipts', 'receipts.receiptid', '=', 'receipts_detail.receiptid')
    ->whereBetween('receipts.receipt_date', [date('Y-m-d', strtotime('First day of October')), date('Y-m-d', strtotime('Last day of October'))])->sum('receipts_detail.total');
    $rec_nov = DB::table('receipts_detail')->join('receipts', 'receipts.receiptid', '=', 'receipts_detail.receiptid')
    ->whereBetween('receipts.receipt_date', [date('Y-m-d', strtotime('First day of November')), date('Y-m-d', strtotime('Last day of November'))])->sum('receipts_detail.total');
    $rec_dec = DB::table('receipts_detail')->join('receipts', 'receipts.receiptid', '=', 'receipts_detail.receiptid')
    ->whereBetween('receipts.receipt_date', [date('Y-m-d', strtotime('First day of December')), date('Y-m-d', strtotime('Last day of December'))])->sum('receipts_detail.total');
    $receipt = array($rec_jan,$rec_feb,$rec_mar,$rec_apr,$rec_may,$rec_jun,$rec_jul,$rec_aug,$rec_sep,$rec_oct,$rec_nov,$rec_dec);
    $data = array("invoice"=>$invoice,"receipt"=>$receipt);
    echo json_encode($data);
  }

  // function show company page
  public function fnCompany()
  {
    return view('manage/account/company');
  }
  
  // function load company data to show
  public function fnLoadcompany(Request $req)
  {
    $result = "";
    $company = DB::table('company')->orderBy('cpid', 'desc')->get();
    $i = 1;
    if(count($company) > 0){
      foreach($company as $cpn){
        $result .= '
        <tr>
          <td class="text-center">'.$i++.'</td>
          <td>'.$cpn->cpname.'</td>
          <td>'.$cpn->address.'</td>
          <td>'.$cpn->phone.'</td>
          <td>'.$cpn->fax.'</td>
          <td class="text-center"><button class="btn btn-primary" type="button" id="btnEdit" value="'.$cpn->cpid.'"><i class="mdi mdi-pencil"></i></button></td>
          <td class="text-center"><button class="btn btn-danger" type="button" id="btnDel" value="'.$cpn->cpid.'"><i class="mdi mdi-trash-can"></i></button></td>
        </tr>
        ';
      }
    }else{
      $result .='
      <tr>
        <td colspan="7">
          <h4 class="text-center">ຍັງ​ບໍ່​ມີ​ຂໍ​້​ມູນ​ໃນລະ​ບົບ</h4>
        </td>
      </tr>
      ';
    }
    $data = array('result' => $result);
    echo json_encode($data);
  }

  // function insert new company
  public function fnInsertCompany(Request $req)
  {
    $datainsert = array('cpname'=>$req->cpname,'address'=>$req->address,'phone'=>$req->phone,'fax'=>$req->fax,'created_at'=> date('Y-m-d H:i:s'));
    DB::table('company')->insert($datainsert);
    $data = "ການ​ເພີ່ມ​ຂໍ້​ມູນ​ບໍ​ລິ​ສັດ​ໃໝ່​ສຳ​ເລັດ";
    echo json_encode($data);
  }

  // function get company data to update
  public function fnGetCompany(Request $req)
  {
    $getdata = DB::table('company')->where('cpid', $req->cpid)->get();
    foreach($getdata as $gdt){
      $cpname = $gdt->cpname;
      $address = $gdt->address;
      $phone = $gdt->phone;
      $fax = $gdt->fax;
    }
    $data = array('cpname'=>$cpname,'address'=>$address,'phone'=>$phone,'fax'=>$fax);
    echo json_encode($data);
  }

  // function update company data
  public function fnUpdatecompany(Request $req)
  {
    $dataupdate = array('cpname' => $req->cpname, 'address' => $req->address, 'phone' => $req->phone, 'fax' => $req->fax, 'updated_at' => date('Y-m-d H:i:s'));
    DB::table('company')->where('cpid', $req->cpid)->update($dataupdate);
    $data = "ການ​ແກ້​ໄຂ​ຂໍ້​ມູນ​ສຳ​ເລັດ!";
    echo json_encode($data);
  }

  // function delete company data
  public function fnDelCompany(Request $req)
  {
    DB::table('company')->where('cpid', $req->cpid)->delete();
    $data = "ການ​ລຶບ​ລາຍ​ການ​ຂໍ​້​ມູນ​ບໍ​ລິ​ສ​ັດ​ສຳ​ເລັດ!";
    echo json_encode($data);
  }
}
