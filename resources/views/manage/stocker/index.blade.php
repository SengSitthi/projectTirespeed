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
                    <span class="badge badge-success float-right">ເດືອນ {{ date('m-Y') }}</span>
                    <h3 class="card-title text-muted">ສັ່ງ​ອະ​ໄຫຼ່</h3>
                    <h6 class="mb-10">​ຈຳ​ນວນ​ສັ່ງ​ອະ​ໄຫຼ່ມື້​ນີ້: <b>{{ count($ordersparetoday) }}</b></h6>
                    <p class="text-muted mb-0">ລວມ​ລາຍ​ການ​ສັ່ງ​ອະ​ໄຫຼ່​ເດືອນນີ້: <b>{{ count($ordersparemonth) }}</b></p>
                  </div>
                </div>
              </div>

              <div class="col">
                <div class="card">
                  <div class="card-body">
                    <span class="badge badge-success float-right">ເດືອນ {{ date('m-Y') }}</span>
                    <h3 class="card-title text-muted">ຮັບ​ອະ​ໄຫຼ່​ເຂົ້າ</h3>
                    <h6 class="mb-10">​ຈຳ​ນວນ​ຮັບ​ອະ​ໄຫຼ່: <b>{{ count($receivesparetoday) }}</b></h6>
                    <p class="text-muted mb-0">ລວມລາຍ​ການ​ຮັບ​ອະ​ໄຫຼ່​ເດືອນ​ນີ້: <b>{{ count($receivesparetodaym) }}</b></p>
                  </div>
                </div>
              </div>

              <div class="col">
                <div class="card">
                  <div class="card-body">
                    <span class="badge badge-success float-right">ເດືອນ {{ date('m-Y') }}</span>
                    <h3 class="card-title text-muted">ເບີກ​ອະ​ໄຫຼ່</h3>
                    <h6 class="mb-10">ຈຳ​ນວນອະ​ໄຫຼ່​ເບີ​ກ​ມື້​ນີ້: <b>{{ count($withdrawdetailtoday) }}</b></h6>
                    <p class="text-muted mb-0">ລວມ​ລາຍ​ການ​ເບີ​ກ​ອະ​ໄຫຼ່​ເດືອນ​ນີ້: <b>{{ count($withdrawdetailmonth) }}</b></p>
                  </div>
                </div>
              </div>

              <div class="col">
                <div class="card">
                  <div class="card-body">
                    <span class="badge badge-success float-right">ເດືອນ {{ date('m-Y') }}</span>
                    <h3 class="card-title text-muted">​ລາຍ​ການ​ອະ​ໄຫຼ່​ໃກ້​ໝົດ</h3>
                    <p class="text-muted mb-0">ຈຳ​ນວນ​ລາຍ​ການ​ອະ​ໄຫຼ່​ໃກ້​ໝົດ: <b>{{ count($sparemin) }}</b> ລາຍ​ການ</p>
                  </div>
                </div>
              </div>

            </div>


            <div class="row">
              <div class="col-lg-8 col-12">

                <div class="card">
                  <div class="card-header bg-transparent py-15">ພາບ​ລວມ</div>
                    <div class="card-body">
                      <div style="height: 540px; max-width: 100%;" id="stockoverview"></div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-12">

                    <div class="card">
                        <div class="card-header bg-transparent py-15">ພາບ​ລວມໜ້າ​ວຽກ</div>

                        <div class="card-body">

                            <div class="form-group">
                                <div style="height: 280px; max-width: 100%;" id="workstockoverview"></div>
                            </div>

                            <div class="form-group">
                                <a href="https://www.google.com" class="text-body">ສັ່ງ​ອະ​ໄຫຼ່</a>
                                <div class="float-right text-muted">
                                    30
                                </div>
                                <div class="progress progress-xs mt-5">
                                    <div class="progress-bar" style="width: 30.5%;"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <a href="https://www.twitter.com" class="text-body">ຮັບ​ອະ​ໄຫຼ່</a>
                                <div class="float-right text-muted">
                                    25
                                </div>
                                <div class="progress progress-xs mt-5">
                                    <div class="progress-bar" style="width: 25.5%;"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <a href="https://morioh.com" class="text-body">ເບີກ​ອະ​ໄຫຼ່</a>
                                <div class="float-right text-muted">
                                    16
                                </div>

                                <div class="progress progress-xs mt-5">
                                    <div class="progress-bar" style="width: 16%;"></div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

@include('manage.layout.foot')
<script src="{{ url('includes/stockjs/dashboard.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif