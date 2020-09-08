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
                            <h3>ລາຍ​ການ​ສ້ອມ​ແປງ</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-2">
                                            <select class="form-control" name="cusid" id="cusid">
                                                <option value="">*** ເລືອກ​ລູກ​ຄ້າ ***</option>
                                            @if (count($customers) > 0)
                                                @foreach ($customers as $cus)
                                                    <option value="{{ $cus->cusid }}">{{ $cus->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ລູກ​ຄ້າ</option>
                                            @endif
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control" name="carid" id="carid">
                                                <option value="">*** ເລືອກ​ລົດລູກ​ຄ້າ ***</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control" name="ap_date" id="ap_date">
                                                <option value="">*** ເລືອກ​ວັນ​ທີ່​ນັດ​ໝາຍ ***</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-light table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ລາຍ​ການ​ສ້ອມ</th>
                                                <th class="text-center">ສະ​ຖາ​ນະ</th>
                                                <th class="text-center">ຈັດ​ການ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="showrepair">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="Title">ເພີ່ມ​ລາຍ​ການ​ສ້ອມ</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="list">ລາຍ​ການ​ສ້ອມ​</label>
                                                        <input type="hidden" name="repairid" id="repairid" value="">
                                                        <input id="list" class="form-control" type="text" name="list" id="list" value="" placeholder="...">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status">ສະ​ຖາ​ນະ​ການ​ສ້ອມ</label>
                                                        <select id="status" class="form-control" name="status">
                                                            <option value="0">ຍັງ​ບໍ່​ໄດ້​ສ້ອມ​ແປງ</option>
                                                            <option value="1">ສ້ອມ​ແປງ​ສຳ​ເລັດ</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="mdi mdi-cancel"></i> ຍົກ​ເລີກ</button>
                                            <button type="button" class="btn btn-success" id="btnAddlist" disabled><i class="mdi mdi-database-plus"></i> ບັນ​ທຶກ</button>
                                            <button type="button" class="btn btn-success" id="btnEditlist" style="display: none"><i class="mdi mdi-database-edit"></i> ແກ້​ໄຂ</button>
                                        </div>
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
<script src="{{ url('js/listrepair.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif