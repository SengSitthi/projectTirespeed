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
                  <h3>ລາຍ​ການ​ລະ​ຫັດ​ສ້ອມ</h3>
                </div>
                <div class="col-md-2 text-right">
                  <a href="{{ url('rpnoidlist') }}" class="btn btn-primary"><i class="mdi mdi-link"></i> ເບິ່ງລະ​ຫັດ​ສ້ອມທັງ​ໝົດ</a>
                </div>
                <div class="col-md-2 text-right">
                  <a href="{{ url('addnewrepairid') }}" class="btn btn-primary"><i class="mdi mdi-link"></i> ໜ້າເພີ່ມ​ລະ​ຫັດ​ສ້ອມ</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="mdi mdi-table-search"></i></span>
                    </div>
                    <input class="form-control" type="text" name="searchrpnoid" id="searchrpnoid">
                    <button class="btn btn-primary" type="button" id="btnSearch"><i class="mdi mdi-table-search"></i> ຄົ້ນ​ຫາ</button>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12 table-responsive">
                  <table class="table table-light table-bordered table-striped">
                    <thead>
                      <th>ລະ​ຫັດ</th>
                      <th>ລະ​ຫັດ​ອະ​ໄຫຼ່</th>
                      <th>ຊື່​ອະ​ໄຫຼ່</th>
                      <th class="text-center">ແກ້​ໄຂ</th>
                      <th class="text-center">ລົບ</th>
                    </thead>
                    <tbody id="rpnoshowlist">
                      @if(count($rpnodata) > 0)
                        @foreach($rpnodata as $rp)
                        <tr>
                          <td>{{ $rp->rpnoid }}</td>
                          <td>{{ $rp->sparesid }}</td>
                          <td>{{ $rp->sparesname }}</td>
                          <td class="text-center">
                            <button class="btn btn-primary" type="button" id="btnEdit" value="{{ $rp->rpnoid }}"><i class="mdi mdi-grease-pencil"></i></button>
                          </td>
                          <td class="text-center">
                            <button class="btn btn-danger" type="button" id="btnDelete" value="{{ $rp->rpnoid }}"><i class="mdi mdi-trash-can"></i></button>
                          </td>
                        </tr>
                        @endforeach
                      @else
                        <tr>
                          <td colspan="5">
                            <h3 class="text-center">ບໍ່​ມີ​ຂໍ້​ມູນ​ລະ​ຫັດ​ສ້ອມໃນ​ລະ​ບົບ</h3>
                          </td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
              @if (Session::get('success'))
                <script>swal("ສຳ​ເລັດ","ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ!","success", {button: false, timer: 3000});</script>
              @endif
              @error('sparesid')
                <script>swal("ຜິດ​ພາດ", "ກະ​ລຸ​ນາ​ເລືອກ​ອະ​ໄຫຼ່​ກ່ອນ","warning");</script>
              @enderror
              <div id="modalData" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modaledittile" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modaledititle">ແກ້​ໄຂ​ລະ​ຫັດ​ສ້ອມ</h5>
                      <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ url('updaterpnodata') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="editrpnoid" id="editrpnoid" value="">
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
    </div>

  </div>

@include('manage.layout.foot')
<script src="{{ url('includes/technical/rpidlist.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif