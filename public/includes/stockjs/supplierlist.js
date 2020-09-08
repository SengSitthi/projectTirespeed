$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  // button show bank account
  function loadViewbank(id=''){
    $.ajax({
      url: '/viewBank',
      type: 'POST',
      data: {supplierid:id},
      dataType: 'json',
      success: function(data){
        $('#banklist').html(data.result);
        $('#btnUpdatebk').hide();
        $('#btnAddbank').show();
        $('#alertbn').hide();
        $('#alertacnum').hide();
        $('#bankname').val("");
        $('#accountnum').val("");
        // console.log(data);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
  }

  // hide btn update
  $('#btnUpdatebk').hide();
  $('#alertbn').hide();
  $('#alertacnum').hide();
  $('#successbank').hide();

  // edit bank account
  $('body').on('click', '#btnEditBank', function(){
    var supplierid = $(this).val();
    loadViewbank(id=supplierid);
    $('#managebank').modal('show');
    $('#supplierid').val(supplierid);
  });

  // button add bank account
  $('body').on('click', '#btnAddbank', function(){
    var bankname = $('#bankname').val();
    var accountnum = $('#accountnum').val();
    var supplierid = $('#supplierid').val();
    if(bankname === ''){
      $('#alertbn').show();
    }else if(accountnum === ''){
      $('#alertacnum').show();
    }else{
      $.ajax({
        url: '/insertBankdata',
        type: 'POST',
        data: {supplierid:supplierid,bankname:bankname,accountnum:accountnum},
        dataType: 'json',
        success: function(data){
          $('#successbank').show();
          $('#scalert').text(data);
          loadViewbank(id=supplierid);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }
  });

  // function get data to update
  $('body').on('click','#btnEditbank',function(){
    var supaccountid = $(this).val();
    $.ajax({
      url: '/getSupaccountdata',
      type: 'POST',
      data: {supaccountid:supaccountid},
      dataType: 'json',
      success: function(data){
        // console.log(data);
        $('#supaccountid').val(supaccountid);
        $('#bankname').val(data.bankname);
        $('#accountnum').val(data.accountnum);
        $('#btnAddbank').hide();
        $('#btnUpdatebk').show();
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  });

  // function update account
  $('body').on('click', '#btnUpdatebk', function(){
    var supaccountid = $('#supaccountid').val();
    var bankname = $('#bankname').val();
    var accountnum = $('#accountnum').val();
    var supplierid = $('#btnEditBank').val();
    if(bankname === ""){
      $('#alertbn').show();
    }else if(accountnum === ""){
      $('#alertacnum').show();
    }else{
      $.ajax({
        url: '/updateSupaccount',
        type: 'POST',
        data: {supaccountid:supaccountid,bankname:bankname,accountnum:accountnum},
        dataType: 'json',
        success: function(data){
          $('#successbank').show();
          $('#scalert').text(data);
          loadViewbank(id=supplierid);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }
  });

  //function delete account
  $('body').on('click', '#btnDelbank', function(){
    var supaccountid = $(this).val();
    var supplierid = $('#btnEditBank').val();
    $.ajax({
      url: '/deletebankdata',
      type: 'POST',
      data: {supaccountid:supaccountid},
      dataType: 'json',
      success: function(data){
        $('#successbank').show();
        $('#scalert').text(data);
        loadViewbank(id=supplierid);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    })
  });

  // function load district
  function loadDistrict(proid=''){
    $.ajax({
      url: '/selectProvince',
      type: 'POST',
      data: {proid:proid},
      dataType: 'json',
      success: function(data){
        $('#disid').html(data.result);
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
  }

  // get data to update supplier
  $('body').on('click', '#btnEditsup', function(){
    var supplierid = $(this).val();
    $.ajax({
      url: '/getSupplierdata',
      type: 'POST',
      data: {supplierid:supplierid},
      dataType: 'json',
      success: function(data){
        // console.log(data.disid);
        loadDistrict(proid=data.proid);
        $('#supplierid').val(supplierid);
        $('#suppliername').val(data.suppliername);
        $('#suppliertax').val(data.suppliertax);
        $('#village').val(data.village);
        $('#mobile').val(data.mobile);
        $('#phone').val(data.phone);
        $('#fax').val(data.fax);
        $('#proid option[value="'+data.proid+'"]').prop('selected', true);
        $('#modalupdatesup').modal('show');
        setTimeout(
          function(){
            $('#disid option[value="'+data.disid+'"]').prop('selected', true);
          }, 1000
        );
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
    
  });

  // province change
  $('body').on('change', '#proid', function(){
    var proid = $(this).val();
    loadDistrict(proid=proid);
    // $.ajax({
    //   url: '/selectProvince',
    //   type: 'POST',
    //   data: {proid:proid},
    //   dataType: 'json',
    //   success: function(data){
    //     // console.log(data);
    //     $('#disid').html(data.result);
    //   }, error: function(data){
    //     console.log('Error: ' + data);
    //   }
    // })
  });

  // function delete
  $('body').on('click', '#btnDeletesup', function(){
    var supplierid = $(this).val();
    swal({
      title: "ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ຂໍ​ມູ້ນ​ນີ້ແທ້​ບໍ່?",
      text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
      icon: "warning",
      buttons: "ຕົກ​ລົງ",
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = '/deleteSupplier/'+supplierid;
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

  // function search button
  $('body').on('click', '#btnSearchsup', function(){
    var txtsearch = $('#searchsupplier').val();
    if(txtsearch === ""){
      $('#searchsupplier').focus();
      $('#searchsupplier').attr('placeholder', 'ກະ​ລຸ​ນາ​ປ້ອນ​ຂໍ້​ມູນ​ທີ່​ຕ້ອງ​ກາ​ນ​ຄົ້ນ​ຫາ!');
    }else{
      $.ajax({
        url: '/searchSupplier',
        type: 'POST',
        data: {txtsearch:txtsearch},
        dataType: 'json',
        success: function(data){
          $('#supplierlist').html(data.result);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      })
    }
  });

  // function autocomplete
  $('body').on('keyup', '#searchsupplier', function(){
    var txtsearch = $(this).val();
    if(txtsearch === ""){
      $('#searchsupplier').focus();
      $('#listautosearch').fadeOut();
    }else{
      $.ajax({
        url: '/searchsupplierAuto',
        type: 'post',
        data: {txtsearch:txtsearch},
        dataType: 'json',
        success: function(data){
          $('#listautosearch').fadeIn();
          $('#listautosearch').html(data.result);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      });
    }
  });

  $(document).on('click', 'li', function(){
    $('#searchsupplier').val($(this).text());
    $('#listautosearch').fadeOut();
  });
});