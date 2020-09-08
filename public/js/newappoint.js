$(document).ready(function(){
    // $('#birthday').bootstrapMaterialDatePicker({
    //     // format: 'DD/MM/YYYY',
    //     time: false,
    //     clearButton: true
    // });

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
    if(query != ""){
      $('#disid').prop('disabled', false);
      getDistrict(query);
    }else{
      $('#disid').prop('disabled', true);
    }
  });

    /// function add row insert repair list
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