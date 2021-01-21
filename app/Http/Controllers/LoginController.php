<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Validator, DB;

class LoginController extends Controller
{
  //
  public function index(){
    return view('login');
  }

  public function adminpage(){
    $today = date('Y-m-d');
    $monday = date('Y-m-d', strtotime('Monday this week'));
    $saturday = date('Y-m-d', strtotime('Saturday this week'));
    $waitrepairtoday = count(DB::table('techcarstatus')->where('status', 1)->where('date_in', $today)->get());
    $waitrepairweek = count(DB::table('techcarstatus')->where('status', 1)->whereBetween('date_in', [$monday, $saturday])->get());
    $repairingtoday = count(DB::table('techcarstatus')->where('status', 3)->where('date_in', $today)->get());
    $repairingweek = count(DB::table('techcarstatus')->where('status', 3)->whereBetween('date_in', [$monday, $saturday])->get());
    $successtoday = count(DB::table('techcarstatus')->where('status', 4)->where('date_in', $today)->get());
    $successweek = count(DB::table('techcarstatus')->where('status', 4)->whereBetween('date_in', [$monday, $saturday])->get());
    // sum total invoice on today
    $invoicetoday = DB::table('invoice_detail')->join('invoice', 'invoice.invoiceid', '=', 'invoice_detail.invoiceid')
    ->where('invoice.invoice_date', '=', date('Y-m-d'))->sum('invoice_detail.total');
    // sum total invoice on this month
    $invoicemonth = DB::table('invoice_detail')->join('invoice', 'invoice.invoiceid', '=', 'invoice_detail.invoiceid')
    ->where('invoice.invoice_date', '=', '%'.date('Y-m').'%')->sum('invoice_detail.total');
    return view('manage/index')->with('waitrepairtoday', $waitrepairtoday)->with('waitrepairweek', $waitrepairweek)
    ->with('repairingtoday', $repairingtoday)->with('repairingweek', $repairingweek)->with('successtoday', $successtoday)
    ->with('successweek', $successweek)->with('invoicetoday', $invoicetoday)->with('invoicemonth', $invoicemonth);
  }

  public function checklogin(Request $req){
    $this->validate($req, [
      'email' => 'required|email',
      'pass' => 'required|alphaNum|min:8',
    ]);

    $data = array(
      'email' => $req->input('email'),
      'password' => $req->input('pass')
    );

    if(Auth::attempt($data)){
      $userdata = array('username'=>Auth::user()->name, 'login_date'=>date('Y-m-d'), 'login_time' => date('H:i:s'));
      // auth()->user()->syncPermissions(['AddData','EditData','DeleteData','ReadData','ManageUser']);
      if(auth()->user()->hasRole("Admin")){
        DB::table('userlog')->insert($userdata);
        return redirect('admin');
      }else if(auth()->user()->hasRole("Manager")){
        DB::table('userlog')->insert($userdata);
        return redirect('admin');
      }else if(auth()->user()->hasRole("CRM")){
        DB::table('userlog')->insert($userdata);
        return redirect('appointment');
      }else if(auth()->user()->hasRole("StockManager")){
        DB::table('userlog')->insert($userdata);
        return redirect('stockdashboard');
      }else if(auth()->user()->hasRole("Technician")){
        DB::table('userlog')->insert($userdata);
        return redirect('technic_dashboard');
      }else if(auth()->user()->hasRole("Accountant")){
        DB::table('userlog')->insert($userdata);
        return redirect('account_dashboard');
      }else{
        DB::table('userlog')->insert($userdata);
        return redirect('login');
      }
    }else{
      return back()->with('error', 'ບໍ່​ມີ​ບັນ​ຊີ​ນີ້​ໃນ​ລະ​ບົບ');
    }
  }

  public function fnLogout(){
    Auth::logout();
    return redirect('login');
  }
}
