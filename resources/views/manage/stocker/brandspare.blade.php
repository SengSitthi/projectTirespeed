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
                            <h3>ຈັດ​ການ​ຂໍ້​ມ​ູນ​ປະ​ເພດ​ອະ​ໄຫຼ່</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                              <div class="col-md-3"></div>
                              <div class="col-md-6">
                                <form action="#" method="post">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <label for="sparesid">ຊື່​ຍີ່​ຫໍ້ອະ​ໄຫຼ່</label>
                                      <div class="input-group">
                                        <input type="hidden" id="brandspareid" name="brandspareid" value="">
                                        <input id="brandsparename" class="form-control" type="text" name="brandsparename" value="">
                                        <div class="input-group-append">
                                          <button class="btn btn-success" type="button" id="btnAdd"><i class="mdi mdi-plus"></i> ບັນ​ທຶກ</button>
                                          <button class="btn btn-primary" type="button" id="btnUpdate"><i class="mdi mdi-pen"></i> ແກ້​ໄຂ</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                            <br>
                            <div class="row">
                              <div class="col-md-3"></div>
                              <div class="col-md-6">
                                <table class="table table-light">
                                  <thead class="thead-light">
                                    <tr>
                                      <th>ລຳ​ດ​ັບ</th>
                                      <th>ຊື່​ຍີ່​ຫໍ້​ອະ​ໄຫຼ່</th>
                                      <th>ແກ້​ໄຂ</th>
                                      <th>ລຶບ</th>
                                    </tr>
                                  </thead>
                                  <tbody id="brandsparelist">
                                    
                                  </tbody>
                                </table>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@include('manage.layout.foot')
  <script src="{{ url('includes/stockjs/brandspare.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif