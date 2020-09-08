<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DisController extends Controller
{
    //

    // function load District
    public function fnLoadDis(Request $req){
        if($req->ajax()){
            $result = '';
            $query = $req->get('query');
            if($query != ''){
                $data = DB::table('districts')->where('proid', $query)->get();
            }else{
                $data = DB::table('districts')->get();
            }
            if(count($data) > 0){
                $result .= '<option value="">***** ເລືອກ​ເມືອງ *****</option>';
                foreach($data as $row){
                    $result .= '
                        <option value="'.$row->disid.'">'.$row->disname.'</option>
                    ';
                }
            }else{
                $result .= '
                    <option value="">ບໍ່​ມີ​ການ​ເພີ່ມ​ຂໍ້​ມູນ​ເມືອງ</option>
                ';
            }
            $data = array('dis_data' => $result);
            echo json_encode($data);
        }
    }
}
