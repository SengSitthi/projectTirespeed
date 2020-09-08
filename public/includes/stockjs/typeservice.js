$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
    }
  });

  $('#btnUpdate').hide();

  // function load typeservice data
  loadTypeservice();
  function loadTypeservice(){
    $.ajax({
      url: '/loadtypeservice',
      type: 'POST',
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#servicelist').html(data.result);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
  }

  // function add type service
  $('body').on('click', '#btnAdd', function(){
    var typeservicename = $('#typeservicename').val();
    if(typeservicename === ""){
      fnAlert(title='ຜິດ​ພາດ', text='ກະ​ລຸ​ນາ​ໃສ່​ຊື່​ປະ​ເພດ​ບໍ​ລິ​ການ', icon='error');
      $('#typeservicename').focus();
    }else{
      $.ajax({
        url: '/insertTypeservice',
        type: 'POST',
        data: {typeservicename:typeservicename},
        dataType: 'json',
        success: function(data){
          fnAlert(title='ສຳ​ເລັດ', text=data, icon='success');
          $('#typeservicename').val("");
          loadTypeservice();
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }
  });

  // function edit type service
  $('body').on('click', '#btnEdit', function(){
    var typeserviceid = $(this).val();
    $.ajax({
      url: '/getTypeservicedata',
      type: 'POST',
      data: {typeserviceid:typeserviceid},
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#typeserviceid').val(typeserviceid);
        $('#typeservicename').val(data.typeservicename);
        $('#btnAdd').hide();
        $('#btnUpdate').show();
      }, error: function(data){
        console.log('Error: '+data);
      }
    });
  });

  /// function update type service
  $('body').on('click', '#btnUpdate', function(){
    var typeserviceid = $('#typeserviceid').val();
    var typeservicename = $('#typeservicename').val();
    if(typeservicename === ""){
      fnAlert(title='ຜິດ​ພາດ', text='ກະ​ລຸ​ນາ​ໃສ່​ຊື່​ປະ​ເພດ​ບໍ​ລິ​ການ', icon='error');
      $('#typeservicename').focus();
    }else{
      $.ajax({
        url: '/updateTypeservice',
        type: 'POST',
        data: {typeserviceid:typeserviceid,typeservicename:typeservicename},
        dataType: 'json',
        success: function(data){
          // console.log(data);
          fnAlert(title='ສຳ​ເລັດ', text=data, icon='success');
          $('#btnAdd').show();
          $('#btnUpdate').hide();
          $('#typeservicename').val("");
          loadTypeservice();
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }
  });

  $('body').on('click', '#btnDelete', function(){
    var typeserviceid = $(this).val();
    swal({
      title: "ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ຂໍ​ມູ້ນ​ນີ້ແທ້​ບໍ່?",
      text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        $.ajax({
          url: '/deteleTypeservice',
          type: 'POST',
          data: {typeserviceid:typeserviceid},
          dataType: 'json',
          success: function(data){
            fnAlert(title='ສຳ​ເລັດ', text=data, icon='success');
            loadTypeservice();
            $('#btnAdd').show();
            $('#btnUpdate').hide();
            $('#typeservicename').val("");
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