<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Auth, Validator;
use Illuminate\Support\Str;

class ReceiptController extends Controller
{
  // function show new receipt page
  public function index()
  {
    $receipts = DB::table('receipts')->select('receiptid')->orderBy('receiptid', 'desc')->take(1)->get();
    if(count($receipts) > 0){
      foreach($receipts as $rec){
        $receiptid = $rec->receiptid;
      }
      $receiptid = "REC0000001";
      $strstring = Str::substr($receiptid, 3, 10);
      $sum = (int)$strstring + 1;
      if(strlen($sum) == 1){
        $id = "000000".$sum;
      }else if(strlen($sum) == 2){
        $id = "00000".$sum;
      }else if(strlen($sum) == 3){
        $id = "0000".$sum;
      }else if(strlen($sum) == 4){
        $id = "000".$sum;
      }else if(strlen($sum) == 5){
        $id = "00".$sum;
      }else if(strlen($sum) == 6){
        $id = "0".$sum;
      }else{
        $id = $sum;
      }
      $rcpt = "REC".$id;
    }else{
      $rcpt = "REC0000001";
    }
    $invoice = DB::table('invoice')->orderBy('invoiceid', 'desc')->get();
    return view('manage/account/receipt')->with('receiptid', $rcpt)->with('invoice', $invoice);
  }

  // function get invoice data
  public function fnLoadInvoicedata(Request $req)
  {
    $result = "";
    $invoicedetail = DB::table('invoice_detail')
    ->join('wages', 'wages.wageid', '=', 'invoice_detail.wageid')
    ->join('repairsno', 'repairsno.rpnoid', '=', 'invoice_detail.rpnoid')
    ->join('spares', 'spares.sparesid', '=', 'repairsno.sparesid')
    ->where('invoice_detail.invoiceid', $req->invoiceid)
    ->select('invoice_detail.*','wages.*','repairsno.*', 'spares.sparesname')->get();
    $invoices = DB::table('invoice')->where('invoiceid', $req->invoiceid)->get();
    foreach($invoices as $inv){
      $invoice_date = $inv->invoice_date;
    }
    foreach($invoicedetail as $invdt){
      $result .= '
      <tr>
        <td>
          <input class="form-control" type="text" name="rpnoid[]" value="'.$invdt->rpnoid.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="sparename[]" value="'.$invdt->sparesname.'" readonly>
        </td>
        <td>
          <input class="form-control" type="number" name="qty[]" value="'.$invdt->qty.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="price[]" value="'.$invdt->price.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="total[]" value="'.$invdt->total.'" readonly>
        </td>
        <td>
          <input class="form-control" type="number" name="discount[]" value="'.$invdt->discount.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="wageid[]" value="'.$invdt->wageid.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="wagename[]" value="'.$invdt->wagename.'" readonly>
        </td>
        <td>
          <input class="form-control" type="text" name="remark[]" value="">
        </td>
        <td>
          <select id="status" class="form-control" name="status[]">
            <option value="ຍັງບໍ່​ທັນ​ຈ່າຍ">ຍັງບໍ່​ທັນ​ຈ່າຍ</option>
            <option value="ຈ່າຍ​ເຄິ່ງ​ໜຶ່ງ">ຈ່າຍ​ເຄິ່ງ​ໜຶ່ງ</option>
            <option value="ຈ່າຍ​ຄົບ">ຈ່າຍ​ຄົບ</option>
            <option value="ຟ​ຣີ">ຟ​ຣີ</option>
          </select>
        </td>
      </tr>
      ';
    }
    $data = array('result'=>$result, 'invoice_date'=>$invoice_date);
    echo json_encode($data);
  }

  // function insert new receipt data
  public function fnInNewreceipt(Request $req)
  {
    $this->validate($req, [
      'invoiceid' => 'required'
    ]);

    $receiptdata = array(
      'receiptid'=>$req->input('receiptid'),
      'invoiceid'=>$req->input('invoiceid'),
      'receipt_date'=>$req->input('receipt_date'),
      'receipt_from'=>$req->input('receipt_from'),
      'invoice_date'=>$req->input('invoice_date'),
      'created_at'=>date('Y-m-d H:i:s')
    );
    $rpnoid = $req->input('rpnoid');
    for($i=0; $i < count($rpnoid); $i++){
      $recdt = array(
        'receiptid' => $req->input('receiptid'),
        'rpnoid' => $req->input('rpnoid')[$i],
        'qty' => $req->input('qty')[$i],
        'price' => $req->input('price')[$i],
        'total' => $req->input('total')[$i],
        'discount' => $req->input('discount')[$i],
        'wageid' => $req->input('wageid')[$i],
        'remark' => $req->input('remark')[$i],
        'status' => $req->input('status')[$i],
        'created_at' => date('Y-m-d H:i:s')
      );
      $rcpdetaildata[] = $recdt;
    }
    $check = DB::table('receipts')->where('receiptid', $req->input('receiptid'))->get();
    if(count($check) > 0){
      return back()->with('errors', 'This ID is already!');
    }else{
      DB::table('receipts')->insert($receiptdata);
      DB::table('receipts_detail')->insert($rcpdetaildata);
      $receipts = DB::table('receipts')->where('receiptid', $req->input('receiptid'))->get();
      $receiptlist = DB::table('receipts_detail')
        ->join('repairsno', 'repairsno.rpnoid', '=', 'receipts_detail.rpnoid')
        ->join('spares', 'spares.sparesid', '=', 'repairsno.sparesid')
        ->join('unitspare', 'unitspare.unitid', '=', 'spares.unitid')
        ->where('receipts_detail.receiptid', $req->input('receiptid'))
        ->select('receipts_detail.*', 'spares.*', 'unitspare.unitname')->get();
      $wages = DB::table('receipts_detail')->join('wages', 'wages.wageid', '=', 'receipts_detail.wageid')
        ->where('receipts_detail.receiptid', '=', $req->input('receiptid'))->select('wages.*')->get();
      $sumspares = DB::table('receipts_detail')->where('receiptid', $req->input('receiptid'))->sum('price');
      $sumwages = DB::table('receipts_detail')->join('wages', 'wages.wageid', '=', 'receipts_detail.wageid')
      ->where('receipts_detail.receiptid', '=', $req->input('receiptid'))->sum('wages.cost');
      $url = "receiptlist";
      $i = 1;
      $w = 1;
      return view('manage/account/receiptbill')->with('receipts', $receipts)->with('receiptlist', $receiptlist)
      ->with('i', $i)->with('url', $url)->with('wages', $wages)->with('w', $w)->with('sumspares', $sumspares)
      ->with('sumwages', $sumwages);
    }
  }

  // function show receipt list page
  public function fnReceiptlist()
  {
    $receipts = DB::table('receipts')->orderBy('receiptid', 'desc')->paginate(30);
    return view('manage/account/receiptlist')->with('receipts', $receipts);
  }

  // function to print receipt bill
  public function fnPrintReceipt($receiptid)
  {
    $receipts = DB::table('receipts')->where('receiptid', $receiptid)->get();
    $receiptlist = DB::table('receipts_detail')
      ->join('repairsno', 'repairsno.rpnoid', '=', 'receipts_detail.rpnoid')
      ->join('spares', 'spares.sparesid', '=', 'repairsno.sparesid')
      ->join('unitspare', 'unitspare.unitid', '=', 'spares.unitid')
      ->where('receipts_detail.receiptid', $receiptid)
      ->select('receipts_detail.*', 'spares.*', 'unitspare.unitname')->get();
    $wages = DB::table('receipts_detail')->join('wages', 'wages.wageid', '=', 'receipts_detail.wageid')
      ->where('receipts_detail.receiptid', '=', $receiptid)->select('wages.*')->get();
    $sumspares = DB::table('receipts_detail')->where('receiptid', $receiptid)->sum('price');
    $sumwages = DB::table('receipts_detail')->join('wages', 'wages.wageid', '=', 'receipts_detail.wageid')
    ->where('receipts_detail.receiptid', '=', $receiptid)->sum('wages.cost');
    $url = "receiptlist";
    $i = 1;
    $w = 1;
    return view('manage/account/receiptbill')->with('receipts', $receipts)->with('receiptlist', $receiptlist)
    ->with('i', $i)->with('url', $url)->with('wages', $wages)->with('w', $w)->with('sumspares', $sumspares)
    ->with('sumwages', $sumwages);
  }

  // function to load receipt detail data to show on modal
  public function fnLoadReceiptdetail(Request $req)
  {
    $result = "";
    $recdetail = DB::table('receipts_detail')->join('repairsno', 'repairsno.rpnoid', '=', 'receipts_detail.rpnoid')
    ->join('spares', 'spares.sparesid', '=', 'repairsno.sparesid')->join('wages', 'wages.wageid', '=', 'receipts_detail.wageid')
    ->where('receipts_detail.receiptid', '=', $req->receiptid)
    ->select('receipts_detail.*', 'spares.sparesname', 'wages.wagename')->get();
    foreach($recdetail as $rdt){
      $result .= '
      <tr>
        <td class="text-center">'.$rdt->rpnoid.'</td>
        <td>'.$rdt->sparesname.'</td>
        <td class="text-center">'.$rdt->qty.'</td>
        <td class="text-right">'.$rdt->price.'</td>
        <td class="text-right">'.$rdt->total.'</td>
        <td class="text-center">'.$rdt->discount.'</td>
        <td class="text-center">'.$rdt->wageid.'</td>
        <td>'.$rdt->wagename.'</td>
        <td>'.$rdt->remark.'</td>
        <td class="text-center">'.$rdt->status.'</td>
      </tr>
      ';
    }
    $data = array('result'=>$result);
    echo json_encode($data);
  }

  // function get receipt data to edit
  public function fnGetreceipt(Request $req)
  {
    $receipts = DB::table('receipts')->where('receiptid', $req->receiptid)->get();
    foreach($receipts as $rec){
      $receipt_date = $rec->receipt_date;
      $receipt_from = $rec->receipt_from;
    }
    $data = array('receipt_date'=>$receipt_date, 'receipt_from'=>$receipt_from);
    echo json_encode($data);
  }

  // function to update receipt data
  public function fnUpdateReceipt(Request $req)
  {
    // dd($req->all());
    $dataupdate = array('receipt_date'=>$req->input('receipt_date'),'receipt_from'=>$req->input('receipt_from'));
    DB::table('receipts')->where('receiptid', $req->input('receiptid'))->update($dataupdate);
    return redirect('receiptlist')->with('success', 'Update Data success!');
  }

  // function delete receipt data
  public function deleteReceipt($receiptid)
  {
    DB::table('receipts')->where('receiptid', $receiptid)->delete();
    return redirect('receiptlist')->with('success', 'Delete Receipt successfully!');
  }

  // function search receipt data
  public function fnSearchReceipt(Request $req)
  {
    $result = "";
    $receipts = DB::table('receipts')->where('receiptid', 'like', '%'.$req->searchreceipt.'%')
    ->orWhere('invoiceid', 'like', '%'.$req->searchreceipt.'%')->orWhere('receipt_date', 'like', '%'.$req->searchreceipt.'%')
    ->orderBy('receiptid', 'desc')->get();
    if(count($receipts) > 0){
      foreach($receipts as $rec){
        $result .= '
        <tr>
          <td>'.$rec->receiptid.'</td>
          <td>'.$rec->invoiceid.'</td>
          <td>'.$rec->receipt_date.'</td>
          <td>'.$rec->receipt_from.'</td>
          <td>'.$rec->invoice_date.'</td>
          <td class="text-center">
            <a href="/printreceipt/'.$rec->receiptid.'" class="btn btn-primary"><i class="mdi mdi-printer"></i></a>
          </td>
          <td>
            <div class="btn-group dropleft">
              <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-dots-horizontal"></i>
              </button>
              <div class="dropdown-menu">
                <button class="dropdown-item" type="button" id="btnShowlist" value="'.$rec->receiptid.'"><i class="mdi mdi-clipboard-list"></i> ສະ​ແດງ​ລາຍ​ການ</button>
                <button class="dropdown-item" type="button" id="btnEdit" value="'.$rec->receiptid.'"><i class="mdi mdi-pen"></i> ແກ້​ໄຂ​ຂໍ້​ມູນ</button>
                <button class="dropdown-item" type="button" id="btnTrash" value="'.$rec->receiptid.'"><i class="mdi mdi-trash-can-outline"></i> ລຶບ</a>
              </div>
            </div>
          </td>
        </tr>
        ';
      }
    }else{
      $result .= '
      <tr>
        <th colspan="7">ບໍ່​ມີ​ລາຍ​ການ​ທີ່​ທ່ານ​ຄົ້ນ​ຫາ!</th>
      </tr>
      ';
    }
    $data = array('result'=>$result);
    echo json_encode($data);
  }
}
