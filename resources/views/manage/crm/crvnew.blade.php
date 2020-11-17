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
              @error('cusid')
                <script>swal({
                  title: "ຜິດ​ຜາດ",
                  text: "ທ່ານຍ​ັງ​ບໍ່​ໄດ້​ເລືອກ​ລູກ​ຄ້າ!",
                  icon: "warning",
                  button: false
                });</script>
              @enderror
              @error('carid')
                <script>swal({
                  title: "ຜິດ​ຜາດ",
                  text: "ທ່ານຍ​ັງ​ບໍ່​ໄດ້​ເລືອກ​ລົດລູກ​ຄ້າ!",
                  icon: "warning",
                  button: false
                });</script>
              @enderror
              <form action="{{ url('insertrcs') }}" method="POST">
                {{ csrf_field() }}
                <nav class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link w3-blue" href="#">ລະ​ຫັດ​ໃບ​ຮັບ​ລົດ</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" href="#"><b>{{ $rcsid }}</b></a>
                    <input type="hidden" name="rcsid" value="{{ $rcsid }}">
                  </li>
                </nav>
                <div class="row">
                  <div class="col-md-2">
                    <h4>ຂໍ້​ມູນ​ລົດ</h4>
                    <div class="form-group">
                      <label for="cusid">ເລືອກ​ລູກ​ຄ້າ</label>
                      <select id="cusid" name="cusid" class="form-control" style="width: 100%">
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
                    <div class="form-group">
                      <label for="carid">ເລືອກ​ລົດ​ລ​ູກ​ຄ້າ</label>
                      <select id="carid" class="form-control" name="carid">
                        <option value="">*** ເລືອກ​ລົດ​ລູກ​ຄ້າ ***</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="date_receive">ວັນ​ທີ່​ຮັບ​ລົດ</label>
                      <input id="date_receive" class="form-control" type="text" name="date_receive" required>
                    </div>
                    <div class="form-group">
                      <label for="time_receive">ເວ​ລາ​ຮັບ​ລົດ</label>
                      <input id="time_receive" class="form-control" type="text" name="time_receive" required>
                    </div>
                    <div class="form-group">
                      <label for="meter">ເລກ​ກົງ​ເຕີ</label>
                      <input id="meter" class="form-control" type="text" name="meter" required>
                    </div>
                    <div class="form-group">
                      <label for="type_car">ປະ​ເພດ​ລົດ</label>
                      <select id="type_car" class="form-control" name="type_car">
                        <option value="ລົດ​ກະ​ປອງ(Mini Car)">ລົດ​ກະ​ປອງ(Mini Car)</option>
                        <option value="ລົດ​ເກັງ(Sedan)">ລົດ​ເກັງ(Sedan)</option>
                        <option value="ລົດ​ກະ​ບະ(Pick Up)">ລົດ​ກະ​ບະ(Pick Up)</option>
                        <option value="ລົດ​ໄຟ​ຟ້າ(SUV)">ລົດ​ໄຟ​ຟ້າ(SUV)</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="gear">ປະ​ເພດ​ເກຍ</label>
                      <select id="gear" class="form-control" name="gear">
                        <option value="MT ທຳ​ມະ​ດາ">MT ທຳ​ມະ​ດາ</option>
                        <option value="AT ອໍ​ໂຕ">AT ອໍ​ໂຕ</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="leveloil">ລະ​ດັບ​ນ້ຳ​ມັນ</label>
                      <select id="leveloil" class="form-control" name="leveloil">
                        <option value="E">E</option>
                        <option value="1/2">1/2</option>
                        <option value="F">F</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <h4>ລາຍ​ການກວດ​​ລົດ​ລູກ​ຄ້າ</h4>
                    <div class="row">
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="front">ດ້ານ​ໜ້າ / Front</label>
                          <select id="front" class="form-control" name="front">
                            <option value="1">ປົກ​ກະ​ຕິ</option>
                            <option value="2">ບໍ່​ປົກ​ກະ​ຕິ</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="front_remark">ລາຍ​ລະ​ອຽດ​ບັນ​ຫາ​ດ້ານ​ໜ້າ</label>
                          <input id="front_remark" class="form-control" type="text" name="front_remark" placeholder="ບໍ່​ໃສ່​ກະ​ໄດ້...">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="left">ດ້ານ​ຊ້າຍ / Left</label>
                          <select id="left" class="form-control" name="left">
                            <option value="1">ປົກ​ກະ​ຕິ</option>
                            <option value="2">ບໍ່ປົກ​ກະ​ຕິ</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="left_remark">ລາຍ​ລະ​ອຽດ​ບັນ​ຫາ​ດ້ານ​ຊ​້າຍ</label>
                          <input id="left_remark" class="form-control" type="text" name="left_remark" placeholder="ບໍ່​ໃສ່​ກະ​ໄດ້...">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="right">ດ້ານ​ຂວາ / Right</label>
                          <select id="right" class="form-control" name="right">
                            <option value="1">ປົກ​ກະ​ຕິ</option>
                            <option value="2">ບໍ່​ປົກ​ກະ​ຕິ</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="right_remark">ລາຍ​ລະ​ອຽດ​ບັນ​ຫາ​ດ້ານ​ຂວາ</label>
                          <input id="right_remark" class="form-control" type="text" name="right_remark" placeholder="ບໍ່​ໃສ່​ກະ​ໄດ້...">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="back">ດ້ານ​ຫຼັງ / Back</label>
                          <select id="back" class="form-control" name="back">
                            <option value="1">ປົກ​ກະ​ຕິ</option>
                            <option value="2">ບໍ່ປົກ​ກະ​ຕິ</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="back_remark">ລາຍ​ລະ​ອຽດ​ບັນ​ຫາ​ດ້ານ​ຫຼັງ</label>
                          <input id="back_remark" class="form-control" type="text" name="back_remark" placeholder="ບໍ່​ໃສ່​ກະ​ໄດ້...">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="wheels">ລໍ້​ຢາງ​ລົດ/Wheels</label>
                          <select id="wheels" class="form-control" name="wheels">
                            <option value="1">ປົກ​ກະ​ຕິ</option>
                            <option value="2">ບໍ່ປົກ​ກະ​ຕິ</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="wheels_remark">ລາຍ​ລະ​ອຽດ​ບັນ​ຫາ​​ລໍ້​ຢາງ​ລົດ</label>
                          <input id="wheels_remark" class="form-control" type="text" name="wheels_remark" placeholder="ບໍ່​ໃສ່​ກະ​ໄດ້...">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="seats">ເບາະ​ນັ່ງ / Seats</label>
                          <select id="seats" class="form-control" name="seats">
                            <option value="1">ປົກ​ກະ​ຕິ</option>
                            <option value="2">ບໍ່​ປົກ​ກະ​ຕິ</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="seats_remark">ລາຍ​ລະ​ອຽດ​ບັນ​ຫາ​ເບາະ​ນັ່ງ</label>
                          <input id="seats_remark" class="form-control" type="text" name="seats_remark" placeholder="ບໍ່​ໃສ່​ກະ​ໄດ້...">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="doors">​ປະ​ຕ​ູ / Door</label>
                          <select id="doors" class="form-control" name="doors">
                            <option value="1">ປົກ​ກະ​ຕິ</option>
                            <option value="2">ບໍ່ປົກ​ກະ​ຕິ</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="doors_remark">ລາຍ​ລະ​ອຽດ​ບັນ​ຫາ​ປະ​ຕູ</label>
                          <input id="doors_remark" class="form-control" type="text" name="doors_remark" placeholder="ບໍ່​ໃສ່​ກະ​ໄດ້...">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="mirror">ສະ​ວິກ​ແວ່ນ/Mirror Switch</label>
                          <select id="mirror" class="form-control" name="mirror">
                            <option value="1">ປົກ​ກະ​ຕິ</option>
                            <option value="2">ບໍ່ປົກ​ກະ​ຕິ</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="mirror_remark">ລາຍ​ລະ​ອຽດ​ບັນ​ຫາ​​ສະ​ວິກ​ແວ່ນ</label>
                          <input id="mirror_remark" class="form-control" type="text" name="mirror_remark" placeholder="ບໍ່​ໃສ່​ກະ​ໄດ້...">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-8">
                        <h4>ລາຍ​ການກວດ​ລົດ​ລູກ​ຄ້າ</h4>
                        <div class="row">
                          <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                              <label for="sound">ເຄື່ອງ​ສຽງ​ໃນ​ລົດ / CD-Checkbox</label>
                              <select id="sound" class="form-control" name="sound">
                                <option value="1">ປົກ​ກະ​ຕິ</option>
                                <option value="2">ບໍ່​ປົກ​ກະ​ຕິ</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                              <label for="sound_remark">ລາຍ​ລະ​ອຽດ​ບັນ​ຫາເຄື່ອງ​ສຽງ​</label>
                              <input id="sound_remark" class="form-control" type="text" name="sound_remark" placeholder="ບໍ່​ໃສ່​ກະ​ໄດ້...">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                              <label for="meter_display">ໜ້າ​ປັດ​ກອງ​ເຕີ / Meter</label>
                              <select id="meter_display" class="form-control" name="meter_display">
                                <option value="1">ປົກ​ກະ​ຕິ</option>
                                <option value="2">ບໍ່ປົກ​ກະ​ຕິ</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                              <label for="meterdis_remark">ລາຍ​ລະ​ອຽດ​ບັນ​ຫາ​ໜ້າ​ປັດ​ກອງ​ເຕີ</label>
                              <input id="meterdis_remark" class="form-control" type="text" name="meterdis_remark" placeholder="ບໍ່​ໃສ່​ກະ​ໄດ້...">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                              <label for="accessories">ອຸ​ປະ​ກອນ​ເສີມ/Accessories</label>
                              <select id="accessories" class="form-control" name="accessories">
                                <option value="1">ປົກ​ກະ​ຕິ</option>
                                <option value="2">ບໍ່ປົກ​ກະ​ຕິ</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                              <label for="accessories_remark">ລາຍ​ລະ​ອຽດ​ບັນ​ຫາ​​ອຸ​ປະ​ກອນ​ເສີມ</label>
                              <input id="accessories_remark" class="form-control" type="text" name="accessories_remark" placeholder="ບໍ່​ໃສ່​ກະ​ໄດ້...">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="valuables">ຂອງ​ມີ​ຄ່າ​ໃນ​ລົດ</label>
                              <select name="valuables" id="valuables" class="form-control">
                                <option value="1">ມີ</option>
                                <option value="2">ບໍ່ມີ</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="valuables_remark">ລາຍ​ລະ​ອຽດຂອງ​ມີ​ຄ່າ​ໃນ​ລົດ</label>
                              <input id="valuables_remark" class="form-control" type="text" name="valuables_remark" placeholder="ບໍ່​ໃສ່​ກະ​ໄດ້...">
                            </div>
                          </div>
                        </div>
                        <hr>
                        
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="rp_other">ລາຍ​ການ​ເພີ່ມ​ເຕີມ</label>
                              <select id="rp_other" class="form-control" name="rp_other">
                                <option value="no">ບໍ່​ມີ​ການ​ເພີ່ມ​ລາຍ​ການ</option>
                                <option value="yes" selected>ມີ​ລາຍ​ການ​ເພີ່ມ​</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-12" id="showother_repair">
                            <label for="">ລາຍ​ການ​ສ້ອມ​ເພີ່ມ​ຕື່ມ</label>
                            <table class="table table-default" id="other_repair">
                              <tr>
                                <td>
                                  <input class="form-control" type="text" name="repairlist[]" id="repairlist" placeholder="ລາຍ​ການ​ສ້ອມ​ແປງ​ອື່ນໆ...">
                                </td>
                                <td>
                                  <button class="btn btn-primary" type="button" id="btnAddrow"><i class="mdi mdi-plus-thick"></i></button>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <h4>ລາຍ​ການ​ສະ​ເໜີ​ຂອງ​ຄ້າ</h4>
                        <div class="form-group">
                          <label for="check33">ກວດ​ເຊັດ 33 ລາຍ​ການ</label>
                          <select id="check33" class="form-control" name="check33">
                            <option value="ກວດ​ເຊັກ">ກວດ​ເຊັກ</option>
                            <option value="ບໍ່​ກວດ​ເຊັກ">ບໍ່​ກວດ​ເຊັກ</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="maintenance">ສ້ອມບ​ຳ​ລຸງ</label>
                          <select id="maintenance" class="form-control" name="maintenance">
                            <option value="ປ່ຽນ​ນ້ຳ​ມັນ​ເຄື່ອງ+ກອງ​ຕ່າງໆ">ປ່ຽນ​ນ້ຳ​ມັນ​ເຄື່ອງ+ກອງ​ຕ່າງໆ</option>
                            <option value="ປ່ຽນ​ນ້ຳ​ມັນ​ເກຍ">ປ່ຽນ​ນ້ຳ​ມັນ​ເກຍ</option>
                            <option value="ນ້ຳ​ມັນ​ເຟືອງ​ທ້າຍ">ນ້ຳ​ມັນ​ເຟືອງ​ທ້າຍ</option>
                            <option value="ອັດ​ກະ​ແລັດ​ທົ່ວ​ໄປ">ອັດ​ກະ​ແລັດ​ທົ່ວ​ໄປ</option>
                            <option value="ອື່ນໆ">ອື່ນໆ</option>
                            <option value=".">ບໍ່​ໄດ້​ສ້ອມ</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="maintenance_list">ລາຍ​ການ​ສ້ອມບ​ຳ​ລຸງ​ເພີ່ມ</label>
                          <select id="maintenance_list" class="form-control" name="maintenance_list">
                            <option value="ເຕີມ​ນ້ຳ​ມັນ​ເຄື່ອງ-ເກຍ-ເຟືອງ​ທ້າຍ">ເຕີມ​ນ້ຳ​ມັນ​ເຄື່ອງ-ເກຍ-ເຟືອງ​ທ້າຍ</option>
                            <option value="​ເຕີມ​ນ້ຳ​ກົດ-ນ້ຳ​ກັ່ນ">ເຕີມ​ນ້ຳ​ກົດ-ນ້ຳ​ກັ່ນ</option>
                            <option value="ເຕີມ​ນ້ຳ​ມັນ​ເບກ-ຄາດ">ເຕີມ​ນ້ຳ​ມັນ​ເບກ-ຄາດ</option>
                            <option value="ກວດ​ເຊັກ​ລົມ​ຢາງ">ກວດ​ເຊັກ​ລົມ​ຢາງ</option>
                            <option value="ເຕີມ​ນ້ຳ​ຢາ​ໜໍ້​ນ້ຳ">ເຕີມ​ນ້ຳ​ຢາ​ໜໍ້​ນ້ຳ</option>
                            <option value=".">ບໍ່​ໄດ້​ສ້ອມ</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="repairs">ສ້ອມ​ແປງ​ລົດ</label>
                          <select id="repairs" class="form-control" name="repairs">
                            <option value="ສ້ອມ​ແປງ​ດ່ວນ">ສ້ອມ​ແປງ​ດ​່ວນ</option>
                            <option value="ບໍ່​ດ່ວນ">ບໍ່​ດ່ວນ</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="tire_service">ບໍ​ລິ​ການ​ຢາງ​ລົດ</label>
                          <select name="tire_service" id="tire_service" class="form-control">
                            <option value="ກວດ​ເຊັກ​ຢາງ">ກວດ​ເຊັກ​ຢາງ</option>
                            <option value="ປ່ຽນ​ຢາງ​ລົດ​ໃໝ່">ປ່ຽນ​ຢາງ​ລົດ​ໃໝ່</option>
                            <option value="ຕັ້ງ​ສູນ​ລົດ">ຕັ້ງ​ສູນ​ລົດ</option>
                            <option value="ຖ່ວງ​ລໍ້">ຖ່ວງ​ລໍ້</option>
                            <option value="ຈອດ​ຢາງ">ຈອດ​ຢາງ</option>
                            <option value="ສະ​ລັບ​ຢາງ">ສະ​ລັບ​ຢາງ</option>
                            <option value=".">ບໍ່​ໄດ້​ສ້ອມ</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="tire_detail">ລາຍ​ລະ​ອຽດ​</label>
                          <input id="tire_detail" class="form-control" type="text" name="tire_detail" placeholder="ລາຍ​ລະ​ອຽດ​ຢາງ​ເພີ່ມ​ເຕີມ...">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 text-center">
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