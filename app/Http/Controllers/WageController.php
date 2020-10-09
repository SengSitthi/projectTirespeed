<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Validator;
use Illuminate\Support\Str;

class WageController extends Controller
{
  public function index()
  {
    $typecars = DB::table('typecars')->get();
    $typeservices = DB::table('typeservice')->get();
    $unitrepairs = DB::table('unitrepairs')->get();
    return view('manage/technical/wagenew')->with('typeservices', $typeservices)->with('typecars', $typecars)->with('unitrepairs', $unitrepairs);
  }

  // function insert new wage
  public function fnInsertWage(Request $req)
  {
    $this->validate($req, [
      'typeserviceid' => 'required',
      'typesparesid' => 'required'
    ]);
    if(count(DB::table('wages')->where('wageid', $req->input('wageid'))->get()) > 0){
      return back()->with('error', 'ID is already in system!');
    }else{  
      $datainsert = array(
        'wageid' => $req->input('wageid'),
        'wagename' => $req->input('wagename'),
        'typeserviceid' => $req->input('typeserviceid'),
        'typesparesid' => $req->input('typesparesid'),
        'cost' => $req->input('cost'),
        'tcarid' => $req->input('tcarid'),
        'guaranty' => $req->input('guaranty'),
        'timeset' => $req->input('timeset'),
        'unitrpid' => $req->input('unitrpid'),
        'created_at' => date('Y-m-d H:i:s')
      );

      DB::table('wages')->insert($datainsert);
      return redirect('wagenew')->with('success', 'Save new wage successfully!');
    }
  }

  // function show wage list
  public function fnWagelist()
  {
    $wages = DB::table('wages')->join('typeservice', 'typeservice.typeserviceid', '=', 'wages.typeserviceid')
                               ->join('typespares', 'typespares.typesparesid', '=', 'wages.typesparesid')
                               ->join('typecars', 'typecars.tcarid', '=', 'wages.tcarid')
                               ->join('unitrepairs', 'unitrepairs.unitrpid', '=', 'wages.unitrpid')
                               ->select('wages.*','typeservice.*','typespares.*','unitrepairs.*','typecars.*')->orderBy('wages.wageid', 'desc')->paginate(35);
    $typecars = DB::table('typecars')->get();
    $typeservices = DB::table('typeservice')->get();
    $unitrepairs = DB::table('unitrepairs')->get();
    return view('manage/technical/wagelist')->with('wages', $wages)->with('typeservices', $typeservices)
                                            ->with('typecars', $typecars)->with('unitrepairs', $unitrepairs);
  }

  // function get wage data to edit form
  public function fnGetWagedata(Request $req)
  {
    $wageid = $req->wageid;
    $sqlwage = DB::table('wages')->where('wageid', $wageid)->get();
    foreach($sqlwage as $sw){
      $wagename = $sw->wagename;
      $typeserviceid = $sw->typeserviceid;
      $typesparesid = $sw->typesparesid;
      $cost = $sw->cost;
      $tcarid = $sw->tcarid;
      $guaranty = $sw->guaranty;
      $timeset = $sw->timeset;
      $unitrpid = $sw->unitrpid;
    }
    $data = array(
      'wagename' => $wagename,'typeserviceid' => $typeserviceid,'cost' => $cost,'tcarid' => $tcarid,
      'guaranty' => $guaranty,'timeset' => $timeset,'unitrpid' => $unitrpid,'typesparesid' => $typesparesid,
    );
    echo json_encode($data);
  }

  //function update wage data
  public function fnUpdateWages(Request $req)
  {
    $this->validate($req, [
      'typeserviceid' => 'required',
      'typesparesid' => 'required'
    ]);

    $dataupdate = array(
      'wagename' => $req->input('wagename'),
      'typeserviceid' => $req->input('typeserviceid'),
      'typesparesid' => $req->input('typesparesid'),
      'cost' => $req->input('cost'),
      'tcarid' => $req->input('tcarid'),
      'guaranty' => $req->input('guaranty'),
      'timeset' => $req->input('timeset'),
      'unitrpid' => $req->input('unitrpid'),
      'updated_at' => date('Y-m-d H:i:s')
    );

    DB::table('wages')->where('wageid', $req->input('wageid'))->update($dataupdate);
    return redirect('wagelist')->with('success', 'Update successfully!');
  }

  // function delete wages data
  public function fnDeleteWages($wageid)
  {
    DB::table('wages')->where('wageid', $wageid)->delete();
    return redirect('wagelist')->with('success', 'Delete success!');
  }

  // function search wage data
  public function fnSearchWage(Request $req)
  {
    $textsearch = $req->textsearch;
    $wages = DB::table('wages')->join('typeservice', 'typeservice.typeserviceid', '=', 'wages.typeserviceid')
                               ->join('typespares', 'typespares.typesparesid', '=', 'wages.typesparesid')
                               ->join('typecars', 'typecars.tcarid', '=', 'wages.tcarid')
                               ->join('unitrepairs', 'unitrepairs.unitrpid', '=', 'wages.unitrpid')
                               ->where('wages.wageid', 'like', '%'.$textsearch.'%')
                               ->orWhere('wages.wagename', 'like', '%'.$textsearch.'%')
                               ->select('wages.*','typeservice.*','typespares.*','unitrepairs.*','typecars.*')->orderBy('wages.wageid', 'desc')->get();
    $result = "";
    if(count($wages) > 0){
      foreach ($wages as $w) {
        $result .= '
        <tr>
          <td class="text-center">'.$w->wageid.'</td>
          <td>'.$w->wagename.'</td>
          <td>'.$w->typeservicename.'</td>
          <td>'.$w->typesparename.'</td>
          <td class="text-center">'.$w->cost.'</td>
          <td class="text-center">'.$w->tcarname.'</td>
          <td class="text-center">'.$w->guaranty.'</td>
          <td class="text-center">'.$w->timeset.'</td>
          <td class="text-center">'.$w->unitrpname.'</td>
          <td class="text-center">
            <div class="btn-group dropleft">
              <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <i class="mdi mdi-dots-horizontal"></i>
              </button>
              <div class="dropdown-menu">
                <button class="dropdown-item" id="btnEdit" value="'.$w->wageid.'"><i class="mdi mdi-grease-pencil"></i> ແກ້​ໄຂ</button>
                  <button class="dropdown-item" id="btnDelete" value="'.$w->wageid.'"><i class="mdi mdi-trash-can"></i> ລຶບ</button>
              </div>
            </div>
          </td>
        </tr>
        ';
      }
    }else{
      $result .= '<tr><td colspan="10"><h3 class="text-center">ບໍ່​ມີ​ຂໍ້​ມູນ​ທີ່​ຄົ້ນ​ຫາໃນ​ລະ​ບົບ</h3></td></tr>';
    }
    $data = array('result'=>$result);
    echo json_encode($data);
  }
}
