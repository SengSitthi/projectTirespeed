@role('CRM')
  {{-- <ul class="menu accordion">
    <li class="menu-item">
      <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#menu-appointment"
        aria-expanded="true" aria-controls="menu-appointment">
        <!-- <i class="menu-icon fas fa-border-all"></i> -->
          <i class="menu-icon mdi mdi-bookmark"></i>
          <span class="menu-label">ນັດ​ໝາຍ</span>
          <i class="menu-arrow mdi mdi-chevron-right"></i>
      </a> --}}

    <ul class="menu accordion" data-parent="#main-menu" id="menu-appointment">
      <li class="menu-item">
        <a href="{{ url('appointment') }}" class="menu-link w3-large">
          <i class="menu-icon mdi mdi-desktop-mac-dashboard"></i>
          <span class="menu-label">ພາບ​ລວມ​ການນັດ​ໝາຍ</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ url('quotationnew') }}" class="menu-link w3-large">
          <i class="menu-icon mdi mdi-file-document-box-plus"></i>
          <span class="menu-label">ໃບ​ສະ​ເໜີ</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ url('quotationlist') }}" class="menu-link w3-large">
          <i class="menu-icon mdi mdi-file-document-box-multiple"></i>
          <span class="menu-label">ລາຍ​ການໃບ​ສະ​ເໜີ</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ url('newcustomer') }}" class="menu-link w3-large">
          <i class="menu-icon mdi mdi-account-multiple-plus"></i>
          <span class="menu-label">ລູກ​ຄ້າ​ໃໝ່</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ url('newcaroldcus') }}" class="menu-link w3-large">
          <i class="menu-icon mdi mdi-account-multiple-plus"></i>
          <span class="menu-label">ເພີ່ມ​ລົດ​ໃໝ່ລູກ​ຄ້າເກົ່າ​</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ url('customerlist') }}" class="menu-link w3-large">
          <i class="menu-icon mdi mdi-account-group"></i>
          <span class="menu-label">ລາຍ​ການ​ລູກ​ຄ້າ​</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ url('newapppointment') }}" class="menu-link w3-large">
          <i class="menu-icon mdi mdi-update"></i>
          <span class="menu-label">ນ​ັດ​ໝາຍ​ລູກ​ຄ້າ​ໃໝ່</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ url('oldappointment') }}" class="menu-link w3-large">
          <i class="menu-icon mdi mdi-update"></i>
          <span class="menu-label">ນັດ​ໝາຍ​ລູກ​ຄ້າ​ເກົ່າ</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ url('appointmenttoday') }}" class="menu-link w3-large">
          <i class="menu-icon mdi mdi-table"></i>
          <span class="menu-label">ລູກ​ຄ້າ​ນັດ​ໝາຍ​ມື້​ນີ້</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ url('appointmentmonth') }}" class="menu-link w3-large">
          <i class="menu-icon mdi mdi-table-large"></i>
          <span class="menu-label">ລູກ​ຄ້າ​ນັດ​ໝາຍ​ເດືອນ​ນີ້</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#apm-report" aria-expanded="true" aria-controls="apm-report">
          <i class="menu-icon mdi mdi-card-text"></i>
          <span class="menu-label">ລາຍ​ງານ</span>
          <i class="menu-arrow mdi mdi-chevron-right"></i>
        </a>
        <ul class="menu collapse" data-parent="#menu-appointment" id="apm-report" style="margin-left: 10px">
          <li class="menu-item">
            <a href="{{ url('reportcustomer') }}" class="menu-link w3-large">
              <i class="menu-icon mdi mdi-file-account"></i>
              <span class="menu-label">ລາຍ​ງານ​ຂໍ້​ມູນ​ລູກ​ຄ້າ</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ url('reportcars') }}" class="menu-link w3-large">
              <i class="menu-icon mdi mdi-car-pickup"></i>
              <span class="menu-label">​ລາຍ​ງານຂໍ້​ມູນ​ລົດ</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ url('reportrepair') }}" class="menu-link w3-large">
              <i class="menu-icon mdi mdi-tools"></i>
              <span class="menu-label">ລາຍ​ງານ​ລາຍການ​ສ້ອມແປງ</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ url('reportAppointment') }}" class="menu-link w3-large">
              <i class="menu-icon mdi mdi-av-timer"></i>
              <span class="menu-label">ລາຍ​ງານເວ​ລາ​ນັດ​ໝາຍ</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item">
        <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#menu-apms" aria-expanded="true" aria-controls="menu-apms">
          <i class="menu-icon mdi mdi-settings-outline"></i>
          <span class="menu-label">ຕັ້ງ​ຄ່າ</span>
          <i class="menu-arrow mdi mdi-chevron-right"></i>
        </a>
        <ul class="menu collapse" data-parent="#menu-appointment" id="menu-apms" style="margin-left: 10px">
          <li class="menu-item">
            <a href="{{ url('customer_setting') }}" class="menu-link w3-large">
              <i class="menu-icon mdi mdi-account-edit"></i>
              <span class="menu-label">ຈັດ​ການ​ຂໍ້​ມູນ​ລູກ​ຄ້າ</span>
            </a>
          </li>
          <li class="menu-item">
              <a href="{{ url('car_setting') }}" class="menu-link w3-large">
              <i class="menu-icon mdi mdi-car"></i>
              <span class="menu-label">​ຈັດ​ການ​ຂໍ້​ມູນ​ລົດ</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ url('listrepair') }}" class="menu-link w3-large">
              <i class="menu-icon mdi mdi-tools"></i>
              <span class="menu-label">ຈັດ​ການລາຍ​ການ​ສ້ອມແປງ</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ url('ap_setting') }}" class="menu-link w3-large">
              <i class="menu-icon mdi mdi-av-timer"></i>
              <span class="menu-label">ຈັດ​ການ​ເວ​ລາ​ນັດ​ໝາຍ</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ url('brand_setting') }}" class="menu-link w3-large">
              <i class="menu-icon mdi mdi-account-multiple"></i>
              <span class="menu-label">ຈັດ​ການ​ຍີ່​ຫໍ້​ລົດ</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>

      {{-- </li>
    </ul> --}}
@endrole