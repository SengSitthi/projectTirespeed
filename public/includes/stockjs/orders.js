$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('#order_date').bootstrapMaterialDatePicker
    ({
        time: false,
        clearButton: true
    });

    // function add row
    var i = 1;
    $('#btnAddrow').click(function(){
      i++;
      $('#order_detail').append('<tr id="row'+i+'">'
      +'<td><input class="form-control search" type="text" name="sparesid[]" id="'+i+'" placeholder="ໃສ່​ລະ​ຫັດ​ອະ​ໄຫຼ່..." required></td>'
      +'<td><input class="form-control search" type="text" name="sparesname[]" id="sparesname'+i+'" placeholder="ໃສ່​ຊື່ອະ​ໄຫຼ່..." readonly></td>'
      +'<td><input type="hidden" name="brandspareid[]" id="brandspareid'+i+'">'
      +'<input class="form-control" type="text" name="brandsparename[]" id="brandsparename'+i+'" required readonly></td>'
      +'<td><input class="form-control" type="text" name="model[]" id="model'+i+'" required readonly></td>'
      +'<td><input class="form-control" type="text" name="madeyear[]" id="madeyear'+i+'" require readonly></td>'
      +'<td><input class="form-control qty" type="number" name="orderqty[]" id="orderqty'+i+'" required></td>'
      // +'<td><input class="form-control" type="number" name="price[]" id="price'+i+'" required readonly></td>'
      +'<td><input type="hidden" name="unitid[]" id="unitid'+i+'" />'
      +'<input class="form-control" type="text" name="unitname[]" id="unitname'+i+'" readonly></td>'
      // +'<td><input class="form-control" type="text" name="total[]" id="total'+i+'" value="0" readonly required></td>'
      +'<td><button class="btn btn-danger btn_removerow" type="button" id="'+i+'"><i class="mdi mdi-minus"></i></button></td>'
      +'</tr>');
      
    });
    $(document).on('click', '.btn_removerow', function(){
      var button_id = $(this).attr("id");
      $("#row"+button_id+"").remove();
    });

    $('body').on('keyup', '.search', function(){
      var inputid = $(this).attr("id");
      var sparesid = $(this).val();
      // alert(inputid);
      if(sparesid.length == 13){
        $.ajax({
          url: '/addsparetoOrder',
          type: 'POST',
          data: {sparesid:sparesid},
          dataType: 'json',
          success: function(data){
            // console.log(data);
            $('#sparesname'+inputid).val(data.sparesname);
            $('#brandspareid'+inputid).val(data.brandspareid);
            $('#brandsparename'+inputid).val(data.brandsparename);
            $('#model'+inputid).val(data.model);
            $('#madeyear'+inputid).val(data.madeyear);
            // $('#price'+inputid).val(data.sellprice);
            $('#unitid'+inputid).val(data.unitid);
            $('#unitname'+inputid).val(data.unitname);
          }, error: function(data){
            console.log('Error: ' + data);
          }
        });
      }else if(sparesid.length == 12){
        $.ajax({
          url: '/addsparetoOrder',
          type: 'POST',
          data: {sparesid:sparesid},
          dataType: 'json',
          success: function(data){
            // console.log(data);
            $('#sparesname'+inputid).val(data.sparesname);
            $('#brandspareid'+inputid).val(data.brandspareid);
            $('#brandsparename'+inputid).val(data.brandsparename);
            $('#model'+inputid).val(data.model);
            $('#madeyear'+inputid).val(data.madeyear);
            // $('#price'+inputid).val(data.sellprice);
            $('#unitid'+inputid).val(data.unitid);
            $('#unitname'+inputid).val(data.unitname);
          }, error: function(data){
            console.log('Error: ' + data);
          }
        });
      }else{
        $('#sparesname'+inputid).val("");
        $('#brandspareid'+inputid).val("");
        $('#brandsparename'+inputid).val("");
        $('#model'+inputid).val("");
        $('#madeyear'+inputid).val("");
        $('#unitid'+inputid).val("");
        $('#unitname'+inputid).val("");
        $('#orderqty'+inputid).val("");
        // $('#price'+inputid).val("");
        // $('#total'+inputid).val("");
      }
    });

    // qty keyup
    // $('body').on('keyup', '.qty', function(){
    //   var id = $(this).attr("id");
    //   var idnum = id.substring(8, 9);
    //   var qty = $(this).val();
    //   if(qty === ""){
    //     $('#total'+idnum).val("0");
    //   }else{
    //     var price = $('#price'+idnum).val();
    //     var total = price * qty;
    //     $('#total'+idnum).val(total);
    //   }
    // });
}); 