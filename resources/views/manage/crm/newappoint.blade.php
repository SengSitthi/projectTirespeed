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
                            <h3>ນັດ​ໝາຍ​ລູກ​ຄ້າ​ໃໝ່</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @if(count($errors) > 0)
                                    <div class="alert alert-danger" role="alert">
                                        <button class="close" data-dismiss="alert">&times;</button>
                                        <ul>
                                          @foreach ($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                          @endforeach  
                                        </ul>
                                    </div>
                                    @endif
                                    <form action="{{ url('innewappoint') }}" method="POST">
                                        {{ csrf_field() }}
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a href="#" class="nav-link w3-blue w3-large"><i class="mdi mdi-account-tie"></i> ຂໍ້​ມູນ​ລູ​ກ​ຄ້າ</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link w3-large">ລະ​ຫັດ​ລູກ​ຄ້າ <b>CUS{{ $cusid }}</b></a>
                                            </li>
                                        </ul>
                                        <div class="row w3-padding">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <input type="hidden" name="cusid" value="CUS{{ $cusid }}">
                                                    <label for="cusname">ຊື່​ລູກ​ຄ້າ</label>
                                                    <input id="cusname" class="form-control" type="text" name="cusname" placeholder="..." required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="lastname">ນາມ​ສະ​ກ​ຸນ</label>
                                                    <input id="lastname" class="form-control" type="text" name="lastname" placeholder="..." required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="village">ບ້ານຢ​ູ່​ປະ​ຈຸ​ບັນ</label>
                                                    <input id="village" class="form-control" type="text" name="village" placeholder="..." required>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="proid">ແຂວງ</label>
                                                    <select id="proid" class="form-control btn-outline-primary1" name="proid" data-toggle="tooltip" data-placement="bottom" title="​ເລືອກ​ແຂວງ​ຂອງ​ເມືອງ">
                                                        @if (count($province) > 0)
                                                        <option value="">***** ເລືອກ​ແຂວງ *****</option>
                                                            @foreach ($province as $pro)
                                                            <option value="{{ $pro->proid }}">{{ $pro->proname }}</option>
                                                            @endforeach
                                                        @else
                                                            <option value="">ຍັງ​ບໍ່​ມີ​ການ​ເພີ່ມ​ແຂວງ​ໃສ່​ເທື່ອ</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="disid">ເມືອງ</label>
                                                    <select id="disid" class="form-control btn-outline-primary1" name="disid" title="​ກະ​ລ​ຸ​ນາເລືອກ​ແຂວງ​ກ່ອນ" disabled>
                                                        
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="mobile">ເບີ​ໂທມື​ຖື</label>
                                                    <input id="mobile" class="form-control" type="number" name="mobile" placeholder="..." required>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="phone">ເບີ​ໂທ​ສຸກ​ເສີນ</label>
                                                    <input id="phone" class="form-control" type="number" name="phone" placeholder="..." required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="occupation">ອາ​ຊີບ</label>
                                                    <input id="occupation" class="form-control" type="text" name="occupation" placeholder="..." required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="workadd">ບ່ອນ​ເຮັດ​ວຽກ</label>
                                                    <input id="workadd" class="form-control" type="text" name="workadd" placeholder="..." required>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="">ລູກ​ຄ້າ​ເຄີຍ​ໃຊ້​ບໍ​ລິ​ການ​ບໍ່?</label>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="status" class="w3-radio" value="ເຄີຍ" checked>
                                                        <label class="w3-xlarge" for="status">ເຄີຍ</label>
                                                        &nbsp;
                                                        <input type="radio" name="status" class="w3-radio" value="​ບໍ່​ເຄີຍ">
                                                        <label class="w3-xlarge" for="status">ບໍ່ເຄີຍ</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tcusid">ປະ​ເພດ​ລູກ​ຄ້າ</label>
                                                    <select id="tcusid" class="form-control btn-outline-primary1" name="tcusid">
                                                    @if (count($typecus) > 0)
                                                        <option value="">***** ເລືອກ​ປະ​ເພດ​ລູກ​ຄ້າ *****</option>
                                                        @foreach ($typecus as $tcus)
                                                            <option value="{{ $tcus->tcusid }}">{{ $tcus->tcusname }}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="">ຍັງ​ບໍ່​ມີ​ຂໍ້​ມູນ​ປະ​ເພດ​ລູກ​ຄ້າ</option>
                                                    @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a href="#" class="nav-link w3-blue w3-large"><i class="mdi mdi-car"></i> ຂໍ້​ມູນ​ລົດລູ​ກ​ຄ້າ</a>
                                            </li>
                                            <li>
                                                <a href="#" class="nav-link w3-large">ລະ​ຫັດ​ລົດ <b>{{ $carid }}</b></a>
                                            </li>
                                        </ul>
                                        <div class="row w3-padding">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <input type="hidden" name="carid" value="{{ $carid }}">
                                                    <label for="license">ປ້າຍ​ລົດ</label>
                                                    <input id="license" class="form-control" type="text" name="license" placeholder="..." required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="brandid">ຍີ່​ຫໍ້​ລົດ</label>
                                                    <select class="form-control btn-outline-primary1" name="brandid" id="brandid">
                                                    @if (count($brands) > 0)
                                                        <option value="">***** ເລືອກ​ຍີ່​ຫໍ້​ລົດ *****</option>
                                                        @foreach ($brands as $bd)
                                                            <option value="{{ $bd->brandid }}">{{ $bd->brandname }}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="">ຍັງ​ບໍ່​ມີ​ຍີ່​ຫໍ້​ລົດ​ໃນ​ລະ​ບົບ​ເທື່ອ</option>
                                                    @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                              <div class="form-group">
                                                <label for="motornum">ເລກ​ຈັກ</label>
                                                <input id="motornum" class="form-control" type="text" name="motornum">
                                              </div>
                                              <div class="form-group">
                                                <label for="bodynum">ເລ​ກ​ຖັງ</label>
                                                <input id="bodynum" class="form-control" type="text" name="bodynum">
                                              </div>
                                            </div>
                                            <div class="col-3">
                                              <div class="row">
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                    <label for="model">ລູ້ນ</label>
                                                    <input id="model" class="form-control" type="text" name="model" placeholder="..." required>
                                                  </div>
                                                </div>
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                    <label for="madeyear">ປີ​ຜະ​ລິດ</label>
                                                    <input id="madeyear" class="form-control" type="text" name="madeyear" placeholder="...">
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                    <label for="color">ສີລົດ</label>
                                                    <input id="color" class="form-control" type="text" name="color" placeholder="..." required>
                                                  </div>
                                                </div>
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                    <label for="distance">​ເລກ​ກົງ​ເຕີ</label>
                                                    <input id="distance" class="form-control" type="number" name="distance" placeholder="..." required>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="col-3">
                                              <div class="form-group">
                                                <label for="motor">​ປະ​ເພດ​ເຄື່ອງ​ຈັກ</label>
                                                <select id="motor" class="form-control" name="motor">
                                                  <option value="">***** ເລືອກປະ​ເພດ​ລົດ *****</option>
                                                  <option value="ແອັດ​ຊັງ">ແອັດ​ຊັງ</option>
                                                  <option value="ກາ​ຊວນ">ກາ​ຊວນ</option>
                                                  <option value="ໄຟ​ຟ້າ">ໄຟ​ຟ້າ</option>
                                                </select>
                                              </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-6" style="border-right: 1px solid lightgray">
                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link w3-blue w3-large"><i class="mdi mdi-tools"></i> ລາຍ​ການ​ລູກ​ຄ້​າ​ຕ້ອງ​ການ​ສ້ອມ</a>
                                                    </li>
                                                </ul>
                                                <div class="w3-padding">
                                                    <label for="">ລາຍ​ການ​ສ້ອມ​ແປງ</label>
                                                    <table class="table table-default" id="dynamic_field">
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control" name="repair[]" id="repair" placeholder="Enter list for repair..." required>
                                                            <td>
                                                                <button name="add" id="add" type="button" class="btn btn-success" ><i class="mdi mdi-plus-box"></i> ເພີ່ມ​ແຖວ</button>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link w3-blue w3-large"><i class="mdi mdi-calendar-clock"></i> ກຳ​ນົດ​ເວ​ລາ​ນັດ​ໝາຍ</a>
                                                    </li>
                                                </ul>
                                                <div class="w3-padding">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="ap_time">ເວ​ລາ​ນັດ​ໝາຍ</label>
                                                                <input id="ap_time" class="form-control" type="time" name="ap_time" placeholder="..." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="ap_date">ເວ​ລາ​ນັດ​ໝາຍ</label>
                                                                <input id="ap_date" class="form-control" type="date" name="ap_date" placeholder="..." required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 w3-center w3-padding">
                                                <button class="btn btn-primary btn-lg" type="submit"><i class="mdi mdi-bookmark-plus-outline"></i> ເພີ່ມການນັດ​ໝາຍ​ລ​ູກ​ຄ້າ</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@include('manage.layout.foot')
<script src="{{ url('js/newappoint.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif