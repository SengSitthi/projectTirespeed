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
                            <h3>ລາຍ​ງານ​ຂໍ້​ມູນ​ລົດ</h3>
                        </div>
                        <div class="card-body">
                            <form class="row" action="{{ url('printCarReport') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="col-md-2"></div>
                                <div class="col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">ຮູບ​ແບ​ບ​ລາຍ​ງານ</span>
                                        </div>
                                        <select name="reportstyle" class="form-control" id="reportstyle">
                                            <option value="">*** ເລືອກ​ຮູບ​ແບບ​ລາຍ​ງານ ***</option>
                                            <option value="1">ລາຍ​ງານ​ຂໍ້​ມູນ​ລົດທັງ​ໝົດ</option>
                                            <option value="2">ລາຍ​ງານ​ຂ​ໍ້​ມູນ​ລູກ​ຄ້າ ແລະ ລົດ</option>
                                            <option value="3">ລາຍ​ງານ​ຕາມ​ຍີ່​ຫໍ້​ລົດ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2" id="divcusid" style="display: none">
                                    <div class="input-group mb-3">
                                        <select name="cusid" id="cusid" class="selectpicker" data-live-search="true" data-style="btn-outline-primary" tabindex="-98">
                                            <option value="">***** ເລ​ືອກ​ລູກ​ຄ້າ *****</option>
                                        @if (count($customers) > 0)
                                            @foreach ($customers as $cus)
                                                <option value="{{ $cus->cusid }}">{{ $cus->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="">ຍັງ​ບໍ່​ມີ​ລູກ​ຄ້າ​ໃນ​ລະ​ບົບ​ເທື່ອ</option>
                                        @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2" id="divbrandid" style="display: none">
                                    <select name="brandid" id="brandid" class="selectpicker" data-live-search="true" data-style="btn-outline-primary" tabindex="-98">
                                        <option value="">***** ເລ​ືອກ​ຍີ່​ຫໍ້​ລົດ *****</option>
                                    @if (count($brands) > 0)
                                        @foreach ($brands as $bd)
                                            <option value="{{ $bd->brandid }}">{{ $bd->brandname }}</option>
                                        @endforeach
                                    @else
                                        <option value="">ຍັງ​ບໍ່​ມີ​ການ​ເພີ່ມ​ຍີ່​ຫໍ້​ລົດ​ໃນ​ລະ​ບົບ​ເທື່ອ</option>
                                    @endif    
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-warning" id="btnPrint" type="submit" disabled><i class="mdi mdi-file-pdf"></i> ພິມ​ລາຍ​ງານ</button>
                                </div>
                            </form>
                            <div class="row">
                              <div class="col-md-12">
                                <table class="table table-light table-striped table-bordered">
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
                                            {{-- <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> --}}
                                  </tbody>
                                  <tfoot>
                                    <tr>
                                      <td class="text-right" colspan="9">ຈຳ​ນວນ​ລູກ​ຄ້າ:</td>
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
<script src="{{ url('js/reportcar.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif