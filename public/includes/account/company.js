$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  loadCompany();
  function loadCompany(){
    $.ajax({
      url: '/loadCompany',
      type: 'POST',
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#showdetail').html(data.result);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
  }

  // function add new company
  $('body').on('click', '#btnAdd', function(){
    var cpname = $('#cpname').val();
    var address = $('#address').val();
    var phone = $('#phone').val();
    var fax = $('#fax').val();
    if(cpname === ""){
      swal("ຜິດ​ພາດ", "ຊື່​ບໍ​ລິ​ສັດ​ຍັງ​ເປັນ​ຄ່າ​ຫວ່າງ!", "warning", {timer: 3000});
    }else if(address === ""){
      swal("ຜິດ​ພາດ", "ທີ່​ຢູ່​ບໍ​ລິ​ສັດ​ຍັງ​ເປັນ​ຄ່າ​ຫວ່າງ!", "warning", {timer: 3000});
    }else if(phone === ""){
      swal("ຜິດ​ພາດ", "ເບີ​ໂທ​ລະ​ສັບຍັງ​ເປັນ​ຄ່າ​ຫວ່າງ!", "warning", {timer: 3000});
    }else{
      var indata = {
        cpname:cpname,
        address:address,
        phone:phone,
        fax:fax
      }
      $.ajax({
        url: '/insertnewcompany',
        type: 'POST',
        data: indata,
        success: function(data){
          swal("ສຳ​ເລັດ", "ການ​ເພີ່ມ​ຂໍ້​ມູນ​ໃໝ່​ສຳ​ເລັດ!", "success", {timer: 3000});
          fnEmpty();
          loadCompany();
        }, error: function(data){
          console.log('Error: '+data);
        }
      });
    }
  });

  // function get data to update
  $('body').on('click', '#btnEdit', function(){
    var cpid = $(this).val();
    $.ajax({
      url: '/getCompanydata',
      type: 'POST',
      data:{cpid:cpid},
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#cpid').val(cpid);
        $('#cpname').val(data.cpname);
        $('#phone').val(data.phone);
        $('#fax').val(data.fax);
        $('#address').val(data.address);
        $('#btnAdd').attr('id', "btnUpdate");
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  });

  // function update
  $('body').on('click', '#btnUpdate', function(){
    var cpid = $('#cpid').val();
    var cpname = $('#cpname').val();
    var address = $('#address').val();
    var phone = $('#phone').val();
    var fax = $('#fax').val();
    if(cpname === ""){
      swal("ຜິດ​ພາດ", "ຊື່​ບໍ​ລິ​ສັດ​ຍັງ​ເປັນ​ຄ່າ​ຫວ່າງ!", "warning", {timer: 3000});
    }else if(address === ""){
      swal("ຜິດ​ພາດ", "ທີ່​ຢູ່​ບໍ​ລິ​ສັດ​ຍັງ​ເປັນ​ຄ່າ​ຫວ່າງ!", "warning", {timer: 3000});
    }else if(phone === ""){
      swal("ຜິດ​ພາດ", "ເບີ​ໂທ​ລະ​ສັບຍັງ​ເປັນ​ຄ່າ​ຫວ່າງ!", "warning", {timer: 3000});
    }else{
      var editdata = {
        cpid:cpid,
        cpname:cpname,
        address:address,
        phone:phone,
        fax:fax
      }
      $.ajax({
        url: '/updatecompany',
        type: 'POST',
        data: editdata,
        success: function(data){
          swal("ສຳ​ເລັດ", "ການ​ແກ້​ໄຂ​ຂໍ້​ມູນສຳ​ເລັດ!", "success", {timer: 3000});
          fnEmpty();
          loadCompany();
        }, error: function(data){
          console.log('Error: '+data);
        }
      });
    }
  });

  // function delete company data
  $('body').on('click', '#btnDel', function(){
    var cpid = $(this).val();
    swal({
      title: "ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ແທ້​ບໍ່?",
      text: "ກົດ​ຕົກ​ລົງ​ເພື່ອ​ລຶບ, ຍົກ​ເລີກ​ດ້ວຍ​ການ​ກົດ​ພື້ນ​ທີ່​ຫວ່າງ.",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    })
    .then((willDelete) => {
      if(willDelete){
        $.ajax({
          url: '/delcompanydata',
          type: 'POST',
          data: {cpid:cpid},
          dataType: 'json',
          success: function(data){
            loadCompany();
            fnEmpty();
            swal("ສຳ​ເລັດ", "ການ​ລົບ​ຂໍ້​ມູນ​ໃໝ່​ສຳ​ເລັດ!", "success", {timer: 3000});
          }, error: function(data){
            console.log('Error: ' + data);
          }
        })
      } else {
        swal("ການ​ລຶບ​ຖືກ​ຍົກ​ເລີກ", {
          icon: "error",
          button: false,
          timer: 2000
        });
      }
    })
  });
  // function empty
  function fnEmpty(){
    $('#cpname').val("");
    $('#address').val("");
    $('#phone').val("");
    $('#fax').val("");
    // $('#btnUpdate').attr('btnAdd');
  }

  // btn cancel
  $('body').on('click', '#btnCancel', function(){
    fnEmpty();
    $('#btnUpdate').attr('id', "btnAdd");
  });
});