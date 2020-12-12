@role('Admin')
<ul class="menu accordion">
    <li class="menu-item">
        <a href="{{ url('admin') }}" class="menu-link w3-large">
            <!-- <i class="menu-icon fas fa-magic"></i> -->
            <i class="menu-icon mdi mdi-view-dashboard"></i>
            <span class="menu-label">ແຜງ​ຄວບ​ຄຸມ</span>
            {{-- <span class="menu-badge">
                <span class="badge badge-info">1</span>
            </span> --}}

        </a>
    </li>

    {{-- Start Appointment --}}
    <li class="menu-item">
        <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#menu-appointment"
            aria-expanded="true" aria-controls="menu-appointment">
            <!-- <i class="menu-icon fas fa-border-all"></i> -->
            <i class="menu-icon mdi mdi-room-service"></i>
            <span class="menu-label">ບໍ​ລິ​ການ</span>
            <i class="menu-arrow mdi mdi-chevron-right"></i>
        </a>

        <ul class="menu collapse" data-parent="#main-menu" id="menu-appointment" style="margin-left: 10px">
          <li class="menu-item">
            <a href="{{ url('appointment') }}" class="menu-link w3-large">
              <i class="menu-icon mdi mdi-desktop-mac-dashboard"></i>
              <span class="menu-label">ພາບ​ລວມ​ການນັດ​ໝາຍ</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#crv" aria-expanded="true" aria-controls="crv">
              <i class="menu-icon mdi mdi-card-text"></i>
              <span class="menu-label">ໃບ​ຮັບ​ລົດ</span>
              <i class="menu-arrow mdi mdi-chevron-right"></i>
            </a>
            <ul class="menu collapse" data-parent="#menu-appointment" id="crv" style="margin-left: 10px">
              <li class="menu-item">
                <a href="{{ url('crvnew') }}" class="menu-link w3-large">
                  <i class="menu-icon mdi mdi-file-document-box-plus"></i>
                  <span class="menu-label">​ໃບ​ຮັບ​ລົດໃໝ່</span>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ url('crvlist') }}" class="menu-link w3-large">
                  <i class="menu-icon mdi mdi-file-document-box-multiple"></i>
                  <span class="menu-label">ລາຍ​ການໃບ​ຮັບ​ລົດ</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="menu-item">
            <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#quotation" aria-expanded="true" aria-controls="quotation">
              <i class="menu-icon mdi mdi-card-text"></i>
              <span class="menu-label">ໃບ​ສະ​ເໜີ</span>
              <i class="menu-arrow mdi mdi-chevron-right"></i>
            </a>
            <ul class="menu collapse" data-parent="#menu-appointment" id="quotation" style="margin-left: 10px">
              <li class="menu-item">
                <a href="{{ url('quotationnew') }}" class="menu-link w3-large">
                  <i class="menu-icon mdi mdi-file-document-box-plus"></i>
                  <span class="menu-label">​ໃບ​ສະ​ເໜີໃໝ່</span>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ url('quotationlist') }}" class="menu-link w3-large">
                  <i class="menu-icon mdi mdi-file-document-box-multiple"></i>
                  <span class="menu-label">ລາຍ​ການໃບ​ສະ​ເໜີ</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="menu-item">
            <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#customer" aria-expanded="true" aria-controls="customer">
              <i class="menu-icon mdi mdi-card-text"></i>
              <span class="menu-label mdi mdi-account-group">ລູກ​ຄ້າ</span>
              <i class="menu-arrow mdi mdi-chevron-right"></i>
            </a>
            <ul class="menu collapse" data-parent="#menu-appointment" id="customer" style="margin-left: 10px">
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
            </ul>
          </li><li class="menu-item">
            <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#appointment-list" aria-expanded="true" aria-controls="appointment-list">
              <i class="menu-icon mdi mdi-card-text"></i>
              <span class="menu-label mdi mdi-update">ນັດ​ໝາຍ</span>
              <i class="menu-arrow mdi mdi-chevron-right"></i>
            </a>
            <ul class="menu collapse" data-parent="#menu-appointment" id="appointment-list" style="margin-left: 10px">
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
            </ul>
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

      </li>
    {{-- End Appointment --}}

    {{-- Start Spares --}}
    <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link w3-large" data-toggle="collapse" data-target="#menu-product"
            aria-expanded="true" aria-controls="menu-product">
            <i class="menu-icon mdi mdi-tools"></i>
            <span class="menu-label">​ອາ​ໄຫຼ່</span>
            <i class="menu-arrow mdi mdi-chevron-right"></i>
        </a>
        <ul class="menu collapse" data-parent="#main-menu" id="menu-product" style="margin-left: 10px">
            <li class="menu-item">
                <a href="{{ url('stockdashboard') }}" class="menu-link w3-large">
                    <i class="menu-icon mdi mdi-monitor-dashboard"></i>
                    <span class="menu-label">ແຜງ​ຄວບ​ຄຸມ​ອະ​ໄຫຼ່</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#spares-data"
                    aria-expanded="true" aria-controls="spares-data">
                    <i class="menu-icon mdi mdi-tools"></i>
                    <span class="menu-label">ຂໍ້​ມູນ​ອາ​ໄຫຼ່</span>
                    <i class="menu-arrow mdi mdi-chevron-right"></i>
                </a>
                <ul class="menu collapse" data-parent="#menu-product" id="spares-data" style="margin-left: 10px">
                    <li class="menu-item">
                        <a href="{{ url('spares') }}" class="menu-link w3-large">
                            <i class="menu-icon mdi mdi-database-plus"></i>
                            <span class="menu-label">ເພີ່ມ​ອະ​ໄຫຼ່</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ url('spareslist') }}" class="menu-link w3-large">
                            <i class="menu-icon mdi mdi-tools"></i>
                            <span class="menu-label">ລາຍ​ການອະ​ໄຫຼ່</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#order-spare"
                    aria-expanded="true" aria-controls="order-spare">
                    <i class="menu-icon mdi mdi-cart"></i>
                    <span class="menu-label">ຂໍ້​ມູນສັ່ງ​ຊື້​ອະ​ໄຫຼ່</span>
                    <i class="menu-arrow mdi mdi-chevron-right"></i>
                </a>
                <ul class="menu collapse" data-parent="#menu-product" id="order-spare" style="margin-left: 10px">
                    <li class="menu-item">
                        <a href="{{ url('orders') }}" class="menu-link w3-large">
                            <i class="menu-icon mdi mdi-playlist-plus"></i>
                            <span class="menu-label">​​ສັ່ງ​ຊື້​ອະ​ໄຫຼ່</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ url('orderslist') }}" class="menu-link w3-large">
                            <i class="menu-icon mdi mdi-clipboard-list"></i>
                            <span class="menu-label">ລາຍ​ການ​ສັ່ງ​ຊື້ອະ​ໄຫຼ່</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#receive-spare"
                    aria-expanded="true" aria-controls="receive-spare">
                    <i class="menu-icon mdi mdi-expand-all"></i>
                    <span class="menu-label">ຂໍ້​ມູນຮ​ັບ​ອະ​ໄຫຼ່​</span>
                    <i class="menu-arrow mdi mdi-chevron-right"></i>
                </a>
                <ul class="menu collapse" data-parent="#menu-product" id="receive-spare" style="margin-left: 10px">
                    <li class="menu-item">
                        <a href="{{ url('receive') }}" class="menu-link w3-large">
                            <i class="menu-icon mdi mdi-cart-plus"></i>
                            <span class="menu-label">​ຮັບ​ອະ​ໄຫຼ່ເຂົ້າ</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ url('receivelist') }}" class="menu-link w3-large">
                            <i class="menu-icon mdi mdi-clipboard-list"></i>
                            <span class="menu-label">​ລາຍ​ການ​ຮັບ​ອະ​ໄຫຼ່</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#withdraw-spare"
                    aria-expanded="true" aria-controls="withdraw-spare">
                    <i class="menu-icon mdi mdi-tools"></i>
                    <span class="menu-label">ຂໍ້​ມູນການ​ເບີກ​ອະ​ໄຫຼ່​</span>
                    <i class="menu-arrow mdi mdi-chevron-right"></i>
                </a>
                <ul class="menu collapse" data-parent="#menu-product" id="withdraw-spare" style="margin-left: 10px">
                    <li class="menu-item">
                        <a href="{{ url('withdraw') }}" class="menu-link w3-large">
                            <i class="menu-icon mdi mdi-cart-plus"></i>
                            <span class="menu-label">​ເບິກ​ອະ​ໄຫຼ່</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ url('withdrawlist') }}" class="menu-link w3-large">
                            <i class="menu-icon mdi mdi-clipboard-list"></i>
                            <span class="menu-label">​ລາຍ​ການ​ເບີກອະ​ໄຫຼ່</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
              <a href="{{ url('sparesbookprint') }}" class="menu-link w3-large">
                  <i class="menu-icon mdi mdi-printer"></i>
                  <span class="menu-label">ພິມ​ລາຍ​ການອະ​ໄຫຼ່</span>
              </a>
          </li>

            <li class="menu-item">
                <a href="{{ url('stocksummary') }}" class="menu-link w3-large">
                    <i class="menu-icon mdi mdi-chart-areaspline"></i>
                    <span class="menu-label">ສະຫຼຸບ</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#supplier-spare"
                    aria-expanded="true" aria-controls="supplier-spare">
                    <i class="menu-icon mdi mdi-account-group"></i>
                    <span class="menu-label">​ຂໍ້​ມູນ​ຜູ້​ສະ​ໜອງ</span>
                    <i class="menu-arrow mdi mdi-chevron-right"></i>
                </a>
                <ul class="menu collapse" data-parent="#menu-product" id="supplier-spare" style="margin-left: 10px">
                    <li class="menu-item">
                        <a href="{{ url('supplier') }}" class="menu-link w3-large">
                            <i class="menu-icon mdi mdi-account-multiple-plus"></i>
                            <span class="menu-label">ເພີ່ມ​ຜ​ູ້​ສະ​ໜອງ</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ url('supplierlist') }}" class="menu-link w3-large">
                            <i class="menu-icon mdi mdi-clipboard-list"></i>
                            <span class="menu-label">​ລາຍ​ການ​​ຜູ້​ສະ​ໜອງ</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#setting-spare"
                    aria-expanded="true" aria-controls="setting-spare">
                    <i class="menu-icon mdi mdi-tools"></i>
                    <span class="menu-label">ຕັ້ງ​ຄ່າອະ​ໄຫຼ່</span>
                    <i class="menu-arrow mdi mdi-chevron-right"></i>
                </a>
                <ul class="menu collapse" data-parent="#menu-product" id="setting-spare" style="margin-left: 10px">
                    <li class="menu-item">
                        <a href="{{ url('typeservice') }}" class="menu-link w3-large">
                            <i class="menu-icon mdi mdi-clipboard-list"></i>
                            <span class="menu-label">​ຈັດ​ການປະ​ເພດ​ອະ​ໄຫຼ່</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ url('typespare') }}" class="menu-link w3-large">
                            <i class="menu-icon mdi mdi-clipboard-list"></i>
                            <span class="menu-label">​ຈັດການ​ລະ​ບົບ​ການ​ສ້ອມ</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ url('brandspare') }}" class="menu-link w3-large">
                            <i class="menu-icon mdi mdi-clipboard-list"></i>
                            <span class="menu-label">​ຈັດການຍີ່​ຫໍ້ອະ​ໄຫຼ່</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ url('brand_setting') }}" class="menu-link w3-large">
                            <i class="menu-icon mdi mdi-clipboard-list"></i>
                            <span class="menu-label">​ຈັດການຍີ່​ຫໍ້​ລົດ</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ url('unitspare') }}" class="menu-link w3-large">
                            <i class="menu-icon mdi mdi-clipboard-list"></i>
                            <span class="menu-label">​ຈັດການຫົວ​ໜ່ວຍອະ​ໄຫຼ່</span>
                        </a>
                    </li>
                    {{-- <li class="menu-item">
                        <a href="javascript://" class="menu-link w3-large" data-toggle="collapse"
                            data-target="#unit-spare" aria-expanded="true" aria-controls="unit-spare">
                            <i class="menu-icon mdi mdi-google-circles-extended"></i>
                            <span class="menu-label">ຂໍ້​ມູນ​ຫົວ​ໜ່ວຍ</span>
                            <i class="menu-arrow mdi mdi-chevron-right"></i>
                        </a>
                        <ul class="menu collapse" data-parent="#setting-spare" id="unit-spare">
                            <li class="menu-item">
                                <a href="#" class="menu-link w3-large">
                                    <i class="menu-icon mdi mdi-plus-thick"></i>
                                    <span class="menu-label">ເພີ່ມ​​ຫົວ​ໜ່ວຍ</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="menu-link w3-large">
                                    <i class="menu-icon mdi mdi-clipboard-list"></i>
                                    <span class="menu-label">​ລາຍ​ການ​ຫົວ​ໜ່ວຍ</span>
                                </a>
                            </li>
                        </ul>
                    </li> --}}

                </ul>
            </li>

        </ul>
    </li>
    {{-- End Stock --}}

    {{-- Start Technical --}}
    <li class="menu-item">
      <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#repair-car"
          aria-expanded="true" aria-controls="repair-car">
          <i class="menu-icon mdi mdi-vector-square"></i>
          <!-- <i class="menu-icon fas fa-vector-square"></i> -->
          <span class="menu-label">ງານ​ສ້ອມ​ແປງລົດ</span>
          <i class="menu-arrow mdi mdi-chevron-right"></i>
      </a>

      <ul class="menu collapse" data-parent="#main-menu" id="repair-car">
        <li class="menu-item">
          <a href="{{ url('technic_dashboard') }}" class="menu-link w3-large">
            <i class="menu-icon mdi mdi-desktop-mac-dashboard"></i>
            <span class="menu-label">ພາບ​ລວມ​ງານ​ສ້ອມ</span>
          </a>
        </li>
        <li class="menu-item">
          <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#open-repair"
            aria-expanded="true" aria-controls="open-repair">
            <!-- <i class="menu-icon fas fa-tasks"></i> -->
            <i class="menu-icon mdi mdi-car-side"></i>
            <span class="menu-label">ໃບ​ເປີດ​ງານ​ສ້ອມ​</span>
            <i class="menu-arrow mdi mdi-chevron-right"></i>
          </a>

          <ul class="menu collapse" data-parent="#repair-car" id="open-repair">
            <li class="menu-item">
              <a href="{{ url('repairbillnew') }}" class="menu-link w3-large">
                <i class="menu-icon mdi mdi-file-document-box-plus"></i>
                <span class="menu-label">ໃບ​ເປີດ​ງານ​ສ້ອມໃໝ່</span>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ url('repairbill_list') }}" class="menu-link w3-large">
                <i class="menu-icon mdi mdi-file-document-box-multiple"></i>
                <span class="menu-label">ລາຍ​ການໃບ​ເປີດ​ງານ​ສ້ອມ</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="menu-item">
          <a href="{{ url('techcarstatus') }}" class="menu-link w3-large">
            <i class="menu-icon mdi mdi-car"></i>
            <span class="menu-label">ສະ​ຖາ​ນະ​ລົດ​ການ​ສ້ອມ</span>
          </a>
        </li>
        <li class="menu-item">
          <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#technical_setting"
            aria-expanded="true" aria-controls="technical_setting">
            <!-- <i class="menu-icon fas fa-tasks"></i> -->
            <i class="menu-icon mdi mdi-car-side"></i>
            <span class="menu-label">ຕັ້ງ​ຄ່າ</span>
            <i class="menu-arrow mdi mdi-chevron-right"></i>
          </a>
          <ul class="menu collapse" data-parent="#repair-car" id="technical_setting">
            <li class="menu-item">
              <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#rpnoidsetting"
                  aria-expanded="true" aria-controls="rpnoidsetting">
                  <!-- <i class="menu-icon fas fa-tasks"></i> -->
                  <i class="menu-icon mdi mdi-tools"></i>
                  <span class="menu-label">ລະ​ຫັດ​ສ້ອມ​ແປງ</span>
                  <i class="menu-arrow mdi mdi-chevron-right"></i>
              </a>
      
              <ul class="menu collapse" data-parent="#technical_setting" id="rpnoidsetting">
                <li class="menu-item">
                  <a href="{{ url('addnewrepairid') }}" class="menu-link w3-large">
                    <i class="menu-icon mdi mdi-car"></i>
                    <span class="menu-label">ເພີ່ມ​ລະ​ຫັດ​ສ້ອມ</span>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ url('rpnoidlist') }}" class="menu-link w3-large">
                    <i class="menu-icon mdi mdi-car"></i>
                    <span class="menu-label">​ລາຍ​ການ​ລະ​ຫັດ​ສ້ອມ</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#repairwage"
                  aria-expanded="true" aria-controls="repairwage">
                  <!-- <i class="menu-icon fas fa-tasks"></i> -->
                  <i class="menu-icon mdi mdi-home-currency-usd"></i>
                  <span class="menu-label">ຄ່າ​ແຮງ​ງານ</span>
                  <i class="menu-arrow mdi mdi-chevron-right"></i>
              </a>
      
              <ul class="menu collapse" data-parent="#technical_setting" id="repairwage">
                <li class="menu-item">
                  <a href="{{ url('wagenew') }}" class="menu-link w3-large">
                    <i class="menu-icon mdi mdi-home-currency-usd"></i>
                    <span class="menu-label">ເພີ່ມ​ຄ່າ​ແຮງ​ງານ</span>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ url('wagelist') }}" class="menu-link w3-large">
                    <i class="menu-icon mdi mdi-currency-eth"></i>
                    <span class="menu-label">​ລາຍ​ການ​​ຄ່າ​ແຮງ​ງານ</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="{{ url('managetypecars') }}" class="menu-link w3-large">
                <i class="menu-icon mdi mdi-car"></i>
                <span class="menu-label">ຈັດ​ການ​ປະ​ເພດ​ລົດ</span>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ url('unitrepairs') }}" class="menu-link w3-large">
                <i class="menu-icon mdi mdi-car"></i>
                <span class="menu-label">ຈັດ​ການ​ຫົວ​ໜ່ວຍ​ສ້ອມ​ແປງ</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </li>
    {{-- End Technical --}}

    {{-- Start Account Manager --}}
    <li class="menu-item">
      <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#menu-account" aria-expanded="true" aria-controls="menu-account">
        <!-- <i class="menu-icon fas fa-tasks"></i> -->
        <i class="menu-icon">₭</i>
        <span class="menu-label">ບັນ​ຊ​ີ</span>
        <i class="menu-arrow mdi mdi-chevron-right"></i>
      </a>

      <ul class="menu collapse" data-parent="#main-menu" id="menu-account">
        <li class="menu-item">
          <a href="{{ url('account_dashboard') }}" class="menu-link w3-large">
            <i class="menu-icon mdi mdi-desktop-mac-dashboard"></i>
            <span class="menu-label">ແຜງ​ຄວບ​ຄຸມ</span>
          </a>
        </li>
        <li class="menu-item">
          <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#menu-invoice" aria-expanded="true" aria-controls="menu-invoice">
            <!-- <i class="menu-icon fas fa-tasks"></i> -->
            <i class="menu-icon">₭</i>
            <span class="menu-label">ໃບຮຽກ​ເກັບ</span>
            <i class="menu-arrow mdi mdi-chevron-right"></i>
          </a>
    
          <ul class="menu collapse" data-parent="#menu-account" id="menu-invoice">
            <li class="menu-item">
              <a href="{{ url('newinvoice') }}" class="menu-link w3-large">
                <i class="menu-icon">₭</i>
                <span class="menu-label">​ໃບ​ຮຽກ​ເກັບ​ໃໝ່</span>
              </a>
            </li>
    
            <li class="menu-item">
              <a href="{{ url('invoicelist') }}" class="menu-link w3-large">
                <i class="menu-icon">₭</i>
                <span class="menu-label">ລາຍ​ການ​ໃບ​ຮຽກ​ເກັບ</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="menu-item">
          <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#menu-receitp" aria-expanded="true" aria-controls="menu-receitp">
            <!-- <i class="menu-icon fas fa-tasks"></i> -->
            <i class="menu-icon">₭</i>
            <span class="menu-label">ໃບຮັບ​ເງິນ</span>
            <i class="menu-arrow mdi mdi-chevron-right"></i>
          </a>
    
          <ul class="menu collapse" data-parent="#menu-account" id="menu-receitp">
            <li class="menu-item">
              <a href="{{ url('newreceipt') }}" class="menu-link w3-large">
                <i class="menu-icon">₭</i>
                <span class="menu-label">​ໃບ​ຮັບ​ເງິນ​ໃໝ່</span>
              </a>
            </li>
    
            <li class="menu-item">
              <a href="{{ url('receiptlist') }}" class="menu-link w3-large">
                <i class="menu-icon">₭</i>
                <span class="menu-label">ລາຍ​ການ​ໃບ​ຮັບ​ເງິນ</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="menu-item">
          <a href="{{ url('account_summary') }}" class="menu-link w3-large">
            <i class="menu-icon">₭ ສະຫຼຸ​ບ​ລາຍ​ຮັບ​ປະ​ຈຳ​ວັນ</i>
            <span class="menu-label"></span>
          </a>
        </li>

        <li class="menu-item">
          <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#account-setting" aria-expanded="true" aria-controls="account-setting">
            <!-- <i class="menu-icon fas fa-tasks"></i> -->
            <i class="menu-icon mdi mdi-settings"></i>
            <span class="menu-label">ຕັ້ງ​ຄ່າ</span>
            <i class="menu-arrow mdi mdi-chevron-right"></i>
          </a>
    
          <ul class="menu collapse" data-parent="#menu-account" id="account-setting">
            <li class="menu-item">
              <a href="{{ url('company') }}" class="menu-link w3-large">
                <i class="menu-icon mdi mdi-office-building"></i>
                <span class="menu-label">ບໍ​ລິ​ສັດ</span>
              </a>
            </li>
    
            {{-- <li class="menu-item">
              <a href="" class="menu-link w3-large">
                <i class="menu-icon">₭</i>
                <span class="menu-label">ລາຍ​ການ​ໃບ​ຮຽກ​ເກັບ</span>
              </a>
            </li> --}}
          </ul>
        </li>
      </ul>
    </li>

    {{-- <li class="menu-item">
        <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#menu-document"
            aria-expanded="true" aria-controls="menu-document">
            <!-- <i class="menu-icon fas fa-tasks"></i> -->
            <i class="menu-icon mdi mdi-folder-multiple-outline"></i>
            <span class="menu-label">​ເອ​ກະ​ສານ</span>
            <i class="menu-arrow mdi mdi-chevron-right"></i>
        </a>

        <ul class="menu collapse" data-parent="#main-menu" id="menu-document">

            <li class="menu-item">
                <a href="form-general.html" class="menu-link w3-large">
                    <i class="menu-icon">E</i>
                    <span class="menu-label">General</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="form-advanced.html" class="menu-link w3-large">
                    <i class="menu-icon">A</i>
                    <span class="menu-label">Advanced</span>
                </a>
            </li>


        </ul>
    </li> --}}

    

    {{-- <li class="menu-item">
        <a href="#" class="menu-link w3-large" data-toggle="collapse" data-target="#menu-62d0a7" aria-expanded="true"
            aria-controls="menu-62d0a7">
            <i class="menu-icon mdi mdi-account-box-multiple"></i>

            <span class="menu-label">ລູກ​ຄ້າ</span>
            <i class="menu-arrow mdi mdi-chevron-right"></i>
        </a>

        <ul class="menu collapse" data-parent="#main-menu" id="menu-62d0a7">

            <li class="menu-item">
                <a href="chart-flot.html" class="menu-link w3-large">
                    <i class="menu-icon">F</i>
                    <span class="menu-label">Flot Charts</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="chart-morris.html" class="menu-link w3-large">
                    <i class="menu-icon">M</i>
                    <span class="menu-label">Morris Charts</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="chart-knob.html" class="menu-link w3-large">
                    <i class="menu-icon">K</i>
                    <span class="menu-label">Knob Charts</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="chart-highcharts.html" class="menu-link w3-large">
                    <i class="menu-icon">H</i>
                    <span class="menu-label">Highcharts</span>
                </a>
            </li>

        </ul>
    </li> --}}

    <li class="menu-item">
        <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#menu-setting"
            aria-expanded="true" aria-controls="menu-setting">
            <i class="menu-icon mdi mdi-settings-outline"></i>
            <!-- <i class="menu-icon fas fa-vector-square"></i> -->
            <span class="menu-label">ຕັ້ງ​ຄ່າ</span>
            <i class="menu-arrow mdi mdi-chevron-right"></i>
        </a>

        <ul class="menu collapse" data-parent="#main-menu" id="menu-setting">
            <li class="menu-item">
                <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#menu-emp"
                    aria-expanded="true" aria-controls="menu-emp">
                    <i class="menu-icon mdi mdi-account-badge-horizontal-outline"></i>
                    <span class="menu-label">​ພະ​ນັກ​ງານ</span>
                    <i class="menu-arrow mdi mdi-chevron-right"></i>
                </a>
                <ul class="menu collapse" data-parent="#menu-setting" id="menu-emp">
                    <li class="menu-item">
                        <a href="{{ url('employee') }}" class="menu-link w3-large">
                            <i class="menu-icon mdi mdi-account-plus-outline"></i>
                            <span class="menu-label">ເພີ່ມພະ​ນັກ​ງານ</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ url('employee_list') }}" class="menu-link w3-large">
                            <i class="menu-icon mdi mdi-clipboard-list-outline"></i>
                            <span class="menu-label">ລາຍ​ການພະ​ນັກ​ງານ</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#menu-user"
                    aria-expanded="true" aria-controls="menu-user">
                    <i class="menu-icon mdi mdi-account-badge-horizontal-outline"></i>
                    <span class="menu-label">ຜູ້​ໃຊ້</span>
                    <i class="menu-arrow mdi mdi-chevron-right"></i>
                </a>
                <ul class="menu collapse" data-parent="#menu-setting" id="menu-user">
                    <li class="menu-item">
                        <a href="{{ url('user') }}" class="menu-link w3-large">
                            <i class="menu-icon mdi mdi-account-plus-outline"></i>
                            <span class="menu-label">​ເພີ່ມ​ຜູ້​ໃຊ້</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ url('rolespms') }}" class="menu-link w3-large">
                            <i class="menu-icon mdi mdi-shield-account"></i>
                            <span class="menu-label">ເພີ່ມສິດ​ທິ​ຜູ້​ໃຊ້</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ url('userlist') }}" class="menu-link w3-large">
                            <i class="menu-icon mdi mdi-clipboard-list-outline"></i>
                            <span class="menu-label">ລາຍ​ການຜູ້​ໃຊ້</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
@endrole
