@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
    <div class="wrapper">

        @include('manage.layout.nav')

        @include('manage.layout.sidemenu')

        <div class="container-fluid mt-30">
            @if (Session::get('success'))
                <script>swal({
                    title: "ສຳ​ເລັດ",
                    text: "ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ!",
                    icon: "success",
                    button: false,
                    timer: 2500
                    });</script>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-transparent py-15">
                            <h3>ລາຍ​ການ​ຜູ້​ໃຊ້</h3>
                        </div>
                        <div class="card-body">
                            {{-- <div class="table-responsive"> --}}
                                <table class="table table-light table-striped table-bordered">
                                    <thead class="thead-blue">
                                        <tr>
                                            <th class="text-center">ລະ​ຫັດ</th>
                                            <th class="text-center">ຊື່​ຜູ້​ໃຊ້</th>
                                            <th class="text-center">ອີ​ເມວ</th>
                                            <th class="text-center">ລະ​ຫັດ​ພະ​ນັກ​ງານ</th>
                                            <th class="text-center">ລາຍ​ການ</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody-light" id="showuserlist">
                                        
                                    </tbody>
                                </table>
                            {{-- </div> --}}
                        </div>
                    </div>
                    {{-- modal form update password --}}
                    <div class="modal fade bd-example-modal-sm" id="modalchange" tabindex="-1" role="dialog" aria-labelledby="changepass" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title h4" id="changepass">ປ່ຽນ​ລະ​ຫັດ​ຜ່ານ</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="password">ລະ​ຫັດ</label>
                                                <input id="pass" class="form-control col-md-12" type="password" id="pass" name="pass" placeholder="Password...">
                                                <input type="hidden" name="uid" id="uid" value="">
                                            </div>
                                            <div class="form-group">
                                                <label for="confirmpass">ລະ​ຫັດຢ​ືນ​ຢັນ</label>
                                                <input id="confirmpass" class="form-control col-md-12" type="password" id="confirmpass" name="confirmpass" placeholder="Confirm Password...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button class="btn btn-warning" id="btnGen" type="button"><i class="mdi mdi-shield-key-outline"></i> ແຣນດອມ​ລະ​ຫັດ</button> &nbsp; <label id="genpass"></label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button class="btn btn-success btn-lg" id="btnChangepass" type="button" disabled><i class="mdi mdi-textbox-password"></i> ປ່ຽນ​ລະ​ຫັດ​ຜ່ານ</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- modal update user data --}}
                    <div class="modal fade" id="modaluserdata" tabindex="-1" role="dialog" aria-labelledby="modaluserdata" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="modaluserdata">ແກ້​ໄຂ​ຂໍ້​ມູນ​ຜູ້​ໃຊ້</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="name">ຊື່​ຜູ້​ໃຊ້</label>
                                                <input id="name" class="form-control" type="text" name="name" id="name" placeholder="User name...">
                                                <input type="hidden" name="euid" id="euid" value=""> <!-- edit user id -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email">ອີ​ເມ​ລ໌</label>
                                                <input id="email" class="form-control" type="text" name="email" id="email" placeholder="User email...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="empid">ເລືອກ​ຜູ້​ໃຊ້</label>
                                                <select id="empid" class="form-control" name="empid">
                                                    <option value="">***** ເລືອກ​ພ​ະ​ນັກ​ງານ *****</option>
                                                @if (count($employees) > 0)
                                                    @foreach ($employees as $emp)
                                                        <option value="{{ $emp->empid }}">{{ $emp->name }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">ບໍ່​ມີ​ພະ​ນັກ​ງານ​ໃນ​ລະ​ບົບ​ເທຶ່ອ</option>
                                                @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button type="button" id="btnUpdateuser" class="btn btn-success btn-lg"><i class="mdi mdi-account-edit-outline"></i> ແກ້​ໄຂ​ຂໍ້​ມູນ​ຜູ້​ໃຊ້</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- modal edit role and permission --}}
                    <div class="modal fade" id="modalrolepms" tabindex="-1" role="dialog" aria-labelledby="rolepermission" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title h4" id="rolepermission">ແກ້​ໄຂ​ສ​ິດ​ທິ​ນຳ​ໃຊ້</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="row" action="{{ url('/updateRolePms') }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="col-12">
                                            <h3>ສະ​ຖາ​ນະ ແລະ ສິດ​ທິ​ຂອງ​ຜູ້​ໃຊ້​</h3>
                                            <div class="row">
                                                <div class="col-3">
                                                    <h4>ສະ​ຖາ​ນະ: <b id="showrole"></b></h4>
                                                </div>
                                                <div class="col-9">
                                                    <h4>ສິດ​ທິ​ຂອງ​ຜູ້​ໃຊ້: <b id="showpms"></b></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h5><b>ສະ​ຖາ​ນະ​ໃຊ້​ງານ</b></h5>
                                            <div class="row">
                                                <input type="hidden" name="uroleid" id="uroleid" value="">
                                            @if (count($roles) > 0)
                                                @foreach ($roles as $role)
                                                <div class="col-6">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="status" id="{{ $role->name }}" class="w3-radio" value="{{ $role->id }}">
                                                        <label class="w3-large">{{ $role->name }}</label>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @endif
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h5><b>ສິດ​ທິ​ໃຊ້​ງານ</b></h5>
                                            <div class="row">
                                            @if (count($permission) > 0)
                                                @foreach ($permission as $pms)
                                                <div class="col-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="w3-check privillage" id="{{ $pms->id }}" name="privillage[]" value="{{ $pms->id }}">
                                                        <label class="w3-large">{{ $pms->name }}</label>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @endif
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button class="btn btn-success btn-lg" type="submit"><i class="mdi mdi-shield-account"></i> ແກ້​ໄຂ​ສິດ​ທິ​ນຳ​ໃຊ້​ລະ​ບົບ</button>
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

@include('manage.layout.foot')
<script type="text/javascript" src="{{ url('js/userlist.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif