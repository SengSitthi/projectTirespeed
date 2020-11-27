$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  
  // function to get invoice data
  $('body').on('change', '#invoiceid', function(){
    var invoiceid = $(this).val();
    $.ajax({
      url: '/loadInvoicedata',
      type: 'POST',
      data: {invoiceid:invoiceid},
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#invoice_date').val(data.invoice_date);
        $('#receipt_detail').html(data.result);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
  });

  $('#invoiceid').select2();
  $('#receipt_date').bootstrapMaterialDatePicker({
    time: false,
    clearButton: true
  });
});