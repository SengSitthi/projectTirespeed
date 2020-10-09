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
                  <h3>ລາຍ​ການ​ຄ່າ​ແຮງ​ງານ</h3>
                </div>
                <div class="col-md-4">
                  <a href="{{ url('wagenew') }}" class="btn btn-primary"><i class="mdi mdi-link"></i> ເພີ່ມ​ຄ່າ​ແຮງ​ງານ​ໃໝ່</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <div class="input-group">
                    <div class="input-group-append">
                      <span class="input-group-text" id=""><i class="mdi mdi-table-search"></i></span>
                    </div>
                    <input class="form-control" type="text" name="searchwage" id="searchwage" placeholder="ຄົ້ນ​ຫາ​ຂໍ້​ມູນ​ດ້ວຍ​ລະ​ຫັດ ຫຼື ຊ​ື່​ລາຍ​ການ">
                    <button class="btn btn-primary" type="button" id="btnSearchwage"><i class="mdi mdi-table-search"></i> ຄົ້ນ​ຫາ</button>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-light table-bordered table-striped">
                      <thead class="text-center">
                        <tr>
                          <th>ລະ​ຫັດ​ຄ່າ​ແຮງ​ງານ</th>
                          <th>ຊື່​ລາຍ​ການ​ຄ່າ​ແຮງ​ງານ</th>
                          <th>ປະ​ເພດ​ການ​ບໍ​ລິ​ການ</th>
                          <th>​ລະ​ບົບ​ລົດ​ຍົນ</th>
                          <th>​ຄ່າ​ແຮງ​ງານ</th>
                          <th>ປະ​ເພດ​ລົດ</th>
                          <th>ຮັບ​ປະ​ກັນ</th>
                          <th>ເວ​ລາ​ຕ​ິດ​ຕັ້ງ</th>
                          <th>ຫົວ​ໜ່ວຍ​ສ້ອມ</th>
                          <th>ອື່ນໆ</th>
                        </tr>
                      </thead>
                      <tbody id="showsearch">
                        @if (count($wages) > 0)
                          @foreach($wages as $w)
                          <tr>
                            <td class="text-center">{{ $w->wageid }}</td>
                            <td>{{ $w->wagename }}</td>
                            <td>{{ $w->typeservicename }}</td>
                            <td>{{ $w->typesparename }}</td>
                            <td class="text-center">{{ $w->cost }}</td>
                            <td class="text-center">{{ $w->tcarname }}</td>
                            <td class="text-center">{{ $w->guaranty }}</td>
                            <td class="text-center">{{ $w->timeset }}</td>
                            <td class="text-center">{{ $w->unitrpname }}</td>
                            <td class="text-center">
                              <div class="btn-group dropleft">
                                <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </button>
                                <div class="dropdown-menu">
                                  <button class="dropdown-item" id="btnEdit" value="{{ $w->wageid }}"><i class="mdi mdi-grease-pencil"></i> ແກ້​ໄຂ</button>
                                    <button class="dropdown-item" id="btnDelete" value="{{ $w->wageid }}"><i class="mdi mdi-trash-can"></i> ລຶບ</button>
                                </div>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        @else
                          <tr>
                            <td colspan="10">
                              <h3 class="text-center">ບໍ່​ມີ​ຂໍ້​ມູນ​ໃນ​ລະ​ບົບ</h3>
                            </td>
                          </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  {{ $wages->render() }}
                </div>
              </div>
              @error('typeserviceid')
                <script>swal("ຜິດ​ພາດ", "ກະ​ລຸ​ນາ​ເລ​ືອກ​ປະ​ເພດ​ບໍ​ລິ​ການ​ກ່ອນ", "warning", {timer: 3000});</script>
              @enderror
              @error('typesparesid')
                <script>swal("ຜິດ​ພາດ", "ກະ​ລຸ​ນາ​ເລ​ືອກ​ລະ​ບົບ​ຂອງ​ລົດ​ຍົນ​ກ່ອນ", "warning", {timer: 3000});</script>
              @enderror
              @if(Session::get('success'))
                <script>swal("ສຳ​ເລັດ", "ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ", "success", {timer: 3000});</script>
              @endif
              <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modaltitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <form class="modal-content" action="{{ url('updateWages') }}" method="POST">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modaltitle">ແກ້​ໄຂ​ລາຍ​ການ​ຄ່າ​ແຮງ​ງານ</h5>
                      <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      {{ csrf_field() }}
                      <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <div class="form-group">
                            <label for="wageid">ລະ​ຫັດ​ຄ່າ​ແຮງ​ງານ</label>
                            <input id="wageid" class="form-control" type="text" name="wageid" placeholder="..." required oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່ລະ​ຫັດ​ຄ່າ​ແຮງ​ງານກ່ອນ!')"
                            oninput="this.setCustomValidity('')" readonly>
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
                    </div>
                    <div class="modal-footer">
                      <div class="row">
                        <div class="col-md-12">
                          <button class="btn btn-success" type="submit"><i class="mdi mdi-content-save"></i> ບັນ​ທຶກ</button>
                          <button class="btn btn-danger" data-dismiss="modal"><i class="mdi mdi-close-circle"></i> ຍົກ​ເລີກ</button>
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

@include('manage.layout.foot')
<script src="{{ url('includes/technical/wagelist.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif