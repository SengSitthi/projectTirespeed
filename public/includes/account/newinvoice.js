$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  
  //function load quotations
  
  
  $('body').on('change', '#expire_date', function(){
    var enddate = $(this).val();
    var expiredate = new Date(enddate);
    var ddate = $('#invoice_date').val();
    var start = new Date(ddate);
    var caltime = expiredate.getTime() - start.getTime();
    var countday = caltime / (1000 * 3600 * 24);
    $('#credit').val(countday);
  });
  
  $('#expire_date').bootstrapMaterialDatePicker({
    time: false,
    clearButton: true
  });
  $('#invoice_date').bootstrapMaterialDatePicker({
    time: false,
    clearButton: true
  });

  $("#cpid").select2();
  $("#qtid").select2();
});