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
        $('#qtdetaildt').html(data.result);
        $('#modalqtid').val(qtid);
        $('#modalEditlist').modal('show');
        // console.log(data);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  }

  $('body').on('click', '#btnDetaillist', function(){
    var qtid = $(this).val();
    getQtDetailModal(qtid);
  });

  $('body').on('keyup', '.sparesid', function(){
    var sparesid = $(this).val();
    // alert(id);
    if(sparesid.length === 13){
      $.ajax({
        url: '/loadSparetoQT',
        type: 'POST',
        data: {sparesid:sparesid},
        dataType: 'json',
        success: function(data){
          // console.log(data);
          $('#sparesname').val(data.sparesname);
          $('#price').val(data.sellprice);
          $('#unitname').val(data.unitname);
          // $('#qty'+id).focus();
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }else if(sparesid.length === 12){
      $.ajax({
        url: '/loadSparetoQT',
        type: 'POST',
        data: {sparesid:sparesid},
        dataType: 'json',
        success: function(data){
          // console.log(data);
          $('#sparesname').val(data.sparesname);
          $('#price').val(data.sellprice);
          $('#unitname').val(data.unitname);
          // $('#qty'+id).focus();
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }else{
      $('#sparesname').val("");
      $('#price').val("0");
      $('#unitname').val("");
    }
  });

  // function add new data
  $('body').on('click', '#btnSavenew', function(){
    var sparesid = $('#sparesid').val();
    var qty = $('#qty').val();
    var wages = $('#wages').val();
    if(sparesid === ""){
      alert(title="ຜິດ​ພາດ",content="ຂໍ​້​ມູນ​ລະ​ຫັດ​ອະ​ໄຫຼ່​ເປັນ​ຄ່າ​ຫວ່າງ", icon="error");
    }else if(qty === ""){
      alert(title="ຜິດ​ພາດ",content="ຂໍ​້​ມູນ​ຈຳ​ນວນເປັນ​ຄ່າ​ຫວ່າງ", icon="error");
    }else if(qty <= 0){
      alert(title="ຜິດ​ພາດ",content="ຂໍ​້​ມູນ​ຈຳ​ນວນເປັນ​ຄ່າ​ 0", icon="error");
    }else if(wages === ""){
      alert(title="ຜິດ​ພາດ",content="ຂໍ​້​ມູນ​ຄ່າ​ແຮງ​ງານ​ເປັນ​ຄ່າ​ຫວ່າງ", icon="error");
    }else{
      var indata = {
        qtid: $('#modalqtid').val(),
        sparesid: sparesid,
        qty: qty,
        price: $('#price').val(),
        wages: wages,
        total: $('#total').val()
      }
      $.ajax({
        url: '/insertQtdetaildata',
        type: 'POST',
        data: indata,
        dataType: 'json',
        success: function(data){
          alert(title="ສຳ​ເລັດ",content=data,icon="success");
          getQtDetailModal($('#modalqtid').val());
          $('#sparesname').val("");
          $('#price').val("0");
          $('#unitname').val("");
          $('#qty').val("0");
          $('#total').val("0");
          $('#wages').val("0");
          $('#sparesid').val("");
          $('#sparesid').focus();
        }, error: function(data){
          console.log('Error:' + data);
        }
      })
    }
  });

  // remove quotation list
  $('body').on('click', '#btnTrash', function(){
    var qtdetailid = $(this).val();
    swal({
      title: "ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ຂໍ​ມູ້ນ​ນີ້ແທ້​ບໍ່?",
      text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        $.ajax({
          url: '/trashQtlist',
          type: 'POST',
          data: {qtdetailid:qtdetailid},
          dataType: 'json',
          success: function(data){
            alert(title="ສຳ​ເລັດ",content=data, icon="success");
            getQtDetailModal($('#modalqtid').val());
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

  // function get car data by cus data
  function loadCutomerdata(cusid = ""){
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
  }

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
        loadCutomerdata(cusid=data.cusid);
        $('#cusid option[value="'+data.cusid+'"]').prop('selected', true);
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
        setTimeout(
          function(){
            $('#carid option[value="'+data.carid+'"]').prop('selected', true);
          }, 1000
        );
        $('#modalquotation').modal('show');
      },error: function(data){
        console.log('Error: ' + data);
      }
    });
  });

  $('body').on('change', '#searchstyle', function(){
    var style = $(this).val();
    if(style == "searchid"){
      $('#inputsearchid').show();
      $('#inputsearchdate').hide();
      $('#inputsearchname').hide();
    }else if(style == "searchdate"){
      hideInput();
    }else if(style == "searchname"){
      $('#inputsearchname').show();
      $('#inputsearchdate').hide();
      $('#inputsearchid').hide();
    }else{
      hideInput();
    }
  });

  $('body').on('click', '#btnSearch', function(){
    var style = $('#searchstyle').val();
    if(style == "searchid"){
      var datasearch = $('#txtsearchid').val();
    }else if(style == "searchname"){
      var datasearch = $('#txtsearchname').val();
    }else{
      var datasearch = $('#txtsearchdate').val();
    }

    var searchdt = {
      style: style,
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

  $('body').on('change', '#cusid', function(){
    var cusid = $(this).val();
    loadCutomerdata(cusid=cusid);
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
    $('#txtsearchdate').bootstrapMaterialDatePicker
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