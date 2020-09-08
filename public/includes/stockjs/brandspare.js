$(document).ready(function(){
  $.ajaxSetup({
    header: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('#btnUpdate').hide();

  // Function get data to show
  loadBrandspare();
  function loadBrandspare(){
    $.ajax({
      url: '/loadBrandspare',
      type: 'POST',
      dataType: 'json',
      success: function(data){
        $('#brandsparelist').html(data.result);
        // console.log(data);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  }

  // function add brand spare data
  $('body').on('click', '#btnAdd', function(){
    var brandsparename = $('#brandsparename').val();
    if(brandsparename === ""){
      fnAlert(title='ຜິດ​ພາດ', text='ຊື່​ຍີ່​ຫໍ້​ອະ​ໄຫຼ່​ຍັງ​ເປັນ​ຄ່າ​ຫວ່າງ', icon='error');
    }else{
      $.ajax({
        url: '/insertBrandspare',
        type: 'POST',
        data: {brandsparename:brandsparename},
        dataType: 'json',
        success: function(data){
          fnAlert(title='ສຳ​ເລັດ', text=data, icon='success');
          $('#brandsparename').val("");
          loadBrandspare();
        }, error: function(data){
          console.log('Error: ' + data);
        }
      })
    }
  });

  // funtion get data to update
  $('body').on('click', '#btnEdit', function(){
    var brandspareid = $(this).val();
    $.ajax({
      url: '/getBrandspare',
      type: 'POST',
      data: {brandspareid:brandspareid},
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#brandsparename').val(data.brandsparename);
        $('#brandspareid').val(brandspareid);
        $('#btnAdd').hide();
        $('#btnUpdate').show();
      }, error: function(data){
        console.log('Error :' + data);
      }
    });
  });

  // function update data
  $('body').on('click', '#btnUpdate', function(){
    var brandspareid = $('#brandspareid').val();
    var brandsparename = $('#brandsparename').val();
    // alert(brandspareid + ' ' + brandsparename + ' ' + typesparesid);
    if(brandsparename === ""){
      fnAlert(title='ຜິດ​ພາດ', text='ຂໍ້​ມູນ​ຊື່​ຍີ່​ຫໍ້​ອະ​ໄຫຼ່​ຍັງ​ເປັນ​ຄ່າ​ຫວ່າງ', icon='error');
    }else{
      $.ajax({
        url: '/updateBrandspare',
        type: 'POST',
        data: {brandspareid:brandspareid,brandsparename:brandsparename},
        dataType: 'json',
        success: function(data){
          fnAlert(title='ສຳ​ເລັດ', text=data, icon='success');
          $('#brandsparename').val("");
          $('#btnAdd').show();
          $('#btnUpdate').hide();
          loadBrandspare();
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }
  });

  // function delete brand spare
  $('body').on('click', '#btnDelete', function(){
    var brandspareid = $(this).val();
    swal({
      title: "ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ຂໍ​ມູ້ນ​ນີ້ແທ້​ບໍ່?",
      text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        $.ajax({
          url: '/deleteBrandspare',
          type: 'POST',
          data: {brandspareid:brandspareid},
          dataType: 'json',
          success: function(data){
            fnAlert(title='ສ​ຳ​ເລັດ', text=data, icon='success');
            $('#btnAdd').show();
            $('#btnUpdate').hide();
            $('#brandsparename').val("");
            loadBrandspare();
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