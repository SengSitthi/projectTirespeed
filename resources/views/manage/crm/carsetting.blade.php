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
                            <h3>ຈັດ​ການ​ຂໍ້​ມູນ​ລົດ​ລູ​ກ​ຄ້າ</h3>
                        </div>
                        <div class="card-body">
                            @if (count($errors) > 0)
                            <script>swal({
                                title: "ມີ​ຂໍ້​ຜິດ​ພາດ",
                                text: "ຍີ່​ຫໍ້​ລົດ​ເປັນ​ຄ່າ​ຫວ່າງ, ກະ​ລຸ​ນາ​ເລືອກ​ຍີ່​ຫໍ້​ລົດ!",
                                icon: "warning",
                                button: false,
                                timer: 3500
                                });</script>
                            @endif
                            @if (Session::get('success'))
                            <script>swal({
                                title: "ສຳ​ເລັດ",
                                text: "ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ!",
                                icon: "success",
                                button: false,
                                timer: 2500
                                });</script>
                            @endif
                            <div class="table-responsive">
                              <table class="table table-light table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th class="text-center">ລະ​ຫັດ​ລູກ​ຄ້າ</th>
                                    <th class="text-center">ຊື່ ແລະ​ ນາມ​ສະ​ກຸນ</th>
                                    <th class="text-center">ລະ​ຫັດ​ລົດ</th>
                                    <th class="text-center">ປ້າຍ​ລົດ</th>
                                    <th class="text-center">ຍີ່​ຫໍ້</th>
                                    <th class="text-center">ລຸ້ນ</th>
                                    <th class="text-center">ປີ​ຜະ​ລິດ</th>
                                    <th class="text-center">ສີລົດ</th>
                                    <th class="text-center">​ເລກ​ກົງ​ເຕີ</th>
                                    <th class="text-center">ປະ​ເພດ​ເຄື່ອງ​ຈັກ</th>
                                    <th class="text-center">ຈັດ​ການ</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  @if(count($carandcus) > 0)
                                    @foreach ($carandcus as $cac)
                                      <tr>
                                        <td>{{ $cac->cusid }}</td>
                                        <td>{{ $cac->name }} {{ $cac->lastname }}</td>
                                        <td>{{ $cac->carid }}</td>
                                        <td>{{ $cac->license }}</td>
                                        <td>{{ $cac->brandname }}</td>
                                        <td>{{ $cac->model }}</td>
                                        <td>{{ $cac->madeyear }}</td>
                                        <td>{{ $cac->color }}</td>
                                        <td>{{ $cac->distance }}</td>
                                        <td>{{ $cac->motor }}</td>
                                        <td>
                                          <div class="btn-group dropleft">
                                            <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <i class="mdi mdi-dots-horizontal"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                              <button class="dropdown-item" id="btnEdit" value="{{ $cac->carid }}"><i class="mdi mdi-car"></i> ແກ້​ໄຂ</button>
                                                <a class="dropdown-item" id="btnDel" href="{{ url('/deleteCar/'.$cac->carid.'') }}"><i class="mdi mdi-trash-can"></i> ລົບ</a>
                                            </div>
                                          </div>
                                        </td>
                                      </tr>   
                                    @endforeach
                                  @else
                                    <tr>
                                      <td colspan="12" class="text-center"><h4>ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ລົດ​ເທື່ອ</h4></td>
                                    </tr>
                                  @endif
                                </tbody>
                              </table>
                                {{ $carandcus->render() }}
                            </div>
                            <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">ແກ້​ໄຂ​ຂໍ້​ມູນ​ລົ​ດ</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="row">
                                            <div class="col-md-12">
                                              <form action="{{ url('/updatecar') }}" method="post">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                  <div class="col-md-3">
                                                    <div class="form-group">
                                                      <input type="hidden" name="carid" id="carid" value="">
                                                      <label for="license">ປ້າຍ​ລົດ</label>
                                                      <input id="license" class="form-control" type="text" name="license" value="" placeholder="..." required>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="brandid">ຍີ່​ຫໍ້​ລົດ</label>
                                                      <select class="form-control btn-outline-primary1" name="brandid" id="brandid">
                                                      @if (count($brands) > 0)
                                                        <option value="">***** ເລືອກ​ຍີ່​ຫໍ້​ລົດ *****</option>
                                                        @foreach ($brands as $bd)
                                                          <option value="{{ $bd->brandid }}">{{ $bd->brandname }}</option>
                                                        @endforeach
                                                      @else
                                                        <option value="">ຍັງ​ບໍ່​ມີ​ຍີ່​ຫໍ້​ລົດ​ໃນ​ລະ​ບົບ​ເທື່ອ</option>
                                                      @endif
                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="col-3">
                                                  <div class="form-group">
                                                    <label for="motornum">ເລກ​ຈັກ</label>
                                                    <input id="motornum" class="form-control" type="text" name="motornum">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="bodynum">ເລ​ກ​ຖັງ</label>
                                                    <input id="bodynum" class="form-control" type="text" name="bodynum">
                                                  </div>
                                                </div>
                                                <div class="col-3">
                                                  <div class="row">
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label for="model">ລູ້ນ</label>
                                                        <input id="model" class="form-control" type="text" name="model" value="" placeholder="..." required>
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label for="madeyear">ປີ​ຜະ​ລິດ</label>
                                                        <input id="madeyear" class="form-control" type="text" name="madeyear" value="" placeholder="..." required>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="row">
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label for="color">ສີລົດ</label>
                                                        <input id="color" class="form-control" type="text" name="color" value="" placeholder="..." required>
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label for="distance">​ເລກ​ກົງ​ເຕີ</label>
                                                        <input id="distance" class="form-control" type="number" name="distance" value="" placeholder="..." required>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="col-md-3">
                                                  <div class="form-group">
                                                    <label for="motor">​ປະ​ເພດ​ເຄື່ອງ​ຈັກ</label>
                                                    <select id="motor" class="form-control" name="motor">
                                                      <option value="">***** ເລືອກປະ​ເພດ​ລົດ *****</option>
                                                      <option value="ແອັດ​ຊັງ">ແອັດ​ຊັງ</option>
                                                      <option value="ກາ​ຊວນ">ກາ​ຊວນ</option>
                                                      <option value="ໄຟ​ຟ້າ">ໄຟ​ຟ້າ</option>
                                                    </select>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="col-md-12 text-center">
                                                  <button class="btn btn-success btn-lg" type="submit"><i class="mdi mdi-car"></i> ແກ້​ໄຂ​ຂໍ້​ມູນ​ລົດ</button>
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
                </div>
            </div>
        </div>

    </div>

@include('manage.layout.foot')
<script src="{{ url('js/carsetting.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif