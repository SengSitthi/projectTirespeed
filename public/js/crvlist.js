$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
    }
  });
  $('body').on('click', '#btnChecklist', function(){
    var rcsid = $(this).val();
    // alert(rcsid);
    $.ajax({
      url: '/getrcsdata',
      type: 'POST',
      data: {rcsid:rcsid},
      dataType: 'json',
      success: function(data){
        $('#checkrcsid').val(rcsid);
        $('#cusid option[value="'+data.cusid+'"]').prop('selected', true);
        console.log(data);
        getCar(data.cusid);
        setTimeout(() => {
          $('#carid option[value="'+data.carid+'"]').prop('selected', true);
        }, 1000);
        $('#date_receive').val(data.date_receive);
        $('#time_receive').val(data.time_receive);
        $('#meter').val(data.meter);
        $('#type_car option[value="'+data.type_car+'"]').prop('selected', true);
        $('#gear option[value="'+data.gear+'"]').prop('selected', true);
        $('#leveloil option[value="'+data.leveloil+'"]').prop('selected', true);
        $('#front option[value="'+data.front+'"]').prop('selected', true);$('#front_remark').val(data.front_remark);
        $('#left option[value="'+data.left+'"]').prop('selected', true);$('#left_remark').val(data.left_remark);
        $('#right option[value="'+data.right+'"]').prop('selected', true);$('#right_remark').val(data.right_remark);
        $('#back option[value="'+data.back+'"]').prop('selected', true);$('#back_remark').val(data.back_remark);
        $('#wheels option[value="'+data.wheels+'"]').prop('selected', true);$('#wheels_remark').val(data.wheels_remark);
        $('#seats option[value="'+data.seats+'"]').prop('selected', true);$('#seats_remark').val(data.seats_remark);
        $('#doors option[value="'+data.doors+'"]').prop('selected', true);$('#doors_remark').val(data.doors_remark);
        $('#mirror option[value="'+data.mirror+'"]').prop('selected', true);$('#mirror_remark').val(data.mirror_remark);
        $('#sound option[value="'+data.sound+'"]').prop('selected', true);$('#sound_remark').val(data.sound_remark);
        $('#meter_display option[value="'+data.meter_display+'"]').prop('selected', true);$('#meterdis_remark').val(data.meterdis_remark);
        $('#accessories option[value="'+data.accessories+'"]').prop('selected', true);$('#accessories_remark').val(data.accessories_remark);
        $('#valuables option[value="'+data.valuables+'"]').prop('selected', true);$('#valuables_remark').val(data.valuables_remark);
        $('#check33 option[value="'+data.check33+'"]').prop('selected', true);
        $('#maintenance option[value="'+data.maintenance+'"]').prop('selected', true);
        $('#maintenance_list option[value="'+data.maintenance_list+'"]').prop('selected', true);
        $('#repairs option[value="'+data.repairs+'"]').prop('selected', true);
        $('#tire_service option[value="'+data.tire_service+'"]').prop('selected', true);$('#tire_detail').val(data.tire_detail);
        $('#modalChecklist').modal('show');
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  });

  // function edit receive car list
  $('body').on('click', '#btnrepairlist', function(){
    var rcsid = $(this).val();
    showRepairlist(rcsid);
  });

  // function add repair list of receivecar
  $('body').on('click', '#btnAddRepairlist', function(){
    var rcsid = $('#rcsidrepair').val();
    var rcs_list = $('#repairlist').val();
    if(rcs_list === ""){
      swal("ຜິດ​ພາດ","ກະ​ລຸ​ນາ​ປ້ອນ​ລາຍ​ການ​ສ້ອມ​ແປງ​ເພີ່ມ​ເຕີມ","warning", {button: false, timer: 3000});
    }else{
      $.ajax({
        url: '/addnewrcslist',
        type: 'POST',
        data: {rcsid:rcsid,rcs_list:rcs_list},
        dataType: 'json',
        success: function(data){
          swal("ສຳ​ເລັດ", data, "success");
          showRepairlist(rcsid);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      })
    }
  });

  // function delete receive car data
  $('body').on('click', '#btnDelRcslist', function(){
    var rcs_detailid = $(this).val();
    swal({
      title: "ທ່ານ​ໝັ່ນ​ໃຈ​ຕ້ອງ​ການ​ລຶບ​ແທ້​ບໍ່?",
      text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: '/delete_rcslist',
          type: 'POST',
          data: {rcs_detailid:rcs_detailid},
          dataType: 'json',
          success: function(data){
            swal("ສຳ​ເລັດ", data, "success");
            showRepairlist($('#rcsidrepair').val());
          }, error: function(data){
            console.log('Error: ' + data);
          }
        })
      } else {
        // swal("Your imaginary file is safe!");
        swal("ການ​​ລຶບ​ຖືກ​ຍົກ​ເລີກ", {
          icon: "error",
          button:false,
          timer:2000
        });
      }
    });
  })

  // function delete receivecar
  $('body').on('click', '#btnDelete', function(){
    var rcsid = $(this).val();
    swal({
      title: "ທ່ານ​ໝັ່ນ​ໃຈ​ຕ້ອງ​ການ​ລຶບ​ແທ້​ບໍ່?",
      text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = '/deleteRcsid/'+rcsid;
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

  // search data
  $('body').on('click', '#btnSearch', function(){
    var style = $('#stylesearch').val();
    var txtsearch = $('#searchtext').val();
    if(style === ""){
      swal("ຜິດ​ພາດ","ທ່ານ​ຍັງ​ບໍ່​ໄດ້​ເລືອກ​ຮູບ​ແບບ​ການ​ຄົ້ນ​ຫາ","warning");
    }else if(txtsearch === ""){
      swal("ຜິ​ດ​ພາດ","ກະ​ລ​ຸ​ນາ​ປ້ອນ​ສິ່ງ​ທີ່​ທ່ານ​ຕ້ອງ​ການ​ຄົ້ນ​ຫາ","warning");
    }else{
      
    }
  });

  function showRepairlist(rcsid = ""){
    $.ajax({
      url: '/showlist',
      type: 'POST',
      data: {rcsid:rcsid},
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#rcsidrepair').val(rcsid);
        $('#showlist').html(data.showlist);
        $('#modalRcslist').modal('show');
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  }

  // show customer car after selected customer
  function getCar(cusid=""){
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
  $('body').on('change', '#cusid', function(){
    var cusid = $(this).val();
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
  });

  $('#date_receive').bootstrapMaterialDatePicker({ time: false, clearButton: true });
  $('#time_receive').bootstrapMaterialDatePicker({ date: false, clearButton: true, shortTime: false, format: 'HH:mm'});
  $('#cusid').select2();
});