$(function(){
  Highcharts.chart('techchart', {
    title: {
      text: ''//'Stats of last 30 days'
    },

    // subtitle: {
    // text: 'Source: thesolarfoundation.com'
    // },

    yAxis: {
      title: {
        text: 'ການ​ເຄື່ອນ​ໄຫວ​ເດືອນ​ນີ້'
      }
    },
    // legend: {
    //     // layout: 'vertical',
    //     // align: 'right',
    //     verticalAlign: 'middle'
    // },

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
        name: 'ຮັບ​ລົດ​',
        data: [89, 3, 56, 22, 45, 30, 20, 8, 73, 12, 50, 60]
      },
      {
        name: 'ລົດ​ລໍ​ຖ້າ​ສ້ອມ',
        data: [62, 35, 71, 5, 21, 30, 16, 9, 40, 26, 19, 39]
      }, {
        name: '​ລົດ​ກຳ​ລັງ​ສ້ອມ',
        data: [14, 40, 18, 62, 15, 30, 60, 32, 52, 39, 7, 5]
      }, {
        name: 'ລົດ​ສ້ອມ​ສຳ​ເລັດ',
        data: [45, 63, 32, 41, 34, 8, 9, 53, 37, 71, 20, 12]
      }, {
        name: '​ສົ່ງ​ມອບ​ລູກ​ຄ້າ',
        data: [38, 66, 48, 9, 60, 29, 35, 7, 9, 54, 16, 11]
      }, {
        name: '​ລົດ​ກາຍ​ເວ​ລາ​ສ້ອມ',
        data: [26, 33, 14, 16, 52, 37, 40, 10, 9, 18, 13, 5]
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
});