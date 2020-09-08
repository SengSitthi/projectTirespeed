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
                            <h3>ຈັດ​ການ​ຍີ່​ຫໍ້​ລົດ</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <input class="form-control text-center" type="text" name="searchbrand" id="searchbrand" placeholder="ຄົ້ນ​ຫາ​ທີ່​ນີ້">
                                    <br>
                                    <table class="table table-light table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ລະ​ຫັດ</th>
                                                <th class="text-center">ຊື່​ຫຍີ່​ຫໍ້</th>
                                                <th class="text-center">ຈັດ​ການ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="brandlist">
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" name="brandid" id="brandid" value="">
                                        <label for="brandname">ຊື່​ຍີ່​ຫໍ້</label>
                                        <input id="brandname" class="form-control" type="text" name="brandname" placeholder="...">
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-danger" type="button" id="btnCancel"><i class="mdi mdi-cancel"></i> ຍົກ​ເລີກ</button>
                                        <button class="btn btn-success" type="button" id="btnAdd" disabled><i class="mdi mdi-content-save"></i> ບັນ​ທຶກ</button>
                                        <button class="btn btn-success" type="button" id="btnUpdate" style="display: none"><i class="mdi mdi-file-edit"></i> ແກ້​ໄຂ</button>
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
<script src="{{ url('js/brandsetting.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif