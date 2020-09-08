$(document).ready(function(){
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('body').on('change', '#reportstyle', function(){
        var mystyle = $(this).val();
        if(mystyle === "1"){
            $('#divcusid').hide();
            $('#divbrandid').hide();
            $('#btnPrint').prop('disabled', false);
            $.ajax({
                url: "/loadAllcars",
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    // console.log(data);
                    $('#showdata').html(data.result);
                    $('#showcount').html(data.count);
                    $('#showdata').show();
                    $('#showcount').show();
                }, error: function(data){
                    console.log('Error: ' +data);
                }
            });
        }else if(mystyle === "2"){
            $('#divcusid').show();
            $('#divbrandid').hide();
            $('#btnPrint').prop('disabled', true);
            $('#showdata').hide();
            $('#showcount').hide();
        }else if(mystyle === "3"){
            $('#divcusid').hide();
            $('#divbrandid').show();
            $('#btnPrint').prop('disabled', true);
            $('#showdata').hide();
            $('#showcount').hide();
        }else{
            $('#divcusid').hide();
            $('#divbrandid').hide();
            $('#btnPrint').prop('disabled', true);
            $('#showdata').hide();
            $('#showcount').hide();
        }
    });
    $('body').on('change', '#cusid', function(){
        var cusid = $(this).val();
        $.ajax({
            url: "/loadCuscars",
            type: 'POST',
            data: {cusid:cusid},
            dataType: 'json',
            success: function(data){
                // console.log(data);
                $('#showdata').html(data.result);
                $('#showcount').html(data.count);
                $('#showdata').show();
                $('#showcount').show();
                $('#btnPrint').prop('disabled', false);
            }, error: function(data){
                console.log('Error: ' +data);
            }
        });
    });

    $('body').on('change', '#brandid', function(){
        var brandid = $(this).val();
        $.ajax({
            url: "/loadBrandcar",
            type: 'POST',
            data: {brandid:brandid},
            dataType: 'json',
            success: function(data){
                // console.log(data);
                $('#showdata').html(data.result);
                $('#showcount').html(data.count);
                $('#showdata').show();
                $('#showcount').show();
                $('#btnPrint').prop('disabled', false);
            }, error: function(data){
                console.log('Error: ' +data);
            }
        });
    });
});