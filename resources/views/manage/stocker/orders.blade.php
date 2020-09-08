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
                      <h3>ສັ່ງ​ຊື້​ອ​ະ​ໄຫຼ່</h3>
                    </div>
                    <div class="col-md-2 text-right">
                      <button class="btn btn-primary" type="button"><a href="{{ url('orderslist') }}"><i class="mdi mdi-clipboard-list"></i> ລາຍການສັ່ງ​ຊ​ື້</a></button>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <form method="post" action="{{ url('insertOrder') }}">
                    @csrf
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="orderid">ລະ​ຫັດ​ສັ່ງ​ຊື້</label>
                          <input id="orderid" class="form-control" type="text" name="orderid" value="OD{{$orderid}}.2020" readonly required>
                        </div>
                      </div>
                      <div class="col-md-2">
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
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="order_date">ວັນ​ທີ່​ສັ່ງ​ຊື້</label>
                            <input id="order_date" class="form-control" type="date" name="order_date">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="remark">ໝາຍ​ເຫດ</label>
                          <textarea id="remark" class="form-control" name="remark" rows="1"></textarea>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="username">ຊື່​ຜູ້​ສັ່ງ​ຊ​ື້</label>
                          <input id="username" class="form-control" type="text" name="username" value="{{ Auth::user()->name }}" readonly>
                          <input type="hidden" name="userid" value="{{ Auth::user()->id }}">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <h4>ລາຍ​ລະ​ອຽດ​ການ​ສັ່ງ​ຊື້</h4>
                      </div>
                      <table class="table table-light">
                        <thead class="thead-light">
                          <tr>
                            <th>​ລະ​ຫັດອະ​ໄຫຼ່</th>
                            <th>ຊື່​ອະ​ໄຫຼ່</th>
                            <th>ຍີ່​ຫໍ້ອະ​ໄຫຼ່</th>
                            <th>​ລຸ້ນອະ​ໄຫຼ່</th>
                            <th>​ປີ​ຜະ​ລິດ​ລົດ</th>
                            <th>ຈຳ​ນວນ</th>
                            <th>ຫົວ​ໜ່ວຍ</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody id="order_detail">
                          <tr>
                            <td>
                              <input class="form-control search" type="text" name="sparesid[]" id="1" placeholder="ໃສ່​ລະ​ຫັດ​ອະ​ໄຫຼ່..." maxlength="13" required oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​​ລະ​ຫັດ​ອະ​ໄຫຼ່')"
                                oninput="this.setCustomValidity('')">
                            </td>
                            <td>
                              <input class="form-control search" type="text" name="sparesname[]" id="sparesname1" placeholder="ໃສ່​ຊື່ອະ​ໄຫຼ່..." required oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​​ລະ​ຫັດ​ອະ​ໄຫຼ່')"
                                oninput="this.setCustomValidity('')" readonly>
                            </td>
                            <td>
                              <input type="hidden" name="brandspareid[]" id="brandspareid1">
                              <input class="form-control" type="text" name="brandsparename[]" id="brandsparename1" required readonly>
                            </td>
                            <td>
                              <input class="form-control" type="text" name="model[]" id="model1" required oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​​ລຸ້ນ​ອະ​ໄຫຼ່')"
                                oninput="this.setCustomValidity('')" readonly>
                            </td>
                            <td>
                              <input class="form-control" type="text" name="madeyear[]" id="madeyear1" required oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​​​ປີ​ຂອງ​ລົດ​')"
                                oninput="this.setCustomValidity('')" readonly>
                            </td>
                            <td>
                              <input class="form-control qty" type="number" name="orderqty[]" id="orderqty1" required oninvalid="this.setCustomValidity('ກະ​ລຸ​ນາ​ໃສ່​​​ຈຳ​ນວນສັ່ງ​')"
                                oninput="this.setCustomValidity('')">
                            </td>
                            {{-- <td>
                              <input class="form-control" type="number" name="price[]" id="price1" required readonly>
                            </td> --}}
                            <td>
                              <input type="hidden" name="unitid[]" id="unitid1" />
                              <input class="form-control" type="text" name="unitname[]" id="unitname1" readonly>
                            </td>
                            {{-- <td>
                              <input class="form-control" type="text" name="total[]" id="total1" value="0" readonly required>
                            </td> --}}
                            <td>
                              <button class="btn btn-info" type="button" id="btnAddrow"><i class="mdi mdi-plus"></i></button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12 text-center">
                        <button class="btn btn-success" type="submit"><i class="mdi mdi-plus"></i> ບັນ​ທຶກ</button>
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
<script src="{{ url('includes/stockjs/orders.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif