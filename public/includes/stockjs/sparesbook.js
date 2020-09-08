$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

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

  $('body').on('change', '#typesparesid', function(){
    var typesparesid = $(this).val();
    // alert(typesparesid);
    if(typesparesid === ""){

    }else{
      $.ajax({
        url: '/loadBookdata',
        type: 'POST',
        data: {typesparesid:typesparesid},
        dataType: 'json',
        success: function(data){
          // console.log(data);
          $('#title').text(data.title);
          $('#showprintbookdata').html(data.result);
        }, error: function(data){
          console.log('Error: ' + data);
        }
      })
    }
  });

  $('body').on('click', '#btnPrint', function(){
    $('#showbutton').hide();
    window.print();
  });
  
  window.onafterprint = function(){
    $('#showbutton').show();
  }
  setTimeout(function(){
    $('.amaran-wrapper').fadeOut();
  }, 3500);
});