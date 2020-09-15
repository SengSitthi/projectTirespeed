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
                    <h3 class="text-center"><b>ລາຍ​ງານ​ຂໍ້​ມູນລົດ</b></h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-light table-bordered table-striped table-responsive">
                                    <thead>
                                        <tr>
                                          <th class="text-center">ລະ​ຫັດ​ລົດ</th>
                                          <th class="text-center">ປ້າຍທະບຽນ​ລົດ</th>
                                          <th class="text-center">ເລກ​ຈັກ</th>
                                          <th class="text-center">ເລກ​ຖັງ</th>
                                          <th class="text-center">ຍີ່​ຫໍ້</th>
                                          <th class="text-center">ລຸ້ນ</th>
                                          <th class="text-center">ປີ​ຜະ​ລິດ</th>
                                          <th class="text-center">ສີ​ລົດ</th>
                                          <th class="text-center">​ເລກ​ກົງ​ເຕີ</th>
                                          <th class="text-center">ປະ​ເພດ​ເຄື່ອ​ງ​ຈັກ</th>
                                          <th class="text-center">ລະ​ຫັດ​ລູກ​ຄ້າ</th>
                                          <th class="text-center">​ຊື່ ແລະ ນາມ​ສະ​ກ​ຸນ</th>
                                        </tr>
                                    </thead>
                                    <tbody id="showdata">
                                    @if(count($cardata) > 0)
                                      @foreach($cardata as $car)
                                      <tr>
                                        <td>{{ $car->carid }}</td>
                                        <td>{{ $car->license }}</td>
                                        <td>{{ $car->motornum }}</td>
                                        <td>{{ $car->bodynum }}</td>
                                        <td>{{ $car->brandname }}</td>
                                        <td>{{ $car->model }}</td>
                                        <td>{{ $car->madeyear }}</td>
                                        <td>{{ $car->color }}</td>
                                        <td>{{ $car->distance }}</td>
                                        <td>{{ $car->motor }}</td>
                                        <td>{{ $car->cusid }}</td>
                                        <td>{{ $car->name }} {{ $car->lastname }}</td>
                                      </tr>
                                      @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="text-right" colspan="9">ຈຳ​ນວນ​ລູກ​ຄ້າ:</td>
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
                                <a class="btn btn-info" href="{{ url('/reportcars') }}" id="btnBack"><i class="mdi mdi-arrow-left-bold-circle"></i> ກັບ​ຄືນ</a>
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