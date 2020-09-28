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
              <h3>ລາຍ​ການ​ໃບ​ຮັບ​ລົດ</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                  <div class="input-group">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="mdi mdi-file-document-box-search-outline"></i></span>
                    </div>
                    <select class="form-control" name="stylesearch" id="stylesearch">
                      <option value="">ຮູບ​ແບບ​ການ​ຄົ້ນ​ຫາ</option>
                      <option value="1">ຄົ້ນ​ຫາ​ຕາມ​ລະ​ຫັດ​ໃບ​ຮັບ​ລົດ</option>
                      <option value="2">ຄົ້ນ​ຫາ​ຕາມ​ທະບຽນ​ລົດ</option>
                      <option value="3">ຄົ້ນ​ຫາ​ຕາມ​ລາຍ​ຊື່​ລ​ູກ​ຄ້າ</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                    <input class="form-control" type="text" name="searchtext" id="searchtext" placeholder="ຄົ້ນ​ຫາ...">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button" id="btnSearch"><i class="mdi mdi-table-search"></i> ຄົ້ນ​ຫາ​</button>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  {{-- <div class="table-responsive"> --}}
                    <table class="table table-light table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>ລະ​ຫັດ​ໃບ​ຮັບ​ລົດ</th>
                          <th>ລະ​ຫັດ​ລົດ</th>
                          <th>ທະບຽນ​ລົດ</th>
                          <th>ລະ​ຫັດ​ລູກ​ຄ້າ</th>
                          <th>ຊື່ ແລະ ນາມ​ສະ​ກຸນ</th>
                          <th>ວັນ​ທີ່​ຮັບ​ລົດ</th>
                          <th>ເວ​ລາ​ຮັບ​ລົດ</th>
                          <th>ເລກ​ກົງ​ເຕີ</th>
                          <th>ປະ​ເພດ​ລົດ</th>
                          <th>ປະ​ເພດ​ເກຍ</th>
                          <th>ລະ​ດັບ​ນ້ຳ​ມັນ</th>
                          <th>ອື່ນໆ</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(count($sqlrcs) > 0)
                          @foreach($sqlrcs as $rcs)
                            <tr>
                              <td>{{ $rcs->rcsid }}</td>
                              <td>{{ $rcs->carid }}</td>
                              <td>{{ $rcs->license }}</td>
                              <td>{{ $rcs->cusid }}</td>
                              <td>{{ $rcs->name }} {{ $rcs->lastname }}</td>
                              <td>{{ $rcs->date_receive }}</td>
                              <td>{{ $rcs->time_receive }}</td>
                              <td>{{ $rcs->meter }}</td>
                              <td>{{ $rcs->type_car }}</td>
                              <td>{{ $rcs->gear }}</td>
                              <td>{{ $rcs->leveloil }}</td>
                              <td>
                                <div class="btn-group d-inline">
                                  <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
                                      aria-haspopup="true" aria-expanded="false">
                                      <i class="mdi mdi-dots-horizontal"></i>
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ url('/printRcs/'.$rcs->rcsid) }}"><i class="mdi mdi-printer"></i>ພິມ​ໃບ​ຮັບ​ລົດ</a>
                                    <button class="dropdown-item" type="button" id="btnChecklist" value="{{ $rcs->rcsid }}"><i class="mdi mdi-clipboard-list"></i>​ແກ​້​ໄຂລາຍ​ການ​</button>
                                    <button class="dropdown-item" type="button" id="btnrepairlist" value="{{ $rcs->rcsid }}"><i class="mdi mdi-playlist-edit"></i>​ລາຍ​ການ​ສະ​ເໜີ​ສ້ອມ</button>
                                    <button class="dropdown-item" type="button" id="btnDelete" value="{{ $rcs->rcsid }}"><i class="mdi mdi-delete"></i>​ລຶບ​ລາຍ​ການ​ນີ້</button>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          @endforeach
                        @else
                          <tr>
                            <td colspan="12">
                              <h4 class="text-center">ບໍ່​ມີ​ຂໍ້​ມູນ​ລາຍ​ການ​ໃບ​ຮັບ​ລົດ</h4>
                            </td>
                          </tr>
                        @endif
                      </tbody>
                    </table>
                  {{-- </div> --}}
                </div>
              </div>
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
              @if($message=Session::get('success'))
                <script>swal({
                  title: 'ສຳ​ເລັດ',
                  text: 'ການ​ດຳ​ເນີນ​ການສຳ​ເລັດ',
                  icon: 'success',
                  button: false,
                  timer: 3000
                });</script>
              @endif
              <div id="modalChecklist" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalcheck" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalcheck">ແກ້​ໄຂລາຍ​ການກວດ​ເຊັກ</h5>
                      <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ url('updateRcs') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="checkrcsid" id="checkrcsid" value="">
                        <div class="row">
                          <div class="col-md-2">
                            <h4>ຂໍ້​ມູນ​ລົດ</h4>
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
                            <div class="form-group">
                              <label for="carid">ເລືອກ​ລົດ​ລ​ູກ​ຄ້າ</label>
                              <select id="carid" class="form-control" name="carid">
                                <option value="">*** ເລືອກ​ລົດ​ລູກ​ຄ້າ ***</option>
                              </select>
                            </div>
                            <div class="row">
                              <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                  <label for="date_receive">ວັນ​ທີ່​ຮັບ​ລົດ</label>
                                  <input id="date_receive" class="form-control" type="text" name="date_receive" required>
                                </div>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                  <label for="time_receive">ເວ​ລາ​ຮັບ​ລົດ</label>
                                  <input id="time_receive" class="form-control" type="text" name="time_receive" required>
                                </div>
                              </div>
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
                            <div class="row">
                              <div class="col-md-7 col-sm-7">
                                <div class="form-group">
                                  <label for="gear">ປະ​ເພດ​ເກຍ</label>
                                  <select id="gear" class="form-control" name="gear">
                                    <option value="MT ທຳ​ມະ​ດາ">MT ທຳ​ມະ​ດາ</option>
                                    <option value="AT ອໍ​ໂຕ">AT ອໍ​ໂຕ</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-5 col-sm-5">
                                <div class="form-group">
                                  <label for="leveloil">ລະ​ດັບ​ນ້ຳ​ມັນ</label>
                                  <select id="leveloil" class="form-control" name="leveloil">
                                    <option value="E">E</option>
                                    <option value="1/2">1/2</option>
                                    <option value="F">F</option>
                                  </select>
                                </div>
                              </div>
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
                          </div>
                          <div class="col-md-6">
                            <div class="row">
                              <div class="col-md-8">
                                <h4>ລາຍ​ການກວດ​ລົດ​ລູກ​ຄ້າ</h4>
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
              <div id="modalRcslist" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="rcslist" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="rcslist">ລາຍ​ການ​ສະ​ເໜີ​ສ້ອມ</h5>
                      <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="input-group">
                            <input type="hidden" name="rcsidrepair" id="rcsidrepair" value="">
                            <input class="form-control" type="text" name="repairlist" id="repairlist">
                            <div class="input-group-append">
                              <button class="btn btn-primary" type="button" id="btnAddRepairlist"><i class="mdi mdi-plus-thick"></i> ບັນ​ທຶກ</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-md-12">
                          <table class="table table-light table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>ລຳ​ດັບ</th>
                                <th>ລາຍ​ການ</th>
                                <th>ລົບ</th>
                              </tr>
                            </thead>
                            <tbody id="showlist">
                              
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

@include('manage.layout.foot')
<script src="{{ url('js/crvlist.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif