$(document).ready(function(){
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    // function show brand
    loadBrand();
    function loadBrand(){
        $.ajax({
            url: '/loadBrand',
            type: 'GET',
            dataType: 'json',
            success: function(data){
                // console.log(data);
                $('#brandlist').html(data.result);
            }, error: function(data){
                console.log('Error: ' + data);
            }
        });
    }

    /// function search
    $("#searchbrand").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#brandlist tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $('body').on('keyup', '#brandname', function(){
        var brandname = $('#brandname').val();
        if(brandname === ''){
            $('#btnAdd').prop('disabled', true);
            $('#btnUpdate').prop('disabled', true);
        }else{
            $('#btnAdd').prop('disabled', false);
            $('#btnUpdate').prop('disabled', false);
        }
    })
    // function add brand
    $('body').on('click', '#btnAdd', function(){
        var brandname = $('#brandname').val();
        $.ajax({
            url: '/insertNewbrand',
            type: 'POST',
            data: {brandname:brandname},
            dataType: 'json',
            success: function(data){
                fnAlert(title='ສຳ​ເລັດ', text=data, icon='success');
                loadBrand();
            }, error: function(data){
                console.log('Error: '+data);
            }
        })
    });
    // function get brand data to edit form
    $('body').on('click', '#btnEdit', function(){
        var brandid = $(this).val();
        $('#btnUpdate').show();
        $('#btnAdd').hide();
        $.ajax({
            url: '/getBrand/'+brandid,
            type: 'GET',
            dataType: 'json',
            success: function(data){
                $('#brandid').val(data.bid);
                $('#brandname').val(data.bname);
            }, error: function(data){
                console.log('Error: '+ data);
            }
        })
    });

    $('body').on('click', '#btnCancel', function(){
        $('#brandid').val("");
        $('#brandname').val("");
        $('#btnAdd').prop('disabled', true);
        $('#btnAdd').show();
        $('#btnUpdate').hide();
    });

    $('body').on('click', '#btnUpdate', function(){
        var brandid = $('#brandid').val();
        var brandname = $('#brandname').val();
        $.ajax({
            url: '/updateBrand',
            type: 'POST',
            data: {brandid:brandid,brandname:brandname},
            dataType: 'json',
            success: function(data){
                fnAlert(title='ສຳ​ເລັດ', text=data, icon='success');
                loadBrand();
                $('#brandid').val("");
                $('#brandname').val("");
                $('#btnAdd').prop('disabled', true);
                $('#btnAdd').show();
                $('#btnUpdate').hide();
            }, error: function(data){
                console.log('Error: ' + data);
            }
        })
    });

    // function dete brand
    $('body').on('click', '#btnDel', function(){
        var brandid = $(this).val();
        swal({
            title: "ທ່ານ​ໝັ່ນ​ໃຈ​ຕ້ອງ​ການ​ລຶບ​ແທ້​ບໍ່?",
            text: "​ກົດ​ຕົກ​ລົງ​ເພື່ອ​ຢືນ​ຢັນ​ການ​ລຶບ ຫຼື ຍົກ​ເລີກດ້ວຍ​ການ​ກົດ​ບ່ອນ​​​ຫວ່າງ!",
            icon: "warning",
            buttons: "ຕົກ​ລົງ",
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/deleteBrand',
                    type: 'POST',
                    data: {brandid:brandid},
                    dataType: 'json',
                    success: function(data){
                        fnAlert(title='ສຳ​ເລັດ', text=data, icon='success');
                        loadBrand();
                    }, error: function(data){
                        console.log('Error: '+ data);
                    }
                });
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