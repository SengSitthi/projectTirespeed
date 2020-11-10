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
      @if (count($errors) > 0)
        <script>swal("ຜິດ​ພາດ","ທ່ານ​ຍັງ​ບໍ່​ໄດ້​ຢືນ​ຢັນ","warning",{timer: 3000});</script>
      @endif
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header bg-transparent py-15">
              <h3>ລາຍ​ການໃບ​ສະ​ເໜີ​</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                  <div class="input-group" id="inputsearchdate">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="mdi mdi-calendar-month"></i></span>
                    </div>
                    <input class="form-control" type="text" name="txtsearch" id="txtsearch" placeholder="ຄົ້ນ​ຫາ​ຕາມ​ລະ​ຫັດ​ໃບ​ສະ​ເໜີ, ລະ​ຫັດ​ໃບ​ເປີດ​ງານ, ວັນ​ທີ່...">
                  </div>
                </div>
                <div class="col-md-1">
                  <button class="btn btn-primary" type="button" id="btnSearch"><i class="mdi mdi-feature-search"></i> ຄົ້ນ​ຫາ</button>
                </div>
                <div class="col-md-3">
                  <a href="{{ url('quotationlist') }}" class="btn btn-primary"><i class="mdi mdi-link"></i> ເບິ່ງ​ທັງ​ໝົດ</a>
                  <a href="{{ url('quotationnew') }}" class="btn btn-primary"><i class="mdi mdi-link"></i> ໄປ​ໜ້າ​ໃບ​ສະ​ເໜີ​ໃໝ່</a>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  {{-- <div class="table-responsive"> --}}
                    <table class="table table-bordered">
                      <thead class="text-center">
                        <tr>
                          <th>ລະ​ຫັດ​ໃບ​ສະ​ເໜີ</th>
                          <th>ລະ​ຫັດ​ໃບ​ເປີດ​ງານ</th>
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
                            <td>{{ $quot->rpbid }}</td>
                            <td>{{ $quot->part }}</td>
                            <td>{{ $quot->checkin_date }} {{ $quot->checkin_time }}</td>
                            <td>{{ $quot->checkout_date }} {{ $quot->checkout_time }}</td>
                            <td>{{ $quot->document_date }}</td>
                            <td>{{ $quot->expire_date }}</td>
                            <td>{{ $quot->credit_day }}</td>
                            <td>{{ $quot->instance }}</td>
                            <td>{{ $quot->receive_bill }}</td>
                            <td class="text-center">
                              <a href="{{ url('/printQuotation/'.$quot->qtid) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-printer"></i></a>
                            </td>
                            <td class="text-center">
                              <div class="btn-group dropleft">
                                <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
                                  aria-haspopup="true" aria-expanded="false">
                                  <i class="mdi mdi-dots-horizontal"></i>
                                </button>
                                <div class="dropdown-menu">
                                  <button class="dropdown-item" id="btnDetaillist" value="{{ $quot->qtid }}"><i class="mdi mdi-format-list-numbered"></i> ຢືນ​ຢັນ​ລາຍ​ການ​ສະ​ເໜີ</button>
                                  <button class="dropdown-item" id="btnEditQT" value="{{ $quot->qtid }}"><i class="mdi mdi-pen"></i> ແກ້​ໄຂ​ຂໍ້​ມູນ</button>
                                  <button class="dropdown-item" id="btnTrashQuot" value="{{ $quot->qtid }}"><i class="mdi mdi-trash-can-outline"></i> ລຶບ</a>
                                </div>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        @else
                        <tr>
                          <td colspan="12" class="text-center">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ໃບ​ສະ​ເໜີ​ໃນ​ລະ​ບົບ</td>
                        </tr>
                        @endif
                      </tbody>
                    </table>
                  {{-- </div> --}}
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 text-center">{{ $quotations->render() }}</div>
              </div>
              {{-- modal to show quotation detail --}}
              <div class="row">
                <div id="modalEditlist" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalQtdetail" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalQtdetail">ລາຍ​ລະ​ອຽດ​ໃບ​ສະ​ເໜີ</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" value="" id="qtiddetail">
                        <div class="row">
                          <table class="table table-light table-striped table-bordered">
                            <thead class="text-center">
                              <tr>
                                <th>ລະ​ຫັດ​ບໍ​ລິ​ການ</th>
                                <th>​ອະ​ໄຫຼ່​ທີ່​ໃຊ້</th>
                                <th>​ຈຳ​ນວນ</th>
                                <th>ລາ​ຄາ</th>
                                <th>ລວມ</th>
                                <th>ລະ​ຫັດ​ຄ່າ​ແຮງ​ງານ</th>
                                <th>ລາຍ​ການ​ແຮງ​ງານ</th>
                                <th>ສະ​ຖາ​ນະ</th>
                                <th>ອະ​ນຸ​ມັດ</th>
                              </tr>
                            </thead>
                            <tbody id="showqtdetaildata">
                              
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              {{-- modal edit quotation --}}
              @error('rpbid')
                <div class="amaran-wrapper bottom right">
                  <div class="amaran-wrapper-inner">
                    <div class="amaran awesome error" style="display: block;">
                      <i class="icon fa fa-ban icon-large"></i>
                      <p class="bold">ຜິດ​ພາດ!</p>
                      <p><span>ທ່າຍ​ຍັງ​ບໍ່​ໄດ້​ເລືອກ​ໃບ​ເປີ​ດ​ງານ​ເທື່ອ!</span>
                        <span class="light">​ກະ​ລ​ຸ​ນາ​ເລືອກ​ລູກ​ຄ້າ​ກ່ອນ</span>
                      </p>
                    </div>
                  </div>
                </div>
              @enderror
              <div id="modalquotation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="title" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="title">ແກ້​ໄຂ​ຂໍ້​ມູນ​ໃບ​ສະ​ເໜີ​</h5>
                      <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ url('updatequotaion') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                          <div class="col-md-2">
                            <div class="form-group">
                              <label for="qtid">ລະ​ຫັດ​ໃບ​ສະ​ເໜີ</label>
                              <input class="form-control" type="text" id="qtid" name="qtid" value="" readonly>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label for="rpbid">ເລືອກ​ໃບ​ເປີດ​ງານ</label>
                              <input class="form-control" type="text" id="rpbid" name="rpbid" value="" readonly>
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

@include('manage.layout.foot')
  <script src="{{ url('js/quotationlist.js') }}"></script>
@else
  <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif