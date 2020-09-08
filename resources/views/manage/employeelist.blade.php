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
                            <h3>ລາຍ​ຊື່​ພະ​ນັກ​ງານ</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-dark table-striped table-bordered">
                                    <thead class="thead-blue">
                                        <tr>
                                            <th class="text-center">ລະ​ຫັດ</th>
                                            <th class="text-center">​ຊື່​ພ​ະ​ນັກ​ງານ</th>
                                            <th class="text-center">​ນາມ​ສະ​ກຸນ</th>
                                            <th class="text-center">​ວັນ​ເດືອນ​ປີ​ເກີດ</th>
                                            <th class="text-center">ບ້ານ​ຢູ່</th>
                                            <th class="text-center">ເມືອງ</th>
                                            <th class="text-center">ແຂ​ວງ</th>
                                            <th class="text-center">ເບີ​ໂທ</th>
                                            <th class="text-center">ອີ​ເມວ</th>
                                            <th class="text-center">ຈ​ັດ​ການ</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody-light" id="showemp">
                                        
                                    </tbody>
                                    <tfoot class="thead-light">
                                        <tr>
                                            <th colspan="9" class="text-right">ຈຳ​ນວນ</th>
                                            <th class="text-center"><b id="numrow"></b></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade bd-example-modal-xl" id="modalform" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title h4" id="myExtraLargeModalLabel">​ແກ້​ໄຂ​ຂໍ້​ມູນ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="post">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>ລະ​ຫັດ​ພະ​ນັກ​ງານ</label>
                                            <input type="text" class="form-control" required="" id="showempid" value="" placeholder="ລະ​ຫັດ" disabled>
                                            <input type="hidden" name="empid" id="empid" value="">
                                        </div>        
                                        <div class="form-group">
                                            <label>ຊື່​ພະ​ນັກ​ງານ</label>
                                            <input type="text" class="form-control" name="name" id="name" required="" value="" placeholder="...........">
                                        </div>
                                        <div class="form-group">
                                            <label>ນາມ​ສະ​ກຸນ</label>
                                            <input type="text" class="form-control" name="lastname" id="lastname" required="" value="" placeholder="...........">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>ວ​ັນ​ເດືອນ​ປີ​ເກີດ</label>
                                            <input type="date" class="form-control" name="birthday" id="birthday" required="" value="" placeholder="...........">
                                        </div>
                                        <div class="form-group">
                                            <label>ບ້ານ​ຢູ່​ປະ​ຈຸ​ບັນ</label>
                                            <input type="text" class="form-control" name="village" id="village" required="" value="" placeholder="...........">
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
                                            <input type="number" class="form-control" name="mobile" id="mobile" required="" value="" placeholder="...........">
                                        </div>
                                        <div class="form-group">
                                            <label>ອີ​ເມ​​ລ</label>
                                            <input type="email" class="form-control" name="email" id="email" required="" value="" placeholder="...........">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button class="btn btn-success btn-lg" type="button" id="btnUpdate"><i class="mdi mdi-account-edit"></i> ແກ້​ໄຂ​ຂໍ້​ມ​ູນ​ພະ​ນັກ​ງານ</button>
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

<script type="text/javascript" src="{{ url('js/employeelist.js') }}"></script>

@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif