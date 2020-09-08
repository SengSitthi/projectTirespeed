$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#cusid').select2();
    loadCars();
    function loadCars(query=''){
        $.ajax({
            url: '/loadCars',
            type: 'GET',
            data: {query:query},
            dataType: 'json',
            success: function(data){
                $('#selectcar').html(data.result);
                // console.log(data.result);
            }, error: function(data){
                console.log(data);
            }
        });
    }
    $('body').on('change', '#cusid', function(){
        var query = $(this).val();
        if(query === ''){
            $('#selectcar').html('<option value="">*** ກະ​ລຸ​ນາເລືອກ​ເຈົ້າ​ຂອງ​ລົດກ່ອນ ***</option>');
            $('#selectcar').prop('disabled', true);
            $('#addnewcar').hide();
            $('#timedate').hide();
        }else{
            $('#selectcar').prop('disabled', false);
            loadCars(query);
        }
    });

    $('body').on('change', '#selectcar', function(){
        var optionselect = $(this).val();
        if(optionselect === 'newcar'){
            $('#addnewcar').show();
            $('#timedate').show();
        }else if(optionselect === ''){
            $('#addnewcar').hide();
            $('#timedate').hide();
        }else{
            $('#addnewcar').hide();
            $('#timedate').show();
        }
    });

    var i = 1;
    $('#add').click(function(){
        i++;
        $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" class="form-control" name="repair[]" id="repair" placeholder="Enter list for repair..." required>'
            +'</td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove"><span class="mdi mdi-trash-can"></span></button></td></tr>');
    });
    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");
        $("#row"+button_id+"").remove();
    });

    // time and date input for appointment
    $('#ap_time').bootstrapMaterialDatePicker
    ({
        date: false,
        clearButton: true,
        shortTime: false,
        format: 'HH:mm'
    });

    $('#ap_date').bootstrapMaterialDatePicker
    ({
        time: false,
        clearButton: true
    });

    $('[data-toggle="tooltip"]').tooltip();
});