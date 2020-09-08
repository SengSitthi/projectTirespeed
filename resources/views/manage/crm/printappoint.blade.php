@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
<style type="text/css" media="print">
    @page { size: landscape; }
</style>
    {{-- <div class="wrapper"> --}}

        {{-- @include('manage.layout.nav') --}}

        {{-- @include('manage.layout.sidemenu') --}}

        {{-- <div class="container-fluid mt-30"> --}}

            <div class="row">
                <div class="col-lg-12">
                    <img src="{{ url('images/header.png') }}" class="img-fluid">
                    <br>
                    <h3 class="text-center"><b>ລາຍ​ງານ​ຂໍ້​ມູນ​ລູກ​ຄ້າ</b></h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-light table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ວັນ​ທີ່​ນັດ​ໝາຍ</th>
                                            <th class="text-center">ເວ​ລາ</th>
                                            <th class="text-center">ລະ​ຫັດ​ລູກ​ຄ້າ</th>
                                            <th class="text-center">ຊື່ ແລະ ນາມ​ສະ​ກຸນ</th>
                                            <th class="text-center">ເບີ​ໂທ</th>
                                            <th class="text-center">ລະ​ຫັດ​ລົດ</th>
                                            <th class="text-center">ປ້າຍ​ລົດ</th>
                                            <th class="text-center">ຍີ່​ຫໍ້</th>
                                            <th class="text-center">ລຸ້ນ</th>
                                            <th class="text-center">​ປີ​ຜະ​ລິດ</th>
                                            <th class="text-center">ສີລົດ</th>
                                            <th class="text-center">​ເລກ​ກົງ​ເຕີ</th>
                                            <th class="text-center">ປະ​ເພດ​ຈັກ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if (count($appointments) > 0)
                                        @foreach($appointments as $app)
                                            <td>{{ $app->ap_date }}</td>
                                            <td>{{ $app->ap_time }}</td>
                                            <td>{{ $app->cusid }}</td>
                                            <td>{{ $app->name }} {{ $app->lastname }}</td>
                                            <td>{{ $app->mobile }}</td>
                                            <td>{{ $app->carid }}</td>
                                            <td>{{ $app->license }}</td>
                                            <td>{{ $app->brandname }}</td>
                                            <td>{{ $app->model }}</td>
                                            <td>{{ $app->madeyear }}</td>
                                            <td>{{ $app->color }}</td>
                                            <td>{{ $app->distance }}</td>
                                            <td>{{ $app->motor }}</td>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="12" class="text-right">ຈຳ​ນວນ​ລູກ​ຄ້າ:</td>
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
                                <a class="btn btn-info" href="{{ url('/reportAppointment') }}" id="btnBack"><i class="mdi mdi-arrow-left-bold-circle"></i> ກັບ​ຄືນ</a>
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