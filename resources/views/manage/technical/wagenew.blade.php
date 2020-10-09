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
                  <h3>​ເພີ່ມ​ຄ່າ​ແຮງ​ງານ​ໃໝ່</h3>
                </div>
                <div class="col-md-4">
                  <a href="{{ url('wagelist') }}" class="btn btn-primary"><i class="mdi mdi-link"></i> ເບິ່ງ​ລາຍ​ການ​ຄ່າ​ແຮງ​ງານ</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                @error('typeserviceid')
                  <script>swal("ຜິດ​ພາດ", "ກະ​ລຸ​ນາ​ເລ​ືອກ​ປະ​ເພດ​ບໍ​ລິ​ການ​ກ່ອນ", "warning", {timer: 3000});</script>
                @enderror
                @error('typesparesid')
                  <script>swal("ຜິດ​ພາດ", "ກະ​ລຸ​ນາ​ເລ​ືອກ​ລະ​ບົບ​ຂອງ​ລົດ​ຍົນ​ກ່ອນ", "warning", {timer: 3000});</script>
                @enderror
                @if(Session::get('success'))
                  <script>swal("ສຳ​ເລັດ", "ການ​ບັນ​ທຶກ​ສຳ​ເລັດ", "success", {timer: 3000});</script>
                @endif
                @if(Session::get('error'))
                  <script>swal("ຜິດ​ພາດ", "​ລະ​ຫັດ​ນີ້​ມີ​ໃນ​ລະ​ບົບ​ແລ້ວ!", "warning", {timer: 3000});</script>
                @endif
                <div class="col-md-3"></div>
                <form class="col-md-6" action="{{ url('insertwage') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="row">
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="wageid">ລະ​ຫັດ​ຄ່າ​ແຮງ​ງານ</label>
                        <input id="wageid" class="form-control" type="text" name="wageid" placeholder="..." required oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່ລະ​ຫັດ​ຄ່າ​ແຮງ​ງານກ່ອນ!')"
                        oninput="this.setCustomValidity('')">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="wagename">ຊື່​ລາຍ​ການ​ຄ່າ​ແຮງ​ງານ</label>
                        <input id="wagename" class="form-control" type="text" name="wagename" placeholder="..." required oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​ຊື່​ລາຍ​ການ​ຄ່າ​ແຮງ​ງານກ່ອນ!')"
                        oninput="this.setCustomValidity('')">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="typeserviceid">ປະ​ເພດ​ການບ​ໍ​ລິ​ການ</label>
                        <select id="typeserviceid" class="form-control" name="typeserviceid">
                          <option value="">ເລືອກ​ປະ​ເພດ​ການ​ບໍ​ລິ​ການ</option>
                          @if(count($typeservices) > 0)
                            @foreach($typeservices as $tsv)
                              <option value="{{ $tsv->typeserviceid }}">{{ $tsv->typeservicename }}</option>
                            @endforeach
                          @else
                            <option value="">ບໍ່​ມີ​ຂໍ້​ມູນ​ການ​ບໍ​ລິ​ການ​ໃນ​ລະ​ບົບ</option>
                          @endif
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="typesparesid">ລະ​ບົບ​ລົດ​ຍົນ</label>
                        <select id="typesparesid" class="form-control" name="typesparesid">
                          <option value=""></option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="cost">​ຄ່າ​ແຮງ​ງານ</label>
                        <input id="cost" class="form-control" type="text" name="cost" placeholder="...">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="tcarid">ປະ​ເພດ​ລົດ</label>
                        <select id="tcarid" class="form-control" name="tcarid">
                        @if (count($typecars) > 0)
                          @foreach($typecars as $tc)
                            <option value="{{ $tc->tcarid }}">{{ $tc->tcarname }}</option>
                          @endforeach
                        @else
                          <option value="">ເລືອກ​ປະ​ເພດ​ລົດ</option>
                        @endif
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                        <label for="guaranty">ຮັບ​ປະ​ກັນ</label>
                        <input id="guaranty" class="form-control" type="text" name="guaranty" placeholder="...">
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                        <label for="timeset">ເວ​ລາ​ຕິດ​ຕັ້ງ</label>
                        <input id="timeset" class="form-control" type="text" name="timeset" placeholder="...">
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                        <label for="unitrpid">ຫົວ​ໜ່ວຍ​ສ້ອມ</label>
                        <select id="unitrpid" class="form-control" name="unitrpid">
                          @if(count($unitrepairs) > 0)
                            @foreach($unitrepairs as $ur)
                              <option value="{{ $ur->unitrpid }}">{{ $ur->unitrpname }}</option>
                            @endforeach
                          @else
                            <option value="">ບໍ່​ມີ​ລາຍ​ການ​ຫົວ​ໜ່ວຍ​ໃນ​ລະ​ບົບ</option>
                          @endif
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 text-center">
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

@include('manage.layout.foot')
<script src="{{ url('includes/technical/wagenew.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif