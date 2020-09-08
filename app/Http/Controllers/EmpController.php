<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, DB, Validator, Response;
use Illuminate\Support\Str;
use App\Employee;

class EmpController extends Controller
{
    // add employee
    public function index(){
        $provinces = DB::table('provinces')->get();
        $selectid = DB::table('employees')->select('empid')->orderBy('empid', 'desc')->take(1)->get();
        foreach($selectid as $id){
            $getid = $id->empid;
        }
        if(count($selectid) > 0){
            $substr = Str::substr($getid, 3);
            $sum = (int)$substr + 1;
            $emp = strlen($sum);
            if($emp == 1){
                $empid = "00".$sum;
            }elseif($emp == 2){
                $empid = "0".$sum;
            }else{
                $empid = $sum;
            }
        }else{
            $empid = '001';
        }
    
        return view('manage/employeeadd')->with('provinces', $provinces)
                                         ->with('empid', $empid);
    }

    // function add employee
    public function fnaddemployee(Request $req){
        $this->validate($req, [
            'proid' => 'required'
        ]);

        $data = array(
            'empid' => $req->input('empid'),
            'name' => $req->input('name'),
            'lastname' => $req->input('lastname'),
            'birthday' => $req->input('birthday'),
            'village' => $req->input('village'),
            'disid' => $req->input('disid'),
            'proid' => $req->input('proid'),
            'mobile' => $req->input('mobile'),
            'email' => $req->input('email'),
        );
        $district = DB::table('districts')->where('disid', $req->input('disid'))->get();
        foreach ($district as $dis) {
            $districts = $dis->disname;
        }
        $province = DB::table('provinces')->where('proid', $req->input('proid'))->get();
        foreach ($province as $pro) {
            $provinces = $pro->proname;
        }

        $username = auth()->user()->name;
        $date = date('Y-m-d');
        $time = date('H:m:s');
        $status = "ເພີ່ມຂໍ້​ມູນ";
        $detail = $req->input('empid').", ".$req->input('name').", ".$req->input('lastname').", ".$req->input('birthday').", ".$req->input('village').", ".$districts.", ".$provinces.", ".$req->input('mobile').", ".$req->input('email');
        $workingdata = array(
            'username' => $username,
            'dateworking' => $date,
            'timeworking' => $time,
            'status' => $status,
            'detail' => $detail,
        );
        // if(auth()->user()->hasPermissionTo('Manage User')){
        //     DB::table('storeworking')->insert($workingdata);
        //     DB::table('employees')->insert($data);
        //     return redirect('employee')->with('success', 'Insert success!');
        // }elseif(auth()->user()->hasRole("Manager")){
        //     DB::table('storeworking')->insert($workingdata);
        //     DB::table('employees')->insert($data);
        //     return redirect('employee')->with('success', 'Insert success!');
        // }else{
        //     return back()->with('error', 'ທ່ານ​ບໍ່​ມີ​ສິດ​ເພີ່ມ​ຂໍ້​ມູນ​ໃນ​ລະ​ບົບ');
        // }
        DB::table('storeworking')->insert($workingdata);
        DB::table('employees')->insert($data);
        return redirect('employee')->with('success', 'Insert success!');
    }

    // function employeelist page
    public function fnShowempList(){
        $provinces = DB::table('provinces')->get();
        return view('manage/employeelist')->with('provinces', $provinces);
    }

    // function load employee
    public function fnloadEmployee(Request $req){
        $result = '';
        if(auth()->user()->hasRole('Admin')){
            $data = DB::table('adminempview')->get();
        }else{
            $data = DB::table('mempview')->get();
        }
        $count = count($data);
        if($count > 0){
            foreach ($data as $dt) {
                $result .= '
                <tr>
                    <td>'.$dt->empid.'<input type="hidden" name="empid" id="empid" value="'.$dt->empid.'" /></td>
                    <td>'.$dt->name.'</td>
                    <td>'.$dt->lastname.'</td>
                    <td>'.$dt->birthday.'</td>
                    <td>'.$dt->village.'</td>
                    <td>'.$dt->disname.'</td>
                    <td>'.$dt->proname.'</td>
                    <td>'.$dt->mobile.'</td>
                    <td>'.$dt->email.'</td>
                    <td class="text-center">
                        <div class="btn-group dropleft">
                            <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                            </button>
                            <div class="dropdown-menu">
                                <button class="dropdown-item" id="btnEdit" value="'.$dt->empid.'"><i class="mdi mdi-account-edit-outline"></i> ແກ້​ໄຂ</button>
                                <button class="dropdown-item" id="btnDel" value="'.$dt->empid.'"><i class="mdi mdi-trash-can"></i> ລົບ</button>
                            </div>
                        </div>
                    </td>
                </tr>
                ';
            }
        }else{
            $result .= '
                <tr>
                    <td colspan="10"><b>ບໍ່​ມີ​ຂໍ້​ມູ​ນ​ພະ​ນັກ​ງານ​ໃນ​ລະ​ບົບ​</b></td>
                </tr>';
        }
        $data = array(
            'showemp' => $result,
            'numrow' => $count
        );
        echo json_encode($data);
    }

    // function data to show edit employee form
    public function fnloadEmpedit($id){
        $data = DB::table('employees')->where('empid', '=', $id)->get();
        foreach ($data as $dt) {
            $empid = $dt->empid;
            $name = $dt->name;
            $lastname = $dt->lastname;
            $birthday = $dt->birthday;
            $village = $dt->village;
            $disid = $dt->disid;
            $proid = $dt->proid;
            $mobile = $dt->mobile;
            $email = $dt->email;
        }
        $data = array(
            'empid' => $empid,
            'name' => $name,
            'lastname' => $lastname,
            'birthday' => $birthday,
            'village' => $village,
            'disid' => $disid,
            'proid' => $proid,
            'mobile' => $mobile,
            'email' => $email
        );
        echo json_encode($data);
    }

    /// function update employee
    public function fnloadUpdateEmp(Request $req, $empid){
        $employee = Employee::find($empid);
        $employee->name = $req->name;
        $employee->lastname = $req->lastname;
        $employee->birthday = $req->birthday;
        $employee->village = $req->village;
        $employee->disid = $req->disid;
        $employee->proid = $req->proid;
        $employee->mobile = $req->mobile;
        $employee->email = $req->email;
        $employee->save();
        return response()->json($employee);
    }
    

    // function delete employee
    public function fndeleteEmp($empid){
        
        $username = auth()->user()->name;
        $date = date('Y-m-d');
        $time = date('H:m:s');
        $status = "ລຶບ​ຂໍ້​ມູນ";
        $sqldetail = DB::table('employees')->where('empid', $empid)->get();
        foreach ($sqldetail as $row) {
            $empid = $row->empid;
            $name = $row->name;
            $lastname = $row->lastname;
            $birthday = $row->birthday;
            $village = $row->village;
            $disid = $row->disid;
            $proid = $row->proid;
            $mobile = $row->mobile;
            $email = $row->email;
        }
        
        $district = DB::table('districts')->where('disid', $disid)->get();
        foreach ($district as $dis) {
            $districts = $dis->disname;
        }
        $province = DB::table('provinces')->where('proid', $proid)->get();
        foreach ($province as $pro) {
            $provinces = $pro->proname;
        }
        $detail = $empid.", ".$name.", ".$lastname.", ".$birthday.", ".$village.", ".$districts.", ".$provinces.", ".$mobile.", ".$email;
        $workingdata = array(
            'username' => $username,
            'dateworking' => $date,
            'timeworking' => $time,
            'status' => $status,
            'detail' => $detail,
        );
        $insertnoti = DB::table('storeworking')->insert($workingdata);
        $employee = Employee::destroy($empid);
        return response()->json($employee);
    }

    /// fucntion get data to show in modal myself
    public function fnloadMyself(Request $req){
        $result = '';
        $id = Auth::user()->id;
        $myself = DB::table('showmyself')->where('id', $id)->get();
        if(count($myself) > 0){
            foreach ($myself as $row) {
                $result .='
                <div class="row">
                    <div class="col-6">
                        <h5>ລະ​ຫັດ​ພະ​ນັກ​ງານ: <b>'.$row->empid.'</b></h5>
                    </div>
                    <div class="col-6">
                        <h5>ຊື່ ແລະ​ ນາມ​ສະ​ກຸນ: <b>'.$row->name.' '.$row->lastname.'</b></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h5>ວັນ​ເດືອນ​ປີ​ເກີດ: <b>'.$row->birthday.'</b></h5>
                    </div>
                    <div class="col-6">
                        <h5>ບ້ານ​ຢູ່​ປະ​ຈຸ​ບັນ: <b>'.$row->village.'</b></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h5>ເມືອງ: <b>'.$row->disname.'</b></h5>
                    </div>
                    <div class="col-6">
                        <h5>ແຂວງ: <b>'.$row->proname.'</b></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h5>ເບີ​ໂທ​ຕິດ​ຕໍ່: <b>'.$row->mobile.'</b></h5>
                    </div>
                    <div class="col-6">
                        <h5>ອີ​ເມ​ລ໌: <b>'.$row->email.'</b></h5>
                    </div>
                </div>
                ';
            }
        }else{
            $result .= 'ບໍ່​ມີ​ຂໍ​້​ມູນ​ໃນ​ລະ​ບົບ!, ກະ​ລຸ​ນາກວ​ດ​ສອບ​ຄືນ';
        }
        $data = array('myself' => $result);
        return response()->json($data);
    }
}
