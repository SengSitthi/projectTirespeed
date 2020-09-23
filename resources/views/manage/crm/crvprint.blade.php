@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
  {{-- <div class="wrapper"> --}}

  {{-- @include('manage.layout.nav') --}}
  {{-- @include('manage.layout.sidemenu') --}}

    {{-- <div class="container-fluid mt-30"> --}}
    {{-- <div class="container"> --}}
      <div class="row">
        <div class="col-lg-12">
          <table>
            <tbody>
              @if(count($showdata) > 0)
                @foreach($showdata as $dt)
                <tr>
                  <td colspan="6" width="50%" style="border: 2px solid black">
                    <img src="{{ url('images/header.png') }}" alt="" srcset="" class="img-fluid">
                  </td>
                  {{-- <td></td> --}}
                  <td style="border: 2px solid black" width="35%" colspan="4">
                    <div class="row">
                      <div class="col-md-7">
                        <h5><b><u>ໃບ​ຮັບ​ລົດ​ເຂົ້າ​ບໍ​ລິ​ການ</u></b></h5>
                        <h6><b>Receive Car Service</b></h6>
                        <p>ເລກ​ທີ: {{ $dt->rcsid }}/RCS</p>
                      </div>
                      <div class="col-md-5">
                        <img src="{{ url('images/car_structure.jpg') }}" alt="structure" width="100%">
                      </div>
                    </div>
                    {{-- <table>
                      <tr>
                        <td width="60%" style="border: 0px">
                          
                        </td>
                        <td style="border: 0px">
                          
                        </td>
                      </tr>
                    </table> --}}
                  </td>
                  <td width="15%" colspan="2" style="border: 2px solid black">
                    <h6>TS-SAFM-01<br>ນຳ​ໃຊ້ 21-09-2020<br>ປັບ​ປຸງ​ຄັ້ງ​ທີ: 01</h6>
                  </td>
                </tr>
                <tr>
                  <td colspan="6" style="border: 2px solid black">
                    <h6>ລູກ​ຄ້າ/Customer: <input type="checkbox"@if($dt->status == "ເຄີຍ") checked @endif> <b>ໃໝ່(New)</b>&emsp; <input type="checkbox"@if($dt->status == "ບໍ່ເຄີຍ") checked @endif> <b>ເກົ່າ(Old)</b></h6>
                    <h6>ລູກ​ຄ້າ/Name: <b>{{ $dt->name }} {{ $dt->lastname }}</b></h6>
                    <h6>ທີ່​ຢູ່/Address: <b>{{ $dt->village}}, {{ $dt->disname }}, {{ $dt->proname }}</b></h6>
                  </td>
                  <td colspan="6" style="border: 2px solid black">
                    <h6>ວ​ັນ​ທີ​ຮັບ​ລົດ: <b>{{ $dt->date_receive }}</b> &emsp;&emsp; ເວ​ລາ: <b>{{ $dt->time_receive }}</b></h6>
                    <h6>ເບີ​ມື​ຖື/Mobile: <b>{{ $dt->mobile }}</b></h6>
                    <h6>ເບີ​ຕິດ​ຕໍ່​ສຸ​ກ​ເສີນ/Phone: <b>{{ $dt->phone }}</b></h6>
                  </td>
                </tr>
                <tr>
                  <td width="25%" colspan="3" style="border: 2px solid black">
                    <h6>ຈາກ​ພາກ​ສ່ວນ/From Department:</h6>
                  </td>
                  <td colspan="9" style="border: 2px solid black"><h6>&emsp;
                    
                    <input type="checkbox"@if($dt->tcusid == "5") checked @endif> <b>ຫ້ອງ​ການ​ລັດ</b> &emsp;&emsp;&emsp;
                    <input type="checkbox"@if($dt->tcusid == "2") checked @endif> <b>ເອ​ກະ​ຊົນ</b> &emsp;&emsp;&emsp;
                    <input type="checkbox"@if($dt->tcusid == "2") checked @endif> <b>ບໍ​ລິ​ສັດ</b> &emsp;&emsp;&emsp;
                    <input type="checkbox"@if($dt->tcusid == "3") checked @endif> <b>​ລັດ​ວິ​ສາ​ຫະ​ກິດ</b> &emsp;&emsp;&emsp;
                    <input type="checkbox"@if($dt->tcusid == "7") checked @endif> <b>​ພະ​ນັກ​ງານ​ໃນ​ເຄືອ</b> &emsp;&emsp;&emsp;
                    <input type="checkbox"@if($dt->tcusid == "1") checked @endif> <b>ອື່ນໆ</b>
                    </h6>
                  </td>
                </tr>
                <tr>
                  <td width="25%" style="border: 2px solid black" colspan="3">
                    <h6>ສັງ​ກັດ / Office Name:</h6>
                  </td>
                  <td colspan="9" style="border: 2px solid black">
                    <h6><b>{{ $dt->workaddress }}</b></h6>
                  </td>
                </tr>
                <tr>
                  <td colspan="6" style="border: 2px solid black">
                    <h6>
                      ເລກ​ທະ​ບຽນ/Plate: <b>{{ $dt->license }}</b> <br>
                      ຍີ່​ຫໍ້​ລົດ/Brand: <b>{{ $dt->brandname }}</b> <br>
                      ລຸ້ນ​ລົດ/Model: <b>{{ $dt->model }}</b> &emsp;&emsp; ສີ/Color: <b>{{ $dt->color }}</b><br>
                      ປີ​ຜະ​ລິດ/Year: <b>{{ $dt->madeyear }}</b> &emsp;&emsp; ປະ​ເພດ​ລົດ/Type: <b>{{ $dt->type_car }}</b> <br>
                      ເກຍ/Gear: <input type="checkbox"@if($dt->gear == "AT ອໍ​ໂຕ") checked @endif> <b>AT ອໍ​ໂຕ</b> &emsp;&emsp; <input type="checkbox"@if($dt->gear == "MT ທຳ​ມະ​ດາ") checked @endif> <b>MT ທຳ​ມະ​ດາ</b>
                    </h6>
                  </td>
                  <td colspan="6" style="border: 2px solid black">
                    <h6>
                      ເລກ​ກົງ​ເຕີ/ODO Meter: <b>{{ $dt->meter }}</b> <br>
                      ເລກ​ຈັກ/Engine No: <b>{{ $dt->motornum }}</b> <br>
                      ເລກ​ຖັງ/Frame No: <b>{{ $dt->bodynum }}</b> <br>
                      ເຄື່ອ​ງ​ຈັກ/Engine: <input type="checkbox"@if($dt->motor == "ແອັດ​ຊັງ") checked @endif> <b>Gassoline ແອັດ​ຊັງ</b> &emsp;&emsp; <input type="checkbox"@if($dt->motor == "ກາ​ຊວນ") checked @endif> <b>Diesel ກາ​ຊວນ</b>
                      ລະ​ດັບ​ນ້ຳ​ມັນ​ເຊື້ອ​ໄຟ/Petro Tank Level: <input type="checkbox"@if($dt->leveloil == "E") checked @endif> <b>E</b> &emsp;&emsp; <input type="checkbox"@if($dt->leveloil == "1/2") checked @endif> <b>1/2</b> &emsp;&emsp; <input type="checkbox"@if($dt->leveloil == "F") checked @endif> <b>F</b>
                    </h6>
                  </td>
                </tr>
                <tr>
                  <td colspan="12" style="border: 2px solid black">
                    <h6>I. ລາຍ​ການກວດ​ເຊັກ​ສະ​ພາບ​ລົບ​ລູກ​ຄ້າ​ກ່ອນ​ເຂົ້າ​ໃຊ້​ບໍ​ລິ​ການ / Customer's cehicle inspection before receiving for service</h6>
                  </td>
                </tr>
                <tr>
                  <td colspan="3" style="border: 2px solid black" width="25%">
                    <h6>A. ພາຍນອກ​ຕົວ​ລົດ​ລູກ​ຄ້າ:</h6>
                  </td>
                  <td colspan="3" style="border: 2px solid black" width="25%">
                    <h6>ຜົນ​ການກວດ​ສະ​ພາບ</h6>
                  </td>
                  <td colspan="6" style="border: 2px solid black">
                    <h6>ລາຍ​ງານ​ຄວາມ​ຜິດ​ປົກ​ກະ​ຕິ</h6>
                  </td>
                </tr>
                <tr>
                  <td style="border: 2px solid black" width="5%">
                    <h6 class="text-center">1</h6>
                  </td>
                  <td colspan="2" style="border: 2px solid black">
                    <h6>ດ້ານ​ໜ້າ / Front:</h6>
                  </td>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>&emsp;
                      <input type="checkbox"@if($dt->front == "1") checked @endif> <b>ປົກ​ກະ​ຕິ</b> &emsp;&emsp;
                      <input type="checkbox"@if($dt->front == "2") checked @endif> <b>ບໍ​່​ປົກ​ກະ​ຕິ</b>
                    </h6>
                  </td>
                  <td colspan="6" style="border: 2px solid black"><h6>{{ $dt->front_remark }}</h6></td>
                </tr>
                <tr>
                  <td style="border: 2px solid black" width="5%">
                    <h6 class="text-center">2</h6>
                  </td>
                  <td colspan="2" style="border: 2px solid black">
                    <h6>ດ້ານ​ຊ້າຍ / Left:</h6>
                  </td>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>&emsp;
                      <input type="checkbox"@if($dt->left == "1") checked @endif> <b>ປົກ​ກະ​ຕິ</b> &emsp;&emsp;
                      <input type="checkbox"@if($dt->left == "2") checked @endif> <b>ບໍ​່​ປົກ​ກະ​ຕິ</b>
                    </h6>
                  </td>
                  <td colspan="6" style="border: 2px solid black"><h6>{{ $dt->left_remark }}</h6></td>
                </tr>
                <tr>
                  <td style="border: 2px solid black" width="5%">
                    <h6 class="text-center">3</h6>
                  </td>
                  <td colspan="2" style="border: 2px solid black">
                    <h6>ດ້ານຂວາ​ / Right:</h6>
                  </td>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>&emsp;
                      <input type="checkbox"@if($dt->right == "1") checked @endif> <b>ປົກ​ກະ​ຕິ</b> &emsp;&emsp;
                      <input type="checkbox"@if($dt->right == "2") checked @endif> <b>ບໍ​່​ປົກ​ກະ​ຕິ</b>
                    </h6>
                  </td>
                  <td colspan="6" style="border: 2px solid black"><h6>{{ $dt->right_remark }}</h6></td>
                </tr>
                <tr>
                  <td style="border: 2px solid black" width="5%">
                    <h6 class="text-center">4</h6>
                  </td>
                  <td colspan="2" style="border: 2px solid black">
                    <h6>ດ້ານ​ຫຼັງ / Back:</h6>
                  </td>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>&emsp;
                      <input type="checkbox"@if($dt->back == "1") checked @endif> <b>ປົກ​ກະ​ຕິ</b> &emsp;&emsp;
                      <input type="checkbox"@if($dt->back == "2") checked @endif> <b>ບໍ​່​ປົກ​ກະ​ຕິ</b>
                    </h6>
                  </td>
                  <td colspan="6" style="border: 2px solid black"><h6>{{ $dt->back_remark }}</h6></td>
                </tr>
                <tr>
                  <td style="border: 2px solid black" width="5%">
                    <h6 class="text-center">5</h6>
                  </td>
                  <td colspan="2" style="border: 2px solid black">
                    <h6>ລໍ້​ຢາງ​ລົດ / Wheels:</h6>
                  </td>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>&emsp;
                      <input type="checkbox"@if($dt->wheels == "1") checked @endif> <b>ປົກ​ກະ​ຕິ</b> &emsp;&emsp;
                      <input type="checkbox"@if($dt->wheels == "2") checked @endif> <b>ບໍ​່​ປົກ​ກະ​ຕິ</b>
                    </h6>
                  </td>
                  <td colspan="6" style="border: 2px solid black"><h6>{{ $dt->wheels_remark }}</h6></td>
                </tr>
                <tr>
                  <td colspan="3" style="border: 2px solid black" width="25%">
                    <h6>B. ພາຍ​ໃນ​ຫ້ອງ​ໂດຍ​ສານ:</h6>
                  </td>
                  <td colspan="3" style="border: 2px solid black" width="25%">
                    <h6>ຜົນ​ການກວດ​ສະ​ພາບ</h6>
                  </td>
                  <td colspan="6" style="border: 2px solid black">
                    <h6>ລາຍ​ງານ​ຄວາມ​ຜິດ​ປົກ​ກະ​ຕິ</h6>
                  </td>
                </tr>
                <tr>
                  <td style="border: 2px solid black" width="5%">
                    <h6 class="text-center">1</h6>
                  </td>
                  <td colspan="2" style="border: 2px solid black">
                    <h6>ເບາະ​ນັ່ງ / Seats:</h6>
                  </td>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>&emsp;
                      <input type="checkbox"@if($dt->seats == "1") checked @endif> <b>ປົກ​ກະ​ຕິ</b> &emsp;&emsp;
                      <input type="checkbox"@if($dt->seats == "2") checked @endif> <b>ບໍ​່​ປົກ​ກະ​ຕິ</b>
                    </h6>
                  </td>
                  <td colspan="6" style="border: 2px solid black"><h6>{{ $dt->seats_remark }}</h6></td>
                </tr>
                <tr>
                  <td style="border: 2px solid black" width="5%">
                    <h6 class="text-center">2</h6>
                  </td>
                  <td colspan="2" style="border: 2px solid black">
                    <h6>ປະ​ຕູ / Doors:</h6>
                  </td>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>&emsp;
                      <input type="checkbox"@if($dt->doors == "1") checked @endif> <b>ປົກ​ກະ​ຕິ</b> &emsp;&emsp;
                      <input type="checkbox"@if($dt->doors == "2") checked @endif> <b>ບໍ​່​ປົກ​ກະ​ຕິ</b>
                    </h6>
                  </td>
                  <td colspan="6" style="border: 2px solid black">{{ $dt->doors_remark }}</td>
                </tr>
                <tr>
                  <td style="border: 2px solid black" width="5%">
                    <h6 class="text-center">3</h6>
                  </td>
                  <td colspan="2" style="border: 2px solid black">
                    <h6>ສະ​ວິກ​ແວ່ນ / Mirror Switch:</h6>
                  </td>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>&emsp;
                      <input type="checkbox"@if($dt->mirror == "1") checked @endif> <b>ປົກ​ກະ​ຕິ</b> &emsp;&emsp;
                      <input type="checkbox"@if($dt->mirror == "2") checked @endif> <b>ບໍ​່​ປົກ​ກະ​ຕິ</b>
                    </h6>
                  </td>
                  <td colspan="6" style="border: 2px solid black"><h6>{{ $dt->mirror_remark }}</h6></td>
                </tr>
                <tr>
                  <td style="border: 2px solid black" width="5%">
                    <h6 class="text-center">4</h6>
                  </td>
                  <td colspan="2" style="border: 2px solid black">
                    <h6>​ເຄື່ອງ​ສຽງ​ໃນ​ລົດ / CD-Checkbox:</h6>
                  </td>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>&emsp;
                      <input type="checkbox"@if($dt->sound == "1") checked @endif> <b>ປົກ​ກະ​ຕິ</b> &emsp;&emsp;
                      <input type="checkbox"@if($dt->sound == "2") checked @endif> <b>ບໍ​່​ປົກ​ກະ​ຕິ</b>
                    </h6>
                  </td>
                  <td colspan="6" style="border: 2px solid black"><h6>{{ $dt->sound_remark }}</h6></td>
                </tr>
                <tr>
                  <td style="border: 2px solid black" width="5%">
                    <h6 class="text-center">5</h6>
                  </td>
                  <td colspan="2" style="border: 2px solid black">
                    <h6>ໜ້າ​ປັດ​ກອງ​ເຕີ / Meter:</h6>
                  </td>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>&emsp;
                      <input type="checkbox"@if($dt->meter_display == "1") checked @endif> <b>ປົກ​ກະ​ຕິ</b> &emsp;&emsp;
                      <input type="checkbox"@if($dt->meter_display == "2") checked @endif> <b>ບໍ​່​ປົກ​ກະ​ຕິ</b>
                    </h6>
                  </td>
                  <td colspan="6" style="border: 2px solid black">{{ $dt->meterdis_remark }}</td>
                </tr>
                <tr>
                  <td style="border: 2px solid black" width="5%">
                    <h6 class="text-center">6</h6>
                  </td>
                  <td colspan="2" style="border: 2px solid black">
                    <h6>ອຸ​ປະ​ກອນ​ເສີມ / Accessories:</h6>
                  </td>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>&emsp;
                      <input type="checkbox"@if($dt->accessories == "1") checked @endif> <b>ປົກ​ກະ​ຕິ</b> &emsp;&emsp;
                      <input type="checkbox"@if($dt->accessories == "2") checked @endif> <b>ບໍ​່​ປົກ​ກະ​ຕິ</b>
                    </h6>
                  </td>
                  <td colspan="6" style="border: 2px solid black"><h6>{{ $dt->accessories_remark }}</h6></td>
                </tr>
                <tr>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>ຂອງ​ມີ​ຄ່າ​ໃນ​ລົດ/Valuables:</h6>
                  </td>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>&emsp;
                      <input type="checkbox"@if($dt->valuables == "1") checked @endif> <b>ມີ</b> &emsp;&emsp;
                      <input type="checkbox"@if($dt->valuables == "2") checked @endif> <b>ບໍ​່​​ມີ</b>
                    </h6>
                  </td>
                  <td colspan="6" style="border: 2px solid black"><h6>{{ $dt->valuables_remark }}</h6></td>
                </tr>
                <tr>
                  <td colspan="12" style="border: 2px solid black">
                    <h6>II. ລາຍ​ການ​ສະ​ເໜີ​ຂອງ​ລູກ​ຄ້າ​ເຂົ້າ​ໃຊ້​ບໍ​ລິ​ການ / Customer's requirement for service</h6>
                  </td>
                </tr>
                <tr>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>A. ກວດ​ເຊັກ​ລົດ 33 ລາຍ​ການ:</h6>
                  </td>
                  <td colspan="9" style="border: 2px solid black" class="text-center">
                    <h6>&emsp;
                      <input type="checkbox"@if($dt->check33 == "ກວດ​ເຊັກ") checked @endif> <b>ກວດ​ເຊັກ</b> &emsp;&emsp;
                      <input type="checkbox"@if($dt->check33 == "ບໍ່ກວດ​ເຊັກ") checked @endif> <b>ບໍ່​ກວດ​ເຊັກ</b>
                    </h6>
                  </td>
                </tr>
                <tr>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>B. ສ້ອມ​ບຳ​ລ​ຸງ / Maintenance (PM):</h6>
                  </td>
                  <td colspan="9" style="border: 2px solid black"><h6>&emsp;
                    <input type="checkbox"@if($dt->maintenance == "ປ່ຽນ​ນ້ຳ​ມັນ​ເຄື່ອງ+ກອງ​ຕ່າງໆ") checked @endif> <b>ປ່ຽນ​ນ້ຳ​ມັນ​ເຄື່ອງ+ກອງ​ຕ່າງໆ</b> &emsp;&emsp; <input type="checkbox"@if($dt->maintenance == "ປ່ຽນ​ນ້ຳ​ມັນ​ເກຍ") checked @endif> <b>ປ່ຽນ​ນ້ຳ​ມັນ​ເກຍ</b> &emsp;&emsp;
                    <input type="checkbox"@if($dt->maintenance == "ນ້ຳ​ມັນ​ເຟືອງ​ທ້າຍ") checked @endif> <b>ນ້ຳ​ມັນ​ເຟືອງ​ທ້າຍ</b> &emsp;&emsp; <input type="checkbox"@if($dt->maintenance == "ອັດ​ກະ​ແລັດ​ທົ່ວ​ໄປ") checked @endif> <b>ອັດ​ກະ​ແລັດ​ທົ່ວ​ໄປ</b> &emsp;&emsp; 
                    <input type="checkbox"@if($dt->maintenance == "ອື່ນໆ") checked @endif> <b>ອື່ນໆ</b></h6>
                  </td>
                </tr>
                <tr>
                  <td colspan="3" style="border: 2px solid black">
                    <h6 class="text-center">ລາຍ​ການ​ສ້ອມ​ບຳ​ລຸງ​ເພີ່ມ</h6>
                  </td>
                  <td colspan="9" style="border: 2px solid black">
                    <h6>&emsp;
                      <input type="checkbox"@if($dt->maintenance_list == "ເຕີມ​ນ້ຳ​ມັນ​ເຄື່ອງ-ເກຍ-ເຟືອງ​ທ້າຍ") checked @endif> <b>ເຕີມ​ນ້ຳ​ມັນ​ເຄື່ອງ-ເກຍ-ເຟືອງ​ທ້າຍ</b> &emsp;&emsp; <input type="checkbox"@if($dt->maintenance_list == "​ເຕີມ​ນ້ຳ​ກົດ-ນ້ຳ​ກັ່ນ") checked @endif> <b>ເຕີມ​ນ້ຳ​ກົດ-ນ້ຳ​ກັ່ນ</b> &emsp;&emsp;
                      <input type="checkbox"@if($dt->maintenance_list == "ເຕີມ​ນ້ຳ​ມັນ​ເບກ-ຄາດ") checked @endif> <b>ເຕີມ​ນ້ຳ​ມັນ​ເບກ-ຄາດ</b> &emsp;&emsp; <input type="checkbox"@if($dt->maintenance_list == "ກວດ​ເຊັກ​ລົມ​ຢາງ") checked @endif> <b>ກວດ​ເຊັກ​ລົມ​ຢາງ</b> &emsp;&emsp;
                      <input type="checkbox"@if($dt->maintenance_list == "ເຕີມ​ນ້ຳ​ຢາ​ໜໍ້​ນ້ຳ") checked @endif> <b>ເຕີ​ມ​ນ້ຳ​ຢາ​ໝໍ້​ນ້ຳ</b>
                    </h6>
                  </td>
                </tr>
                <tr>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>C. ສ້ອມ​ແປງ​ລົດ / Repairs (RM):</h6>
                  </td>
                  <td colspan="9" style="border: 2px solid black">
                    <h6 class="text-center"><input type="checkbox"@if($dt->repairs == "ສ້ອມ​ແປງ​ດ່ວນ") checked @endif> <b>ສ້ອມ​ແປງ​ດ່ວນ</b> &emsp;&emsp; <input type="checkbox"@if($dt->repairs == "ບໍ່​ດ່ວນ") checked @endif> <b>ບໍ່​ດ່ວນ</b></h6>
                  </td>
                </tr>
                @foreach ($showdetail as $sdt)
                  <tr>
                    <td colspan="12" style="border: 2px solid black"><h6>{{ $i++ }}. {{ $sdt->rcs_list }}</h6></td>
                  </tr>
                @endforeach
                <tr>
                  <td colspan="3" style="border: 2px solid black"><h6>B. ບໍ​ລິ​ການ​ຢາງ​ລົດ / Tires service:</h6></td>
                  <td colspan="9" style="border: 2px solid black"><h6>&emsp;
                    <input type="checkbox"@if($dt->tire_service =="ກວດ​ເຊັກ​ຢາງ") checked @endif> <b>ກວດ​ເຊັກ​ຢາງ</b> &emsp;&emsp; <input type="checkbox"@if($dt->tire_service =="ປ່ຽນ​ຢາງ​ລົດ​ໃໝ່") checked @endif> <b>ປ່ຽນ​ຢາງ​ລົດ​ໃໝ່</b> &emsp;&emsp; <input type="checkbox"@if($dt->tire_service =="ຕັ້ງ​ສູນ​ລົດ") checked @endif> <b>ຕັ້ງ​ສູນ​ລົດ</b> &emsp;&emsp;
                    <input type="checkbox"@if($dt->tire_service =="ຖ່ວງ​ລໍ້") checked @endif> <b>ຖ່ວງ​ລໍ​້</b> &emsp;&emsp; <input type="checkbox"@if($dt->tire_service =="ຈອດ​ຢາງ") checked @endif> <b>ຈອດ​ຢາງ</b> &emsp;&emsp; <input type="checkbox"@if($dt->tire_service =="ສະ​ລັບ​ຢາງ") checked @endif> <b>ສະ​ລັບ​ຢາງ</b></h6>
                  </td>
                </tr>
                <tr>
                  <td colspan="3" style="border: 2px solid black">
                    <h6 class="text-center">ລາຍ​ລະ​ອຽດ</h6>
                  </td>
                  <td colspan="9" style="border: 2px solid black"><h6>{{ $dt->tire_detail }}</h6></td>
                </tr>
                <tr>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>ເຊັນ​ຫົວ​ໜ້າ​ຊ່າງ / ເວ​ລາ:______</h6>
                  </td>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>ເຊັນ​ຊ່າງ​ຮັບ​ລົດ / ເວ​ລາ:_______</h6>
                  </td>
                  <td colspan="3" style="border: 2px solid black">
                    <h6 class="text-center">ເຊັນ​ພະ​ນັກ​ງານ​ຮັບ​ລົດ</h6>
                  </td>
                  <td colspan="3" style="border: 2px solid black">
                    <h6 class="text-center">ເຊັນ​ລູກ​ຄ້າ​ສົ່ງ​ມອບ​ລົດ</h6>
                  </td>
                </tr>
                <tr>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>&nbsp;</h6>
                    <h6>&nbsp;</h6>
                    <h6 class="text-center"> ວັນ​ທີ: ____/____/______</h6>
                  </td>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>&nbsp;</h6>
                    <h6>&nbsp;</h6>
                    <h6 class="text-center"> ວັນ​ທີ: ____/____/______</h6>
                  </td>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>&nbsp;</h6>
                    <h6>&nbsp;</h6>
                    <h6 class="text-center"> ວັນ​ທີ: ____/____/______</h6>
                  </td>
                  <td colspan="3" style="border: 2px solid black">
                    <h6>&nbsp;</h6>
                    <h6>&nbsp;</h6>
                    <h6 class="text-center"> ວັນ​ທີ: ____/____/______</h6>
                  </td>
                </tr>
                <tr>
                  <td colspan="12" style="border: 2px solid black">
                    <h6><b>ໝາຍ​ເຫດ:</b> ລູກ​ຄ້າ ແລະ ພະ​ນັກ​ງານ​ຮັບ​ລົດ​ສູນ​ທາຍ​ສະ​ປ​ີດ ໄດ້​ກວດ​ເຊັກ​ສະ​ພາບ​ລົດ​ກ່ອນ​ຮັບ​ລົດ​ເຂົ້າ​ໃຊ້​ບໍ​ລິ​ການ ຕາມ​ລາຍ​ການກວດ​ເຊັກ​ທີ່​ໄດ້​ລະ​ບຸ​ໄວ້​ຂ້າງ​ເທິງ​ນີ້ ໂດຍ​ຊ່ອງ​ໜ້າ​ກັນ​ຈຶ່ງ​ລົງ​ລາຍ​ເຊັນ​ໃນ​ໃບ​ຮັບ​ລົດ​ສະ​ບັບ​ນີ້​ຮ່ວມ​ກັນ. 
                    ເພື່ອ​ເປັນຫຼ​ັກ​ຖານ​ໃນ​ການ​ມອບ​ຮັບ-ສົ່ງ​ມອບ​ລົດ​ຂອງ​ລູກ​ຄ້າ​ທີ່​ເຂົ້າ​ໃຊ້​ບໍ​ລິ​ການ​ສູນ​ທາຍ​ສະ​ປີດ.</h6>
                  </td>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                <a class="btn btn-info" href="{{ url(''.$url.'') }}" id="btnBack"><i class="mdi mdi-arrow-left-bold-circle"></i> ກັບ​ຄືນ</a>
            </div>
        </div>
    </div>
    {{-- </div> --}}
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