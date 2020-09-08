@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
<style type="text/css" media="print">
  @page { size: landscape; border: 5px; margin-top: -40px; margin-left: 3px; margin-right: 3px; }
</style>
<style>
  table{
    font-size: 9px;
    /* border: 1px solid black; */
    /* border-bottom: 1px solid black; */
  }
  th {
    font-size: 9px;
    border: 1px solid black;
    border-top: 1px solid black;
    /* align-items: center; */
    text-align: center
  }
  td {
    font-size: 8px;
    border: 1px solid black;
    /* padding: 0px; */
  }
</style>
    <div class="wrapper">

        {{-- @include('manage.layout.nav') --}}

        {{-- @include('manage.layout.sidemenu') --}}

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-7">
            <img class="img-fluid" src="{{ url('images/header.png') }}" alt="header" class="img-fluid">
          </div>
          <div class="col-md-5 text-center">
            <a class="btn btn-info" href="{{ url('stocksummary') }}" id="btnBack"><i class="mdi mdi-arrow-left-bold-circle"></i> ກັບ​ຄືນ</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h6 class="text-center">ສະຫຼຸບ​ສະ​ຕ໋ອກ​ອະ​ໄຫຼ່ ລົບ​ບັນ​ທຸກ + ລົດ​ໃຊ້​ສ່ວນ​ບຸກ​ຄົນ ປະ​ຈຳ​ເດືອນ <b>{{ $month }}{{ $year }}</b></h6>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            {{-- class="table table-responsive" --}}
            <table>
              <thead>
                <tr>
                  <th>ລຳ​ດັບ</th>
                  <th>​ລະ​ຫັດອະ​ໄຫຼ່</th>
                  <th>​ລາຍ​ການອະ​ໄຫຼ່</th>
                  <th>ຫົ​ວ​ໜ່ວຍ</th>
                  <th>ຈຳ​ນວນ​ຍົກ​ຍອດ</th>
                  <th>ລາ​ຄາ​ສະ​ເລ່ຍ​ຍົກ​ຍອດ</th>
                  <th>ລວມ​ມູນ​ຄ່າ​ຍົກ​ຍອດ</th>
                  <th>​ຈຳ​ນວນ​ຮັບ​ເຂົ້າ</th>
                  <th>ລາ​ຄາ​ຊື້</th>
                  <th>ລວມ​ລາ​ຄາ​ຊື້</th>
                  <th>ຈຳ​ນວນ​ເບີກ</th>
                  <th>ລາ​ຄາ​ຕົ້ນ​ທຶນ</th>
                  <th>ລວມ​ມູນ​ຄ່າ​​ຕົ້ນ​ທຶນ</th>
                  <th>ຈ​ຳ​ນວນ​ຄົງ​ເຫຼືອ</th>
                  <th>ລາ​ຄາ​​ສະ​ເລ່ຍຄົງ​ເຫຼືອ</th>
                  <th>ລວມ​ມູນ​ຄ່າ​ຄົງ​ເຫຼືອ</th>
                  <th>ໝາຍ​ເຫດ</th>
                </tr>
              </thead>
              <tbody>
                @if(count($summary) > 0)
                  @foreach($summary as $sum)
                  <tr>
                      <td style="text-align: center">{{ $no++ }}</td>
                      <td>{{ $sum->sparesid }}</td>
                      <td>{{ $sum->sparesname }}</td>
                      <td style="text-align: center">{{ $sum->unitname }}</td>
                      <td style="text-align: center">{{ $sum->Yordyokma }}</td>
                      <td style="text-align: right">{{ number_format($sum->SaliaYokyord) }}</td>
                      <td style="text-align: right">{{ number_format($sum->LuamYokyord) }}</td>
                      <td style="text-align: center">{{ $sum->Jamnuanhubkhao }}</td>
                      <td style="text-align: right">{{ number_format($sum->lakhahubkhao) }}</td>
                      <td style="text-align: right">{{ number_format($sum->Luamlakhahubkhao) }}</td>
                      <td style="text-align: center">{{ $sum->jamnuanberk }}</td>
                      <td style="text-align: right">{{ number_format($sum->LakhaTonteun) }}</td>
                      <td style="text-align: right">{{ number_format($sum->LuamTonteun) }}</td>
                      <td style="text-align: center">{{ $sum->Khongluea }}</td>
                      <td style="text-align: right">{{ number_format($sum->Lakhakhongluea) }}</td>
                      <td style="text-align: right">{{ number_format($sum->Luamlakhakhongluea) }}</td>
                      <td></td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="17">
                      <h3 class="text-center text-danger">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ລາຍ​ການ​ທີ່​ຄົ້ນ​ຫາ​ໃນເດືອນ​ນີ້</h3>
                    </td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
        {{-- <div class="row">
          <div class="col-lg-12">
            <div class="text-center">
              <a class="btn btn-info" href="{{ url('stocksummary') }}" id="btnBack"><i class="mdi mdi-arrow-left-bold-circle"></i> ກັບ​ຄືນ</a>
            </div>
          </div>
        </div> --}}
      </div>

    </div>

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