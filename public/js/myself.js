$(document).ready(function(){
    loadMydata();
    function loadMydata(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/loadMyself',
            type: 'GET',
            dataType: 'json',
            success: function(data){
                $('#showmyself').html(data.myself);
                // console.log(data.myself);
            },error: function(data){
                console.log('Error: '+ data);
            }
        });
    }

    window.setInterval(function(){
        loadMydata();
    }, 1000 * 120);

    $('body').on('keyup', '#nconfirmpass', function(){
        if($('#npass').val() != $('#nconfirmpass').val()){
            $('#npass').css('border-style', 'solid');
            $('#npass').css('border-color', 'red');
            $('#nconfirmpass').css('border-style', 'solid');
            $('#nconfirmpass').css('border-color', 'red');
        }else if($('#npass').val() === "" && $('#confirmnpass').val() === ""){
            $('#npass').css('border-style', 'solid');
            $('#npass').css('border-color', 'red');
            $('#nconfirmpass').css('border-style', 'solid');
            $('#nconfirmpass').css('border-color', 'red');
        }else{
            $('#npass').css('border-style', 'solid');
            $('#npass').css('border-color', 'green');
            $('#nconfirmpass').css('border-style', 'solid');
            $('#nconfirmpass').css('border-color', 'green');
            $('#btnChangenpass').prop('disabled', false);
        }
    });
    /// function update password
    $('body').on('click', '#btnChangenpass', function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var datachange = {
            passch: $('#npass').val()
        };
        if($('#npass').val() != $('#nconfirmpass').val()){
            fnAlert(title='ມີ​ບາງ​ຢ່າງ​ຜິດ​ພາດ', text='ລະ​ຫັດ​ບໍ່​ຄື​ກັນ​ກະ​ລຸ​ນາ​ກວດ​ສອບ​ຄືນ!', icon='error');
        }else if($('#npass').val() == '' || $('#nconfirmpass').val() == ''){
            fnAlert(title='ມີ​ບາງ​ຢ່າງ​ຜິດ​ພາດ', text='ຂໍ້​ມູນ​ເປັນ​ຄ່າ​ຫວ່າງ​ກະ​ລຸ​ນາ​ກວດ​ສອບ​ຄືນ!', icon='error');
        }else if($('#npass').val().length < 8 || $('#nconfirmpass').val().length < 8){
            fnAlert(title='ການ​ປ້ອນ​ຜິດ​ພາດ', text='​ລະ​ຫັດ​ທີ່​ທ່ານ​ໃສ​່​ມີ​ໜ້ອຍກວ່າ​ 8 ໂຕ!', icon='error');
        }else{
            $.ajax({
                url: '/updatepass/'+$('#nid').val(),
                type: 'POST',
                data: datachange,
                dataType: 'json',
                success: function(data){
                    fnAlert(title='ສຳ​ເລັດ', text='ລະ​ຫັດ​ຜ່ານ​ຖືກ​ປ່ຽນ​ແປງ​ແລ້ວ', icon='success');
                    $('#nmodalchange').modal('hide');
                    $('#nconfirmpass').val('');
                    $('#npass').val('');
                }, error: function(data){
                    console.log('Error: ' + data);
                }
            });
        }
    });

    /// function alert
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