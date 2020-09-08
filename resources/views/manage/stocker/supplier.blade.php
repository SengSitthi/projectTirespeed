@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
    <div class="wrapper">

        @include('manage.layout.nav')

        @include('manage.layout.sidemenu')

        <div class="container-fluid mt-30">
            
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                @if ($message=Session::get('success'))
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>ສຳ​ເລັດ!</strong> {{$message}}.
                </div>
                @endif
                <div class="card-header bg-transparent py-15">
                  <h3>ເພີ່ມ​ຜູ້​ສະ​ໜອງ</h3>
                </div>
                <div class="card-body">
                  <form action="{{ url('insertSupplier') }}" method="POST">
                    @csrf
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="supplierid">ລະ​ຫັດ​ຜູ້​ສະ​ໜອງ</label>
                          <input id="supplierid" class="form-control" type="text" name="supplierid" value="SUP{{ $supplierid }}" readonly>
                        </div>
                        <div class="form-group">
                          <label for="suppliername">​ຊື່​ຜູ້​ສະ​ໜອງ</label>
                          <input id="suppliername" class="form-control" type="text" name="suppliername" required>
                        </div>
                        <div class="form-group">
                          <label for="suppliertax">ພາ​ສີ​ອາ​ກອນ</label>
                          <input id="suppliertax" class="form-control" type="text" name="suppliertax" required>
                        </div>
                        {{-- <div class="form-group">
                          <label for="contact_person">ບຸກ​ຄົນ​ຕິດ​ຕໍ່</label>
                          <input id="contact_person" class="form-control" type="text" name="contact_person" required>
                        </div> --}}
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="village">ບ້ານ</label>
                          <input id="village" class="form-control" type="text" name="village">
                        </div>
                        <div class="form-group">
                          <label for="proid">ແຂວງ</label>
                          <select id="proid" class="form-control" name="proid">
                            <option value="">​ເລືອກ​ແຂວງ</option>
                            @if (count($provinces) > 0)
                              @foreach ($provinces as $pro)
                                <option value="{{ $pro->proid }}">{{ $pro->proname }}</option>
                              @endforeach
                            @else
                              <option value="">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ໃນ​ລະ​ບົບ</option>
                            @endif
                          </select>
                          <div><h5 class="text-danger">{{ $errors->first('proid') }}</h5></div>
                        </div>
                        <div class="form-group">
                          <label for="disid">ເມືອງ</label>
                          <select id="disid" class="form-control" name="disid">
                            <option value="">​ເລືອກ​ເມືອງ</option>
                          </select>
                          <div><h5 class="text-danger">{{ $errors->first('disid') }}</h5></div>
                        </div>
                        {{-- <div class="form-group">
                          <label for="zipcode">ລະ​ຫັດ​ໄປ​ສະ​ນີ</label>
                          <input id="zipcode" class="form-control" type="text" name="zipcode" required>
                        </div> --}}
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="mobile">ມື​ຖື</label>
                          <input id="mobile" class="form-control" type="text" name="mobile" required>
                        </div>
                        <div class="form-group">
                          <label for="phone">​ເບີ​ໂທ​ລະ​ສັບ</label>
                          <input id="phone" class="form-control" type="text" name="phone" required>
                        </div>
                        <div class="form-group">
                          <label for="fax">​ແຟັກ</label>
                          <input id="fax" class="form-control" type="text" name="fax" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        {{-- <h5>ເລກ​ບັນ​ຊີ</h5> --}}
                        <div class="row">
                          <div class="col-md-6">
                            <div class="custom-control custom-radio">
                              <input type="radio" id="addaccount1" name="addaccount" class="custom-control-input" value="1" checked>
                              <label class="custom-control-label" for="addaccount1">ເພີ່ມ​ບັນ​ຊີ​ທະ​ນາ​ຄານ</label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="custom-control custom-radio">
                              <input type="radio" id="addaccount0" name="addaccount" class="custom-control-input" value="0">
                              <label class="custom-control-label" for="addaccount0">ບໍ່​ມີ​ບັນ​ຊີ​ທະ​ນາ​ຄານ</label>
                            </div>
                          </div>
                        </div>
                        <table class="table table-light">
                          <thead>
                            <tr>
                              <th>ຊື່​ທະ​ນາ​ຄານ</th>
                              <th>ເລກ​ບັນ​ຊີ​ທະ​ນາ​ຄານ</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody id="addaccount">
                            <tr>
                              <td>
                                <input class="form-control" type="text" name="bankname[]" id="bankname" value="">
                              </td>
                              <td>
                                <input class="form-control" type="text" name="account_num[]" id="account_num" value="">
                              </td>
                              <td>
                                <button class="btn btn-info" type="button" id="btnAddcount"><i class="mdi mdi-plus"></i></button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
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

@include('manage.layout.foot')
<script src="{{ url('includes/stockjs/supplier.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif