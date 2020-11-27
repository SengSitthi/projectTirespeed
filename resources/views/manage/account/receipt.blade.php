@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
  <div class="wrapper">

  @include('manage.layout.nav')
  @include('manage.layout.sidemenu')

    <div class="container-fluid mt-30">
      @if(Session::get('errors'))
        <script>swal("ຜິດ​ພາດ","ເລກ​ທີນ​ີ້​ມີ​ໃນ​ລະ​ບົບ​ແລ້ວ","warning", {timer: 3000});</script>
      @endif
      {{-- @error('invoiceid')
        <script>swal("ຜິດ​ພາດ","ກະ​ລຸ​ນາ​ເລືອກ​ໃບ​ຮຽກ​ເກັບ​ເງິນ","warning", {timer: 3000});</script>
      @enderror --}}
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header bg-transparent py-15">
              <div class="row">
                <div class="col-md-8">
                  <h3>ເພີ່ມໃບ​ຮັບ​ເງິນ</h3>
                </div>
                <div class="col-md-4">
                  <a href="{{ url('receiptlist') }}" class="btn btn-primary"><i class="mdi mdi-clipboard-list"></i> ລາຍ​ການ​ໃບ​ຮັບ​ເງິນ</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="{{ url('innewreceipt') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="receiptid">ເລກ​ທີໃບ​ຮັບ​ເງິນ</label>
                      <input id="receiptid" class="form-control" type="text" name="receiptid" value="{{ $receiptid }}" readonly>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="invoiceid">ເລກ​ທີ​ໃບ​ຮຽກ​ເກັບ</label>
                      <select id="invoiceid" class="form-control" name="invoiceid">
                        <option value="">*** ເລືອກເລກ​ທີໃບ​ຮຽກ​ເກັບ ***</option>
                        @if(count($invoice) > 0)
                          @foreach($invoice as $inv)
                            <option value="{{ $inv->invoiceid }}">{{ $inv->invoiceid }}</option>
                          @endforeach
                        @else
                          <option value="">ຍັງ​ບໍ່​ມີ​ເລກ​ທີ​ໃບ​ຮຽກ​ເກັບ​ໃນ​ລະ​ບົບ</option>
                        @endif
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="receipt_date">ວັນ​ທີ​ອອກ​ໃບ​ຮັບ​ເງິນ</label>
                      <input id="receipt_date" class="form-control" type="text" name="receipt_date" value="" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="receipt_from">ຮ​ັບ​ເງິນ​ຈ​າກ</label>
                      <input id="receipt_from" class="form-control" type="text" name="receipt_from" value="" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="invoice_date">ວັນ​ທີ​ອອກໃບ​ຮຽກ​ເກັບ</label>
                      <input id="invoice_date" class="form-control" type="text" name="invoice_date" value="" readonly>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <p>
                      <div class="form-group">
                        <button class="btn btn-success" type="submit"><i class="mdi mdi-content-save"></i> ບັນ​ທຶກ</button>
                      </div>
                    </p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
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
<script src="{{ url('includes/account/receipt.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif