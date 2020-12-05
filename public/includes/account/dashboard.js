$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  showChart();
  function showChart(){
    $.ajax({
      url: '/invoice_receipt_chart',
      type: 'POST',
      dataType: 'json',
      success: function(data){
        console.log(data.invoice);
        Highcharts.chart('invoicechart', {
          chart: {
            type: 'column',
            style: {
              fontFamily: 'Phetsarath OT'
            }
          },
          title: {
            text: 'ສະ​ແດງ​ພາບ​ລວມ'
          },
          subtitle: {
            text: 'ລາຍ​ຮັບ ແລະ ລ​ູກ​ຄ້າ​ຊຳ​ລະຕົວ​ຈິງ'
          },
          xAxis: {
            categories: [
              '​ມັງ​ກອນ',
              'ກຸມ​ພາ',
              'ມີ​ນາ',
              'ເມ​ສາ',
              'ພຶດ​ສະ​ພາ',
              'ມີ​ຖ​ຸ​ນາ',
              'ກໍ​ລະ​ກົດ',
              'ສິງ​ຫາ',
              'ກັນ​ຍາ',
              'ຕຸ​ລາ',
              'ພະ​ຈິກ',
              'ທັນ​ວາ'
            ],
            crosshair: true
          },
          yAxis: {
            min: 0,
            title: {
              text: 'ຈຳ​ນວນ​ເງິນ (₭)'
            }
          },
          tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
              '<td style="padding:0"><b>{point.y:.1f} ₭</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
          },
          plotOptions: {
            column: {
              pointPadding: 0.2,
              borderWidth: 0
            }
          },
          series: [{
            name: 'ລາຍ​ຮັບ',
            data: data.invoice
          }, {
            name: 'ລາຍ​ຮັບ​ຈາກ​ລ​ູກ​ຄ້າ​ຊຳ​ລະ',
            data: data.receipt
          }]
        });
      }, error: function(data){
        console.log('Error: ' + data);
      }
    });
  }
});