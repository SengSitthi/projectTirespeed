<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB,Validator;

class RolepmsController extends Controller
{
    // function get role permission page
    public function index(){
        $users = DB::table('notrolepms')->get();
        return view('manage/rolespms')->with('users', $users);
    }

    // function get role to show
    public function fnloadRoles(Request $req){
        $result = '';
        if(auth()->user()->hasRole('Admin')){
            $roles = DB::table('roles')->get();
        }else{
            $roles = DB::table('mroleview')->get();
        }
        if(count($roles) > 0){
            foreach ($roles as $row) {
                $result .= '
                <div class="col-6">
                    <div class="custom-control custom-radio">
                        <input type="radio" name="status" class="w3-radio" value="'.$row->id.'">
                        <label class="w3-xlarge" for="admin">'.$row->name.'</label>
                    </div>
                </div>
                ';
            }
        }else{
            $result .= '
                <div class="col-6">
                    <h5>ຍັງ​ບໍ່​ມີ​ການ​ເພີ່​ມ​ສະ​ຖາ​ນະ​ເຂົ້າ​ລະ​ບົບ</h5>
                </div>
            ';
        }
        $data = array('showrole' => $result);
        echo json_encode($data);
    }

    // function get permission to show
    public function fnloadPermission(Request $req){
        $result = '';
        if(auth()->user()->hasRole('Admin')){
            $permission = DB::table('permissions')->get();
        }else{
            $permission = DB::table('mpmsview')->get();
        }
        if(count($permission) > 0){
            foreach ($permission as $row) {
                $result .= '
                <div class="col-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="w3-check" name="privillage[]" value="'.$row->id.'">
                        <label class="w3-xlarge">'.$row->name.'</label>
                    </div>
                </div>
                ';
            }
        }else{
            $result .= '
                <div class="col-6">
                    <h5>ຍັງ​ບໍ່​ມີ​ການ​ເພີ່​ມສິດ​ທິ​ນຳ​ໃຊ້​ເຂົ້າ​ລະ​ບົບ</h5>
                </div>
            ';
        }
        $data = array('showpms' => $result);
        echo json_encode($data);
    }

    // function insert role and permission
    public function fninsertrolepms(Request $req){
        $this->validate($req, [
            'uid' => 'required',
            'status' => 'required',
            'privillage' => 'required'
        ]);
        $uid = (int)$req->input('uid');
        $status = $req->input('status');
        $privillage = $req->input('privillage');
        $model_type = "App\User";
        for ($i=0; $i < count($privillage); $i++){
            $data = array(
                'permission_id' => $privillage[$i],
                'model_type' => $model_type,
                'model_id' => (int)$uid
            );
            $pvl[] = $data;
        }
        $rolesdata = array(
            'role_id' => $status,
            'model_type' => $model_type,
            'model_id' => $uid
        );
        DB::table('model_has_permissions')->insert($pvl);
        DB::table('model_has_roles')->insert($rolesdata);
        return redirect('rolespms')->with('success', 'Insert success');
    }

    // function to load role and permission name by user id
    public function fnloadUserrolepms($uid){
        $roles = '';
        $rid = '';
        $pms = '';
        $pmsid = '';
        $sqlrole = DB::table('urolename')->where('id', $uid)->get();
        $sqlpms = DB::table('upmsname')->where('id', $uid)->get();
        $countpms = count($sqlpms);
        if(count($sqlrole) > 0 && $countpms > 0){
            foreach ($sqlrole as $role) {
                $rid .= $role->role_id;
                $roles .= $role->name;
            }
            foreach($sqlpms as $p){
                $pmsid .= $p->permission_id;
                $pms .= $p->name.', ';
            }
        }else{
            $roles = "ຍັງ​ບໍ່​ມີ​ການ​ເພີ່ມ​ສະ​ຖາ​ນະ​ໃຫ້​ຜູ້​ໃຊ້​ນີ້​ເທື​່ອ!";
            $pms = "ຍັງ​ບໍ່​ມີ​ການ​ເພີ່ມ​ສ​ິດ​ທິ​ໃຫ້​ຜູ້​ໃຊ້​ນີ້​ເທື່ອ!";
        }
        $data = array('rid' => $rid,'roles' => $roles,'pmsid'=>$pmsid,'pms' => $pms,'countpms'=>$countpms);
        echo json_encode($data);
    }

    // function update user's role and permission
    public function fnupdateRolePms(Request $req){
        $this->validate($req, [
            'uroleid' => 'required'
        ]);
        $uid = (int)$req->input('uroleid');
        DB::table('model_has_roles')->where('model_id', $uid)->delete();
        DB::table('model_has_permissions')->where('model_id', $uid)->delete();
        $status = $req->input('status');
        $privillage = $req->input('privillage');
        $model_type = "App\User";
        $rolesdata = array(
            'role_id' => $status,
            'model_type' => $model_type,
            'model_id' => $uid
        );
        for ($i=0; $i < count($privillage); $i++){
            $data = array(
                'permission_id' => $privillage[$i],
                'model_type' => $model_type,
                'model_id' => (int)$uid
            );
            $pvl[] = $data;
        }
        DB::table('model_has_permissions')->insert($pvl);
        DB::table('model_has_roles')->insert($rolesdata);
        return redirect('/userlist')->with('success', 'Update success');
    }

    // function delete role and permission
    public function fndeleteRolePms($uid){
        $delrole = DB::table('model_has_roles')->where('model_id', $uid)->delete();
        $delpms = DB::table('model_has_permissions')->where('model_id', $uid)->delete();
        return response()->json($delrole);
    }
}
