<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Validator;
use Picqer;// barcode import


class SpareController extends Controller
{
    //
  //////////////////// Spare Function //////////////
  public function fnSpares()
  {
    $typeservice = DB::table('typeservice')->get();
    $unitspare = DB::table('unitspare')->get();
    $brandspares = DB::table('brandspares')->get();
    $brands = DB::table('brands')->orderBy('brandname', 'asc')->get();
    return view('manage/stocker/spares')->with('typeservice', $typeservice)
                                        ->with('unitspare', $unitspare)
                                        ->with('brandspares', $brandspares)
                                        ->with('brands', $brands);
  }

  // function get type spare after select type service
  public function fnSelectTypespare(Request $req)
  {
    $result = "";
    $typeserviceid = $req->typeserviceid;
    $sqltypespares = DB::table('typespares')->where('typeserviceid', $typeserviceid)->get();
    if(count($sqltypespares) > 0){
      $result .= '<option value="">ເລືອກປະ​ເພດ​ອະ​ໄຫຼ່</option>';
      foreach($sqltypespares as $tsp){
        $result .= '
          <option value="'.$tsp->typesparesid.'">'.$tsp->typesparename.'</option>
        ';
      }
    }else{
      $result = '
        <option value="">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ປະ​ເພດ​ອະ​ໄຫຼ່</option>
      ';
    }
    $data = array('result' => $result);
    echo json_encode($data);
  }

  // function get brand spare after select type spare
  // public function fnSelectBrandspare(Request $req)
  // {
  //   $result = "";
  //   $typesparesid = $req->typesparesid;
  //   $sqlbrandspare = DB::table('brandspares')->where('typesparesid', $typesparesid)->get();
  //   if(count($sqlbrandspare) > 0){
  //     $result .= '<option value="">ເລືອກ​ຍີ່​ຫໍ້​ອະ​ໄຫຼ່</option>';
  //     foreach ($sqlbrandspare as $bs) {
  //       $result .= '<option value="'.$bs->brandspareid.'">'.$bs->brandsparename.'</option>';
  //     }
  //   }else{
  //     $result .= '<option value="">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ຍີ່​ຫໍ້​ອະ​ໄຫຼ່</option>';
  //   }
  //   $data = array('result' => $result);
  //   echo json_encode($data);
  // }

  // function insert spare
  public function fnInsertspare(Request $req)
  {
    $this->validate($req, [
      'typeserviceid' => 'required',
      'typesparesid' => 'required',
      'brandspareid' => 'required',
      'brandid' => 'required',
      'unitid' => 'required',
    ]);
    $createbarcode = $req->input('createbarcode');
    $datainsert = array(
      'sparesid' => $req->input('sparesid'),
      'rpnoid' => $req->input('rpnoid'),
      'sparesname' => $req->input('sparesname'),
      'typeserviceid' => $req->input('typeserviceid'),
      'typesparesid' => $req->input('typesparesid'),
      'brandspareid' => $req->input('brandspareid'),
      'model' => $req->input('model'),
      'brandid' => $req->input('brandid'),
      'carmodel' => $req->input('carmodel'),
      'madeyear' => $req->input('madeyear'),
      'sellprice' => $req->input('sellprice'),
      'unitid' => $req->input('unitid'),
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s')
    );
    // DB::table('spares')->insert($datainsert);
    $sparesid = $req->input('sparesid');
    $count = count(DB::table('spares')->where('sparesid', $sparesid)->get());
    $count1 = count(DB::table('spares')->where('rpnoid'), $req->input('rpnoid')->get());
    if($count > 0){
      return back()->with('error', 'ຜິດ​ພາດ​ລະ​ຫັດ​ທີ່​ທ່ານ​ປ້ອນ​ຊ້ຳ​ກັນ');
    }else if($count1 > 0){
      return back()->with('rpno_error', 'ຜິດ​ພາດ​ລະ​ຫັດ​ສ້ອມ​ແປງທີ່​ທ່ານ​ປ້ອນ​ຊ້ຳ​ກັນ');
    }else{
      if($createbarcode == "1"){
        DB::table('spares')->insert($datainsert);
        $barcodeqty = $req->input('barcodeqty');
        $barcode_generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = $barcode_generator->getBarcode($sparesid, $barcode_generator::TYPE_CODABAR);
        // echo '<img src="data:image/png;base64,'.base64_encode($barcode).'">';
        // echo '<br>'.$sparesid;
        return view('manage/stocker/printbarcode')->with('sparesid', $sparesid)
                                                  ->with('barcodeqty', $barcodeqty)
                                                  ->with('barcode', $barcode);
      }else{
        DB::table('spares')->insert($datainsert);
        return redirect('spares')->with('success', 'ການ​ເພີ່ມ​ອະ​ໄຫຼ່​ສຳ​ເລັດ');
      }
    }
  }

  public function fnListSpare()
  {
    $sparelist = DB::table('spares')
    ->join('typeservice', 'typeservice.typeserviceid', '=', 'spares.typeserviceid')
    ->join('typespares', 'typespares.typesparesid', '=', 'spares.typesparesid')
    ->join('brandspares', 'brandspares.brandspareid', '=', 'spares.brandspareid')
    ->join('brands', 'brands.brandid', '=', 'spares.brandid')
    ->join('unitspare', 'unitspare.unitid', '=', 'spares.unitid')
    ->select('spares.*','brands.*','typeservice.typeservicename','typespares.typesparename','brandspares.brandsparename','unitspare.unitname')
    ->orderBy('rpnoid', 'asc')
    ->paginate(50);
    $count = count($sparelist);
    $typeservice = DB::table('typeservice')->get();
    $typespares = DB::table('typespares')->get();
    $brandspares = DB::table('brandspares')->get();
    $unitspare = DB::table('unitspare')->get();
    $brands = DB::table('brands')->orderBy('brandname', 'asc')->get();
    return view('manage/stocker/spareslist')->with('sparelist', $sparelist)
      ->with('rowcount', $count)
      ->with('typeservice', $typeservice)
      ->with('unitspare', $unitspare)
      ->with('typespares', $typespares)
      ->with('brandspares', $brandspares)
      ->with('brands', $brands);
  }

  // function autocomplete search spare
  public function fnSearchspare(Request $req)
  {
    $result = "";
    $search = $req->search;
    if($search != ""){
      $sqlsearchspare = DB::table('spares')->where('sparesid', 'like', '%'.$search.'%')
                                           ->orWhere('sparesname', 'like', '%'.$search.'%')->get();
      $count = count($sqlsearchspare);
      if($count > 0){
        $result = '<ul class="dropdown-menu" style="display:block; position:absolute">';
        foreach($sqlsearchspare as $rs){
          $result .= '
            <li><a href="#">'.$rs->sparesname.'</a></li>
          ';
        }
        $result .= '</ul>';
      }else{
        $result = '<ul class="dropdown-menu" style="display:block; position:absolute">';
        $result .= '<li><a href="#">ບໍ່​ມີ​ຂໍ້​ມູນ​ນີ້​ໃນ​ລະ​ບົບ</a></li>';
        $result .= '</ul>';
      }
    }
    $data = array('result' => $result);
    echo json_encode($data);
  }

  // function show search data
  public function fnShowsearchdata(Request $req)
  {
    $result = "";
    $datasearch = $req->datasearch;
    $sqlsearch = DB::table('spares')
    ->join('typeservice', 'typeservice.typeserviceid', '=', 'spares.typeserviceid')
    ->join('typespares', 'typespares.typesparesid', '=', 'spares.typesparesid')
    ->join('brandspares', 'brandspares.brandspareid', '=', 'spares.brandspareid')
    ->join('brands', 'brands.brandid', '=', 'spares.brandid')
    ->join('unitspare', 'unitspare.unitid', '=', 'spares.unitid')
    ->where('sparesid', 'like', '%'.$datasearch.'%')->orWhere('sparesname', 'like', '%'.$datasearch.'%')
    ->select('spares.*','typeservice.typeservicename','typespares.typesparename','brandspares.brandsparename','brands.*','unitspare.unitname')
    ->get();
    if(count($sqlsearch) > 0){
      foreach($sqlsearch as $row){
        $result .= '
        <tr>
          <td>'.$row->sparesid.'</td>
          <td>'.$row->rpnoid.'</td>
          <td>'.$row->sparesname.'</td>
          <td>'.$row->typeservicename.'</td>
          <td>'.$row->typesparename.'</td>
          <td>'.$row->brandsparename.'</td>
          <td>'.$row->model.'</td>
          <td>'.$row->brandname.'</td>
          <td>'.$row->carmodel.'</td>
          <td>'.$row->madeyear.'</td>
          <td>'.number_format($row->sellprice).'</td>
          <td>'.$row->unitname.'</td>
          <td class="text-center">
            <button class="btn btn-info" type="button" value="'.$row->sparesid.'" id="btnBarcode"><i class="mdi mdi-barcode"></i></button>
          </td>
          <td class="text-center">
            <div class="dropdown">
              <button id="btnManage" class="btn btn-default btn-sm btn-icon btn-transparent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></button>
              <div class="dropdown-menu" aria-labelledby="btnManage">
                <button class="dropdown-item text-center bg-info" value="'.$row->sparesid.'" id="btnEdit"><i class="mdi mdi-pen"></i></button>
                <button class="dropdown-item text-center bg-danger" value="'.$row->sparesid.'" id="btnDelete"><i class="mdi mdi-trash-can-outline"></i></button>
              </div>
            </div>
          </td>
        </tr>
        ';
      }
    }else{
      $result .= '<tr><td colspan="11"><h5 class="text-danger>ບໍ່​ມີ​ຂໍ້​ມູນ​ທີ່​ທ່ານ​ຄົ້ນ​ຫາ</h5></td></tr>';
    }
    $data = array('result' => $result);
    echo json_encode($data);
  }

  // function print barcode
  public function fnPrintBarcode(Request $req)
  {
    $sparesid = $req->input('sparesid');
    $barcodeqty = $req->input('barcodeqty');
    $barcode_generator = new Picqer\Barcode\BarcodeGeneratorPNG();
    $barcode = $barcode_generator->getBarcode($sparesid, $barcode_generator::TYPE_CODABAR);
    return view('manage/stocker/printbarcode')->with('sparesid', $sparesid)
                                              ->with('barcodeqty', $barcodeqty)
                                              ->with('barcode', $barcode);
  }

  // function get spare data to edit
  public function fnGetSparetoEdit(Request $req)
  {
    $sparesid = $req->sparesid;
    $sqlspares = DB::table('spares')->where('sparesid', $sparesid)->get();
    foreach($sqlspares as $row){
      $sparesid = $row->sparesid;
      $rpnoid = $row->rpnoid;
      $sparesname = $row->sparesname;
      $typeserviceid = $row->typeserviceid;
      $typesparesid = $row->typesparesid;
      $brandspareid = $row->brandspareid;
      $model = $row->model;
      $brandid = $row->brandid;
      $carmodel = $row->carmodel;
      $madeyear = $row->madeyear;
      $sellprice = $row->sellprice;
      $unitid = $row->unitid;
    }
    $data = array(
      'sparesid' => $sparesid,
      'rpnoid' => $rpnoid,
      'sparesname' => $sparesname,
      'typeserviceid' => $typeserviceid,
      'typesparesid' => $typesparesid,
      'brandspareid' => $brandspareid,
      'model' => $model,
      'brandid' => $brandid,
      'carmodel' => $carmodel,
      'madeyear' => $madeyear,
      'sellprice' => $sellprice,
      'unitid' => $unitid
    );
    echo json_encode($data);
  }

  // function update spare data
  public function fnUpdateSpare(Request $req)
  {
    $this->validate($req, [
      'typeserviceid' => 'required',
      'typesparesid' => 'required',
      'brandspareid' => 'required',
      'unitid' => 'required',
      'brandid' => 'required'
    ]);
    $updatecurrenturl = $req->input('updatecurrenturl');
    $sparesid = $req->input('sparesid1');
    $dataupdate = array(
      'rpnoid' => $req->input('rpnoid'),
      'sparesname' => $req->input('sparesname'),
      'typeserviceid' => $req->input('typeserviceid'),
      'typesparesid' => $req->input('typesparesid'),
      'brandspareid' => $req->input('brandspareid'),
      'model' => $req->input('model'),
      'brandid' => $req->input('brandid'),
      'carmodel' => $req->input('carmodel'),
      'madeyear' => $req->input('madeyear'),
      'sellprice' => $req->input('sellprice'),
      'unitid' => $req->input('unitid')
    );
    DB::table('spares')->where('sparesid', $sparesid)->update($dataupdate);
    return redirect($updatecurrenturl)->with('success', 'update spares success');
  }

  // function delete spares data
  public function fnDeletespare($sparesid)
  {
    DB::table('spares')->where('sparesid', $sparesid)->delete();
    return redirect('spareslist')->with('success', 'update spares success');
  }

  // function show spares page
  public function fnSparesbookprint()
  {
    $typeservice = DB::table('typeservice')->get();
    return view('/manage/stocker/sparesbookprint')->with('typeservice', $typeservice);
  }

  // function load book spare data
  public function fnLoadbookdata(Request $req)
  {
    $result = "";
    $sparesbook = DB::table('spares')->where('typesparesid', $req->typesparesid)->get();
    $typesparename = DB::table('typespares')->select('typesparename')->where('typesparesid', $req->typesparesid)->get();
    $barcode_generator = new Picqer\Barcode\BarcodeGeneratorPNG();
    // $barcode = $barcode_generator->getBarcode($sparesid, $barcode_generator::TYPE_CODE_128);

    foreach($typesparename as $tsp){
      $title = $tsp->typesparename;
    }
    if(count($sparesbook) > 0){
      foreach($sparesbook as $book){
        $result .= '
        <div class="d-inline p-2">
          <p class="text-center">'.$book->sparesname.'</p>
          <img src="data:image/png;base64,'.base64_encode($barcode_generator->getBarcode($book->sparesid, $barcode_generator::TYPE_CODABAR)).'">
          <h6 class="text-center">'.$book->rpnoid.'|'.$book->sparesid.'</h6>
        </div>
        ';
      }
    }else{
      $result .= '
      <div class="col-md-12">
        <h3>ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ທີ່​ທ່ານ​ຄົ້ນ​ຫາ</h3>
      </div> 
      ';
    }
    $data = array('title' => $title, 'result' => $result);
    echo json_encode($data);
  }
}
