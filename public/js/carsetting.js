$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('body').on('click', '#btnEdit', function(){
        var carid = $(this).val();
        $.ajax({
            url: '/loadCartoEdit/' + carid,
            type: 'GET',
            dataType: 'json',
            success: function(data){
                // console.log(data);
                $('#carid').val(data.id);
                $('#license').val(data.license);
                $('#motornum').val(data.motornum);
                $('#bodynum').val(data.bodynum);
                // $('#province').val(data.province);
                $('#brandid option[value="'+data.brandid+'"]').prop('selected', true);
                $('#model').val(data.model);
                $('#madeyear').val(data.madeyear);
                $('#color').val(data.color);
                $('#distance').val(data.distance);
                $('#motor option[value="'+data.motor+'"]').prop('selected', true);
                $('#modaledit').modal('show');
            }, error: function(data){
                console.log(data);
            }
        });
        // $('#modaledit').modal('show');
    });
    
});