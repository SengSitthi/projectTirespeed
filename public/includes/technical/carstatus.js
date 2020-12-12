$(document).ready(function(){
  $.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  
  // function get data to insert new car status
  $('body').on('change', '#rpbid', function(){
    var rpbid = $(this).val();
    if(rpbid === ""){
      $('#license').val("");
      $('#date_in').val("");
      $('#time_in').val("");
    }else{
      $.ajax({
        url: '/getreceivedata',
        type: 'POST',
        data: {rpbid:rpbid},
        dataType: 'json',
        success: function(data){
          // console.log(data);
          $('#license').val(data.license);
          $('#date_in').val(data.date_in);
          $('#time_in').val(data.time_in);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }
  });

  // function update date_out of customer's car
  $('body').on('click', '#btnUpdateDate', function(){
    var date_outid = $(this).val();
    $('#editdate_out').val(date_outid);
    $('#modalDateout').modal('show');
  });

  // function update time_out of customer's car
  $('body').on('click', '#btnUpdateTime', function(){
    var time_outid = $(this).val();
    $('#edittime_out').val(time_outid);
    $('#modalTimeout').modal('show');
  });

  // function update car status
  $('body').on('click', '#btnStatus', function(){
    var statusid = $(this).val();
    $('#statusid').val(statusid);
    $('#modalStatus').modal('show');
  });

  // function delete car status
  $('body').on('click','#btnDelete', function(){
    var tscid = $(this).val();
    swal({
      title: "ທ່ານ​ໝັ່ນ​ໃຈ​ຕ້ອງ​ການ​ລຶບ​ແທ້​ບໍ່?",
      text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = '/deleteCarstatus/'+tscid;
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

  $('#rpbid').select2();
  $('#date_out').bootstrapMaterialDatePicker({
    time: false,
    clearButton: true
  });
  $('#time_out').bootstrapMaterialDatePicker({ date: false, clearButton: true, shortTime: false, format: 'HH:mm'});
});