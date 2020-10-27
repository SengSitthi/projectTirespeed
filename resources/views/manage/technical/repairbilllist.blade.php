@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
  <div class="wrapper">

  @include('manage.layout.nav')
  @include('manage.layout.sidemenu')

    <div class="container-fluid mt-30">
      @if(Session::get('success'))
        <script>swal("ສຳ​ເລັດ","ການ​ດຳ​ເນີນ​ການ​​ສຳ​ເລັດ!","success", {timer: 3000});</script>
      @endif
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header bg-transparent py-15">
              <div class="row">
                <div class="col-md-8">
                  <h3>ລານ​ການ​ໃບ​ເປີດ​ງານ​ສ້ອມ</h3>
                </div>
                <div class="col-md-2">
                  <a href="{{ url('repairbill_list') }}" class="btn btn-primary"><i class="mdi mdi-link"></i> ເບິ່ງ​ທັງ​ໝົດ</a>
                </div>
                <div class="col-md-2">
                  <a href="{{ url('repairbillnew') }}" class="btn btn-primary"><i class="mdi mdi-link"></i> ໄປ​ໜ້າ​ໃບ​ເປີດ​ງານ​ສ້ອມ​ໃໝ່</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-append">
                      <span class="input-group-text" id="my-addon"><i class="mdi mdi-table-search"></i></span>
                    </div>
                    <input class="form-control" id="textsearch" type="text" name="textsearch" placeholder="ຄົ້ນ​ຫາ: ລະ​ຫັດ​ໃບ​ເປີດ​ງານ, ລະ​ຫັດ​ໃບ​ຮັບ​ລົດ​, ວັນ​ທີ່ {{ date('Y-m-d') }}">
                    <button class="btn btn-primary" type="button" id="btnSearch"><i class="mdi mdi-table-search"></i> ຄົ້ນ​ຫາ</button>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12 table-responsive">
                  <table class="table table-light table-bordered table-striped">
                    <thead class="text-center">
                      <tr>
                        <th>ລະ​ຫັດ​ໃບ​ເປີດ​ງານ</th>
                        <th>ລະ​ຫັດ​ໃບ​ຮັບ​ລົດ</th>
                        <th>ວັນ​ທີ່​ອອກ​ເອ​ກະ​ສານ</th>
                        <th>​ພິມ​ໃບ​ເປີດ​ງານ</th>
                        <th>ຈັດ​ການລາຍ​ການ​</th>
                        <th>ອື່ນໆ</th>
                      </tr>
                    </thead>
                    <tbody class="text-center" id="rpbdetail">
                      @if(count($rpbills) > 0)
                        @foreach($rpbills as $rpb)
                        <tr>
                          <td>{{ $rpb->rpbid }}</td>
                          <td>{{ $rpb->rcsid }}</td>
                          <td>{{ $rpb->rpbdate }}</td>
                          <td class="text-center">
                            <a href="{{ url('/printrpbill/'.$rpb->rpbid) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-printer"></i></a>
                          </td>
                          <td><button class="btn btn-primary btn-sm" type="button" id="btnEditList" value="{{ $rpb->rpbid }}"><i class="mdi mdi-file-document-edit"></i></button></td>
                          <td class="text-center">
                            <div class="btn-group dropleft">
                              <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                              </button>
                              <div class="dropdown-menu">
                                <button class="dropdown-item" id="btnEditrpb" value="{{ $rpb->rpbid }}"><i class="mdi mdi-pen"></i> ແກ້​ໄຂ​ວັນ​ທີ່</button>
                                <button class="dropdown-item" id="btnTrashrpb" value="{{ $rpb->rpbid }}"><i class="mdi mdi-trash-can-outline"></i> ລຶບ</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      @else
                        <tr>
                          <td colspan="6">
                            <h4 class="text-center">ບໍ່​ມີ​ຂໍ້​ມູນ​ໃບ​ເປີດ​ງານ​ສ້ອມ​ໃນ​ລະ​ບົບ</h4>
                          </td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>

              <div id="modalEditlist" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="listdetail" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="listdetail">ລາຍ​ການ​ອະ​ໄຫຼ່ ແລະ ແຮງ​ງານ</h5>
                      <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-1">
                          <div class="form-group">
                            <input type="hidden" name="rpbid" id="rpbid" value="">
                            <label for="rpnoid">ລະ​ຫັດ​ບໍ​ລິ​ການ</label>
                            <input class="form-control" type="text" name="rpnoid" id="rpnoid" placeholder="ປ້ອນ​ລະ​ຫັດ​ບໍ​ລິ​ການ">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="sparename">ຊື່​ອະ​ໄຫຼ່</label>
                            <input class="form-control" type="text" name="sparename" id="sparename" readonly>
                          </div>
                        </div>
                        <div class="col-md-1">
                          <div class="form-group">
                            <label for="useqty">ຈຳ​ນວນ​ທີ່​ໃຊ້</label>
                            <input class="form-control" type="number" name="useqty" id="useqty" placeholder="#">
                          </div>
                        </div>
                        <div class="col-md-1">
                          <div class="form-group">
                            <label for="">ລະ​ຫັດ​ຄ່າແຮງ​ງານ</label>
                            <input class="form-control" type="text" name="wageid" id="wageid" placeholder="ລະ​ຫັດ​ຄ່າ​ແຮງ​ງານ">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="wagename">ຊື່​ຄ່າ​ແຮງ​ງານ</label>
                            <input class="form-control" type="text" name="wagename" id="wagename" placeholder="ຊື່​ແຮງ​ງານ" readonly>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="unitname">ຫົວ​ໜ່ວຍ</label>
                            <input class="form-control" type="text" name="unitrpname" id="unitrpname" readonly>
                          </div>
                        </div>
                        <div class="col-md-1 text-center">
                          <br>
                          <button class="btn btn-primary" type="button" id="btnSavelist"><i class="mdi mdi-plus-thick"></i></button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 table-responsive">
                          <table class="table table-light table-bordered table-striped">
                            <thead class="text-center">
                              <tr>
                                <th>ລະ​ຫັດ​ບໍ​ລິ​ການ</th>
                                <th>​ຊື່​ອະ​ໄຫຼ່</th>
                                <th>ຈຳ​ນວນ​ອະ​ໄຫຼ່</th>
                                <th>ລະ​ຫັດ​ຄ່າ​ແຮງ​ງານ</th>
                                <th>ຊື່​ແຮງ​ງານ</th>
                                <th>ຫົວ​ໜ​່ວຍ​ຄ່າ​ແຮງ​ງານ</th>
                                <th>ລ​ຶບ</th>
                              </tr>
                            </thead>
                            <tbody class="text-center" id="showrpbdetail">
                              
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              {{-- modal edit rpb data --}}
              <div id="modaleditrpb" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editrpb" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editrpb">ແກ​້​ໄຂ​ຂໍ້​ມູນ​ໃບ​ເປີດ​ງາ​ນ​ສ້ອມ</h5>
                      <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="{{ url('updateRpbdate') }}">
                        {{ csrf_field() }}
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="rpbid1">ລະ​ຫັດ​ບໍ​ລິ​ການ</label>
                              <input id="rpbid1" class="form-control" type="text" name="rpbid1" value="" readonly>
                            </div>
                            <div class="form-group">
                              <label for="rcsid">ເລກ​ທີໃບ​ຮັບ​ລົດ</label>
                              <input id="rcsid" class="form-control" type="text" name="rcsid" value="" readonly>
                              {{-- <select id="rcsid" class="form-control" name="rcsid">
                                @if (count($receivecars) > 0)
                                  @foreach ($receivecars as $rcs)
                                  <option value="{{ $rcs->rcsid }}">{{ $rcs->rcsid }}</option>
                                  @endforeach
                                @else
                                  <option value="">ຍັງ​ບໍ່​ມີ​ເລກ​ທີ​ໃບ​ຮັບ​ລົດ</option>
                                @endif
                              </select> --}}
                            </div>
                            <div class="form-group">
                              <label for="rpbdate">ວັນ​ທີ່​ໃບ​ແຈ້ງ​ສ້ອມ</label>
                              <input id="rpbdate" class="form-control" type="text" name="rpbdate" value="" required>
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
      </div>
    </div>

  </div>

@include('manage.layout.foot')
<script src="{{ url('includes/technical/repairbilllist.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif