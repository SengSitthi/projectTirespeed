@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
  <div class="wrapper">

  @include('manage.layout.nav')
  @include('manage.layout.sidemenu')

    <div class="container-fluid mt-30">
      @error('rpbid')
        <div class="amaran-wrapper bottom right">
          <div class="amaran-wrapper-inner">
            <div class="amaran awesome error" style="display: block;">
              <i class="icon fa fa-ban icon-large"></i>
              <p class="bold">ຜິດ​ພາດ!</p>
              <p><span>ທ່າຍ​ຍັງ​ບໍ່​ໄດ້​ເລືອກ​ໃບ​ເປີ​ດ​ງານ​ເທື່ອ!</span>
                <span class="light">​ກະ​ລ​ຸ​ນາ​ເລືອກ​ລູກ​ຄ້າ​ກ່ອນ</span>
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
                <div class="col-md-8">
                  <h3>ໃບ​ສະ​ເໜີ​ໃໝ່</h3>
                </div>
                <div class="col-md-4">
                  <a href="{{ url('quotationlist') }}" class="btn btn-primary"><i class="mdi mdi-link"></i> ລາຍ​ການ​ໃບ​ສະ​ເໜີ</a>
                </div>
              </div>
            </div>
            <form class="card-body" action="{{ url('insertnewqt') }}" method="POST">
              {{ csrf_field() }}
              <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#" class="nav-link w3-blue w3-large"><i class="mdi mdi-car"></i> ຂໍ້​ມູນ​ລູ​ກ​ຄ້າ</a>
                </li>
              </ul>
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="qtid">ລະ​ຫັດ​ໃບ​ສະ​ເໜີ</label>
                    <input class="form-control" type="text" id="qtid" name="qtid" value="{{ $qtid }}" readonly>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="rpbid">ເລືອກ​ໃບ​ເປີດ​ງານ</label>
                    <select name="rpbid" id="rpbid" class="form-control">
                      <option value="">ເລືອກ​ໃບ​ເປີດ​ງານ</option>
                      @if(count($repairbill) > 0)
                        @foreach ($repairbill as $rpb)
                          <option value="{{ $rpb->rpbid }}">{{ $rpb->rpbid }}</option>
                        @endforeach
                      @else
                        <option value="">ບໍ່​ມີ​ຂໍ້​ມູນ​ໃບ​ເປີດ​ງານ</option>
                      @endif
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="part">ພາກ​ສ່ວນ</label>
                    <input id="part" class="form-control" type="text" name="part">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="checkin_date">ວັນ​ທີ່​ເຂົ້າ</label>
                    <input id="checkin_date" class="form-control" type="text" name="checkin_date" required>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label for="checkin_time">ເວ​ລາ​ເຂົ້າ</label>
                    <input id="checkin_time" class="form-control" type="text" name="checkin_time" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="checkout_date">ວັນ​ທີ່​ອອກ</label>
                    <input id="checkout_date" class="form-control" type="text" name="checkout_date" required>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label for="checkout_time">ເວ​ລາ​ອອກ</label>
                    <input id="checkout_time" class="form-control" type="text" name="checkout_time" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="document_date">ວັນ​ທີ່​ອອກ​ເອ​ກະ​ສາ​ນ</label>
                    <input id="document_date" class="form-control" type="text" name="document_date" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="expire_date">ວັນ​ທີ່​ໝົດ​ກຳ​ນົດ</label>
                    <input id="expire_date" class="form-control" type="text" name="expire_date" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="credit_day">ຈຳ​ນວນ​ມື້</label>
                    <input id="credit_day" class="form-control" type="number" name="credit_day" readonly required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="instance">ເລກ​ກົງ​ເຕີ</label>
                    <input id="instance" class="form-control" type="number" name="instance" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="receive_bill">ເລກ​ທີ​ໃບ​ຮັບ​ລົດ</label>
                    <input id="receive_bill" class="form-control" type="text" name="receive_bill" required>
                  </div>
                </div>
                <div class="col-md-2 text-center">
                  <p></p>
                  <button class="btn btn-success btn-lg" type="submit"><i class="mdi mdi-file-document-box-plus"></i> ບັນ​ທຶກ​ໃບ​ສະ​ເໜີ</button>
                </div>
              </div>
              <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#" class="nav-link w3-blue w3-large"><i class="mdi mdi-car"></i> ລາຍ​ລະ​ອຽດ​ອະ​ໄຫຼ່</a>
                </li>
              </ul>
              <div class="row col-md-12">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead class="text-center">
                      <tr>
                        <th>ລະ​ຫັດ​ບໍ​ລິ​ການ</th>
                        <th>ຊື່ອະ​ໄຫຼ່</th>
                        <th>​ຫົວ​ໜ່ວຍ​ອະ​ໄຫຼ່</th>
                        <th>ຈຳ​ນວນ</th>
                        <th>ລາ​ຄາ​ຂາຍ (ກີບ)</th>
                        <th>ລວມ (ກີບ)</th>
                        <th>ລະ​ຫັດ​ແຮງ​ງານ</th>
                        <th>ຊື່​ຄ່າແຮງ​ງານ</th>
                        <th>ຄ່າ​ແຮງ​ງານ</th>
                      </tr>
                    </thead>
                    <tbody id="showrpbdetail">
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>

@include('manage.layout.foot')
<script src="{{ url('js/quotationnew.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif