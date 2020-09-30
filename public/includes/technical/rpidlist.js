$(document).ready(function(){
  $('body').on('click', '#btnEdit', function(){
    var rpnoid = $(this).val();
    $.ajax({
      url: '/getrpnodata',
      type: 'POST',
      data: {rpnoid:rpnoid},
      dataType: 'json',
      success: function(data){
        $('#editrpnoid').val(rpnoid);
        $('#typesparesid option[value="'+data.typesparesid+'"]').prop('selected', true);
        getSparedata(data.typesparesid);
        setTimeout(() => {
          $('#sparesid option[value="'+data.sparesid+'"]').prop('selected', true);
        }, 1000)
        $('#modalData').modal('show');
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
  });

  // delete repairsno
  $('body').on('click', '#btnDelete', function(){
    var rpnoid = $(this).val();
    swal({
      title: "ທ່ານ​ໝັ່ນ​ໃຈ​ຕ້ອງ​ການ​ລຶບ​ແທ້​ບໍ່?",
      text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = '/deleteRpnoid/'+rpnoid;
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

  $('body').on('click', '#btnSearch', function(){
    var textsearch = $('#searchrpnoid').val();
    if(textsearch === ""){
      swal("ຜິດ​ພາດ", "ກະ​ລຸ​ນາ​ໃສ່​ຂໍ້​ມູນ​ທີ່​ທ່ານ​ຕ້ອງ​ການ​ຄົ້ນ​ຫາ!","error", {button: false, timer: 3000});
    }else{
      $.ajax({
        url: '/searchRpnoid',
        type: 'POST',
        data: {style:style,textsearch:textsearch},
        dataType: 'json',
        success: function(data){
          // console.log(data);
          $('#rpnoshowlist').html(data.result);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      })
    }
  });

  $('body').on('change', '#typesparesid', function(){
    var typesparesid = $(this).val();
    getSparedata(typesparesid);
  });

  // function get data sparedata
  function getSparedata(typesparesid=""){
    $.ajax({
      url: '/gettypesparedt',
      type: 'POST',
      data: {typesparesid:typesparesid},
      dataType: 'json',
      success: function(data){
        $('#sparesid').html(data.result);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  }

  $('#sparesid').select2();
});