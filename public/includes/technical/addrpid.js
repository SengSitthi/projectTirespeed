$(document).ready(function(){
  $.ajaxSetup({
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  });

  $('body').on('change', '#typesparesid', function(){
    var typesparesid = $(this).val();
    $.ajax({
      url: '/gettypesparedt',
      type: 'POST',
      data: {typesparesid:typesparesid},
      dataType: 'json',
      success: function(data){
        $('#sparesid').html(data.result);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  });

  $('#sparesid').select2();
});