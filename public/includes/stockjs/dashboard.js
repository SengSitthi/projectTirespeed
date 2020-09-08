$(document).ready(function() {
  Highcharts.chart('workstockoverview', {
    chart: {
          
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
    },
    title: {
      text: ''
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}</b>'
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        dataLabels: {
        enabled: false
      },
        showInLegend: false
      }
    },
    series: [{
      name: 'Referrals',
      colorByPoint: true,
      data: [{
      name: 'Google',
      y: 30.5,
      sliced: true,
      // selected: true
    }, {
      name: 'Twiter',
      y: 25.5
          }, {
              name: 'Morioh',
              y: 16
          }]
      }]
  });

  

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
      data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
      zoneAxis: 'x'
    },
    {
      name: 'ຮັບ​ອະ​ໄຫຼ່​ເຂົ້າ',
      data: [56.9, 99.5, 66.4, 87.2, 141.0, 189.0, 114.6, 98.5, 196.4, 255.1, 153.6, 72.4],
      zoneAxis: 'x'
    },
    {
      name: 'ເບີກອະ​ໄຫຼ່',
      data: [32.9, 21.5, 66.4, 132.2, 101.0, 123.0, 157.6, 98.5, 199.4, 176.1, 69.6, 12.4],
      zoneAxis: 'x',
      zones: [
        {
          dashStyle: 'dot'
        }
      ]
    }
  ]
  });
})