$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('body').on('click', '#btnEdit', function(){
    var wageid = $(this).val();
    $.ajax({
      url: '/getWagedata',
      type: 'POST',
      data: {wageid:wageid},
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#wageid').val(wageid);
        $('#wagename').val(data.wagename);
        $('#guaranty').val(data.guaranty);
        $('#timeset').val(data.timeset);
        $('#cost').val(data.cost);
        $('#typeserviceid option[value="'+data.typeserviceid+'"').attr("selected", true);
        showTypespares(data.typeserviceid);
        setTimeout(() => {
          $('#typesparesid option[value="'+data.typesparesid+'"').attr("selected", true);
        }, 1000);
        $('#tcarid option[value="'+data.tcarid+'"').attr("selected", true);
        $('#unitrpid option[value="'+data.unitrpid+'"').attr("selected", true);
        $('#editModal').modal('show');
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  });

  // function delete wage data
  $('body').on('click', '#btnDelete', function(){
    var wageid = $(this).val();
    swal({
      title: "ທ່ານ​ໝັ່ນ​ໃຈ​ຕ້ອງ​ການ​ລຶບ​ແທ້​ບໍ່?",
      text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = '/deletewage/'+wageid;
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

  // function search wage data
  $('body').on('click', '#btnSearchwage', function(){
    var textsearch = $('#searchwage').val();
    if(textsearch === ""){
      swal("ຜິດ​ພາດ","ກະ​ລຸ​ນາ​ປ້ອນ​ຂໍ້​ມູນ​ທີ່​ທ່ານ​ຕ້ອງ​ການ​ຄົ້ນ​ຫາ!","warning",{timer: 3000});
    }else{
      $.ajax({
        url: '/searchWagedata',
        type: 'POST',
        data: {textsearch:textsearch},
        dataType: 'json',
        success: function(data){
          // console.log(data);
          $('#showsearch').html(data.result);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      })
    }
  });

  function showTypespares(typeserviceid = ""){
    $.ajax({
      url: '/selectTypeservice',
      type: 'POST',
      data: {typeserviceid:typeserviceid},
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#typesparesid').html(data.result);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  }

  $('body').on('change', '#typeserviceid', function(){
    var typeserviceid = $(this).val();
    showTypespares(typeserviceid);
  });

});