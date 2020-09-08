<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Validator;
use Illuminate\Support\Str;

class SupController extends Controller
{
    // fnSupplier
    public function fnSupplier()
    {
      $sqlsupid = DB::table('supplier')->select('supplierid')->orderBy('supplierid', 'desc')->take(1)->get();
      foreach($sqlsupid as $sup){
        $supplierid = $sup->supplierid;
      }
      // $supplierid = "SUP001";
      if(count($sqlsupid) > 0){
        $strstring = Str::substr($supplierid, 3);
        $sum = (int)$strstring + 1;
        $supid = strlen($sum);
        if($supid == 1){
          $suppid = "00".$sum;
        }elseif($supid == 2){
          $suppid = "0".$sum;
        }else{
          $suppid = $sum;
        }
      }else{
        $suppid = "001";
      }
      $provinces = DB::table('provinces')->get();
      return view('manage/stocker/supplier')->with('supplierid', $suppid)
                                            ->with('provinces', $provinces);
    }

    public function fnSelectProvince(Request $req)
    {
      $result = "";
      $proid = $req->proid;
      $districts = DB::table('districts')->where('proid', $proid)->get();
      if(count($districts) > 0){
          $result = '<option>​ເລືອກ​ເມືອງ</option>';
        foreach($districts as $dis){
          $result .= '<option value="'.$dis->disid.'">'.$dis->disname.'</option>';
        }
      }else{
        $result = '<option value="">ຍັງ​ບໍ່​ມີ​ການ​ເພີ່ມ​ເມືອງ​ຂອງ​ແຂວງ​ນີ້</option>';
      }
      $data = array('result' => $result);
      echo json_encode($data);
    }

    // function insert supplier
    public function fnInsertSupplier(Request $req)
    {
      $this->validate($req, [
        'proid' => 'required',
        'disid' => 'required',
      ]);
      // dd($req->all());
      $supdata = array(
        'supplierid' => $req->input('supplierid'),
        'suppliername' => $req->input('suppliername'),
        'suppliertax' => $req->input('suppliertax'),
        'village' => $req->input('village'),
        'disid' => $req->input('disid'),
        'proid' => $req->input('proid'),
        'mobile' => $req->input('mobile'),
        'phone' => $req->input('phone'),
        'fax' => $req->input('fax'),
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d')
      );

      if($req->input('addaccount') == "1"){
        $bankname = $req->input('bankname');
        $account_num = $req->input('account_num');
      
        for($i = 0; $i<count($bankname); $i++){
          $accountdata = array(
            'supplierid' => $req->input('supplierid'),
            'bankname' => $bankname[$i],
            'accountnum' => $account_num[$i]
          );
          $inbankdata[] = $accountdata;
        }
        
        DB::table('supplier')->insert($supdata);
        DB::table('supaccount')->insert($inbankdata);
        $descript = "ການ​ເພີ່ມ​ຂໍ້​ມູນ​ຜູ້​ສະ​ໜອງ​ສຳ​ເລັດ";
      }else{
        DB::table('supplier')->insert($supdata);
        $descript = "ການ​ເພີ່ມ​ຂໍ້​ມູນ​ຜູ້​ສະ​ໜອງ​ສຳ​ເລັດ, ບໍ່​ມີ​ການ​ເພີ່ມ​ບັນ​ຊີ​ທະ​ນາ​ຄານ";
      }
      
      return back()->with('success', $descript);
    }

    // supplier list page
    public function fnSupplierlist()
    {
      $sqlsupplier = DB::table('supplier')
      ->join('districts', 'districts.disid', '=', 'supplier.disid')
      ->join('provinces', 'provinces.proid', '=', 'supplier.proid')
      ->select('supplier.*','districts.disname','provinces.proname')
      ->paginate(20);
      $provinces = DB::table('provinces')->get();
      return view('manage/stocker/supplierlist')->with('supplierlist', $sqlsupplier)->with('provinces', $provinces);
    }

    // function view bank
    public function fnViewbank(Request $req)
    {
      $result = "";
      $supplierid = $req->supplierid;
      $sqlviewbank = DB::table('supaccount')->where('supplierid', $supplierid)->get();
      $i = 1;
      if(count($sqlviewbank) > 0){
        foreach ($sqlviewbank as $gb) {
          $result .= '
          <tr>
            <td>'.$i++.'</td>
            <td>'.$gb->bankname.'</td>
            <td>'.$gb->accountnum.'</td>
            <td class="text-center">
              <button class="btn btn-info" type="button" id="btnEditbank" value="'.$gb->supaccountid.'"><i class="mdi mdi-pen"></i></button>
            </td>
            <td class="text-center">
              <button class="btn btn-danger" type="button" id="btnDelbank" value="'.$gb->supaccountid.'"><i class="mdi mdi-trash-can-outline"></i></button>
            </td>
          </tr>
          ';
        }
      }else{
        $result .= '
          <tr>
            <td class="text-center" colspan="5">ບໍ່​ມີ​ຂໍ້​ມູນ​ບັນ​ຊີ​ທະ​ນາ​ຄານ</td>
          </tr>
        ';
      }
      $data = array('result' => $result);
      echo json_encode($data);
    }

    // function insert new bank
    public function fnInsertbank(Request $req)
    {
      $insertbkdata = array(
        'supplierid' => $req->supplierid,
        'bankname' => $req->bankname,
        'accountnum' => $req->accountnum
      );
      DB::table('supaccount')->insert($insertbkdata);
      $data = "ການ​ເພີ່ມ​ຂໍ້​ມູນ​ສຳ​ເລັດ";
      echo json_encode($data);
    }

    // function get supaccount to edit
    public function fnGetSupaccount(Request $req)
    {
      $supaccountid = $req->supaccountid;
      $sqlsupaccount = DB::table('supaccount')->where('supaccountid', $supaccountid)->get();
      foreach($sqlsupaccount as $dtsac){
        $bankname = $dtsac->bankname;
        $accountnum = $dtsac->accountnum;
      }
      $data = array('bankname' => $bankname, 'accountnum' => $accountnum);
      echo json_encode($data);
    }

    // function update account
    public function fnUpdateSupaccount(Request $req)
    {
      $supaccountid = $req->supaccountid;
      $supdataupdate = array(
        'bankname' => $req->bankname,
        'accountnum' => $req->accountnum
      );
      DB::table('supaccount')->where('supaccountid', $supaccountid)->update($supdataupdate);
      $data = "ການ​ແກ້​ໄຂ​ຂໍ້​ມູນ​ສຳ​ເລັດ";
      echo json_encode($data);
    }

    // function delete bank data
    public function fnDeletebank(Request $req)
    {
      $supaccountid = $req->supaccountid;
      DB::table('supaccount')->where('supaccountid', $supaccountid)->delete();
      $data = "ການ​ລຶບ​ຂໍ້​ມູນ​ສຳ​ເລັດ";
      echo json_encode($data);
    }

    // function get supplier data
    public function fnGetsupplierdata(Request $req)
    {
      $supplierid = $req->supplierid;
      $sqlsupplier = DB::table('supplier')->where('supplierid', $supplierid)->get();
      foreach($sqlsupplier as $supdt){
        $suppliername = $supdt->suppliername;
        $suppliertax = $supdt->suppliertax;
        $village = $supdt->village;
        $disid = $supdt->disid;
        $proid = $supdt->proid;
        $mobile = $supdt->mobile;
        $phone = $supdt->phone;
        $fax = $supdt->fax;
      }
      $data = array('suppliername' => $suppliername,'suppliertax' => $suppliertax,'village' => $village,'village' => $village,
      'disid' => $disid,'proid' => $proid,'mobile' => $mobile,'phone' => $phone,'fax' => $fax);
      echo json_encode($data);
    }

    // function update
    public function fnUpdateSupplier(Request $req)
    {
      $this->validate($req, [
        'proid' => 'required',
        'disid' => 'required'
      ]);
      $supplierid = $req->input('supplierid');
      $updatedata = array(
        'suppliername' => $req->input('suppliername'),
        'suppliertax' => $req->input('suppliertax'),
        'village' => $req->input('village'),
        'disid' => $req->input('disid'),
        'proid' => $req->input('proid'),
        'mobile' => $req->input('mobile'),
        'phone' => $req->input('phone'),
        'fax' => $req->input('fax')
      );

      DB::table('supplier')->where('supplierid', $supplierid)->update($updatedata);
      return redirect('supplierlist')->with('success', 'ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ');
    }

    //function delete supplier
    public function fnDeleteSupplier($supplierid)
    {
      DB::table('supplier')->where('supplierid', $supplierid)->delete();
      return redirect('supplierlist')->with('success', 'ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ');
    }

    // function search
    public function fnSearchSupplier(Request $req)
    {
      $result = "";
      $txtsearch = $req->txtsearch;
      $sqlsearchsup = DB::table('supplier')
      ->join('districts', 'districts.disid', '=', 'supplier.disid')
      ->join('provinces', 'provinces.proid', '=', 'supplier.proid')
      ->where('supplier.supplierid', 'like', '%'.$txtsearch.'%')
      ->orWhere('supplier.suppliername', 'like', '%'.$txtsearch.'%')
      ->select('supplier.*','districts.disname','provinces.proname')
      ->get();
      if(count($sqlsearchsup) > 0){
        foreach($sqlsearchsup as $sup)
          $result .= '
          <tr>
            <td>'.$sup->supplierid.'</td>
            <td>'.$sup->suppliername.'</td>
            <td>'.$sup->suppliertax.'</td>
            <td>'.$sup->village.'</td>
            <td>'.$sup->disname.'</td>
            <td>'.$sup->proname.'</td>
            <td>'.$sup->mobile.'</td>
            <td>'.$sup->phone.'</td>
            <td>'.$sup->fax.'</td>
            <td>
              <div class="dropdown d-inline">
                <button class="btn btn-default btn-sm btn-icon btn-transparent" type="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="mdi mdi-dots-horizontal"></i>
                </button>
                <div class="dropdown-menu">
                  <button class="btn btn-primary" type="button" id="btnEditsup" value="'.$sup->supplierid.'"><i class="mdi mdi-pen"></i> ແກ້​ໄຂ​ຂໍ​້​ມູນ</button>
                  <button class="btn btn-info" type="button" id="btnEditBank" value="'.$sup->supplierid.'"><i class="mdi mdi-pen"></i> ເພີ່ມ,ແກ້​ໄຂ​ບັນ​ຊີ</button>
                  <button class="btn btn-danger" type="button" id="btnDeletesup" value="'.$sup->supplierid.'"><i class="mdi mdi-trash-can-outline"></i> ລືບ​ຂໍ້​ມູນ​</button>
                </div>
              </div>
            </td>
          </tr>
          ';
      }else{
        $result .= '
        <tr>
          <td colspan="10"><h5 class="text-center">ບໍ່​ມີ​ຂໍ້​ມູນ​ທີ່​ທ່ານ​ຄົ້ນ​ຫາໃນ​ລະ​ບົບ</h5></td>
        </tr>
        ';
      }
      $data = array('result' => $result);
      echo json_encode($data);
    }

    // function search autocomplete
    public function fnSearchSupauto(Request $req)
    {
      $result = "";
      $txtsearch = $req->txtsearch;
      $sqlsearchauto = DB::table('supplier')->where('supplierid', 'like', '%'.$txtsearch.'%')
                                            ->orWhere('suppliername', 'like', '%'.$txtsearch.'%')
                                            ->get();
      if(count($sqlsearchauto) > 0){
        $result = '<ul class="dropdown-menu" style="display:block; position:absolute">';
        foreach($sqlsearchauto as $sauto){
          $result .= '
            <li><a href="#">'.$sauto->suppliername.'</a></li>
          ';
        }
        $result .= '</ul>';
      }else{
        $result = '<ul class="dropdown-menu" style="display:block; position:absolute">';
        $result .= '<li><a href="#">ບໍ່​ມີ​ຂໍ້​ມູນ​ນີ້​ໃນ​ລະ​ບົບ</a></li>';
        $result .= '</ul>';
      }
      $data = array('result' => $result);
      echo json_encode($data);
    }

}
