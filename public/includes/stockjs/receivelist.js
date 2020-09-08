$(document).ready(function(){
  $.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  // function load receive detail
  function loadReceiveDetail(receiveid = ""){
    $.ajax({
      url: '/loadreceivedetail',
      type: 'POST',
      data: {receiveid:receiveid},
      dataType: 'json',
      success: function(data){
        $('#showreceivelist').html(data.result);
        $('#receivecount').text(data.count);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
  }

  $('body').on('click', '#btnReceivelist', function(){
    var id = $(this).val();
    var receiveid = id.substring(0, 12);
    var orderid = id.substring(12, 24);
    // alert(receiveid + ' / ' + orderid);
    $('#receiveid').val(receiveid);
    $('#orderid').val(orderid);
    $('#alertstatus').hide();
    loadReceiveDetail(receiveid);
    $('#modaldetail').modal('show');
  });

  // btn alert
  $('body').on('click', '#btnShowreceivelist', function(){
    var id = $(this).val();
    var receiveid = id.substring(0, 12);
    var orderid = id.substring(12, 24);
    // alert(receiveid + ' / ' + orderid);
    $('#receiveid').val(receiveid);
    $('#orderid').val(orderid);
    $('#alertstatus').hide();
    loadReceiveDetail(receiveid);
    $('#modaldetail').modal('show');
  });

  // function search spares
  $('body').on('keyup', '#sparesid', function(){
    var sparesid = $(this).val();
    var receiveid = $('#receiveid').val();
    var orderid = $('#orderid').val();
    if(sparesid.length === 13){
      $.ajax({
        url: '/searchOrderlist',
        type: 'POST',
        data: {sparesid:sparesid,orderid:orderid},
        dataType: 'json',
        success: function(data){
          $('#sparesname').val(data.sparesname);
          $('#brandspareid').val(data.brandspareid);
          $('#brandsparename').val(data.brandsparename);
          $('#model').val(data.model);
          $('#madeyear').val(data.madeyear);
          $('#unitid').val(data.unitid);
          $('#unitname').val(data.unitname);
          // console.log(data);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }else{
      fnEmpty();
    }
  });
  
  // function add new receive list
  $('body').on('click', '#btnAddnew', function(){
    var sparesid = $('#sparesid').val();
    var receiveid = $('#receiveid').val();
    if(sparesid === ""){
      $('#status').text('ຜິດ​ພາດ');
      $('#textstatus').text('ຂໍ້​ມູນ​ລະ​ຫັດ​ອະ​ໄຫຼ່​ເປັນ​ຄ່າ​ຫວ່າ​ງ');
      $('#alertstatus').show();
    }else{
      var addnewdata = {
        receiveid: receiveid,
        sparesid: sparesid,
        sparesname: $('#sparesname').val(),
        brandspareid:  $('#brandspareid').val(),
        model:  $('#model').val(),
        madeyear:  $('#madeyear').val(),
        receiveqty:  $('#receiveqty').val(),
        price:  $('#price').val(),
        unitid:  $('#unitid').val(),
        total:  $('#total').val(),
        remark:  $('#remark').val(),
      };
      $.ajax({
        url: '/insertnewreceive',
        type: 'POST',
        data: addnewdata,
        dataType: 'json',
        success: function(data){
          $('#status').text('ສຳ​ເລັດ');
          $('#textstatus').text(data);
          $('#alertstatus').show();
          $('#alertstatus').attr('class', 'alert alert-success');
          loadReceiveDetail(receiveid);
          fnEmpty();
        }, error: function(data){
          console.log('Error: ' + data);
        }
      })
    }
  });

  // function delete receive list
  $('body').on('click', '#btnTrash', function(){
    var receivedetailid = $(this).val();
    var receiveid = $('#receiveid').val();
    swal({
      title: "ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ຂໍ​ມູ້ນ​ນີ້ແທ້​ບໍ່?",
      text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        $.ajax({
          url: '/deleteReceivedetail',
          type: 'POST',
          data: {receivedetailid:receivedetailid},
          dataType: 'json',
          success: function(data){
            $('#status').text('ສຳ​ເລັດ');
            $('#textstatus').text(data);
            $('#alertstatus').show();
            $('#alertstatus').attr('class', 'alert alert-success');
            loadReceiveDetail(receiveid);
            l
          }, error: function(data){
            console.log('Error: ' + data);
          }
        })
      }else{
        swal("ການ​ລຶບ​ຖືກ​ຍົກ​ເລີກ", {
          icon: "warning",
          button: false,
          timer: 2500
        });
      }
    });
  });

  // edit receive data
  $('body').on('click', '#btnEditReceive', function(){
    var receiveid = $(this).val();
    $.ajax({
      url: '/getreceivedata',
      type: 'POST',
      data: {receiveid:receiveid},
      dataType: 'json',
      success: function(data){
        $('#invoicenum').val(data.invoicenum);
        $('#receive_date').val(data.receivedate);
        $('#sendername').val(data.sendername);
        $('#updatereceiveid').val(receiveid);
        $('#modalEdit').modal('show');
        // console.log(data);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  });

  // delete receive
  $('body').on('click', '#btnDelete', function(){
    var receiveid = $(this).val();
    swal({
      title: "ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ຂໍ​ມູ້ນ​ນີ້ແທ້​ບໍ່?",
      text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        window.location.href = '/deleteReceive/'+receiveid;
      }else{
        swal("ການ​ລຶບ​ຖືກ​ຍົກ​ເລີກ", {
          icon: "warning",
          button: false,
          timer: 2500
        });
      }
    });
  });

  // function search receive
  $('body').on('click', '#btnSearchreceive', function(){
    var datasearch = $('#receivesearch').val();
    if(datasearch === ""){
      $('#receivesearch').attr('placeholder', 'ກະ​ລຸ​ນາໃສ່​ຂໍ້​ມູນ​ທີ່​ທ່ານ​ຕ້ອງ​ການ​ຄົ້ນ​ຫາ!');
      $('#receivesearch').focus();
    }else{
      $.ajax({
        url: '/searchreceivedt',
        type: 'POST',
        data: {datasearch:datasearch},
        dataType: 'json',
        success: function(data){
          $('#receivedata').html(data.result);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }
  });

  $('body').on('change', '#filepdf', function(){
    var fileName = $('#filepdf')[0].files[0].name;
    $('#showfilename').text(fileName);
  });

  // material date
  $('#receive_date').bootstrapMaterialDatePicker
    ({
      time: false,
      clearButton: true
    });

  // sum data
  $('body').on('keyup', '#receiveqty', function(){
    var qty = $(this).val();
    if(qty === ""){
      $('#total').val("0");
    }else{
      var total = $('#price').val() * qty;
      $('#total').val(total);
    }
  });

  $('body').on('keyup', '#price', function(){
    var price = $(this).val();
    if(price === ""){
      $('#total').val("0");
    }else{
      var total = price * $('#receiveqty').val();
      $('#total').val(total);
    }
  });

  // empty data modal add new receive list
  function fnEmpty(){
    $('#sparesname').val("");
    $('#brandspareid').val("");
    $('#brandsparename').val("");
    $('#model').val("");
    $('#madeyear').val("");
    $('#receiveqty').val("0");
    $('#price').val("0");
    $('#unitid').val("");
    $('#unitname').val("");
    $('#total').val("0");
  }

  // btn close alert
  $('#btnClose').click(function(){
    $('#alertstatus').hide();
  });
});