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
                <div class="col-md-12">
                  <h3>ຈັດ​ການ​ປະ​ເພດ​ລົດ</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <input class="form-control text-center" type="text" name="searchtc" id="searchtc" placeholder="ຄົ້ນ​ຫາ​ປະ​ເພດ​ລົດ...">
                  <hr>
                  <table class="table table-light table-striped table-bordered">
                    <thead>
                      <tr class="text-center">
                        <th>ລຳ​ດັບ​</th>
                        <th>ຊື່​ປະ​ເພດ​ລົດ</th>
                        <th>ແກ້​ໄຂ</th>
                        <th>ລຶບ</th>
                      </tr>
                    </thead>
                    <tbody id="showTypecar">
                      
                    </tbody>
                  </table>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="hidden" name="tcarid" id="tcarid" value="">
                    <label for="tcarname">ຊື່​ປະ​ເພດ​ລົດ</label>
                    <input id="tcarname" class="form-control" type="text" name="tcarname" placeholder=".....">
                  </div>
                  <div class="text-center">
                    <button class="btn btn-primary" type="button" id="btnSaveTC"><i class="mdi mdi-car"></i> ບັນ​ທຶກ</button>
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
<script src="{{ url('includes/technical/typecars.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif