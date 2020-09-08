$(document).ready(function(){
    fnLoadEmp();
    function fnLoadEmp(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/loadEmployee',
            type: 'GET',
            dataType: 'json',
            success: function(data){
                $('#showemp').html(data.showemp);
                $('#numrow').html(data.numrow);
            },error: function(data){
                console.log('Error: '+ data);
            }
        });
    }

    /// function get data for update 
    $('body').on('click', '#btnEdit', function(){
        var id = $(this).val();
        // alert(empid);
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
            }
        });
        $.ajax({
            url: '/loadEmpedit/'+id,
            type: 'GET',
            dataType: 'json',
            success: function(data){
                $('#showempid').val(data.empid);
                $('#empid').val(data.empid);
                $('#name').val(data.name);
                $('#lastname').val(data.lastname);
                $('#birthday').val(data.birthday);
                $('#village').val(data.village);
                $('#proid option[value="'+data.proid+'"]').prop("selected", true);
                $('#disid option[value="'+data.disid+'"]').prop("selected", true);
                $('#mobile').val(data.mobile);
                $('#email').val(data.email);
                $('#modalform').modal('show');
                // console.log(data);
            },error: function(data){
                console.log('Error: '+data);
            }
        })
    });

    ///function update employee data;
    $('body').on('click', '#btnUpdate', function(){
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"}').attr('content')
        //     }
        // });
        if ($('#empid').val() == "" || $('#name').val() == "") {
            fnAlert(title="ມີ​ຂໍ້​ຜິດ​ພາດ", message="ກະ​ລຸ​ນາ​ກວດ ລະ​ຫັດ ຫຼື ຊື່​ເປັນ​ຄ່າ​ຫວ່າງບໍ່?", status="error");
        }else if($('#lastname').val() == "" || $('#birthday').val() == ""){
            fnAlert(title="ມີ​ຂໍ້​ຜິດ​ພາດ", message="ກະ​ລຸ​ນາ​ກວດ ນາມ​ສະ​ກຸນ ຫຼື ວັນ​ເດືອນ​ປີ​ເ​ກີດ​ເປັນ​ຄ່າ​ຫວ່າງບໍ່?", status="error");
        }else if($('#village').val() == "" || $('#disid').val() == ""){
            fnAlert(title="ມີ​ຂໍ້​ຜິດ​ພາດ", message="ກະ​ລຸ​ນາ​ກວດ ບ້ານ ຫຼື ເມືອງ​ເປັນ​ຄ່າ​ຫວ່າງບໍ່?", status="error");
        }else if($('#proid').val() == "" || $('#mobile').val() == ""){
            fnAlert(title="ມີ​ຂໍ້​ຜິດ​ພາດ", message="ກະ​ລຸ​ນາ​ກວດ ແຂວງ ຫຼື ເບີ​ໂທ​ເປັນ​ຄ່າ​ຫວ່າງບໍ່?", status="error");
        }else if($('#email').val() == ""){
            fnAlert(title="ມີ​ຂໍ້​ຜິດ​ພາດ", message="ອ​ີ​ເມວ​ເປັນ​ຄ່າ​ຫວ່າງ", status="error");
        }else{
            var empid = $('#empid').val();
            var updatedata = {
                name: $('#name').val(),
                lastname: $('#lastname').val(),
                birthday: $('#birthday').val(),
                village: $('#village').val(),
                disid: $('#disid').val(),
                proid: $('#proid').val(),
                mobile: $('#mobile').val(),
                email: $('#email').val(),
            }
            $.ajax({
                url:'/updateEmp/'+empid,
                type: 'PUT',
                data: updatedata,
                dataType: 'json',
                success: function(data){
                    $('#modalform').modal('hide');
                    fnAlert(title='ການ​​ແກ້​ໄຂ​ຂໍ້​ມູ​ນ', message='ການ​ດຳ​ເນີນ​ການ​ສຳ​ເລັດ', status='success');
                    // console.log('Result: '+ data);
                    fnLoadEmp();
                }, error: function(data){
                    console.log('Error: '+data);
                }
            });
            // console.log(updatedata);
        }
        
    });

    $('body').on('click', '#btnDel', function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var empid = $(this).val();
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
                    url: '/deleteEmp/' + empid,
                    type: "DELETE",
                    success: function(data){
                        fnLoadEmp();
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

    function fnAlert(title = '', message = '', status = ""){
        swal({
                title: title,
                text: message,
                icon: status,
                button: "ຕົກ​ລົງ",
        });
    }

    $('#birthday').bootstrapMaterialDatePicker({
        time: false,
        clearButton: true
    });
    getDistrict();
    function getDistrict(query = ''){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
            }
        });
        $.ajax({
            url: '/loadDistrict',
            type: 'GET',
            data: {query:query},
            dataType: 'json',
            success: function(data){
                $('#disid').html(data.dis_data);
            }, error: function(data){
                console.log('Error: '+data);
            }
        });
    }

    $('body').on('change', '#proid', function(){
        var query = $(this).val();
        getDistrict(query);
    });
});