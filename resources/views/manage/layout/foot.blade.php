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
        })

    </script>

</body>

</html>