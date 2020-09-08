$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  ////// Random Password //////
  function randomCode() {
    var chars = "1234567890";
    var pass = "";
    var length = 12;
    for (var x = 0; x < length; x++) {
        var i = Math.floor(Math.random() * chars.length);
        pass += chars.charAt(i);
    }
    return pass;
  }

  ///// button generate code ///////
  $('#randomcode').click(function(){
    var code = randomCode();
    $('#sparesid').val(8+code);
  });

  // barcode radio button
  $('body').on('change', '#createbarcode', function(){
    $('#barcodeqty').prop('disabled', false);
  });

  $('body').on('change', '#createbarcode1', function(){
    $('#barcodeqty').prop('disabled', true);
  });

  // change typeservice to select type spare
  $('body').on('change', '#typeserviceid', function(){
    var typeserviceid = $(this).val();
    if(typeserviceid === ""){

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

  // change type spare to select brand spare
  // $('body').on('change', '#typesparesid', function(){
  //   var typesparesid = $(this).val();
  //   if(typesparesid === ""){

  //   }else{
  //     $.ajax({
  //       url: '/selectBrandspare',
  //       type: 'POST',
  //       data: {typesparesid:typesparesid},
  //       dataType: 'json',
  //       success: function(data){
  //         // console.log(data);
  //         $('#brandspareid').html(data.result);
  //       }, error: function(data){
  //         console.log('Error: ' + data);
  //       }
  //     });
  //   }
  // });

});