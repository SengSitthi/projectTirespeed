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
                            <h3>ຈັດ​ການຫົວ​ໜ່ວຍ​ອະ​ໄຫຼ່</h3>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                              <label for="unitname">ຊື່​ຫົວ​ໜ່ວຍ</label>
                              <div class="input-group">
                                <input type="hidden" name="unitid" id="unitid" value="">
                                <input class="form-control" type="text" name="unitname" id="unitname" value="" placeholder="...............">
                                <div class="input-group-append">
                                  <button class="btn btn-success" type="button" id="btnAdd"><i class="mdi mdi-plus"></i> ບັນ​ທຶກ</button>
                                  <button class="btn btn-primary" type="button" id="btnUpdate"><i class="mdi mdi-pen"></i> ແກ້​ໄຂ</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                              <table class="table table-light">
                                <thead class="thead-light">
                                  <tr>
                                    <th>ລຳ​ດັ​ບ</th>
                                    <th>ຊື່​ຫົວ​ໜ່ວຍ</th>
                                    <th class="text-center">ແກ້​ໄຂ</th>
                                    <th class="text-center">ລຶບ</th>
                                  </tr>
                                </thead>
                                <tbody id="unitsparelist">
                                  
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
<script src="{{ url('includes/stockjs/unitspare.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif