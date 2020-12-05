@role('Accountant')
{{-- <li class="menu-item">
  <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#menu-account" aria-expanded="true" aria-controls="menu-account">
    <!-- <i class="menu-icon fas fa-tasks"></i> -->
    <i class="menu-icon">₭</i>
    <span class="menu-label">ບັນ​ຊ​ີ</span>
    <i class="menu-arrow mdi mdi-chevron-right"></i>
  </a> --}}

    {{-- <ul class="menu collapse" data-parent="#main-menu" id="menu-account"> --}}
    <ul class="menu accordtion" data-parent="#main-menu" id="menu-account">
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
{{-- </li> --}}
@endrole