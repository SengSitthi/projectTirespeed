$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  // function autocomplete
  $('body').on('keyup', '#searchspares', function(){
    var search = $(this).val();
    // alert(search);
    if(search === ""){
      $('#searchspares').focus();
      $('#listsparesearch').fadeOut();
    }else{
      $.ajax({
        url: '/searchsparescomplete',
        type: 'POST',
        data: {search:search},
        dataType: 'json',
        success: function(data){
          // console.log(data);
          $('#listsparesearch').fadeIn();
          $('#listsparesearch').html(data.result);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }
  });

  $(document).on('click', 'li', function(){
    $('#searchspares').val($(this).text());
    $('#listsparesearch').fadeOut();
  });

  // function show seach data
  $('body').on('click', '#btnSearchspare', function(){
    var datasearch = $('#searchspares').val();
    $.ajax({
      url: '/showsearchdata',
      type: 'POST',
      data: {datasearch:datasearch},
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#sparelist').html(data.result);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
  });

  /// open barcode modal
  $('body').on('click', '#btnBarcode', function(){
    var sparesid = $(this).val();
    $('#sparesid').val(sparesid);
    $('#barcodeprint').modal('show');
  });

  //
  // change typeservice to select type spare
  $('body').on('change', '#typeserviceid', function(){
    var typeserviceid = $(this).val();
    if(typeserviceid === ""){

    }else{
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
  });

  // change type spare to select brand spare
  // $('body').on('change', '#typesparesid', function(){
  //   var typesparesid = $(this).val();
  //   if(typesparesid === ""){

  //   }else{
  //     $.ajax({
  //       url: '/selectBrandspare',
  //       type: 'POST',
  //       data: {typesparesid:typesparesid},
  //       dataType: 'json',
  //       success: function(data){
  //         // console.log(data);
  //         $('#brandspareid').html(data.result);
  //       }, error: function(data){
  //         console.log('Error: ' + data);
  //       }
  //     });
  //   }
  // });

  // btnEdit click
  $('body').on('click', '#btnEdit', function(){
    var sparesid = $(this).val();
    $.ajax({
      url: '/getSparetoedit',
      type: 'POST',
      data: {sparesid:sparesid},
      dataType: 'json',
      success: function(data){
        $('#sparesid1').val(sparesid);
        $('#sparesname').val(data.sparesname);
        $('#typeserviceid option[value="'+data.typeserviceid+'"]').prop('selected', true);
        $('#typesparesid option[value="'+data.typesparesid+'"]').prop('selected', true);
        $('#brandspareid option[value="'+data.brandspareid+'"]').prop('selected', true);
        $('#model').val(data.model);
        $('#brandid option[value="'+data.brandid+'"]').prop('selected', true);
        $('#carmodel').val(data.carmodel);
        $('#madeyear').val(data.madeyear);
        $('#sellprice').val(data.sellprice);
        $('#unitid option[value="'+data.unitid+'"]').prop('selected', true);
        $('#editspare').modal('show');
        console.log(data);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  });

  $('body').on('click', '#btnDelete', function(){
    var sparesid = $(this).val();
    swal({
      title: "ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ຂໍ​ມູ້ນ​ນີ້ແທ້​ບໍ່?",
      text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = '/deleteSpares/'+sparesid;
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


});