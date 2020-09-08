$(document).ready(function(){
    $('#birthday').bootstrapMaterialDatePicker({
        time: false,
        clearButton: true
    });
    getDistrict();
    function getDistrict(query = ''){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/loadDistrict',
            type: 'GET',
            data: {query:query},
            dataType: 'json',
            success: function(data){
                $('#disid').html(data.dis_data);
            }, error: function(data){
                console.log('Error: '+data);
            }
        });
    }

    $('body').on('change', '#proid', function(){
        var query = $(this).val();
        getDistrict(query);
    });
});