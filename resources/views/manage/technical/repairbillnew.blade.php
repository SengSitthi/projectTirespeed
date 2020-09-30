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
                <div class="col-md-8">
                  <h3>Header Text</h3>
                </div>
                <div class="col-md-4">
                  <a href="" class="btn btn-primary"><i class="mdi mdi-link"></i> ໜ້າ</a>
                </div>
              </div>
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