<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccInvoiceController extends Controller
{
  // index account page
  public function fnNewInvoice()
  {
    return view('manage/account/newinvoice');
  }
}
