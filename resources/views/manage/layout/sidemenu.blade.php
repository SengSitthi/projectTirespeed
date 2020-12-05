<div class="menubar menubar-dark" id="main-menu">

    <div class="menubar-header text-center" style="background-color: lightgray">
        @role('Admin')
          <a class="menubar-brand" href="{{ url('admin') }}">
              <img src="{{ url('images/tslogo.png') }}" title="Tirespeed" class="menubar-logo img-fluid" style="height: 50px;">
          </a>
        @endrole
        @role('Manager')
          <a class="menubar-brand" href="{{ url('admin') }}">
              <img src="{{ url('images/tslogo.png') }}" title="Tirespeed" class="menubar-logo img-fluid" style="height: 50px;">
          </a>
        @endrole
        @role('CRM')
          <a class="menubar-brand" href="{{ url('appointment') }}">
              <img src="{{ url('images/tslogo.png') }}" title="Tirespeed" class="menubar-logo img-fluid" style="height: 50px;">
          </a>
        @endrole
        @role('StockManager')
          <a class="menubar-brand" href="{{ url('stockdashboard') }}">
            <img src="{{ url('images/tslogo.png') }}" title="Tirespeed" class="menubar-logo img-fluid" style="height: 50px;">
          </a>
        @endrole
        @role('Technician')
          <a class="menubar-brand" href="{{ url('technic_dashboard') }}">
            <img src="{{ url('images/tslogo.png') }}" title="Tirespeed" class="menubar-logo img-fluid" style="height: 50px;">
          </a>
        @endrole
        @role('Accountant')
          <a class="menubar-brand" href="{{ url('account_dashboard') }}">
            <img src="{{ url('images/tslogo.png') }}" title="Tirespeed" class="menubar-logo img-fluid" style="height: 50px;">
          </a>
        @endrole
    </div>

    <div class="menubar-body">
      {{-- include admin side menu --}}
      @include('manage.layout.adminsidemenu')
      {{-- include admin side menu --}}

      {{-- include manager side menu --}}
      @include('manage.layout.mgsidemenu')
      {{-- include manager side menu --}}

      {{-- include crm sidemenu bar --}}
      @include('manage.layout.crmsidemenu')
      {{-- include crm sidemenu bar --}}

      {{-- include stock sidebar --}}
      @include('manage.layout.stocksidemenu')
      {{-- include stock sidebar --}}

      {{-- include Technician sidebar --}}
      @include('manage.layout.technician')
      {{-- include Technician sidebar --}}

      {{-- include accountant sidebar --}}
      @include('manage.layout.actsidemenu')
      {{-- include accountant sidebar --}}
    </div>

    <div class="menubar-footer bg-dark p-10">
        <a href="https://sitthilogistics.com" class="d-block text-truncate">&copy IT Sitthi Logistics <span
                id="version">0.1.0</span></a>
    </div>

</div>
