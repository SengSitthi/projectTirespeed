@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
    {{-- <div class="wrapper"> --}}

        <div class="container-fluid mt-30" id="back">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row" id="showcontent">
                                <div class="col-12">
                                    <img src="{{ url('images/header.png') }}" alt="" srcset="" class="img-fluid">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    <h3 class="w3-center"><b>ໃບ​ນັດ​ໝາຍ/ແຈ້ງ​ສ້ອມ​ແປງ ລູກ​ຄ້າ</b></h3>
                                                    <h5 class="w3-center">(Appointment/Note Customer)</h5>
                                                </th>
                                                <th>
                                                    @foreach ($billid as $bid)
                                                        <h4>ລະ​ຫັດ​ບິນ: <b>{{ $bid->billid }}</b></h4>  
                                                    @endforeach
                                                    <h4>ວັນ​ທີ່: <b>{{ date('Y-m-d') }}</b></h4>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($customers as $cus)
                                            <tr>
                                                <td><h4>ຊື່: <b>{{ $cus->name }}</b></h4></td>
                                                <td><h4>ນາມ​ສະ​ກຸນ: <b>{{ $cus->lastname }}</b></h4></td>
                                                <td><h4></h4></td>
                                            </tr>
                                            <tr>
                                                <td><h4>ທີ່​ຢູ່​ບ້ານ: <b>{{ $cus->village }}</b></h4></td>
                                                <td><h4>ເມືອງ: <b>{{ $cus->disname }}</b></h4></td>
                                                <td><h4>ແຂວງ: <b>{{ $cus->proname }}</b></h4></td>
                                            </tr>
                                            <tr>
                                                <td><h4>ມື​ຖື: <b>{{ $cus->mobile }}</b></h4></td>
                                                <td><h4>​ໂທ​ລະ​ສັບ: <b>{{ $cus->phone }}</b></h4></td>
                                                <td><h4>ອາ​ຊີບ: <b>{{ $cus->occupation }}</b></h4></td>
                                            </tr>
                                            <tr>
                                                <td><h4>ຊື່​ບ່ອນ​ປະ​ຈຳ​ການ: <b>{{ $cus->workaddress }}</b></h4></td>
                                                <td colspan="2"><h4>ປະ​ເພດ​ລູກ​ຄ້າ: <b>{{ $cus->tcusname }}</b></h4></td>
                                            </tr>
                                            @endforeach
                                            @foreach($cardata as $car)
                                            <tr>
                                                <td><h4>ລົດ​ທະ​ບຽນ: <b>{{ $car->license }}</b></h4></td>
                                                <td><h4>ຍີ່​ຫໍ້: <b>{{ $car->brandname }}</b> ລຸ້​ນ: <b>{{ $car->model }}</b></h4></td>
                                                <td><h4>ປີ​ຜະ​ລິດ: <b>{{ $car->madeyear }}</b></h4></td>
                                            </tr>
                                            <tr>
                                                <td><h4>ສີ​ລົດ: <b>{{ $car->color }}</b></h4></td>
                                                <td><h4>ເຄື່ອງ​ຈັກ: <b>{{ $car->motor }}</b></h4></td>
                                                <td><h4>ກົງ​ເຕີ: <b>{{ $car->distance }}</b></h4></td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                @foreach($customers as $cus)
                                                <td colspan="3"><h4>ລູກ​ຄ້າ​ເຄີຍ​ໃຊ້​ບໍ​ລິ​ການ​ທີ່​ສູນ​ບໍ່? <b>{{ $cus->status }}</b></h4></td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td colspan="3"><h4>ລາຍ​ການ​ລູກ​ຄ້າ​ສອບ​ຖາມ ຫຼື້ ລາຍ​ການ​ທີ່​ລູກ​ຄ້າ​ຕ້ອງ​ການ​ແຈ້ງ​ສ້ອມ​ແປງ​ການ​ເປ​ເພ​ມີ:</h4></td>
                                            </tr>
                                            @foreach($listdata as $list)
                                                <tr>    
                                                    <td colspan="3"><h4>&#9733; <b> {{ $list->list }}</b></h4></td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                            @foreach($appointment as $app)
                                                <td colspan="2"><h4>ວັນ​ທີ່ ແລະ ເວ​ລາ​ນັດ​ໝາຍ <b>{{ $app->ap_date }}  {{ $app->ap_time }}</b></h4></td>
                                            @endforeach
                                                <td rowspan="4"><h3 class="w3-center">ພະ​ນັກ​ງານ​ຕ້ອນ​ຮັບ (CRM)</h3></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <h4>ວັນ​ທີ​ຮັບ​ເຂົ້າ​ສ້ອມ​ແປງ <b></b></h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><h4>ເວ​ລາ​ສ້ອມ​ແປງ <b>_ _ _ _ _</b> ໂມງ ເຖິງ <b>_ _ _ _ _</b> ໂມງ</h4></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <h4>ວັນ​ທີ່​ສົ່ງ​ຄືນ​ລູກ​ຄ້າ  _ _ _/_ _ _/ {{ date('Y') }}</h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <a class="btn btn-info" href="{{ url('/newapppointment') }}" id="btnBack"><i class="mdi mdi-arrow-left-bold-circle"></i> ກັບ​ຄືນ</a>
                    </div>
                </div>
            </div>
        </div>

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
    });
</script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif