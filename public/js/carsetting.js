$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('body').on('click', '#btnEdit', function(){
        var carid = $(this).val();
        $.ajax({
            url: '/loadCartoEdit/' + carid,
            type: 'GET',
            dataType: 'json',
            success: function(data){
                // console.log(data);
                $('#carid').val(data.id);
                $('#license').val(data.license);
                $('#motornum').val(data.motornum);
                $('#bodynum').val(data.bodynum);
                // $('#province').val(data.province);
                $('#brandid option[value="'+data.brandid+'"]').prop('selected', true);
                $('#model').val(data.model);
                $('#madeyear').val(data.madeyear);
                $('#color').val(data.color);
                $('#distance').val(data.distance);
                $('#motor option[value="'+data.motor+'"]').prop('selected', true);
                $('#modaledit').modal('show');
            }, error: function(data){
                console.log(data);
            }
        });
        // $('#modaledit').modal('show');
    });

    //search car data
    $('body').on('click', '#btnSearchcar', function(){
      var license = $('#searchcar').val();
      if(license == ""){
        swal("ຜິດ​ພາດ!", "ກະ​ລຸ​ນາ​ປ້ອນ​ປ້າຍ​ທະ​ບຽນ​ລົດ​ທີ່​ທ່ານ​ຕ້ອງ​ກາ​ນ​ຄົ້ນ​ຫາ!", "warning");
      }else{
        $.ajax({
          url: '/searchcarbylicense',
          type: 'POST',
          data: {license:license},
          dataType: 'json',
          success:function(data){
            $('#showsearchcar').html(data.result);
            // console.log(data);
          }, error: function(data){
            console.log("Error: " + data);
          }
        })
      }
    });
    
});