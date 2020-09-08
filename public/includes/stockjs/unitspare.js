$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('#btnUpdate').hide();
  // function load unit spare
  loadUnitspare();
  function loadUnitspare(){
    $.ajax({
      url: '/loadUnitspare',
      type: 'POST',
      dataType: 'json',
      success: function(data){
        $('#unitsparelist').html(data.unitdata);
        $('#btnUpdate').hide();
        $('#unitname').val("");
        $('#btnAdd').show();
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  }


  // function add unit spare
  $('body').on('click', '#btnAdd', function(){
    var unitname = $('#unitname').val();
    if(unitname === ""){
      fnAlert(title='ຜິດ​ພາດ', text='ຂໍ້​ມູນ​ຫົວ​ໜ່ວຍ​ຍັງ​ເປັນ​ຄ່າ​ຫວ່າງ',icon='warning');
    }else{
      $.ajax({
        url: '/insertUnitspare',
        type: 'POST',
        data: {unitname:unitname},
        dataType: 'json',
        success: function(data){
          fnAlert(title='ສຳ​ເລັດ', text=data, icon='success');
          loadUnitspare();
        }, error: function(data){
          console.log('Error: ' + data);
        }
      })
    }
  });

  // function get data to edit
  $('body').on('click', '#btnEdit', function(){
    var unitid = $(this).val();
    $.ajax({
      url: '/getUnitdata',
      type: 'POST',
      data: {unitid:unitid},
      dataType: 'json',
      success: function(data){
        $('#unitid').val(data.unitid);
        $('#unitname').val(data.unitname);
        $('#btnUpdate').show();
        $('#btnAdd').hide();
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
  });

  // function update data
  $('body').on('click', '#btnUpdate', function(){
    var unitid = $('#unitid').val();
    var unitname = $('#unitname').val();
    if(unitname === ""){
      fnAlert(title='ຜິດ​ພາດ',text='ຊື່​ຫົວ​ໜ່ວຍ​ຍັງ​ເປັນ​ຄ່າ​ຫວ່າງ', icon='warning');
      $('#unitname').focus();
    }else{
      $.ajax({
        url: '/updateUnitspare',
        type: 'POST',
        data: {unitid:unitid,unitname:unitname},
        dataType: 'json',
        success: function(data){
          fnAlert(title='ສຳ​ເລັດ', text=data, icon='success');
          loadUnitspare();
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }
  });

  // function delete data
  $('body').on('click', '#btnDelete', function(){
    var unitid = $(this).val();
    swal({
      title: "ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ຂໍ​ມູ້ນ​ນີ້ແທ້​ບໍ່?",
      text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: '/deleteUnitspare',
          type: 'POST',
          data: {unitid:unitid},
          dataType: 'json',
          success: function(data){
            fnAlert(title='ສຳ​ເລັດ', text=data, icon='success');
            loadUnitspare();
          }, error: function(data){
            console.log('Error: ' + data);
          }
        });
      } else {
        // swal("Your imaginary file is safe!");
        swal("ການ​​ລຶບ​ຖືກ​ຍົກ​ເລີກ", {
          icon: "warning",
          button:false,
          timer:2000
        });
      }
    });
  });

  // function alert
  function fnAlert(title='',text='',icon=''){
    swal({
      title: title,
      text: text,
      icon: icon,
      button: false,
      timer: 2500
    });
  }
});