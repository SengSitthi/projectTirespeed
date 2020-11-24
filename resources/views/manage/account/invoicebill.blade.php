@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
  {{-- <div class="wrapper"> --}}
    <div class="container">

      <div class="row">
        <div class="col-md-12">
          <img class="img-fluid" src="{{ url('images/header.png') }}" alt="headwer">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h3 class="text-center mt-30"><b><u>ໃບ​ຮຽກ​ເກັບ​ເງິນ</u></b></h3>
        </div>
      </div>
      @foreach ($invoices as $inv)
      <div class="row">
        <div class="col-md-9">
          <h5><b><u>ເຖິງ:</u></b> {{ $inv->cpname }}</h5>
          <h5>&emsp;&emsp; <b>{{ $inv->address }}</b></h5>
          <h5>&emsp;&emsp;ໂທ​ລະ​ສັບ: <b>{{ $inv->phone }}</b>, ແຟັກ: <b>{{ $inv->fax }}</b></h5>
        </div>
        <div class="col-md-3">
          <h4>ເລກ​ທີ: <b>{{ $inv->invoiceid }}</b></h4>
          <h4>ວັນ​ທີ່: <b>{{ $inv->invoice_date }}</b></h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <h5>ທະ​ບຽນ​ລົດ: <b>{{ $inv->license }}</b></h5>
          <h5>ຍີ່​ຫໍ້/ລຸ້ນ: <b>{{ $inv->brandname }}</b></h5>
        </div>
        <div class="col-md-4">
          <h5>ເລກ​ຈັກ: <b>{{ $inv->motornum }}</b></h5>
          <h5>ເລກ​ຖັງ: <b>{{ $inv->bodynum }}</b></h5>
        </div>
        <div class="col-md-4">
          <h5>ຊື່​ທະ​ນາ​ຄານ: <b>ທະ​ນາ​ຄານ​ພົງ​ສະ​ຫວັນ</b></h5>
          <h5>ຊື່​ບັນ​ຊີ: <b>Sitthi Logistic Lao Co.,Ltd (Service)</b></h5>
          <h5>ເລກ​ບັນ​ຊ​ີ: <b>020.8.05.00.01420</b></h5>
        </div>
      </div>
      @endforeach
      <div class="row">
        <table class="table table-light table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="border: 2px solid black">I.</th>
              <th colspan="9" style="border: 2px solid black">ຄ່າ​ອະ​ໄຫຼ່​ສ້ອມ​ແປງ</th>
            </tr>
            <tr class="text-center">
              <th style="border: 2px solid black">ລຳ​ດັບ</th>
              <th style="border: 2px solid black">ລະ​ຫັດ​ບໍ​ລິ​ການ</th>
              <th style="border: 2px solid black">​ລາຍ​ການ</th>
              <th style="border: 2px solid black">​ຈຳ​ນວນ</th>
              <th style="border: 2px solid black">​ຫົວ​ໜ່ວຍ</th>
              <th style="border: 2px solid black">​ລາ​ຄາ</th>
              <th style="border: 2px solid black">ລວມ</th>
              <th style="border: 2px solid black">ສ່ວນຫຼຸດ</th>
              <th style="border: 2px solid black">ມູນ​ຄ່າ</th>
              <th style="border: 2px solid black">ໝາຍ​ເຫດ</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($inlist as $inl)
            <tr>
              <td class="text-center" style="border: 2px solid black">{{ $i++ }}</td>
              <td style="border: 2px solid black">{{ $inl->rpnoid }}</td>
              <td style="border: 2px solid black">{{ $inl->sparesname }}</td>
              <td style="border: 2px solid black">{{ $inl->qty }}</td>
              <td style="border: 2px solid black">{{ $inl->unitname }}</td>
              <td style="border: 2px solid black">{{ number_format($inl->price) }} ກີບ</td>
              <td style="border: 2px solid black">{{ number_format($inl->total) }} ກີບ</td>
              <td style="border: 2px solid black">{{ $inl->discount }}</td>
              <td style="border: 2px solid black">{{ number_format($inl->total-$inl->discount) }} ກີບ</td>
              <td style="border: 2px solid black">{{ $inl->remark }}</td>
            </tr>
            @endforeach
            
            <tr>
              <th colspan="6" class="text-right" style="border: 2px solid black">ລວມ​ອະ​ໄຫຼ່=</th>
              <td colspan="2" class="text-right" style="border: 2px solid black"><b>{{ number_format($sumspares) }} ກີບ</b></td>
              <td colspan="2" class="text-right" style="border: 2px solid black"></td>
            </tr>
            <tr>
              <th class="text-center" style="border: 2px solid black">II.</th>
              <th colspan="9" style="border: 2px solid black">ຄ່າ​ແຮງ​ງານ​ສ້ອມ​ແປງ</th>
            </tr>
            <tr class="text-center">
              <th style="border: 2px solid black">ລຳ​ດັບ</th>
              <th style="border: 2px solid black">ລະ​ຫັດ​ແຮງ​ງານ</th>
              <th style="border: 2px solid black" colspan="4">ລາຍ​ການຄ່າ​ແຮງ​ງານສ້ອມ</th>
              <th style="border: 2px solid black" colspan="2">ຄ່າ​ແຮງ​ງານ</th>
              <th style="border: 2px solid black" colspan="2"></th>
            </tr>
            @foreach ($wages as $wg)
            <tr>
              <td class="text-center" colspan="0" style="border: 2px solid black">{{ $w++ }}</td>
              <td colspan="0" style="border: 2px solid black">{{ $wg->wageid }}</td>
              <td colspan="4" style="border: 2px solid black">{{ $wg->wagename }}</td>
              <td class="text-right" colspan="2" style="border: 2px solid black">{{ number_format($wg->cost) }} ກີບ</td>
              <td class="text-right" colspan="2" style="border: 2px solid black"></td>
            <tr>
            @endforeach
              <th class="text-right" colspan="6" style="border: 2px solid black">ຄ່າ​ແຮງ​ງານ</th>
              <th class="text-right" colspan="2" style="border: 2px solid black">{{ number_format($sumwages) }} ກີບ</th>
              <td colspan="2" style="border: 2px solid black"></td>
            </tr>
            <tr>
              <th class="text-right" colspan="6" style="border: 2px solid black">ລ​ວ​ມ​ທັງ​ໝົດ I+II=</th>
              <th class="text-right" colspan="2" style="border: 2px solid black"><b>{{ number_format($sumspares+$sumwages) }} ກີບ</b></th>
              <td class="text-right" colspan="2" style="border: 2px solid black"></td>
            </tr>
            <tr>
              <td colspan="8" class="text-right">ລວມ​ມູນ​ຄ່າ​ບໍ່​ມີ​ອາ​ກອນ</td>
              <th class="text-right" colspan="2" style="border: 2px solid black"><b>{{ number_format($sumspares+$sumwages) }} ກີບ</b></th>
            </tr>
            <tr>
              <td colspan="8" class="text-right">​ສ່ວນຫຼຸດ</td>
              <th class="text-right" colspan="2" style="border: 2px solid black"><b>{{ number_format($sumspares+$sumwages) }} ກີບ</b></th>
            </tr>
            <tr>
              <td colspan="8" class="text-right">​ລວມ​ມູນ​ຄ່າ​ທັງ​ໝົດ</td>
              <th class="text-right" colspan="2" style="border: 2px solid black"><b>{{ number_format($sumspares+$sumwages) }} ກີບ</b></th>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h4><b>ຈຳ​ນວນ​ເງິນ​ເປັນ​ຕົວ​ໜັງ​ສື: _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</b></h4>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-4">
          <h4 class="text-center"><b>ຜູ້​ຮັບ​ວາງ​ບິນ</b></h4>
        </div>
        <div class="col-md-4">
          <h4 class="text-center"><b>​ຜູ້​ຈັດ​ການ​ສູນ</b></h4>
        </div>
        <div class="col-md-4">
          <h4- class="text-center"><b>​ຜູ້​ຮຽກ​ເກັບ​ເງິນ</b></h4>
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