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
              <h3>Header Text</h3>
            </div>
            <div class="card-body">
                            
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