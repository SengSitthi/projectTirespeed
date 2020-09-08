$(document).ready(function(){
  $('#withdrawdate').bootstrapMaterialDatePicker
    ({
        time: false,
        clearButton: true
    });
    
    $('#sparesid').select2();

    ///function add row
    var i = 1;
    $('#btnAddrow').click(function(){
      i++;
      $('#withdraw_detail').append('<tr id="row'+i+'">'
      +'<td><input class="form-control keysparesid" type="text" name="sparesid[]" id="sparesid'+i+'" maxlength="13" required placeholder="ໃສ່​ລະ​ຫັດ​ສິນ​ຄ້າ"></td>'
      +'<td><input class="form-control" type="text" name="sparesname[]" id="sparesname'+i+'" readonly required></td>'
      +'<td><input type="hidden" name="brandspareid[]" id="brandspareid'+i+'" value=""><input class="form-control" type="text" name="brandsparename[]" id="brandsparename'+i+'" required readonly></td>'
      +'<td><input class="form-control" type="text" name="model[]" id="model'+i+'" required readonly></td>'
      +'<td><input class="form-control" type="text" name="madeyear[]" id="madeyear'+i+'" required readonly></td>'
      +'<td><input class="form-control qty" type="number" name="withdrawqty[]" id="withdrawqty'+i+'" value="0" required></td>'
      +'<td><input class="form-control" type="number" name="price[]" id="price'+i+'" value="0" readonly></td>'
      +'<td><input type="hidden" name="unitid[]" id="unitid'+i+'" value=""><input class="form-control" type="text" name="unitname[]" id="unitname'+i+'" readonly></td>'
      +'<td><input class="form-control" type="number" name="total[]" id="total'+i+'" value="0" readonly></td>'
      +'<td><textarea name="remark[]" id="remark'+i+'" cols="15" rows="1">.</textarea></td>'
      +'<td><button class="btn btn-danger btn_remove" type="button" id="'+i+'"><i class="mdi mdi-minus"></i></button></td>'
      +'</tr>');
    });
    $('body').on('click', '.btn_remove', function(){
      var button_id = $(this).attr("id");
      $("#row"+button_id+"").remove();
    });

    // function select 
    $('body').on('keyup', '.keysparesid', function(){
      var textid = $(this).attr("id");
      var id = textid.substring(8, 9);
      var sparesid = $(this).val();
      // alert(id);
      if(sparesid.length === 13){
        $.ajax({
          url: '/withdrawspares',
          type: 'POST',
          data: {sparesid:sparesid},
          dataType: 'json',
          success: function(data){
            if(data.remain == 0){
              $('#showremainstock').attr('class', 'text-danger');
              $('#showremainstock').text(data.remain);
              $('#withdrawqty'+id).prop('readonly', true);
            }else{
              $('#showremainstock').attr('class', 'text-success');
              $('#showremainstock').text(data.remain);
            }
            $('#showsparesid').text(sparesid);
            // console.log(data);
            $('#sparesname'+id).val(data.sparesname);
            $('#brandspareid'+id).val(data.brandspareid);
            $('#price'+id).val(data.sellprice);
            $('#brandsparename'+id).val(data.brandsparename);
            $('#unitid'+id).val(data.unitid);
            $('#model'+id).val(data.model);
            $('#unitname'+id).val(data.unitname);
            $('#madeyear'+id).val(data.madeyear);
          }, error:function(data){
            console.log('Error: ' + data);
          }
        })
      }else{
        $('#showremainstock').text("");
        $('#showsparesid').text("");
        $('#sparesname'+id).val(""); $('#withdrawqty'+id).val("0");
        $('#brandspareid'+id).val(""); $('#price'+id).val("0");
        $('#brandsparename'+id).val(""); $('#unitid'+id).val("");
        $('#model'+id).val(""); $('#unitname'+id).val("");
        $('#madeyear'+id).val(""); $('#total'+id).val("0");
      }
    });

    // function load car by customer id
    function loadCarBycusid(cusid = ''){
      $.ajax({
        url: '/loadcarwithdraw',
        type: 'POST',
        data: {cusid:cusid},
        dataType: 'json',
        success: function(data){
          // console.log(data)
          $('#carid').html(data.result);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }

    // select customer
    $('body').on('change', '#cusid', function(){
      var cusid = $(this).val();
      if(cusid === ""){
        var result = '<option value="">ເລືອກ​ລູກ​ຄ້າກ່ອນ</option>';
        $('#carid').html(result);
      }else{
        loadCarBycusid(cusid);
      }
    });

    // show file name
    $('body').on('change', '#receivecarfile', function(){
      var filename = $('#receivecarfile')[0].files[0].name;
      $('#showdoc').text(filename);
    });

    // total
    $('body').on('keyup', '.qty', function(){
      var textid = $(this).attr("id");
      var id = textid.substring(11, 12);
      var qty = $(this).val();
      if(qty >= 1){
        var price = $('#price'+id).val();
        $('#total'+id).val(price * qty);
      }else{
        $('#total'+id).val("0");
      }
    });

    // amaran alert set time out
    setTimeout(function(){
      $('.amaran-wrapper').fadeOut();
    }, 3500);
});