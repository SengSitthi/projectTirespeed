@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
  <div class="wrapper">

    @include('manage.layout.nav')
    @include('manage.layout.sidemenu')

    <div class="container-fluid mt-30">
      <div class="row row row-cols-1 row-cols-md-2 row-cols-lg-4">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <span class="badge badge-success float-right">ເດືອນ</span>
              <h3 class="card-title text-muted">​ລົດ​ເຂົ້າ</h3>
              <h6 class="mb-10">ລົດ​ເຂົ້າມື້​ນີ້: <b>{{ $waitrepairtoday }}</b> ຄັນ</h6>
              <p class="text-muted mb-0">​ລົດ​ເຂົ້າອາ​ທິດ​ນີ້: <b>{{ $waitrepairweek }}</b> ຄັນ</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <span class="badge badge-success float-right">ເດືອນ</span>
              <h3 class="card-title text-muted">ລົດ​ກຳ​ລັງ​ສ້ອມ</h3>
              <h6 class="mb-10">​ລົດ​ກຳ​ລັງ​ສ້ອມ​ມື້​ນີ້: <b>{{ $repairingtoday }}</b> ຄັນ</h6>
              <p class="text-muted mb-0">ລົດ​ກຳ​ລັງ​ສ້ອມອາ​ທິດນີ້: <b>{{ $repairingweek }}</b> ຄັນ</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <span class="badge badge-success float-right">ເດືອນ</span>
              <h3 class="card-title text-muted">ລົດ​ສ້ອມ​ສຳ​ເລັດ</h3>
              <h6 class="mb-10">ລົດ​ສ້ອມ​ສຳ​ເລັດມື້​ນີ້: <b>{{ $successtoday }}</b> ຄັນ</h6>
              <p class="text-muted mb-0">ລົດ​ສ້ອມ​ສຳ​ເລັດອາ​ທິດນີ້: <b>{{ $successweek }}</b> ຄັນ</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <span class="badge badge-success float-right">ເດືອນ</span>
              <h3 class="card-title text-muted">​ລາຍ​ຮັບ</h3>
              <h6 class="mb-10">ລາຍ​ຮັບ​ມື້​ນີ້: <b>{{ number_format($invoicetoday) }}</b> ກີບ</h6>
              <p class="text-muted mb-0">​ລາຍ​ຮັບເດືອນ​ນີ້: <b>{{ number_format($invoicemonth) }}</b> ກີບ</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-12">
          <div class="card">
            <div class="card-header bg-transparent py-15">ພາບ​ລວມ</div>
            <div class="card-body">
              <div style="height: 540px; max-width: 100%;" id="techchart"></div>
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