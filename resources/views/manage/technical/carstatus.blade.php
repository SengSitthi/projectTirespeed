@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
  <div class="wrapper">

  @include('manage.layout.nav')
  @include('manage.layout.sidemenu')

    <div class="container-fluid mt-30">
      @if (Session::get('success'))
        <script>swal("ສຳ​ເລັດ", "ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ!", "success", {timer: 3000});</script>
      @endif
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header bg-transparent py-15">
              <div class="row">
                <div class="col-md-9">
                  <h3>ສະ​ຖາ​ນະ​ລົດ</h3>
                </div>
                <div class="col-md-3">
                  <button class="btn btn-primary" type="button" id="btnAddForm" data-toggle="modal" data-target="#modal-add"><i class="mdi mdi-car-info"></i> ເພີ່ມ​ສະ​ຖາ​ນະ​ລົດ​ໃໝ່</button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-light table-striped table-bordered">
                    <thead class="text-center">
                      <tr>
                        <th>ລຳ​ດັບ</th>
                        <th>ທະ​ບຽນ​ລົດ</th>
                        <th>ວັນ​ທີ​ລົດເຂົ້າ​</th>
                        <th>ເວ​ລາລົດເຂົ້າ</th>
                        <th>​ວັນ​ທີ​ລົດອອກ</th>
                        <th>ເວ​ລາ​ລົດອອກ</th>
                        <th>ສະ​ຖາ​ນະ</th>
                        <th>ໝາຍ​ເຫດ</th>
                        <th>ແກ້​ໄຂ​ສະ​ຖາ​ນະ</th>
                        <th>ລຶບ</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($techcarstatus) > 0)
                        @foreach($techcarstatus as $tcs)
                          <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center">{{ $tcs->license }}</td>
                            <td class="text-center">{{ $tcs->date_in }}</td>
                            <td class="text-center">{{ $tcs->time_in }}</td>
                            <td class="text-center">
                              @if ($tcs->date_out == "")
                                <button class="btn btn-primary btn-sm" type="button" id="btnUpdateDate" value="{{ $tcs->tcsid }}"><i class="mdi mdi-calendar"></i></button>
                              @else
                                {{ $tcs->date_out }}
                              @endif
                            </td>
                            <td class="text-center">
                              @if ($tcs->time_out == "")
                                <button class="btn btn-primary btn-sm" type="button" id="btnUpdateTime" value="{{ $tcs->tcsid }}"><i class="mdi mdi-av-timer"></i></button>
                              @else
                                {{ $tcs->time_out }}
                              @endif
                            </td>
                            <td class="text-center">
                              @if ($tcs->status == "1")
                                <b>ລົດ​ກຳ​ລັງ​ລໍ​ຖ້າ​ສ້ອມ</b>
                              @endif
                              @if ($tcs->status == "2")
                                <b>ລົດ​ກຳ​ລັງ​ລໍ​ຖ້າ​ອະ​ໄຫຼ່</b>
                              @endif
                              @if ($tcs->status == "3")
                                <b>ລົດ​ກຳ​ລັງ​ສ້ອມ</b>
                              @endif
                              @if ($tcs->status == "4")
                                <b>ສ້ອມ​ສຳ​ເລັດ</b>
                              @endif
                              @if ($tcs->status == "5")
                                <b>ສົ່ງ​ລົດ​​ລູກ​ຄ້າ</b>
                              @endif
                            </td>
                            <td>{{ $tcs->remark }}</td>
                            <td class="text-center">
                              <button class="btn btn-primary btn-sm" type="button" id="btnStatus" value="{{ $tcs->tcsid }}"><i class="mdi mdi-chevron-double-down"></i></button>
                            </td>
                            <td class="text-center">
                              <button class="btn btn-danger btn-sm" type="button" id="btnDelete" value="{{ $tcs->tcsid }}"><i class="mdi mdi-trash-can-outline"></i></button>
                            </td>
                          </tr>
                        @endforeach
                      @else
                        <tr>
                          <th colspan="10" class="text-center">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ໃນລະ​ບົບ</th>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
              @error('rpbid')
                <script>swal("ຜິດ​ພາດ!","ທ່ານ​ຍັງ​ບໍ່​ໄດ້​ເລືອກ​ໃບ​ແຈ້ງ​ສ້ອມ!","warning", {timer: 3000});</script>
              @enderror
              <div class="row">
                <div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addformtitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title" id="addformtitle">ເພີ່ມ​ສະ​ຖາ​ນະລົດໃໝ່​</h3>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="{{ url('intechcarstatus') }}">
                          {{ csrf_field() }}
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="rpbid">ເລືອກ​ໃບ​ແຈ້ງ​ສ້ອມ</label>
                                <select id="rpbid" class="form-control" name="rpbid" style="width: 100%">
                                  <option value="">*** ເລືອກ​ໃບ​ແຈ້ງ​ສ້ອມ ***</option>
                                  @if (count($repairbill) > 0)
                                    @foreach ($repairbill as $rpb)
                                      <option value="{{ $rpb->rpbid }}">{{ $rpb->rpbid }}</option>
                                    @endforeach
                                  @else
                                    <option value="">ຍັງ​ບໍ່​ມີ​ໃບ​ແຈ​້ງ​ສ້ອມ​ໃນ​ລະ​ບົບ</option>
                                  @endif
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="license">ທະ​ບຽນ​ລົດ</label>
                                <input id="license" class="form-control" type="text" name="license" value="" required readonly>
                              </div>
                              <div class="form-group">
                                <label for="date_in">ວັນ​ທີ່​ລົດ​ເຂົ້າ</label>
                                <input id="date_in" class="form-control" type="text" name="date_in" value="" readonly>
                              </div>
                              <div class="form-group">
                                <label for="time_in">ເວ​ລາ​ລົດ​ເຂົ້າ</label>
                                <input id="time_in" class="form-control" type="text" name="time_in" value="" readonly>
                              </div>
                              <div class="form-group">
                                <label for="remark">ໝາຍ​ເຫດ</label>
                                <textarea id="remark" class="form-control" name="remark" rows="3"></textarea>
                              </div>
                              <div class="form-group text-center">
                                <button class="btn btn-success" type="submit"><i class="mdi mdi-plus"></i> ເພີ່ມ​ລາຍ​ການ​ໃໝ່</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div id="modalDateout" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalDateout-title" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalDateout-title">ແກ້​ໄຂວັນ​ທີ່​ລົດ​ອອກ</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ url('updateDateout') }}" method="post">
                          {{ csrf_field() }}
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="date_out">ວັນ​ທີ​ລົດ​ອອກ</label>
                                <input type="hidden" name="editdate_out" id="editdate_out" value="">
                                <input id="date_out" class="form-control" type="text" name="date_out" required>
                              </div>
                              <div class="form-group text-center">
                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-calendar-month"></i> ບັນ​ທຶກ</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div id="modalTimeout" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTimeout-title" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalTimeout-title">ແກ້​ໄຂເວ​ລາ​ລົດ​ອອກ</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ url('updateTimeout') }}" method="post">
                          {{ csrf_field() }}
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="date_out">ເວ​ລາລົດ​ອອກ</label>
                                <input type="hidden" name="edittime_out" id="edittime_out" value="">
                                <input class="form-control" type="text" name="time_out" id="time_out" value="" required>
                              </div>
                              <div class="form-group text-center">
                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-av-timer"></i> ບັນ​ທຶກ</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div id="modalStatus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalstatus-title" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalstatus-title">ປ່ຽນ​ສະ​ຖານ​ະ​ລົດ</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ url('updateStatus') }}" method="post">
                          {{ csrf_field() }}
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="status">ສະ​ຖາ​ນະ</label>
                                <input type="hidden" name="statusid" id="statusid" value="">
                                <select id="status" class="form-control" name="status">
                                  <option value="">*** ເລືອກ​ສະ​ຖາ​ນະ ***</option>
                                  <option value="1">ລົດ​ກຳ​ລັງ​ລໍ​ຖ້າ​ສ້ອມ</option>
                                  <option value="2">ລົດ​ກຳ​ລັງ​ລໍ​ຖ້າ​ອະ​ໄຫຼ່</option>
                                  <option value="3">ລົດ​ກຳ​ລັງ​ສ້ອມ</option>
                                  <option value="4">ສ້ອມ​ສຳ​ເລັດ</option>
                                  <option value="5">ສົ່ງ​ລົດ​​ລູກ​ຄ້າ</option>
                                </select>
                              </div>
                              <div class="form-group text-center">
                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-speedometer"></i> ບັນ​ທຶກ</button>
                              </div>
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

@include('manage.layout.foot')
<script src="{{ url('includes/technical/carstatus.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif