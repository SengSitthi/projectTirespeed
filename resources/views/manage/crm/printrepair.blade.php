@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
    {{-- <div class="wrapper"> --}}

        {{-- @include('manage.layout.nav') --}}

        {{-- @include('manage.layout.sidemenu') --}}

        {{-- <div class="container-fluid mt-30"> --}}

            <div class="row">
                <div class="col-lg-12">
                    <img src="{{ url('images/header.png') }}" class="img-fluid">
                    <br>
                    <h3 class="text-center"><b>ລາຍ​ງານ​ຂໍ້​ມູນລາຍ​ການ​ສ້ອມ</b></h3>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                        @if (count($cusdata) > 0)
                            @foreach ($cusdata as $cus)
                                <h4>ລະ​ຫັດ​ລ​ູກ​ຄ້າ: <b id="showcusid">{{ $cus->cusid }}</b></h4>
                                <h4>ຊື່ ແລະ ນາມ​ສະ​ກ​ຸນ: <b id="showname">{{ $cus->name }} {{ $cus->lastname }}</b></h4>
                                <h4>ບ່ອນຢ​ູ່: <b id="showaddress">{{ $cus->village }}, {{ $cus->disname }}, {{ $cus->proname }}</b></h4>
                            @endforeach
                        @else
                            <h4 class="text-center">ບໍ່​ມີ​ຂໍ້​ມູນ​ລູກ​ຄ້າ​ຄົນ​ນີ້</h4>
                        @endif
                        </div>
                        <div class="col-md-5">
                        @if(count($cardata) > 0)
                            @foreach($cardata as $car)
                            <h4>ລະ​ຫັດ​ລົດ: <b id="showcarid">{{ $car->carid }}</b></h4>
                            <h4>ປ້າຍ​ລົດ: <b id="showlicense">{{ $car->license }}</b></h4>
                            <h4>ຍີ່​ຫໍ້​ລົດ: <b id="showbrand">{{ $car->brandname }}</b> ລຸ້ນ: <b id="showmodel">{{ $car->model }}</b></h4>
                            @endforeach
                        @else
                        <h4 class="text-center">ບໍ່​ມີ​ຂໍ້​ມູນ​ລົດ​ຄັນ​ນີ້</h4>
                        @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="table-responsive">
                                <table class="table table-light table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><h4>ລຳ​ດັບ</h4></th>
                                            <th class="text-center"><h4>ລາຍ​ການ</h4></th>
                                            <th class="text-center"><h4>ສະ​ຖາ​ນະ​ການ​ສ້ອມ</h4></th>
                                        </tr>
                                    </thead>
                                    <tbody id="showlist">
                                    @if (count($repair) > 0)
                                        <?php $i = 1; ?>
                                        @foreach ($repair as $rp)
                                            <tr>
                                                <td class="text-center"><h4>{{ $i++ }}</h4></td>
                                                <td><h4>{{ $rp->list }}</h4></td>
                                                <td>
                                                    @if($rp->status == "0")
                                                        <h4>ຍັງ​ບໍ່​ໄດ້​ສ້ອມ​ແປງ</h4>    
                                                    @else
                                                        <h4>ສ້ອມ​ແປງ​ສຳ​ເລັດ</h4>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        
                                    @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="text-right" colspan="2">ຈຳ​ນວນ​ລາຍ​ການ:</td>
                                            <td class="text-center"><b id="showcount">{{ $count }}</b></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <a class="btn btn-info" href="{{ url('/reportrepair') }}" id="btnBack"><i class="mdi mdi-arrow-left-bold-circle"></i> ກັບ​ຄືນ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- </div> --}}

    {{-- </div> --}}

@include('manage.layout.foot')
    <script>
        $(document).ready(function(){
            window.onload = function(){
                $('#btnBack').hide();
                window.print();
            }
            window.onafterprint = function(){
                $('#btnBack').show();
            }
        })
    </script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif