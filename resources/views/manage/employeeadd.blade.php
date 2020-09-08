@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
    <div class="wrapper">

        @include('manage.layout.nav')

        @include('manage.layout.sidemenu')

        <div class="container-fluid mt-30">

            @if (count($errors) > 0)
                <script>swal({
                    title: "ການ​ເພີ່ມ​ພາດ!",
                    text: "ກະ​ລຸ​ນາ​ເລືອກ​ແຂວງ​ກ່ອນ",
                    icon: "error",
                    button: false,
                    timer: 3000
                });
                </script>
            @endif
            @if (Session::get('error'))
                <script>swal({
                    title: "ຜິດ​ພາດ!",
                    text: "ທ່ານ​ບໍ່​ມີ​ສິດ​ເພີ່ມ​ຂໍ້​ມູນ​ໃນ​ລະ​ບົບ",
                    icon: "error",
                    button: true,
                });
            </script>
            @endif
            @if (Session::get('success'))
                <script>swal({
                    title: "​ສຳ​ເລັດ!",
                    text: "ການ​ເພີ່ມ​ຂໍ້​ມູນ​ພະ​ນັກ​ງານສຳ​ເລັດ",
                    icon: "success",
                    button: false,
                    timer: 3000
                });
            </script>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-transparent py-15">
                            <h3>ເພີ່ມ​ພະ​ນັກ​ງານ</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('insertemp') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>ລະ​ຫັດ​ພະ​ນັກ​ງານ</label>
                                            <input type="text" class="form-control" required="" value="EMP{{ $empid }}" placeholder="ລະ​ຫັດ" disabled>
                                            <input type="hidden" name="empid" value="EMP{{ $empid }}">
                                        </div>        
                                        <div class="form-group">
                                            <label>ຊື່​ພະ​ນັກ​ງານ</label>
                                            <input type="text" class="form-control" name="name" required="" value="" placeholder="...........">
                                        </div>
                                        <div class="form-group">
                                            <label>ນາມ​ສະ​ກຸນ</label>
                                            <input type="text" class="form-control" name="lastname" required="" value="" placeholder="...........">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>ວ​ັນ​ເດືອນ​ປີ​ເກີດ</label>
                                            <input type="date" class="form-control" name="birthday" id="birthday" required="" value="" placeholder="...........">
                                        </div>
                                        <div class="form-group">
                                            <label>ບ້ານ​ຢູ່​ປະ​ຈຸ​ບັນ</label>
                                            <input type="text" class="form-control" name="village" required="" value="" placeholder="...........">
                                        </div>
                                        <div class="form-group">
                                            <label>ແຂວງ</label>
                                            <select class="form-control btn-outline-primary" name="proid" id="proid">
                                                @if (count($provinces) > 0)
                                                <option value="">***** ເລືອກ​ແຂວງ *****</option>
                                                    @foreach ($provinces as $pro)
                                                    <option value="{{ $pro->proid }}">{{ $pro->proname }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">ຍັງ​ບໍ່​ມີ​ການ​ເພີ່ມ​ແຂວງ​ໃສ່​ເທື່ອ</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>ເມືອງ</label>
                                            <select class="form-control btn-outline-primary" name="disid" id="disid">
                                                <option value="" data-icon="mdi mdi-home-map-marker mr-1"> ເລືອກ​ແຂວງ​ຂອງ​ເມືອງ</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>ເບີ​ໂທ</label>
                                            <input type="number" class="form-control" name="mobile" required="" value="" placeholder="...........">
                                        </div>
                                        <div class="form-group">
                                            <label>ອີ​ເມ​​ລ</label>
                                            <input type="email" class="form-control" name="email" required="" value="" placeholder="...........">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button class="btn btn-success btn-lg" type="submit"><i class="mdi mdi-account-multiple-plus"></i> ເພີ່ມ​ພະ​ນັກ​ງານ</button>
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
<script type="text/javascript" src="{{ url('js/employeeadd.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif