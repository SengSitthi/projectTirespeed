$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('#btnUpdate').hide();

  // function load typespare
  loadTypeSpare();
  function loadTypeSpare(){
    $.ajax({
      url: '/loadTypespare',
      type: 'POST',
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#typesparelist').html(data.typesparedt);
      }, error:function(data){
        console.log('Error: ' + data);
      }
    });
  }
  // btnadd type spare
  $('body').on('click', '#btnAdd', function(){
    var typesparename = $('#typesparename').val();
    var typeserviceid = $('#typeserviceid').val();
    if(typesparename === ""){
      // fnAlert(title='​ຜິດ​ພາດ', text='ຊື່​ປະ​ເພດ​ອະ​ໄຫຼ່​ຍັງເປັນ​ຄ່າ​ວ່າງ ກະ​ລຸ​ນາ​ໃສ່​ຂໍ້​ມູນ', icon='error');
      alert(typeserviceid);
    }else{
      $.ajax({
        url: '/insertTypespare',
        type: 'POST',
        data: {typesparename:typesparename,typeserviceid:typeserviceid},
        dataType: 'json',
        success: function(data){
          fnAlert(title="ສຳ​ເລັດ", text=data, icon="success");
          loadTypeSpare();
          $('#typesparename').val("");
          // console.log(data);
        }, error: function(data){
          console.log('Error: ' +data);
        }
      })
    }
  });

  // btn get data to edit
  $('body').on('click', '#btnEdit', function(){
    var typesparesid = $(this).val();
    $.ajax({
      url: '/gettypespare',
      type: 'POST',
      data: {typesparesid:typesparesid},
      dataType: 'json',
      success: function(data){
        $('#typeserviceid option[value="'+data.typeserviceid+'"]').prop('selected', true);
        $('#typesparename').val(data.typesparename);
        $('#typesparesid').val(typesparesid);
        $('#btnAdd').hide();
        $('#btnUpdate').show();
        // console.log(data);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
  });

  // btn update data
  $('body').on('click', '#btnUpdate', function(){
    var typesparesid = $('#typesparesid').val();
    var typesparename = $('#typesparename').val();
    var typeserviceid = $('#typeserviceid').val();
    if(typesparename === ""){
      fnAlert(title='ຜິດ​ພາດ', text='ຊື່​ປະ​ເພດ​ອະ​ໄຫຼ່​ຍັງ​ເປັນ​ຄ່າ​ຫວ່າງ', icon='error');
    }else{
      $.ajax({
        url: '/updateTypespare',
        type: 'POST',
        data: {typesparesid:typesparesid,typesparename:typesparename,typeserviceid:typeserviceid},
        dataType: 'json',
        success: function(data){
          fnAlert(title='ສຳ​ເລັດ', text=data, icon='success');
          loadTypeSpare();
          $('#btnAdd').show();
          $('#btnUpdate').hide();
          $('#typesparename').val("");
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }
  });

  // function delete type spare data
  $('body').on('click', '#btnDelete', function(){
    var typesparesid = $(this).val();
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
          url: '/deleteTypespare',
          type: 'POST',
          data: {typesparesid:typesparesid},
          dataType: 'json',
          success: function(data){
            fnAlert(title='ສຳ​ເລັດ', text=data, icon='success');
            $('#btnAdd').show();
            $('#btnUpdate').hide();
            $('#typesparename').val("");
            loadTypeSpare();
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
  function fnAlert(title='', text='', icon=''){
    swal({
      title: title,
      text: text,
      icon: icon,
      button: false,
      timer: 2500
    });
  }
});