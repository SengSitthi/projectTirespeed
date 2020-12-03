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
                <div class="col-md-12">
                  <h3>ສະຫຼຸບ​ລາຍ​ຮັບ</h3>
                </div>
                {{-- <div class="col-md-4">
                  <a href="" class="btn btn-primary"><i class="mdi mdi-link"></i> ໜ້າ</a>
                </div> --}}
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <form action="{{ url('searchsummary') }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-group">
                      <div class="input-group-append">
                        <span class="input-group-text" id=""><i class="mdi mdi-table-search"></i></span>
                      </div>
                      <input class="form-control" type="text" name="textsearch" value="" placeholder="ຄົ້ນ​ຫາ: ເລກ​ທີ​ໃບ​ຮຽກ​ເກັບ, ເລກ​ທີ​ໃບ​ຮັບ​ເງິນ, ວັນ​ທີ່ {{ date('Y-m-d') }}">
                      <button class="btn btn-primary" type="submit"><i class="mdi mdi-file-document-box-search"></i> ຄົ້ນ​ຫາ</button>
                    </div>
                  </form>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-light table-bordered table-striped">
                    <thead class="text-center">
                      <tr>
                        <th>ວັນ​ທີອອກ​ໃບ​ຮຽກ​ເກັບ</th>
                        <th>ເລກ​ທີ​ໃບ​ຮຽກ​ເກັບ</th>
                        <th>ຂໍ້​ມູນ​ລົດ, ຍີ່​ຫໍ້</th>
                        <th>ລາ​ຄາ​ໃບ​ຮຽກ​ເກັບ</th>
                        <th>ວັນ​ທີ່​ວາງ​ບິນ</th>
                        <th>ວັ​ນ​ທີ່​ຊຳ​ລະ</th>
                        <th>ຈຳ​ນວນ​ເງິນ​ຊຳ​ລະ</th>
                        <th>ຈຳ​ນວນ​ຍັງ​ຄ້າງ</th>
                        <th>ກຳ​ນົດຈ່າຍ</th>
                        <th>ລາຍ​ການ</th>
                      </tr>
                    </thead>
                    <tbody>
                    @if(count($summary) > 0)
                      @foreach($summary as $sum)
                      <tr>
                        <td class="text-center">{{ $sum->invoice_date }}</td>
                        <td class="text-center">{{ $sum->invoiceid }}</td>
                        <td>{{ $sum->license }}, {{ $sum->brandname }}</td>
                        <td class="text-right">{{ $sum->invoice_total }}</td>
                        <td class="text-center">{{ $sum->bill_date }}</td>
                        <td class="text-center">{{ $sum->receipt_date }}</td>
                        <td class="text-right">{{ $sum->receipt_total }}</td>
                        <td class="text-right">{{ $sum->invoice_total-$sum->receipt_total }}</td>
                        <td class="text-center" > {{ $sum->credit }}</td>
                        <td class="text-center">
                          <button class="btn btn-primary btn-sm" type="button" id="btnList" value="{{ $sum->receiptid }}"><i class="mdi mdi-clipboard-list"></i></button>
                        </td>
                      </tr>
                      @endforeach
                    @else
                      <tr>
                        <th colspan="10" class="text-center">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມ​ູນ​ລາຍ​ຈ່າຍ​ໃນ​ລະ​ບົບ</th>
                      </tr>
                    @endif
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  {{ $summary->render() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

@include('manage.layout.foot')

@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif