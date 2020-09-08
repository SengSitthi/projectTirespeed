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
                            <div class="col-md-10">
                              <h3>ລາຍ​ການ​ສັ່ງ​ຊື້</h3>
                            </div>
                            <div class="col-md-2 text-right">
                              <button class="btn btn-primary" type="button"><a href="{{ url('orders') }}"><i class="mdi mdi-plus-thick"></i> ເພີ່ມ​ການ​ສັ່ງ​ຊ​ື້</a></button>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                              <div class="input-group">
                                <input class="form-control text-center" type="text" name="searchorder" id="searchorder" placeholder="ການ​ຄົ້ນ​ຫາ...">
                                <div class="input-group-append">
                                  <button class="btn btn-primary" type="button" id="btnSearch"><i class="mdi mdi-table-search"></i> ຄົ້ນ​ຫາ</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <br>
                          <table class="table table-light">
                            <thead class="thead-light">
                              <tr>
                                <th>ລະ​ຫັດ​ສັ່ງ​ຊື້</th>
                                <th>​ຜູ​້​ສະ​ໜອງ</th>
                                <th>ວັນ​ທີ່​ສັ່ງ​ຊື້</th>
                                <th>ໝາຍ​ເຫດ</th>
                                <th>ຊື່​ຜູ້​ສັ່ງ​ຊື້</th>
                                <th>ພິມ​ລາຍ​ການ</th>
                                <th>ຈັດ​ການ</th>
                              </tr>
                            </thead>
                            <tbody id="showorder">
                              @if (count($orders) > 0)
                                @foreach ($orders as $od)
                                <tr>
                                  <td>{{ $od->orderid }}</td>
                                  <td>{{ $od->suppliername }}</td>
                                  <td>{{ $od->orderdate }}</td>
                                  <td>{{ $od->remark }}</td>
                                  <td>{{ $od->userorder }}</td>
                                  <td>
                                    <a class="btn btn-primary" href="{{ url('/orderprint/'.$od->orderid)}}"><i class="mdi mdi-printer"></i></a>
                                  </td>
                                  <td>
                                    <div class="btn-group dropleft">
                                      <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
                                          aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                      </button>
                                      <div class="dropdown-menu">
                                        <button class="dropdown-item" id="btnOrderDetail" value="{{ $od->orderid }}"><i class="mdi mdi-format-list-numbered"></i> ລາຍ​ການ​ສັ່ງ​ຊື້</button>
                                        <button class="dropdown-item" id="btnEditOrder" value="{{ $od->orderid }}"><i class="mdi mdi-square-edit-outline"></i> ແກ້​ໄຂ​ຂໍ້​ມູນ​ສັ່ງ​ຊື້</button>
                                        <button class="dropdown-item" id="btnDelete" value="{{ $od->orderid }}"><i class="mdi mdi-trash-can-outline"></i> ລຶບ​ຂໍ້​ມູນ​ການ​ສັ່ງ​ຊື້</button>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                @endforeach
                              @else
                                <tr>
                                  <td colspan="7"><h5 class="text-danger text-center">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ສັ່ງ​ຊື້</h5></td>
                                </tr>
                              @endif
                            </tbody>
                          </table>
                          <div class="row">
                            {{ $orders->render() }}
                          </div>
                          {{-- Modal detail --}}
                          <div id="modaldetail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="orderdetail" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="orderdetail">ລາຍ​ການ​ສັ່ງ​ຊື້​ຂອງ​ບິນ</h5>
                                  <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="sparesid">ລະ​ຫັດ​ອະ​ໄຫຼ່</label>
                                        <input type="hidden" name="orderid" id="orderid" value="">
                                        <input id="sparesid" class="form-control" type="text" name="sparesid" value="" maxlength="13">
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="sparesname">ຊື່​​ອະ​ໄຫຼ່</label>
                                        <input id="sparesname" class="form-control" type="text" name="sparesname" value="" readonly>
                                      </div>
                                    </div>
                                    <div class="col-md-1">
                                      <div class="form-group">
                                        <label for="brandsparename">ຍີ່​ຫໍ້ອະ​ໄຫຼ່</label>
                                        <input type="hidden" name="brandspareid" id="brandspareid" value="">
                                        <input id="brandsparename" class="form-control" type="text" name="brandsparename" value="" readonly>
                                      </div>
                                    </div>
                                    <div class="col-md-1">
                                      <div class="form-group">
                                        <label for="model">ລຸ້ນອະ​ໄຫຼ່</label>
                                        <input id="model" class="form-control" type="text" name="model" value="" readonly>
                                      </div>
                                    </div>
                                    <div class="col-md-1">
                                      <div class="form-group">
                                        <label for="madeyear">ປີ​ຜະ​ລິດ​ລົດ</label>
                                        <input id="madeyear" class="form-control" type="text" name="madeyear" value="" readonly>
                                      </div>
                                    </div>
                                    <div class="col-md-1">
                                      <div class="form-group">
                                        <label for="orderqty">​ຈຳ​ນວນ</label>
                                        <input id="orderqty" class="form-control" type="number" name="orderqty">
                                      </div>
                                    </div>
                                    {{-- <div class="col-md-1">
                                      <div class="form-group">
                                        <label for="price">ລາ​ຄາ</label>
                                        <input id="price" class="form-control" type="text" name="price" readonly>
                                      </div>
                                    </div> --}}
                                    <div class="col-md-1">
                                      <div class="form-group">
                                        <label for="unitname">ຫົວ​ໜ່ວຍ</label>
                                        <input type="hidden" name="unitid" id="unitid" value="">
                                        <input id="unitname" class="form-control" type="text" name="unitname" value="" readonly>
                                      </div>
                                    </div>
                                    {{-- <div class="col-md-1">
                                      <div class="form-group">
                                        <label for="total">ລວມ</label>
                                        <input id="total" class="form-control" type="number" name="total" value="0" readonly>
                                      </div>
                                    </div> --}}
                                    <div class="col-md-1">
                                      <div class="form-group">
                                        <p>&nbsp;</p>
                                        <button class="btn btn-primary" type="button" id="btnAddOrder" disabled><i class="mdi mdi-plus-thick"></i> ເພີ່ມ​</button>
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
                                        <th>ລະ​ຫັດ</th>
                                        <th>ອະ​ໄຫຼ່</th>
                                        <th>ຍີ່​ຫໍ້ລົດ​</th>
                                        <th>​ລ​ຸ້ນ​ລົດ</th>
                                        <th>​ປີ​ຜະ​ລິດ​ລົດ</th>
                                        <th>​ຈຳ​ນວນ</th>
                                        {{-- <th>ລາ​ຄາ</th> --}}
                                        <th>ຫົວ​ໜ່ວຍ</th>
                                        {{-- <th>ລວມ​</th> --}}
                                        <th>ລົບ</th>
                                      </tr>
                                    </thead>
                                    <tbody id="orderlistdata">
                                      
                                    </tbody>
                                    <tfoot>
                                      <tr>
                                        <td class="text-right" colspan="6">ຈຳ​ນວນ​ລາຍ​ການ​ສັ່ງ</td>
                                        <td colspan="2"><b id="count"></b>  ລາຍ​ການ</td>
                                      </tr>
                                    </tfoot>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                          {{-- end modal --}}


                          @if (Session::get('success'))
                            <script>swal({
                              title: "ສຳ​ເລັດ",
                              text: "ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ!",
                              icon: "success",
                              button: false,
                              timer: 2500
                              });</script>
                          @endif
                          <div id="OrderModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="order-title" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="order-title">ແກ້​ໄຂ​ຂໍ້​ມູນ​ສັ່ງ​ຊື້</h5>
                                  <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="{{ url('updateOrder') }}" method="POST">
                                  @csrf
                                  <div class="modal-body">
                                    <div class="row">
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="orderid1">ລະ​ຫັດ​ສັ່ງ​ຊື້</label>
                                          <input id="orderid1" class="form-control" type="text" name="orderid1" value="" readonly required>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="supplierid">​ຜູ້​ສະ​ໜອງ</label>
                                          <select id="supplierid" class="form-control" name="supplierid">
                                            @if (count($supplier) > 0)
                                            <option value="">​ເລືອກ​ຜູ້​ສະ​ໜອງ</option>
                                              @foreach ($supplier as $sup)
                                                <option value="{{ $sup->supplierid }}">{{ $sup->suppliername }}</option>
                                              @endforeach
                                            @else
                                              <option value="">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ໃນ​ລະ​ບົບ</option>
                                            @endif                                      
                                          </select>
                                          <div><p class="text-danger">{{ $errors->first('supplierid') }}</p></div>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="orderdate">ວັນ​ທີ່​ສັ່ງ​ຊື້</label>
                                          <input id="orderdate" class="form-control" type="date" name="orderdate">
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="remark">ໝາຍ​ເຫດ</label>
                                          <textarea id="remark" class="form-control" name="remark" rows="1"></textarea>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button class="btn btn-success" type="submit"><i class="mdi mdi-pen"></i> ບັນ​ທຶກ</button>
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

@include('manage.layout.foot')
<script src="{{ url('includes/stockjs/orderslist.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif