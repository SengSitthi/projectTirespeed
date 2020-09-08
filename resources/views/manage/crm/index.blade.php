@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
  <div class="wrapper">

  @include('manage.layout.nav')
    @include('manage.layout.sidemenu')

    <div class="container-fluid mt-30">
      <div class="row">
        <div class="col-lg-12">
          {{-- <div class="card">
            <div class="card-header bg-transparent py-15"> --}}
          <h3>​ພາບ​ລວມ</h3>
        {{-- </div> --}}
        {{-- <div class="card-body"> --}}
          <div class="row row row-cols-1 row-cols-md-2 row-cols-lg-4">
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <span class="badge badge-success float-right">ມື້ນີ້</span>
                  <h3 class="card-title text-muted">ນັດ​ໝາຍ​ລູກ​ຄ້າ​ມື້​ນີ້</h3>
                  <h6 class="mb-10">​ຈຳ​ນວນນັດ​ໝາຍ​ລູກ​ຄ້າ​ມື້​ນີ້: <a href="{{ url('appointmenttoday')}}"><b id="showtoday">5</b> ຄົນ</a></h6>
                  {{-- <p class="text-muted mb-0">ລວມ​ທ​ັງ​ໝົດ: 5 ຄັນ
                    <span class="float-right"> <i class="fas fa-angle-up text-success"></i> 5.5%</span>
                  </p> --}}
                </div>
              </div>
            </div>
                
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <span class="badge badge-success float-right">ເດືອນ​ນີ້</span>
                  <h3 class="card-title text-muted">ນັດ​ໝາຍລ​ູກ​ຄ້າເດືອນ​ນີ້</h3>
                  <h6 class="mb-10">ຈຳ​ນວນນັດ​ໝາຍລ​ູກ​ຄ້າເດືອນ​ນີ້: <a href="{{ url('appointmentmonth')}}"><b id="showmonth">20</b> ຄົນ</a></h6>
                      {{-- <p class="text-muted mb-0">ລວມ​ທ​ັງ​ໝົດ: 20 ຄົນ
                        <span class="float-right"> <i class="fas fa-angle-up text-success"></i> 5.5%</span>
                      </p> --}}
                </div>
              </div>
            </div>          
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <span class="badge badge-success float-right">ເດືອນນີ້</span>
                  <h3 class="card-title text-muted">ນັດ​ໝາຍ​ລົດ​ບໍ​ລິ​ສັດ</h3>
                  <h6 class="mb-10">ນັດ​ໝາຍ​ລົດ​ບໍ​ລິ​ສັດ: <b id="showcompany">2</b> ຄັນ</h6>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <span class="badge badge-success float-right">ເດືອນ​ນີ້</span>
                  <h3 class="card-title text-muted">ນັດ​ໝາຍ​ລົດ​ອື່ນໆ</h3>
                  <h6 class="mb-10">ນັດ​ໝາຍ​ລົດ​ອື່ນໆ: <b id="showother">3</b> ຄັນ</h6>
                </div>
              </div>
            </div>
          </div>

          <div class="row row row-cols-1 row-cols-md-2 row-cols-lg-2">
            <div class="col">
              <a href="{{ url('customerlist')}}">
                <div class="card">
                  <div class="card-body">
                    <span class="badge badge-success float-right">ມື້ນີ້</span>
                    <h3 class="card-title text-muted">ເພີ່ມລູກ​ຄ້າ​ມື້​ນີ້</h3>
                    <h6 class="mb-10">​ຈຳ​ນວນເພີ່ມລູກ​ຄ້າ​ມື້​ນີ້: <b id="showtoday">{{ count($todaynewcustomer) }}</b> ຄົນ</h6>
                    {{-- <p class="text-muted mb-0">ລວມ​ທ​ັງ​ໝົດ: 5 ຄັນ
                      <span class="float-right"> <i class="fas fa-angle-up text-success"></i> 5.5%</span>
                    </p> --}}
                  </div>
                </div>
              </a>
            </div>
              
            <div class="col">
              <a href="{{ url('customerlist')}}">
                <div class="card">
                  <div class="card-body">
                    <span class="badge badge-success float-right">ເດືອນ​ນີ້</span>
                    <h3 class="card-title text-muted">ເພີ່ມລ​ູກ​ຄ້າເດືອນ​ນີ້</h3>
                    <h6 class="mb-10">ຈຳ​ນວນເພີ່ມລ​ູກ​ຄ້າເດືອນ​ນີ້: <b id="showmonth">{{ count($monthnewcustomer) }}</b> ຄົນ</h6>
                    {{-- <p class="text-muted mb-0">ລວມ​ທ​ັງ​ໝົດ: 20 ຄົນ
                      <span class="float-right"> <i class="fas fa-angle-up text-success"></i> 5.5%</span>
                    </p> --}}
                  </div>
                </div>
              </a>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-7 w3-padding">
                  <div id="chart_div"></div>
                </div>
                <div class="col-md-5 w3-padding">
                  <div id="piechart"></div>
                </div>
              </div>
            </div>
          </div>
        {{-- </div> --}}
        {{-- </div> --}}
        </div>
      </div>
    </div>

  </div>

@include('manage.layout.foot')
<script src="{{ url('js/canvasjs.min.js') }}"></script>
<script src="{{ url('js/crmdashboard.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif