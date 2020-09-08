<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Auth, Validator;
use Illuminate\Support\Str;

class StocksummaryController extends Controller
{
  //
  public function fnStocksmr()
  {
    // $lastday = date('d', strtotime('Last day of this month'));
    $lastdayoldmonth = date('Y-m-d', strtotime('Last day of last month'));
    $firstdaycurmonth = date('Y-m-d', strtotime('First day of this month'));
    $lastdaycurmonth = date('Y-m-d');
    $summary = DB::table('spares')->select('spares.*',
      DB::raw('(SELECT unitname FROM unitspare WHERE spares.unitid=unitspare.unitid) AS unitname'),

      DB::raw("COALESCE((SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') - (SELECT SUM(`withdrawdetail`.`withdrawqty`) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` <= '".$lastdayoldmonth."'), 0) AS Yordyokma"),

      DB::raw("(SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') AS SaliaYokyord"),

      DB::raw("((SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.receivedate <= '".$lastdayoldmonth."') / (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."')) 
      * ((SELECT CONVERT(SUM(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') - (SELECT CONVERT(SUM(`withdrawdetail`.`withdrawqty`), CHAR) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.withdrawid=`withdrawdetail`.withdrawid WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` <= '".$lastdayoldmonth."')) AS LuamYokyord"),

      DB::raw("COALESCE((SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0) AS Jamnuanhubkhao"),

      DB::raw("(SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."') / (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."') AS lakhahubkhao"),

      DB::raw("(SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."') * COALESCE((SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0) AS Luamlakhahubkhao"),

      DB::raw("COALESCE((SELECT SUM(`withdrawdetail`.`withdrawqty`) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0) AS jamnuanberk"),

      DB::raw("(SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') AS LakhaTonteun"),

      DB::raw("((SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / 
      (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."')) *
      (SELECT CONVERT(SUM(`withdrawdetail`.`withdrawqty`), CHAR) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."') AS LuamTonteun"),

      DB::raw("COALESCE(((SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') - (SELECT SUM(`withdrawdetail`.`withdrawqty`) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` <= '".$lastdayoldmonth."')), 0)
      +
      COALESCE((SELECT CONVERT(SUM(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0) -
      COALESCE((SELECT SUM(`withdrawdetail`.`withdrawqty`) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0) AS Khongluea"),

      DB::raw("(COALESCE(((SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / 
      (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."'))
      * 
      ((SELECT CONVERT(SUM(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."')
      -(SELECT CONVERT(SUM(`withdrawdetail`.`withdrawqty`), CHAR) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` <= '".$lastdayoldmonth."')), 0)
      +
      COALESCE(
      (SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."') *
      (SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0)
      -
      COALESCE(
      ((SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / 
      (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."')) *
      (SELECT CONVERT(SUM(`withdrawdetail`.`withdrawqty`), CHAR) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0))
      /
      (COALESCE(((SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') - (SELECT SUM(`withdrawdetail`.`withdrawqty`) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` <= '".$lastdayoldmonth."')), 0)
      +
      COALESCE((SELECT CONVERT(SUM(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0) -
      COALESCE((SELECT SUM(`withdrawdetail`.`withdrawqty`) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0))
      AS Lakhakhongluea"),
      
      DB::raw("COALESCE(((SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / 
        (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."'))
        * 
        ((SELECT CONVERT(SUM(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."')
        -(SELECT CONVERT(SUM(`withdrawdetail`.`withdrawqty`), CHAR) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` <= '".$lastdayoldmonth."')), 0)
        +
        COALESCE(
        (SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."') *
        (SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0)
        -
        COALESCE(
        ((SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / 
        (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."')) *
        (SELECT CONVERT(SUM(`withdrawdetail`.`withdrawqty`), CHAR) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0)
        AS Luamlakhakhongluea")
    )->orderBy('sparesname', 'asc')->paginate(30);
    $no = 1;
    $typespares = DB::table('typespares')->orderBy('typesparename', 'asc')->get();
    return view('manage/stocker/stocksummary')->with('lastday', $lastdayoldmonth)
                                              ->with('summary', $summary)
                                              ->with('typespares', $typespares)
                                              ->with('no', $no);
  }

  public function fnStocksumsearch(Request $req)
  {
    $this->validate($req, [
      'typespares' => 'required'
    ]);
    $lastdayoldmonth = date('Y-m-d', strtotime($req->input('ymd').'Last day of last month'));
    $firstdaycurmonth = date('Y-m-d', strtotime($req->input('ymd').'First day of this month'));
    $lastdaycurmonth = $req->input('ymd');
    $summary = DB::table('spares')->select('spares.*',
    DB::raw('(SELECT unitname FROM unitspare WHERE spares.unitid=unitspare.unitid) AS unitname'),

    DB::raw("COALESCE((SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') - (SELECT SUM(`withdrawdetail`.`withdrawqty`) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` <= '".$lastdayoldmonth."'), 0) AS Yordyokma"),

    DB::raw("(SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') AS SaliaYokyord"),

    DB::raw("((SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.receivedate <= '".$lastdayoldmonth."') / (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."')) 
    * ((SELECT CONVERT(SUM(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') - (SELECT CONVERT(SUM(`withdrawdetail`.`withdrawqty`), CHAR) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.withdrawid=`withdrawdetail`.withdrawid WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` <= '".$lastdayoldmonth."')) AS LuamYokyord"),

    DB::raw("COALESCE((SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0) AS Jamnuanhubkhao"),

    DB::raw("(SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."') / (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."') AS lakhahubkhao"),

    DB::raw("(SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."') * COALESCE((SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0) AS Luamlakhahubkhao"),

    DB::raw("COALESCE((SELECT SUM(`withdrawdetail`.`withdrawqty`) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0) AS jamnuanberk"),

    DB::raw("(SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') AS LakhaTonteun"),

    DB::raw("((SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / 
    (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."')) *
    (SELECT CONVERT(SUM(`withdrawdetail`.`withdrawqty`), CHAR) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."') AS LuamTonteun"),

    DB::raw("COALESCE(((SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') - (SELECT SUM(`withdrawdetail`.`withdrawqty`) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` <= '".$lastdayoldmonth."')), 0)
    +
    COALESCE((SELECT CONVERT(SUM(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0) -
    COALESCE((SELECT SUM(`withdrawdetail`.`withdrawqty`) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0) AS Khongluea"),

    DB::raw("(COALESCE(((SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / 
    (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."'))
    * 
    ((SELECT CONVERT(SUM(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."')
    -(SELECT CONVERT(SUM(`withdrawdetail`.`withdrawqty`), CHAR) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` <= '".$lastdayoldmonth."')), 0)
    +
    COALESCE(
    (SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."') *
    (SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0)
    -
    COALESCE(
    ((SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / 
    (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."')) *
    (SELECT CONVERT(SUM(`withdrawdetail`.`withdrawqty`), CHAR) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0))
    /
    (COALESCE(((SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') - (SELECT SUM(`withdrawdetail`.`withdrawqty`) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` <= '".$lastdayoldmonth."')), 0)
    +
    COALESCE((SELECT CONVERT(SUM(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0) -
    COALESCE((SELECT SUM(`withdrawdetail`.`withdrawqty`) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0))
    AS Lakhakhongluea"),
    
    DB::raw("COALESCE(((SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / 
      (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."'))
      * 
      ((SELECT CONVERT(SUM(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."')
      -(SELECT CONVERT(SUM(`withdrawdetail`.`withdrawqty`), CHAR) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` <= '".$lastdayoldmonth."')), 0)
      +
      COALESCE(
      (SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."') *
      (SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0)
      -
      COALESCE(
      ((SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / 
      (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."')) *
      (SELECT CONVERT(SUM(`withdrawdetail`.`withdrawqty`), CHAR) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0)
      AS Luamlakhakhongluea")
    )->where('typesparesid', $req->input('typespares'))->get();
    $no = 1;
    // $typespares = DB::table('typespares')->orderBy('typesparename', 'asc')->get();
    return view('manage/stocker/stocksumsearch')->with('summary', $summary)->with('no', $no)->with('ymd', $lastdaycurmonth)->with('typespares', $req->input('typespares'));
  }

  public function fnPrintstocksearch(Request $req)
  {
    $lastdayoldmonth = date('Y-m-d', strtotime($req->input('ymd').'Last day of last month'));
    $firstdaycurmonth = date('Y-m-d', strtotime($req->input('ymd').'First day of this month'));
    $lastdaycurmonth = $req->input('ymd');
    $summary = DB::table('spares')->select('spares.*',
    DB::raw('(SELECT unitname FROM unitspare WHERE spares.unitid=unitspare.unitid) AS unitname'),

    DB::raw("COALESCE((SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') - (SELECT SUM(`withdrawdetail`.`withdrawqty`) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` <= '".$lastdayoldmonth."'), 0) AS Yordyokma"),

    DB::raw("(SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') AS SaliaYokyord"),

    DB::raw("((SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.receivedate <= '".$lastdayoldmonth."') / (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."')) 
    * ((SELECT CONVERT(SUM(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') - (SELECT CONVERT(SUM(`withdrawdetail`.`withdrawqty`), CHAR) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.withdrawid=`withdrawdetail`.withdrawid WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` <= '".$lastdayoldmonth."')) AS LuamYokyord"),

    DB::raw("COALESCE((SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0) AS Jamnuanhubkhao"),

    DB::raw("(SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."') / (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."') AS lakhahubkhao"),

    DB::raw("(SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."') * COALESCE((SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0) AS Luamlakhahubkhao"),

    DB::raw("COALESCE((SELECT SUM(`withdrawdetail`.`withdrawqty`) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0) AS jamnuanberk"),

    DB::raw("(SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') AS LakhaTonteun"),

    DB::raw("((SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / 
    (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."')) *
    (SELECT CONVERT(SUM(`withdrawdetail`.`withdrawqty`), CHAR) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."') AS LuamTonteun"),

    DB::raw("COALESCE(((SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') - (SELECT SUM(`withdrawdetail`.`withdrawqty`) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` <= '".$lastdayoldmonth."')), 0)
    +
    COALESCE((SELECT CONVERT(SUM(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0) -
    COALESCE((SELECT SUM(`withdrawdetail`.`withdrawqty`) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0) AS Khongluea"),

    DB::raw("(COALESCE(((SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / 
    (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."'))
    * 
    ((SELECT CONVERT(SUM(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."')
    -(SELECT CONVERT(SUM(`withdrawdetail`.`withdrawqty`), CHAR) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` <= '".$lastdayoldmonth."')), 0)
    +
    COALESCE(
    (SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."') *
    (SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0)
    -
    COALESCE(
    ((SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / 
    (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."')) *
    (SELECT CONVERT(SUM(`withdrawdetail`.`withdrawqty`), CHAR) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0))
    /
    (COALESCE(((SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') - (SELECT SUM(`withdrawdetail`.`withdrawqty`) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` <= '".$lastdayoldmonth."')), 0)
    +
    COALESCE((SELECT CONVERT(SUM(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0) -
    COALESCE((SELECT SUM(`withdrawdetail`.`withdrawqty`) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0))
    AS Lakhakhongluea"),
    
    DB::raw("COALESCE(((SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / 
      (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."'))
      * 
      ((SELECT CONVERT(SUM(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."')
      -(SELECT CONVERT(SUM(`withdrawdetail`.`withdrawqty`), CHAR) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` <= '".$lastdayoldmonth."')), 0)
      +
      COALESCE(
      (SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."') *
      (SELECT SUM(`receivedetail`.`receiveqty`) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0)
      -
      COALESCE(
      ((SELECT CONVERT(SUM(`receivedetail`.`receiveprice`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."') / 
      (SELECT CONVERT(COUNT(`receivedetail`.`receiveqty`), CHAR) FROM `receivedetail` INNER JOIN `receive` ON `receive`.`receiveid`=`receivedetail`.`receiveid` WHERE `receivedetail`.`sparesid`=`spares`.`sparesid` AND `receive`.`receivedate` <= '".$lastdayoldmonth."')) *
      (SELECT CONVERT(SUM(`withdrawdetail`.`withdrawqty`), CHAR) FROM `withdrawdetail` INNER JOIN `withdraw` ON `withdraw`.`withdrawid`=`withdrawdetail`.`withdrawid` WHERE `withdrawdetail`.`sparesid`=`spares`.`sparesid` AND `withdraw`.`withdrawdate` BETWEEN '".$firstdaycurmonth."' AND '".$lastdaycurmonth."'), 0)
      AS Luamlakhakhongluea")
    )->where('typesparesid', $req->input('typespares'))->get();

    $year = Str::substr($req->input('ymd'), 0, 4);
    $month = Str::substr($req->input('ymd'), 5, 3);
    $mixym = $month;
    $no = 1;
    // $typespares = DB::table('typespares')->orderBy('typesparename', 'asc')->get();
    return view('manage/stocker/stocksumprint')->with('summary', $summary)->with('no', $no)->with('year', $year)->with('month', $month);
  }
}
