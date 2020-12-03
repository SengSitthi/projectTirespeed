<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Validator;

class AccountSumController extends Controller
{
  // account summary page
  public function index()
  {
    $monday = date('Y-m-d', strtotime('Monday this week'));
    $saturday =  date('Y-m-d', strtotime('Saturday this week'));
    $summary = DB::table('receipts')->join('receipts_detail', 'receipts_detail.receiptid', '=', 'receipts.receiptid')
                                    ->join('invoice', 'invoice.invoiceid','=','receipts.invoiceid')
                                    ->join('invoice_detail', 'invoice_detail.invoiceid', 'invoice.invoiceid')
                                    ->join('quotations', 'quotations.qtid', '=', 'invoice.qtid')
                                    ->join('repairbill', 'repairbill.rpbid', '=', 'quotations.rpbid')
                                    ->join('receivecars', 'receivecars.rcsid', '=', 'repairbill.rcsid')
                                    ->join('cars', 'cars.carid', '=', 'receivecars.carid')
                                    ->join('brands', 'brands.brandid', '=', 'cars.brandid')
                                    ->whereBetween('invoice.invoice_date', [$monday, $saturday])
                                    ->select('invoice.*','cars.license','brands.brandname','invoice_detail.total as invoice_total','receipts.*', 'receipts_detail.total as receipt_total')
                                    ->orderBy('invoice.invoice_date', 'desc')->paginate(30);
    
    return view('manage/account/summary')->with('summary', $summary);
  }

  // function search summary account
  public function fnSearchsummary(Request $req)
  {
    $this->validate($req, [
      'textsearch' => 'required'
    ]);
    $textsearch = $req->input('textsearch');
    $summary = DB::table('receipts')->join('receipts_detail', 'receipts_detail.receiptid', '=', 'receipts.receiptid')
                                    ->join('invoice', 'invoice.invoiceid','=','receipts.invoiceid')
                                    ->join('invoice_detail', 'invoice_detail.invoiceid', 'invoice.invoiceid')
                                    ->join('quotations', 'quotations.qtid', '=', 'invoice.qtid')
                                    ->join('repairbill', 'repairbill.rpbid', '=', 'quotations.rpbid')
                                    ->join('receivecars', 'receivecars.rcsid', '=', 'repairbill.rcsid')
                                    ->join('cars', 'cars.carid', '=', 'receivecars.carid')
                                    ->join('brands', 'brands.brandid', '=', 'cars.brandid')
                                    ->where('receipts.receiptid', 'like', '%'.$textsearch.'%')
                                    ->orWhere('invoice.invoiceid', 'like', '%'.$textsearch.'%')
                                    ->orWhere('invoice.invoice_date', 'like', '%'.$textsearch.'%')
                                    ->orWhere('receipts.receipt_date', 'like', '%'.$textsearch.'%')
                                    ->select('invoice.*','cars.license','brands.brandname','invoice_detail.total as invoice_total','receipts.*', 'receipts_detail.total as receipt_total')
                                    ->orderBy('invoice.invoice_date', 'desc')->paginate(30);
    
    return view('manage/account/summary')->with('summary', $summary);
  }
}
