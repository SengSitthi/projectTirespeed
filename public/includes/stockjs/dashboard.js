$(document).ready(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  loadStockoverview();
  function loadStockoverview(){
    $.ajax({
      url: '/loadStockchart',
      type: 'POST',
      dataType: 'json',
      success: function(data){
        console.log(data);
        Highcharts.chart('stockoverview', {
          chart: {
            style: {
              fontFamily: 'Phetsarath OT'
            }
          },
          title: {
            text: 'ພາບ​ລວມ​ອະ​ໄຫຼ່'
          },
          subtitle: {
            text: 'ພາບ​ລວມ​ການ​ສັ່ງ​ຊື້, ຮັບ​ເຂົ້າ ແລະ ເບີກ'
          },
          xAxis: {
            categories: ['ມັງ​ກອນ', '​ກຸມ​ພາ', '​ມີ​ນາ', 'ເມ​ສາ', '​ພຶດ​ສະ​ພາ', '​ມີ​ຖຸ​ນາ', '​ກໍ​ລະ​ກົດ', '​ສິງ​ຫາ', '​ກັນ​ຍາ', '​ຕຸ​ລາ', '​ພະ​ຈິກ', '​ທັນ​ວາ']
          },
          series: [{
            name: 'ສັ່ງ​ຊື້ອະ​ໄຫຼ່',
            data: data.order,
            zoneAxis: 'x'
          },
          {
            name: 'ຮັບ​ອະ​ໄຫຼ່​ເຂົ້າ',
            data: data.receive,
            zoneAxis: 'x'
          },
          {
            name: 'ເບີກອະ​ໄຫຼ່',
            data: data.withdraw,
            zoneAxis: 'x',
            zones: [
              {
                dashStyle: 'dot'
              }
            ]
          }
        ]
        });
      }, error: function(data){
        console.log('Error:'+data);
      }
    });

    
  }
})