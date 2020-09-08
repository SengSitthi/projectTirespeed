@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
    <div class="wrapper">

        @include('manage.layout.nav')

        @include('manage.layout.sidemenu')

        <div class="container-fluid mt-30">
          @if (Session::get('success'))
            <script>swal({
              title: "ສຳ​ເລັດ",
              text: "ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ!",
              icon: "success",
              button: false,
              timer: 2500
              });</script>
          @endif
          @error('filepdf')
            <script>swal({
              title: "ຜິດ​ພາດ",
              text: "​ເອ​ກະ​ສານ​ຕິດ​ຂັດ​ຕ້ອງ​ເປັນ​ໄຟ​ລ໌ PDF ເທົ່າ​ນັ້ນ!",
              icon: "error",
              button: true,
              });</script>
          @enderror
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-transparent py-15">
                          <div class="row">
                            <div class="col-md-8">
                              <h3>ລາຍ​ການ​ຮັບ​ອະ​ໄຫຼ່</h3>
                            </div>
                            <div class="col-md-2 text-right">
                              <a href="{{ url('receivelist') }}" class="btn btn-primary"><i class="mdi mdi-clipboard-list"></i> ລາຍ​ການ​ທັງ​ໝົດ</a></div>
                            <div class="col-md-2 text-right">
                              <a href="{{ url('receive') }}" class="btn btn-primary"><i class="mdi mdi-plus-thick"></i> ຮັບ​ອະ​ໄຫຼ່ເຂົ້າ</a>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                              <div class="input-group">
                                <input class="form-control text-center" type="text" id="receivesearch" name="receivesearch" placeholder="ຄົ້ນ​ຫາ..">
                                <div class="input-group-append">
                                  <button class="btn btn-primary" type="button" id="btnSearchreceive"><i class="mdi mdi-table-search"></i> ຄົ້ນ​ຫາ​</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <br>
                          <table class="table table-light">
                            <thead class="thead-light">
                              <tr>
                                <th>ລະ​ຫັດ​ຮັບ​ເຂົ້າ</th>
                                <th>​ລະ​ຫັດ​ໃບ​ສັ່ງ​ຊື້</th>
                                <th>​ໃບ​ແຈ້ງ​ໜີ້</th>
                                <th>​ວັນ​ທີ່​ຮັບ​ອະ​ໄຫຼ່</th>
                                <th>​ຜູ້​ຮັບ​ອະ​ໄຫຼ່​ເຂົ້າ</th>
                                <th>ຜູ້​ສົ່ງ</th>
                                <th>ເອ​ກະ​ສານ​ຕິດ​ຂັດ</th>
                                <th>ພິມ​ບິນ</th>
                                <th>​ລາຍ​ລະ​ອຽດ</th>
                              </tr>
                            </thead>
                            <tbody id="receivedata">
                              @if (count($receives) > 0)
                                @foreach($receives as $rc)
                                <tr>
                                  <td>{{ $rc->receiveid }}</td>
                                  <td>{{ $rc->orderid }}</td>
                                  <td>{{ $rc->invoicenum }}</td>
                                  <td>{{ $rc->receivedate }}</td>
                                  <td>{{ $rc->userreceive }}</td>
                                  <td>{{ $rc->sendername }}</td>
                                  <td><a class="btn btn-primary" href="{{ url('stockfiles/'.$rc->filepdf) }}" target="_tab"><i class="mdi mdi-file-download"></i></a></td>
                                  <td>
                                    <a class="btn btn-primary" href="{{ url('/receiveprint/'.$rc->receiveid) }}"><i class="mdi mdi-printer"></i></a>
                                  </td>
                                  <td>
                                    <div class="btn-group dropleft">
                                      <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
                                          aria-haspopup="true" aria-expanded="false">
                                          <i class="mdi mdi-dots-horizontal"></i>
                                      </button>
                                      <div class="dropdown-menu">
                                        <button class="dropdown-item" type="button" id="btnReceivelist" value="{{ $rc->receiveid }}{{ $rc->orderid }}"><i class="mdi mdi-clipboard-list"></i>ລາຍ​ການ​ຮັບ​ເຂົ້າ</button>
                                        <button class="dropdown-item" type="button" id="btnEditReceive" value="{{ $rc->receiveid }}"><i class="mdi mdi-playlist-edit"></i>​ແກ້​ໄຂຂໍ້​ມູນ​ຮັບ​ເຂົ້າ</button>
                                        <button class="dropdown-item" type="button" id="btnDelete" value="{{ $rc->receiveid }}"><i class="mdi mdi-delete"></i>​ລົບຂໍ້​ມູນ​ຮັບ​ເຂົ້າ</button>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                @endforeach
                              @else
                                <td colspan="7">
                                  <h5 class="text-danger text-center">ບໍ່​ມີ​ຂໍ້​ມູນ​ການ​ຮັບ​ອະ​ໄຫຼ່ໃນ​ລະ​ບົບ</h5>
                                </td>
                              @endif
                            </tbody>
                            <tfoot>
                              <tr>
                                <th class="text-right" colspan="6">ລວມ​ທັງ​ໝົດ</th>
                                <th>{{ $count }}</th>
                              </tr>
                            </tfoot>
                          </table>
                          <br>
                          <div class="row">
                            {{ $receives->render() }}
                          </div>

                          {{-- Modal detail --}}
                          <div id="modaldetail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="orderdetail" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="orderdetail">ລາຍ​ການ​ຂອງ​ບິນ <b></b></h5>
                                  <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-2">
                                      <div class="form-group">
                                        <label for="sparesid">ລະ​ຫັດ​</label>
                                        <input type="hidden" name="receivedetailid" id="receivedetailid" value="">
                                        <input type="hidden" name="receiveid" id="receiveid" value="">
                                        <input type="hidden" name="orderid" id="orderid" value="">
                                        <input id="sparesid" class="form-control" type="text" name="sparesid" value="">
                                      </div>
                                    </div>
                                    <div class="col-md-1">
                                      <div class="form-group">
                                        <label for="sparesname">ຊື່​ອະ​ໄຫຼ່</label>
                                        <input id="sparesname" class="form-control" type="text" name="sparesname" value="" readonly>
                                      </div>
                                    </div>
                                    <div class="col-md-1">
                                      <div class="form-group">
                                        <label for="brandsparename">ຍີ່​ຫໍ້</label>
                                        <input type="hidden" name="brandspareid" id="brandspareid" value="">
                                        <input id="brandsparename" class="form-control" type="text" name="brandsparename" value="" readonly>
                                      </div>
                                    </div>
                                    <div class="col-md-1">
                                      <div class="form-group">
                                        <label for="model">​ລຸ້ນ</label>
                                        <input id="model" class="form-control" type="text" name="model" value="" readonly>
                                      </div>
                                    </div>
                                    <div class="col-md-1">
                                      <div class="form-group">
                                        <label for="madeyear">​ປີ​ຜະ​ລິດ</label>
                                        <input id="madeyear" class="form-control" type="text" name="madeyear" value="" readonly>
                                      </div>
                                    </div>
                                    <div class="col-md-1">
                                      <div class="form-group">
                                        <label for="receiveqty">ຈຳ​ນວນ</label>
                                        <input id="receiveqty" class="form-control" type="number" name="receiveqty" value="0">
                                      </div>
                                    </div>
                                    <div class="col-md-1">
                                      <div class="form-group">
                                        <label for="price">​ລາ​ຄາ</label>
                                        <input id="price" class="form-control" type="number" name="price" value="0">
                                      </div>
                                    </div>
                                    <div class="col-md-1">
                                      <div class="form-group">
                                        <label for="unitname">​ຫົວ​ໜ່ວຍ</label>
                                        <input type="hidden" name="unitid" id="unitid" value="">
                                        <input id="unitname" class="form-control" type="text" name="unitname" value="" readonly>
                                      </div>
                                    </div>
                                    <div class="col-md-1">
                                      <div class="form-group">
                                        <label for="total">​ລວມ</label>
                                        <input id="total" class="form-control" type="text" name="total" value="0" readonly>
                                      </div>
                                    </div>
                                    <div class="col-md-1">
                                      <div class="form-group">
                                        <label for="remark">​ໝາຍ​ເຫດ</label>
                                        <textarea name="remark" id="remark" class="form-control" cols="10" rows="1">.</textarea>
                                      </div>
                                    </div>
                                    <div class="col-md-1">
                                      <div class="form-group">
                                        <p>&nbsp;</p>
                                        <button class="btn btn-primary" type="button" id="btnAddnew"><i class="mdi mdi-plus-thick"></i></button>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="alert alert-danger" role="alert" id="alertstatus">
                                        <button class="close" id="btnClose" title="ປິດ"><i class="mdi mdi-close-circle"></i></button>
                                        <h5><b id="status"></b> <i id="textstatus"></i></h5>
                                      </div>
                                    </div>
                                  </div>
                                  <table class="table table-light">
                                    <thead class="thead-light">
                                      <tr>
                                        <th>ລຳ​ດັບ</th>
                                        <th>ລະ​ຫັດ</th>
                                        <th>ຊື່ອະ​ໄຫຼ່</th>
                                        <th>ຍີ່​ຫໍ້​ອະ​ໄຫຼ່</th>
                                        <th>​ລ​ຸ້ນ</th>
                                        <th>​ປີ​ຜະ​ລິດ</th>
                                        <th>​ຈຳ​ນວນ</th>
                                        <th>ລາ​ຄາ</th>
                                        <th>ຫົວ​ໜ່ວຍ</th>
                                        <th>ລວມ</th>
                                        <th>ໝາຍ​ເຫດ</th>
                                        <th class="text-center">ລົບ</th>
                                      </tr>
                                    </thead>
                                    <tbody id="showreceivelist">
                                      
                                    </tbody>
                                    <tfoot>
                                      <tr>
                                        <th class="text-right" colspan="9">ຈຳ​ນວນ​ລາຍ​ການ​ຮັບ</th>
                                        <th><b id="receivecount"></b> ລາຍ​ການ</th>
                                      </tr>
                                    </tfoot>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>

                          {{-- modal edit receive data --}}
                          <div id="modalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mdeditreceive" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <form class="modal-content" action="{{ url('updateReceive') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="modal-header">
                                  <h5 class="modal-title" id="mdeditreceive">ແກ້​ໄຂ​ຂໍ້​ມູນ​ຮ​ັບ​ສິນ​ຄ້າ</h5>
                                  <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <input type="hidden" name="updatereceiveid" id="updatereceiveid" value="">
                                        <label for="invoicenum">ໃບ​ແຈ້ງ​ໜີ້</label>
                                        <input id="invoicenum" class="form-control" type="text" name="invoicenum" value="" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="receive_date">ວັນ​ທີ່​ຮັບ​ອະ​ໄຫຼ່</label>
                                        <input id="receive_date" class="form-control" type="text" name="receive_date" value="" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="sendername">ຊື່ຜູ້​ສົ່ງ</label>
                                        <input id="sendername" class="form-control" type="text" name="sendername" value="" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="filepdf">​ເອ​ກະ​ສານ​ຕິດ​ຂ​ັດ</label>
                                        <div class="custom-file">
                                          <input id="filepdf" class="custom-file-input" type="file" name="filepdf">
                                          <label class="custom-file-label" for="filepdf" id="showfilename"></label>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-success" type="submit"><i class="mdi mdi-pen"></i> ແກ້​ໄຂ​ຂໍ້​ມູນ</button>
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
<script src="{{ url('includes/stockjs/receivelist.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif