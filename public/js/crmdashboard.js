$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    

    loadTypeCustomer();
    function loadTypeCustomer(){
        $.ajax({
            url: "/loadTypeCus",
            type: 'GET',
            dataType: 'json',
            success: function(data){
                // console.log(data);
                var chart = new CanvasJS.Chart("piechart", {
                    animationEnabled: true,
                    title: {
                        text: "ປະ​ເພດ​ລ​ູກ​ຄ້າ​ທີ່​ໃຊ້​ບໍ​ລິ​ການ​ເດືອນ​ນີ້",
                        fontFamily: "Phetsarath OT",
                        fontSize: 20
                    },
                    data: [{
                        type: "pie",
                        startAngle: 240,
                        yValueFormatString: "## ຄົນ",
                        indexLabel: "{label} {y}",
                        dataPoints: data
                    }]
                }); 
                chart.render();
            }, error: function(data){
                console.log('Error: '+data);
            }
        });
    }

    loadCusofMonth();
    function loadCusofMonth(){
        $.ajax({
            url: "/loadCusofMonth",
            type: 'GET',
            dataType: 'json',
            success: function(data){
                // console.log(data);
                var chart = new CanvasJS.Chart("chart_div", {
                    animationEnabled: true,
                    theme: "light2", // "light1", "light2", "dark1", "dark2"
                    title:{
                        text: "ຈຳ​ນວນ​ລູກ​ຄ້າ​ທີ່​ໃຊ້​ບໍ​ລິ​ການ​ແຕ່​ລະ​ເດືອນ",
                        fontFamily: "Phetsarath OT",
                        fontSize: 20,
                    },
                    axisY: {
                        title: "​ຈຳ​ນວນ​ຄົນ",
                        titleFontFamily: "Phetsarath OT",
                    },
                    data: [{        
                        type: "column",  
                        showInLegend: true, 
                        legendMarkerColor: "grey",
                        legendText: "ຈຳ​ນວນ​ຄົ​ນ​ໃນ​ແຕ່​ລະ​ເດືອນ",
                        dataPoints: data
                    }]
                });
                chart.render();
            }, error: function(data){
                console.log('Error: '+data);
            }
        })
    }


    // show count appointment
    showCount();
    function showCount(){
        $.ajax({
            url: '/showCountApp',
            type: 'POST',
            dataType: 'json',
            success: function(data){
                // console.log('Result: '+data.countother);
                $('#showtoday').html(data.counttoday);
                $('#showmonth').html(data.countmonth);
                $('#showcompany').html(data.countcompany);
                $('#showother').html(data.countother);
            }, error: function(data){
                console.log('Error: '+data);
            }
        })
    }
});