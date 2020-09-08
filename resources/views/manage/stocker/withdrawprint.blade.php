@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
    {{-- <div class="wrapper"> --}}

        <div class="container-fluid mt-30">

          <div class="row">
            <div class="col-lg-12">
              <div class="row">
                <div class="col-md-12">
                  <img class="img-fluid" src="{{ url('images/header.png') }}" alt="header" class="img-fluid">
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <p></p>
                  <h4>ສູນ​ບໍ​ລິ​ການ​ສ້ອມ​ແປງ</h4>
                </div>
                <div class="col-md-4">
                  <h2 class="text-center"><u>ໃບ​ເບີກ​ເຄື່ອງ​ອະ​ໄຫຼ່</u></h2>
                  <h2 class="text-center"><u>Payment Accessories</u></h2>
                </div>
              @foreach($withdraw as $wd)
                <div class="col-md-4">
                  <h4 class="text-right">ລະ​ຫັດ​ໃບ​ເບີກ: <b>{{ $wd->withdrawid }}</b></h4>
                  <h4 class="text-right">ວັນ​ທີ່​ເບີກ: <b>{{ $wd->withdrawdate }}</b></h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <h5>ຜູ້​ຂໍ​ເບີກ: <b style="text-decoration-line: underline; text-decoration-style: dashed">{{ $wd->userrequest }}</b></h5>
                </div>
                <div class="col-md-4">
                  <h5>ຜູ້​ເບີກອະ​ໄຫຼ່: <b style="text-decoration-line: underline; text-decoration-style: dashed">{{ $wd->userwithdraw }}</b></h5>
                </div>
                <div class="col-md-4">
                  <h5>ໃບ​ຮັບ​ລົດ/ເປີດ​ງານ​ເລ​ກ​ທີ: <b style="text-decoration-line: underline; text-decoration-style: dashed">{{ $wd->receivecartitle }}</b></h5>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <h5>ຊື່​ລູກ​ຄ້າ: <b style="text-decoration-line: underline; text-decoration-style: dashed">{{ $wd->name }}</b></h5>
                </div>
                <div class="col-md-3">
                  <h5>​ທະ​ບຽນ​ລົດ: <b style="text-decoration-line: underline; text-decoration-style: dashed">{{ $wd->license }}</b></h5>
                </div>
                <div class="col-md-3">
                  <h5>​ຍີ່​ຫໍ້​ລົດ: <b style="text-decoration-line: underline; text-decoration-style: dashed">{{ $wd->brandname }}</b></h5>
                </div>
              </div>
              @endforeach
              <div class="row">
                <table class="table table-bordered table-striped" style="border: 1px solid #000">
                  <thead class="">
                    <tr class="text-center">
                      <th style="border: 1px solid #000">
                        <h5>ລຳ​ດັບ</h5>
                        <h5>No.</h5>
                      </th>
                      <th style="border: 1px solid #000">
                        <h5>ລາຍ​ການ​ເບີກ​ເຄື່ອ​ງ​ອະ​ໄຫຼ່</h5>
                        <h5>List out</h5>
                      </th>
                      <th style="border: 1px solid #000">
                        <h5>ລະ​ຫັດ​ອະ​ໄຫຼ່</h5>
                        <h5>Series No</h5>
                      </th>
                      <th style="border: 1px solid #000">
                        <h5>ລະ​ຫັດ​ລຸ້ນ</h5>
                        <h5>Model No</h5>
                      </th>
                      <th style="border: 1px solid #000">
                        <h5>ຫົວ​ໜ່ວຍ</h5>
                        <h5>Unit</h5>
                      </th>
                      <th style="border: 1px solid #000">
                        <h5>ຈຳ​ນວນ</h5>
                        <h5>Qty</h5>
                      </th>
                      <th style="border: 1px solid #000">
                        <h5>ໝາຍ​ເຫດ</h5>
                        <h5>Remark</h5>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($withdrawdetail as $wdt)
                    <tr>
                      <td style="border: 1px solid #000">{{ $i++ }}</td>
                      <td style="border: 1px solid #000">{{ $wdt->sparesname }}</td>
                      <td style="border: 1px solid #000">{{ $wdt->sparesid }}</td>
                      <td style="border: 1px solid #000">{{ $wdt->model }}</td>
                      <td style="border: 1px solid #000">{{ $wdt->unitname }}</td>
                      <td style="border: 1px solid #000">{{ $wdt->withdrawqty }}</td>
                      <td style="border: 1px solid #000">{{ $wdt->remark }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <td style="border: 1px solid #000"></td>
                      <td colspan="3" style="border: 1px solid #000">
                        <h5 class="text-center">ລວມ​ຈຳ​ນວນ​ທັງ​ໝົດ/TOTAL: <b>{{ $count }}</b></h5>
                      </td>
                      <td style="border: 1px solid #000"></td>
                      <td style="border: 1px solid #000"></td>
                      <td style="border: 1px solid #000"></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <br>
              <div class="row">
                <div class="col-md-3">
                  <h4 class="text-center"><u>ສາງ​ອະ​ໄຫຼ່</u></h4>
                </div>
                <div class="col-md-3">
                  <h4 class="text-center"><u>ຜູ້​ອະ​ນຸ​ມັດ</u></h4>
                </div>
                <div class="col-md-3">
                  <h4 class="text-center"><u>ຜູ້​ເຫັນ​ດີ</u></h4>
                </div>
                <div class="col-md-3">
                  <h4 class="text-center"><u>ຜູ້​ຂໍ​ເບີກ​ອະ​ໄຫຼ່</u></h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="text-center">
                    <a class="btn btn-info" href="{{ url($url) }}" id="btnBack"><i class="mdi mdi-arrow-left-bold-circle"></i> ກັບ​ຄືນ</a>
                    {{-- <a class="btn btn-info" href="" id="btnBack"><i class="mdi mdi-arrow-left-bold-circle"></i> ກັບ​ຄືນ</a> --}}
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