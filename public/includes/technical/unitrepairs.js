$(document).ready(function(){
  $.ajaxSetup({
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  });

  // function show repair unit
  showrpunit();
  function showrpunit(){
    $.ajax({
      url: '/showunitrepair',
      type: 'POST',
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#showunitrp').html(data.result);
        $('#btnUpdate').attr("id", "btnAdd");
        $('#unitrpname').val("");
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
  }

  // function add new unitrp
  $('body').on('click', '#btnAdd', function(){
    var unitrpname = $('#unitrpname').val();
    if(unitrpname === ""){
      swal("ຜ​ິດ​ຜາດ!","ກະ​ລຸ​ນາ​ປ້ອນ​ຊື່​ຫົວ​ໜ່ວຍ​ການ​ສ້ອມ​ແປງ​ກ່ອນ!","warning", {button: false, timer: 3000});
    }else{
      $.ajax({
        url: '/addnewunitrp',
        type: 'POST',
        data: {unitrpname:unitrpname},
        dataType: 'json',
        success: function(data){
          swal("ສຳ​ເລັດ", data,"success",{button: false, timer: 3000});
          showrpunit();
        }, error: function(data){
          console.log('Error: ' + data);
        }
      })
    }
  });

  // function get data to edit
  $('body').on('click', '#btnEditUnitrp', function(){
    var unitrpid = $(this).val();
    $.ajax({
      url: '/getUnitrpID',
      type: 'POST',
      data: {unitrpid:unitrpid},
      dataType: 'json',
      success: function(data){
        $('#btnAdd').attr("id", "btnUpdate");
        $('#unitrpid').val(unitrpid);
        $('#unitrpname').val(data.unitrpname);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
  });

  // function update data
  $('body').on('click', '#btnUpdate', function(){
    var unitrpid = $('#unitrpid').val();
    var unitrpname = $('#unitrpname').val();
    if(unitrpname === ""){
      swal("ຜ​ິດ​ຜາດ!","ກະ​ລຸ​ນາ​ປ້ອນ​ຊື່​ຫົວ​ໜ່ວຍ​ການ​ສ້ອມ​ແປງ​ກ່ອນ!","warning", {button: false, timer: 3000});
    }else{
      $.ajax({
        url: '/updateUnitrp',
        type: 'POST',
        data: {unitrpid:unitrpid, unitrpname:unitrpname},
        dataType: 'json',
        success: function(data){
          swal("ສຳ​ເລັດ", data,"success",{button: false, timer: 3000});
          showrpunit();
        }, error: function(data){
          console.log('Error: ' + data);
        }
      })
    }
  });

  // delete unit repair
  $('body').on('click', '#btnDelUnitrp', function(){
    var unitrpid = $(this).val();
    swal({
      title: "ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ບໍ່",
      text: "ກົດ​ຕົກ​ລົງ​ເພື່ອ​ລົບ, ຍົກ​ເລີກ​ການ​ລຶບ​ດ້ວຍ​ການ​ກົດ​ບ່ອນ​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົ​ກ​ລົງ",
      dangerMode: true
    }).then((willDelete) => {
      if(willDelete){
        $.ajax({
          url: '/deleteUnitrp',
          type: 'POST',
          data: {unitrpid:unitrpid},
          dataType: 'json',
          success: function(data){
            swal("ສຳ​ເລັດ", data, "success", {button: false, timer: 3000});
            showrpunit();
          }, error: function(data){
            console.log('Error: ' + data);
          }
        });
      }else{
        swal("ການ​ລຶ​ບ​ຖືກ​ຍົກ​ເລີກ", {
          icon: "error",
          button: false,
          timer: 2000
        });
      }
    });
  });

  // function search unit repair
  $('body').on('keyup', '#searchunit', function(){
    var textsearch = $(this).val().toLowerCase();
    $("#showunitrp tr").filter(function(){
      $(this).toggle($(this).text().toLowerCase().indexOf(textsearch) > -1)
    });
  });
});