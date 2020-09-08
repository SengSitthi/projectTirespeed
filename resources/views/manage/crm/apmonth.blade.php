@if(isset(Auth::user()->email) && isset(Auth::user()->password))
@include('manage.layout.head')
    <div class="wrapper">

        @include('manage.layout.nav')

        @include('manage.layout.sidemenu')

        <div class="container-fluid mt-30">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-transparent py-15">
                            <h3>ນັດ​ໝາຍ​ເດືອນ​ນີ້</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-light table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ວັນ​ທີ່​ນັດ​ໝາຍ</th>
                                            <th class="text-center">ເວ​ລາ​ນັດ​ໝາຍ</th>
                                            <th class="text-center">ລະ​ຫັດ​ລູກ​ຄ້າ</th>
                                            <th class="text-center">​ຊື່ ແລະ ນາມ​ສະ​ກຸນ</th>
                                            <th class="text-center">ບ​້ານຢ​ູ່</th>
                                            <th class="text-center">ເມ​ືອງ</th>
                                            <th class="text-center">ແຂວງ</th>
                                            <th class="text-center">ເບີ​ມື​ຖື</th>
                                            <th class="text-center">ເບີ​ສຸກ​ເສີນ</th>
                                            <th class="text-center">ປະ​ເພດ​ລູກ​ຄ້າ</th>
                                            <th class="text-center">ບ່ອນ​ເຮັດ​ວຽກ</th>
                                            <th class="text-center">​ເຄີຍ​ໃຊ້​ບໍ​ລິ​ການ​ບໍ່</th>
                                            <th class="text-center">ອື່ນໆ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($appointmonth) > 0)
                                            @foreach($appointmonth as $ap)
                                            <tr>
                                                <td>{{ $ap->ap_date }}</td>
                                                <td>{{ $ap->ap_time }}</td>
                                                <td>{{ $ap->cusid }}</td>
                                                <td>{{ $ap->name }} {{ $ap->lastname }}</td>
                                                <td>{{ $ap->village }}</td>
                                                <td>{{ $ap->disname }}</td>
                                                <td>{{ $ap->proname }}</td>
                                                <td>{{ $ap->mobile }}</td>
                                                <td>{{ $ap->phone }}</td>
                                                <td>{{ $ap->tcusname }}</td>
                                                <td>{{ $ap->workaddress }}</td>
                                                <td>{{ $ap->status }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group dropleft">
                                                        <button class="btn btn-default btn-sm btn-icon btn-transparent font-xl" value="{{ $ap->carid }}" type="button" id="btnOther">
                                                            <i class="mdi mdi-dots-horizontal"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="13" class="text-center"><h3>ຍັງ​ບໍ່​ມີ​ການ​ນັດ​ໝາຍ​ມື້​ນີ້</h3></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                {{ $appointmonth->render() }}
                                <div class="modal fade" id="otherdata" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myExtraLargeModalLabel"><i class="mdi mdi-car"></i> <b>ຂໍ້​ມູນ​ລົດ</b></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="carRepair">
                                                {{-- <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <h5>ລະ​ຫັດ​ລົດ: <b></b></h5>
                                                                <h5>ປ້າຍ​ລົດ: <b></b></h5>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h5>ຍີ່​ຫໍ້​ລົດ: <b></b></h5>
                                                                <h5>ລຸ້ນ: <b></b></h5>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h5>ປີ​ຜະ​ລິດ: <b></b></h5>
                                                                <h5>ສີລົດ: <b></b></h5>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h5>​ເລກ​ກົງ​ເຕີ: <b></b></h5>
                                                                <h5>ປະ​ເພດ​ເຄື່ອງ​ຈັກ: <b></b></h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4 class="modal-title" id="myExtraLargeModalLabel"><i class="mdi mdi-car"></i> <b>ລາຍ​ການ​ສ້ອມ</b></h4>
                                                        <ul>
                                                            <li>a</li>
                                                        </ul>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@include('manage.layout.foot')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
            }
        });
        $('body').on('click', '#btnOther', function(){
            var carid = $(this).val();
            // alert(carid);
            $.ajax({
                url: '/loadapmonth/'+carid,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    // console.log(data.result);
                    $('#carRepair').html(data.result);
                    $('#otherdata').modal('show');
                }, error: function(data){
                    console.log('Error: '+data);
                }
            });
        });
    })
</script>
@else
    <meta http-equiv="refresh" content="0; url={{ url('login')}}">
@endif