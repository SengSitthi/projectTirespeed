@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
    <div class="wrapper">

        @include('manage.layout.nav')

        @include('manage.layout.sidemenu')

        <div class="container-fluid mt-30">

            <div class="row">
                <div class="col-lg-12">
                  @error('filepdf')
                  <script>swal({
                    title: "ຜິດ​ພາດ",
                    text: "​ເອ​ກະ​ສານ​ຕິດ​ຂັດ​ຕ້ອງ​ເປັນ​ໄຟ​ລ໌ PDF ເທົ່າ​ນັ້ນ!",
                    icon: "error",
                    button: true,
                    });</script>
                  @enderror
                    <div class="card">
                        <div class="card-header bg-transparent py-15">
                          <div class="row">
                            <div class="col-md-10">
                              <h3>ຮັບ​ອະ​ໄຫຼ່</h3>
                            </div>
                            <div class="col-md-2 text-right">
                              <a href="{{ url('receivelist') }}" class="btn btn-primary"><i class="mdi mdi-clipboard-list"></i> ລາຍ​ການ​ຮັບ​ອະ​ໄຫຼ່</a>
                            </div>
                          </div>
                          
                        </div>
                        <div class="card-body">
                          <form action="{{ url('receivespares') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label for="receiveid">ລະ​ຫັດ​ໃບ​ຮັບ​ສິນ​ຄ້າ</label>
                                  <input id="receiveid" class="form-control" type="text" name="receiveid" value="RE{{ $receiveid }}.{{ date('Y') }}" readonly>
                                </div>
                              </div>
                              <div class="col-md-2">
                                <label for="orderid">ລະ​ຫັດ​ໃບ​ສັ່ງ​ຊື້</label>
                                <div class="form-group">
                                  <select class="selectpicker" data-live-search="true" data-style="btn-light" tabindex="-98" name="orderid" id="orderid">
                                  @if (count($orderid) > 0)
                                    @foreach ($orderid as $ord)
                                      <option value="{{ $ord->orderid }}">{{ $ord->orderid }}</option>
                                    @endforeach
                                  @else
                                    <option value="">ບໍ່​ມີ​ຂໍ້​ມູນ​ໃບ​ບິນ​ການ​ສັ່ງ​ຊີ້</option>
                                  @endif  
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label for="invoicenum">ໃບ​ແຈ້ງ​ໜີ້</label>
                                  <input id="invoicenum" class="form-control" type="text" name="invoicenum" value="">
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label for="receive_date">ວັນ​ທີ່​ຮັບ​ອະ​ໄຫຼ່</label>
                                  <input class="form-control" type="text" name="receive_date" id="receive_date" required oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​​ວັນ​ທີ່ຮັບ​ອະ​ໄຫຼ່')"
                                  oninput="this.setCustomValidity('')">
                                </div>
                              </div>
                              <div class="col-md-1">
                                <div class="form-group">
                                  <label for="sendername">ຊື້​ຜູ້​ສົ່ງ</label>
                                  <input id="sendername" class="form-control" type="text" name="sendername" required oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​​ຊື່​ຜູ້​ສົ່ງ​ອະ​ໄຫຼ່')"
                                  oninput="this.setCustomValidity('')">
                                </div>
                              </div>
                              <div class="col-md-2">
                                <label for="filepdf">​ເອ​ກະ​ສານ​ຕິດ​ຂ​ັດ</label>
                                <div class="custom-file">
                                  <input id="filepdf" class="custom-file-input" type="file" name="filepdf" required oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ເລືອກ​ເອ​ກະ​ສານ​ຕິດ​ຂັດ')"
                                    oninput="this.setCustomValidity('')">
                                    <label class="custom-file-label" for="filepdf" id="showfilename"></label>
                                </div>
                              </div>
                              <div class="col-md-1">
                                <div class="form-group">
                                  <label for="username">ຊື່ຜູ້​ຮັບ</label>
                                  <input id="username" class="form-control" type="text" name="username" value="{{ Auth::user()->name }}" readonly>
                                </div>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="table-responsive">
                                <table class="table table-light">
                                  <thead class="thead-light">
                                    <tr>
                                      <th>​ອະ​ໄຫຼ່</th>
                                      <th>ຊື່​ອະ​ໄຫຼ່</th>
                                      <th>ຍີ່​ຫໍ້​ອະ​ໄຫຼ່</th>
                                      <th>ລຸ້ນ</th>
                                      <th>ປີ​ຜະ​ລິດ</th>
                                      <th>​ຈຳ​ນວນ</th>
                                      <th>ລາ​ຄາ</th>
                                      <th>ຫົ​ວ​ໜ່ວຍ</th>
                                      <th>ລວມ</th>
                                      <th>ໝາຍ​ເຫດ</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody id="receive_detail">
                                    <tr>
                                      <td>
                                        <input class="form-control search" type="text" name="sparesid[]" id="1" maxlength="13" required oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​​ລະ​ຫັດຂອງ​ອະ​ໄຫຼ່!')"
                                        oninput="this.setCustomValidity('')" placeholder="ລະ​ຫັດ​ອະ​ໄຫຼ່.....">
                                      </td>
                                      <td>
                                        <input class="form-control" type="text" name="sparesname[]" id="sparesname1" required oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​​ລະ​ຫັດຂອງ​ອະ​ໄຫຼ່!')"
                                        oninput="this.setCustomValidity('')" placeholder="ຊື່ອະ​ໄຫຼ່....." readonly>
                                      </td>
                                      <td>
                                        <input type="hidden" name="brandspareid[]" id="brandspareid1" value="">
                                        <input class="form-control" type="text" name="brandsparename[]" id="brandsparename1" value="" readonly>
                                      </td>
                                      <td>
                                        <input type="text" name="model[]" id="model1" class="form-control" required oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​​ລຸ້ນ​ຂອງ​ອະ​ໄຫຼ່!')"
                                        oninput="this.setCustomValidity('')" readonly>
                                      </td>
                                      <td>
                                        <input class="form-control" type="text" name="madeyear[]" id="madeyear1" readonly>
                                      </td>
                                      <td>
                                        <input type="number" name="receiveqty[]" id="receiveqty1" class="form-control receiveqty" value="0" required oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​​ຈຳ​ນວນ​ຮັບ​ເຂົ້າ!')"
                                        oninput="this.setCustomValidity('')">
                                      </td>
                                      <td>
                                        <input type="number" name="price[]" id="price1" class="form-control price" value="0" required oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​​ລາ​ຄາ!')"
                                        oninput="this.setCustomValidity('')">
                                      </td>
                                      <td>
                                        <input type="hidden" name="unitid[]" id="unitid1">
                                        <input class="form-control" type="text" name="unitname[]" id="unitname1" readonly>
                                      </td>
                                      <td>
                                        <input type="number" name="total[]" id="total1" class="form-control" value="0" required readonly>
                                      </td>
                                      <td>
                                        <textarea name="remark[]" id="remark1" rows="1">.</textarea>
                                      </td>
                                      <td>
                                        <button class="btn btn-info" type="button" id="addrow"><i class="mdi mdi-plus"></i></button>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12 text-center">
                                <button class="btn btn-success" type="submit"><i class="mdi mdi-plus-thick"></i> ບັນ​ທຶກ</button>
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

@include('manage.layout.foot')
<script src="{{ url('includes/stockjs/receive.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif