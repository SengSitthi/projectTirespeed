    <script src="{{ url('moriotheme/js/jquery.min.js') }}"></script>
    {{-- <script src="{{ url('moriotheme/js/jquery.slim.min.js') }}"></script> --}}
    <script src="{{ url('moriotheme/js/popper.min.js') }}"></script>
    <script src="{{ url('moriotheme/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('moriotheme/js/bootstrap-select.min.js') }}"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --}}

    <script src="{{ url('moriotheme/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('moriotheme/js/highcharts.js') }}"></script>
    <script src="{{ url('moriotheme/js/jquery.knob.min.js') }}"></script>
    <script src="{{ url('moriotheme/js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ url('moriotheme/js/jquery.peity.min.js') }}"></script>

    {{-- datepicker js libralies --}}
    <script src="{{ url('datetimepicker/js/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="{{ url('datetimepicker/js/datetool.js') }}"></script>
    <script src="{{ url('select2/js/select2.min.js') }}"></script>

    {{-- Amaran js --}}
    <script src="{{ url('Amaranjs/js/jquery.amaran.min.js') }}"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-50750921-19"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-50750921-19');
    </script>


    <script src="{{ url('moriotheme/js/morioh.js') }}"></script>

    <script src="{{ url('js/myself.js') }}"></script>

    <script src="{{ url('js/notification.js')}}"></script>

    <script>

        $(function () {

            // $('#modal-download').modal('show');

            // $('body').on('click', '#btnMenu', function(){
            //   $('#main-menu').show();
            // });


            $(".bar").peity("bar");


            // knob

            $(".knob").knob();


            // sparkline bar
            $('.sparkline-bar').sparkline('html', {
                type: 'bar',
                barWidth: 10,
                height: 65,
                barColor: '#3b73da',
                chartRangeMax: 12
            });

            $('.sparkline-line').sparkline('html', {
                width: 120,
                height: 65,
                lineColor: '#3b73da',
                fillColor: false
            });

            /************** AREA CHARTS ********************/


            $('.sparkline-area').sparkline('html', {
                width: 120,
                height: 65,
                lineColor: '#3b73da',
                fillColor: 'rgba(59, 115, 218,0.2)'
            });


            $('.sparkline').sparkline('html', {
                width: '100%',
                height: 80,
                lineColor: '#3b73da',
                fillColor: 'rgba(59, 115, 218,0.2)'
            });



            Highcharts.chart('hl-pie-ref', {
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
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
                    }, {
                        name: 'Facebook',
                        y: 8
                    }, {
                        name: 'Pinterest',
                        y: 4
                    }, {
                        name: 'Other',
                        y: 7.05
                    }]
                }]
            });



            Highcharts.chart('hl-line-main', {
                title: {
                    text: ''//'Stats of last 30 days'
                },

                // subtitle: {
                //     text: 'Source: thesolarfoundation.com'
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
                        name: '​ລົດ​ເຂົ້າ',
                        data: [8050, 8500, 8600, 8800, 8600, 9000, 9100, 9100, 9500, 9400, 9800, 9900, 10000, 9800, 9600, 9000, 8800, 9600, 9800, 10000, 11000, 11200, 11400, 11400]
                    },
                    {
                        name: '​ລູກ​ຄ້າ',
                        data: [1000, 1100, 1210, 1110, 1150, 1200, 1400, 1500, 1350, 1300, 1200, 1250, 1260, 1390, 1289, 1120, 1200, 1300, 1310, 1350, 1350, 1400, 1300, 1400]
                    }, {
                        name: '​ລົດ​ກຳ​ລັງ​ສ້ອມ​ແປງ',
                        data: [3000, 3200, 4000, 3000, 3500, 6000, 5000, 3450, 5460, 7000, 6000, 6500, 5500, 8000, 7000, 9000, 8000, 7000, 8000, 9000, 9100, 9200, 9300, 9400]
                    }, {
                        name: '​ລາຍ​ຮັບ',
                        data: [1000, 2200, 2300, 3000, 2500, 2300, 3000, 3200, 2600, 2800, 2700, 2650, 2600, 2800, 2500, 2500, 3000, 3100, 3300, 3000, 3200, 3000, 3200, 3300]
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
        })

    </script>

</body>

</html>