@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
<style type="text/css" media="print">
    @page { size: landscape; }
</style>
    {{-- <div class="wrapper"> --}}

        {{-- @include('manage.layout.nav') --}}

        {{-- @include('manage.layout.sidemenu') --}}

        {{-- <div class="container-fluid mt-30"> --}}

            <div class="row">
              <div class="col-lg-12">
                <img src="{{ url('images/header.png') }}" class="img-fluid">
                <br>
                <h3 class="text-center"><b>ລາຍ​ງານ​ຂໍ້​ມູນ​ລູກ​ຄ້າ</b></h3>
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-light table-bordered table-striped">
                        <thead>
                          <tr>
                            <th class="text-center">ລະ​ຫັດ​</th>
                            <th class="text-center">ຊື່​ ແລະ ນາມ​ສະ​ກຸນ</th>
                            <th class="text-center">​ບ້ານ​ຢູ່</th>
                            <th class="text-center">​ເມືອງ</th>
                            <th class="text-center">ແຂວງ</th>
                            <th class="text-center">​ເບີ​ມື​ຖື</th>     
                            <th class="text-center">​ເບີ​ໂທ​ສຸກ​ເສີນ</th>
                            <th class="text-center">ອາ​ຊີບ</th>
                            <th class="text-center">ບ່ອນ​ເຮັດ​ວຽກ</th>
                            <th class="text-center">​ປະ​ເພດ​ລູກ​ຄ້າ</th>
                            <th class="text-center">​ເຄີຍ​ໃຊ້​ບໍ​ລິ​ການ​ບໍ່</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if (count($customers) > 0)
                          @foreach($customers as $cus)
                          <tr>
                            <td>{{ $cus->cusid }}</td>
                            <td>{{ $cus->name }} {{ $cus->lastname }}</td>
                            <td>{{ $cus->village }}</td>
                            <td>{{ $cus->disname }}</td>
                            <td>{{ $cus->proname }}</td>
                            <td>{{ $cus->mobile }}</td>
                            <td>{{ $cus->phone }}</td>
                            <td>{{ $cus->occupation }}</td>
                            <td>{{ $cus->workaddress }}</td>
                            <td>{{ $cus->tcusname }}</td>
                            <td>{{ $cus->status }}</td>
                          </tr>
                          @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="10" class="text-right">ຈຳ​ນວນ​ລູກ​ຄ້າ::</td>
                            <td class="text-center"><b id="showcount">{{ $count }}</b></td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="text-center">
                      <a class="btn btn-info" href="{{ url('/reportcustomer') }}" id="btnBack"><i class="mdi mdi-arrow-left-bold-circle"></i> ກັບ​ຄືນ</a>
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