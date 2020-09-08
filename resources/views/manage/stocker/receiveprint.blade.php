@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
    {{-- <div class="wrapper"> --}}

      <div class="container-fluid">

        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-md-12">
                <img class="img-fluid" src="{{ url('images/header.png') }}" alt="header">
              </div>
            </div>
            @if (count($receives) > 0)
              @foreach ($receives as $rc)
              <div class="row">
                <div class="col-md-4">
                  <p></p>
                  <h3>ສູນ​ບໍ​ລິ​ການ​ສ້ອມ​ແປງ</h3>
                </div>
                <div class="col-md-4">
                  <p></p>
                  <h2 class="text-center"><u>ໃບ​ຮັບ​ເຄື່ອງ​ອະ​ໄຫຼ່</u></h2>
                </div>
                <div class="col-md-4">
                  <h6 class="text-right">ລະ​ຫັດ​ໃບ​ສັ່ງ​ຊື້: <b>{{ $rc->receiveid }}</b></h6>
                  <h6 class="text-right">ວັນ​ທີ່: {{ $rc->receivedate }}</h6>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">
                  <h6>ຊື່​ຜູ້​ຮັບ: <b>{{ $rc->userreceive }}</b></h6>
                </div>
                <div class="col-md-6">
                  <h6>ຜູ້​ສົ່ງ: <b>{{ $rc->sendername }}</b></h6>
                </div>
              </div>
              @endforeach
            @endif
            <div class="row">
              <div class="col-md-12">
                <table class="table table-bordered table-striped">
                  <thead class="text-center">
                    <tr>
                      <th>ລຳ​ດັບ</th>
                      <th>ລາຍ​ການ</th>
                      <th>ຫົວ​ໜ່ວຍ</th>
                      <th>ຈຳ​ນວນ</th>
                      <th>ໝາຍ​ເຫດ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (count($receivedetail) > 0)
                      @foreach ($receivedetail as $rcd)
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $rcd->sparesname }}</td>
                        <td>{{ $rcd->unitname }}</td>
                        <td>{{ $rcd->receiveqty }}</td>
                        <td>{{ $rcd->remark }}</td>
                      </tr>
                      @endforeach
                    @endif
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="2" class="text-center">ລ​ວມ: <b>{{ $count }}</b> ລາຍ​ການ</td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-3">
                <h4 class="text-center"><u>ຜູ້​ອະ​ນຸ​ມັດ</u></h4>
              </div>
              <div class="col-md-3">
                <h4 class="text-center"><u>​ຜູ້​ເຫັນ​ດີ</u></h4>
              </div>
              <div class="col-md-3">
                <h4 class="text-center"><u>​ຜູ້​ຮັບ​ເຄື່ອງ</u></h4>
              </div>
              <div class="col-md-3">
                <h4 class="text-center"><u>​ຜູ້ມອບ​ເຄື່ອງ</u></h4>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="text-center">
                  <a class="btn btn-info" href="{{ url($url) }}" id="btnBack"><i class="mdi mdi-arrow-left-bold-circle"></i> ກັບ​ຄືນ</a>
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