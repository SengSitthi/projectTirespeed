@role('Technician')
  {{-- Start Technical --}}
  <li class="menu-item">
    <a href="javascript://" class="menu-link w3-large" data-toggle="collapse" data-target="#repair-car" aria-expanded="true" aria-controls="repair-car">
      <i class="menu-icon mdi mdi-vector-square"></i>
      <!-- <i class="menu-icon fas fa-vector-square"></i> -->
      <span class="menu-label">ງານ​ສ້ອມ​ແປງລົດ</span>
      <i class="menu-arrow mdi mdi-chevron-right"></i>
    </a>

    <ul class="menu collapse" data-parent="#main-menu" id="repair-car">
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
        <a href="icon-fa.html" class="menu-link w3-large">
          <i class="menu-icon mdi mdi-car"></i>
          <span class="menu-label">ລົດ​ກຳ​ລັງ​ສ້ອມ</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="icon-remix.html" class="menu-link w3-large">
          <i class="menu-icon mdi mdi-car"></i>
          <span class="menu-label">​ລົ​ດ​ສ້ອມ​ສຳ​ເລັດ</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="icon-remix.html" class="menu-link w3-large">
          <i class="menu-icon mdi mdi-car"></i>
          <span class="menu-label">​ລົ​ດ​ສົ່ງ​ຄືນ​ລູກ​ຄ້າ​ແລ້ວ</span>
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
@endrole