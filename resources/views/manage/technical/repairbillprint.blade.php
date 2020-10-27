@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
  {{-- <div class="wrapper"> --}}

  {{-- @include('manage.layout.nav') --}}
  {{-- @include('manage.layout.sidemenu') --}}

    <div class="container-fluid mt-30">

      <div class="row">
        <div class="col-lg-12">
          <table class="table">
            <tbody>
              @foreach($rpbpersonaldata as $rpdt)
              <tr>
                <td colspan="4" style="border: 2px solid black; width: 70%">
                  <img src="{{ url('images/header.png') }}" alt="header-img" class="img-fluid">
                </td>
                <td colspan="2" style="border: 2px solid black">
                  <h4 class="text-center"><b>ໃບເປີດ​ງານ​ສ້ອມ (Open Job Form)</b></h4>
                  <h6>ເລກ​ທີ​ໃບ​ສັ່ງ​ສ້ອມ: <b>{{ $rpdt->rpbid }}</b></h6>
                  <h6>ວັນທີ​ອອກໃບ​ສັ່ງ​ສ້ອມ: <b>{{ $rpdt->rpbdate }}</b></h6>
                </td>
              </tr>
              <tr>
                <th colspan="3" style="border: 2px solid black; width: 50%">
                  <h5 class="text-center"><b>I. ຂໍ​້​ມູນ​ລູກ​ຄ້າ</b></h5>
                </th>
                <th colspan="3" style="border: 2px solid black width: 50%">
                  <h5 class="text-center"><b>II. ຂໍ້​ມູນ​ລົດ</b></h5>
                </th>
              </tr>
              <tr>
                <td colspan="3" style="border: 2px solid black">
                  <h6>ຊື່ ແລະ ນາມ​ສະ​ກຸນ: <b>{{ $rpdt->name }} {{ $rpdt->lastname }}</b></h6>
                  <h6>ເບີ​ໂທ: <b>{{ $rpdt->mobile }}, {{ $rpdt->phone }}</b></h6>
                  <h6>ທີ່​ຢູ່: <b>{{ $rpdt->village }}, {{ $rpdt->disname }}, {{ $rpdt->proname }}</b></h6>
                  <h6>ບໍ​ລິ​ສັດ: <b>{{ $rpdt->workaddress }}</b></h6>
                </td>
                <td colspan="3" style="border: 2px solid black">
                  <h6>ທະ​ບຽນ​ລົດ: <b>{{ $rpdt->license }}</b>&emsp; ຍີ່​ຫໍ້ລົ​ດ: <b>{{ $rpdt->brandname }}</b></h6>
                  <h6>ລຸ້ນ​ລົດ: <b>{{ $rpdt->model }}</b>&emsp; ສີ: <b>{{ $rpdt->color }}</b>&emsp; ປີ​ຜະ​ລິດ <b>{{ $rpdt->madeyear }}</b></h6>
                  <h6>ປະ​ເພດ​ລົດ: <b>{{ $rpdt->motor }}</b> </h6>
                  <h6>ເລ​ກ​ຈັກ​: <b>{{ $rpdt->motornum }}</b>&emsp; ເລກ​ຖັງ: <b>{{ $rpdt->bodynum }}</b></h6>
                </td>
              </tr>
              @endforeach
            </tbody>
            <tbody>
              <tr>
                <td colspan="6" style="border: 2px solid black">
                  <h5><b>III. ລາຍ​ການ​ອະ​ໄຫຼ່​ທີ່​ຕ້ອງ​ໃຊ້</b></h5>
                </td>
              </tr>
              <tr>
                <th style="border: 2px solid black">
                  <h6 class="text-center"><b>ລຳ​ດັບ</b></h6>
                </th>
                <th style="border: 2px solid black">
                  <h6 class="text-center"><b>ລະ​ຫັດ​ບໍ​ລິ​ການ</b></h6>
                </th>
                <th style="border: 2px solid black">
                  <h6 class="text-center">​<b>ລະ​ຫັດ​ອະ​ໄຫຼ່</b></h6>
                </th>
                <th colspan="2" style="border: 2px solid black">
                  <h6 class="text-center"><b>​ຊື່​ອະ​ໄຫຼ່</b></h6>
                </th>
                <th style="border: 2px solid black">
                  <h6 class="text-center"><b>​ຈຳ​ນວນ/ຫົວ​ໜ່ວຍ</b></h6>
                </th>
              </tr>
              @foreach($spares as $sp)
              <tr>
                <td style="border: 2px solid black" class="text-center">
                  <h6>{{ $no++ }}</h6>
                </td>
                <td style="border: 2px solid black">
                  <h6>{{ $sp->rpnoid }}</h6>
                </td>
                <td style="border: 2px solid black">
                  <h6>{{ $sp->sparesid }}</h6>
                </td>
                <td colspan="2" style="border: 2px solid black">
                  <h6>{{ $sp->sparesname }}</h6>
                </td>
                <td style="border: 2px solid black" class="text-center">
                  <h6>{{ $sp->useqty }}/{{ $sp->unitname }}</h6>
                </td>
              </tr>
              @endforeach
              <tr>
                <td colspan="6" style="border: 2px solid black">
                  <h5><b>IV. ຄ່າ​ແຮງ​ງານ</b></h5>
                </td>
              </tr>
              <tr>
                <td style="border: 2px solid black">
                  <h6 class="text-center"><b>ລຳ​ດັບ</b></h6>
                </td>
                <td style="border: 2px solid black">
                  <h6 class="text-center"><b>​ປະ​ເພດ​ລົ​ດ</b></h6>
                </td>
                <td style="border: 2px solid black">
                  <h6 class="text-center"><b>ລະ​ຫັດ​ແຮງ​ງານ</b></h6>
                </td>
                <td colspan="2" style="border: 2px solid black">
                  <h6 class="text-center"><b>​ແຮງ​ງານ</b></h6>
                </td>
                <td style="border: 2px solid black">
                  <h6 class="text-center"><b>​ຮັບ​ປະ​ກັນ</b></h6>
                </td>
              </tr>
              @foreach($wages as $w)
              <tr>
                <td style="border: 2px solid black" class="text-center">
                  <h6>{{ $no1++ }}</h6>
                </td>
                <td style="border: 2px solid black">
                  <h6>{{ $w->tcarname }}</h6>
                </td>
                <td style="border: 2px solid black">
                  <h6>{{ $w->wageid }}</h6>
                </td>
                <td colspan="2" style="border: 2px solid black">
                  <h6>{{ $w->wagename }}</h6>
                </td>
                <td style="border: 2px solid black">
                  <h6>{{ $w->guaranty }}</h6>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="row ml-4">
            <div class="col-md-4">
              <h5>.......................</h5>
              <h5>(ລູກ​ຄ້າ/ຜູ້​ອະ​ນຸ​ມັດ)</h5>
            </div>
            <div class="col-md-4">
              <h5>...................</h5>
              <h5>(ຫົວ​ໜ້າ​ຊ່າງ)</h5>
            </div>
            <div class="col-md-4">
              <h5>...................</h5>
              <h5>(ຊ່າງ)</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="text-center">
            <a class="btn btn-primary" href="{{ url($link) }}" id="btnBack"><i class="mdi mdi-arrow-left-bold-circle"></i> ກັບ​ຄືນ</a>
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