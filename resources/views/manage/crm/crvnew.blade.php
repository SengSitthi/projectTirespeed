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
              <h3>ໃບ​ຮັບ​ລົດ​ໃໝ່</h3>
            </div>
            <div class="card-body">
              <form action="" method="POST">
                <nav class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link w3-blue" href="#">ລະ​ຫັດ​ໃບ​ຮັບ​ລົດ</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" href="#"><b>{{ $rcid }}</b></a>
                    <input type="hidden" name="rcid" value="{{ $rcid }}">
                  </li>
                </nav>
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="cusid">ເລືອກ​ລູກ​ຄ້າ</label>
                      <select id="cusid" class="form-control" name="cusid">
                        <option value="">*** ເລືອກລູກ​ຄ້າ ***</option>
                      @if (count($customers) > 0)
                        @foreach ($customers as $cus)
                          <option value="{{ $cus->cusid }}">{{ $cus->name }}</option>
                        @endforeach
                      @else
                        <option value="">ບໍ່​ມີ​ລູກ​ຄ້າ​ໃນ​ລະ​ບົບ</option>
                      @endif
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="carid">ເລືອກ​ລົດ​ລ​ູກ​ຄ້າ</label>
                      <select id="carid" class="form-control" name="carid">
                        <option value="">*** ເລືອກ​ລົດ​ລູກ​ຄ້າ ***</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="appoint_no">ໃບ​ນັດ​ໝາຍ</label>
                      <select id="appoint_no" class="form-control" name="appoint_no" required>
                        <option value="">*** ໃບ​ນັດ​ໝາຍ ***</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="date_receive">ວັນ​ທີ່​ໃບ​ຮັບ​ລົດ</label>
                      <input id="date_receive" class="form-control" type="text" name="date_receive" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="time_receive">ເວ​ລາ​ຮັບ​ລົດ</label>
                      <input id="time_receive" class="form-control" type="text" name="time_receive" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="intance">ເລກ​ກົງ​ເຕີ</label>
                      <input id="intance" class="form-control" type="text" name="instance" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="gear">ປະ​ເພດ​ເກຍ</label>
                      <select id="gear" class="form-control" name="gear">
                        <option value="">*** ປະ​ເພດ​ເກຍ ***</option>
                        <option value="ກະ​ປຸກ">ກະ​ປຸກ</option>
                        <option value="ອໍ​ໂຕ້">ອໍ​ໂຕ້</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="type_running">ປະ​ເພດ​ການ​ແລ່ນ</label>
                      <select id="type_running" class="form-control" name="type_running">
                        <option value="">*** ປະ​ເພດ​ການ​ແລ່ນ ***</option>
                        <option value="2FR">2FR</option>
                        <option value="2WD">2WD</option>
                        <option value="4WD">4WD</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="bodyoil">ນ້ຳ​ມັນ​ໃນ​ຖັງ</label>
                      <select id="bodyoil" class="form-control" name="bodyoil">
                        <option value="">ເລືອກນ້ຳ​ມັນ​ໃນ​ຖັງ</option>
                        <option value="E">E</option>
                        <option value="1/4">1/4</option>
                        <option value="1/2">1/2</option>
                        <option value="3/4">3/4</option>
                        <option value="F">F</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="type_car">ປະ​ເພດ​ລົດ</label>
                      <select id="type_car" class="form-control" name="type_car">
                        <option value="">ເລືອກ​ປະ​ເພດ​ລົດ</option>
                        <option value="ລົດ​ກະ​ປອງ(Mini Car)">ລົດ​ກະ​ປອງ(Mini Car)</option>
                        <option value="ລົດ​ເກັງ(Sedan)">ລົດ​ເກັງ(Sedan)</option>
                        <option value="ລົດ​ກະ​ບະ(Pick Up)">ລົດ​ກະ​ບະ(Pick Up)</option>
                        <option value="ລົດ​ໄຟ​ຟ້າ(SUV)">ລົດ​ໄຟ​ຟ້າ(SUV)</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="front_tank">ໂຕ​ຖັງ​ດ້ານ​ໜ້າ</label>
                      <input id="front_tank" class="form-control" type="text" name="front_tank" required>
                    </div>
                    <div class="form-group">
                      <label for="behind_tank">ໂຕ​ຖັງ​ດ້ານ​ຫຼັງ</label>
                      <input id="behind_tank" class="form-control" type="text" name="behind_tank" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="car_mirror">ແກ້ວ​ແວ່ນ​ໜ້າ ຫຼັງ ຂ້າງ</label>
                      <input id="car_mirror" class="form-control" type="text" name="car_mirror" required>
                    </div>
                    <div class="form-group">
                      <label for="wiper">ໄມ້ປັດ​ນ້ຳ​ຝົນ</label>
                      <input id="wiper" class="form-control" type="text" name="wiper" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="insidecar">ສະ​ພາບ​ຫ້ອງ​ເກັງ</label>
                      <input id="insidecar" class="form-control" type="text" name="insidecar" required>
                    </div>
                    <div class="form-group">
                      <label for="light">ລະ​ບົບ​ໄຟ​ສະ​ຫວ່າງ</label>
                      <input id="light" class="form-control" type="text" name="light" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="machineroom">ຫ້ອງ​ເຄື່ອງ​ຈັກ</label>
                      <input id="machineroom" class="form-control" type="text" name="machineroom" required>
                    </div>
                    <div class="form-group">
                      <label for="type_battery">ປະ​ເພດ​ໝໍ້​ໄຟ</label>
                      <input id="type_battery" class="form-control" type="text" name="type_battery" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="accessory">ອ​ຸ​ປະ​ກອນ​ພາຍ​ໃນ​ລົດ</label>
                      <input id="accessory" class="form-control" type="text" name="accessory" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="kit">ຊຸດ​ອຸ​ປະ​ກອນ</label>
                      <input id="kit" class="form-control" type="text" name="kit" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="date_checked">ວັນ​ທີ່ກວດ​ເຊັດ​ສຳ​ເລັດ</label>
                      <input id="date_checked" class="form-control" type="text" name="date_checked" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="time_checked">ເວ​ລາ​ກວດ​ສຳ​ເລັດ</label>
                      <input id="time_checked" class="form-control" type="text" name="time_checked" required>
                    </div>
                  </div>
                  <div class="col-md-4 text-center">
                    <button class="btn btn-success btn-lg" type="submit"><i class="mdi mdi-file-document-box-plus-outline"></i> ບັນ​ທຶກ</button>
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
<script src="{{ url('js/crvnew.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif