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
                            <h3>ລາຍ​ງານ​ນັດ​ໝາຍ</h3>
                        </div>
                        <div class="card-body">
                            <form class="row" action="{{ url('printAppointment') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="col-md-2"></div>
                                <div class="col-md-3">
                                    <select class="form-control" name="stylereport" id="stylereport">
                                        <option value="">**** ເລືອກ​ຮູບ​ແບບ​ລາຍ​ງານ ****</option>
                                        <option value="1">ລາຍ​ງານ​ນັດ​ໝາຍ​ມື້ນ​ີ້</option>
                                        <option value="2">​ລາຍ​ງານ​ນັດ​ໝາຍ​ເດືອນ​ນີ້</option>
                                        <option value="3">ລາຍ​ງານ​ນັດ​ໝາຍ​ບຸກ​ຄົນ</option>
                                        <option value="4">ລາຍ​ງານ​ນັດ​ໝາຍ​ດ້ວຍ​ເດືອນ</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="cusdiv" style="display: none">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">ລູ​ກ​ຄ້າ</span>
                                        </div>
                                        <select class="selectpicker form-control" id="cusid" name="cusid" data-live-search="true" data-style="btn-outline-primary" tabindex="-98">
                                        @if (count($customers) > 0)
                                            <option value="">***** ເລືອກ​ລ​ູກ​ຄ້າ *****</option>
                                            @foreach ($customers as $cus)
                                                <option value="{{ $cus->cusid }}">{{ $cus->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="">** ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ລ​ູກ​ຄ້າ​ໃນ​ລະ​ບົບ **</option>
                                        @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3" id="datediv" style="display: none">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">ເດືອນ</span>
                                        </div>
                                        <select class="form-control" name="month" id="month">
                                            <option value="">*** ເລືອກເດືອນ ***</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                @if(strlen($i) == 1)
                                                    <option value="0{{ $i }}">ເດືອນ 0{{ $i }}</option>
                                                @else
                                                    <option value="{{ $i }}">ເດືອນ {{ $i }}</option>
                                                @endif
                                            @endfor
                                        </select>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">ປີ</span>
                                        </div>
                                        <select class="form-control" name="year" id="year" disabled>
                                            <option value="">*** ເລືອກປີ ***</option>
                                            <?php $year = date('Y'); 
                                                $oldyear = (int)$year-1;
                                            ?>

                                            @for ($i = $oldyear; $i <= $year; $i++)
                                            <option value="{{ $i }}">ປີ {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-warning" type="submit" id="btnPrintReport" disabled><i class="mdi mdi-file-pdf"></i> ພິມ​ລາຍ​ງານ</button>
                                </div>
                            </form>
                            <br>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <table class="table table-light table-striped table-bordered">
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
                                        <tbody id="showdata">
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="12" class="text-right">ຈຳ​ນວນ​ລູກ​ຄ້າ:</td>
                                                <td class="text-center"><b id="showcount"></b></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@include('manage.layout.foot')
<script src="{{ url('js/reportappoint.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif