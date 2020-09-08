{{-- <div class="main-navbar navbar-expand-md navbar-light bg-white fixed-top shadow-sm"> --}}
<div class="main-navbar navbar-expand-md fixed-top shadow-sm" style="background-color: lightgray">

    <button class="btn hidden-md-up" type="button" data-toggle="collapse" data-target="#main-menu"
        aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
    </button>


    <img src="{{ url('images/tslogo.png') }}" title="Tirespeed" class="navbar-logo hidden-md-up"
        style="height: 36px;">


    <button class="btn hidden-md-up" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
    </button>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto hidden-sm-down">

            <li class="nav-item mr-10">
                <a href="javascript://" class="nav-icon font-2xl" id="navbar-toggler" style="color:#21409b">
                    <!-- <i class="fas fa-bars"></i> -->
                    <!-- <i class="mdi mdi-view-sequential font-2xl"></i> -->

                    <i class="mdi mdi-menu"></i>
                </a>
            </li>

            {{-- <li class="nav-item">
                <form class="form-inline">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                        <span class="input-group-append">
                            <button class="btn btn-outline-primary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </li> --}}

        </ul>


        <ul class="navbar-nav my-2 my-lg-0">


            <li class="nav-item mr-5">
                <a href="#" class="nav-icon font-2xl" style="color:#21409b">
                    <!-- <i class="fas fa-chart-pie"></i> -->
                    <i class="mdi mdi-view-dashboard-outline"></i>
                </a>
            </li>
            @role('Admin')
            <li class="nav-item mr-5">
                <a class="nav-icon font-2xl" href="#" id="btnNoti" style="color:#21409b">
                    <i class="mdi mdi-bell-ring-outline"></i> <span style="position: absolute; right: 69px; top: 33px; color: red; font-size: 14px; font-weight: bolder" id="shownavnoti"></span>
                </a>
            </li>
            @endrole
            @role('Manager')
            <li class="nav-item mr-5">
                <a class="nav-icon font-2xl" href="#" id="btnNoti" style="color:#21409b">
                    <i class="mdi mdi-bell-ring-outline"></i> <span style="position: absolute; right: 69px; top: 33px; color: red; font-size: 14px; font-weight: bolder" id="shownavnoti"></span>
                </a>
            </li>
            @endrole
            {{-- <li class="nav-item mr-5">
                <a href="#" class="nav-icon font-2xl rounded-circle">
                    <!-- <i class="fas fa-cog"></i> -->
                    <i class="mdi mdi-settings-outline"></i>
                </a>
            </li> --}}

            <li class="nav-item mr-5 dropdown">
                <a href="#" class="nav-icon avatar rounded-circle" id="PJXN7R" role="button"
                    data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ url('images/person.png') }}">
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="PJXN7R">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#mydata">
                        <i class="mdi mdi-account-circle-outline"></i> ຂໍ້​ມູນ​​ສ່ວນ​ຕົວ</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#nmodalchange"><i class="mdi mdi-lock-outline"></i> ປ່ຽ​ນ​ລະ​ຫັດ​ຜ່ານ</a>
                    <a class="dropdown-item" href="#"><i class="mdi mdi-settings-outline"></i> ຕັ້ງ​ຄ່າ</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('logout') }}"><i class="mdi mdi-exit-to-app"></i> ອອກ​ຈາກ​ລະ​ບົບ</a>
                </div>
            </li>

            {{-- <li class="nav-item dropdown">
                <a class="nav-icon font-2xl rounded-circle" href="#" id="WJIK6R" role="button"
                    data-toggle="dropdown" aria-expanded="false">
                    <!-- <i class="fas fa-ellipsis-h"></i> -->

                    <i class="mdi mdi-dots-horizontal"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="WJIK6R">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li> --}}
        </ul>

    </div>
</div>
<div class="modal fade" id="mydata" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title h4" id="myExtraLargeModalLabel">ຂໍ້​ມູນ​​ສ່ວນ​ຕົວ</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="showmyself">
                
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-sm" id="nmodalchange" tabindex="-1" role="dialog" aria-labelledby="changepass" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="changepass">ປ່ຽນ​ລະ​ຫັດ​ຜ່ານ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password">ລະ​ຫັດ</label>
                            <input class="form-control col-md-12" type="password" id="npass" name="npass" placeholder="Password...">
                            <input type="hidden" name="nid" id="nid" value="{{ Auth::user()->id }}">
                        </div>
                        <div class="form-group">
                            <label for="nconfirmpass">ລະ​ຫັດຢ​ືນ​ຢັນ</label>
                            <input class="form-control col-md-12" type="password" id="nconfirmpass" name="nconfirmpass" placeholder="Confirm Password...">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <button class="btn btn-success btn-lg" id="btnChangenpass" type="button" disabled><i class="mdi mdi-textbox-password"></i> ປ່ຽນ​ລະ​ຫັດ​ຜ່ານ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-slide-right" tabindex="-1" role="dialog" aria-labelledby="slideright"
    class="modal fade" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="slideright">ການ​ແຈ້ງ​ເຕືອນ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th>ລຳ​ດັ​ບ</th>
                            <th>ຊື່​ຜູ້​ໃຊ້</th>
                            <th>ວັນ​ທີ່ ເວ​ລາ​</th>
                            <th>ສ​ະ​ຖາ​ນະ​</th>
                            <th>ລາຍ​ລະ​ອຽດ</th>
                        </tr>
                    </thead>
                    <tbody id="shownotification">
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-right">ຈຳ​ນວນ​ວຽກ​ເຄື່ອນ​ໄຫວ​ມື້​ນີ້</td>
                            <td><b id="showcountnoti"></b></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ປິດ</button>
            </div>
        </div>
    </div>
</div>