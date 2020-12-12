$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

// function load Technical chart data
loadTechchart();
function loadTechchart(){
  $.ajax({
    url: '/loadtechchart',
    type: 'POST',
    dataType: 'json',
    success: function(data){
      // console.log(data);
      Highcharts.chart('techchart', {
        title: {
          text: ''
        },
    
        yAxis: {
          title: {
            text: 'ການ​ເຄື່ອນ​ໄຫວ​ເດືອນ​ນີ້'
          }
        },
    
        plotOptions: {
          series: {
            label: {
              connectorAllowed: false
              },
            pointStart: 1
          }
        },
    
        series: [
          {
            name: 'ລົດ​ລໍ​ຖ້າ​ສ້ອມ',
            data: data.waitrepair
          },
          {
            name: 'ລົດ​ລໍ​ຖ້າ​ອະ​ໄຫຼ່',
            data: data.waitspare
          }, {
            name: '​ລົດ​ກຳ​ລັງ​ສ້ອມ',
            data: data.repairing
          }, {
            name: 'ລົດ​ສ້ອມ​ສຳ​ເລັດ',
            data: data.success
          }, {
            name: '​ສົ່ງ​ມອບ​ລູກ​ຄ້າ',
            data: data.send
          }],
    
        responsive: {
          rules: [{
            // condition: {
            //     maxWidth: 500
            // },
            chartOptions: {
              legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
              }
            }
          }]
        }
      });
    }, error: function(data){
      console.log('Error: '+ data);
    }
  });
}

$(function(){
  
});