@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
    <div class="wrapper">

        @include('manage.layout.nav')

        @include('manage.layout.sidemenu')

        <div class="container-fluid mt-30">

            <div class="row">
                @if (Session::get('success'))
                    <script>swal({
                        title: "ສຳ​ເລັດ",
                        text: "ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ!",
                            icon: "success",
                        button: false,
                        timer: 2500
                    });</script>
                @endif
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-transparent py-15">
                            <h3>ຈັດ​ການ​ວັນ​ທີ່​ເວ​ລາ​ນັດ​ໝາຍ</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <input type="text" name="searchlist" class="form-control text-center" id="searchlist" placeholder="ຄົ້ນ​ຫາ​ຂໍ້​ມູນ">
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
                                                <th class="text-center">ວັນ​ທີ່​ນັດ​ໝາຍ</th>
                                                <th class="text-center">ເວ​ລາ​ນັດ​ໝາຍ</th>
                                                <th class="text-center">ລະ​ຫັດ​ລູກ​ຄ້າ</th>
                                                <th class="text-center">​ຊື່ລູກ​ຄ້າ</th>
                                                <th class="text-center">​ລະ​ຫັດ​ລົດ</th>
                                                <th class="text-center">ປ້າຍ​ລົດ</th>
                                                <th class="text-center">ຈັດ​ການ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="applist">
                                        @if(count($appoint) > 0)
                                            @foreach($appoint as $app)
                                            <tr>
                                                <td>{{ $app->ap_date }}</td>
                                                <td>{{ $app->ap_time }}</td>
                                                <td>{{ $app->cusid }}</td>
                                                <td>{{ $app->name }}</td>
                                                <td>{{ $app->carid }}</td>
                                                <td>{{ $app->license }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group dropleft">
                                                        <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" type="button" id="d350ad" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <button class="dropdown-item" id="btnEdit" value="{{ $app->apid }}"><i class="mdi mdi-pencil-outline"></i> ແກ້​ໄຂ</button>
                                                            <a class="dropdown-item" id="btnDel" href="{{ url('/deleteAppointment/'.$app->apid) }}"><i class="mdi mdi-trash-can"></i> ລົບ</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="text-center" colspan="7"><h4>ຍັງ​ບໍ່​ມີ​ການ​ນັດ​ໝາຍ​ເທື່ອ</h4></td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    {{ $appoint->render() }}
                                </div>
                                <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalCenterTitle">ແກ້​ໄຂ​ເວ​ລາການ​ນັດ​ໝາຍ</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form action="{{ url('/updateAppointment') }}" method="POST">
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="ap-date">ວັນ​ທີ​ເດືອນ​ປີ​ນັດ​ໝາຍ</label>
                                                                <input type="hidden" name="apid" id="apid" value="">
                                                                <input type="hidden" name="cusid" id="cusid" value="">
                                                                <input type="hidden" name="carid" id="carid" value="">
                                                                <input type="hidden" name="olddate" id="olddate" value="">
                                                                <input class="form-control" type="date" name="ap_date" id="ap_date" value="" placeholder=".../.../....." required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="ap_time">ເວ​ລາ​ນັດ​ໝາຍ</label>
                                                                <input id="ap_time" class="form-control" type="time" name="ap_time" value="" placeholder=".... : ...." required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="mdi mdi-cancel"></i> ຍົກ​ເລີກ</button>
                                                    <button type="submit" class="btn btn-success" id="btnUpdate"><i class="mdi mdi-database-edit"></i> ແກ້​ໄຂ</button>
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

@include('manage.layout.foot')
<script src="{{ url('js/appointsetting.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif