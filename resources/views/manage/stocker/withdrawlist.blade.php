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
    <div class="row">
      <div class="col-lg-12">
                  
        <div class="card">
          <div class="card-header bg-transparent py-15">
            <div class="row">  
              <div class="col-md-8">
                <h3>ລາຍ​ການ​ເບີກ​ອະ​ໄຫຼ່</h3>
              </div>
              <div class="col-md-2 text-right">
                <a href="{{ url('withdrawlist') }}" class="btn btn-primary"><i class="mdi mdi-clipboard-list"></i> ເບິ່ງ​ລາຍ​ການ​ທັງ​ໝົດ</a>
              </div>
              <div class="col-md-2 text-right">
                <a href="{{ url('withdraw') }}" class="btn btn-primary"><i class="mdi mdi-plus-thick"></i> ເພີ່ມ​ລາຍ​ການ​ເບີກ</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4"></div>
                <div class="col-md-4">
                  <div class="input-group">
                    <input class="form-control text-center" type="text" name="searchwithdraw" id="searchwithdraw" placeholder="ຄົ້ນ​ຫາ​ຂໍ້​ມູນ">
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="btnSearchwd"><i class="mdi mdi-table-search"></i> ຄົ້ນ​ຫາ</button>
                      </div>
                    </div>
                  </div>
                </div>
                <br>
                <table class="table table-bordered table-striped">
                  <thead class="thead-light">
                    <tr>
                      <th>ລະ​ຫັດ​ເບີກ​ອະ​ໄຫຼ່</th>
                      <th>ຜູ້​ຂໍ​ເບີກ</th>
                      <th>ໃບ​ຮັບ​ລົດ/ເປີດ​ງານ</th>
                      <th>ວັນ​ທີ່​ເບີກ​ອະ​ໄຫຼ່</th>
                      <th>​ຊື່ລຸກ​ຄ້າ</th>
                      <th>ທະ​ບຽນ​ລົດ</th>
                      <th>ຜູ້​ເບີກ​ອະ​ໄຫຼ່</th>
                      <th>ພິມ​ໃບ​ບິນ</th>
                      <th>ເອ​ກະ​ສານຕິດ​ຂັດ</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="wdsearchdata">
                    @if(count($withdraws) > 0)
                      @foreach($withdraws as $wd)
                        <tr>
                          <td>{{ $wd->withdrawid }}</td>
                          <td>{{ $wd->userrequest }}</td>
                          <td>{{ $wd->receivecartitle }}</td>
                          <td>{{ $wd->withdrawdate }}</td>
                          <td>{{ $wd->name }}</td>
                          <td>{{ $wd->license }}</td>
                          <td>{{ $wd->userwithdraw }}</td>
                          <td>
                            <a href="{{ url('withdrawprint/'.$wd->withdrawid) }}" class="btn btn-primary"><i class="mdi mdi-printer"></i></a>
                          </td>
                          <td>
                            <a href="{{ url('stockfiles/'.$wd->receivecarfile) }}" class="btn btn-primary" target="_blank" title="ດາວ​ໂຫຼດ​ເອ​ກະ​ສານ​ຕິດ​ຂັດ"><i class="mdi mdi-download"></i></a>
                          </td>
                          <td>
                            <div class="btn-group dropleft">
                              <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                              </button>
                              <div class="dropdown-menu">
                                <button class="dropdown-item" id="btnDetaillist" value="{{ $wd->withdrawid }}"><i class="mdi mdi-format-list-numbered"></i> ລາຍ​ການ​ເບີກ</button>
                                  <button class="dropdown-item" id="btnEditdata" value="{{ $wd->withdrawid }}"><i class="mdi mdi-pen"></i> ແກ້​ໄຂ​ຂໍ້​ມູນ</button>
                                  <button class="dropdown-item" id="btnTrashdata" value="{{ $wd->withdrawid }}"><i class="mdi mdi-trash-can-outline"></i> ລຶບ</button>
                              </div>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      @else
                        <tr>
                          <td colspan="10">
                            <h3 class="text-center text-danger">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ການ​ເບີກໃນ​ລະ​ບົບ</h3>
                          </td>
                        </tr>
                      @endif
                    </tbody>
                    <tfoot>
                      <tr>
                        <td class="text-right" colspan="5">ຈຳ​ນວນ​ລາຍ​ການ​ເບີກ</td>
                        <td colspan="2"></td>
                        <td colspan="3"></td>
                      </tr>
                    </tfoot>
                  </table>
                  <div class="text-center">
                    {{ $withdraws->render() }}
                  </div>
                          {{-- alert --}}
                  <div class="amaran-wrapper bottom right" id="showalert">
                    <div class="amaran-wrapper-inner">
                      <div class="amaran awesome error" style="display: block;" id="showtheme">
                        <i class="icon fa fa-ban icon-large" id="showicon"></i>
                        <p class="bold" id="showalerttitle"></p>
                        <p><span id="showalertdata"></span>
                          <span class="light" id="showalertdetail"></span>
                        </p>
                      </div>
                    </div>
                  </div>

                  <div id="withdrawlist" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="withdrawlisttitle" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="withdrawlisttitle">ລາຍ​ການ​ເບີກ​</h5>
                          <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-6">
                              <h5>ລະ​ຫັດ​ສິນ​ຄ້າ: <b id="showsparesid"></b></h5>
                            </div>
                            <div class="col-md-6">
                              <h5 class="text-center">ຈຳ​ນວນ​ຍັງ​ເຫຼືອ: <b id="showremainstock"></b></h5>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <div class="form-group">
                                <input type="hidden" name="withdrawaddid" id="withdrawaddid" value="">
                                <label for="sparesid">ລະ​ຫັດ​ອະ​ໄຫຼ່</label>
                                <input class="form-control keysparesid" type="text" name="sparesid" id="sparesid" maxlength="13" required placeholder="ໃສ່​ລະ​ຫັດ​ສິນ​ຄ້າ">
                              </div>
                            </div>
                            <div class="col-md-1">
                              <div class="form-group">
                                <label for="sparesname">ຊື່​ອະ​ໄຫຼ່</label>
                                <input class="form-control" type="text" name="sparesname" id="sparesname" readonly required>
                              </div>
                            </div>
                            <div class="col-md-1">
                              <div class="form-group">
                                <label for="brandsparename">ຍີ່​ຫໍ້</label>
                                <input type="hidden" name="brandspareid" id="brandspareid" value="">
                                <input class="form-control" type="text" name="brandsparename" id="brandsparename" required readonly>
                              </div>
                            </div>
                            <div class="col-md-1">
                              <div class="form-group">
                                <label for="model">ລຸ້ນ</label>
                                <input class="form-control" type="text" name="model" id="model" required readonly>
                              </div>
                            </div>
                            <div class="col-md-1">
                              <div class="form-group">
                                <label for="madeyear">ປີ​ຜະ​ລິດ</label>
                                <input class="form-control" type="text" name="madeyear" id="madeyear" required readonly>
                              </div>
                            </div>
                            <div class="col-md-1">
                              <div class="form-group">
                                <label for="withdrawqty">ຈຳ​ນວນ</label>
                                <input class="form-control qty" type="number" name="withdrawqty" id="withdrawqty" value="0" required>
                              </div>
                            </div>
                            <div class="col-md-1">
                              <div class="form-group">
                                <label for="price">ລາ​ຄາ</label>
                                <input class="form-control" type="number" name="price" id="price" value="0" readonly>
                              </div>
                            </div>
                            <div class="col-md-1">
                              <div class="form-group">
                                <label for="unitname">ຫົວ​ໜ່ວຍ</label>
                                <input type="hidden" name="unitid" id="unitid" value="">
                                <input class="form-control" type="text" name="unitname" id="unitname" readonly>
                              </div>
                            </div>
                            <div class="col-md-1">
                              <div class="form-group">
                                <label for="total">ລວມ</label>
                                <input class="form-control" type="number" name="total" id="total" value="0" readonly>
                              </div>
                            </div>
                            <div class="col-md-1">
                              <div class="form-group">
                                <label for="remark">ໝາຍ​ເຫດ</label>
                                <textarea name="remark" id="remark" cols="10" rows="1">.</textarea>
                              </div>
                            </div>
                            <div class="col-md-1">
                              <div class="form-group">
                                <p>&nbsp;</p>
                                <button class="btn btn-primary" type="button" id="btnAddnew"><i class="mdi mdi-plus-thick"></i></button>
                              </div>
                            </div>
                          </div>
                          <table class="table table-light">
                            <thead class="thead-light">
                              <tr>
                                <th>ລຳ​ດັບ</th>
                                <th>ລະ​ຫັດ</th>
                                <th>​ຊື່​ອະ​ໄຫຼ່</th>
                                <th>ຍີ່​ຫໍ້</th>
                                <th>ລຸ້ນ</th>
                                <th>​ປີ​ຜະ​ລິດ</th>
                                <th>​ຈຳ​ນວນ</th>
                                <th>ລາ​ຄາ</th>
                                <th>ຫົວ​ໜ່ວຍ</th>
                                <th>ລວມ</th>
                                <th>​ໝາຍ​ເຫດ</th>
                                <th>ລຶບ</th>
                              </tr>
                            </thead>
                            <tbody id="showwithdrawdt">                                      
                            
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div id="modaledit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modaledittitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modaledittitle">ແກ້​ໄຂ​ຂໍ້​ມູນ</h5>
                          <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form class="row" action="{{ url('updatewithdraw') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-md-12">
                              <input type="hidden" name="withdrawid" id="withdrawid" value="">
                              <div class="form-group">
                                <label for="withdrawdate">ວັນ​ທີ່​ເບີກ​ອະ​ໄຫຼ່</label>
                                <input class="form-control" type="text" name="withdrawdate" id="withdrawdate" required>
                              </div>
                              <div class="form-group">
                                <label for="cusid">ລູກ​ຄ້າ</label>
                                <select class="selectpicker" data-live-search="true" data-style="btn-light" tabindex="-98" id="cusid" name="cusid">
                                  @if (count($customers) > 0)
                                    @foreach ($customers as $cus)
                                      <option value="{{ $cus->cusid }}">{{ $cus->name }}</option>
                                    @endforeach
                                  @else
                                    <option value="">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ລູກ​ຄ້າ</option>
                                  @endif
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="carid">ລົດ</label>
                                <select id="carid" class="form-control" name="carid">
                                  <option value="">ເລືອກ​ລົດ​ລູກ​ຄ້າ</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="">ໃບ​ຮັບ​ລົດ/ເປີດ​ງານ</label>
                                <input class="form-control" type="text" name="receivecartitle" id="receivecartitle" value="" required>
                              </div>
                              <div class="form-group">
                                <label for="receivecarfile">ເອ​ກະ​ສານ​ຕິດ​ຄັດ</label>
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="receivecarfile" name="receivecarfile">
                                  <label class="custom-file-label" for="receivecarfile" id="showdoc"></label>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="userrequest">ຜູ້​ຂໍເບີກ​</label>
                                <input id="userrequest" class="form-control" type="text" name="userrequest" value="" required>
                              </div>
                              <div class="form-group text-center">
                                <button class="btn btn-success" type="submit"><i class="mdi mdi-pen"></i> ແກ້​ໄຂ​ຂໍ້​ມູນ</button>
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
<script src="{{ url('includes/stockjs/withdrawlist.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif