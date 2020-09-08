@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
  <div class="wrapper">

  @include('manage.layout.nav')
  @include('manage.layout.sidemenu')

    <div class="container-fluid mt-30">
      @if (Session::get('success'))
        <script>swal({
          title: "ສຳ​ເລັດ",
          text: "ການ​ເພີ່ມ​ຂໍ້​ມູນ​ສຳ​ເລັດ",
          icon: "success",
          button: false,
          timer: 2500
        });</script>
      @endif
      @if (Session::get('alreadycar'))
      <div class="amaran-wrapper bottom right">
        <div class="amaran-wrapper-inner">
          <div class="amaran awesome error" style="display: block;">
            <i class="icon fa fa-ban icon-large"></i>
            <p class="bold">ຜິດ​ພາດ!</p>
            <p><span>ລະຫັດ​ລົດ​ຂອງ​ລູກ​ຄ້າ​ແມ່ນ​ມີ​ໃນ​ລະ​ບົບ​ແລ້ວ</span>
              <span class="light">​ກະ​ລ​ຸ​ນາ​ປ້ອນ​ໃໝ່​ອີກ​ຄັ້ງ</span>
            </p>
          </div>
        </div>
      </div>
      @endif
      @error('cusid')
        <div class="amaran-wrapper bottom right">
          <div class="amaran-wrapper-inner">
            <div class="amaran awesome error" style="display: block;">
              <i class="icon fa fa-ban icon-large"></i>
              <p class="bold">ຜິດ​ພາດ!</p>
              <p><span>​ທ່ານ​ຍັງ​ບໍ່​ໄດ້​ເລືອກເຈົ້າ​ຂອງ​ລົດ​</span>
                <span class="light">​ກະ​ລ​ຸ​ນາ​ເລືອກ​​​​ເຈົ້າຂອງລົດ​ກ່ອນ</span>
              </p>
            </div>
          </div>
        </div>
      @enderror
      @error('brandid')
        <div class="amaran-wrapper bottom right">
          <div class="amaran-wrapper-inner">
            <div class="amaran awesome error" style="display: block;">
              <i class="icon fa fa-ban icon-large"></i>
              <p class="bold">ຜິດ​ພາດ!</p>
              <p><span>​ທ່ານ​ຍັງ​ບໍ່​ໄດ້​ເລືອກຍີ່​ຫໍ້​ລົດ​ຂອງ​ລູກ​ຄ້າ</span>
                <span class="light">​ກະ​ລ​ຸ​ນາ​​ເລືອກ​ຍີ່​ຫໍ້​ລົດ​ລູກ​ຄ້າ​ກ່ອນ</span>
              </p>
            </div>
          </div>
        </div>
      @enderror
      @error('motor')
        <div class="amaran-wrapper bottom right">
          <div class="amaran-wrapper-inner">
            <div class="amaran awesome error" style="display: block;">
              <i class="icon fa fa-ban icon-large"></i>
              <p class="bold">ຜິດ​ພາດ!</p>
              <p><span>​ທ່ານ​ຍັງ​ບໍ່​ໄດ້​ເລືອກປະ​ເພດເຄື່ອງ​ຈັກ​ລົດ​</span>
                <span class="light">​ກະ​ລ​ຸ​ນາ​ເລືອກ​ປະ​ເພດ​ເຄື່ອງ​ຈັກ​ລົດ​ຂອງ​​​ລູກ​ຄ້າ​ກ່ອນ</span>
              </p>
            </div>
          </div>
        </div>
      @enderror
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header bg-transparent py-15">
              <div class="row">
                <div class="col-md-6">
                  <h3>ເພີ່ມ​ລົດ​ໃໝ່​ຂອງ​ລ​ູກ​ຄ້າ​ທີ່​ມີ​ໃນ​ລະ​ບົບ</h3>
                </div>
                <div class="col-md-3">
                  <a class="btn btn-primary" href="{{ url('newcustomer') }}"><i class="mdi mdi-account-group"></i> ເພີ່ມລູ​ກ​ຄ້າໃໝ່</a>
                </div>
                <div class="col-md-3">
                  <a class="btn btn-primary" href="{{ url('customerlist') }}"><i class="mdi mdi-account-group"></i> ລາຍ​ການ​ລູ​ກ​ຄ້າ</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="{{ url('insertNewcaroldcus') }}" method="post">
                {{ csrf_field() }}
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
                      <label for="cusid">ລູ​ກ​ຄ້າ</label>
                      <select id="cusid" class="form-control" name="cusid">
                        <option value="">ເລືອກ​ລູກ​ຄ້າ</option>
                        @if (count($customers) > 0)
                          @foreach ($customers as $cus)
                            <option value="{{ $cus->cusid }}">{{ $cus->name }}</option>
                          @endforeach
                        @else
                          <option value="">ຍັງ​ບໍ່​ມີ​ລູກ​ຄ້າ​ເທື່ອ</option>
                        @endif
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="carid" value="{{ $carid }}">
                      <label for="license">ປ້າຍ​ລົດ</label>
                      <input id="license" class="form-control" type="text" name="license" placeholder="..." required>
                    </div>
                  </div>
                  <div class="col-3">
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
                    <div class="form-group">
                      <label for="model">ລູ້ນ</label>
                      <input id="model" class="form-control" type="text" name="model" placeholder="..." required>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="madeyear">ປີ​ຜະ​ລິດ</label>
                      <input id="madeyear" class="form-control" type="text" name="madeyear" placeholder="...">
                    </div>
                    <div class="form-group">
                      <label for="color">ສີລົດ</label>
                      <input id="color" class="form-control" type="text" name="color" placeholder="..." required>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="distance">​ເລກ​ກົງ​ເຕີ</label>
                      <input id="distance" class="form-control" type="number" name="distance" placeholder="..." required>
                    </div>
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
                <div class="row">
                  <div class="col-md-12 text-center">
                    <button class="btn btn-success btn-lg" type="submit"><i class="mdi mdi-car-side"></i> ເພີ່ມ​ລົດ​ລູກ​ຄ້າ</button>
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
<script src="{{ url('js/newcustomoldcus.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif