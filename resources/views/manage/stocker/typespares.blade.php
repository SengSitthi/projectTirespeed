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
                            <h3>ປະ​ເພດ​ອະ​ໄຫຼ່</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                              <div class="col-md-3"></div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label for="typeserviceid">ປະ​ເພດອະ​ໄຫຼ່</label>
                                  <select id="typeserviceid" class="form-control" name="typeserviceid">
                                  @if (count($typeservicedt) > 0)
                                    <option disabled>*** ເລືອກ​ປະ​ເພດ​ອະ​ໄຫຼ່ ***</option>
                                    @foreach ($typeservicedt as $tsdt)
                                      <option value="{{ $tsdt->typeserviceid }}">{{ $tsdt->typeservicename }}</option>
                                    @endforeach
                                  @else
                                    <option value="" disabled>ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ປະ​ເພດ​ບໍ​ລິ​ການ​ໃນ​ລະ​ບົບ​ເທື່ອ</option>
                                  @endif
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <label for="sparesid">ຊື່​​ລະ​ບົບ​ການ​ສ້​ອມ</label>
                                <div class="input-group">
                                  <input type="hidden" name="typesparesid" id="typesparesid" value="">
                                  <input class="form-control" type="text" name="typesparename" id="typesparename" value="">
                                  <div class="input-group-append">
                                    <button class="btn btn-success" type="button" id="btnAdd"><i class="mdi mdi-plus"></i> ເພີ່ມປະ​ເພດ​ອະ​ໄຫຼ່</button>
                                    <button class="btn btn-success" type="button" id="btnUpdate"><i class="mdi mdi-pen"></i> ແກ້​ໄຂປະ​ເພດ​ອະ​ໄຫຼ່</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <br>
                            <div class="row">
                              <div class="col-md-3"></div>
                              <div class="col-md-6">
                                <table class="table table-light">
                                  <thead class="thead-light">
                                    <tr>
                                      <th>ລຳ​ດ​ັ​ບ</th>
                                      <th>ປະ​ເພດອະ​ໄຫຼ່</th>
                                      <th>ຊື່​​ລະ​ບົບ​ການ​ສ້ອມ</th>
                                      <th>ແກ້​ໄຂ</th>
                                      <th>ລຶບ</th>
                                    </tr>
                                  </thead>
                                  <tbody id="typesparelist">
                                    
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
<script src="{{ url('includes/stockjs/typespares.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif