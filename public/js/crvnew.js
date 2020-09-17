$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('#date_receive').bootstrapMaterialDatePicker({ time: false, clearButton: true });
  $('#time_receive').bootstrapMaterialDatePicker({ date: false, clearButton: true, shortTime: false, format: 'HH:mm'});
  $('#date_checked').bootstrapMaterialDatePicker({ time: false, clearButton: true });
  $('#time_checked').bootstrapMaterialDatePicker({ date: false, clearButton: true, shortTime: false, format: 'HH:mm'});
  $('#cusid').select2();
  $('#appoint_no').select2();
  
  // show customer car after selected customer
  $('body').on('change', '#cusid', function(){
    var cusid = $(this).val();
    $.ajax({
      url: "/getCuscar",
      type: 'POST',
      data: {cusid:cusid},
      dataType: 'json',
      success: function(data){
        $('#carid').html(data.result);
      }, error: function(data){
        console.log('Error: ' +data);
      }
    });
  });
})