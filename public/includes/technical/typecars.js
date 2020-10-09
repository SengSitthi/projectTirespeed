$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  
  // function show Type of car
  showTypecars();
  function showTypecars(){
    $.ajax({
      url: '/showtypecars',
      type: 'POST',
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#showTypecar').html(data.result);
        $('#tcarname').val("");
        $('#btnUpdateTC').attr("id", "btnSaveTC");
        $('#searchtc').val("");
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  }

  // function insert new type car
  $('body').on('click', '#btnSaveTC', function(){
    var tcarname = $('#tcarname').val();
    if(tcarname === ""){
      swal("ຜິດ​ພາດ!", "ທ່ານ​ຍັງ​ບໍ່​ໄດ້​ໃສ່​ຊື່​ປະ​ເພດ​ລ​ົດ!", "warning", {button: false, timer: 3000});
    }else{
      $.ajax({
        url: '/insertnewtypecar',
        type: 'POST',
        data: {tcarname:tcarname},
        dataType: 'json',
        success: function(data){
          swal("ສຳ​ເລັດ", data, "success", {timer: 3000});
          showTypecars();
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }
  });

  // function get data to edit
  $('body').on('click', '#btnEditTC', function(){
    var tcarid = $(this).val();
    $.ajax({
      url: '/getTypecardata',
      type: 'POST',
      data: {tcarid:tcarid},
      dataType: 'json',
      success: function(data){
        $('#btnSaveTC').attr("id", "btnUpdateTC");
        $('#tcarid').val(tcarid);
        $('#tcarname').val(data.tcarname);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  });

  // function update type car data
  $('body').on('click', '#btnUpdateTC', function(){
    var tcarid = $('#tcarid').val();
    var tcarname = $('#tcarname').val();
    $.ajax({
      url: '/updateTypecar',
      type: 'POST',
      data: {tcarid:tcarid,tcarname:tcarname},
      dataType: 'json',
      success: function(data){
        swal("ສຳ​ເລັດ", data, "success", {timer: 3000});
        showTypecars();
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  });

  // function delete type 
  $('body').on('click', '#btnDelTC', function(){
    var tcarid = $(this).val();
    swal({
      title: "ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ບໍ່",
      text: "ກົດ​ຕົກ​ລົງ​ເພື່ອ​ລົບ, ຍົກ​ເລີກ​ການ​ລຶບ​ດ້ວຍ​ການ​ກົດ​ບ່ອນ​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົ​ກ​ລົງ",
      dangerMode: true
    }).then((willDelete) => {
      if(willDelete){
        $.ajax({
          url: '/deleteTypecus',
          type: 'POST',
          data: {tcarid:tcarid},
          dataType: 'json',
          success: function(data){
            swal("ສຳ​ເລັດ", data, "success", {timer: 3000});
            showTypecars();
          }, error: function(data){
            console.log('Error: ' + data);
          }
        })
      }else{
        swal("ການ​ລຶ​ບ​ຖືກ​ຍົກ​ເລີກ", {
          icon: "error",
          button: false,
          timer: 2000
        });
      }
    });
  });

  // function search type car
  $('body').on('keyup', '#searchtc', function(){
    var textsearch = $(this).val().toLowerCase();
    $('#showTypecar tr').filter(function(){
      $(this).toggle($(this).text().toLowerCase().indexOf(textsearch) > -1)
    });
  });
});