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
                            <h3>ຈັດ​ການ​ຂໍ້​ມູນ​ລູກ​ຄ້າ</h3>
                        </div>
                        <div class="card-body">
                            @if (Session::get('success'))
                            <script>swal({
                                title: "ສຳ​ເລັດ",
                                text: "ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ!",
                                icon: "success",
                                button: false,
                                timer: 2500
                                });</script>
                            @endif
                            @if(count($errors) > 0)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger" role="alert">
                                        <button class="close" data-dismiss="alert">&times;</button>
                                        <ul>
                                        @foreach ($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <input class="form-control text-center" type="text" name="search" id="search" placeholder="ປ້ອນ​ຂໍ້​ມູນຄົ້ນ​ຫາ​">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-light table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ລະ​ຫັດ</th>
                                                <th class="text-center">ຊື່ ແລະ ນາມ​ສະ​ກຸນ</th>
                                                <th class="text-center">ບ້ານ</th>
                                                <th class="text-center">ເມືອງ</th>
                                                <th class="text-center">ແຂວງ</th>
                                                <th class="text-center">ເບີ​ໂທ</th>
                                                <th class="text-center">ເບີ​ໂທ​ສ​ຸກ​ເສີນ</th>
                                                <th class="text-center">ອາ​ຊີບ</th>
                                                <th class="text-center">ບ່ອນ​ເຮັດ​ວຽກ</th>
                                                <th class="text-center">ປະ​ເພດ​ລູກ​ຄ້າ</th>
                                                <th class="text-center">ເຄີຍ​ໃຊ້​ບໍ​ລິ​ການ​ບໍ່</th>
                                                <th class="text-center">ຈັດ​ການ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                        @if(count($customer) > 0)
                                            @foreach($customer as $cus)
                                            <tr>
                                                <td>{{ $cus->cusid }}</td>
                                                <td>{{ $cus->name }} {{ $cus->lastname }}</td>
                                                <td>{{ $cus->village }}</td>
                                                <td>{{ $cus->disname }}</td>
                                                <td>{{ $cus->proname }}</td>
                                                <td>{{ $cus->mobile }}</td>
                                                <td>{{ $cus->phone }}</td>
                                                <td>{{ $cus->occupation }}</td>
                                                <td>{{ $cus->workaddress }}</td>
                                                <td>{{ $cus->tcusname }}</td>
                                                <td>{{ $cus->status }}</td>
                                                <td>
                                                    <div class="btn-group dropleft">
                                                        <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <button class="dropdown-item" id="btnEdit" value="{{ $cus->cusid }}"><i class="mdi mdi-account-edit-outline"></i> ແກ້​ໄຂ</button>
                                                            <button class="dropdown-item" id="btnDel" value="{{ $cus->cusid }}"><i class="mdi mdi-trash-can"></i> ລົບ</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                    {{ $customer->render() }}
                                    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="">ແກ້​ໄຂຂໍ້​ມູນ​ລູກ​ຄ້າ</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{ url('editcustomdata') }}">
                                                        {{ csrf_field() }}
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="cusid" id="cusid" value="">
                                                                    <label for="cusname">ຊື່​ລູກ​ຄ້າ</label>
                                                                    <input id="cusname" class="form-control" type="text" name="cusname" placeholder="..." required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="lastname">ນາມ​ສະ​ກ​ຸນ</label>
                                                                    <input id="lastname" class="form-control" type="text" name="lastname" placeholder="...">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="village">ບ້ານຢ​ູ່​ປະ​ຈຸ​ບັນ</label>
                                                                    <input id="village" class="form-control" type="text" name="village" placeholder="..." required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="proid">ແຂວງ</label>
                                                                    <select id="proid" class="form-control btn-outline-primary1" name="proid" data-toggle="tooltip" data-placement="bottom" title="​ເລືອກ​ແຂວງ​ຂອງ​ເມືອງ">
                                                                        @if (count($province) > 0)
                                                                        <option value="">***** ເລືອກ​ແຂວງ *****</option>
                                                                            @foreach ($province as $pro)
                                                                            <option value="{{ $pro->proid }}">{{ $pro->proname }}</option>
                                                                            @endforeach
                                                                        @else
                                                                            <option value="">ຍັງ​ບໍ່​ມີ​ການ​ເພີ່ມ​ແຂວງ​ໃສ່​ເທື່ອ</option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="disid">ເມືອງ</label>
                                                                    <select id="disid" class="form-control btn-outline-primary1" name="disid" title="​ກະ​ລ​ຸ​ນາເລືອກ​ແຂວງ​ກ່ອນ">

                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="mobile">ເບີ​ໂທມື​ຖື</label>
                                                                    <input id="mobile" class="form-control" type="number" name="mobile" placeholder="..." required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="phone">ເບີ​ໂທ​ສຸກ​ເສີນ</label>
                                                                    <input id="phone" class="form-control" type="number" name="phone" placeholder="..." required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="occupation">ອາ​ຊີບ</label>
                                                                    <input id="occupation" class="form-control" type="text" name="occupation" placeholder="..." required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="workadd">ບ່ອນ​ເຮັດ​ວຽກ</label>
                                                                    <input id="workadd" class="form-control" type="text" name="workadd" placeholder="..." required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="">ລູກ​ຄ້າ​ເຄີຍ​ໃຊ້​ບໍ​ລິ​ການ​ບໍ່?</label>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" name="status" class="w3-radio" value="ເຄີຍ">
                                                                        <label class="w3-xlarge" for="status">ເຄີຍ</label>
                                                                        &nbsp;
                                                                        <input type="radio" name="status" class="w3-radio" value="​ບໍ່​ເຄີຍ">
                                                                        <label class="w3-xlarge" for="status">ບໍ່ເຄີຍ</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tcusid">ປະ​ເພດ​ລູກ​ຄ້າ</label>
                                                                    <select id="tcusid" class="form-control btn-outline-primary1" name="tcusid">
                                                                    @if (count($typecus) > 0)
                                                                        <option value="">***** ເລືອກ​ປະ​ເພດ​ລູກ​ຄ້າ *****</option>
                                                                        @foreach ($typecus as $tcus)
                                                                            <option value="{{ $tcus->tcusid }}">{{ $tcus->tcusname }}</option>
                                                                        @endforeach
                                                                    @else
                                                                        <option value="">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ປະ​ເພດ​ລູກ​ຄ້າ</option>
                                                                    @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 text-center">
                                                                <button class="btn btn-success btn-lg" type="submit"><i class="mdi mdi-account-edit"></i> ແກ້​ໄຂ​ຂໍ້​ມູນ​ລູກ​ຄ້າ</button>
                                                            </div>
                                                        </div>
                                                    </form>
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
        </div>

    </div>

@include('manage.layout.foot')
<script src="{{ url('js/settingcus.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif