$(document).ready(function(){
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('body').on('change', '#stylereport', function(){
        var style = $(this).val();
        if(style == "1"){
            $('#cusdiv').hide();
            $('#datediv').hide();
            $('#btnPrintReport').prop('disabled', false);
            $.ajax({
                url: "/reportAppointToday",
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    // console.log(data);
                    $('#showdata').html(data.result);
                    $('#showcount').html(data.count);
                }, error: function(data){
                    console.log('Error: '+data);
                }
            });
        }else if(style == "2"){
            $('#cusdiv').hide();
            $('#datediv').hide();
            $('#btnPrintReport').prop('disabled', false);
            $.ajax({
                url: "/reportAppointMonth",
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    // console.log(data);
                    $('#showdata').html(data.result);
                    $('#showcount').html(data.count);
                }, error: function(data){
                    console.log('Error: '+data);
                }
            });
        }else if(style == "3"){
            $('#cusdiv').show();
            $('#showdata').html('');
            $('#showcount').html('');
            $('#datediv').hide();
            $('#btnPrintReport').prop('disabled', true);
        }else if(style == "4"){
            $('#cusdiv').hide();
            $('#showdata').html('');
            $('#showcount').html('');
            $('#datediv').show();
            $('#btnPrintReport').prop('disabled', true);
        }else{
            $('#cusdiv').hide();
            $('#datediv').hide();
            $('#btnPrintReport').prop('disabled', true);
            $('#showdata').html('');
            $('#showcount').html('');
        }
    });

    // function to show appointment of customer
    $('body').on('change', '#cusid', function(){
        var cusid = $(this).val(); 
        if(cusid != ""){
            $.ajax({
                url: "/reportAppCus",
                type: 'POST',
                data: {cusid:cusid},
                dataType: 'json',
                success: function(data){
                    // console.log(data);
                    $('#showdata').html(data.result);
                    $('#showcount').html(data.count);
                    $('#btnPrintReport').prop('disabled', false);
                }, error: function(data){
                    console.log('Error: '+data);
                }
            })
        }else{
            $('#cusdiv').show();
            $('#showdata').html('');
            $('#showcount').html('');
            $('#datediv').hide();
            $('#btnPrintReport').prop('disabled', true);
        }
    });

    $('body').on('change', '#month', function(){
        var month = $(this).val();
        if(month === ""){
            $('#showdata').html('');
            $('#showcount').html('');
            $('#year').prop('disabled', true);
            $('#year option[value=""]').prop('selected', true);
        }else{
            $('#year').prop('disabled', false);
        }
    });

    $('body').on('change', '#year', function(){
        var month = $('#month').val();
        var year = $(this).val();
        if(month === "" && year === ""){
            $('#showdata').html('');
            $('#showcount').html('');
        }else{
            $.ajax({
                url: "/reportAppByMonth",
                type: 'POST',
                data: {month:month,year:year},
                dataType: 'json',
                success: function(data){
                    // console.log(data);
                    $('#showdata').html(data.result);
                    $('#showcount').html(data.count);
                    $('#btnPrintReport').prop('disabled', false);
                }, error: function(data){
                    console.log('Error: '+data);
                }
            })
        }
    });

});