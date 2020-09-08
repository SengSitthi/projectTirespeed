<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB, Hash, Str;

class UserController extends Controller
{
    // form insert user
    public function index(){
        // if(auth()->user()->hasPermissionTo('Manage User')){
        //   $employees = DB::table('empnotuser')->get();
        // }else{
        //   $employees = DB::table('empnotuser')->get();
        // }
        $employees = DB::table('empnotuser')->get();
        return view('manage/useradd')->with('employees', $employees);
    }

    // function get employee data for add new user
    public function fnloadEmpData($empid){
        $employee = DB::table('employees')->where('empid', $empid)->get();
        if(count($employee) > 0){
            foreach ($employee as $row) {
                $name = $row->name;
                $email = $row->email;
            }
        }else{
            $name = 'ບໍ່​ມີ​ຂໍ້​​ມູນ​ພະ​ນັກ​ງານນີ້ໃນ​ລະ​ບົບ​ເທື່ອ';
        }
        $data = array(
            'name' => $name,
            'email' => $email
        );
        echo json_encode($data);
    }

    // function insert new user
    public function fninsertUser(Request $req){
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->pass);
        $user->remember_token = Str::random(60);
        $user->empid = $req->empid;
        $user->save();
        return response()->json($user);
    }

    // function show user list in useradd page
    public function fnUserlist(Request $req){
        if(auth()->user()->hasRole('Admin')){
            $employees = DB::table('employees')->get();
            $roles = DB::table('roles')->get();
            $permission = DB::table('permissions')->get();
        }else if(auth()->user()->hasRole('Manager')){
            // $employees = DB::table('employees')->whereNotIn('empid', 'EMP001')->get();
            $employees = DB::table('mempview')->get();
            $roles = DB::table('mroleview')->get();
            $permission = DB::table('mpmsview')->get();
        }
        return view('manage/userlist')->with('employees', $employees)
                                      ->with('roles', $roles)
                                      ->with('permission', $permission);
    }

    // function load user to show user list on table
    public function fnloadUserlist(Request $req){
        $result = '';
        if(auth()->user()->hasRole('Admin')){
            $sql = DB::table('users')->get();
        }else{
            $sql = DB::table('otherviewuser')->get();
        }

        if(count($sql) > 0){
            foreach ($sql as $row) {
                $result .= '
                <tr>
                    <td class="text-center">'.$row->id.'</td>
                    <td>'.$row->name.'</td>
                    <td>'.$row->email.'</td>
                    <td>'.$row->empid.'</td>
                    <td class="text-center">
                        <div class="btn-group dropleft">
                            <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                            </button>
                            <div class="dropdown-menu">
                                <button class="dropdown-item" id="btnChange" value="'.$row->id.'"><i class="mdi mdi-textbox-password"></i> ປ່ຽນ​ລະ​ຫັດ​ຜ່ານ</button>
                                <button class="dropdown-item" id="btnEdit" value="'.$row->id.'"><i class="mdi mdi-account-edit-outline"></i> ແກ້​ໄຂຂໍ້​ມູນ</button>
                                <button class="dropdown-item" id="btnEditRole" value="'.$row->id.'"><i class="mdi mdi-shield-account"></i> ແກ້​ໄຂສິດ​ທິ​ນຳ​ໃຊ້</button>
                                <button class="dropdown-item" id="btnDelpms" value="'.$row->id.'"><i class="mdi mdi-trash-can"></i> ລົບສິດ​ທິ​ຜູ້​ໃຊ້</button>
                                <button class="dropdown-item" id="btnDeluser" value="'.$row->id.'"><i class="mdi mdi-trash-can"></i> ລົບຜ​ູ້​ໃຊ້</button>
                            </div>
                        </div>
                    </td>
                </tr>
                ';
            }
        }else{
            $result .= '
                <tr>
                    <td colspan="5">ບໍ່​ມີ​ຂໍ້​ມູ​ນ​ໃຊ້​ໃນ​ລະ​ບົບ​ເທື່ອ​</td>
                </tr>
            ';
        }
        $data = array('user_data' => $result);
        echo json_encode($data);
    }

    // function update password of user
    public function fnUpdatepass(Request $req, $uid){
        $user = User::find($uid);
        $user->password = Hash::make($req->passch);
        $user->save();
        return response()->json($user);
    }

    // function get user data
    public function fngetUserdata($uid){
        $user = DB::table('users')->where('id', $uid)->get();
        if(count($user) > 0){
            foreach ($user as $row) {
                $name = $row->name;
                $email = $row->email;
                $empid = $row->empid;
            }
        }else{
            $name = "ບໍ່​ມີ​ຂ​ໍ້​ມູນ​ໃນ​ລະ​ບົບ";
            $email = "ບໍ່​ມີ​ຂ​ໍ້​ມູນ​ໃນ​ລະ​ບົບ";
        }
        $data = array(
            'name' => $name,
            'email' => $email,
            'empid' => $empid
        );
        echo json_encode($data);
    }

    // function update user data
    public function fnupUserdata(Request $req, $uid){
        $user = User::find($uid);
        $user->name = $req->name;
        $user->email = $req->email;
        $user->empid = $req->empid;
        $user->save();
        return response()->json($user);
    }

    // function delete user data
    public function fnDelUser($uid){
        $user = User::destroy($uid);
        return response()->json($user);
    }
}
