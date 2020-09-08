$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  // function load withdraw list
  function loadWithdrawdt(withdrawid){
    $.ajax({
      url: '/loadWithdrawdt',
      type: 'POST',
      data: {withdrawid:withdrawid},
      dataType: 'json',
      success: function(data){
        $('#showwithdrawdt').html(data.result);
      }, error: function(data){
        console.log('Error: ' +data);
      }
    })
  }

  $('body').on('click', '#btnDetaillist', function(){
    var withdrawid = $(this).val();
    loadWithdrawdt(withdrawid);
    $('#withdrawaddid').val(withdrawid);
    $('#withdrawlist').modal('show');
  });

  // function get spare
  // function select 
  $('body').on('keyup', '.keysparesid', function(){
    var sparesid = $(this).val();
    // alert(id);
    if(sparesid.length == 13){
      $.ajax({
        url: '/withdrawspares',
        type: 'POST',
        data: {sparesid:sparesid},
        dataType: 'json',
        success: function(data){
          if(data.remain == 0){
            $('#showremainstock').attr('class', 'text-danger');
            $('#showremainstock').text(data.remain);
            $('#withdrawqty').prop('readonly', true);
          }else{
            $('#showremainstock').attr('class', 'text-success');
            $('#showremainstock').text(data.remain);
          }
          $('#showsparesid').text(sparesid);
          // console.log(data);
          $('#sparesname').val(data.sparesname);
          $('#brandspareid').val(data.brandspareid);
          $('#price').val(data.sellprice);
          $('#brandsparename').val(data.brandsparename);
          $('#unitid').val(data.unitid);
          $('#model').val(data.model);
          $('#unitname').val(data.unitname);
          $('#madeyear').val(data.madeyear);
        }, error:function(data){
          console.log('Error: ' + data);
        }
      })
    }else if(sparesid.length == 12){
      $.ajax({
        url: '/withdrawspares',
        type: 'POST',
        data: {sparesid:sparesid},
        dataType: 'json',
        success: function(data){
          if(data.remain == 0){
            $('#showremainstock').attr('class', 'text-danger');
            $('#showremainstock').text(data.remain);
            $('#withdrawqty').prop('readonly', true);
          }else{
            $('#showremainstock').attr('class', 'text-success');
            $('#showremainstock').text(data.remain);
          }
          $('#showsparesid').text(sparesid);
          // console.log(data);
          $('#sparesname').val(data.sparesname);
          $('#brandspareid').val(data.brandspareid);
          $('#price').val(data.sellprice);
          $('#brandsparename').val(data.brandsparename);
          $('#unitid').val(data.unitid);
          $('#model').val(data.model);
          $('#unitname').val(data.unitname);
          $('#madeyear').val(data.madeyear);
        }, error:function(data){
          console.log('Error: ' + data);
        }
      })
    }else{
      fnEmptyfield();
    }
  });

  // add new list
  $('body').on('click', '#btnAddnew', function(){
    var sparesid = $('#sparesid').val();
    var qty = $('#withdrawqty').val();
    if(sparesid === ""){
      $('#showicon').attr('class', 'icon fa fa-ban icon-large');
      $('#showtheme').attr('class', 'amaran awesome error');
      $('#showalerttitle').text('ຜິດ​ພາດ');
      $('#showalertdata').text('ຍັງ​ບໍ່​ໄດ້​ເລືອກ​ອະ​ໄຫ​ຼ່');
      $('#showalertdetail').text('ກະ​ລຸ​ນາປ້ອນ​ລະ​ຫັດ​ອະ​ໄຫຼ່​ໃສ່​ໃນ​ລະ​ບົບ');
      $('#showalert').show();
    }else if(qty === "0"){
      $('#showicon').attr('class', 'icon fa fa-ban icon-large');
      $('#showtheme').attr('class', 'amaran awesome error');
      $('#showalerttitle').text('ຜິດ​ພາດ');
      $('#showalertdata').text('ຈຳ​ນວນ​ເປັນ​ຄ່າ​ຫວ່າງ');
      $('#showalertdetail').text('ກະ​ລຸ​ນາ​ກວດ​ສະຕ໋ອກ​ໃນ​ລະ​ບົບ​ ບໍ່​ສາ​ມາດ​ບັ​ນ​ທຶກ​ໄດ້​ຫາກ​ຈຳ​ນວນເບີກເທົ່າ​ກັບ 0');
      $('#showalert').show();
    }else{
      var addnew = {
        withdrawaddid: $('#withdrawaddid').val(), sparesid: $('#sparesid').val(),
        sparesname: $('#sparesname').val(), brandspareid: $('#brandspareid').val(),
        model: $('#model').val(), madeyear: $('#madeyear').val(), withdrawqty: $('#withdrawqty').val(),
        price: $('#price').val(), unitid: $('#unitid').val(), total: $('#total').val(),
        remark: $('#remark').val()
      }
      $.ajax({
        url: '/addnewwithdraw',
        type: 'POST',
        data: addnew,
        dataType: 'json',
        success: function(data){
          $('#showalerttitle').text('ສຳ​ເລັດ');
            $('#showalertdata').text(data);
            $('#showalertdetail').text("");
            $('#showicon').attr('class', 'icon fa fa-check-circle icon-large');
            $('#showtheme').attr('class', 'amaran awesome ok');
            $('#showalert').show();
          loadWithdrawdt($('#withdrawaddid').val());
          // console.log(data);
          fnEmptyfield();
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }
  });

  // btn trash list
  $('body').on('click', '#btnTrashlist', function(){
    var wddtid = $(this).val();
    var wdid = $('#withdrawaddid').val();
    
    swal({
      title: "ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ຂໍ​ມູ້ນ​ນີ້ແທ້​ບໍ່?",
      text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        $.ajax({
          url: '/trashlist',
          type: 'POST',
          data: {wddtid:wddtid},
          dataType: 'json',
          success: function(data){
            $('#showalerttitle').text('ສຳ​ເລັດ');
            $('#showalertdata').text(data);
            $('#showalertdetail').text("");
            $('#showicon').attr('class', 'icon fa fa-check-circle icon-large');
            $('#showtheme').attr('class', 'amaran awesome ok');
            $('#showalert').show();
            loadWithdrawdt(wdid);
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

  // edit withdraw data
  $('body').on('click', '#btnEditdata', function(){
    var withdrawid = $(this).val();
    $.ajax({
      url: '/getWithdrawdata',
      type: 'POST',
      data: {withdrawid:withdrawid},
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#userrequest').val(data.userrequest);
        $('#receivecartitle').val(data.receivecartitle);
        $('#withdrawdate').val(data.withdrawdate);
        $('#withdrawid').val(withdrawid);
        $('#cusid option[value="'+data.cusid+'"').prop('selected', true);
        $('.filter-option-inner-inner').text(data.name);
        loadCarBycusid(data.cusid);
        setInterval(function(){
          $('#carid option[value="'+data.carid+'"').prop('selected', true);
        }, 1000);
        $('#modaledit').modal('show');
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  });

  // function delete withdraw data
  $('body').on('click', '#btnTrashdata', function(){
    var withdrawid = $(this).val();
    swal({
      title: "ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ຂໍ​ມູ້ນ​ນີ້ແທ້​ບໍ່?",
      text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        window.location.href = '/deletewithdraw/'+ withdrawid;
      }else{
        swal("ການ​ລຶບ​ຖືກ​ຍົກ​ເລີກ", {
          icon: "warning",
          button: false,
          timer: 2500
        });
      }
    });
  });


  // function search withdraw data by id
  $('body').on('click', '#btnSearchwd', function(){
    var wdsearch = $('#searchwithdraw').val();
    if(wdsearch === ""){
      $('#showicon').attr('class', 'icon fa fa-ban icon-large');
      $('#showtheme').attr('class', 'amaran awesome error');
      $('#showalerttitle').text('ຜິດ​ພາດ');
      $('#showalertdata').text('ຂໍ້​ມູນ​ການ​ຄົ້​ນຫາ​ເປັນ​ຄ່າ​ຫວ່າງ!');
      $('#showalertdetail').text('ກະ​ລຸ​ນາ​ໃສ່​ລະ​ຫັດ​ທີ່​ທ່ານ​ຕ້ອງ​ການ​ຄົ້ນ​ຫາ');
      $('#showalert').show();
    }else{
      $.ajax({
        url: '/searchwithdrawdata',
        type: 'POST',
        data: {wdsearch:wdsearch},
        dataType: 'json',
        success: function(data){
          // console.log(data);
          $('#wdsearchdata').html(data.result);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      })
    }
  });

  // calculate
  $('body').on('keyup', '.qty', function(){
    var qty = $(this).val();
    if(qty >= 1){
      var price = $('#price').val();
      $('#total').val(price * qty);
    }else{
      $('#total').val("0");
    }
  });

  $('#showalert').hide();
  setInterval(function(){
    $('#showalert').fadeOut();
  }, 5000);

  // function empty field
  function fnEmptyfield(){
    // $('#sparesid').val("");
    $('#showremainstock').text("");
    $('#showsparesid').text("");
    $('#sparesname').val(""); $('#withdrawqty').val("0");
    $('#brandspareid').val(""); $('#price').val("0");
    $('#brandsparename').val(""); $('#unitid').val("");
    $('#model').val(""); $('#unitname').val("");
    $('#madeyear').val(""); $('#total').val("0");
  }

  // show file name
  $('body').on('change', '#receivecarfile', function(){
    var filename = $('#receivecarfile')[0].files[0].name;
    $('#showdoc').text(filename);
  });

  $('#withdrawdate').bootstrapMaterialDatePicker
    ({
        time: false,
        clearButton: true
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

  // change customer and car
  $('body').on('change', '#cusid', function(){
    var cusid = $(this).val();
    loadCarBycusid(cusid=cusid);
  });
});