$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var i = 1;
  $('#btnAddcount').click(function(){
    i++;
    $('#addaccount').append('<tr id="row'+i+'">'
    +'<td><input class="form-control" type="text" name="bankname[]" id="bankname" value=""></td>'
    +'<td><input class="form-control" type="text" name="account_num[]" id="account_num" value=""></td>'
    +'<td><button class="btn btn-danger btn_remove" type="button" id="'+i+'"><i class="mdi mdi-minus"></i></button></td>'
    +'</tr>');
  });
  $('body').on('click', '.btn_remove', function(){
    var id = $(this).attr("id");
    $("#row"+id+"").remove();
  });

  $('body').on('change', '#proid', function(){
    var proid = $(this).val();
    $.ajax({
      url: '/selectProvince',
      type: 'POST',
      data: {proid:proid},
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#disid').html(data.result);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  });

  // radio disabled bank name and account num
  $('body').on('change', '#addaccount0', function(){
    $('#bankname').prop('disabled', true);
    $('#account_num').prop('disabled', true);
    $('#btnAddcount').prop('disabled', true);
  });
  $('body').on('change', '#addaccount1', function(){
    $('#bankname').prop('disabled', false);
    $('#account_num').prop('disabled', false);
    $('#btnAddcount').prop('disabled', false);
  });
});