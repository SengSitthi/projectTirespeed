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
                            <h3>ລາຍ​ການ​ອະ​ໄຫ​ຼ່</h3>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                              <div class="input-group">
                                <button class="btn btn-primary" type="button"><a href="{{ url('spares') }}"><i class="mdi mdi-plus"></i> ໄປ​ໜ້າ​ເພີ່ມ​ອະ​ໄຫຼ່</a></button>
                                <input class="form-control" type="text" id="searchspares" name="searchspares" placeholder="ຄົ້ນ​ຫາ​ລະ​ຫັດ​ສິນ​ຄ້າ​ທີ່​ນີ້...">
                                <div id="listsparesearch"></div>
                                <div class="input-group-append">
                                  <button class="btn btn-primary" type="button" id="btnSearchspare"><i class="mdi mdi-file-document-box-search"></i> ຄົ້ນ​ຫາ</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="table-responsive">
                            <table class="table table-light">
                              <thead class="thead-light">
                                <tr>
                                  <th>ລະ​ຫັດ</th>
                                  <th>ລະ​ຫັດ​ສ້ອມ​ແປງ</th>
                                  <th>ຊື່</th>
                                  <th>ປະ​ເພດ​ອະ​ໄຫຼ່</th>
                                  <th>ລະ​ບົບ​ການ​ສ້ອມ</th>
                                  <th>ຍີ່​ຫໍ້ອະ​ໄຫຼ່</th>
                                  <th>ລຸ້ນ​ອະ​ໄຫ​ຼ່</th>
                                  <th>ຍີ່​ຫໍ້​ລົດ</th>
                                  <th>ລຸ້ນ​ລົດ</th>
                                  <th>ປີ​ຜະ​ລິດ​ລົດ</th>
                                  <th>ລາ​ຄາ​ຂາຍ</th>
                                  <th>ຫົວ​ໜ່ວຍ</th>
                                  <th class="text-center">ພິມ​ບາ​ຣ໌​ໂຄດ</th>
                                  <th class="text-center">ຈັດ​ການ</th>
                                </tr>
                              </thead>
                              <tbody id="sparelist">
                              @if (count($sparelist) > 0)
                                @foreach ($sparelist as $sl)
                                <tr>
                                  <td>{{ $sl->sparesid }}</td>
                                  <td>{{ $sl->rpnoid }}</td>
                                  <td>{{ $sl->sparesname }}</td>
                                  <td>{{ $sl->typeservicename }}</td>
                                  <td>{{ $sl->typesparename }}</td>
                                  <td>{{ $sl->brandsparename }}</td>
                                  <td>{{ $sl->model }}</td>
                                  <td>{{ $sl->brandname }}</td>
                                  <td>{{ $sl->carmodel }}</td>
                                  <td>{{ $sl->madeyear }}</td>
                                  <td>{{ number_format($sl->sellprice) }}</td>
                                  <td>{{ $sl->unitname }}</td>
                                  <td class="text-center">
                                    <button class="btn btn-info" type="button" value="{{ $sl->sparesid }}" id="btnBarcode"><i class="mdi mdi-barcode"></i></button>
                                  </td>
                                  <td class="text-center">
                                    <div class="dropdown">
                                      <button id="btnManage" class="btn btn-default btn-sm btn-icon btn-transparent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></button>
                                      <div class="dropdown-menu" aria-labelledby="btnManage">
                                        <button class="dropdown-item text-center bg-info" value="{{ $sl->sparesid }}" id="btnEdit"><i class="mdi mdi-pen"></i></button>
                                        <button class="dropdown-item text-center bg-danger" value="{{ $sl->sparesid }}" id="btnDelete"><i class="mdi mdi-trash-can-outline"></i></button>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                @endforeach
                              @else
                                <tr>
                                  <td colspan="11"><h5 class="text-center text-danger">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ໃນ​ລະ​ບົບ</h5></td>
                                </tr>
                              @endif
                                
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th class="text-right" colspan="10">ຈຳ​ນວນ​ແຖວ</th>
                                  <th class="text-center"><b id="rowcount">{{ $rowcount }}</b></th>
                                </tr>
                              </tfoot>
                            </table>
                            {{ $sparelist->render() }}
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="barcodeprint" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <form action="{{ url('printBarcode') }}" method="post">
                      @csrf
                      <div class="form-group">
                        <label for="barcodeqty">ຈຳ​ນວນ​ບາ​ຣ໌​ໂຄດ</label>
                        <input type="hidden" name="sparesid" id="sparesid" value="">
                        <input id="barcodeqty" class="form-control" type="number" name="barcodeqty" required>
                      </div>
                      <div class="text-center">
                        <button class="btn btn-info" type="submit"><i class="mdi mdi-barcode"></i> ພິມ​ບາ​ຣ໌​ໂຄດ</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div id="editspare" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <form action="{{ url('updateSpare') }}" method="post">
                      <h3>ແກ້​ໄຂ​ຂໍ້​ມູນ​ອະ​ໄຫຼ່</h3>
                      <hr>
                      @csrf
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="sparesid1">ລະ​ຫັດ​ອະ​ໄຫຼ່</label>
                            <input id="sparesid1" class="form-control" type="text" name="sparesid1" id="sparesid1" value="" required readonly>
                          </div>
                          <div class="form-group">
                            <label for="sparesname">ຊື່ອະ​ໄຫຼ່</label>
                            <input id="sparesname" class="form-control" type="text" name="sparesname" required placeholder="...">
                            <div><h5 class="text-danger">{{ $errors->first('sparesname') }}</h5></div>
                          </div>
                          <div class="form-group">
                            <label for="typeserviceid">ປະ​ເພດການ​ສ້ອມ</label>
                            <select id="typeserviceid" class="form-control" name="typeserviceid">
                              <option disabled>ເລືອກປະ​ເພດ​ການ​ສ້ອມ</option>
                              @if (count($typeservice) > 0)
                                @foreach ($typeservice as $tsv)
                                  <option value="{{ $tsv->typeserviceid }}">{{ $tsv->typeservicename }}</option>
                                @endforeach
                              @else
                                <option value="">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ລະ​ບົບ</option>
                              @endif
                            </select>
                            <div><h5 class="text-danger">{{ $errors->first('typeserviceid') }}</h5></div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="typesparesid">ປ​ະ​ເພດອະ​ໄຫຼ່</label>
                            <select id="typesparesid" class="form-control" name="typesparesid">
                              <option disabled>ເລືອກປະ​ເພດ​ອະ​ໄຫຼ່</option>
                              @if (count($typespares) > 0)
                                @foreach ($typespares as $tsp)
                                  <option value="{{ $tsp->typesparesid }}">{{ $tsp->typesparename }}</option>
                                @endforeach
                              @else
                                <option value="">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ລະ​ບົບ</option>
                              @endif  
                            </select>
                            <div><h5 class="text-danger">{{ $errors->first('typesparesid') }}</h5></div>
                          </div>
                          <div class="form-group">
                            <label for="brandspareid">ຍີ່​ຫໍ້​ອະ​ໄຫຼ່</label>
                            <select id="brandspareid" class="form-control" name="brandspareid">
                              <option disabled>ເລືອກຍີ່​ຫໍ້​ລົດ</option>
                              @if (count($brandspares) > 0)
                                @foreach ($brandspares as $bsp)
                                  <option value="{{ $bsp->brandspareid }}">{{ $bsp->brandsparename }}</option>
                                @endforeach
                              @else
                                <option value="">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ລະ​ບົບ</option>
                              @endif    
                            </select>
                            <div><h5 class="text-danger">{{ $errors->first('brandspareid') }}</h5></div>
                          </div>
                          <div class="form-group">
                            <label for="model">ລຸ້ນ​ອະ​ໄຫຼ່</label>
                            <input id="model" class="form-control" type="text" name="model" required placeholder="...">
                            <div><h5 class="text-danger">{{ $errors->first('model') }}</h5></div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="brandid">ຍີ່​ຫໍ້ລົດ</label>
                            <select id="brandid" class="form-control" name="brandid">
                              <option>ເລືອກຍີ່​ຫໍ້​ລົດ</option>
                              @if (count($brands) > 0)
                                @foreach ($brands as $bd)
                                  <option value="{{ $bd->brandid }}">{{ $bd->brandname }}</option>
                                @endforeach
                              @else
                                <option value="">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ລະ​ບົບ</option>
                              @endif  
                            </select>
                            <div><h5 class="text-danger">{{ $errors->first('brandid') }}</h5></div>
                          </div>
                          <div class="form-group">
                            <label for="carmodel">ລຸ້ນລົດ</label>
                            <input id="carmodel" class="form-control" type="text" name="carmodel" required placeholder="..." oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​ລຸ້ນ​ລົດ​ຂອງອະ​ໄຫຼ່')"
                            oninput="this.setCustomValidity('')">
                            <div><h5 class="text-danger">{{ $errors->first('carmodel') }}</h5></div>
                          </div>
                          <div class="form-group">
                            <label for="madeyear">ປີ​ຜະ​ລິດ​ລົດ</label>
                            <input id="madeyear" class="form-control" type="text" name="madeyear" required placeholder="...">
                            <div><h5 class="text-danger">{{ $errors->first('madeyear') }}</h5></div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="sellprice">ລາ​ຄາ​ຂາຍ</label>
                            <input id="sellprice" class="form-control" type="number" name="sellprice" required placeholder="...">
                            <div><h5 class="text-danger">{{ $errors->first('sellprice') }}</h5></div>
                          </div>
                          <div class="form-group">
                            <label for="unitid">ຫົວ​ໜ່ວຍ​ອະ​ໄຫຼ່</label>
                            <select id="unitid" class="form-control" name="unitid">
                              <option disabled>ເລືອກ​ຫົວ​ໜ່ວຍ​ອະ​ໄຫຼ່</option>
                              @if (count($unitspare) > 0)
                                @foreach ($unitspare as $unit)
                                  <option value="{{ $unit->unitid }}">{{ $unit->unitname }}</option>
                                @endforeach
                              @else
                                <option value="">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ຫົວ​ໜ່ວຍ​ໃນ​ລະ​ບົບ</option>
                              @endif  
                            </select>
                            <div><h5 class="text-danger">{{ $errors->first('unitid') }}</h5></div>
                          </div>
                          <div class="form-group">
                            <label for="rpnoid">ລະ​ຫັດ​ສ້ອມ​ແປງ</label>
                            <input id="rpnoid" class="form-control" type="text" name="rpnoid" maxlength="8" required placeholder="..." oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​ລາ​ຄາ​ຂາຍ')"
                            oninput="this.setCustomValidity('')">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 text-center">
                          <button class="btn btn-success" type="submit"><i class="mdi mdi-pen"></i> ແກ້​ໄຂ​ຂໍ້​ມູນ​ອະ​ໄຫຼ່</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>

    </div>

@include('manage.layout.foot')
<script src="{{ url('includes/stockjs/spareslist.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif