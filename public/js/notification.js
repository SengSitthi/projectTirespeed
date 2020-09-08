$(document).ready(function(){


    $('body').on('click', '#btnNoti', function(){
        $('#modal-slide-right').modal('show');
    });

    window.setInterval(function(){
        shownotification();
    }, 3000000);
    shownotification();
    function shownotification(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/loadNotification',
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                $('#shownavnoti').html(data.countnoti);
                $('#showcountnoti').html(data.countnoti);
                $('#shownotification').html(data.datanoti);
                // console.log(data);
            }, error: function(data){
                console.log('Error: ' + data);
            }
        });
    }

});