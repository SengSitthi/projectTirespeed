$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('#alertstatus').hide();
  $('body').on('click', '#btnClose', function(){
    $('#alertstatus').hide();
  });

  // function load spare
  function loadOrderlist(orderid=''){
    $.ajax({
      url: '/loadOrderList',
      type: 'POST',
      data: {orderid:orderid},
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#btnAddOrder').prop('disabled', true);
        $('#orderlistdata').html(data.result);
        $('#count').text(data.count);
        $('#sparesid').val("");
        $('#sparesname').val("");
        $('#brandspareid').val("");
        $('#brandsparename').val("");
        $('#model').val("");
        $('#madeyear').val("");
        // $('#price').val("");
        $('#unitid').val("");
        $('#unitname').val("");
        // $('#total').val("0");
        $('#orderqty').val("");
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  }

  // order list detail
  $('body').on('click','#btnOrderDetail',function(){
    var orderid = $(this).val();
    loadOrderlist(orderid);
    $('#orderid').val(orderid);
    $('#modaldetail').modal('show');
  });

  // function get spare data
  $('body').on('keyup', '#sparesid', function(){
    var sparesid = $(this).val();
    if(sparesid.length == 13){
      $.ajax({
        url: '/addsparetoOrder',
        type: 'POST',
        data: {sparesid:sparesid},
        dataType: 'json',
        success: function(data){
          // console.log(data);
          $('#sparesname').val(data.sparesname);
          $('#brandspareid').val(data.brandspareid);
          $('#brandsparename').val(data.brandsparename);
          $('#model').val(data.model);
          $('#madeyear').val(data.madeyear);
          // $('#price').val(data.sellprice);
          $('#unitid').val(data.unitid);
          $('#unitname').val(data.unitname);
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
          $('#sparesname').val(data.sparesname);
          $('#brandspareid').val(data.brandspareid);
          $('#brandsparename').val(data.brandsparename);
          $('#model').val(data.model);
          $('#madeyear').val(data.madeyear);
          // $('#price').val(data.sellprice);
          $('#unitid').val(data.unitid);
          $('#unitname').val(data.unitname);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }else{
      $('#sparesname').val("");
      $('#brandspareid').val("");
      $('#brandsparename').val("");
      $('#model').val("");
      $('#madeyear').val("");
      // $('#price').val("");
      $('#unitid').val("");
      $('#unitname').val("");
    }
  });
  // total
  $('body').on('keyup', '#orderqty', function(){
    var qty = $(this).val();
    if(qty <= 0){
      // $('#total').val("0");
      $('#btnAddOrder').prop('disabled', true);
    }else{
      // var price = $('#price').val();
      // var total = price * qty;
      // $('#total').val(total);
      $('#btnAddOrder').prop('disabled', false);
    }
  });

  // addd new list or add order qty
  $('body').on('click', '#btnAddOrder', function(){
    var orderid = $('#orderid').val();
    var sparesid = $('#sparesid').val();
    var sparesname = $('#sparesname').val();
    var brandspareid = $('#brandspareid').val();
    var model = $('#model').val();
    var madeyear = $('#madeyear').val();
    var orderqty = $('#orderqty').val();
    // var price = $('#price').val();
    var unitid = $('#unitid').val();
    // var total = $('#total').val();
    $.ajax({
      url: '/addOrderlist',
      type: 'POST',
      data: {orderid:orderid,sparesid:sparesid,sparesname:sparesname,brandspareid:brandspareid,model:model,madeyear:madeyear,orderqty:orderqty,unitid:unitid},
      dataType: 'json',
      success: function(data){
        $('#alertstatus').attr('class', 'alert alert-success');
        $('#alertstatus').show();
        $('#textstatus').text(data);
        $('#status').text('ສຳ​ເລັດ!');
        loadOrderlist(orderid);
        // console.log(data);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
  });

  // function delete
  $('body').on('click', '#btnTrash', function(){
    var orderdetailid = $(this).val();
    var orderid = $('#orderid').val();
    // alert(orderid);
    swal({
      title: "ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ຂໍ​ມູ້ນ​ນີ້ແທ້​ບໍ່?",
      text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        $.ajax({
          url: '/deleteOrderlist',
          type: 'POST',
          data: {orderdetailid:orderdetailid},
          dataType: 'json',
          success: function(data){
            $('#alertstatus').attr('class', 'alert alert-success');
            $('#alertstatus').show();
            $('#textstatus').text(data);
            $('#status').text('ສຳ​ເລັດ!');
            loadOrderlist(orderid);
          }, error: function(data){
            console.log('Error: ' + data);
          }
        });
      }else{
        swal("ການ​ລຶບ​ຖືກ​ຍົກ​ເລີກ", {
          icon: "warning",
          button: false,
          timer: 2500
        });
      }
    });
  });

  // date order
  $('#orderdate').bootstrapMaterialDatePicker
    ({
        time: false,
        clearButton: true
    });

  /////////// function edit order
  $('body').on('click', '#btnEditOrder', function(){
    var orderid = $(this).val();
    $.ajax({
      url: '/getOrderdata',
      type: 'POST',
      data: {orderid:orderid},
      dataType: 'json',
      success: function(data){
        $('#orderid1').val(orderid);
        $('#orderdate').val(data.orderdate);
        $('#remark').val(data.remark);
        $('#supplierid option[value="'+data.supplierid+'"]').prop('selected', true);
        $('#OrderModal').modal('show');
        // console.log(data);
      }, error: function(data){
        console.log('Error:' + data);
      }
    });
  });

  // function search
  $('body').on('click', '#btnSearch', function(){
    var searchorder = $('#searchorder').val();
    if(searchorder === ""){
      $('#searchorder').attr('placeholder', 'ໃສ່​ລະ​ຫັດ​ບິນ​ເພື່ອ​ຄົ້ນ​ຫາ...');
      $('#searchorder').focus();
    }else{
      $.ajax({
        url: '/searchOrderdata',
        type: 'POST',
        data: {searchorder:searchorder},
        dataType: 'json',
        success: function(data){
          $('#showorder').html(data.result);
          $('#searchorder').val("");
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }
  });

  // function delete order
  $('body').on('click', '#btnDelete', function(){
    var orderid = $(this).val();
    swal({
      title: "ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ຂໍ​ມູ້ນ​ນີ້ແທ້​ບໍ່?",
      text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        window.location = '/deleteOrder/'+orderid;
      }else{
        swal("ການ​ລຶບ​ຖືກ​ຍົກ​ເລີກ", {
          icon: "warning",
          button: false,
          timer: 2500
        });
      }
    });
  });
});