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
                            <h3>ລາຍ​ງານ​ລາຍ​ການ​ສ້ອມ</h3>
                        </div>
                        @if(count($errors) > 0)
                            <script>swal({
                                title: "ມີ​ບາງ​ຢ່າງ​ຜິດ​ຜາດ",
                                text: "ກະ​ລຸ​ນາ​ກວດ​ສອບ​ວ່າ​ຂໍ້​ມູ​ນ​ທີ່​ເລືອກ​ຖືກ​ຕ້ອງບ​ໍ່",
                                icon: 'error',
                                button: true,
                            });
                            </script>
                        @endif
                        <div class="card-body">
                            <form class="row" action="{{ url('printRepair') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="col-md-2"></div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">ລູກ​ຄ້າ</span>
                                        </div>
                                        {{-- <select name="cusid" id="cusid" class="form-control btn-outline-primary1">
                                            <option value="">***** ເລືອກລູກ​ຄ້າ *****</option>
                                        </select> --}}
                                        <select class="selectpicker form-control" id="cusid" name="cusid" data-live-search="true" data-style="btn-outline-primary" tabindex="-98">
                                            <option value="">***** ເລືອກລູກ​ຄ້າ *****</option>
                                        @if (count($customers) > 0)
                                            @foreach ($customers as $cus)
                                                <option value="{{ $cus->cusid }}">{{ $cus->name }}</option>
                                            @endforeach
                                        @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="">ລົດ​ລູກ​ຄ້າ</span>
                                        </div>
                                        <select name="carid" id="carid" class="form-control">
                                            <option value="">***** ເລືອກລົດ *****</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="">ວັນ​ທີ່ນັດ​ໝາຍ</span>
                                        </div>
                                        <select name="datelist" id="datelist" class="form-control">
                                            <option value="">***** ເລືອກວັນ​ທີ່ *****</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-warning" type="submit" id="btnPrint"><i class="mdi mdi-file-pdf"></i> ພິມ​ລາຍ​ງານ</button>
                                </div>
                                <div class="col-md-2"></div>
                            </form>
                            <br>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-4">
                                    <h4>ລະ​ຫັດ​ລ​ູກ​ຄ້າ: <b id="showcusid"></b></h4>
                                    <h4>ຊື່ ແລະ ນາມ​ສະ​ກ​ຸນ: <b id="showname"></b></h4>
                                    <h4>ບ່ອນຢ​ູ່: <b id="showaddress"></b></h4>
                                </div>
                                <div class="col-md-4">
                                    <h4>ລະ​ຫັດ​ລົດ: <b id="showcarid"></b></h4>
                                    <h4>ປ້າຍ​ລົດ: <b id="showlicense"></b></h4>
                                    <h4>ຍີ່​ຫໍ້​ລົດ: <b id="showbrand"></b> ລຸ້ນ: <b id="showmodel"></b></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <table class="table table-light table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ລຳ​ດັບ</th>
                                                <th class="text-center">ລາຍ​ການ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="showlist">
                                            
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
<script src="{{ url('js/reportrepair.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif