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
                  <h3>ຈັດ​ການ​ຫົວ​ໜ່ວຍ​ກາ​ນ​ສ້ອມ​ແປງ</h3>
                </div>
                <div class="col-md-4">
                  {{-- <a href="" class="btn btn-primary"><i class="mdi mdi-link"></i> ໜ້າ</a> --}}
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <input type="text" name="searchunit" id="searchunit" class="form-control text-center" placeholder="ຄົ້ນ​ຫາ">
                  <hr>
                  <table class="table table-light table-bordered table-striped">
                    <thead>
                      <tr class="text-center">
                        <th>ລຳ​ດັບ</th>
                        <th>ລາຍ​ການ</th>
                        <th>ແກ້​ໄຂ</th>
                        <th>ລົບ</th>
                      </tr>
                    </thead>
                    <tbody id="showunitrp">
                      
                    </tbody>
                  </table>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="unitrpname">ຊື່​ຫົວ​ໜ່ວຍ​ສ້ອມ​ແປງ</label>
                    <input type="hidden" name="unitrpid" id="unitrpid" value="">
                    <input id="unitrpname" class="form-control" type="text" name="unitrpname" placeholder="....">
                  </div>
                  <div class="form-group text-center">
                    <button class="btn btn-primary" type="button" id="btnAdd"><i class="mdi mdi-content-save"></i> ບັນ​ທຶກ</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

@include('manage.layout.foot')
<script src="{{ url('/includes/technical/unitrepairs.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif