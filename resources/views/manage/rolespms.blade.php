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
                            <h3><b>ຈັດ​ການ​ສິດ​ທິ​ນຳ​ໃຊ້</b></h3>
                        </div>
                        <div class="card-body">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger" role="alert">
                                    <button class="close" data-dismiss="alert">&times;</button>
                                    <ul>
                                        @foreach ($errors as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (Session::get('success'))
                                <script>swal({
                                    title: "ສຳ​ເລັດ",
                                    text: "ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ!",
                                    icon: "success",
                                    button: false,
                                    timer: 2500
                            });</script>
                            @endif
                            <form action="{{ url('/insertrolepms') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-4">
                                        <select class="form-control btn-outline-success" name="uid" id="uid">
                                            <option value="">***** ເລືອກ​ຜູ້​ໃຊ້ *****</option>
                                            @if (count($users) > 0)
                                                @foreach ($users as $us)
                                                    <option value="{{ $us->id }}">{{ $us->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">ບໍ່​ມີ​ຜູ້​ໃຊ້​ໃນ​ລະ​ບົບ​ເທື່ອ</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h4><b>ສະ​ຖາ​ນະ​ໃຊ້​ງານ</b></h4>
                                        <div class="row" id="showstatus">
                                                
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h4><b>ສິດ​ທິ​ການ​ໃຊ້​ງານ</b></h4>
                                        <div class="row" id="showpms">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary btn-lg" type="submit" id="btnPrivillage" disabled><i class="mdi mdi-shield-account"></i> ເພີ່ມ​ສິດ​ທິ​ຜູ້​ໃຊ້</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@include('manage.layout.foot')
<script type="text/javascript" src="{{ url('js/rolepms.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif