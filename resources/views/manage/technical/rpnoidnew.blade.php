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
              <div class="row">
                <div class="col-md-8">
                  <h3>ເພີ່ມ​ລະ​ຫັດ​ສ້ອມ​ໃໝ່</h3>
                </div>
                <div class="col-md-4 text-right">
                  <a href="{{ url('rpnoidlist') }}" class="btn btn-primary"><i class="mdi mdi-link"></i> ໜ້າລາຍ​ການລະ​ຫັດ​ສ້ອມ</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              @if (Session::get('success'))
                <script>swal("ສຳ​ເລັດ","ການ​ເພີ່ມ​ຂໍ້​ມູນ​ສຳ​ເລັດ!","success", {button: false, timer: 3000});</script>
              @endif
              @if (Session::get('error'))
                <script>swal("ຜິດ​ພາດ","​ລະ​ຫ​ັດ​ນີ້​ມີ​ໃນ​ລະ​ບົບ​ແລ້ວ!","error", {button: false, timer: 3000});</script>
              @endif
              <div class="row">
                @error('sparesid')
                  <script>swal("ຜິດ​ພາດ", "ກະ​ລຸ​ນາ​ເລືອກ​ອະ​ໄຫຼ່​ກ່ອນ","warning");</script>
                @enderror
                <div class="col-md-3"></div>
                <div class="col-md-6 col-sm-12">
                  <form action="{{ url('insertnewrpno') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="repairid">ລະ​ຫັດ​ສ້ອມ</label>
                      <input id="repairid" class="form-control" type="text" name="repairid" required oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​ລະ​ຫັດ​ສ້ອມ​ກ່ອນ!')"
                      oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group">
                      <label for="typesparesid">ລະ​ບົບ​ການ​ສ້ອມ</label>
                      <select id="typesparesid" class="form-control" name="typesparesid">
                        <option value="">ເລືອກ​ລະ​ບົບ​ການ​ສ້ອມ</option>
                        @if (count($typespares) > 0)
                          @foreach ($typespares as $tsp)
                            <option value="{{ $tsp->typesparesid }}">{{ $tsp->typesparename }}</option>
                          @endforeach
                        @else
                          <option value="">ບໍ່​ມີລະ​ບົບ​ການ​ສ້ອມ</option>
                        @endif
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="sparesid">ອະ​ໄຫຼ່</label>
                      <select id="sparesid" class="form-control" name="sparesid">
                        <option value="">ເລືອກ​ອະ​ໄຫຼ່</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <div class="text-center">
                        <button class="btn btn-success" type="submit"><i class="mdi mdi-content-save"></i> ບັນ​ທຶກ</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

@include('manage.layout.foot')
<script src="{{ url('includes/technical/addrpid.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif