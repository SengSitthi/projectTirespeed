@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
  <div class="wrapper">

  @include('manage.layout.nav')
  @include('manage.layout.sidemenu')

    <div class="container-fluid mt-30">

      @error('typespares')
            <div class="amaran-wrapper bottom right">
              <div class="amaran-wrapper-inner">
                <div class="amaran awesome error" style="display: block;">
                  <i class="icon fa fa-ban icon-large"></i>
                  <p class="bold">ຜິດ​ພາດ!</p>
                  <p><span>​ທ່ານ​ຍັງ​ບໍ່​ໄດ້​ເລືອກປະ​ເພດ​ອະ​ໄຫຼ່</span>
                    <span class="light">​ກະ​ລ​ຸ​ນາ​ເລືອກ​​​ປະ​ເພດ​ອະ​ໄຫຼ່​ກ່ອນ</span>
                  </p>
                </div>
              </div>
            </div>
          @enderror

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header bg-transparent py-15">
              <h3>ສະ​ຫຼຸບ​ສະ​ຕ໋ອກ</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <h4 class="text-center">ຄົ້ນ​ຫາ​ຂໍ້​ມູນ</h4>
                </div>
              </div>
              <form class="row" action="{{ url('stocksumsearch') }}" method="POST">
                {{ csrf_field() }}
                <div class="col-md-3"></div>
                <div class="col-md-3">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-append">
                        <span class="input-group-text" id="">ເລືອກວັນ​ທີ່</span>
                      </div>
                      <input type="text" name="ymd" id="ymd" class="form-control" placeholder="ເລືອກວັນ​ທີ່​ເດືອນ​ປີ" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-append">
                        <span class="input-group-text" id="">ປະ​ເພດ​ອະ​ໄຫຼ່</span>
                        <select id="typespares" class="form-control" name="typespares">
                          <option value="">ເລ​ືອກ​ປະ​ເພດ​ອະ​ໄຫຼ່</option>
                          @if(count($typespares) > 0)
                            @foreach($typespares as $ts)
                            <option value="{{ $ts->typesparesid }}">{{ $ts->typesparename }}</option>
                            @endforeach
                          @else
                            <option value="">ບໍ່​ມີ​ປະ​ເພດ​ໃນ​ລະ​ບົບ</option>
                          @endif
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-table-search"></i> ຄົ້ນ​ຫາ</button>
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
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $sum->sparesid }}</td>
                        <td>{{ $sum->sparesname }}</td>
                        <td>{{ $sum->unitname }}</td>
                        <td class="text-center">{{ $sum->Yordyokma }}</td>
                        <td>{{ number_format($sum->SaliaYokyord) }}</td>
                        <td>{{ number_format($sum->LuamYokyord) }}</td>
                        <td class="text-center">{{ $sum->Jamnuanhubkhao }}</td>
                        <td>{{ number_format($sum->lakhahubkhao) }}</td>
                        <td>{{ number_format($sum->Luamlakhahubkhao) }}</td>
                        <td class="text-center">{{ $sum->jamnuanberk }}</td>
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
                        <h3 class="text-center text-danger">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ເດືອນ​ນີ້</h3>
                      </td>
                    </tr>
                  @endif
                  </tbody>
                </table>
              </div>
              <div class="row">
                <div class="text-center">
                  {{ $summary->render() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

@include('manage.layout.foot')
<script>
  $(document).ready(function(){
    $('#ymd').bootstrapMaterialDatePicker
    ({
        time: false,
        clearButton: true
    });
    setTimeout(function(){
      $('.amaran-wrapper').fadeOut();
    }, 3500);
  })
</script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif