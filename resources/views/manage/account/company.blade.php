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
                  <h3>ບໍ​ລິ​ສັດ</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="cpname">ຊື່​ບໍ​ລິ​ສັດ</label>
                    <input type="hidden" name="cpid" id="cpid" value="">
                    <input id="cpname" class="form-control" type="text" name="cpname" value="">
                  </div>
                  <div class="form-group">
                    <label for="address">ທີ່ຢ​ູ່​ບໍ​ລິ​ສັດ</label>
                    <textarea id="address" class="form-control" name="address" rows="3"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="phone">ເບີ​ໂທ</label>
                    <input id="phone" class="form-control" type="text" name="phone" value=""  placeholder="ມືຖື:012 34 567 890, ຕັ້ງ​ໂຕະ:012 345 678">
                  </div>
                  <div class="form-group">
                    <label for="fax">ແຟັກ</label>
                    <input id="fax" class="form-control" type="text" name="fax" value="" placeholder="012-345678">
                  </div>
                  <div class="form-group text-center">
                    <button class="btn btn-success" type="button" id="btnAdd"><i class="mdi mdi-content-save"></i> ບັນ​ທຶກ</button> 
                    <button class="btn btn-danger" type="button" id="btnCancel"><i class="mdi mdi-close-circle"></i> ຍົກ​ເລີກ</button>
                  </div>
                </div>
                <div class="col-md-9">
                  <h4>ລາຍ​ການ</h4>
                  <table class="table table-light table-bordered table-striped">
                    <thead>
                      <tr class="text-center">
                        <th>ລຳ​ດັບ</th>
                        <th>ຊື່​ບໍ​ລິ​ສັດ</th>
                        <th>ທີ່​ຢູ່</th>
                        <th>ເບີ​ໂທ</th>
                        <th>ແຟັກ</th>
                        <th>ແກ້​ໄຂ</th>
                        <th>ລຶບ</th>
                      </tr>
                    </thead>
                    <tbody id="showdetail">
                      
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
<script src="{{ url('includes/account/company.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif