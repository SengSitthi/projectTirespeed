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
                  <h3>ລາຍ​ການ​ໃບ​ຮັບ​ເງິນ</h3>
                </div>
                <div class="col-md-2">
                  <a href="{{ url('receiptlist') }}" class="btn btn-primary"><i class="mdi mdi-table"></i> ເບິ່ງ​ລາຍ​ການ​ທັງ​ໝົດ</a>
                </div>
                <div class="col-md-2">
                  <a href="{{ url('newreceipt') }}" class="btn btn-primary"><i class="mdi mdi-plus-thick"></i> ເພີ່ມ​ໃບ​ຮັບ​ເງິນ​ໃໝ່</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <div class="input-group">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="mdi mdi-table-search"></i></span>
                    </div>
                    <input class="form-control" type="text" name="searchreceipt" id="searchreceipt" placeholder="ຄົ້ນ​ຫາ: ເລກ​ທີ​ໃບ​ຮັບ​ເງິນ, ເລກ​ທີ​ໃບ​ຮ​ຽກ​ເກັບ, ວັນ​ທີ: {{ date('Y-m-d') }}">
                    <button class="btn btn-primary" type="button" id="btnSearch"><i class="mdi mdi-search-web"></i> ຄົ້ນ​ຫາ</button>
                  </div>
                </div>
              </div>
              <hr>
              <form action="" method="post">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-light table-bordered table-striped">
                      <thead class="text-center">
                        <tr>
                          <th>ເລກ​ທີ​ໃບ​ຮັບ​ເງິນ</th>
                          <th>ເລກ​ທີ​ໃບ​ຮຽກ​ເກັບ</th>
                          <th>ວັນ​ທີ​ອອກ​ໃບ​ຮັບ​ເງິນ</th>
                          <th>ຮັບ​ເງິນ​ຈາກ</th>
                          <th>ວັນ​ທີ​ອອກ​ໃບ​ຮຽກ​ເກັບ</th>
                          <th>ພິມ​ໃບ​ຮັບ​ເງິນ</th>
                          <th>ອື່​ນໆ</th>
                        </tr>
                      </thead>
                      <tbody class="text-center" id="receipt_data">
                        @if (count($receipts) > 0)
                          @foreach ($receipts as $rec)
                          <tr>
                            <td>{{ $rec->receiptid }}</td>
                            <td>{{ $rec->invoiceid }}</td>
                            <td>{{ $rec->receipt_date }}</td>
                            <td>{{ $rec->receipt_from }}</td>
                            <td>{{ $rec->invoice_date }}</td>
                            <td class="text-center">
                              <a href="{{ url('/printreceipt/'.$rec->receiptid) }}" class="btn btn-primary"><i class="mdi mdi-printer"></i></a>
                            </td>
                            <td>
                              <div class="btn-group dropleft">
                                <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
                                  aria-haspopup="true" aria-expanded="false">
                                  <i class="mdi mdi-dots-horizontal"></i>
                                </button>
                                <div class="dropdown-menu">
                                  <button class="dropdown-item" type="button" id="btnShowlist" value="{{ $rec->receiptid }}"><i class="mdi mdi-clipboard-list"></i> ສະ​ແດງ​ລາຍ​ການ</button>
                                  <button class="dropdown-item" type="button" id="btnEdit" value="{{ $rec->receiptid }}"><i class="mdi mdi-pen"></i> ແກ້​ໄຂ​ຂໍ້​ມູນ</button>
                                  <button class="dropdown-item" type="button" id="btnTrash" value="{{ $rec->receiptid }}"><i class="mdi mdi-trash-can-outline"></i> ລຶບ</a>
                                </div>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        @else
                          <tr>
                            <th colspan="7">ບໍ່​ມີ​ລາຍ​ການ​ໃບ​ຮຽກ​ເກັບໃນ​ລະ​ບົບ</th>
                          </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="row">
                  {{ $receipts->render() }}
                </div>
              </form>
              <div id="modalshowlist" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="list_title" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="list_title">ລາຍ​ລະ​ອຽດ​ຂອງ​ໃບ​ຮັບ​ເງິນເລກ​ທີ: <b id="showreceiptid"></b></h5>
                      <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      {{-- <div class="col-md-12"> --}}
                        <table class="table table-light table-striped table-bordered">
                          <thead class="text-center">
                            <tr>
                              <th>ລະ​ຫັດ​ບໍ​ລິ​ການ</th>
                              <th>ລາຍ​ການ</th>
                              <th>ຈຳ​ນວນ</th>
                              <th>ລາ​ຄາ</th>
                              <th>ລວມ</th>
                              <th>ສ່ວນຫຼຸດ</th>
                              <th>ລະ​ຫັດ​ແຮງ​ງານ​</th>
                              <th>​ແຮງ​ງານ</th>
                              <th>ໝາຍ​ເຫດ</th>
                              <th>ສະ​ຖານ​ະ</th>
                            </tr>
                          </thead>
                          <tbody id="receipt_detail">
                            {{-- <tr>
                              <td class="text-center"></td>
                              <td></td>
                              <td class="text-center"></td>
                              <td></td>
                              <td></td>
                              <td class="text-center"></td>
                              <td class="text-center"></td>
                              <td></td>
                              <td></td>
                              <td class="text-center"></td>
                            </tr> --}}
                          </tbody>
                        </table>
                      {{-- </div> --}}
                    </div>
                  </div>
                </div>
              </div>
              @if (Session::get('success'))
                <script>swal("ສຳ​ເລັດ!","ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ!","warning", {timer: 3000});</script>
              @endif
              <div id="modaleditreceipt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="receipt-edit" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="receipt-edit">ແກ້​ໄຂ​ຂໍ້​ມູນ​ໃບ​ຮ​ັບ​ເງິນ</h5>
                      <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ url('updateReceipt') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="receiptid" id="receiptid" value="">
                        <div class="form-group">
                          <label for="receipt_date">ວັນ​ທີ​ອອກ​ໃບ​ຮັບ​ເງິນ</label>
                          <input id="receipt_date" class="form-control" type="text" name="receipt_date" value="" required>
                        </div>
                        <div class="form-group">
                          <label for="receipt_from">ຮ​ັບ​ເງິນ​ຈ​າກ</label>
                          <input id="receipt_from" class="form-control" type="text" name="receipt_from" value="" required>
                        </div>
                        <div class="form-group text-center">
                          <button class="btn btn-success" type="submit"><i class="mdi mdi-save"></i> ບັນ​ທຶກ</button>
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
<script src="{{ url('includes/account/receiptlist.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif