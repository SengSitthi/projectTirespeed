@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
  <div class="wrapper">

  @include('manage.layout.nav')
  @include('manage.layout.sidemenu')

    <div class="container-fluid mt-30">

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header bg-transparent py-15">
              <h3>ສະ​ຫຼຸບ​ສະ​ຕ໋ອກ</h3>
            </div>
            <div class="card-body">
              <form class="row" action="{{ url('printstocksearch') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="ymd" id="ymd" value="{{ $ymd }}">
                <input type="hidden" name="typespares" id="typespares" value="{{ $typespares }}">
                <div class="col-md-12 text-right">
                  <div class="form-group">
                    <button class="btn btn-success" type="submit"><i class="mdi mdi-file-document-box-search"></i> ພິມ​ການ​ຄົ້ນ​ຫາ​ນີ້</button>
                    <button class="btn btn-primary" type="button"><a href="{{ url('stocksummary') }}"><i class="mdi mdi-arrow-left-bold-box"></i> ກັບ​ຄືນ​ໜ້າ​ຄົ້ນ​ຫາ</a></button>
                  </div>
                </div>
              </form>
              <div class="row">
                <table class="table table-striped table-bordered table-responsive">
                  <thead>
                    <tr>
                      <th>ລຳ​ດັບ</th>
                      <th>​ລະ​ຫັດ</th>
                      <th>​ຊື່</th>
                      <th>ຫົ​ວ​ໜ່ວຍ</th>
                      <th>ຈ/ນ​ຍົກ​ຍອດ</th>
                      <th>ລາ​ຄາ​ສະ​ເລ່ຍ</th>
                      <th>ລວມ​ມູນ​ຄ່າ​ຍົກ​ຍອດ</th>
                      <th>ຈ/ນ​ຮັບ​ເຂົ້າ</th>
                      <th>ລາ​ຄາ​ຊື້</th>
                      <th>ລວມ​ຊື້</th>
                      <th>ຈ/ນ​ເບີກ</th>
                      <th>ລາ​ຄາ​ຕົ້ນ​ທຶນ</th>
                      <th>ລວມ​ຕົ້ນ​ທຶນ</th>
                      <th>ຈ/ນ​ຄົງ​ເຫຼືອ</th>
                      <th>ລາ​ຄາ​ຄົງ​ເຫຼືອ</th>
                      <th>ລວມ​ຄົງ​ເຫຼືອ</th>
                      <th>ລາ​ຄາ​ຂາຍ</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($summary) > 0)
                    @foreach($summary as $sum)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $sum->sparesid }}</td>
                        <td>{{ $sum->sparesname }}</td>
                        <td>{{ $sum->unitname }}</td>
                        <td>{{ $sum->Yordyokma }}</td>
                        <td>{{ number_format($sum->SaliaYokyord) }}</td>
                        <td>{{ number_format($sum->LuamYokyord) }}</td>
                        <td>{{ $sum->Jamnuanhubkhao }}</td>
                        <td>{{ number_format($sum->lakhahubkhao) }}</td>
                        <td>{{ number_format($sum->Luamlakhahubkhao) }}</td>
                        <td>{{ $sum->jamnuanberk }}</td>
                        <td>{{ number_format($sum->LakhaTonteun) }}</td>
                        <td>{{ number_format($sum->LuamTonteun) }}</td>
                        <td>{{ $sum->Khongluea }}</td>
                        <td>{{ number_format($sum->Lakhakhongluea) }}</td>
                        <td>{{ number_format($sum->Luamlakhakhongluea) }}</td>
                        <td>{{ number_format($sum->sellprice) }}</td>
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
              {{-- <div class="row">
                <div class="text-center">
                  {{ $summary->render() }}
                </div>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

@include('manage.layout.foot')

@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif