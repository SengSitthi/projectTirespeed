$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })
  hideInput();
  function hideInput(){
    $('#inputsearchdate').prop('disabled', true);
    $('#inputsearchdate').show();
    $('#inputsearchid').hide();
    $('#inputsearchname').hide();
  }

  function getQtDetailModal(qtid = ""){
    $.ajax({
      url: '/modalloadQTDetail',
      type: 'POST',
      data: {qtid:qtid},
      dataType: 'json',
      success:function(data){
        $('#showqtdetaildata').html(data.result);
        $('#modalEditlist').modal('show');
        // console.log(data);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
  }

  $('body').on('click', '#btnDetaillist', function(){
    var qtid = $(this).val();
    // $('#modalEditlist').modal('show');
    $('#qtiddetail').val(qtid);
    getQtDetailModal(qtid);
  });

  // function update status
  $('body').on('click', '.confirm', function(){
    var qtid = $('#qtiddetail').val();
    var qtdetailid = $(this).attr("id");
    var status = $(this).val();
    $.ajax({
      url: '/updateqtdetailstatus',
      type: 'POST',
      data: {qtdetailid:qtdetailid,status:status},
      dataType: 'json',
      success: function(data){
        swal("ສຳ​ເລັດ", data, "success",{timer: 3000});
        getQtDetailModal(qtid);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  });
  

  $('body').on('click', '#btnEditQT', function(){
    var qtid = $(this).val();
    $('#editqtid').val(qtid);
    $.ajax({
      url: '/loadQuotations',
      type: 'POST',
      data: {qtid:qtid},
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#qtid').val(qtid);
        $('#rpbid').val(data.rpbid);
        $('#part').val(data.part);
        $('#checkin_date').val(data.checkin_date);
        $('#checkin_time').val(data.checkin_time);
        $('#checkout_date').val(data.checkout_date);
        $('#checkout_time').val(data.checkout_time);
        $('#document_date').val(data.document_date);
        $('#expire_date').val(data.expire_date);
        $('#credit_day').val(data.credit_day);
        $('#instance').val(data.instance);
        $('#receive_bill').val(data.receive_bill);
        $('#modalquotation').modal('show');
      },error: function(data){
        console.log('Error: ' + data);
      }
    });
  });

  $('body').on('click', '#btnSearch', function(){
      var datasearch = $('#txtsearchid').val();

    var searchdt = {
      datasearch: datasearch
    }
    if(datasearch == ""){
      alert(title="ຜິດ​ພາດ",content="ຂໍ້​ມູນ​ການ​ຄົ້ນຫາເປັນ​ຄ່າ​ຫວ່າງ", icon="error");
    }else{
      $.ajax({
        url:'/searchQuotation',
        type: 'POST',
        data: searchdt,
        dataType: 'json',
        success: function(data){
          // console.log(data);
          $('#showquotation').html(data.result);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }
  });

  // btn trash quotation
  $('body').on('click', '#btnTrashQuot', function(){
    var qtid = $(this).val();
    swal({
      title: "ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ຂໍ​ມູ້ນ​ນີ້ແທ້​ບໍ່?",
      text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        window.location.href = "/deleteQuotation/" + qtid;
      }else{
        swal("ການ​ລຶບ​ຖືກ​ຍົກ​ເລີກ", {
          icon: "warning",
          button: false,
          timer: 2500
        });
      }
    });
  });

  $('body').on('keyup', '.qty', function(){
    var qty = $(this).val();
    var price = $('#price').val();
    $('#total').val(price*qty);
  });

  function alert(title="", content="", icon=""){
    swal({
      title: title,
      text: content,
      icon: icon,
      button: false,
      timer: 2500
    });
  }

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

    $('body').on('change', '#expire_date', function(){
      var enddate = $(this).val();
      var expiredate = new Date(enddate);
      var ddate = $('#document_date').val();
      var start = new Date(ddate);
      var caltime = expiredate.getTime() - start.getTime();
      var countday = caltime / (1000 * 3600 * 24);
      $('#credit_day').val(countday);
    });

    $('body').on('change', '#document_date', function(){
      var enddate = $('#expire_date').val();
      var expiredate = new Date(enddate);
      var ddate = $(this).val();
      var start = new Date(ddate);
      var caltime = expiredate.getTime() - start.getTime();
      var countday = caltime / (1000 * 3600 * 24);
      $('#credit_day').val(countday);
    });
});