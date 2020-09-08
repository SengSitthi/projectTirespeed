$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('#receive_date').bootstrapMaterialDatePicker
    ({
      time: false,
      clearButton: true
    });

    // file pdf change
  $('body').on('change', '#filepdf', function(){
    var fileName = $('#filepdf')[0].files[0].name;
    $('#showfilename').text(fileName);
  });

    // function add row detail
    var i = 1;
    $('#addrow').click(function(){
      i++;
      $('#receive_detail').append('<tr id="row'+i+'">'
      +'<td><input class="form-control search" type="text" name="sparesid[]" id="'+i+'" maxlength="13" required placeholder="ລະ​ຫັດ​ອະ​ໄຫຼ່....."></td>'
      +'<td><input class="form-control" type="text" name="sparesname[]" id="sparesname'+i+'" required placeholder="ຊື່ອະ​ໄຫຼ່....." readonly></td>'
      +'<td><input type="hidden" name="brandspareid[]" id="brandspareid'+i+'" value=""><input class="form-control" type="text" name="brandsparename[]" id="brandsparename'+i+'" value="" readonly></td>'
      +'<td><input type="text" name="model[]" id="model'+i+'" class="form-control" readonly></td>'
      +'<td><input class="form-control" type="text" name="madeyear[]" id="madeyear'+i+'" readonly></td>'
      +'<td><input type="number" name="receiveqty[]" id="receiveqty'+i+'" class="form-control receiveqty" value="0"></td>'
      +'<td><input type="number" name="price[]" id="price'+i+'" class="form-control price" value="0"></td>'
      +'<td><input type="hidden" name="unitid[]" id="unitid'+i+'"><input class="form-control" type="text" name="unitname[]" id="unitname'+i+'" readonly></td>'
      +'<td><input type="number" name="total[]" id="total'+i+'" class="form-control" value="0" required readonly></td>'
      +'<td><textarea name="remark[]" id="remark'+i+'" rows="1">.</textarea></td>'
      +'<td><button class="btn btn-danger btn_removerow" type="button" id="'+i+'"><i class="mdi mdi-minus"></i></button></td>'
      +'</tr>');
    });
    $(document).on('click', '.btn_removerow', function(){
      var button_id = $(this).attr("id");
      $("#row"+button_id+"").remove();
    });

    // search spare
    $('body').on('keyup', '.search', function(){
      var id = $(this).attr("id");
      var sparesid = $(this).val();
      var orderid = $('#orderid').val();
    
      if(sparesid.length == 13){
        $.ajax({
          url: '/searchOrderlist',
          type: 'POST',
          data: {sparesid:sparesid,orderid:orderid},
          dataType: 'json',
          success: function(data){
            $('#sparesname'+id).val(data.sparesname);
            $('#brandspareid'+id).val(data.brandspareid);
            $('#brandsparename'+id).val(data.brandsparename);
            $('#model'+id).val(data.model);
            $('#madeyear'+id).val(data.madeyear);
            $('#unitid'+id).val(data.unitid);
            $('#unitname'+id).val(data.unitname);
            // console.log(data);
          }, error: function(data){
            console.log('Error: ' + data);
          }
        });
      }else if(sparesid.length == 12){
        $.ajax({
          url: '/searchOrderlist',
          type: 'POST',
          data: {sparesid:sparesid,orderid:orderid},
          dataType: 'json',
          success: function(data){
            $('#sparesname'+id).val(data.sparesname);
            $('#brandspareid'+id).val(data.brandspareid);
            $('#brandsparename'+id).val(data.brandsparename);
            $('#model'+id).val(data.model);
            $('#madeyear'+id).val(data.madeyear);
            $('#unitid'+id).val(data.unitid);
            $('#unitname'+id).val(data.unitname);
            // console.log(data);
          }, error: function(data){
            console.log('Error: ' + data);
          }
        });
      }else{
        $('#sparesname'+id).val("");
        $('#brandspareid'+id).val("");
        $('#brandsparename'+id).val("");
        $('#model'+id).val("");
        $('#madeyear'+id).val("");
        $('#receiveqty'+id).val("0");
        $('#unitid'+id).val("");
        $('#unitname'+id).val("");
        $('#total'+id).val("0");
      }
    });

    // receive qty keyup amount
    $('body').on('keyup', '.receiveqty', function(){
      var textid = $(this).attr("id");
      var idnum = textid.substring(10, 11);
      var qty = $(this).val();
      if(qty === ""){
        $('#total'+idnum).val("0");
      }else{
        var price = $('#price'+idnum).val();
        var total = price * qty;
        $('#total'+idnum).val(total);
      }
    });

    // receive price keyup
    $('body').on('keyup', '.price', function(){
      var textid = $(this).attr("id");
      var idnum = textid.substring(5, 6);
      var price = $(this).val();
      
      if(price === ""){
        $('#total'+idnum).val("0");
      }else{
        var qty = $('#receiveqty'+idnum).val();
        var total = price * qty;
        $('#total'+idnum).val(total);
      }
    });
});