<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Validator, Auth;
use Illuminate\Support\Str;

class AccountController extends Controller
{
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
