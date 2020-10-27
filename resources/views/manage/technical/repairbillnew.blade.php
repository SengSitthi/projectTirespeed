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
              <div class="row">
                <div class="col-md-8">
                  <h3>ເພີ່ມ​ໃບ​ເປີດ​ງານ​ສ້ອມໃໝ່</h3>
                </div>
                <div class="col-md-4">
                  <a href="{{ url('repairbill_list') }}" class="btn btn-primary"><i class="mdi mdi-link"></i> ລານ​ການ​ໃບ​ເປີດ​ງານ​ສ້ອມ</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              @error('rcsid')
                <script>swal("ຜິດ​ພາດ","ກະ​ລຸ​ນາ​ເລືອກ​ເລກ​ທີ​ໃບ​ຮັບ​ລົດ, ແລ້ວ​ລອງ​ໃໝ່​ອີກ​ຄັ້ງ", "warning", {timer: 3000})</script>
              @enderror
              <form action="{{ url('insertnewrpbill') }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="rpbid">ລະ​ຫັດ​ໃບ​ແຈ້ງ​ສ້ອມ</label>
                      <input id="rpbid" class="form-control" type="text" name="rpbid" value="{{ $rpbid }}" readonly>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="rcsid">ເລກ​ທີໃບ​ຮັບ​ລົດ</label>
                      <select id="rcsid" class="form-control" name="rcsid">
                        @if (count($receivecars) > 0)
                          @foreach ($receivecars as $rcs)
                          <option value="{{ $rcs->rcsid }}">{{ $rcs->rcsid }}</option>
                          @endforeach
                        @else
                          <option value="">ຍັງ​ບໍ່​ມີ​ເລກ​ທີ​ໃບ​ຮັບ​ລົດ</option>
                        @endif
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="rpbdate">ວັນ​ທີ່​ໃບ​ແຈ້ງ​ສ້ອມ</label>
                      <input id="rpbdate" class="form-control" type="text" name="rpbdate" required>
                    </div>
                  </div>
                  <div class="col-md-4 d-flex justify-content-center mb-3">
                    <button class="btn btn-success" type="submit"><i class="mdi mdi-content-save"></i> ບັນ​ທຶກ</button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 table-responsive">
                    <table class="table table-light table-bordered table-striped">
                      <thead>
                        <tr class="text-center">
                          <th>ລະ​ຫັດ​ບໍ​ລິ​ການ</th>
                          <th>​ຊື່​ອະ​ໄຫຼ່</th>
                          <th>ຈຳ​ນວນ​ຕ້ອງ​ໃຊ້</th>
                          <th>​ລະ​ຫັດ​ແຮງ​ງານ</th>
                          <th>ຊື່​ແຮງ​ງານ​</th>
                          {{-- <th>ຈຳ​ນວນ</th> --}}
                          <th>​ຫົວ​ໜ່ວຍ</th>
                          <th>ເພີ່ມ/ລຶບ</th>
                        </tr>
                      </thead>
                      <tbody id="tbDetail">
                        <tr class="text-center">
                          <td>
                            <input class="form-control searchrpno" type="text" name="rpnoid[]" id="1" placeholder="ປ້ອນ​ລະ​ຫັດ​ບໍ​ລິ​ການ">
                          </td>
                          <td>
                            <input class="form-control" type="text" name="sparename" id="sparename1" readonly>
                          </td>
                          <td>
                            <input class="form-control" type="number" name="useqty[]" id="useqty1" placeholder="#">
                          </td>
                          <td>
                            <input class="form-control searchwage" type="text" name="wageid[]" id="1" placeholder="ລະ​ຫັດ​ຄ່າ​ແຮງ​ງານ">
                          </td>
                          <td>
                            <input class="form-control" type="text" name="wagename" id="wagename1" placeholder="ຊື່​ແຮງ​ງານ" readonly>
                          </td>
                          {{-- <td>
                            <input class="form-control" type="text" name="qty" id="qty" placeholder="ຈຳ​ນວນ">
                          </td> --}}
                          <td>
                            <input class="form-control" type="text" name="unitrpname" id="unitrpname1" readonly>
                          </td>
                          <td>
                            <button class="btn btn-primary" type="button" id="btnAddrow"><i class="mdi mdi-plus-thick"></i></button>
                          </td>
                        </tr>
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

  </div>

@include('manage.layout.foot')
<script src="{{ url('includes/technical/repairbillnew.js') }}"></script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif