$(document).ready(function(){
    
    /// function generate password
    function randomPassword() {
        var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        var pass = "";
        var length = 10;
        for (var x = 0; x < length; x++) {
            var i = Math.floor(Math.random() * chars.length);
            pass += chars.charAt(i);
        }
        return pass;
    }

    /// function click random password
    $('body').on('click', '#btnGen', function(){
        var randompass = randomPassword();
        $('#genpass').html(randompass);
        $('#pass').val(randompass);
        $('#confirmpass').val(randompass);
        if($('#pass').val() != $('#confirmpass').val()){
            $('#pass').css('border-style', 'solid');
            $('#pass').css('border-color', 'red');
            $('#confirmpass').css('border-style', 'solid');
            $('#confirmpass').css('border-color', 'red');
            $('#btnInsert').prop('disabled', true);
        }else if($('#pass').val() == '' && $('#confirmpass').val() == ''){
            $('#pass').css('border-style', 'solid');
            $('#pass').css('border-color', 'red');
            $('#confirmpass').css('border-style', 'solid');
            $('#confirmpass').css('border-color', 'red');
            $('#btnInsert').prop('disabled', true);
        }else{
            $('#pass').css('border-style', 'solid');
            $('#pass').css('border-color', 'green');
            $('#confirmpass').css('border-style', 'solid');
            $('#confirmpass').css('border-color', 'green');
            $('#btnInsert').prop('disabled', false);
        }
    });

    /// function get employee for add user
    $('body').on('change', '#empid', function(){
        var empid = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if(empid == ""){
            fnError(title='ມີ​ຂໍ້​​ຜິດ​ພາດ', text='ກະ​ລຸ​ນາ​ເພີ່ມ​ພະ​ນັກ​ງານ​ກ່ອນ');
        }else{
            $.ajax({
                url: '/loadEmpData/'+empid,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#userdata').show();
                }, error: function(data){
                    console.log('Error: '+data);
                }
            });
        }
    });

    /// function insert user
    $('body').on('click', '#btnInsert', function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if($('#name').val() == "" || $('#email').val() == ""){
            fnError(title='​ມີ​ບາງ​ຢ່າງ​ຜິດ​ພາດ', text='ກະ​ລຸ​ນາ​ກວດ​ຊື່ ແລະ ອີ​ເມວ​ເປັນ​ຄ່າ​ຫວ່າງ​ບໍ່');
        }else if($('#pass').val() == "" || $('#confirmpass').val() == ""){
            fnError(title='​ມີ​ບາງ​ຢ່າງ​ຜິດ​ພາດ', text='ກະ​ລຸ​ນາ​ກວດລະ​ຫັດ​​ ແລະ ລະ​ຫັດ​ຢືນ​ຢັນ​ເປັນ​ຄ່າ​ຫວ່າງ​ບໍ່');
        }else{
            var userdata = {
                name: $('#name').val(),
                email: $('#email').val(),
                pass: $('#pass').val(),
                empid: $('#empid').val()
            };
            $.ajax({
                url: 'insertUser',
                type: 'POST',
                data: userdata,
                dataType: 'json',
                success: function(data){
                    fnSuccess(title='ສຳ​ເລັດ', text='ເພີ່ມ​ຜູ້​ໃຊ້​ງານ​ສຳ​ເລັດ');
                    window.location = 'user';
                }, error: function(data){
                    console.log('Error: '+data);
                }
            });
        }
    });

    function fnSuccess(title='', text=''){
        swal({
            title: title,
            text: text,
            icon: 'success',
            button: false,
            timer: 2000
        });
    }
    function fnError(title='', text=''){
        swal({
            title: title,
            text: text,
            icon: 'error',
            button: 'ຕົກ​ລົງ'
        });
    }
});