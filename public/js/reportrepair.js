$(document).ready(function(){
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKE': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //function show car
    function loadRepairCars(query = ''){
        $.ajax({
            url: "/loadRepairCars",
            type: 'POST',
            data: {query:query},
            dataType: 'json',
            success: function(data){
                // console.log(data.result);
                $('#carid').html(data.result);
            }, error: function(data){
                console.log('Error: '+data);
            }
        });
    }
    $('body').on('change', '#cusid', function(){
        var query = $(this).val();
        loadRepairCars(query);
    });
    // function show repair date
    function loadRepairDate(cusid='',carid=''){
        $.ajax({
            url: "/loadRepairDate",
            type: 'POST',
            data: {cusid:cusid,carid:carid},
            dataType: 'json',
            success: function(data){
                // console.log(data);
                $('#datelist').html(data.result);
            }, error: function(data){
                console.log('Error: '+data);
            }
        });
    }

    $('body').on('change', '#carid', function(){
        var carid = $(this).val();
        var cusid = $('#cusid').val();
        loadRepairDate(cusid, carid);
    });

    // function show customer, car and repair list
    $('body').on('change', '#datelist', function(){
        var datelist = $(this).val();
        var cusid = $('#cusid').val();
        var carid = $('#carid').val();
        $.ajax({
            url: "/loadRepairData",
            type: 'POST',
            data: {datelist:datelist,cusid:cusid,carid:carid},
            dataType: 'json',
            success: function(data){
                // console.log(data);
                $('#showcusid').html(data.cusid);
                $('#showname').html(data.name);
                $('#showaddress').html(data.village+", "+data.disname+", "+data.proname);
                $('#showcarid').html(data.carid);
                $('#showlicense').html(data.license);
                $('#showbrand').html(data.brand);
                $('#showmodel').html(data.model);
                $('#showlist').html(data.list);
            }, error: function(data){
                console.log('Error: '+data);
            }
        })
    });
});