$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  // change typeservice to select type spare
  $('body').on('change', '#typeserviceid', function(){
    var typeserviceid = $(this).val();
    if(typeserviceid === ""){
      $('#typesparesid').html('<option value="">ກະ​ລຸ​ນາ​ເລືອກ​ປະ​ເພດ​ການ​ບໍ​ລິ​ການ​ກ່ອນ</option>');
    }else{
      $.ajax({
        url: '/selectTypeservice',
        type: 'POST',
        data: {typeserviceid:typeserviceid},
        dataType: 'json',
        success: function(data){
          // console.log(data);
          $('#typesparesid').html(data.result);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      })
    }
  });
});