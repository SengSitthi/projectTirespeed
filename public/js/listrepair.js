$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#cusid').select2();
    $('#carid').select2();
    $('#ap_date').select2();
    function loadCars(query=''){
        $.ajax({
            url: '/loadCarsdata',
            type: 'GET',
            data: {query:query},
            dataType: 'json',
            success: function(data){
                $('#carid').html(data.result);
            //    console.log(data);
            }, error: function(data){
                console.log('Error: ' +data);
           }
        });
    }
    $('body').on('change', '#cusid', function(){
        var query = $(this).val();
        loadCars(query);
    });

    function loadAppointment(cusid = '', carid = ''){
        $.ajax({
            url: '/loadAppointment',
            type: 'GET',
            data: {cusid:cusid, carid:carid},
            dataType: 'json',
            success: function(data){
                // console.log(data);
                $('#ap_date').html(data.result);
            }, error: function(data){
                console.log('Error: ' + data);
            }
        });
    }
    $('body').on('change', '#carid', function(){
        var carid = $(this).val();
        var cusid = $('#cusid').val();
        loadAppointment(cusid, carid);
    });
    // show list repair
    function loadRepair(cusid='',carid='',datelist=''){
        $.ajax({
            url: '/loadRepair',
            type: 'GET',
            data: {cusid:cusid,carid:carid,datelist:datelist},
            dataType: 'json',
            success: function(data){
                // console.log(data.result);
                $('#showrepair').html(data.result);
            }, error: function(data){
                console.log('Error: '+data);
            }
        })
    }

    $('body').on('change', '#ap_date', function(){
        var datelist = $(this).val();
        var cusid = $('#cusid').val();
        var carid = $('#carid').val();
        // alert(listdate+'+'+cusid+'+'+carid);
        loadRepair(cusid, carid, datelist);
    });

    $('body').on('keyup', '#list', function(){
        var list = $(this).val();
        if(list === ""){
            $('#btnAddlist').prop('disabled', true);
            $('#btnEditlist').prop('disabled', true);
        }else{
            $('#btnAddlist').prop('disabled', false);
        }
    });
    
    $('body').on('click', '#btnAddlist', function(){
        var datelist = $('#ap_date').val();
        var cusid = $('#cusid').val();
        var carid = $('#carid').val();
        var list = $('#list').val();
        var status = $('#status').val();
        $.ajax({
            url: '/insertList',
            type: 'POST',
            data: {cusid:cusid,carid:carid,list:list,datelist:datelist,status:status},
            dataType: 'json',
            success: function(data){
                // console.log(data);
                fnAlert(title='ສຳ​ເລັດ', text='ການ​ເພີ່ມ​ສຳ​ເລັດ', icon='success');
                loadRepair(cusid, carid, datelist);
            }, error: function(data){
                console.log('Error: '+data);
            }
        })
    });

    $('body').on('click', '#btnEdit', function(){
        var repairid = $(this).val();
        $.ajax({
            url: '/loadRepairtoEdit/'+repairid,
            type: 'GET',
            dataType: 'json',
            success: function(data){
                $('#repairid').val(repairid);
                $('#list').val(data.list);
                $('#status option[value="'+data.status+'"]').prop('selected', true);
                $('#btnEditlist').show();
                $('#btnAddlist').hide();
                $('#Title').html('ແກ້​ໄຂ​ລາຍ​ການ​ສ້ອມ');
                $('#modalAdd').modal('show');
            }, error: function(data){
                console.log('Error: ' +data);
            }
        })
        // alert(repairid);
    });

    $('body').on('click', '#btnModalAdd', function(){
        $('#Title').html('ເພີ່ມ​ລາຍ​ການ​ສ້ອມ');
        $('#modalAdd').modal('show');
        $('#list').val("");
        $('#btnAddlist').show();
        $('#btnEditlist').hide();
    });

    // function update list repair data
    $('body').on('click', '#btnEditlist', function(){
        var repairid = $('#repairid').val();
        var cusid = $('#cusid').val();
        var carid = $('#carid').val();
        var list = $('#list').val();
        var status = $('#status').val();
        var datelist = $('#ap_date').val();
        // alert(repairid+'+'+cusid+'+'+carid+'+'+list+'+'+status+'+'+datelist);
        $.ajax({
            url: '/updateRepairlist',
            type: 'POST',
            data:{repairid:repairid,list:list,status:status},
            dataType: 'json',
            success: function(data){
                fnAlert(title='ສຳ​ເລັດ', text='ການ​ແກ້​ໄຂ​ຂໍ້​ມູນ​ສຳ​ເລັດ', icon='success');
                loadRepair(cusid, carid, datelist);
                $('#modalAdd').modal('hide');
            },error: function(data){
                console.log('Error: '+data);
            }
        })
    });

    // function delete repair list
    $('body').on('click', '#btnDel', function(){
        var repairid = $(this).val();
        var cusid = $('#cusid').val();
        var carid = $('#carid').val();
        var datelist = $('#ap_date').val();
        swal({
            title: "ທ່ານ​ໝັ່ນ​ໃຈ​ຕ້ອງ​ການ​ລຶບ​ແທ້​ບໍ່?",
            text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
            icon: "warning",
            buttons: "ຕົກ​ລົງ",
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/deleteRepair/'+repairid,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        // console.log(data);
                        fnAlert(title='ສຳ​ເລັດ', text=data, icon='success');
                        loadRepair(cusid, carid, datelist);
                    }, error: function(data){
                        console.log('Error: '+data);
                    }
                });
            } else {
                // swal("Your imaginary file is safe!");
                swal("ການ​​ລຶບ​ຖືກ​ຍົກ​ເລີກ", {
                    icon: "error",
                    button:false,
                    timer:2000
                });
            }
        });
    });

    function fnAlert(title='', text='', icon=''){
        swal({
            title: title,
            text: text,
            icon: icon,
            button: false,
            timer: 2500
        });
    }
});