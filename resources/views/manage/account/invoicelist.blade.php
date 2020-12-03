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
                  <h3>ລາຍ​ການ​ໃບ​ຮຽກ​ເກັບ</h3>
                </div>
                <div class="col-md-2">
                  <a href="" class="btn btn-primary"><i class="mdi mdi-link"></i> ເບິ່ງ​ທັງ​ໝົດ</a>
                </div>
                <div class="col-md-2">
                  <a href="{{ url('newinvoice') }}" class="btn btn-primary"><i class="mdi mdi-link"></i> ເພີ່ມ​ໃບ​ຮຽກ​ເກັບ</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <div class="input-group">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="mdi mdi-file-search"></i></span>
                    </div>
                    <input class="form-control" type="text" name="searchinvoice" id="searchinvoice" placeholder="​ຄົ້ນ​ຫາ: ເລກ​ທີ​ໃສ​ຮຽກ​ເກັ​ບ, ເລກ​ທີ​ໃບ​ສະ​ເໜີ, ຊື່​ບໍ​ລິ​ສັດ, ວັນ​ທີ່: {{ date('Y-m-d') }}">
                    <button class="btn btn-success" type="button" id="btnSearch"><i class="mdi mdi-card-search"></i> ຄົ້ນ​ຫາ</button>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-light table-striped table-bordered">
                    <thead class="text-center">
                      <tr>
                        <th>ເລກ​ທີໃບ​ຮຽກ​ເກັບ</th>
                        <th>​ເລກ​ທີ​ໃບ​ສະ​ເໜີ</th>
                        <th>ຊື່​ບໍ​ລິ​ສັດ</th>
                        <th>​ວັນ​ທີ​ອອກ​ໃບ​ຮຽກ​ເກັບ</th>
                        <th>ວັນ​ທີ​ວາງ​ບິນ</th>
                        <th>ວັນ​ທີ​ໝົດ​ກຳ​ນົດ</th>
                        <th>ເຄ​ດິດ​ມື້</th>
                        <th>ພິມ​ໃບ​ບິນ</th>
                        <th>ຈັດ​ການ</th>
                      </tr>
                    </thead>
                    <tbody id="invoice_list">
                      @if (count($invoices) > 0)
                        @foreach ($invoices as $inv)
                        <tr>
                          <td class="text-center">{{ $inv->invoiceid }}</td>
                          <td>{{ $inv->qtid }}</td>
                          <td>{{ $inv->cpname }}</td>
                          <td class="text-center">{{ $inv->invoice_date }}</td>
                          <td class="text-center">{{ $inv->bill_date }}</td>
                          <td class="text-center">{{ $inv->expire_date }}</td>
                          <td class="text-center">{{ $inv->credit }}</td>
                          <td class="text-center">
                            <a href="{{ url('/printinvoice/'.$inv->invoiceid) }}" class="btn btn-primary"><i class="mdi mdi-printer"></i></a>
                          </td>
                          <td class="text-center">
                            <div class="btn-group dropleft">
                              <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                              </button>
                              <div class="dropdown-menu">
                                <button class="dropdown-item" id="btnShowlist" value="{{ $inv->invoiceid }}"><i class="mdi mdi-clipboard-list"></i> ສະ​ແດງ​ລາຍ​ການ</button>
                                <button class="dropdown-item" id="btnEdit" value="{{ $inv->invoiceid }}"><i class="mdi mdi-pen"></i> ແກ້​ໄຂ​ຂໍ້​ມູນ</button>
                                <button class="dropdown-item" id="btnTrash" value="{{ $inv->invoiceid }}"><i class="mdi mdi-trash-can-outline"></i> ລຶບ</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      @else
                        <tr>
                          <th colspan="8" class="text-center">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ໃບ​ຮຽກ​ເກັບ​ໃນ​ລະ​ບົບ</th>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
              @if(Session::get('success'))
                <script>swal("ສຳ​ເລັດ","ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ!","success", {timer: 3000});</script>
              @endif
              @error('cpid')
                <script>swal("ຜິດ​ພາດ","ກະ​ລຸ​ນາເລືອກ​ບໍ​ລິ​ສັດ!","warning", {timer: 3000});</script>
              @enderror
              <div id="modalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalEdit-title" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalEdit-title">ແກ້​ໄຂ​ຂໍ້​ມູນ​ໃບ​ຮຽກ​ເກັບ</h5>
                      <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ url('updateInvoice') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="invoiceid" id="invoiceid" value="">
                        <div class="form-group">
                          <label for="cpid">ເລ​ືອກ​ບໍ​ລິ​ສັດ</label>
                          <select id="cpid" class="form-control" name="cpid" style="width: 100%">
                            <option value="">*** ເລືອກ​ບໍ​ລິ​ສັດ ***</option>
                            @if (count($company) > 0)
                              @foreach ($company as $cpn)
                                <option value="{{ $cpn->cpid }}">{{ $cpn->cpname }}</option>
                              @endforeach
                            @else
                              <option value="">ຍັງ​ບໍ່​ມ​ີ​ຂໍ້​ມູນ​ບໍ​ລິ​ສັດ​ໃນ​ລະ​ບົບ</option>
                            @endif
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="invoice_date">ວັນ​ທີ່ອອ​ກ​ໃບ​ຮຽກ​ເກັບ</label>
                          <input id="invoice_date" class="form-control" type="text" name="invoice_date" value="{{ date('Y-m-d') }}" required>
                        </div><div class="form-group">
                          <label for="bill_date">ວັນ​ທີ່ອອ​ກ​ໃບ​ຮຽກ​ເກັບ</label>
                          <input id="bill_date" class="form-control" type="text" name="bill_date" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                          <label for="expire_date">ວັນ​ທີ່​ໝົດ​ກຳ​ນົດ</label>
                          <input id="expire_date" class="form-control" type="text" name="expire_date" required>
                        </div>
                        <div class="form-group">
                          <label for="credit">ເຄ​ດິດ​ມື້</label>
                          <input id="credit" class="form-control" type="text" name="credit" required readonly>
                        </div>
                        <div class="form-group text-center">
                          <button class="btn btn-success" type="submit"><i class="mdi mdi-content-save"></i> ບັນ​ທຶກ</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <div id="invoice_detail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="invoice_detail-title" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="invoice_detail-title">ລາຍ​ລະ​ອຽດ​ຂອງ​ໃບ​ຮຽກ​ເກັບ</h5>
                      <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <table class="table table-light table-striped table-bordered">
                        <thead class="text-center">
                          <tr>
                            <th>ລະ​ຫັດ​ບໍ​ລິ​ການ​ສູນ</th>
                            <th>ລາຍ​ການ</th>
                            <th>​ຈຳ​ນວນ</th>
                            <th>​ລາ​ຄາ</th>
                            <th>ລວມ</th>
                            <th>ສ່ວຍ​ຫຼຸດ</th>
                            <th>ລະ​ຫັດ​ແຮງ​ງານ</th>
                            <th>ແຮງ​ງານ</th>
                            <th>ໝາຍ​ເຫດ</th>
                          </tr>
                        </thead>
                        <tbody id="showinvoice_detail">
                          {{-- <tr>
                            <td class="text-center"></td>
                            <td></td>
                            <td class="text-center"></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-center"></td>
                            <td></td>
                            <td></td>
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
      </div>
    </div>

  </div>

@include('manage.layout.foot')
<script src="{{ url('includes/account/invoicelist.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif