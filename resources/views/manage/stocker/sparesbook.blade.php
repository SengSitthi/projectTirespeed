@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
  <div class="wrapper">

  @include('manage.layout.nav')
  @include('manage.layout.sidemenu')

    <div class="container-fluid mt-30">
      @error('typesparesid')
        <script>swal({
          title: "ຜິດ​ພາດ",
          text: "​ກະ​ລຸ​ນາເລືອກປະ​ເພດ ແລະ ​ລະ​ບົບ​ອະ​ໄຫຼ່ກ່ອນ!",
          icon: "error",
          button: true,
        });</script>
      @enderror
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header bg-transparent py-15">
              <h3>ປິ່ນອະ​ໄຫຼ່</h3>
            </div>
            <div class="card-body">
              <form class="row" action="{{ url('printsparesbook') }}" method="post">
                {{ csrf_field() }}
                
              </form>     
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

@include('manage.layout.foot')
<script src="{{ url('includes/stockjs/sparesbook.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif