@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
  {{-- <div class="wrapper"> --}}

  {{-- @include('manage.layout.nav') --}}
  {{-- @include('manage.layout.sidemenu') --}}

    <div class="container">

      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-md-12">
              <h4 class="text-center">ສ​າ​ທາ​ລະ​ນະ​ລັດ ປະ​ຊາ​ທິ​ປະ​ໄຕ ປະ​ຊາ​ຊົນ​ລາວ</h4>
              <h4 class="text-center">ສັນ​ຕິ​ພາບ ເອ​ກະ​ລາດ ປະ​ຊາ​ທິ​ປະ​ໄຕ ເອ​ກະ​ພາບ ວັດ​ທະ​ນະ​ຖາ​ວອນ</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <img src="{{ url('images/tslogo.png') }}" alt="logotirespeed" class="img-fluid">
            </div>
            <div class="col-md-6">
              <br><br>
              <h3 class="text-center"><b><u>ໃບ​ຮັບ​ເງິນ</u> (RECEIPT)</b></h3>
            </div>
          @foreach($receipts as $rec)
            <div class="col-md-3">
              <h4><b>ທາຍ​ສະ​ປີດ (TIRE SPEED)</b></h4>
              <h4>ເລກ​ທີ​ບິນ​: <b>{{ $rec->receiptid }}</b></h4>
              <h4>ວັນ​ທີ: <b>{{ $rec->receipt_date }}</b></h4>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
              <h4>ໄດ້​ຮັບ​ເງິນ​ຈາກ/Received From: _ _ _ _ <b>{{ $rec->receipt_from }}</b>_ _ _ _ </h4>
              <h4>ອີງ​ໃສ່​ໃບ​ຮຽກ​ເກັບ​ງິນ​ເລກ​ທີ/Refer to Invoice NO. _ _ _ _ _ _ <b>{{ $rec->invoiceid }}</b> _ _ _ _ _ _ ວັນ​ທີ/Date: _<b>{{ $rec->invoice_date }}</b>_</h4>
            </div>
          </div>
          @endforeach
          <div class="row">
            <div class="col-md-12">
              <table class="table">
                <thead>
                  <tr>
                    <th colspan="8" style="border: 1px solid black">
                      <h4><b>I. ລາຍ​ການ​ອະ​ໄຫຼ່</b></h4>
                    </th>
                  </tr>
                  <tr>
                    <th style="border: 1px solid black" class="text-center">
                      <h4>ລຳ​ດັບ<br>No.</h4>
                    </th>
                    <th style="border: 1px solid black" class="text-center">
                      <h4>ລະ​ຫັດ​ອະ​ໄຫຼ່<br>Spare ID</h4>
                    </th>
                    <th style="border: 1px solid black" class="text-center">
                      <h4>ລາຍ​ການ<br>List</h4>
                    </th>
                    <th style="border: 1px solid black" class="text-center">
                      <h4>ຫົວ​ໜ່ວຍ<br>Unit</h4>
                    </th>
                    <th style="border: 1px solid black" class="text-center">
                      <h4>ຈຳ​ນວນ<br>Quantity</h4>
                    </th>
                    <th style="border: 1px solid black" class="text-center">
                      <h4>ລາ​ຄາ/ຫົວ​ໜ່ວຍ<br>Price/Unit</h4>
                    </th>
                    <th style="border: 1px solid black" class="text-center">
                      <h4>ລວມ<br>Total</h4>
                    </th>
                    <th style="border: 1px solid black" class="text-center">
                      <h4>ໝາຍ​ເຫດ<br>Remark</h4>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($receiptlist as $recl)
                  <tr>
                    <td class="text-center" style="border: 1px solid black"> {{ $i++ }}</td>
                    <td class="text-center" style="border: 1px solid black">{{ $recl->sparesid }}</td>
                    <td style="border: 1px solid black">{{ $recl->sparesname }}</td>
                    <td class="text-center" style="border: 1px solid black">{{ $recl->unitname }}</td>
                    <td class="text-center" style="border: 1px solid black">{{ $recl->qty }}</td>
                    <td class="text-right" style="border: 1px solid black">{{ $recl->price }}</td>
                    <td class="text-right" style="border: 1px solid black">{{ $recl->price * $recl->qty }}</td>
                    <td style="border: 1px solid black">{{ $recl->remark }}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <th colspan="8" style="border: 1px solid black">
                      <h4><b>II. ຄ່າ​ແຮງ​ງານ</b></h4>
                    </th>
                  </tr>
                  <tr>
                    <th style="border: 1px solid black" class="text-center">
                      <h4>ລຳ​ດັບ<br>No.</h4>
                    </th>
                    <th style="border: 1px solid black" class="text-center" colspan="5">
                      <h4>ລາຍ​ການ<br>List</h4>
                    </th>
                    <th style="border: 1px solid black" class="text-center">
                      <h4>ລາ​ຄາ<br>Price</h4>
                    </th>
                    <th style="border: 1px solid black" class="text-center">
                      <h4>ໝາຍ​ເຫດ<br>Remark</h4>
                    </th>
                  </tr>
                  @foreach($wages as $wage)
                  <tr>
                    <td style="border: 1px solid black" class="text-center">{{ $w++ }}</td>
                    <td style="border: 1px solid black" colspan="5">{{ $wage->wagename }}</td>
                    <td style="border: 1px solid black" class="text-right">{{ $wage->cost }}</td>
                    <td style="border: 1px solid black"></td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <th class="text-center" colspan="6" style="border: 1px solid black"><b>ລວມ/TOTAL: </b></td>
                  <td class="text-right" colspan="2" style="border: 1px solid black"><b>{{ $sumspares+$sumwages }}</b></td>
                </tfoot>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <h4 class="text-center"><b><u>ຜູ້ກວດ​ກາ</u></b></h4>
              <br><br>
              <h5 class="ml-30">ລາຍ​ເຊັນ: _ _ _ _ _ _ _ _ _ _ _ _ _</h5>
              <h5 class="ml-30">ຊື່​ແຈ້ງ: _ _ _ _ _ _ _ _ _ _ _ _ _ _</h5>
            </div>
            <div class="col-md-4">
              <h4 class="text-center"><b><u>ຜູ້​ຈ່າຍ​ເງິນ/Payer</u></b></h4>
              <br><br>
              <h5 class="ml-30">ລາຍ​ເຊັນ: _ _ _ _ _ _ _ _ _ _ _ _ _</h5>
              <h5 class="ml-30">ຊື່​ແຈ້ງ: _ _ _ _ _ _ _ _ _ _ _ _ _ _</h5>
            </div>
            <div class="col-md-4">
              <h4 class="text-center"><b><u>ຜູ້​ຮັບ​ເງິນ/Collector</u></b></h4>
              <br><br>
              <h5 class="ml-30">ລາຍ​ເຊັນ: _ _ _ _ _ _ _ _ _ _ _ _ _</h5>
              <h5 class="ml-30">ຊື່​ແຈ້ງ: _ _ _ _ _ _ _ _ _ _ _ _ _ _</h5>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="text-center">
                <a class="btn btn-primary" href="{{ url($url) }}" id="btnBack"><i class="mdi mdi-arrow-left-bold-circle"></i> ກັບ​ຄືນ</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  {{-- </div> --}}

@include('manage.layout.foot')
<script>
  $(document).ready(function(){
    window.onload = function(){
      $('#btnBack').hide();
      window.print();
    }
    window.onafterprint = function(){
      $('#btnBack').show();
    }
  })
</script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif