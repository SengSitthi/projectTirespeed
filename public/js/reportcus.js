$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // function load customer data
    function loadCustomer(query = ''){
        $.ajax({
            url: "/loadCustomer",
            type: 'GET',
            data: {query:query},
            dataType: 'json',
            success: function(data){
                // console.log(data);
                $('#showdata').html(data.result);
                $('#showcount').html(data.count);
            }, error: function(data){
                console.log('Error: '+data);
            }
        });
    }
    // function show customer by customer type id
    $('body').on('change', '#tcusid', function(){
        var query = $(this).val();
        loadCustomer(query);
    });
});