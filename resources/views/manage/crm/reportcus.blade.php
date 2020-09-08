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
                            <h3>ລາຍ​ງານ​ຂໍ້​ມູນ​ລູກ​ຄ້າ</h3>
                        </div>
                        <div class="card-body">
                            <form class="row" action="{{ url('printCustomer') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="col-md-3"></div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">ປະ​ເພດ​ລູ​ກ​ຄ້າ</span>
                                        </div>
                                        <select name="tcusid" id="tcusid" class="form-control btn-outline-primary1">
                                        @if (count($typecus) > 0)
                                            <option value="">***** ເລືອກ​ປະ​ເພດ​ລູ​ກ​ຄ້າ *****</option>
                                            @foreach ($typecus as $tcus)
                                                <option value="{{ $tcus->tcusid }}">{{ $tcus->tcusname }}</option>
                                            @endforeach
                                        @endif
                                        </select>
                                        
                                        {{-- <button type="button" class="btn btn-primary"><i class="mdi mdi-table-search"></i> ຄົ້ນ​ຫາ</button> --}}
                                      </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-warning"><i class="mdi mdi-printer"></i> ພິມ​ລາຍ​ງານ</button>
                                </div>
                            </form>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-light table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ລະ​ຫັດ​</th>
                                                <th class="text-center">ຊື່​ລູກ​ຄ້າ</th>
                                                <th class="text-center">ນາມ​ສະ​ກຸນ</th>
                                                <th class="text-center">​ບ້ານ​ຢູ່</th>
                                                <th class="text-center">​ເມືອງ</th>
                                                <th class="text-center">ແຂວງ</th>
                                                <th class="text-center">​ເບີ​ມື​ຖື</th>     
                                                <th class="text-center">​ເບີ​ໂທ​ສຸກ​ເສີນ</th>
                                                <th class="text-center">ອາ​ຊີບ</th>
                                                <th class="text-center">ບ່ອນ​ເຮັດ​ວຽກ</th>
                                                <th class="text-center">​ປະ​ເພດ​ລູກ​ຄ້າ</th>
                                                <th class="text-center">​ເຄີຍ​ໃຊ້​ບໍ​ລິ​ການ​ບໍ່</th>
                                            </tr>
                                        </thead>
                                        <tbody id="showdata">
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="11" class="text-right">ຈຳ​ນວນ​ລູກ​ຄ້າ:</td>
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
<script src="{{ url('js/reportcus.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif