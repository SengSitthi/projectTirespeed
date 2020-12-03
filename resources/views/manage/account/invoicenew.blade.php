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
                  <h3>ໃບ​ຮຽກ​ເກັບ​ໃໝ່</h3>
                </div>
                <div class="col-md-4">
                  <a href="{{ url('invoicelist') }}" class="btn btn-primary"><i class="mdi mdi-link"></i> ໜ້າລາຍ​ການ​ຮຽກ​ເກັບ</a>
                </div>
              </div>
            </div>
            @error('qtid')
              <script>swal("ຜິດ​ພາດ","ກະ​ລຸ​ນາເລືອກ​ເລກ​ທີໃບ​ສະ​ເໜີ!","warning", {timer: 3000});</script>
            @enderror
            @error('cpid')
              <script>swal("ຜິດ​ພາດ","ກະ​ລຸ​ນາເລືອກ​ບໍ​ລິ​ສັດ!","warning", {timer: 3000});</script>
            @enderror
            <div class="card-body">
              <form action="{{ url('insertnewinvoice') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="invoiceid">ລະ​ຫັດ​ໃບ​ຮຽກ​ເກັບ</label>
                      <input id="invoiceid" class="form-control" type="text" name="invoiceid" value="{{ $invid }}" readonly required>
                    </div>
                    <div class="form-group">
                      <label for="bill_date">ວັນ​ທີ່​ວາງ​ບິນ</label>
                      <input id="bill_date" class="form-control" type="text" name="expire_date" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="qtid">ໃບ​ສະ​ເໜີ​ລາ​ຄາ</label>
                      <select id="qtid" name="qtid" style="width: 100%">
                        <option value="">*** ເລືອກ​ໃບ​ສະ​ເໜີ​ລາ​ຄາ ***</option>
                        @if (count($quotations) > 0)
                          @foreach ($quotations as $qtt)
                            <option value="{{ $qtt->qtid }}">{{ $qtt->qtid }}</option>
                          @endforeach
                        @else
                          <option value="">ຍ​ັງ​ບໍ່​ມີ​ສະ​ເໜີ​ໃນ​ລະ​ບົບ</option>
                        @endif
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="expire_date">ວັນ​ທີ່​ໝົດ​ກຳ​ນົດ</label>
                      <input id="expire_date" class="form-control" type="text" name="expire_date" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="cpid">ເລ​ືອກ​ບໍ​ລິ​ສັດ</label>
                      <select id="cpid" class="form-control" name="cpid">
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
                      <label for="credit">ເຄ​ດິດ​ມື້</label>
                      <input id="credit" class="form-control" type="text" name="credit" required readonly>
                    </div>
                    {{-- <div class="form-group">
                      <label for="discount">ສ່ວນຫຼຸດ</label>
                      <input id="discount" class="form-control" type="text" name="discount">
                    </div> --}}
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="invoice_date">ວັນ​ທີ່ອອ​ກ​ໃບ​ຮຽກ​ເກັບ</label>
                      <input id="invoice_date" class="form-control" type="text" name="invoice_date" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
                      <button class="btn btn-success btn-lg" type="submit"><i class="mdi mdi-content-save"></i> ບັນ​ທຶກ</button>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h4>ລາຍ​ລະ​ອຽດ</h4>
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
                      <tbody id="invoice_detail">
                        {{-- <tr>
                          <td>
                            <input class="form-control" type="text" name="rpnoid[]" value="" readonly>
                          </td>
                          <td>
                            <input class="form-control" type="text" name="qty[]" value="" readonly>
                          </td>
                          <td>
                            <input class="form-control" type="text" name="price[]" value="" readonly>
                          </td>
                          <td>
                            <input class="form-control" type="text" name="total[]" value="" readonly>
                          </td>
                          <td>
                            <input class="form-control" type="text" name="remark[]" value="" readonly>
                          </td>
                        </tr> --}}
                      </tbody>
                    </table>
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
<script src="{{ url('includes/account/newinvoice.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif