$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  getDistrict();
  function getDistrict(query = ''){
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

  $('body').on('change', '#proid', function(){
    var query = $(this).val();
    if(query != ""){
      $('#disid').prop('disabled', false);
      getDistrict(query);
    }else{
      $('#disid').prop('disabled', true);
    }
  });

  setTimeout(function(){
    $('.amaran-wrapper').fadeOut();
  }, 3500);
});