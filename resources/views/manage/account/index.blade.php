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
                  <h3>Dashboard</h3>
                </div>
                {{-- <div class="col-md-4">
                  <a href="" class="btn btn-primary"><i class="mdi mdi-link"></i> ໜ້າ</a>
                </div> --}}
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                  <div class="card">
                    <div class="card bg-info text-white">
                      <div class="card-header"><h4>ລາຍ​ຮັບ​ປະ​ຈຳ​ວັນ</h4></div>
                    </div>
                    <div class="card-body">
                      <h6>ຈຳ​ນວນ​ເງິນ​​ລາຍ​ຮັບມື້​ນີ້ <span class="badge badge-info">{{ number_format($invoicetoday) }}</span></h6>
                      <h6>ຈຳ​ນວນ​ເງິນລ​ູກ​ຄ້າ​ຊຳ​ລະ​ມື້​ນີ້ <span class="badge badge-info">{{ number_format($receipttoday) }}</span></h6>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card">
                    <div class="card bg-primary text-white">
                      <div class="card-header"><h4>​ລາຍ​ຮັບ​ປະ​ຈຳ​ອາ​ທິດ</h4></div>
                    </div>
                    <div class="card-body">
                      <h6>ຈຳ​ນວນເງິນລາຍ​ຮັບ​ອາ​ທິດ​ນີ້ <span class="badge badge-primary">{{ number_format($invoiceweek) }}</span></h6>
                      <h6>​ຈຳ​ນວນ​ເງິນລູກ​ຄ້າ​ຊຳ​ລະ​ອາ​ທິດ​ນີ້ <span class="badge badge-primary">{{ number_format($receiptweek) }}</span></h6>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card">
                    <div class="card bg-warning text-white">
                      <div class="card-header"><h4>​ລາຍ​ຮັບ​ປະ​ຈຳ​ເດືອນ</h4></div>
                    </div>
                    <div class="card-body">
                      <h6>ຈຳ​ນວນ​ເງິນ​ລາຍ​ຮັບ​ເດືອນ​ນີ້ <span class="badge badge-warning">{{ number_format($invoicemonth) }}</span></h6>
                      <h6>ຈຳ​ນວນ​ເງິນ​ລູກ​ຄ້າ​ຊຳ​ລະ​ເດືອນນີ້ <span class="badge badge-warning">{{ number_format($receiptmonth) }}</span></h6>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card">
                    <div class="card bg-success text-white">
                      <div class="card-header"><h4>ລາຍ​ຮັບ​ປະ​ຈຳ​ປີ</h4></div>
                    </div>
                    <div class="card-body">
                      <h6>ຈຳ​ນວນ​ເງິນ​ລາຍ​ຮັບ​ປີ​ນີ້ <span class="badge badge-success">{{ number_format($invoiceyear) }}</span></h6>
                      <h6>ຈຳ​ນວນ​ເງິນ​ລ​ູກ​ຄ້າ​ຊຳ​ລະ​ອາ​ທິດນີ້ <span class="badge badge-success">{{ number_format($receiptyear) }}</span></h6>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <div id="invoicechart"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

@include('manage.layout.foot')
<script src="{{ url('includes/account/dashboard.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif