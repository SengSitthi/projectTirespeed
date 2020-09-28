$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('#date_receive').bootstrapMaterialDatePicker({ time: false, clearButton: true });
  $('#time_receive').bootstrapMaterialDatePicker({ date: false, clearButton: true, shortTime: false, format: 'HH:mm'});
  $('#cusid').select2();
  
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

  // function add row other_repair
  var i = 1;
  $('#btnAddrow').click(function(){
    i++;
    $('#other_repair').append('<tr id="row'+i+'">'
    +'<td><input class="form-control" type="text" name="repairlist[]" id="repairlist" placeholder="ລາຍ​ການ​ສ້ອມ​ແປງ​ອື່ນໆ..."></td>'
    +'<td><button class="btn btn-danger btnRemove" type="button" id="'+i+'"><i class="mdi mdi-trash-can"></i></button></td>'
    +'</tr>');
  });

  // remove row other_repair
  $(document).on('click', '.btnRemove', function(){
    var btnid = $(this).attr("id");
    $("#row"+btnid+"").remove();
  });

  $('body').on('change', '#rp_other', function(){
    var data = $(this).val();
    if(data === "yes"){
      $('#showother_repair').show();
    }else{
      $('#showother_repair').hide();
    }
  });
})