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
            @if (Session::get('error'))
              <script>swal({
                title: "ຜິດ​ພາດ",
                text: "​ລະ​ຫັດ​ອະ​ໄຫຼ່​ປ້ອນ​ມີ​ໃນ​ລະ​ບົບແລ້ວ!",
                icon: "warning",
                button: false,
                timer: 2500
                });</script>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-transparent py-15">
                            <h3>ເພ​ີ່ມ​ອະ​ໄຫຼ່</h3>
                        </div>
                        <div class="card-body">
                          <form action="{{ url('/insertSpare') }}" method="POST">
                            
                            <div class="row">
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label for="sparesid">ລະ​ຫັດ​ອະ​ໄຫຼ່</label>
                                  <div class="input-group">
                                    <input id="sparesid" class="form-control" type="text" name="sparesid" id="sparesid" value="" required placeholder="..." oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​ລະ​ຫັດ​ອະ​ໄຫຼ່')"
                                    oninput="this.setCustomValidity('')">
                                    <div class="input-group-append">
                                        <button class="btn btn-dark" type="button" id="randomcode"><i class="mdi mdi-reload"></i> ສ້າງ​ລະ​ຫັດ​ສິນ​ຄ້າ</button>
                                    </div>
                                    <div><h5 class="text-danger">{{ $errors->first('sparesid') }}</h5></div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="sparesname">ຊື່ອະ​ໄຫຼ່</label>
                                  <input id="sparesname" class="form-control" type="text" name="sparesname" required placeholder="..." oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​ຊື່ອະ​ໄຫຼ່')"
                                  oninput="this.setCustomValidity('')">
                                  <div><h5 class="text-danger">{{ $errors->first('sparesname') }}</h5></div>
                                </div>
                                <div class="form-group">
                                  <label for="typeserviceid">ປ​ະ​ເພດອະ​ໄຫຼ່</label>
                                  <select id="typeserviceid" class="form-control" name="typeserviceid">
                                    <option value="">ເລືອກປ​ະ​ເພດອະ​ໄຫຼ່</option>
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
                                  <label for="typesparesid">ລະ​ບົບ​ການ​ສ້​ອມ</label>
                                  <select id="typesparesid" class="form-control" name="typesparesid">
                                      <option>ເລືອກ​ລະ​ບົບ​ການ​ສ​້ອມ</option>
                                      
                                  </select>
                                  <div><h5 class="text-danger">{{ $errors->first('typesparesid') }}</h5></div>
                                </div>
                                <div class="form-group">
                                  <label for="brandspareid">ຍີ່​ຫໍ້ອະ​ໄຫຼ່</label>
                                  <select id="brandspareid" class="form-control" name="brandspareid">
                                    <option>ເລືອກຍີ່​ຫໍ້​ອະ​ໄຫຼ່</option>
                                    @if (count($brandspares) > 0)
                                      @foreach ($brandspares as $bs)
                                        <option value="{{ $bs->brandspareid }}">{{ $bs->brandsparename }}</option>
                                      @endforeach
                                    @else
                                      <option value="">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ລະ​ບົບ</option>
                                    @endif  
                                  </select>
                                  <div><h5 class="text-danger">{{ $errors->first('brandspareid') }}</h5></div>
                                </div>
                                <div class="form-group">
                                  <label for="model">ລຸ້ນ​ອະ​ໄຫຼ່</label>
                                  <input id="model" class="form-control" type="text" name="model" required placeholder="..." oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​ລຸ້ນ​ຂອ​ງ​ອະ​ໄຫຼ່')"
                                  oninput="this.setCustomValidity('')">
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
                                  <input id="madeyear" class="form-control" type="text" name="madeyear" required placeholder="..." oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​ປີ​ຜະ​ລິດຂອ​ງ​ອະ​ໄຫຼ່')"
                                  oninput="this.setCustomValidity('')">
                                  <div><h5 class="text-danger">{{ $errors->first('madeyear') }}</h5></div>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label for="sellprice">ລາ​ຄາ​ຂາຍ</label>
                                  <input id="sellprice" class="form-control" type="number" name="sellprice" required placeholder="..." oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​ລາ​ຄາ​ຂາຍ')"
                                  oninput="this.setCustomValidity('')">
                                  <div><h5 class="text-danger">{{ $errors->first('sellprice') }}</h5></div>
                                </div>
                                <div class="form-group">
                                  <label for="unitid">ຫົວ​ໜ່ວຍ​ອະ​ໄຫຼ່</label>
                                  <select id="unitid" class="form-control" name="unitid">
                                    <option>ເລືອກ​ຫົວ​ໜ່ວຍ​ອະ​ໄຫຼ່</option>
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
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3">
                                <label for="createbarcode">ບາ​ຣ໌​ໂຄດ</label>
                                <div class="form-group">
                                  <div class="custom-control custom-radio">
                                    <input type="radio" id="createbarcode" name="createbarcode" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="createbarcode">ສ້າງ​ລະ​ຫັດ​ບາ​ຣ໌ໂຄດ​ໃໝ່</label>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-grop">
                                  <label for="barcodeqty">ຈຳ​ນວນ​ບາ​ຣ໌​ໂຄດ</label>
                                  <input id="barcodeqty" class="form-control" type="number" name="barcodeqty" required disabled placeholder="..." oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​ຈຳ​ນວນ​ບາ​ຣ໌​ໂຄດ​ທີ່​ຕ້ອງ​ການ​ພີມ')"
                                  oninput="this.setCustomValidity('')">
                                  <div><h5 class="text-danger">{{ $errors->first('barcodeqty') }}</h5></div>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <div class="custom-control custom-radio">
                                    <br><p></p>
                                    <input type="radio" id="createbarcode1" name="createbarcode" class="custom-control-input" value="0" checked>
                                    <label class="custom-control-label" for="createbarcode1">ມີ​ລະ​ຫັດ​ບາ​ຣ໌​ໂຄດ​ແລ້ວ</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @csrf
                            <div class="row">
                              <div class="col-md-12 text-center">
                                <button class="btn btn-success" type="submit"><i class="mdi mdi-plus"></i> ເພີ່ມ​ສິນ​ຄ້າ</button>
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
<script src="{{ url('includes/stockjs/spares.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif