<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Validator;

class StockerController extends Controller
{
    //
  public function index()
  {
    $ordersparetoday = DB::table('orderdetail')->join('order', 'order.orderid', '=', 'orderdetail.orderid')
                                               ->where('order.orderdate', '=', date('Y-m-d'))
                                               ->select('order.*','orderdetail.*')->get();
    $ordersparemonth = DB::table('orderdetail')->join('order', 'order.orderid', '=', 'orderdetail.orderid')
                                                ->where('order.orderdate', 'like', '%'.date('Y-m-d').'%')
                                                ->select('order.*','orderdetail.*')->get();

    $receivesparetoday = DB::table('receivedetail')->join('receive', 'receive.receiveid', '=', 'receivedetail.receiveid')
                                                   ->where('receive.receivedate', '=', date('Y-m-d'))
                                                   ->select('receive.*', 'receivedetail.*')->get();
    $receivesparetodaym = DB::table('receivedetail')->join('receive', 'receive.receiveid', '=', 'receivedetail.receiveid')
                                                   ->where('receive.receivedate', 'like', '%'.date('Y-m').'%')
                                                   ->select('receive.*', 'receivedetail.*')->get();

    $withdrawdetailtoday = DB::table('withdrawdetail')->join('withdraw', 'withdraw.withdrawid', '=', 'withdrawdetail.withdrawid')
                                                      ->where('withdraw.withdrawdate', '=', date('Y-m-d'))
                                                      ->select('withdraw.*', 'withdrawdetail.*')->get();
    $withdrawdetailmonth = DB::table('withdrawdetail')->join('withdraw', 'withdraw.withdrawid', '=', 'withdrawdetail.withdrawid')
                                                      ->where('withdraw.withdrawdate', 'like', '%'.date('Y-m-d').'%')
                                                      ->select('withdraw.*', 'withdrawdetail.*')->get();

    $sparemin = DB::select('SELECT * FROM spares s INNER JOIN receivedetail rd ON rd.sparesid=s.sparesid INNER JOIN withdrawdetail wd ON wd.sparesid=s.sparesid 
    WHERE rd.sparesid=wd.sparesid AND (rd.receiveqty - wd.withdrawqty) < 3');

    return view('manage/stocker/index')->with('ordersparetoday', $ordersparetoday)->with('ordersparemonth', $ordersparemonth)
                                       ->with('receivesparetoday', $receivesparetoday)->with('receivesparetodaym', $receivesparetodaym)
                                       ->with('withdrawdetailtoday', $withdrawdetailtoday)->with('withdrawdetailmonth', $withdrawdetailmonth)
                                       ->with('sparemin', $sparemin);
  }

  ////////////////////////// Load Stock to show on Chart ////////////////////////////
  public function fnLoadstockchart()
  {
    $jan_receive = DB::table('receivedetail')->join('receive', 'receive.receiveid', '=', 'receivedetail.receiveid')->whereBetween('receivedate', [date('Y-m-d', strtotime('First day of January')), date('Y-m-d', strtotime('Last day of January'))])->sum('receivedetail.receiveqty');
    $feb_receive = DB::table('receivedetail')->join('receive', 'receive.receiveid', '=', 'receivedetail.receiveid')->whereBetween('receivedate', [date('Y-m-d', strtotime('First day of February')), date('Y-m-d', strtotime('Last day of February'))])->sum('receivedetail.receiveqty');
    $mar_receive = DB::table('receivedetail')->join('receive', 'receive.receiveid', '=', 'receivedetail.receiveid')->whereBetween('receivedate', [date('Y-m-d', strtotime('First day of March')), date('Y-m-d', strtotime('Last day of March'))])->sum('receivedetail.receiveqty');
    $apr_receive = DB::table('receivedetail')->join('receive', 'receive.receiveid', '=', 'receivedetail.receiveid')->whereBetween('receivedate', [date('Y-m-d', strtotime('First day of April')), date('Y-m-d', strtotime('Last day of April'))])->sum('receivedetail.receiveqty');
    $may_receive = DB::table('receivedetail')->join('receive', 'receive.receiveid', '=', 'receivedetail.receiveid')->whereBetween('receivedate', [date('Y-m-d', strtotime('First day of May')), date('Y-m-d', strtotime('Last day of May'))])->sum('receivedetail.receiveqty');
    $jun_receive = DB::table('receivedetail')->join('receive', 'receive.receiveid', '=', 'receivedetail.receiveid')->whereBetween('receivedate', [date('Y-m-d', strtotime('First day of June')), date('Y-m-d', strtotime('Last day of June'))])->sum('receivedetail.receiveqty');
    $jul_receive = DB::table('receivedetail')->join('receive', 'receive.receiveid', '=', 'receivedetail.receiveid')->whereBetween('receivedate', [date('Y-m-d', strtotime('First day of July')), date('Y-m-d', strtotime('Last day of July'))])->sum('receivedetail.receiveqty');
    $aug_receive = DB::table('receivedetail')->join('receive', 'receive.receiveid', '=', 'receivedetail.receiveid')->whereBetween('receivedate', [date('Y-m-d', strtotime('First day of August')), date('Y-m-d', strtotime('Last day of August'))])->sum('receivedetail.receiveqty');
    $sep_receive = DB::table('receivedetail')->join('receive', 'receive.receiveid', '=', 'receivedetail.receiveid')->whereBetween('receivedate', [date('Y-m-d', strtotime('First day of September')), date('Y-m-d', strtotime('Last day of September'))])->sum('receivedetail.receiveqty');
    $oct_receive = DB::table('receivedetail')->join('receive', 'receive.receiveid', '=', 'receivedetail.receiveid')->whereBetween('receivedate', [date('Y-m-d', strtotime('First day of October')), date('Y-m-d', strtotime('Last day of October'))])->sum('receivedetail.receiveqty');
    $nov_receive = DB::table('receivedetail')->join('receive', 'receive.receiveid', '=', 'receivedetail.receiveid')->whereBetween('receivedate', [date('Y-m-d', strtotime('First day of November')), date('Y-m-d', strtotime('Last day of November'))])->sum('receivedetail.receiveqty');
    $dec_receive = DB::table('receivedetail')->join('receive', 'receive.receiveid', '=', 'receivedetail.receiveid')->whereBetween('receivedate', [date('Y-m-d', strtotime('First day of December')), date('Y-m-d', strtotime('Last day of December'))])->sum('receivedetail.receiveqty');
    $receive = array((int)$jan_receive,(int)$feb_receive,(int)$mar_receive,(int)$apr_receive,(int)$may_receive,(int)$jun_receive,(int)$jul_receive,(int)$aug_receive,(int)$sep_receive,(int)$oct_receive,(int)$nov_receive,(int)$dec_receive);

    $jan_order = DB::table('orderdetail')->join('order', 'order.orderid', '=', 'orderdetail.orderid')->whereBetween('orderdate', [date('Y-m-d', strtotime('First day of January')), date('Y-m-d', strtotime('Last day of January'))])->sum('orderdetail.orderqty');
    $feb_order = DB::table('orderdetail')->join('order', 'order.orderid', '=', 'orderdetail.orderid')->whereBetween('orderdate', [date('Y-m-d', strtotime('First day of February')), date('Y-m-d', strtotime('Last day of February'))])->sum('orderdetail.orderqty');
    $mar_order = DB::table('orderdetail')->join('order', 'order.orderid', '=', 'orderdetail.orderid')->whereBetween('orderdate', [date('Y-m-d', strtotime('First day of March')), date('Y-m-d', strtotime('Last day of March'))])->sum('orderdetail.orderqty');
    $apr_order = DB::table('orderdetail')->join('order', 'order.orderid', '=', 'orderdetail.orderid')->whereBetween('orderdate', [date('Y-m-d', strtotime('First day of April')), date('Y-m-d', strtotime('Last day of April'))])->sum('orderdetail.orderqty');
    $may_order = DB::table('orderdetail')->join('order', 'order.orderid', '=', 'orderdetail.orderid')->whereBetween('orderdate', [date('Y-m-d', strtotime('First day of May')), date('Y-m-d', strtotime('Last day of May'))])->sum('orderdetail.orderqty');
    $jun_order = DB::table('orderdetail')->join('order', 'order.orderid', '=', 'orderdetail.orderid')->whereBetween('orderdate', [date('Y-m-d', strtotime('First day of June')), date('Y-m-d', strtotime('Last day of June'))])->sum('orderdetail.orderqty');
    $jul_order = DB::table('orderdetail')->join('order', 'order.orderid', '=', 'orderdetail.orderid')->whereBetween('orderdate', [date('Y-m-d', strtotime('First day of July')), date('Y-m-d', strtotime('Last day of July'))])->sum('orderdetail.orderqty');
    $aug_order = DB::table('orderdetail')->join('order', 'order.orderid', '=', 'orderdetail.orderid')->whereBetween('orderdate', [date('Y-m-d', strtotime('First day of August')), date('Y-m-d', strtotime('Last day of August'))])->sum('orderdetail.orderqty');
    $sep_order = DB::table('orderdetail')->join('order', 'order.orderid', '=', 'orderdetail.orderid')->whereBetween('orderdate', [date('Y-m-d', strtotime('First day of September')), date('Y-m-d', strtotime('Last day of September'))])->sum('orderdetail.orderqty');
    $oct_order = DB::table('orderdetail')->join('order', 'order.orderid', '=', 'orderdetail.orderid')->whereBetween('orderdate', [date('Y-m-d', strtotime('First day of October')), date('Y-m-d', strtotime('Last day of October'))])->sum('orderdetail.orderqty');
    $nov_order = DB::table('orderdetail')->join('order', 'order.orderid', '=', 'orderdetail.orderid')->whereBetween('orderdate', [date('Y-m-d', strtotime('First day of November')), date('Y-m-d', strtotime('Last day of November'))])->sum('orderdetail.orderqty');
    $dec_order = DB::table('orderdetail')->join('order', 'order.orderid', '=', 'orderdetail.orderid')->whereBetween('orderdate', [date('Y-m-d', strtotime('First day of December')), date('Y-m-d', strtotime('Last day of December'))])->sum('orderdetail.orderqty');
    $order = array((int)$jan_order,(int)$feb_order,(int)$mar_order,(int)$apr_order,(int)$may_order,(int)$jun_order,(int)$jul_order,(int)$aug_order,(int)$sep_order,(int)$oct_order,(int)$nov_order,(int)$dec_order);
    
    $jan_withdraw = DB::table('withdrawdetail')->join('withdraw', 'withdraw.withdrawid', '=', 'withdrawdetail.withdrawid')->whereBetween('withdrawdate', [date('Y-m-d', strtotime('First day of January')), date('Y-m-d', strtotime('Last day of January'))])->sum('withdrawdetail.withdrawqty');
    $feb_withdraw = DB::table('withdrawdetail')->join('withdraw', 'withdraw.withdrawid', '=', 'withdrawdetail.withdrawid')->whereBetween('withdrawdate', [date('Y-m-d', strtotime('First day of February')), date('Y-m-d', strtotime('Last day of February'))])->sum('withdrawdetail.withdrawqty');
    $mar_withdraw = DB::table('withdrawdetail')->join('withdraw', 'withdraw.withdrawid', '=', 'withdrawdetail.withdrawid')->whereBetween('withdrawdate', [date('Y-m-d', strtotime('First day of March')), date('Y-m-d', strtotime('Last day of March'))])->sum('withdrawdetail.withdrawqty');
    $apr_withdraw = DB::table('withdrawdetail')->join('withdraw', 'withdraw.withdrawid', '=', 'withdrawdetail.withdrawid')->whereBetween('withdrawdate', [date('Y-m-d', strtotime('First day of April')), date('Y-m-d', strtotime('Last day of April'))])->sum('withdrawdetail.withdrawqty');
    $may_withdraw = DB::table('withdrawdetail')->join('withdraw', 'withdraw.withdrawid', '=', 'withdrawdetail.withdrawid')->whereBetween('withdrawdate', [date('Y-m-d', strtotime('First day of May')), date('Y-m-d', strtotime('Last day of May'))])->sum('withdrawdetail.withdrawqty');
    $jun_withdraw = DB::table('withdrawdetail')->join('withdraw', 'withdraw.withdrawid', '=', 'withdrawdetail.withdrawid')->whereBetween('withdrawdate', [date('Y-m-d', strtotime('First day of June')), date('Y-m-d', strtotime('Last day of June'))])->sum('withdrawdetail.withdrawqty');
    $jul_withdraw = DB::table('withdrawdetail')->join('withdraw', 'withdraw.withdrawid', '=', 'withdrawdetail.withdrawid')->whereBetween('withdrawdate', [date('Y-m-d', strtotime('First day of July')), date('Y-m-d', strtotime('Last day of July'))])->sum('withdrawdetail.withdrawqty');
    $aug_withdraw = DB::table('withdrawdetail')->join('withdraw', 'withdraw.withdrawid', '=', 'withdrawdetail.withdrawid')->whereBetween('withdrawdate', [date('Y-m-d', strtotime('First day of August')), date('Y-m-d', strtotime('Last day of August'))])->sum('withdrawdetail.withdrawqty');
    $sep_withdraw = DB::table('withdrawdetail')->join('withdraw', 'withdraw.withdrawid', '=', 'withdrawdetail.withdrawid')->whereBetween('withdrawdate', [date('Y-m-d', strtotime('First day of September')), date('Y-m-d', strtotime('Last day of September'))])->sum('withdrawdetail.withdrawqty');
    $oct_withdraw = DB::table('withdrawdetail')->join('withdraw', 'withdraw.withdrawid', '=', 'withdrawdetail.withdrawid')->whereBetween('withdrawdate', [date('Y-m-d', strtotime('First day of October')), date('Y-m-d', strtotime('Last day of October'))])->sum('withdrawdetail.withdrawqty');
    $nov_withdraw = DB::table('withdrawdetail')->join('withdraw', 'withdraw.withdrawid', '=', 'withdrawdetail.withdrawid')->whereBetween('withdrawdate', [date('Y-m-d', strtotime('First day of November')), date('Y-m-d', strtotime('Last day of November'))])->sum('withdrawdetail.withdrawqty');
    $dec_withdraw = DB::table('withdrawdetail')->join('withdraw', 'withdraw.withdrawid', '=', 'withdrawdetail.withdrawid')->whereBetween('withdrawdate', [date('Y-m-d', strtotime('First day of December')), date('Y-m-d', strtotime('Last day of December'))])->sum('withdrawdetail.withdrawqty');
    $withdraw = array((int)$jan_withdraw,(int)$feb_withdraw,(int)$mar_withdraw,(int)$apr_withdraw,(int)$may_withdraw,(int)$jun_withdraw,(int)$jul_withdraw,(int)$aug_withdraw,(int)$sep_withdraw,(int)$oct_withdraw,(int)$nov_withdraw,(int)$dec_withdraw);
    $data = array('receive'=>$receive,'order'=>$order,'withdraw'=>$withdraw);
    echo json_encode($data);
  }

//////////////////// type service page /////////////
  public function fnTypeService()
  {
    return view('manage/stocker/typeservice');
  }
  // load type service page
  public function fnLoadtypeservice()
  {
    $result = "";
    $sqltypeservice = DB::table('typeservice')->get();
    $count = count($sqltypeservice);
    $i = 1;
    if($count > 0){
      foreach ($sqltypeservice as $ts) {
        $result .= '
        <tr>
          <td>'.$i++.'</td>
          <td>'.$ts->typeservicename.'</td>
          <td>
            <button class="btn btn-info" type="button" id="btnEdit" value="'.$ts->typeserviceid.'"><i class="mdi mdi-pen"></i></button>
          </td>
          <td>
            <button class="btn btn-danger" type="button" id="btnDelete" value="'.$ts->typeserviceid.'"><i class="mdi mdi-trash-can-outline"></i> </button>
          </td>
        </tr>
        ';
      }
    }else{
      $result .= '
        <tr>
          <td colspan="4"><h4 class="text-center">ຍັງ​ບໍ​່​ມີ​ຂໍ້​ມູນ​ໃນ​ລະ​ບົບ</h4></td>
        </tr>
      ';
    }
    $data = array('result' => $result);
    echo json_encode($data);
  }

  /// add type service
  public function fnInsertTypeService(Request $req)
  {
    $typservicedata = array('typeservicename' => $req->typeservicename, 'created_at' => date('Y-m-d H:i:s'));
    DB::table('typeservice')->insert($typservicedata);
    $data = 'ການ​ເພີ່ມ​ຂໍ້​ມູນ​ສຳ​ເລັດ';
    echo json_encode($data);
  }

  // function get type service to edit
  public function fnGetTypeservicedata(Request $req)
  {
    $typeserviceid = $req->typeserviceid;
    $sqltypeservice = DB::table('typeservice')->where('typeserviceid', $typeserviceid)->get();
    foreach ($sqltypeservice as $ts) {
      $typeservicename = $ts->typeservicename;
    }
    $data = array('typeservicename' => $typeservicename);
    echo json_encode($data);
  }

  // function update type service
  public function fnUpdateTypeservice(Request $req)
  {
    $typeserviceid = $req->typeserviceid;
    $typeserviceupdate = array('typeservicename' => $req->typeservicename, 'updated_at' => date('Y-m-d H:i:s'));
    DB::table('typeservice')->where('typeserviceid', $typeserviceid)->update($typeserviceupdate);
    $data = "ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ";
    echo json_encode($data);
  }

  //////// function delete type service
  public function fnDeleteTypeservice(Request $req)
  {
    $typeserviceid = $req->typeserviceid;
    DB::table('typeservice')->where('typeserviceid', $typeserviceid)->delete();
    $data = "ກາ​ນ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ";
    echo json_encode($data);
  }

////////////////// End type service page ///////////

////////////////// Start type spare page ////////////////////////////////////
  public function fnTypespare()
  {
    $typeservicedt = DB::table('typeservice')->get();
    return view('manage/stocker/typespares')->with('typeservicedt', $typeservicedt);
  }
  // function load type spare data
  public function fnLoadTypespare()
  {
    $result = "";
    $sqltypespare = DB::table('typespares')
                    ->join('typeservice', 'typeservice.typeserviceid', '=', 'typespares.typeserviceid')
                    ->select('typespares.*','typeservice.typeservicename')
                    ->get();
    $count = count($sqltypespare);
    $i = 1;
    if($count > 0){
      // $i++;
      foreach ($sqltypespare as $tsp) {
        $result .= '
        <tr>
          <td>'.$i++.'</td>
          <td>'.$tsp->typeservicename.'</td>
          <td>'.$tsp->typesparename.'</td>
          <td>
            <button class="btn btn-info" type="button" id="btnEdit" value="'.$tsp->typesparesid.'"><i class="mdi mdi-pen"></i></button>
          </td>
          <td>
            <button class="btn btn-danger" type="button" id="btnDelete" value="'.$tsp->typesparesid.'"><i class="mdi mdi-trash-can-outline"></i></button></td>
        </tr>
        ';
      }
    }else{
      $result .= '
        <tr>
          <td colspan="5"><h4 class="text-center">ບໍ່​ມີ​ຂໍ້​ມູນ​ໃນ​ລະ​ບ​ົບ​ເທື່ອ</h4></td>
        </tr>
      ';
    }
    $data = array('typesparedt' => $result);
    echo json_encode($data);
  }

  // insert type spare function
  public function fnInsertTypespare(Request $req)
  {
    $insertdata = array('typesparename'=> $req->typesparename, 'typeserviceid'=>$req->typeserviceid, 'created_at' => date('Y-m-d H:i:s'));
    DB::table('typespares')->insert($insertdata);
    $data = "ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ";
    echo json_encode($data);
  }

  /// function get type spare data to edit
  public function fnGetTypespare(Request $req)
  {
    $typesparesid = $req->typesparesid;
    $sqltypespareedit = DB::table('typespares')->where('typesparesid', $typesparesid)->get();
    foreach ($sqltypespareedit as $tsedit) {
      $typesparename = $tsedit->typesparename;
      $typeserviceid = $tsedit->typeserviceid;
    }
    $data = array('typesparename'=>$typesparename, 'typeserviceid' => $typeserviceid);
    echo json_encode($data);
  }

  // function update type spare
  public function fnUpdateTypespare(Request $req)
  {
    $typesparesid = $req->typesparesid;
    $dataupdate = array('typesparename' => $req->typesparename, 'typeserviceid' => $req->typeserviceid, 'updated_at' => date('Y-m-d H:i:s'));
    DB::table('typespares')->where('typesparesid', $typesparesid)->update($dataupdate);
    $data = "ກາ​ນ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ";
    echo json_encode($data);
  }

  // function delete type spare
  public function fnDeleteTypespare(Request $req)
  {
    $typesparesid = $req->typesparesid;
    DB::table('typespares')->where('typesparesid', $typesparesid)->delete();
    $data = "ກາ​ນ​ດຳ​ເນີ​ນ​ການ​ສຳ​ເລັດ";
    echo json_encode($data);
  }

////////////////// End type spare page ././././././././././././././././././.././

//////////////////////////// START BRAND SPARE /////////////////////////////////
    // brand spare page
  public function fnBrandSpare()
  {
    // $sqltypespares = DB::table('typespares')->get();
    return view('manage/stocker/brandspare');
  }

  // function load data to show
  public function fnLoadBrandspare()
  {
    $result = "";
    $sqlbrandspare = DB::table('brandspares')->get();
    $count = count($sqlbrandspare);
    $i = 1;
    if($count > 0){
      foreach ($sqlbrandspare as $bs) {
        $result .= '
          <tr>
            <td>'.$i++.'</td>
            <td>'.$bs->brandsparename.'</td>
            <td>
              <button class="btn btn-info" type="button" id="btnEdit" value="'.$bs->brandspareid.'"><i class="mdi mdi-pen"></i></button>
            </td>
            <td>
              <button class="btn btn-danger" type="button" id="btnDelete" value="'.$bs->brandspareid.'"><i class="mdi mdi-trash-can-outline"></i> </button>
            </td>
          </tr>
        ';
      }
    }else{
      $result .= '<tr><td colspan="5"><h4 class="text-center">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ໃນ​ລະ​ບົບ</h4></td></tr>';
    }

    $data = array('result' => $result);
    echo json_encode($data);
  }

  // function insert brand spare
  public function fnInsertBrandspare(Request $req)
  {
    $datainsert = array('brandsparename' => $req->brandsparename, 'created_at' => date('Y-m-d H:i:s'));
    DB::table('brandspares')->insert($datainsert);
    $data = "ກາ​ນ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ!";
    echo json_encode($data);
  }

  // function get data to update
  public function fnGetBrandspare(Request $req)
  {
    $brandspareid = $req->brandspareid;
    $sqlgetdata = DB::table('brandspares')->where('brandspareid', $brandspareid)->get();
    foreach ($sqlgetdata as $gbs) {
      $brandsparename = $gbs->brandsparename;
    }
    $data = array('brandsparename' => $brandsparename);
    echo json_encode($data);
  }

  // funcion udpate brand spare
  public function fnUpdateBrandspare(Request $req)
  {
    $brandspareid = $req->brandspareid;
    $dataupdate = array('brandsparename'=>$req->brandsparename, 'updated_at' => date('Y-m-d H:i:s'));
    DB::table('brandspares')->where('brandspareid', $brandspareid)->update($dataupdate);
    $data = "ກາ​ນ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ";
    echo json_encode($data);
  }

  // function delete brand spare
  public function fnDeleteBrandspare(Request $req)
  {
    $brandspareid = $req->brandspareid;
    DB::table('brandspares')->where('brandspareid', $brandspareid)->delete();
    $data = "ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ";
    echo json_encode($data);
  }
//////////////////////////// END BRAND SPARE ////////////////////////////////////

//////////////////////////// START UNIT SPARE /////////////////////////////////
  public function fnUnitspare()
  {
    return view('manage/stocker/unitspare');
  }
  // function load unit spare data
  public function fnLoadUnitspare()
  {
    $result = "";
    $sqlunitspare = DB::table('unitspare')->get();
    $i = 1;
    if(count($sqlunitspare) > 0){
      foreach($sqlunitspare as $us){
        $result .= '
        <tr>
          <td>'.$i++.'</td>
          <td>'.$us->unitname.'</td>
          <td class="text-center">
            <button class="btn btn-info" type="button" id="btnEdit" value="'.$us->unitid.'"><i class="mdi mdi-pen"></i></button>
          </td>
          <td class="text-center">
            <button class="btn btn-danger" type="button" id="btnDelete" value="'.$us->unitid.'"><i class="mdi mdi-trash-can-outline"></i></button>
          </td>
        </tr>
        ';
      }
    }else{
      $result .='
        <tr>
          <td colspan="4">
            <h4 class="text-center">ຍັງ​ບໍ່​ມີຂໍ້​ມູນ​ໃນ​ລະ​ບົບ</h4>
          </td>
        </tr>
      ';
    }
    $data = array('unitdata' => $result);
    echo json_encode($data);
  }

  // function insert unit spare
  public function fnInsertUnitspare(Request $req)
  {
    $insertdata = array('unitname' => $req->unitname, 'created_at' => date('Y-m-d H:i:s'));
    DB::table('unitspare')->insert($insertdata);
    $data = "ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ";
    echo json_encode($data);
  }

  // get unit spare to edit
  public function fnGetUnitspare(Request $req)
  {
    $unitid = $req->unitid;
    $sqlunitedit = DB::table('unitspare')->where('unitid', $unitid)->get();
    foreach($sqlunitedit as $uedit){
      $unitid = $uedit->unitid;
      $unitname = $uedit->unitname;
    }
    $data = array('unitid' => $unitid, 'unitname' => $unitname);
    echo json_encode($data);
  }
  
  // function update unit spare
  public function fnUpdateUnitspare(Request $req)
  {
    $unitid = $req->unitid;
    $updatedata = array('unitname' => $req->unitname, 'updated_at' => date('Y-m-d H:i:s'));
    DB::table('unitspare')->where('unitid', $unitid)->update($updatedata);
    $data = "ກາ​ນ​ແກ້​ໄຂ​ຂໍ້​ມູນສຳ​ເລັດ";
    echo json_encode($data);
  }

  // function delete unit spare
  public function fnDeleteUnitspare(Request $req)
  {
    $unitid = $req->unitid;
    DB::table('unitspare')->where('unitid', $unitid)->delete();
    $data = "ການ​ລົບ​ຂໍ້​ມູນ​ສຳ​ເລັດ";
    echo json_encode($data);
  }

}
