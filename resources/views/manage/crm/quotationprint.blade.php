@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
  {{-- <div class="wrapper"> --}}

    {{-- @include('manage.layout.nav') --}}

    {{-- @include('manage.layout.sidemenu') --}}

    {{-- <div class="container-fluid mt-30"> --}}

        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-md-6">
                <img src="{{ url('images/header.png') }}" class="img-fluid">
              </div>
            </div>
            <br>
        @if(count($quotations) > 0)
          @foreach($quotations as $quota)
            <div class="row">
              <div class="col-md-8">
                <p>ລູ​ກ​ຄ້າ: <b>{{ $quota->name }} ({{ $quota->workaddress }})</b></p>
              </div>
              <div class="col-md-4">
                <p>ວັນ​ທີ່​ອອກ​ເອ​ກະ​ສານ: <b>{{ $quota->document_date }}</b></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <p>ທີ່​ຢູ່ບ້ານ: <b>{{ $quota->village }}</b></p>
              </div>
              <div class="col-md-4">
                <p>ເບີ​ໂທ: <b>{{ $quota->mobile }}</b></p>
              </div>
              <div class="col-md-4">
                <p>​ເລກ​ທີ​ເອ​ກະ​ສານ: <b>{{ $quota->qtid }}</b></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <p>ເມືອງ: <b>{{ $quota->disname }}</b></p>
              </div>
              <div class="col-md-4">
                <p>ເບີ​ໂທ​ສຸກ​ເສີນ: <b>{{ $quota->phone }}</b></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <p>ແຂ​ວງ: <b>{{ $quota->proname }}</b></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7">
                <h5>Quotation / Repair Notification:ໃບ​ສະ​ເໜີ​ລາ​ຄາ/ໃບ​ແຈ້​ງ​ສ້ອມ</h5>
              </div>
              <div class="col-md-3">
                <p>Day <b></b></p>
              </div>
              <div class="col-md-2">
                <p>Time <b></b></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7">
                <p>If you have any questions about this document, please contact 021 316 482.</p>
              </div>
              <div class="col-md-3">
                <p>Check In: <b>{{ $quota->checkin_date }}</b></p>
              </div>
              <div class="col-md-2">
                <p>Time: <b>{{ $quota->checkin_time }}</b></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7">
                <p>ຫາກ​ມີ​ຂໍ້​ສົງ​ໃສ​ໃດ​ທີ່​ກ່ຽວ​ຂ້ອງ​ໃນ​ເອ​ກະ​ສານ​ນີ້​ຕິດ​ຕໍ່​ໄດ້​ທີ່ເບີ 021 316 482</p>
              </div>
              <div class="col-md-3">
                <p>Check Out: <b>{{ $quota->checkout_date }}</b></p>
              </div>
              <div class="col-md-2">
                <p>Time: <b>{{ $quota->checkout_time }}</b></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <p>Contact:</p>
              </div>
            </div>
            <div class="row ml-4">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-8">
                    <p>ເລກ​ຈັກ: <b>{{ $quota->motornum }}</b></p>
                  </div>
                  <div class="col-md-4">
                    <p>ວັນ​ຄົບ​ກຳ​ນົດ: <b>{{ $quota->expire_date }}</b></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row ml-4">
              <div class="col-md-8">
                <p>ເລກ​ຖັງ: <b>{{ $quota->bodynum }}</b></p>
              </div>
              <div class="col-md-4">
                <p>ເຄ​ຣ​ດິດ: <b>{{ $quota->credit_day }}</b></p>
              </div>
            </div>
            <div class="row ml-4">
              <div class="col-md-4">
                <p>ຍີ່​ຫໍ້: <b>{{ $quota->brandname }}</b></p>
              </div>
              <div class="col-md-4">
                <p>ລຸ້ນ: <b>{{ $quota->model }}</b></p>
              </div>
              <div class="col-md-4">
                <p>ພາກ​ສ່ວນ: <b>{{ $quota->part }}</b></p>
              </div>
            </div>
            <div class="row ml-4">
              <div class="col-md-3">
                <p>ທະ​ບຽນ​: <b>{{ $quota->license }}</b></p>
              </div>
              <div class="col-md-3">
                <p>ກິ​ໂລ​ແມັດ: <b>{{ $quota->instance }}</b></p>
              </div>
              <div class="col-md-3">
                <p>ສີ: <b>{{ $quota->color }}</b></p>
              </div>
              <div class="col-md-3">
                <p>ເລກ​ທີ​ໃບ​ຮັບ​ລົດ: <b>{{ $quota->receive_bill }}</b></p>
              </div>
            </div>
          @endforeach
        @endif
            <div class="row">
              <div class="col-md-12">
                <table class="table">
                  <thead class="text-center">
                    <tr>
                      <th style="border: 1px solid #000">ລຳ​ດັບ</th>
                      <th style="border: 1px solid #000">ລະ​ຫັດ​ບໍ​ລິ​ການ</th>
                      <th style="border: 1px solid #000">ລະ​ຫັດ​ບາ​ຣ໌​ໂຄດ​ອະ​ໄຫຼ່</th>
                      <th style="border: 1px solid #000">​ລາຍ​ການ​ອະ​ໄຫຼ່</th>
                      <th style="border: 1px solid #000">​ຫົວ​ໜ່ວຍ</th>
                      <th style="border: 1px solid #000">​ຈຳ​ນວນ</th>
                      <th style="border: 1px solid #000">ລາ​ຄາ/ໜ່ວຍ</th>
                      <th style="border: 1px solid #000">ຈຳ​ນວນ​ເງິນ (ກີບ)</th>
                    </tr>
                  </thead>
                  <tbody>
                @if(count($quodetail) > 0)
                  @foreach($quodetail as $quodt)
                    <tr>
                      <td class="text-center" style="border: 1px solid #000">{{ $no++ }}</td>
                      <td style="border: 1px solid #000">{{ $quodt->rpnoid }}</td>
                      <td style="border: 1px solid #000">{{ $quodt->sparesid }}</td>
                      <td style="border: 1px solid #000">{{ $quodt->sparesname }}</td>
                      <td class="text-center" style="border: 1px solid #000">{{ $quodt->unitname }}</td>
                      <td class="text-center" style="border: 1px solid #000">{{ $quodt->qty }}</td>
                      <td class="text-right" style="border: 1px solid #000">{{ number_format($quodt->price) }}</td>
                      <td class="text-right" style="border: 1px solid #000">{{ number_format($quodt->total) }}</td>
                    </tr>
                  @endforeach
                @endif
                
                    <tr>
                      <th colspan="8" class="text-center" style="border: 1px solid #000">ຄ່າ​ແຮງ​ງານ</th>
                    </tr>
                    <tr class="text-center">
                      <th style="border: 1px solid #000">ລຳ​ດັບ</th>
                      <th style="border: 1px solid #000">ລະ​ຫັດ​ຄ່າ​ແຮງ​ງານ</th>
                      <th style="border: 1px solid #000">​ປະ​ເພດ​ລົດ</th>
                      <th style="border: 1px solid #000">​ລາຍ​ການ​ແຮງ​ງານ</th>
                      <th style="border: 1px solid #000">​ຫົວ​ໜ່ວຍ</th>
                      <th style="border: 1px solid #000">ຮັບ​ປະ​ກັນ</th>
                      <th style="border: 1px solid #000"></th>
                      <th style="border: 1px solid #000">ຈຳ​ນວນ​ເງິນ (ກີບ)</th>
                    </tr>
                    @if(count($wagelist) > 0)
                      @foreach($wagelist as $ws)
                      <tr>
                        <td class="text-center" style="border: 1px solid #000">{{ $w }}</td>
                        <td style="border: 1px solid #000">{{ $ws->wageid }}</td>
                        <td style="border: 1px solid #000">{{ $ws->tcarname }}</td>
                        <td style="border: 1px solid #000">{{ $ws->wagename }}</td>
                        <td class="text-center" style="border: 1px solid #000">{{ $ws->unitrpname }}</td>
                        <td class="text-center" style="border: 1px solid #000">{{ $ws->guaranty }}</td>
                        <td class="text-center" style="border: 1px solid #000"></td>
                        <td class="text-right" style="border: 1px solid #000">{{ number_format($ws->cost) }}</td>
                      </tr>
                      @endforeach
                    @endif
                  </tbody>
                  
                  <tfoot>
                    {{-- <tr>
                      <th class="text-center" colspan="7" style="border: 1px solid #000">ລວມ​ຄ່າແຮງ​ງານ​​ສ້ອມ​ແປງ​</th>
                      <th class="text-right" style="border: 1px solid #000">{{ number_format($sumwages) }}</th>
                    </tr> --}}
                    <tr>
                      <th colspan="6" rowspan="4" class="ml-4"><b>ໝາຍ​ເຫດ:</b></th>
                      <th class="text-right" style="border: 1px solid #000">ລວມ​ຄ່າແຮງ​ງານ​​ສ້ອມ​ແປງ​:</th>
                      <th style="border: 1px solid #000" class="text-right">{{ number_format($sumwages) }}</th>
                    </tr>
                    <tr>
                      <th class="text-right" style="border: 1px solid #000">ລວມ​ຈຳ​ນວນ​ເງິນ:</th>
                      <th style="border: 1px solid #000" class="text-right">{{ number_format($sumtotal+$sumwages) }}</th>
                    </tr>
                    <tr>
                      <th class="text-right" style="border: 1px solid #000">ສ່ວນຫຼຸດ:</th>
                      <th style="border: 1px solid #000" class="text-right"></th>
                    </tr>
                    <tr>
                      <th class="text-right" style="border: 1px solid #000">ລວມ​ຈຳ​ນວນ​ເງິນ​ທັງ​ໝົດ:</th>
                      <th style="border: 1px solid #000" class="text-right">{{ number_format($sumtotal+$sumwages) }}</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12" style="border: 2px solid black">
            <div class="row">
              <div class="col-md-6">
                <p>Please remove all valuebles from your car.</p>
                <p>The service center will <b>not</b> be responsible for any damage caused by it.</p>
                <p>ກະ​ລ​ຸ​ນາ​ນຳ​ສິ່ງ​ຂອງ​ທີ່​ມີ​ຄ່າ​ອອກ​ຈາກ​ລະ​ບົບ​ຂອງ​ທ່ານ</p>
                <p>ທາງ​ສູນ​ບໍ​ລິ​ການ​ຈະ​ບໍ່​ຮັບ​ຜິດ​ຊອບ​ຄວາມ​ເສຍ​ຫາຍ​ໃດໆ</p>
              </div>
              <div class="col-md-6">
                <p>I, or its representative, agree that the company Carry out repairs of my car</p>
                <p>and I other necesscary tasks Due to the preliminary agreed reparing conditions.</p>
                <p>ຂ້າ​ພະ​ເຈົ້າ​ເປັນ​ຕົວ​ແທນ​ຍິນຍອມ​ໃຫ້​ບໍ​ລິ​ການ ດຳ​ເນີນ​ການ</p>
                <p>ຊ້ອມ​ແປງ​ລົດ​ຊອງ​ຂ້າ​ພະ​ເຈົ້າ ແລະ ງາ​ນ​ຈຳ​ເປັນ​ອື່ນໆ ອັນ​ເນື່ອງ​ມາ​ຈາກ​ເງື່ອນ​ໄຂ​ການ​ສ້ອມ​ທີ່​ໄດ້​ຕົກ​ລົງ​ກັນ​ໄວ້​ແລ້ວ​ເບື​້ອງ​ຕົ້ນ.</p>
              </div>
            </div>
            <br>
            <div class="row ml-4">
              <div class="col-md-4">
                <h5>.......................</h5>
                <h5>(ລູກ​ຄ້າ/ຜູ້​ອະ​ນຸ​ມັດ)</h5>
              </div>
              <div class="col-md-4">
                <h5>...................</h5>
                <h5>(ຜູ້​ຈັດ​ການ​ສູນ)</h5>
              </div>
              <div class="col-md-4">
                <h5>...................</h5>
                <h5>(ຜູ້​ສະ​ເໜີ​ລາ​ຄາ)</h5>
              </div>
            </div>
          </div>
        </div>
        <br><br>
        <div class="row">
          <div class="col-md-12">
            <div class="text-center">
              <a class="btn btn-primary" href="{{ url($url) }}" id="btnBack"><i class="mdi mdi-arrow-left-bold-circle"></i> ກັບ​ຄືນ</a>
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