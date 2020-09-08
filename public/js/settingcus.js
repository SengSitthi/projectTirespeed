$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#birthday').bootstrapMaterialDatePicker({
        // format: 'DD/MM/YYYY',
        time: false,
        clearButton: true
    });
    $('body').on('click', '#btnEdit', function(){
        var cusid = $(this).val();
        $.ajax({
            url: '/loadcusedit/'+cusid,
            type: 'GET',
            dataType: 'json',
            success: function(data){
                $('#cusid').val(data.cusid);
                $('#cusname').val(data.name);
                $('#lastname').val(data.lastname);
                // $('#birthday').val(data.birthday);
                $('#village').val(data.village);
                $('#proid option[value="'+data.proid+'"]').prop("selected", true);
                $('#disid option[value="'+data.disid+'"]').prop("selected", true);
                $('#mobile').val(data.mobile);
                $('#phone').val(data.phone);
                $('#occupation').val(data.occupation);
                $('#workadd').val(data.workaddress);
                $('.w3-radio[value="'+data.status+'"]').prop('checked', true);
                $('#tcusid option[value="'+data.tcusid+'"]').prop("selected", true);
            }, error: function(data){
                console.log('Error: ' +data);
            }
        })
        $('#editmodal').modal('show');
    });

    $('body').on('click', '#btnDel', function(){
        var cusid = $(this).val();
        // alert(cusid);
        $.ajax({
            url: '/delcustomer/'+cusid,
            type: 'GET',
            dataType: 'json',
            success: function(data){

            },error: function(data){
                console.log('Error: '+data);
            }
        });
    });

    getDistrict();
    function getDistrict(query = ''){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
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
        if(query != ""){
            $('#disid').prop('disabled', false);
            getDistrict(query);
        }else{
            $('#disid').prop('disabled', true);
        }
    });

    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});