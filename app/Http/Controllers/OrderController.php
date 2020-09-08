<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB, Validator, Auth;
class OrderController extends Controller
{
  // show order page
  public function fnOrder()
  {
    $sqlorderid = DB::table('order')->select('orderid')->orderBy('orderid', 'desc')->take(1)->get();
    foreach ($sqlorderid as $row) {
      $id = $row->orderid;
    }
    // $id = "OD00001/2020";
    if(count($sqlorderid) > 0){
      $strstring = Str::substr($id, 2, 8);
      $sum = (int)$strstring + 1;
      $orid = strlen($sum);
      if($orid == 1){
        $orderid = "0000".$sum;
      }else if($orid == 2){
        $orderid = "000".$sum;
      }else if($orid == 3){
        $orderid = "00".$sum;
      }else if($orid == 4){
        $orderid = "0".$sum;
      }else{
        $orderid = $sum;
      }
    }else{
      $orderid = "00001";
    }
    $supplier = DB::table('supplier')->get();
    return view('manage/stocker/orders')->with('orderid', $orderid)
                                        ->with('supplier', $supplier);
  }

  // function get spare to order
  public function fnAddsparetoOrder(Request $req)
  {
    $sparesid = $req->sparesid;
    $sqlspares = DB::table('spares')
    ->join('unitspare', 'unitspare.unitid', '=', 'spares.unitid')
    ->join('brandspares', 'brandspares.brandspareid', '=', 'spares.brandspareid')
    ->where('spares.sparesid', '=', $sparesid)
    ->select('spares.*','unitspare.unitname','brandspares.brandsparename')
    ->get();
    if(count($sqlspares) > 0){
      foreach ($sqlspares as $spare) {
        $sparesname = $spare->sparesname;
        $brandspareid = $spare->brandspareid;
        $brandsparename = $spare->brandsparename;
        $model = $spare->model;
        $madeyear = $spare->madeyear;
        // $sellprice = $spare->sellprice;
        $unitid = $spare->unitid;
        $unitname = $spare->unitname;
      }
    }else{
      $sparesname = "ບໍ່​ມີ​ຂໍ້​ມູນ";
      $brandspareid = "ບໍ່​ມີ​ຂໍ້​ມູນ";
      $brandsparename = "ບໍ່​ມີ​ຂໍ້​ມູນ";
      $model = "ບໍ່​ມີ​ຂໍ້​ມູນ";
      $madeyear = "ບໍ່ມີ​ຂໍ້​ມູນ";
      $madeyear = "ບໍ່​ມີຂໍ້​ມູນ";
      // $sellprice = "ບໍ່​ມີ​ຂໍ້​ມູນ";
      $unitid = "ບໍ່​ມີ​ຂໍ້​ມູນ";
      $unitname = "ບໍ່​ມີ​ຂໍ້​ມູນ";
    }
    $data = array(
      'sparesname' => $sparesname,
      'brandspareid' => $brandspareid,
      'brandsparename' => $brandsparename,
      'model' => $model,
      'madeyear' => $madeyear,
      // 'sellprice' => $sellprice,
      'unitid' => $unitid,
      'unitname' => $unitname
    );
    echo json_encode($data);
  }

  // function insert order data
  public function fnInsertOrder(Request $req)
  {
    $this->validate($req, [
      'supplierid' => 'required'
    ]);
    $count = DB::table('order')->where('orderid', $req->input('orderid'))->get();
    if(count($count) <= 0){
      if($req->input('remark') == ""){
        $remark = ".";
      }else{
        $remark = $req->input('remark');
      }
      if($req->input('order_date') == ""){
        $order_date = date('Y-m-d');
      }else{
        $order_date = $req->input('order_date');
      }
      $insertorder = array(
        'orderid' => $req->input('orderid'),
        'supplierid' => $req->input('supplierid'),
        'orderdate' => $order_date,
        'remark' => $remark,
        'userorder' => Auth::user()->name,
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d')
      );

      DB::table('order')->insert($insertorder);
      $sparesid = $req->input('sparesid');
      for ($i=0; $i < count($sparesid); $i++) { 
        $orderdetail = array(
          'orderid' => $req->input('orderid'),
          'sparesid' => $req->input('sparesid')[$i],
          'sparesname' => $req->input('sparesname')[$i],
          'brandspareid' => $req->input('brandspareid')[$i],
          'model' => $req->input('model')[$i],
          'madeyear' => $req->input('madeyear')[$i],
          'orderqty' => $req->input('orderqty')[$i],
          // 'price' => $req->input('price')[$i],
          'unitid' => $req->input('unitid')[$i],
          // 'total' => $req->input('total')[$i],
          'status' => "ກຳ​ລັງ​ສະ​ເໜີ"
        );
        $orderdetaildt[] = $orderdetail;
      }
      DB::table('orderdetail')->insert($orderdetaildt);
      $sqlorders = DB::table('order')
      ->join('supplier', 'supplier.supplierid', '=', 'order.supplierid')
      ->join('provinces', 'provinces.proid', '=', 'supplier.proid')
      ->join('districts', 'districts.disid', '=', 'supplier.disid')
      ->where('orderid', $req->input('orderid'))
      ->select('order.*', 'supplier.*', 'provinces.proname', 'districts.disname')
      ->get();

      $sqlorderdetail = DB::table('orderdetail')
      ->join('unitspare', 'unitspare.unitid', '=', 'orderdetail.unitid')
      ->join('brandspares', 'brandspares.brandspareid', '=', 'orderdetail.brandspareid')
      ->where('orderdetail.orderid', '=', $req->input('orderid'))
      ->select('orderdetail.*', 'unitspare.unitname', 'brandspares.brandsparename')
      ->get();
      $sumorderqty = DB::table('orderdetail')->where('orderid', $req->input('orderid'))->sum('orderqty');
      $countorderdetail = count($sqlorderdetail);
      $url = "orders";
      $i = 1;
      return view('manage/stocker/orderprint')->with('orders', $sqlorders)->with('orderdetail', $sqlorderdetail)->with('sumorderqty', $sumorderqty)
                                              ->with('count', $countorderdetail)->with('url', $url)->with('i', $i);
    }else{
      return back()->with('Error', 'ລະ​ຫັດ​ນີ້​ມີ​ໃນ​ລະ​ບົບ​ແລ້ວ');
    }
  }

  // show order list page
  public function fnOrderlist()
  {
    $orders = DB::table('order')
    ->join('supplier', 'supplier.supplierid', '=', 'order.supplierid')
    ->select('order.*', 'supplier.*')->orderBy('orderid', 'desc')
    ->paginate(20);
    $supplier = DB::table('supplier')->get();
    return view('manage/stocker/orderslist')->with('orders', $orders)
                                            ->with('supplier', $supplier);
  }

  // print order funtion from order list
  public function fnOrderPrint($orderid)
  {
    $sqlorders = DB::table('order')
      ->join('supplier', 'supplier.supplierid', '=', 'order.supplierid')
      ->join('provinces', 'provinces.proid', '=', 'supplier.proid')
      ->join('districts', 'districts.disid', '=', 'supplier.disid')
      ->where('orderid', $orderid)
      ->select('order.*', 'supplier.*', 'provinces.proname', 'districts.disname')
      ->get();

      $sqlorderdetail = DB::table('orderdetail')
      ->join('unitspare', 'unitspare.unitid', '=', 'orderdetail.unitid')
      ->join('brandspares', 'brandspares.brandspareid', '=', 'orderdetail.brandspareid')
      ->where('orderdetail.orderid', '=', $orderid)
      ->select('orderdetail.*', 'unitspare.unitname', 'brandspares.brandsparename')
      ->get();
      $sumorderqty = DB::table('orderdetail')->where('orderid', $orderid)->sum('orderqty');
      $countorderdetail = count($sqlorderdetail);
      $url = "orderslist";
      $i = 1;
      return view('manage/stocker/orderprint')->with('orders', $sqlorders)->with('orderdetail', $sqlorderdetail)
                                              ->with('count', $countorderdetail)->with('sumorderqty', $sumorderqty)
                                              ->with('url', $url)->with('i', $i);
  }

  // function load order list
  public function fnLoadOrderlist(Request $req)
  {
    $result = "";
    $orderid = $req->orderid;
    $sqlorderdetail = DB::table('orderdetail')
      ->join('unitspare', 'unitspare.unitid', '=', 'orderdetail.unitid')
      ->join('brandspares', 'brandspares.brandspareid', '=', 'orderdetail.brandspareid')
      ->where('orderdetail.orderid', '=', $orderid)
      ->select('orderdetail.*', 'unitspare.unitname', 'brandspares.brandsparename')
      ->get();
    if(count($sqlorderdetail) > 0){
      foreach ($sqlorderdetail as $dt) {
        $result .= '
        <tr>
          <td>'.$dt->sparesid.'</td>
          <td>'.$dt->sparesname.'</td>
          <td>'.$dt->brandsparename.'</td>
          <td>'.$dt->model.'</td>
          <td>'.$dt->madeyear.'</td>
          <td>'.$dt->orderqty.'</td>
          <td>'.$dt->unitname.'</td>
          <td>
            <button class="btn btn-danger" type="button" id="btnTrash" value="'.$dt->orderdetailid.'"><i class="mdi mdi-trash-can-outline"></i></button>
          </td>
        </tr>
        ';
      }
    }else{
      $result .= '
        <tr>
          <td colspan="10"><h5 class="text-center">ບໍ່​ມີ​ຂໍ້​ມູນ​ລາຍ​ການ​ສັ່ງ​ຊື້</h5></td>
        </tr>
      ';
    }
    $data = array('result' => $result, 'count' => count($sqlorderdetail));
    echo json_encode($data);
  }

  // function add new order list
  public function fnAddOrderlist(Request $req)
  {
    $orderid = $req->orderid;
    $sparesid = $req->sparesid;
    $sqlorderdetail = DB::table('orderdetail')->where('orderid', $orderid)->where('sparesid', $sparesid)->get();
    if(count($sqlorderdetail) > 0){
      foreach($sqlorderdetail as $dt){
        $orderqty = $dt->orderqty;
      }
      $qty = (int)$orderqty + (int)$req->orderqty;
      $dataupdate = array('orderqty' => $qty);
      DB::table('orderdetail')->where('orderid', $orderid)->where('sparesid', $sparesid)->update($dataupdate);
    }else{
      $insertdetail = array(
        'orderid' => $orderid,
        'sparesid' => $sparesid,
        'sparesname' => $req->sparesname,
        'brandspareid' => $req->brandspareid,
        'model' => $req->model,
        'madeyear' => $req->madeyear,
        'orderqty' => $req->orderqty,
        // 'price' => $req->price,
        'unitid' => $req->unitid,
        // 'total' => $req->total,
        'status' => "ກຳ​ລັງ​ສະ​ເໜີ"
      );
      DB::table('orderdetail')->insert($insertdetail);
    }
    $data = "ກາ​ນ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ";
    echo json_encode($data);
  }

  // function delete detail list
  public function fnDeleteOrderlist(Request $req)
  {
    $orderdetailid = $req->orderdetailid;
    DB::table('orderdetail')->where('orderdetailid', $orderdetailid)->delete();
    $data = "ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ";
    echo json_encode($data);
  }

  //function get order data to update
  public function fnGetorderdata(Request $req)
  {
    $orderid = $req->orderid;
    $sqlorder = DB::table('order')->where('orderid', $orderid)->get();
    foreach($sqlorder as $od){
      $supplierid = $od->supplierid;
      $orderdate = $od->orderdate;
      $remark = $od->remark;
    }
    $data = array(
      'supplierid' => $supplierid,
      'orderdate' => $orderdate,
      'remark' => $remark
    );
    echo json_encode($data);
  }

  // function update order data
  public function fnUpdateOrder(Request $req)
  {
    $this->validate($req, [
      'supplierid' => 'required'
    ]);
    if($req->input('remark') == ""){
      $remark = ".";
    }else{
      $remark = $req->input('remark');
    }
    $orderid = $req->input('orderid1');
    $orderupdate = array(
      'supplierid' => $req->input('supplierid'),
      'orderdate' => $req->input('orderdate'),
      'remark' => $remark
    );
    DB::table('order')->where('orderid', $orderid)->update($orderupdate);
    return redirect('orderslist')->with('success', 'Update success');
  }

  // function search order data
  public function fnSearchOrderData(Request $req)
  {
    $result = "";
    $searchorder = $req->searchorder;
    $sqlsearchorder = DB::table('order')
    ->join('supplier', 'supplier.supplierid', '=', 'order.supplierid')
    ->select('order.*', 'supplier.*')->get();
    if(count($sqlsearchorder) > 0){
      foreach($sqlsearchorder as $search){
        $result .= '
        <tr>
          <td>'.$search->orderid.'</td>
          <td>'.$search->suppliername.'</td>
          <td>'.$search->orderdate.'</td>
          <td>'.$search->remark.'</td>
          <td>'.$search->userorder.'</td>
          <td>
            <a class="btn btn-primary" href="/orderprint/'.$search->orderid.'"><i class="mdi mdi-printer"></i></a>
          </td>
          <td>
            <div class="btn-group dropleft">
              <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-dots-horizontal"></i>
              </button>
              <div class="dropdown-menu">
                <button class="dropdown-item" id="btnOrderDetail" value="'.$search->orderid.'"><i class="mdi mdi-format-list-numbered"></i> ລາຍ​ການ​ສັ່ງ​ຊື້</button>
                <button class="dropdown-item" id="btnEditOrder" value="'.$search->orderid.'"><i class="mdi mdi-square-edit-outline"></i> ແກ້​ໄຂ​ຂໍ້​ມູນ​ສັ່ງ​ຊື້</button>
                <button class="dropdown-item" id="btnDelete" value="'.$search->orderid.'"><i class="mdi mdi-trash-can-outline"></i> ລຶບ​ຂໍ້​ມູນ​ການ​ສັ່ງ​ຊື້</button>
              </div>
            </div>
          </td>
        </tr>
        ';
      }
    }else{
      $result .= '
        <tr>
          <td colspan="7"><h5 class="text-center">ບໍ່​ມີ​ຂໍ້​ມູນ​ຂອງ​ລະ​ຫັດ​ບິນ'.$searchorder.' ນີ້</h5></td>
        </tr>
      ';
    }
    $data = array('result' => $result);
    echo json_encode($data);
  }

  // function delete order data
  public function fnDeleteOrderdata($orderid)
  {
    DB::table('order')->where('orderid', $orderid)->delete();
    return redirect('orderslist')->with('success', 'ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ');
  }
}
