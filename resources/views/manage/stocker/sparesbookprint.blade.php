@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
  <div class="wrapper">

    {{-- @include('manage.layout.nav') --}}

    {{-- @include('manage.layout.sidemenu') --}}

    <div class="container-fluid mt-0">
      <div class="row">
        <div class="col-lg-12">
        <div class="row" id="showbutton">
          <div class="col-md-3">
            <div class="input-group">
              <div class="input-group-append">
                <span class="input-group-text">ປ​ະ​ເພດອະ​ໄຫຼ່</span>
              </div>
              <select id="typeserviceid" class="form-control" name="typeserviceid">
                <option value="">ເລືອກປ​ະ​ເພດອະ​ໄຫຼ່</option>
                @if (count($typeservice) > 0)
                  @foreach ($typeservice as $tsv)
                    <option value="{{ $tsv->typeserviceid }}">{{ $tsv->typeservicename }}</option>
                  @endforeach
                @else
                  <option value="">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ລະ​ບົບ</option>
                @endif
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="input-group">
              <div class="input-group-append">
                <span class="input-group-text">​ລະ​ບົບ​ອະ​ໄຫຼ່</span>
              </div>
              <select id="typesparesid" class="form-control" name="typesparesid">
                <option value="">ເລືອກ​ລະ​ບົບ​ອະ​ໄຫຼ່</option>
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary" type="button" id="btnPrint"><i class="mdi mdi-printer"></i> ພິມ​ປຶ້ມ</button>
          </div>
          <div class="col-md-2">
            <a class="btn btn-primary" href="{{ url('sparesbookprint') }}"><i class="mdi mdi-reload"></i> ເລີ່ມ​ໃໝ່</a>
          </div>
          <div class="col-md-2">
            <a class="btn btn-info" href="{{ url('stockdashboard') }}" id="btnBack"><i class="mdi mdi-arrow-left-bold-circle"></i> ກັບ​ຄືນ</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h3 class="text-center" id="title"></h3>
          </div>
        </div>
        <div class="row" id="showprintbookdata">
          {{-- <div class="d-inline p-2">
              <p class="text-center"></p>
              <img src="data:image/png;base64, base64_encode('9875465255354')">
              <h4 class="text-center">ລະ​ຫັດ​: 9875465255354</h4>
          </div> --}}
        </div>
      </div>
    </div>

  </div>

@include('manage.layout.foot')
<script src="{{ url('includes/stockjs/sparesbook.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif