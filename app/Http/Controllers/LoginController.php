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
        return view('manage/index');
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
            }else if(auth()->user()->hasRole("StockManager")){
              DB::table('userlog')->insert($userdata);
              return redirect('stockdashboard');
            }else{
                DB::table('userlog')->insert($userdata);
                return redirect('appointment');
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
