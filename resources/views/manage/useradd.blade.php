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
                            <h3>ເພີ່ມ​ຜູ້​ໃຊ້ລະ​ບົບ</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('insertUser') }}" method="post">
                                <div class="row">
                                    <div class="col-3">&nbsp;</div>
                                    <div class="col-6">
                                        <div class="form-group">
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
                                <div id="userdata" style="display:none">
                                    <div class="row" id="">
                                        <div class="col-2"></div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="name">ຊື່​ຜູ້​ໃຊ້</label>
                                                <input id="name" class="form-control" type="text" name="name" placeholder=".......">
                                            </div>
                                            <div class="form-group">
                                                <label for="pass">ລະ​ຫັດ</label>
                                                <input id="pass" class="form-control" type="password" name="pass" placeholder=".......">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="email">ອີ​ເມວ​ຜູ້​ໃຊ້</label>
                                                <input id="email" class="form-control" type="email" name="email" placeholder=".......">
                                            </div>
                                            <div class="form-group">
                                                <label for="confirmpass">​ລະ​ຫັດ​ຢືນ​ຢັນ</label>
                                                <input id="confirmpass" class="form-control" type="password" name="confirmpass" placeholder=".......">
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
                                            <button class="btn btn-success btn-lg" id="btnInsert" type="button" disabled><i class="mdi mdi-account-plus-outline"></i> ເພີ່ມ​ຜ​ູ້​ໃຊ້​ລະ​ບົບ</button>
                                        </div>
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
<script type="text/javascript" src="{{ url('js/useradd.js') }}"></script>

@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif