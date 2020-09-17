<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Validator, Auth;
use Illuminate\Support\Str;

class CrvController extends Controller
{
  // show crv new page
  public function index()
  {
    $sqlrc = DB::table('receivecars')->select('rcid')->orderBy('rcid', 'desc')->take(1)->get();  
    // $rcid = "CRV0000000";
    if(count($sqlrc) > 0){
      foreach($sqlrc as $rc){
        $rcid = $rc->rcid;
      }
      $string = Str::substr($rcid, 3, 10);
      $sum = (int)$string + 1;
      if(strlen($sum) == 1){
        $num = "000000".$sum;
      }elseif(strlen($sum) == 2){
        $num = "00000".$sum;
      }elseif(strlen($sum) == 3){
        $num = "0000".$sum;
      }elseif(strlen($sum) == 4){
        $num = "000".$sum;
      }elseif(strlen($sum) == 5){
        $num = "00".$sum;
      }elseif(strlen($sum) == 6){
        $num = "0".$sum;
      }else{
        $num = $sum;
      }
    }else{
      $num = "0000001";
    }
    $id = "CRV".$num."-".date('m.Y');
    $customers = DB::table('customers')->get();
    return view('manage/crm/crvnew')->with('rcid', $id)
                                    ->with('customers', $customers);
  }
}
