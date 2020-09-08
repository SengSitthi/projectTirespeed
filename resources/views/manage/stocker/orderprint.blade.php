@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
  {{-- <div class="wrapper"> --}}

    {{-- @include('manage.layout.nav') --}}

    {{-- @include('manage.layout.sidemenu') --}}

      {{-- <div class="container-fluid mt-30"> --}}

        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              @if(count($orders) > 0)
                @foreach($orders as $order)
                <div class="col-md-9" style="border-right: 1px solid #000">
                  <img src="{{ url('images/header.png') }}" alt="header" class="img-fluid" style="height: 100px; width: 100%">
                  <div class="row">
                    <div class="col-md-5">
                      <h5>ຊື່​ຜູ້​ສະ​ໜອງ/ຊື່​ຮ້ານ: <b style="text-decoration: underline dotted">{{ $order->suppliername }}</b></h5>
                      <h5>ເບີ​ມື​ຖື: <b>{{ $order->mobile }}</b></h5>
                    </div>
                    <div class="col-md-7">
                      <h5>ທີ່​ຢູ່: <b>{{ $order->village }}, {{ $order->disname }}, {{ $order->proname }}</b></h5>
                      <h5>ເບີ​ຕິດ​ຕໍ່: <b>{{ $order->phone }}</b></h5>
                    </div>
                  </div>
                </div>
                <div class="col-md-3" style="">
                  <h3 class="text-center"><b>ໃບ​ສະ​ເໜີ​ສັ່ງ​ຊື້​ອະ​ໄຫຼ່</b></h3>
                  <h4 class="text-center">Accessories Inform</h4>
                  <h5>ເລກ​ທີ​: <b>{{ $order->orderid }}</b></h5>
                  <h5>ວັນ​ທີ: <b>{{ $order->orderdate }}</b></h5>
                  <h5>ຜູ້​ຂໍ​ຊື້: <b>{{ $order->userorder }}</b></h5>
                </div>
                @endforeach
              @endif
            </div>
            <div class="row" style="margin-top: 1px">
              <div class="col-lg-12">
                <table class="table" style="border: 1px solid #000">
                  <thead style="border: 1px solid #000">
                    <tr>
                      <th style="border: 1px solid #000">ລຳ​ດັບ</th>
                      <th style="border: 1px solid #000">ລະ​ຫັດ​ອະ​ໄຫຼ່</th>
                      <th style="border: 1px solid #000">​ລາຍ​ການ</th>
                      <th style="border: 1px solid #000">ຍີ່​ຫໍ້ອະ​ໄຫຼ່</th>
                      <th style="border: 1px solid #000">ລຸ້ນອະ​ໄຫຼ່</th>
                      <th style="border: 1px solid #000">ປີ​ຜະລິດ​ລົດ</th>
                      <th style="border: 1px solid #000">ຈຳ​ນວນ</th>
                      <th style="border: 1px solid #000">ລາ​ຄາ</th>
                      <th style="border: 1px solid #000">ຫ​ົວ​ໜ່ວຍ</th>
                      <th style="border: 1px solid #000">ລວມ</th>
                      <th style="border: 1px solid #000">ໝາຍ​ເຫດ</th>
                    </tr>
                  </thead>
                  <tbody style="border: 1px solid #000">
                    @foreach ($orderdetail as $dt)
                    <tr>
                      <td style="border: 1px solid #000" class="text-center">{{ $i++ }}</td>
                      <td style="border: 1px solid #000">{{ $dt->sparesid }}</td>
                      <td style="border: 1px solid #000">{{ $dt->sparesname }}</td>
                      <td style="border: 1px solid #000">{{ $dt->brandsparename }}</td>
                      <td style="border: 1px solid #000">{{ $dt->model }}</td>
                      <td style="border: 1px solid #000" class="text-center">{{ $dt->madeyear }}</td>
                      <td style="border: 1px solid #000" class="text-center">{{ $dt->orderqty }}</td>
                      <td style="border: 1px solid #000"></td>
                      <td style="border: 1px solid #000">{{ $dt->unitname }}</td>
                      <td style="border: 1px solid #000"></td>
                      <td style="border: 1px solid #000">​</td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot style="border: 1px solid #000">
                    <tr>
                      <td colspan="6" class="text-center" style="border: 1px solid #000">ລວມ​ທັງ​ໝົດ <b>{{ $count }}</b> ລາຍ​ການ</td>
                      <td style="border: 1px solid #000" class="text-center">{{ $sumorderqty }}</td>
                      <td colspan="2" class="text-right" style="border: 1px solid #000">ລວມ​ລາ​ຄາ​ທັງ​ໝົດ</td>
                      <td class="text-center" colspan="2" style="border: 1px solid #000"><b></b></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <div class="row" style="margin-top: 30px">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-3">
                    <h5 class="text-center"><b><u>ພະ​ແນກ​ຈັດ​ຊື້</u></b></h5>
                  </div>
                  <div class="col-md-3">
                    <h5 class="text-center"><b><u>ຜູ້​ຈ​ັດ​ການ​ສ​ູນ</u></b></h5>
                  </div>
                  <div class="col-md-3">
                    <h5 class="text-center"><b><u>​ຜູ້​ເຫັນ​ດີ</u></b></h5>
                  </div>
                  <div class="col-md-3">
                    <h5 class="text-center"><b><u>​ຜູ້​ສະ​ເໜີ</u></b></h5>
                  </div>
                </div>
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
      {{-- </div> --}}

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