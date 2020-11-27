$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  // function list
  $('body').on('click', '#btnShowlist', function(){
    var receiptid = $(this).val();
    // alert(receiptid);
    $.ajax({
      url: '/loadReceiptdetail',
      type: 'POST',
      data: {receiptid:receiptid},
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#receipt_detail').html(data.result);
        $('#modalshowlist').modal('show');
        $('#showreceiptid').text(receiptid);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
  });

  // function edit receipt data
  $('body').on('click', '#btnEdit', function(){
    var receiptid = $(this).val();
    // alert(receiptid);
    $.ajax({
      url: '/getreceipt',
      type: 'POST',
      data: {receiptid:receiptid},
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#receiptid').val(receiptid);
        $('#receipt_date').val(data.receipt_date);
        $('#receipt_from').val(data.receipt_from);
      }, error: function(data){
        console.log('Error: '+ data);
      }
    });
      $('#modaleditreceipt').modal('show');
  });

  // function to delete receipt data
  $('body').on('click', '#btnTrash', function(){
    var receiptid = $(this).val();
    // alert(receiptid);
    swal({
      title: "ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ແທ້​ບໍ່?",
      text: "ກົດ​ຕົກ​ລົງ​ເພື່ອ​ລຶບ, ຍົກ​ເລີກ​ດ້ວຍ​ການ​ກົດ​ພື້ນ​ທີ່​ຫວ່າງ.",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        window.location = '/deleteReceipt/'+receiptid;
      } else {
        swal("ການ​ລຶບ​ຖືກ​ຍົກ​ເລີກ", {
          icon: "error",
          button: false,
          timer: 2000
        });
      }
    })
  });

  // function search receipt data
  $('body').on('click', '#btnSearch', function(){
    var searchreceipt = $('#searchreceipt').val();
    // alert(searchreceipt);
    if(searchreceipt === ""){
      swal("ຜິດ​ພາດ!", "ກະ​ລຸ​ນາ​ໃສ່​ຂໍ້​ມູນ​ທີ່​ທ່ານ​ຕ້ອງ​ການ​ຄົ້ນ​ຫາ!", "warning");
    }else{
      $.ajax({
        url: '/searchReceipt',
        type: 'POST',
        data: {searchreceipt:searchreceipt},
        dataType: 'json',
        success: function(data){
          // console.log(data);
          $('#receipt_data').html(data.result);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      })
    }
  });

  $('#receipt_date').bootstrapMaterialDatePicker({
    time: false,
    clearButton: true
  });
});