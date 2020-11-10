$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })
  $('#checkin_date').bootstrapMaterialDatePicker
    ({
        time: false,
        clearButton: true
    });
  $('#checkin_time').bootstrapMaterialDatePicker
    ({
        date: false,
        clearButton: true,
        shortTime: false,
        format: 'HH:mm'
    });

  $('#checkout_date').bootstrapMaterialDatePicker
    ({
        time: false,
        clearButton: true
    });
  $('#checkout_time').bootstrapMaterialDatePicker
    ({
        date: false,
        clearButton: true,
        shortTime: false,
        format: 'HH:mm'
    });
    $('#expire_date').bootstrapMaterialDatePicker
    ({
        time: false,
        clearButton: true
    });
  $('#document_date').bootstrapMaterialDatePicker
    ({
        time: false,
        clearButton: true
    });


  // function to show repairbill detail on new quotation
  $('body').on('change', '#rpbid', function(){
    var rpbid = $(this).val();
    if(rpbid === ""){

    }else{
      $.ajax({
        url: '/getrpbdetaildata',
        type: 'POST',
        data: {rpbid:rpbid},
        dataType: 'json',
        success: function(data){
          // console.log(data);
          $('#showrpbdetail').html(data.result);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }
  });

  $('#rpbid').select2();

  // $('body').on('keyup', '.qty', function(){
  //   var textid = $(this).attr("id");
  //   var id = textid.substring(3, 5);
  //   var qty = $(this).val();
  //   var price = $('#price'+id).val();
  //   $('#total'+id).val(price*qty);
  // });

  $('body').on('change', '#expire_date', function(){
    var enddate = $(this).val();
    var expiredate = new Date(enddate);
    var ddate = $('#document_date').val();
    var start = new Date(ddate);
    var caltime = expiredate.getTime() - start.getTime();
    var countday = caltime / (1000 * 3600 * 24);
    $('#credit_day').val(countday);
  });

  setTimeout(function(){
    $('.amaran-wrapper').fadeOut();
  }, 3500);
})