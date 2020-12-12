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
                  <h3>ແຜງ​ຄວບ​ຄຸມ</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-2 col-md-6 col-sm-6">
                  <div class="card">
                    <div class="card bg-info text-white">
                      <div class="card-header"><h4>ລົດ​ລໍ​ຖ້າ​ສ້ອມ</h4></div>
                    </div>
                    <div class="card-body">
                      <h6>ຮັບ​ລົດລູກ​ຄ້າ​ມື້ນີ້ <span class="badge badge-info">{{ $waitrepairtoday }}</span></h6>
                      <h6>ຮັບ​ລົດລູກ​ຄ້າອ​າ​ທິດນີ້ <span class="badge badge-info">{{ $waitrepairweek }}</span></h6>
                    </div>
                  </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                  <div class="card">
                    <div class="card bg-primary text-white">
                      <div class="card-header"><h4>ລົດ​ລໍ​ຖ້າ​ອະ​ໄຫຼ່</h4></div>
                    </div>
                    <div class="card-body">
                      <h6>ລົດ​ລໍ​ຖ້າ​ສ້ອມ​ມື້​ນີ້ <span class="badge badge-primary">{{ $waitsparetoday }}</span></h6>
                      <h6>ລົດ​ລໍ​ຖ້າ​ສ້ອມ​ອາ​ທິດ​ນີ້ <span class="badge badge-primary">{{ $waitspareweek }}</span></h6>
                    </div>
                  </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                  <div class="card">
                    <div class="card bg-warning text-white">
                      <div class="card-header"><h4>ລົດ​ກຳ​ລັງ​ສ້ອມ</h4></div>
                    </div>
                    <div class="card-body">
                      <h6>ລົດ​ກຳ​ລັງ​ສ້ອມ​ມື້​ນີ້ <span class="badge badge-warning">{{ $repairingtoday }}</span></h6>
                      <h6>ລົດ​ກຳ​ລັງ​ສ້ອມ​ອ​າ​ທິດນີ້ <span class="badge badge-warning">{{ $repairingweek }}</span></h6>
                    </div>
                  </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                  <div class="card">
                    <div class="card bg-success text-white">
                      <div class="card-header"><h4>ລົດ​ສ້ອມສຳ​ເລັດ</h4></div>
                    </div>
                    <div class="card-body">
                      <h6>ລົດ​ສ້ອມ​ສຳ​ເລັດ​ມື້ນີ້ <span class="badge badge-success">{{ $successtoday }}</span></h6>
                      <h6>ລົດ​ສ້ອມສ​ຳ​ເລັດ​ອ​າ​ທິດນີ້ <span class="badge badge-success">{{ $successweek }}</span></h6>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                  <div class="card">
                    <div class="card bg-info text-white">
                      <div class="card-header"><h4>ລົດ​ສົ່ງ​ມອບ​ໃຫ້ລູກ​ຄ້າ​ແລ້ວ</h4></div>
                    </div>
                    <div class="card-body">
                      <h6>ລົດ​ສົ່ງ​ມອບ​ໃຫ້ລູກ​ຄ້າ​ແລ້ວ​ມື້ນີ້ <span class="badge badge-info">{{ $sendtoday }}</span></h6>
                      <h6>ລົດ​ສົ່ງ​ມອບ​ໃຫ້ລູກ​ຄ້າ​ແລ້ວອ​າ​ທິດນີ້ <span class="badge badge-info">{{ $sendweek }}</span></h6>
                    </div>
                  </div>
                </div>
              </div>
              {{-- <div class="row">
                <div class="col-md-3">
                  <div class="card">
                    <div class="card bg-info text-white">
                      <div class="card-header"><h4>ລົດ​ສົ່ງ​ມອບ​ໃຫ້ລູກ​ຄ້າ​ແລ້ວ</h4></div>
                    </div>
                    <div class="card-body">
                      <h6>ລົດ​ສົ່ງ​ມອບ​ໃຫ້ລູກ​ຄ້າ​ແລ້ວ​ມື້ນີ້ <span class="badge badge-info">2</span></h6>
                      <h6>ລົດ​ສົ່ງ​ມອບ​ໃຫ້ລູກ​ຄ້າ​ແລ້ວອ​າ​ທິດນີ້ <span class="badge badge-info">0</span></h6>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card">
                    <div class="card bg-danger text-white">
                      <div class="card-header"><h4>ລົດ​ກາຍ​ເວ​ລາ​ສ້ອມ</h4></div>
                    </div>
                    <div class="card-body">
                      <h6>ລົດ​ກາຍ​ເວ​ລາ​ສ້ອມ​ມື້ນີ້ <span class="badge badge-danger">2</span></h6>
                      <h6>ລົດ​ກາຍ​ເວ​ລາ​ສ້ອມອ​າ​ທິດນີ້ <span class="badge badge-danger">0</span></h6>
                    </div>
                  </div>
                </div>
              </div> --}}
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card bg-primary text-white">
                      <div class="card-header"><h4>ພາບ​ລວມ</h4></div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div id="techchart"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

@include('manage.layout.foot')
<script src="{{ url('includes/technical/dashboard.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif