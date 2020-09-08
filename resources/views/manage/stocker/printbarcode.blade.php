@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
  <div class="wrapper">

    {{-- @include('manage.layout.nav') --}}

    {{-- @include('manage.layout.sidemenu') --}}

    <div class="container-fluid mt-30">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            @for ($i = 1; $i <= $barcodeqty; $i++)
              <div class="col-md-4">
                <div class="text-center">
                  <img src="data:image/png;base64, {{ base64_encode($barcode) }}">
                  <h3>{{ $sparesid }}</h3>
                </div>
              </div>
            @endfor
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="text-center">
            <a class="btn btn-info" href="{{ url('spareslist') }}" id="btnBack"><i class="mdi mdi-arrow-left-bold-circle"></i> ກັບ​ຄືນ</a>
          </div>
        </div>
      </div>
    </div>

  </div>

@include('manage.layout.foot')
<script>
  $(document).ready(function(){
    window.onload = function(){
      $('#btnBack').hide();
      window.print();
    }
    window.onafterprint = function(){
      $('#btnBack').show();
    }
  })
</script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif