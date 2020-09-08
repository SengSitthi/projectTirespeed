$(document).ready(function(){
    // function get user list
    loadUser();
    function loadUser(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/loadUserlist',
            type: 'GET',
            dataType: 'json',
            success: function(data){
                $('#showuserlist').html(data.user_data);
                // console.log(data.user_data);
            }, error: function(data){
                console.log('Error:'+data.user_data);
            }
        })
    }

    // function show modal update password
    $('body').on('click', '#btnChange', function(){
        var uid = $(this).val();
        $('#uid').val(uid);
        $('#modalchange').modal('show');
    });

    // function change password of btnChangepass
    $('body').on('click', '#btnChangepass', function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var datachange = {
            passch: $('#pass').val()
        };
        if($('#pass').val() != $('#confirmpass').val()){
            fnAlert(title='ມີ​ບາງ​ຢ່າງ​ຜິດ​ພາດ', text='ລະ​ຫັດ​ບໍ່​ຄື​ກັນ​ກະ​ລຸ​ນາ​ກວດ​ສອບ​ຄືນ!', icon='error');
        }else if($('#pass').val() == '' || $('#confirmpass').val() == ''){
            fnAlert(title='ມີ​ບາງ​ຢ່າງ​ຜິດ​ພາດ', text='ຂໍ້​ມູນ​ເປັນ​ຄ່າ​ຫວ່າງ​ກະ​ລຸ​ນາ​ກວດ​ສອບ​ຄືນ!', icon='error');
        }else if($('#pass').val().length < 8 || $('#confirmpass').val().length < 8){
            fnAlert(title='ການ​ປ້ອນ​ຜິດ​ພາດ', text='​ລະ​ຫັດ​ທີ່​ທ່ານ​ໃສ​່​ມີ​ໜ້ອຍກວ່າ​ 8 ໂຕ!', icon='error');
        }else{
            $.ajax({
                url: '/updatepass/'+$('#uid').val(),
                type: 'POST',
                data: datachange,
                dataType: 'json',
                success: function(data){
                    loadUser();
                    fnAlert(title='ສຳ​ເລັດ', text='ລະ​ຫັດ​ຜ່ານ​ຖືກ​ປ່ຽນ​ແປງ​ແລ້ວ', icon='success');
                    $('#modalchange').modal('hide');
                    $('#confirmpass').val('');
                    $('#pass').val('');
                }, error: function(data){
                    console.log('Error: ' + data);
                }
            });
        }
    });

    // get user data modal update
    $('body').on('click', '#btnEdit', function(){
        var uid = $(this).val();
        $('#euid').val(uid);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/getUserdata/'+uid,
            type: 'GET',
            dataType: 'json',
            success: function(data){
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#empid option[value="'+data.empid+'"]').prop('selected', true);
                $('#modaluserdata').modal('show');
                if($('#name').val() != '' || $('#email').val() != ''){
                    $('#btnUpdateuser').prop('disabled', false);
                }else{
                    $('#btnUpdateuser').prop('disabled', true);
                }
                // console.log(data);
            }, error: function(data){
                console.log('Error: ' + data);
            }
        });
    });

    // function update employee data
    $('body').on('click', '#btnUpdateuser', function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if($('#name').val() == '' || $('#email').val() == ''){
            fnAlert(title='ຂໍ້​ມູນ​ຜິດ​ພາດ', text='ກະ​ລຸ​ນາ​ກວດ​ສອບ​ຊື່ ຫຼື ອີ​ເມ​ລ໌​ເປັນ​ຄ່າ​ຫວ່າງ​ບໍ່!', icon='error');
        }else{
            var userdata = {
                name: $('#name').val(),
                email: $('#email').val(),
                empid: $('#empid').val(),
            };
            $.ajax({
                url: '/upUserdata/'+$('#euid').val(),
                type: 'PUT',
                data: userdata,
                dataType: 'json',
                success: function(data){
                    $('#name').val('');
                    $('#email').val('');
                    $('#empid').val('');
                    $('#modaluserdata').modal('hide');
                    loadUser();
                    fnAlert(title='ສຳ​ເລັດ', text='ການ​ແກ້​ໄຂ​ຂໍ້​ມູນ​ສຳ​ເລັດ!', icon='success');
                }, error: function(data){
                    console.log('Error: ' + data);
                }
            });
        }
    });

    // function show edit status and permission
    $('body').on('click', '#btnEditRole', function(){
        var uid = $(this).val();
        $('#uroleid').val(uid);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/loadUserrolepms/'+uid,
            type: 'GET',
            dataType: 'json',
            success: function(data){
                $('#showrole').html(data.roles);
                $('#showpms').html(data.pms+' ');
                // $('#'+data.roles+'[value="'+data.rid+'"]').prop('checked', true);
                // for(i=0; i < data.countpms; i++){
                //     $('#'+data.pmsid[i]+'[value="'+data.pmsid[i]+'"]').prop('checked', true);
                //     // console.log(data.pmsid[i]);
                // }
                $('.w3-radio[value="'+data.rid+'"]').prop('checked', true);
                for(i=0; i < data.countpms; i++){
                    $('.privillage[value="'+data.pmsid[i]+'"]').prop('checked', true);
                    // console.log(data.pmsid[i]);
                }
                // console.log(data.rid);
                $('#modalrolepms').modal('show');
            }, error: function(data){
                console.log('Error: '+ data);
            }
        })
    });
    $('body').on('click', '#btnDelpms', function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var uid = $(this).val();
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
                    url: '/deleteRolePms/' + uid,
                    type: "DELETE",
                    success: function(data){
                        loadUser();
                        swal("ການ​ດຳ​ເນີນ​ການ​ລຶບ​ສຳ​ເລັດ!", {
                            icon: "success",
                            button: false,
                            timer: 2000,
                        });
                    }, error: function(data){
                        console.log('Error: '+data);
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

    // function delete user
    $('body').on('click', '#btnDeluser', function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var duid = $(this).val();
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
                    url: '/deleteUser/' + duid,
                    type: "DELETE",
                    success: function(data){
                        loadUser();
                        swal("ການ​ດຳ​ເນີນ​ການ​ລຶບ​ສຳ​ເລັດ!", {
                            icon: "success",
                            button: false,
                            timer: 2000,
                        });
                    }, error: function(data){
                        console.log('Error: '+data);
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

    // similar password
    $('body').on('keyup', '#confirmpass', function(){
        if($('#pass').val() != $('#confirmpass').val()){
            $('#pass').css('border-style', 'solid');
            $('#pass').css('border-color', 'red');
            $('#confirmpass').css('border-style', 'solid');
            $('#confirmpass').css('border-color', 'red');
            $('#btnInsert').prop('disabled', true);
        }else if($('#pass').val() === "" && $('#confirmpass').val() === ""){
            $('#pass').css('border-style', 'solid');
            $('#pass').css('border-color', 'red');
            $('#confirmpass').css('border-style', 'solid');
            $('#confirmpass').css('border-color', 'red');
            $('#btnChangepass').prop('disabled', true);
        }else{
            $('#pass').css('border-style', 'solid');
            $('#pass').css('border-color', 'green');
            $('#confirmpass').css('border-style', 'solid');
            $('#confirmpass').css('border-color', 'green');
            $('#btnChangepass').prop('disabled', false);
        }
    });
    $('body').on('keyup', '#pass', function(){
        if($('#pass').val() != $('#confirmpass').val()){
            $('#pass').css('border-style', 'solid');
            $('#pass').css('border-color', 'red');
            $('#confirmpass').css('border-style', 'solid');
            $('#confirmpass').css('border-color', 'red');
            $('#btnChangepass').prop('disabled', true);
        }else if($('#pass').val() === "" && $('#confirmpass').val() === ""){
            $('#pass').css('border-style', 'solid');
            $('#pass').css('border-color', 'red');
            $('#confirmpass').css('border-style', 'solid');
            $('#confirmpass').css('border-color', 'red');
            $('#btnChangepass').prop('disabled', true);
        }else{
            $('#pass').css('border-style', 'solid');
            $('#pass').css('border-color', 'green');
            $('#confirmpass').css('border-style', 'solid');
            $('#confirmpass').css('border-color', 'green');
            $('#btnChangepass').prop('disabled', false);
        }
    });

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
            $('#btnChangepass').prop('disabled', true);
        }else if($('#pass').val() == '' && $('#confirmpass').val() == ''){
            $('#pass').css('border-style', 'solid');
            $('#pass').css('border-color', 'red');
            $('#confirmpass').css('border-style', 'solid');
            $('#confirmpass').css('border-color', 'red');
            $('#btnChangepass').prop('disabled', true);
        }else{
            $('#pass').css('border-style', 'solid');
            $('#pass').css('border-color', 'green');
            $('#confirmpass').css('border-style', 'solid');
            $('#confirmpass').css('border-color', 'green');
            $('#btnChangepass').prop('disabled', false);
        }
    });

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