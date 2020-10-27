$(document).ready(function(){
  $.ajaxSetup({
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  });

  $('#rcsid').select2();
  $('#rpbdate').bootstrapMaterialDatePicker({
    time: false,
    clearButton: true
  });

  var i = 1;
  $('#btnAddrow').click(function(){
    i++;
    $('#tbDetail').append('<tr id="row'+i+'" class="text-center">'
    +'<td><input class="form-control searchrpno" type="text" name="rpnoid[]" id="'+i+'" placeholder="ປ້ອນ​ລະ​ຫັດ​ບໍ​ລິ​ການ"></td>'
    +'<td><input class="form-control" type="text" name="sparename" id="sparename'+i+'" readonly></td>'
    +'<td><input class="form-control" type="number" name="useqty[]" id="useqty'+i+'" placeholder="#"></td>'
    +'<td><input class="form-control searchwage" type="text" name="wageid[]" id="'+i+'" placeholder="ລະ​ຫັດ​ຄ່າ​ແຮງ​ງານ"></td>'
    +'<td><input class="form-control" type="text" name="wagename" id="wagename'+i+'" placeholder="ຊື່​ແຮງ​ງານ" readonly></td>'
    +'<td><input class="form-control" type="text" name="unitrpname" id="unitrpname'+i+'" readonly></td>'
    +'<td><button class="btn btn-danger btnRemove" type="button" id="'+i+'"><i class="mdi mdi-trash-can"></i></button></td>'
    +'</tr>');
  });
  $(document).on('click', '.btnRemove', function(){
    var btnid = $(this).attr("id");
    $("#row"+btnid+"").remove();
  });

  $('body').on('keyup', '.searchrpno', function(){
    var id = $(this).attr("id");
    var textsearch = $(this).val();
    if(textsearch.length == 8){
      $.ajax({
        url: '/getsparename',
        type: 'POST',
        data: {textsearch:textsearch},
        dataType: 'json',
        success: function(data){
          // console.log(data);
          $('#sparename'+id).val(data.sparesname);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }else{
      $('#sparename'+id).val("");
    }
  });

  $('body').on('keyup', '.searchwage', function(){
    var id = $(this).attr("id");
    var textsearch = $(this).val();
    if(textsearch.length == 8){
      $.ajax({
        url: '/getwagedata',
        type: 'POST',
        data: {textsearch:textsearch},
        dataType: 'json',
        success: function(data){
          // console.log(data);
          $('#wagename'+id).val(data.wagename);
          $('#unitrpname'+id).val(data.unitrpname);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      })
    }
  });
});