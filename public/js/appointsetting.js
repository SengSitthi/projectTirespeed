$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#searchlist").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#applist tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    
    $('#ap_date').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
    $('#ap_time').bootstrapMaterialDatePicker
    ({
        date: false,
        clearButton: true,
        shortTime: false,
        format: 'HH:mm'
    });
    // function get data to edit
    $('body').on('click', '#btnEdit', function(){
        var apid = $(this).val();
        $.ajax({
            url: '/getAppointment/'+apid,
            type: 'GET',
            dataType: 'json',
            success: function(data){
                // console.log(data);
                $('#apid').val(apid);
                $('#cusid').val(data.cusid);
                $('#carid').val(data.carid);
                $('#ap_date').val(data.date);
                $('#olddate').val(data.date);
                $('#ap_time').val(data.time);
                $('#modalEdit').modal('show');
            }, error: function(data){
                console.log('Error: '+data);
            }
        });
    });
});