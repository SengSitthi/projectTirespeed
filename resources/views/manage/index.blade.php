@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
    <div class="wrapper">

        @include('manage.layout.nav')

        @include('manage.layout.sidemenu')

        <div class="container-fluid mt-30">

            <div class="row row row-cols-1 row-cols-md-2 row-cols-lg-4">

                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <span class="badge badge-success float-right">ເດືອນ</span>
                            <h3 class="card-title text-muted">​ລົດ​ເຂົ້າ</h3>
                            <h6 class="mb-10">ລົດ​ເຂົ້າມື້​ນີ້: <b>5</b> ຄັນ</h6>
                            <p class="text-muted mb-0">ລວມ: 15 ຄັນ
                                <span class="float-right"> <i class="fas fa-angle-up text-success"></i> 5.5%</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <span class="badge badge-success float-right">ເດືອນ</span>
                            <h3 class="card-title text-muted">ລ​ູກ​ຄ້າ</h3>
                            <h6 class="mb-10">​ລ​ູກ​ຄ້າ​ເຂົ້າ​ມື້​ນີ້: <b>3</b> ຄົນ</h6>
                            <p class="text-muted mb-0">ລວມ: 15 ຄົນ
                                <span class="float-right"> <i class="fas fa-angle-up text-success"></i> 5.5%</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <span class="badge badge-success float-right">ເດືອນ</span>
                            <h3 class="card-title text-muted">ລາຍ​ການ​ລົດ​ກຳ​ລັງ​ສ້ອມ​ແປງ</h3>
                            <h6 class="mb-10">ລົດ​ກຳ​ລັງ​ສ້ອມ​ມື້​ນີ້: <b>2</b> ຄັນ</h6>
                            <p class="text-muted mb-0">ລວມ: 3 ຄັນ
                                <span class="float-right"> <i class="fas fa-angle-up text-success"></i> 5.5%</span>
                            </p>

                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <span class="badge badge-success float-right">ເດືອນ</span>
                            <h3 class="card-title text-muted">​ລາຍ​ຮັບ</h3>
                            <h6 class="mb-10">ລາຍ​ຮັບ​ມື້​ນີ້: <b>2.3500.000</b> ກີບ</h6>
                            <p class="text-muted mb-0">​ລວມ: 23.000.000 ກີບ
                                <span class="float-right"> <i class="fas fa-angle-up text-success"></i> 5.5%</span>
                            </p>

                        </div>
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-lg-8 col-12">

                    <div class="card">
                        <div class="card-header bg-transparent py-15">ພາບ​ລວມ</div>
                        <div class="card-body">
                            <div style="height: 540px; max-width: 100%;" id="hl-line-main"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-12">

                    <div class="card">
                        <div class="card-header bg-transparent py-15">ພາບ​ລວມໜ້າ​ວຽກ</div>

                        <div class="card-body">

                            <div class="form-group">
                                <div style="height: 280px; max-width: 100%;" id="hl-pie-ref"></div>
                            </div>

                            <div class="form-group">
                                <a href="https://www.google.com" class="text-body">ນັດ​ໝາຍ</a>
                                <div class="float-right text-muted">
                                    30.5%
                                </div>
                                <div class="progress progress-xs mt-5">
                                    <div class="progress-bar" style="width: 30.5%;"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <a href="https://www.twitter.com" class="text-body">​ລົດ​ກຳ​ລັງ​ສ້ອມ​ແປງ</a>
                                <div class="float-right text-muted">
                                    25.5%
                                </div>
                                <div class="progress progress-xs mt-5">
                                    <div class="progress-bar" style="width: 25.5%;"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <a href="https://morioh.com" class="text-body">​ລົດ​ລໍ​ຖ້າ​ອາ​ໄຫຼ່</a>
                                <div class="float-right text-muted">
                                    16%
                                </div>

                                <div class="progress progress-xs mt-5">
                                    <div class="progress-bar" style="width: 16%;"></div>
                                </div>
                            </div>


                            <div class="form-group">
                                <a href="https://facebook.com" class="text-body">​ລົດ​ສ້ອມ​ສຳ​ເລັດ</a>
                                <div class="float-right text-muted">
                                    8%
                                </div>
                                <div class="progress progress-xs mt-5">
                                    <div class="progress-bar" style="width: 8%;"></div>
                                </div>
                            </div>


                            <div class="form-group">
                                <a href="https://pinterest.com" class="text-body">​ລົດ​ສົ່ງ-ມອບລູກ​ຄ້າ</a>
                                <div class="float-right text-muted">
                                    4%
                                </div>
                                <div class="progress progress-xs mt-5">
                                    <div class="progress-bar" style="width: 8%;"></div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

            {{-- <div class="row">

                <div class="col-lg-8 col-md-12">

                    <div class="card">
                        <div class="card-header bg-transparent py-15">ຈຳ​ນວນ​ລູກ​ຄ້າ​ເຂົ້າ​ລ່າ​ສຸດ</div>

                        <div class="table-responsive">
                            <table class="table">

                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Qty</th>
                                        <th>Amount</th>
                                        <th class="text-right">Time</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            neha******@gmail.com
                                        </td>

                                        <td>
                                            3
                                        </td>

                                        <td>
                                            $1285.23
                                        </td>

                                        <td class="text-right">
                                            2019-12-30 10:10:10 AM
                                        </td>

                                        <td class="text-center">
                                            <span class="badge badge-primary">Paid</span>
                                        </td>

                                        <td class="text-right">
                                            <div class="dropdown">
                                                <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl"
                                                    type="button" id="d350ad" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="d350ad">
                                                        <a class="dropdown-item" href="#">View</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Detele</a>
                                                    </div>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            neha******@gmail.com
                                        </td>

                                        <td>
                                            3
                                        </td>

                                        <td>
                                            $1685.23
                                        </td>

                                        <td class="text-right">
                                            2019-12-30 10:10:10 AM
                                        </td>

                                        <td class="text-center">
                                            <span class="badge badge-success">Shipped</span>
                                        </td>

                                        <td class="text-right">
                                            <div class="dropdown">
                                                <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl"
                                                    type="button" id="d350ad" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="d350ad">
                                                        <a class="dropdown-item" href="#">View</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Detele</a>
                                                    </div>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            neha******@gmail.com
                                        </td>

                                        <td>
                                            3
                                        </td>

                                        <td>
                                            $1685.23
                                        </td>

                                        <td class="text-right">
                                            2019-12-30 10:10:10 AM
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-info">Shipping</span>
                                        </td>

                                        <td class="text-right">
                                            <div class="dropdown">
                                                <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl"
                                                    type="button" id="d350ad" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="d350ad">
                                                        <a class="dropdown-item" href="#">View</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Detele</a>
                                                    </div>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            neha******@gmail.com
                                        </td>

                                        <td>
                                            3
                                        </td>

                                        <td>
                                            $1685.23
                                        </td>

                                        <td class="text-right">
                                            2019-12-30 10:10:10 AM
                                        </td>

                                        <td class="text-center">
                                            <span class="badge badge-danger">Cancel</span>
                                        </td>

                                        <td class="text-right">
                                            <div class="dropdown">
                                                <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl"
                                                    type="button" id="d350ad" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="d350ad">
                                                        <a class="dropdown-item" href="#">View</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Detele</a>
                                                    </div>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            neha******@gmail.com
                                        </td>

                                        <td>
                                            3
                                        </td>

                                        <td>
                                            $1685.23
                                        </td>
                                        <td class="text-right">
                                            2019-12-30 10:10:10 AM
                                        </td>

                                        <td class="text-center">
                                            <span class="badge badge-warning">Delay</span>
                                        </td>

                                        <td class="text-right">
                                            <div class="dropdown">
                                                <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl"
                                                    type="button" id="d350ad" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="d350ad">
                                                        <a class="dropdown-item" href="#">View</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Detele</a>
                                                    </div>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            neha******@gmail.com
                                        </td>

                                        <td>
                                            3
                                        </td>

                                        <td>
                                            $1685.23
                                        </td>
                                        <td class="text-right">
                                            2019-12-30 10:10:10 AM
                                        </td>

                                        <td class="text-center">
                                            <span class="badge badge-success">Shipped</span>
                                        </td>

                                        <td class="text-right">
                                            <div class="dropdown">
                                                <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl"
                                                    type="button" id="d350ad" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="d350ad">
                                                        <a class="dropdown-item" href="#">View</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Detele</a>
                                                    </div>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


                <div class="col-lg-4 col-md-12">

                    <div class="card">
                        <div class="card-header bg-transparent py-15">ຜູ້​ໃຊ້​ງານ​ລ່າ​ສຸດ</div>

                        <div class="card-body">
                            <div class="form-group">
                                <div class="media">
                                    <a href="javascript://" class="avatar avatar-lg mr-20">
                                        <img src="https://i.imgur.com/Y7cK0Jg.png">
                                    </a>
                                    <div class="media-body">
                                        <div class="float-right mt-10">
                                            <button class="btn btn-outline-primary btn-sm">Chat</button>
                                        </div>
                                        <h6 class="my-3">Vlastimil Kočvara</h6>
                                        <small class="text-muted">vla*****@gmail.com</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="media">
                                    <a href="javascript://" class="avatar avatar-lg mr-20">
                                        <img src="https://i.imgur.com/urMsIe0.png">
                                    </a>
                                    <div class="media-body">
                                        <div class="float-right mt-10">
                                            <button class="btn btn-outline-primary btn-sm">Chat</button>
                                        </div>
                                        <h6 class="my-3">Kurt L. Oliver</h6>
                                        <small class="text-muted">kurt*****@gmail.com</small>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="media">
                                    <a href="javascript://" class="avatar avatar-lg mr-20">
                                        <img src="https://i.imgur.com/Y7cK0Jg.png">
                                    </a>
                                    <div class="media-body">
                                        <div class="float-right mt-10">
                                            <button class="btn btn-outline-primary btn-sm">Chat</button>
                                        </div>
                                        <h6 class="my-3">Kevin D. Shirley</h6>
                                        <small class="text-muted">kev*****@gmail.com</small>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="media">
                                    <a href="javascript://" class="avatar avatar-lg mr-20">
                                        <img src="https://i.imgur.com/mtHKlth.png">
                                    </a>
                                    <div class="media-body">
                                        <div class="float-right mt-10">
                                            <button class="btn btn-outline-primary btn-sm">Chat</button>
                                        </div>
                                        <h6 class="my-3">Ella D. Wentworth</h6>
                                        <small class="text-muted">ell*****@gmail.com</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="media">
                                    <a href="javascript://" class="avatar avatar-lg mr-20">
                                        <img src="https://i.imgur.com/sqRDrAe.png">
                                    </a>
                                    <div class="media-body">
                                        <div class="float-right mt-10">
                                            <button class="btn btn-outline-primary btn-sm">Chat</button>
                                        </div>
                                        <h6 class="my-3">Nora C. Cantin</h6>
                                        <small class="text-muted">nora*****@gmail.com</small>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>


            </div> --}}


            {{-- <div id="modal-download" tabindex="-1" role="dialog" aria-labelledby="BottomRightLabel" class="modal fade"
                aria-hidden="true">
                <div class="modal-dialog modal-bottom-right" role="document">
                    <div class="modal-content">
                        <div class="modal-body">

                            <div class="card border-0 mb-0">
                                <img class="card-img" src="https://i.imgur.com/gWYKl5Fm.png">

                                <div class="card-body">
                                    Need to download the source files?
                                </div>
                            </div>
                            <div class="form-group">
                                <a target="_blank"
                                    href="https://morioh.com/go/?f=aHR0cHM6Ly9naXRodWIuY29tL01vcmlvaC1MYWIvbW9yaW9oL2FyY2hpdmUvbWFzdGVyLnppcA=="
                                    class="btn btn-primary btn-block">
                                    Download
                                </a>
                            </div>

                        </div>

                    </div>
                </div>
            </div> --}}


        </div>

    </div>

@include('manage.layout.foot')

@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif