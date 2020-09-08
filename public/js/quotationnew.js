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

    $('#cusid').select2();

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
    
    // function add row detail
    var i = 1;
    $('#addrow').click(function(){
      i++;
      $('#quotation_detail').append('<tr id="row'+i+'">'
      +'<td><input class="form-control sparesid" type="number" name="sparesid[]" id="sparesid'+i+'" maxlength="13" placeholder="ຄົ້ນ​ຫາ​ລະ​ຫັດ"></td>'
      +'<td><input class="form-control" type="text" name="sparesname[]" id="sparesname'+i+'" readonly></td>'
      +'<td><input class="form-control" type="text" name="unitname[]" id="unitname'+i+'" readonly></td>'
      +'<td><input class="form-control qty" type="number" name="qty[]" id="qty'+i+'"></td>'
      +'<td><input class="form-control" type="text" name="price[]" id="price'+i+'" readonly></td>'
      +'<td><input class="form-control" type="number" name="wages[]" id="wages'+i+'"></td>'
      +'<td><input class="form-control" type="text" name="total[]" id="total'+i+'" value="0" readonly></td>'
      +'<td><button class="btn btn-danger btn_removerow" type="button" id="'+i+'"><i class="mdi mdi-minus"></i></button></td>'
      +'</tr>');
    });

    $(document).on('click', '.btn_removerow', function(){
      var button_id = $(this).attr("id");
      $("#row"+button_id+"").remove();
    });

  $('body').on('keyup', '.sparesid', function(){
    var textid = $(this).attr("id");
    var id = textid.substring(8, 10);
    var sparesid = $(this).val();
    // alert(id);
    if(sparesid.length === 13){
      $.ajax({
        url: '/loadSparetoQT',
        type: 'POST',
        data: {sparesid:sparesid},
        dataType: 'json',
        success: function(data){
          console.log(data);
          $('#sparesname'+id).val(data.sparesname);
          $('#price'+id).val(data.sellprice);
          $('#unitname'+id).val(data.unitname);
          // $('#qty'+id).focus();
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }else if(sparesid.length === 12){
      $.ajax({
        url: '/loadSparetoQT',
        type: 'POST',
        data: {sparesid:sparesid},
        dataType: 'json',
        success: function(data){
          console.log(data);
          $('#sparesname'+id).val(data.sparesname);
          $('#price'+id).val(data.sellprice);
          $('#unitname'+id).val(data.unitname);
          // $('#qty'+id).focus();
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }else{
      $('#sparesname'+id).val("");
      $('#price'+id).val("");
      $('#unitname'+id).val("");
    }
  });

  $('body').on('keyup', '.qty', function(){
    var textid = $(this).attr("id");
    var id = textid.substring(3, 5);
    var qty = $(this).val();
    var price = $('#price'+id).val();
    $('#total'+id).val(price*qty);
  });

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