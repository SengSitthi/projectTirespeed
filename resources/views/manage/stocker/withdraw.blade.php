@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
    <div class="wrapper">

        @include('manage.layout.nav')

        @include('manage.layout.sidemenu')

        <div class="container-fluid mt-30">

          @error('receivecarfile')
            <script>swal({
              title: "ຜິດ​ພາດ",
              text: "​ເອ​ກະ​ສານ​ຕິດ​ຂັດ​ຕ້ອງ​ເປັນ​ໄຟ​ລ໌ PDF ເທົ່າ​ນັ້ນ!",
              icon: "error",
              button: true,
              });</script>
          @enderror
          @error('carid')
            <div class="amaran-wrapper bottom right">
              <div class="amaran-wrapper-inner">
                <div class="amaran awesome error" style="display: block;">
                  <i class="icon fa fa-ban icon-large"></i>
                  <p class="bold">ຜິດ​ພາດ!</p>
                  <p><span>​ທ່ານ​ຍັງ​ບໍ່​ໄດ້​ເລືອກລົດ​ລູກ​ຄ້າ</span>
                    <span class="light">​ກະ​ລ​ຸ​ນາ​ເລືອກ​​ລົດລູກ​ຄ້າ​ກ່ອນ</span>
                  </p>
                </div>
              </div>
            </div>
          @enderror
          @error('cusid')
            <div class="amaran-wrapper bottom right">
              <div class="amaran-wrapper-inner">
                <div class="amaran awesome error" style="display: block;">
                  <i class="icon fa fa-ban icon-large"></i>
                  <p class="bold">ຜິດ​ພາດ!</p>
                  <p><span>​ທ່ານ​ຍັງ​ບໍ່​ໄດ້​ເລືອກ​ລູກ​ຄ້າ</span>
                    <span class="light">​ກະ​ລ​ຸ​ນາ​ເລືອກ​ລູກ​ຄ້າ​ກ່ອນ</span>
                  </p>
                </div>
              </div>
            </div>
          @enderror

          @if($message=Session::get('error'))
            <div class="amaran-wrapper bottom right">
              <div class="amaran-wrapper-inner">
                <div class="amaran awesome error" style="display: block;">
                  <i class="icon fa fa-ban icon-large"></i>
                  <p class="bold">ຜິດ​ພາດ!</p>
                  <p><span>{{ $message }}</span></p>
                </div>
              </div>
            </div>
          @endif

          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header bg-transparent py-15">
                  <div class="row">
                    <div class="col-md-10">
                      <h3>ເບີກ​ອະ​ໄຫຼ່</h3>
                    </div>
                    <div class="col-md-2 text-right">
                      <a href="{{ url('withdrawlist') }}" class="btn btn-primary"><i class="mdi mdi-clipboard-list"></i> ລາຍ​ການ​ເບີ​ກ</a>
                    </div>
                  </div>
                </div>
                
                <div class="card-body">
                  <form action="{{ url('insertWithdraw') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="withdrawid">ລະ​ຫັດ​ເບີກ​ອະ​ໄຫຼ່</label>
                          <input class="form-control" type="text" name="withdrawid" value="WH{{ $withdrawid }}.2020" readonly>
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group">
                          <label for="withdrawdate">ວັນ​ທີ່​ເບີກ​</label>
                          <input class="form-control" type="text" name="withdrawdate" id="withdrawdate" required>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="cusid">ລູກ​ຄ້າ</label>
                          <select class="selectpicker" data-live-search="true" data-style="btn-light" tabindex="-98" id="cusid" name="cusid">
                            @if (count($customers) > 0)
                            <option value="">ເລືອກ​ລູກ​ຄ້າ</option>
                              @foreach ($customers as $cus)
                                <option value="{{ $cus->cusid }}">{{ $cus->name }}</option>
                              @endforeach
                            @else
                              <option value="">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ລູກ​ຄ້າ</option>
                            @endif
                          </select>
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group">
                          <label for="carid">ລົດ</label>
                          <select id="carid" class="form-control" name="carid">
                            <option value="">ເລືອກ​ລົດ​ລູກ​ຄ້າ</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="">ໃບ​ຮັບ​ລົດ/ເປີດ​ງານ</label>
                          <input class="form-control" type="text" name="receivecartitle" id="receivecartitle" value="" required>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <label for="receivecarfile">ເອ​ກະ​ສານ​ຕິດ​ຄັດ</label>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="receivecarfile" name="receivecarfile" required>
                          <label class="custom-file-label" for="receivecarfile" id="showdoc"></label>
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group">
                          <label for="userrequest">ຜູ້​ຂໍເບີກ​</label>
                          <input id="userrequest" class="form-control" type="text" name="userrequest" value="" required>
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group">
                          <label for="userwithdraw">ຜູ້​ເບີກ​</label>
                          <input id="userwithdraw" class="form-control" type="text" name="userwithdraw" value="{{ Auth::user()->name }}" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-8">  
                        <h4>ລາຍ​ລະ​ອຽດເບີກ​ອະ​ໄຫຼ່</h4>
                      </div>
                      <div class="col-md-2">
                        <h5>ລະ​ຫັດ​ສິນ​ຄ້າ: <b id="showsparesid"></b></h5>
                      </div>
                      <div class="col-md-2">
                        <h5 class="text-center">ຈຳ​ນວນ​ຍັງ​ເຫຼືອ: <b id="showremainstock"></b></h5>
                      </div>
                    </div>
                    <table class="table table-light">
                      <thead class="thead-light">
                        <tr class="text-center">
                          <th>​ລະ​ຫັດ​ອະ​ໄຫຼ່</th>
                          <th>​ຊື່</th>
                          <th>ຍີ່​ຫໍ້</th>
                          <th>​ລຸ້ນ</th>
                          <th>ປີ​ຜະ​ລິດ</th>
                          <th>ຈຳ​ນວນ​ເບີກ</th>
                          <th>​ລາ​ຄາ</th>
                          <th>ຫົວ​ໜ່ວຍ</th>
                          <th>ລວມ</th>
                          <th>ໝາຍ​ເຫດ</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody id="withdraw_detail">
                        <tr>
                          <td>
                            <input class="form-control keysparesid" type="text" name="sparesid[]" id="sparesid1" maxlength="13" required placeholder="ໃສ່​ລະ​ຫັດ​ສິນ​ຄ້າ">
                          </td>
                          <td>
                            <input class="form-control" type="text" name="sparesname[]" id="sparesname1" readonly required>
                          </td>
                          <td>
                            <input type="hidden" name="brandspareid[]" id="brandspareid1" value="">
                            <input class="form-control" type="text" name="brandsparename[]" id="brandsparename1" required readonly>
                          </td>
                          <td>
                            <input class="form-control" type="text" name="model[]" id="model1" required readonly>
                          </td>
                          <td>
                            <input class="form-control" type="text" name="madeyear[]" id="madeyear1" required readonly>
                          </td>
                          <td>
                            <input class="form-control qty" type="number" name="withdrawqty[]" id="withdrawqty1" value="0" required>
                          </td>
                          <td>
                            <input class="form-control" type="number" name="price[]" id="price1" value="0" readonly>
                          </td>
                          <td>
                            <input type="hidden" name="unitid[]" id="unitid1" value="">
                            <input class="form-control" type="text" name="unitname[]" id="unitname1" readonly>
                          </td>
                          <td>
                            <input class="form-control" type="number" name="total[]" id="total1" value="0" readonly>
                          </td>
                          <td>
                            <textarea name="remark[]" id="remark1" cols="15" rows="1">.</textarea>
                          </td>
                          <td>
                            <button class="btn btn-info" type="button" id="btnAddrow"><i class="mdi mdi-plus"></i></button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <br>
                    <div class="row">
                      <div class="col-md-12 text-center">
                        <button class="btn btn-success" type="submit"><i class="mdi mdi-content-save"></i> ບັ​ນ​ທຶກ</button>
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
<script src="{{ url('includes/stockjs/withdraw.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif