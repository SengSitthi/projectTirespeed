<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Auth, Validator;
use Illuminate\Support\Str;

class AccInvoiceController extends Controller
{
  // index account page
  public function fnNewInvoice()
  {
    $invoice = DB::table('invoice')->select('invoiceid')->orderBy('invoiceid', 'desc')->take(1)->get();
    if(count($invoice) > 0){
      foreach($invoice as $inv){
        $invoiceid = $inv->invoiceid;
      }
      // $invoiceid = "INV0001";
      $strstring = Str::substr($invoiceid, 3, 7);
      $sum = (int)$strstring + 1;
      if(strlen($sum) == 1){
        $id = "000".$sum;
      }else if(strlen($sum) == 2){
        $id = "00".$sum;
      }else if(strlen($sum) == 3){
        $id = "0".$sum;
      }else{
        $id = $sum;
      }
      $invid = "INV".$id;
    }else{
      $invid = "INV0001";
    }
    $quotations = DB::table('quotations')->orderBy('qtid', 'desc')->get();
    $company = DB::table('company')->orderBy('cpid', 'desc')->get();
    return view('manage/account/invoicenew')->with('company', $company)->with('quotations', $quotations)->with('invid', $invid);
  }

  // function get quotation detail
  public function fnGetQuotationdt(Request $req)
  {
    $result = "";
    $qtdetail = DB::table('quotations_detail')
    ->join('wages', 'wages.wageid', '=', 'quotations_detail.wageid')
    ->join('spares', 'spares.rpnoid', '=', 'quotations_detail.rpnoid')
    ->where('quotations_detail.qtid', $req->qtid)->where('quotations_detail.status', "1")
    ->select('quotations_detail.*','wages.*','spares.*')->get();
    foreach($qtdetail as $qtdt){
      $result .= '
      <tr>
        <td>
          <input class="form-control" type="text" name="rpnoid[]" value="'.$qtdt->rpnoid.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="sparename[]" value="'.$qtdt->sparesname.'" readonly>
        </td>
        <td>
          <input class="form-control" type="number" name="qty[]" value="'.$qtdt->qty.'">
        </td>
        <td>
          <input class="form-control" type="text" name="price[]" value="'.$qtdt->price.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="total[]" value="'.$qtdt->total.'" readonly>
        </td>
        <td>
          <input class="form-control" type="number" name="discount[]" value="0">
        </td>
        <td>
          <input class="form-control" type="text" name="wageid[]" value="'.$qtdt->wageid.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="wagename[]" value="'.$qtdt->wagename.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="remark[]" value="">
        </td>
      </tr>
      ';
    }
    $data = array('result' => $result);
    echo json_encode($data);
  }

  // function insert new invoice data
  public function fnInsertNewInvoice(Request $req)
  {
    $this->validate($req, [
      'qtid' => 'required',
      'cpid' => 'required'
    ]);

    $newinvoicedata = array(
      'invoiceid' => $req->input('invoiceid'),
      'qtid' => $req->input('qtid'),
      'cpid' => $req->input('cpid'),
      'invoice_date' => $req->input('invoice_date'),
      'bill_date' => $req->input('bill_date'),
      // 'discount' => $req->input('discount'),
      'expire_date' => $req->input('expire_date'),
      'credit' => $req->input('credit'),
      'status' => 0,
      'created_at' => date('Y-m-d H:i:s')
    );

    $rpnoid = $req->input('rpnoid');
    for($i=0; $i < count($rpnoid); $i++){
      $indt = array(
        'invoiceid' => $req->input('invoiceid'),
        'rpnoid' => $req->input('rpnoid')[$i],
        'qty' => $req->input('qty')[$i],
        'price' => $req->input('price')[$i],
        'total' => $req->input('total')[$i],
        'discount' => $req->input('discount')[$i],
        'wageid' => $req->input('wageid')[$i],
        'remark' => $req->input('remark')[$i],
        'status' => "0",
        'created_at' => date('Y-m-d H:i:s')
      );
      $invoicedetail[] = $indt;
    }

    $checkrow = DB::table('invoice')->where('invoiceid', $req->input('invoiceid'))->get();
    if(count($checkrow) > 0){
      return back()->with('error', 'The ID is already!');
    }else{
      DB::table('invoice')->insert($newinvoicedata);
      DB::table('invoice_detail')->insert($invoicedetail);
      $invoices = DB::table('invoice')->join('quotations', 'quotations.qtid', '=', 'invoice.qtid')
      ->join('company', 'company.cpid', '=', 'invoice.cpid')
      ->join('repairbill', 'repairbill.rpbid', '=', 'quotations.rpbid')
      ->join('receivecars', 'receivecars.rcsid', '=', 'repairbill.rcsid')
      ->join('cars', 'cars.carid', '=', 'receivecars.carid')
      ->join('brands', 'brands.brandid', '=', 'cars.brandid')
      ->where('invoice.invoiceid', '=', $req->input('invoiceid'))
      ->select('invoice.*', 'company.*', 'cars.*', 'brands.brandname')->get();
      $inlist = DB::table('invoice_detail')
      ->join('spares', 'spares.rpnoid', '=', 'invoice_detail.rpnoid')
      ->join('unitspare', 'unitspare.unitid', '=', 'spares.unitid')
      ->where('invoiceid', $req->input('invoiceid'))
      ->select('invoice_detail.*', 'spares.sparesname', 'unitspare.unitname')->get();
      $wages = DB::table('invoice_detail')->join('wages', 'wages.wageid', '=', 'invoice_detail.wageid')
      ->where('invoice_detail.invoiceid', '=', $req->input('invoiceid'))->select('wages.*')->get();
      $sumspares = DB::table('invoice_detail')->where('invoiceid', $req->input('invoiceid'))->sum('price');
      $sumwages = DB::table('invoice_detail')->join('wages', 'wages.wageid', '=', 'invoice_detail.wageid')
      ->where('invoiceid', $req->input('invoiceid'))->sum('wages.cost');
      $url = "newinvoice";
      $i = 1;
      $w = 1;
      return view('manage/account/invoicebill')->with('invoices', $invoices)->with('url', $url)->with('inlist', $inlist)
      ->with('i', $i)->with('w', $w)->with('wages', $wages)->with('sumspares', $sumspares)->with('sumwages', $sumwages);
    }
  }

  // function show invoice list page
  public function fnInvoicelist()
  {
    $company = DB::table('company')->orderBy('cpid', 'desc')->get();
    $invoices = DB::table('invoice')->join('company', 'company.cpid', '=', 'invoice.cpid')
    ->select('invoice.*', 'company.cpname')->orderBy('invoiceid', 'desc')->get();
    return view('manage/account/invoicelist')->with('invoices', $invoices)->with('company', $company);
  }

  // function print invoice bill
  public function fnPrintInvoicebill($invoiceid)
  {
    $invoices = DB::table('invoice')->join('quotations', 'quotations.qtid', '=', 'invoice.qtid')
      ->join('company', 'company.cpid', '=', 'invoice.cpid')
      ->join('repairbill', 'repairbill.rpbid', '=', 'quotations.rpbid')
      ->join('receivecars', 'receivecars.rcsid', '=', 'repairbill.rcsid')
      ->join('cars', 'cars.carid', '=', 'receivecars.carid')
      ->join('brands', 'brands.brandid', '=', 'cars.brandid')
      ->where('invoice.invoiceid', '=', $invoiceid)
      ->select('invoice.*', 'company.*', 'cars.*', 'brands.brandname')->get();
    $inlist = DB::table('invoice_detail')
    ->join('spares', 'spares.rpnoid', '=', 'invoice_detail.rpnoid')
    ->join('unitspare', 'unitspare.unitid', '=', 'spares.unitid')
    ->where('invoiceid', $invoiceid)
    ->select('invoice_detail.*', 'spares.sparesname', 'unitspare.unitname')->get();
    $wages = DB::table('invoice_detail')->join('wages', 'wages.wageid', '=', 'invoice_detail.wageid')
    ->where('invoice_detail.invoiceid', '=', $invoiceid)->select('wages.*')->get();
    $sumspares = DB::table('invoice_detail')->where('invoiceid', $invoiceid)->sum('price');
    $sumwages = DB::table('invoice_detail')->join('wages', 'wages.wageid', '=', 'invoice_detail.wageid')->where('invoiceid', $invoiceid)->sum('wages.cost');
    $url = "invoicelist";
    $i = 1;
    $w = 1;
    return view('manage/account/invoicebill')->with('invoices', $invoices)->with('url', $url)->with('inlist', $inlist)
    ->with('i', $i)->with('w', $w)->with('wages', $wages)->with('sumspares', $sumspares)->with('sumwages', $sumwages);
  }

  // function to get invoice data to update form
  public function fnInvoicetoEdit(Request $req)
  {
    $invoicedata = DB::table('invoice')->where('invoiceid', $req->invoiceid)->get();
    foreach($invoicedata as $invdt){
      $cpid = $invdt->cpid;
      $invoice_date = $invdt->invoice_date;
      $bill_date = $invdt->bill_date;
      $expire_date = $invdt->expire_date;
      $credit = $invdt->credit;
    }
    $data = array('cpid'=>$cpid,'invoice_date'=>$invoice_date, 'bill_date'=>$bill_date, 'expire_date'=>$expire_date, 'credit'=>$credit);
    echo json_encode($data);
  }

  // function update invoice data
  public function fnUpdateInvoice(Request $req)
  {
    $this->validate($req, [
      'cpid' => 'required'
    ]);

    $dataupdate = array(
      'cpid' => $req->input('cpid'),
      'invoice_date' => $req->input('invoice_date'),
      'bill_date' => $req->input('bill_date'),
      'expire_date' => $req->input('expire_date'),
      'credit' => $req->input('credit'),
      'updated_at' => date('Y-m-d H:i:s')
    );
    DB::table('invoice')->where('invoiceid', $req->input('invoiceid'))->update($dataupdate);
    return redirect('invoicelist')->with('success', 'Update data successfully!');
  }

  // function search invoice
  public function fnSearchInvoice(Request $req)
  {
    $result = "";
    $datasearch = DB::table('invoice')->join('company', 'company.cpid', '=', 'invoice.cpid')
    ->where('invoice.invoiceid', 'like', '%'.$req->txtsearch.'%')->orWhere('invoice.qtid', 'like', '%'.$req->txtsearch.'%')
    ->orWhere('invoice.invoice_date', 'like', '%'.$req->txtsearch.'%')->orWhere('company.cpname', 'like', '%'.$req->txtsearch.'%')
    ->select('invoice.*', 'company.cpname')->orderBy('invoiceid', 'desc')->get();
    if(count($datasearch) > 0){
      foreach($datasearch as $inv){
      $result .= '
      <tr>
        <td class="text-center">'.$inv->invoiceid.'</td>
        <td>'.$inv->qtid.'</td>
        <td>'.$inv->cpname.'</td>
        <td class="text-center">'.$inv->invoice_date.'</td>
        <td class="text-center">'.$inv->expire_date.'</td>
        <td class="text-center">'.$inv->credit.'</td>
        <td class="text-center">
          <a href="/printinvoice/'.$inv->invoiceid.'" class="btn btn-primary"><i class="mdi mdi-printer"></i></a>
        </td>
        <td class="text-center">
          <div class="btn-group dropleft">
            <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="mdi mdi-dots-horizontal"></i>
            </button>
            <div class="dropdown-menu">
              <button class="dropdown-item" id="btnShowlist" value="'.$inv->invoiceid.'"><i class="mdi mdi-clipboard-list"></i> ສະ​ແດງ​ລາຍ​ການ</button>
              <button class="dropdown-item" id="btnEdit" value="'.$inv->invoiceid.'"><i class="mdi mdi-pen"></i> ແກ້​ໄຂ​ຂໍ້​ມູນ</button>
              <button class="dropdown-item" id="btnTrash" value="'.$inv->invoiceid.'"><i class="mdi mdi-trash-can-outline"></i> ລຶບ</a>
            </div>
          </div>
        </td>
      </tr>
      ';
      }
    }else{
      $result .= '
        <tr><th colspan="8" class="text-center">ບໍ່​ມີ​ຂໍ້​ມູນ​ທີ່​ທ່ານ​ຄົ້ນ​ຫາ</th></tr>
      ';
    }
    $data = array('result'=>$result);
    echo json_encode($data);
  }

  // function get invoice detail list
  public function fnGetinvoice_detail(Request $req)
  {
    $result = "";
    $inlist = DB::table('invoice_detail')
    ->join('spares', 'spares.rpnoid', '=', 'invoice_detail.rpnoid')
    ->join('unitspare', 'unitspare.unitid', '=', 'spares.unitid')
    ->join('wages', 'wages.wageid', '=', 'invoice_detail.wageid')
    ->where('invoiceid', $req->invoiceid)
    ->select('invoice_detail.*', 'spares.sparesname', 'unitspare.unitname', 'wages.wagename')->get();
    foreach($inlist as $inl){
      $result .= '
      <tr>
        <td class="text-center">'.$inl->rpnoid.'</td>
        <td>'.$inl->sparesname.'</td>
        <td class="text-center">'.$inl->qty.'</td>
        <td class="text-right">'.$inl->price.'</td>
        <td class="text-right">'.$inl->total.'</td>
        <td class="text-right">'.$inl->discount.'</td>
        <td class="text-center">'.$inl->wageid.'</td>
        <td>'.$inl->wagename.'</td>
        <td>'.$inl->remark.'</td>
      </tr>
      ';
    }
    $data = array('result'=>$result);
    echo json_encode($data);
  }

  // function delete invoice data
  public function fnDeleteInvoice($invoiceid)
  {
    DB::table('invoice')->where('invoiceid', $invoiceid)->delete();
    return redirect('invoicelist')->with('success', 'Delete invoice data successfully!');
  }
}
