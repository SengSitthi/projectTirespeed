<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class StoreWorkingController extends Controller
{
    public function fnLoadNotification(Request $req)
    {
        $result = "";
        $date = date('Y-m-d');
        $sqlnoti = DB::table('storeworking')->where('dateworking', 'like', '%'.$date.'%')->get();
        $countnoti = count($sqlnoti);
        if($countnoti > 0){
            foreach ($sqlnoti as $row) {
                $result .= '
                    <tr>
                        <td>'.$row->workID.'</td>
                        <td>'.$row->username.'</td>
                        <td>'.$row->dateworking.' '.$row->timeworking.'</td>
                        <td>'.$row->status.'</td>
                        <td>'.$row->detail.'</td>
                    </tr>
                ';
            }
        } else {
            $result .= '<tr><td class="text-center" colspan="5">ບໍ່​ມີ​ຂໍ້​ມູນ​ການ​ເຄື່ອນ​ໄຫວ​ຂອງ​ຜູ້​ໃຊ້ໃນ​ລະ​ບົບ</td></tr>';
        }

        $data = array('countnoti' => $countnoti, 'datanoti' => $result);
        return json_encode($data);
    }
}
