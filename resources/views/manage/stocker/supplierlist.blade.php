@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
    <div class="wrapper">

        @include('manage.layout.nav')

        @include('manage.layout.sidemenu')

        <div class="container-fluid mt-30">
          @if (Session::get('success'))
            <script>swal({
              title: 'ສຳ​ເລັດ',
              text: 'ການ​ດຳ​ເນີນ​ການສຳ​ເລັດ',
              icon: 'success',
              button: false,
              timer: 3000
            });</script>
          @endif
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header bg-transparent py-15">
                  <h3>ລາຍ​ການ​ຜູ້​ສະ​ໜອງ</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <div class="input-group">
                        <button class="btn btn-info" type="button"><a href="{{ url('supplier') }}"><i class="mdi mdi-plus"></i> ເພີ່ມ​ຜູ້​ສະ​ໜອງ</a></button>
                        <input class="form-control text-center" type="text" name="searchsupplier" id="searchsupplier" placeholder="ຄົ້ນ​ຫາ​ທີ່​ນີ້...">
                        <div id="listautosearch"></div>
                        <div class="input-group-append">
                          <button class="btn btn-info" type="button" id="btnSearchsup"><i class="mdi  mdi-file-document-box-search"></i> ຄົ້ນ​ຫາ</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <table class="table table-light">
                    <thead class="thead-light">
                      <tr>
                        <th>ລະ​ຫັດ​ຜູ້​ສະ​ໜອງ</th>
                        <th>ຊື່​ຜູ້​ສະ​ໜອງ</th>
                        <th>​ພາ​ສີ​ອາ​ກອນ</th>
                        <th>​ບ້ານ</th>
                        <th>ເມືອງ​</th>
                        <th>ແຂວງ</th>
                        <th>​ເບີ​ມື​ຖື</th>
                        <th>ເບີ​ຕິດ​ຕໍ່​ດ​່ວນ</th>
                        <th>​ແຟັກ</th>
                        <th>​ຈັດ​ການ</th>
                      </tr>
                    </thead>
                    <tbody id="supplierlist">
                      @if(count($supplierlist) >0)
                        @foreach($supplierlist as $splist)
                      <tr>
                        <td>{{ $splist->supplierid }}</td>
                        <td>{{ $splist->suppliername }}</td>
                        <td>{{ $splist->suppliertax }}</td>
                        <td>{{ $splist->village }}</td>
                        <td>{{ $splist->disname }}</td>
                        <td>{{ $splist->proname }}</td>
                        <td>{{ $splist->mobile }}</td>
                        <td>{{ $splist->phone }}</td>
                        <td>{{ $splist->fax }}</td>
                        <td>
                          <div class="dropdown d-inline">
                            <button class="btn btn-default btn-sm btn-icon btn-transparent" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="mdi mdi-dots-horizontal"></i>
                            </button>
                            <div class="dropdown-menu">
                              <button class="btn btn-primary" type="button" id="btnEditsup" value="{{ $splist->supplierid }}"><i class="mdi mdi-pen"></i> ແກ້​ໄຂ​ຂໍ​້​ມູນ</button>
                              <button class="btn btn-info" type="button" id="btnEditBank" value="{{ $splist->supplierid }}"><i class="mdi mdi-pen"></i> ເພີ່ມ,ແກ້​ໄຂ​ບັນ​ຊີ</button>
                              <button class="btn btn-danger" type="button" id="btnDeletesup" value="{{ $splist->supplierid }}"><i class="mdi mdi-trash-can-outline"></i> ລືບ​ຂໍ້​ມູນ​</button>
                            </div>
                          </div>
                        </td>
                      </tr>
                        @endforeach
                      @else
                        <tr>
                          <td colspan="10"><h5 class="text-center">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ໃນ​ລະ​ບົບ</h5></td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                  {{ $supplierlist->render() }}
                </div>
              </div>
            </div>
          </div>

          {{-- modal edit supplier account --}}
          <div id="modalupdatesup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edittitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <form action="{{ url('updateSupplier') }}" method="POST">
                  <div class="modal-header">
                    <h5 class="modal-title" id="edittitle">ແກ້​ໄຂ​ຂໍ້​ມູນ​ຜູ້​ສະ​ໜອງ</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @csrf
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="supplierid">ລະ​ຫັດ​ຜູ້​ສະ​ໜອງ</label>
                          <input id="supplierid" class="form-control" type="text" name="supplierid" value="" readonly required>
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
                      <div class="col-md-4">
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
                      <div class="col-md-4">
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
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="btnsubmit"><i class="mdi mdi-pen"></i> ແກ້​ໄຂ​ຂໍ້​ມູນ</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal" title="ຍົກ​ເລີກ"><i class="mdi mdi-close-circle close"></i></button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          {{-- modal manage account bank --}}
          <div id="managebank" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">ແກ້​ໄຂຂໍ້​ມູນ​ບັນ​ຊີ​ທະ​ນາ​ຄານ</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="bankname">ຊື່​ທະ​ນາ​ຄານ</label>
                        <input type="hidden" id="supaccountid" name="supaccountid" value="">
                        <input type="hidden" id="supplierid" name="supplierid" value="">
                        <input id="bankname" class="form-control" type="text" name="bankname">
                        <p id="alertbn" class="text-danger">ຊື່​ທະ​ນາ​ຄານ​ຍັງ​ເປັນ​ຄ່າ​ຫວ່າງ</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <label for="accountnum">ເລກ​ບັນ​ຊີ</label>
                      <div class="input-group">
                        <input id="accountnum" class="form-control" type="text" name="accountnum">
                        <div class="input-group-append">
                          <button class="btn btn-warning" type="button" id="btnUpdatebk"><i class="mdi mdi-pen"></i> ແກ້​ໄຂ​ຂໍ້​ມູນ</button>
                          <button class="btn btn-warning" type="button" id="btnAddbank"><i class="mdi mdi-plus"></i> ເພີ່ມ​ໃໝ່</button>
                        </div>
                      </div>
                      <p id="alertacnum" class="text-danger">ເລກ​ບັນ​ຊີຍັງ​ເປັນ​ຄ່າ​ຫວ່າງ</p>
                    </div>
                  </div>
                  <div class="alert alert-success" role="alert" id="successbank">
                    <button type="button" class="close" data-dismiss="alert"><i class="mdi mdi-close-circle"></i></button>
                    <h5><b>ສຳ​ເລັດ!</b> <i id="scalert">ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ</i></h5>
                  </div>
                  <table class="table table-light">
                    <thead>
                      <tr>
                        <th>ລຳ​ດັບ</th>
                        <th>ຊື່​ທະ​ນາ​ຄານ</th>
                        <th>ເລກ​ບັນ​ຊ​ີ</th>
                        <th class="text-center">ແກ້​ໄຂ</th>
                        <th class="text-center">ລົບ</th>
                      </tr>
                    </thead>
                    <tbody id="banklist">
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

    </div>

@include('manage.layout.foot')
<script src="{{ url('includes/stockjs/supplierlist.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif