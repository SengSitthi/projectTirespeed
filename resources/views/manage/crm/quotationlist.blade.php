@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
  <div class="wrapper">

  @include('manage.layout.nav')
  @include('manage.layout.sidemenu')

    <div class="container-fluid mt-30">
      @if($message=Session::get('success'))
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
              <h3>ລາຍ​ການໃບ​ສະ​ເໜີ​</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-3">
                  <div class="input-group">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="mdi mdi-card-search"></i></span>
                    </div>
                    <select id="searchstyle" class="form-control" name="searchstyle">
                      <option value="">ຮູ​ບ​ແບບ​ການ​ຄົ້ນ​ຫາ</option>
                      <option value="searchid">ຄົ້ນ​ຫາ​ຕາມ​ລະ​ຫັດ​ໃບ​ສະ​ເໜີ</option>
                      <option value="searchdate">ຄົ້ນ​ຫາ​ຕາມ​ວັນ​ທີ່ອອກ​ໃບ​ສະ​ເໜີ</option>
                      <option value="searchname">ຄົ​້ນ​ຫາ​ຕາມ​ລາຍ​ຊື່</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="input-group" id="inputsearchdate">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="mdi mdi-calendar-month"></i></span>
                    </div>
                    <input class="form-control" type="text" name="txtsearchdate" id="txtsearchdate" placeholder="ຄົ້ນ​ຫາ​ຕາມ​ວັນ​ທີ່ອອກ​ໃບ​ສະ​ເໜີ">
                  </div>
                  <div class="input-group" id="inputsearchid">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="mdi mdi-table-search"></i></span>
                    </div>
                    <input class="form-control" type="text" name="txtsearchid" id="txtsearchid" placeholder="ຄົ້ນ​ຫາ​ຕາມ​ລະ​ຫັດ​ໃບ​ສະ​ເໜີ">
                  </div>
                  <div class="input-group" id="inputsearchname">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="mdi mdi-account-search"></i></span>
                    </div>
                    <input class="form-control" type="text" name="txtsearchname" id="txtsearchname" placeholder="ຄົ້ນ​ຫາ​ຕາມ​ລາຍ​ຊື່​ລູກ​ຄ້າ">
                  </div>
                </div>
                <div class="col-md-2">
                  <button class="btn btn-primary" type="button" id="btnSearch"><i class="mdi mdi-feature-search"></i> ຄົ້ນ​ຫາ</button>
                </div>
                <div class="col-md-2">
                  <a href="{{ url('quotationlist') }}" class="btn btn-primary"><i class="mdi mdi-link"></i> ເບິ່ງ​ທັງ​ໝົດ</a>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead class="text-center">
                        <tr>
                          <th>ລະ​ຫັດ​ໃບ​ສະ​ເໜີ</th>
                          <th>​ຊື່​ລູກ​ຄ້າ</th>
                          <th>ທະ​ບຽນ​ລົດ</th>
                          <th>ພາກ​ສ່ວນ</th>
                          <th>ວັນ​ທີ​ເວ​ລາ​ເຂົ້າ</th>
                          <th>ວັນ​ທີ​ເວ​ລາ​ອອກ</th>
                          <th>ວັນ​ທີ່​ອອກ​ເອ​ກະ​ສານ</th>
                          <th>ວັນ​ທີ່​ໝົດ​ກຳ​ນົດ</th>
                          <th>ເຄ​ຣ​ດິດ</th>
                          <th>ເລ​ກ​ກົງ​ເຕີ</th>
                          <th>ເລກ​ທີ​ໃບ​ຮັບ​ລົດ</th>
                          <th>ພິມ</th>
                          <th>ລາຍ​ການ​ອື່ນໆ</th>
                        </tr>
                      </thead>
                      <tbody id="showquotation">
                      @if(count($quotations) > 0)
                        @foreach($quotations as $quot)
                        <tr>
                          <td>{{ $quot->qtid }}</td>
                          <td>{{ $quot->name }} ({{ $quot->workaddress }})</td>
                          <td>{{ $quot->license }}</td>
                          <td>{{ $quot->part }}</td>
                          <td>{{ $quot->checkin_date }} {{ $quot->checkin_time }}</td>
                          <td>{{ $quot->checkout_date }} {{ $quot->checkout_time }}</td>
                          <td>{{ $quot->document_date }}</td>
                          <td>{{ $quot->expire_date }}</td>
                          <td>{{ $quot->credit_day }}</td>
                          <td>{{ $quot->instance }}</td>
                          <td>{{ $quot->receive_bill }}</td>
                          <td>
                            <a href="{{ url('/printQuotation/'.$quot->qtid) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-printer"></i></a>
                          </td>
                          <td>
                            <div class="btn-group dropleft">
                              <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                              </button>
                              <div class="dropdown-menu">
                                <button class="dropdown-item" id="btnDetaillist" value="{{ $quot->qtid }}"><i class="mdi mdi-format-list-numbered"></i> ລາຍ​ການ​ສະ​ເໜີ</button>
                                <button class="dropdown-item" id="btnEditQT" value="{{ $quot->qtid }}"><i class="mdi mdi-pen"></i> ແກ້​ໄຂ​ຂໍ້​ມູນ</button>
                                <button class="dropdown-item" id="btnTrashQuot" value="{{ $quot->qtid }}"><i class="mdi mdi-trash-can-outline"></i> ລຶບ</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      @else
                      <tr>
                        <td colspan="13" class="text-center">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ໃບ​ສະ​ເໜີ​ໃນ​ລະ​ບົບ</td>
                      </tr>
                      @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 text-center">{{ $quotations->render() }}</div>
              </div>

              {{-- // modal add and trash quotation list --}}
              <div class="row">
                <div id="modalEditlist" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12">
                            <h3>ລາຍ​ລະ​ອຽດ</h3>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-md-2">
                            <div class="form-group">
                              <label for="sparesid">ລະ​ຫັດ​ອະ​ໄຫຼ່</label>
                              <input type="hidden" name="modalqtid" id="modalqtid" value="">
                              <input id="sparesid" class="form-control sparesid" type="text" name="sparesid">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label for="sparesname">ຊື່​ອະ​ໄຫຼ່</label>
                              <input id="sparesname" class="form-control" type="text" name="sparesname" readonly>
                            </div>
                          </div>
                          <div class="col-md-1">
                            <div class="form-group">
                              <label for="unitname">ຫົວ​ໜ່ວຍ</label>
                              <input id="unitname" class="form-control" type="text" name="unitname" readonly>
                            </div>
                          </div>
                          <div class="col-md-1">
                            <div class="form-group">
                              <label for="qty">ຈຳ​ນວນ</label>
                              <input class="form-control qty" type="number" name="qty" id="qty" value="0">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label for="price">ລາ​ຄາ/ໜ່ວຍ</label>
                              <input id="price" class="form-control" type="number" name="price" value="0" readonly>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label for="total">ລວມ​ຈຳ​ນວນ​ເງິນ</label>
                              <input id="total" class="form-control" type="number" name="total" value="0" readonly>
                            </div>
                          </div>
                          <div class="col-md-1">
                            <div class="form-group">
                              <label for="wages">ຄ່າ​ແຮ​ງ​ງານ</label>
                              <input id="wages" class="form-control" type="number" name="wages" value="0">
                            </div>
                          </div>
                          <div class="col-md-1">
                            <div class="form-group">
                              <label for="save">ບັນ​ທຶກ</label><br>
                              <button class="btn btn-primary" type="button" id="btnSavenew"><i class="mdi mdi-plus-thick"></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <table class="table table-bordered table-striped">
                              <thead class="text-center">
                                <tr>
                                  <th>ລຳ​ດັບ</th>
                                  <th>ລະ​ຫັດ​ອະ​ໄຫຼ່</th>
                                  <th>ຊື່ອະ​ໄຫຼ່</th>
                                  <th>ຫົວ​ໜ່ວຍ</th>
                                  <th>ຈຳ​ນວນ</th>
                                  <th>ລາ​ຄາ/ຕໍ່​ຫົວ​ໜ່ວຍ</th>
                                  <th>ລວມລາ​ຄາ</th>
                                  <th>ຄ່າ​ແຮງ​ງານ</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody id="qtdetaildt">
                                {{-- <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td>
                                    <button class="btn btn-danger" type="button" id="btnTrash" value=""><i class="mdi mdi-trash-can"></i></button>
                                  </td>
                                </tr> --}}
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              {{-- modal edit quotations data --}}
              <div class="row">
                <div id="modalquotation" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        <div class="row">
                          <h3>ແກ້​ໄຂ​ຂໍ້​ມູນ​ໃບ​ສະ​ເໜີ</h3>
                        </div>
                        <hr>
                        <div class="row">
                          <form class="card-body" action="{{ url('updatequotations') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label for="cusid">ລູກ​ຄ້າ</label>
                                  <br>
                                  <select id="cusid" class="form-control" name="cusid">
                                    <option value="">ເລືອກ​ລູກ​ຄ້າ</option>
                                  @if (count($customers) > 0)
                                    @foreach ($customers as $cus)
                                      <option value="{{ $cus->cusid }}">{{ $cus->name }}</option>
                                    @endforeach
                                  @else
                                  <option value="">ບໍ່​ມີ​ລູກ​ຄ້າໃນ​ລະ​ບົບ</option>
                                  @endif
                                  </select>
                                </div>
                                <input type="hidden" name="editqtid" id="editqtid" value="">
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label for="carid">ເລືອກ​ລົດ​ລ​ູກ​ຄ້າ</label>
                                  <select id="carid" class="form-control" name="carid">
                                    <option value="">ເລືອກ​ລົດ​ລູກ​ຄ້າ</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label for="part">ພາກ​ສ່ວນ</label>
                                  <input id="part" class="form-control" type="text" name="part">
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label for="checkin_date">ວັນ​ທີ່​ເຂົ້າ</label>
                                  <input id="checkin_date" class="form-control" type="text" name="checkin_date" required>
                                </div>
                              </div>
                              <div class="col-md-1">
                                <div class="form-group">
                                  <label for="checkin_time">ເວ​ລາ​ເຂົ້າ</label>
                                  <input id="checkin_time" class="form-control" type="text" name="checkin_time" required>
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label for="checkout_date">ວັນ​ທີ່​ອອກ</label>
                                  <input id="checkout_date" class="form-control" type="text" name="checkout_date" required>
                                </div>
                              </div>
                              <div class="col-md-1">
                                <div class="form-group">
                                  <label for="checkout_time">ເວ​ລາ​ອອກ</label>
                                  <input id="checkout_time" class="form-control" type="text" name="checkout_time" required>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label for="document_date">ວັນ​ທີ່​ອອກ​ເອ​ກະ​ສາ​ນ</label>
                                  <input id="document_date" class="form-control" type="text" name="document_date" required>
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label for="expire_date">ວັນ​ທີ່​ໝົດ​ກຳ​ນົດ</label>
                                  <input id="expire_date" class="form-control" type="text" name="expire_date" required>
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label for="credit_day">ຈຳ​ນວນ​ມື້</label>
                                  <input id="credit_day" class="form-control" type="number" name="credit_day" readonly required>
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label for="instance">ເລກ​ກົງ​ເຕີ</label>
                                  <input id="instance" class="form-control" type="number" name="instance" required>
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label for="receive_bill">ເລກ​ທີ​ໃບ​ຮັບ​ລົດ</label>
                                  <input id="receive_bill" class="form-control" type="text" name="receive_bill" required>
                                </div>
                              </div>
                              <div class="col-md-2 text-center">
                                <p></p>
                                <button class="btn btn-success btn-lg" type="submit"><i class="mdi mdi-file-document-box-plus"></i> ບັນ​ທຶກ​ໃບ​ສະ​ເໜີ</button>
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
  <script src="{{ url('js/quotationlist.js') }}"></script>
@else
  <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif