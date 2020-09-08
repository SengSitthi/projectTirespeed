{{-- Start Stock --}}
@role('StockManager')
{{-- <li class="menu-item">
  <a href="javascript:void(0)" class="menu-link w3-large" data-toggle="collapse" data-target="#menu-product"
      aria-expanded="true" aria-controls="menu-product">
    <i class="menu-icon mdi mdi-tools"></i>
    <span class="menu-label">​ອາ​ໄຫຼ່</span>
    <i class="menu-arrow mdi mdi-chevron-right"></i>
  </a> --}}
  <ul class="menu accordion" data-parent="#main-menu" id="menu-product" style="margin-left: 10px">
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
            <a href="{{ url('unitspare') }}" class="menu-link w3-large">
              <i class="menu-icon mdi mdi-clipboard-list"></i>
              <span class="menu-label">​ຈັດການຫົວ​ໜ່ວຍອະ​ໄຫຼ່</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ url('brand_setting') }}" class="menu-link w3-large">
              <i class="menu-icon mdi mdi-clipboard-list"></i>
              <span class="menu-label">​ຈັດການຍີ່​ຫໍ້​ລົດ</span>
            </a>
          </li> 
        </ul>
      </li>

  </ul>
{{-- </li> --}}
@endrole
{{-- End Stock --}}