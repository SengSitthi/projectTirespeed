$(document).ready(function(){
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('body').on('change', '#uid', function(){
        var uid = $(this).val();
        if(uid != ''){
            $('#btnPrivillage').prop('disabled', false);
        }else{
            $('#btnPrivillage').prop('disabled', true);
        }
    });

    // function load Roles
    loadRoles();
    function loadRoles(){
        $.ajax({
            url: '/loadRoles',
            type: 'GET',
            dataType: 'json',
            success: function(data){
                // console.log(data.showrole);
                $('#showstatus').html(data.showrole);
            }, error: function(data){
                console.log('Error: '+data);
            }
        });
    }
    // function load Permission
    loadPermission();
    function loadPermission(){
        $.ajax({
            url: '/loadPermission',
            type: 'GET',
            dataType: 'json',
            success: function(data){
                // console.log(data.showpms);
                $('#showpms').html(data.showpms);
            }, error: function(data){
                console.log('Error: '+data);
            }
        });
    }
});