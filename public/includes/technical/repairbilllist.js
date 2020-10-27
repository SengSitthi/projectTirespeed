$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function getShowlistdata(rpbid=""){
    $.ajax({
      url: '/getShowrpbdetail',
      type: 'POST',
      data: {rpbid:rpbid},
      dataType: 'json',
      success: function(data){
        $('#showrpbdetail').html(data.result);
        $('#sparename').val("");
        $('#wagename').val("");
        $('#unitrpname').val("");
        $('#rpnoid').val("");
        $('#wageid').val("");
        $('#useqty').val("");
        // console.log(data);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
  }

  $('body').on('click', '#btnEditList', function(){
    var rpbid = $(this).val();
    $('#rpbid').val(rpbid);
    getShowlistdata(rpbid);
    $('#modalEditlist').modal('show');
  });

  // search spare name by repair no
  $('body').on('keyup', '#rpnoid', function(){
    var textsearch = $(this).val();
    if(textsearch.length == 8){
      $.ajax({
        url: '/getsparename',
        type: 'POST',
        data: {textsearch:textsearch},
        dataType: 'json',
        success: function(data){
          // console.log(data);
          $('#sparename').val(data.sparesname);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }else{
      $('#sparename').val("");
    }
  });
  
  // search wage
  $('body').on('keyup', '#wageid', function(){
    // var id = $(this).attr("id");
    var textsearch = $(this).val();
    if(textsearch.length == 8){
      $.ajax({
        url: '/getwagedata',
        type: 'POST',
        data: {textsearch:textsearch},
        dataType: 'json',
        success: function(data){
          // console.log(data);
          $('#wagename').val(data.wagename);
          $('#unitrpname').val(data.unitrpname);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      })
    }
  });

  // save new list
  $('body').on('click', '#btnSavelist', function(){
    var rpnoid = $('#rpnoid').val();
    var useqty = $('#useqty').val();
    var wageid = $('#wageid').val();
    var rpbid = $('#rpbid').val();
    if(rpnoid === ""){
      swal("ຜິດ​ພາດ!","ກະ​ລຸ​ນາ​ປ້ອນ​ລະ​ຫັດ​ບໍ​ລິ​ການ​ກ່ອນ","warning",{timer: 3000});
    }else if(wageid === ""){
      swal("ຜິດ​ພາດ!","ກະ​ລຸ​ນາ​ປ້ອນ​ລະ​ຫັດ​ຄ່າ​ແຮງ​ງານ​ກ່ອນ","warning",{timer: 3000});
    }else if(useqty === ""){
      swal("ຜິດ​ພາດ!","ກະ​ລຸ​ນາ​ປ້ອນ​ຈຳ​ນວນ​ອະ​ໄຫຼ່​ທີ່​ຕ້ອງ​ໃຊ້​ກ່ອນ","warning",{timer: 3000});
    }else{
      $.ajax({
        url: '/addnewrpblist',
        type: 'POST',
        data: {rpbid:rpbid,rpnoid:rpnoid,useqty:useqty,wageid:wageid},
        dataType: 'json',
        success: function(data){
          swal("ສ​ຳ​ເລັດ", data, "warning", {timer:3000});
          getShowlistdata(rpbid);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      })
    }
  });

  // function trash rpbdetail list
  $('body').on('click', '#btnTrashlist', function(){
    var rpbdtid = $(this).val();
    var rpbid = $('#rpbid').val();
    $.ajax({
      url: '/delrpblistdata',
      type: 'POST',
      data: {rpbdtid:rpbdtid},
      dataType: 'json',
      success: function(data){
        swal("ສຳ​ເລັດ!", data, "warning", {timer: 3000});
        getShowlistdata(rpbid);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  });

  // edit rpb data
  $('body').on('click', '#btnEditrpb', function(){
    var rpbid = $(this).val();
    $.ajax({
      url: '/geteditrpbdata',
      type: 'POST',
      data: {rpbid:rpbid},
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#rpbid1').val(rpbid);
        $('#rcsid').val(data.rcsid);
        $('#rpbdate').val(data.rpbdate);
        $('#modaleditrpb').modal('show');
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
  });

  // delete repair bill data
  $('body').on('click', '#btnTrashrpb', function(){
    var rpbid = $(this).val();
    swal({
      title: "ທ່ານ​ໝັ່ນ​ໃຈ​ຕ້ອງ​ການ​ລຶບ​ແທ້​ບໍ່?",
      text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = '/deleterpbdata/'+rpbid;
      } else {
        // swal("Your imaginary file is safe!");
        swal("ການ​​ລຶບ​ຖືກ​ຍົກ​ເລີກ", {
          icon: "error",
          button:false,
          timer:2000
        });
      }
    });
  });

  // function search
  $('body').on('click', '#btnSearch', function(){
    var textsearch = $("#textsearch").val();
    if(textsearch === ""){
      swal("ຜິດ​ພາດ","ກະ​ລຸ​ນາ​ປ້ອນ​ຂໍ້​ມູນ​ທີ່​ທ່ານ​ຕ້ອງ​ການ​ຄົ້ນ​ຫາ!","warning", {timer: 3000});
    }else{
      $.ajax({
        url: '/searchrepairbill',
        type: 'POST',
        data: {textsearch:textsearch},
        dataType: 'json',
        success: function(data){
          // console.log(data);
          $('#rpbdetail').html(data.result);
        }, error: function(data){
          console.log('Error ' + data);
        }
      });
    }
  });


  // $('#rcsid').select2();
  $('#rpbdate').bootstrapMaterialDatePicker({
    time: false,
    clearButton: true
  });
});