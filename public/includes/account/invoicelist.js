$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('body').on('click', '#btnEdit', function(){
    var invoiceid = $(this).val();
    $.ajax({
      url: '/invoicetoEdit',
      type: 'POST',
      data: {invoiceid:invoiceid},
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#invoiceid').val(invoiceid);
        $('#cpid option[value="'+data.cpid+'"').attr('selected', true);
        $('#invoice_date').val(data.invoice_date);
        $('#expire_date').val(data.expire_date);
        $('#credit').val(data.credit);
        $('#modalEdit').modal('show');
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
  });

  // function search invoice data by invoice id and quotation id
  $('body').on('click', '#btnSearch', function(){
    var txtsearch = $('#searchinvoice').val();
    if(txtsearch === ""){
      swal("ຜິດ​ພາດ!", "ກະ​ລຸ​ນາ​ໃສ່​ຂໍ້​ມູນ​ທີ່​ທ່ານ​ຕ້ອງ​ການ​ຄົ້ນ​ຫາ!","warning", {timer: 3000});
    }else{
      $.ajax({
        url: '/searchInvoice',
        type: 'POST',
        data: {txtsearch:txtsearch},
        dataType: 'json',
        success: function(data){
          // console.log(data);
          $('#invoice_list').html(data.result);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }
  });

  // function get show invoice detail list
  $('body').on('click', '#btnShowlist', function(){
    var invoiceid = $(this).val();
    $.ajax({
      url: '/getinvoice_detail',
      type: 'POST',
      data: {invoiceid:invoiceid},
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#invoice_detail').modal('show');
        $('#showinvoice_detail').html(data.result);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
  });

  // function delete invoice data
  $('body').on('click', '#btnTrash', function(){
    var invoiceid = $(this).val();
    swal({
      title: "ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ແທ້​ບໍ່?",
      text: "ກົດ​ຕົກ​ລົງ​ເພື່ອ​ລຶບ, ຍົກ​ເລີກ​ດ້ວຍ​ການ​ກົດ​ພື້ນ​ທີ່​ຫວ່າງ.",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        window.location = '/deleteInvoice/'+invoiceid;
      } else {
        swal("ການ​ລຶບ​ຖືກ​ຍົກ​ເລີກ", {
          icon: "error",
          button: false,
          timer: 2000
        });
      }
    })
  });

  $('body').on('change', '#expire_date', function(){
    var enddate = $(this).val();
    var expiredate = new Date(enddate);
    var ddate = $('#invoice_date').val();
    var start = new Date(ddate);
    var caltime = expiredate.getTime() - start.getTime();
    var countday = caltime / (1000 * 3600 * 24);
    $('#credit').val(countday);
  });
  
  $('#expire_date').bootstrapMaterialDatePicker({
    time: false,
    clearButton: true
  });
  $('#invoice_date').bootstrapMaterialDatePicker({
    time: false,
    clearButton: true
  });

  $("#cpid").select2();
});