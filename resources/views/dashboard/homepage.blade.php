@extends('dashboard.base')

@section('custom-css')
<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

<style>
  .dataTables_paginate {
    display: flex !important;
    gap: 1rem !important;
    align-items: center;
    justify-content: flex-end;
  }

  .paginate_button {
    padding: 1rem;
    cursor: pointer;
  }

  .current {
    background-color: #eee !important;
    color: #111 !important;
  }
</style>
@endsection

@section('content')

          <div class="container-fluid">
            <div class="fade-in">
              <div class="row">
                @foreach ($colorsNum as $colorName => $colorNum)
                  <div class="col-sm-3 col-lg-1">
                    <div class="card text-white" style="background-color: {{ $colorName }};">
                      <a href="#" class="card-body text-center pb-0" style="text-decoration: none; color: #fff;">
                        <div class="text-value-lg">{{ $colorNum}}</div>
                        <div class="pb-2">Entries</div>
                      </a>
                    </div>
                  </div>
                @endforeach
                
              </div>
              
              <!-- /.row-->
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-5">
                      <h4 class="card-title mb-0">Entries</h4>
                      <div class="small text-muted">Yoday</div>
                    </div>
                  </div>
                  <!-- /.row-->
                  <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
                    <canvas class="chart" id="main-chart" height="300"></canvas>
                  </div>
                </div>
              </div>
              <!-- /.card-->

              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">
                      Ent
                    </div>
                    <div class="card-body">
                    <div id="regions_div"></div>
                  </div>
                </div>
              </div>

@endsection

@section('javascript')



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
        labelsObject = {
        0: 0,
        1: 0,
        2: 0,
        3: 0,
        4: 0,
        5: 0,
        6: 0,
        7: 0,
        8: 0,
        9: 0,
        10: 0,
        11: 0,
        12: 0,
        13: 0,
        14: 0,
        15: 0,
        16: 0,
        17: 0,
        18: 0,
        19: 0,
        20: 0,
        21: 0,
        22: 0,
        23: 0,
      };

      let labels = [];
      let data = [];
      
       $.ajax({
         url: '/admin.chartjson',
         type: 'get',
         dataType: 'json',
         success: (response) => {
            for (const prop in response) {
              const value = response[prop];
              if (labelsObject.hasOwnProperty(prop)) {
                labelsObject[prop] = value;
              }
          }

          data = Object.values(labelsObject);
          labels = Object.keys(labelsObject);

          labels.forEach((value, index) => {
            if (index < 9) {
              labels[index] = "0" + index;
            }
          });

          // eslint-disable-next-line no-unused-vars
          const mainChart = new Chart(document.getElementById('main-chart'), {
            type: 'bar',
            data: {
              labels:  labels,
              datasets: [
                {
                  label: 'Entries',
                  backgroundColor: coreui.Utils.hexToRgba(coreui.Utils.getStyle('--info'), 10),
                  borderColor: coreui.Utils.getStyle('--info'),
                  pointHoverBackgroundColor: '#fff',
                  borderWidth: 2,
                  data: data,
                },
              ]
            },
            options: {
              maintainAspectRatio: false,
              legend: {
                display: false
              },
              scales: {
                xAxes: [{
                  gridLines: {
                    drawOnChartArea: false
                  }
                }],
                yAxes: [{
                  ticks: {
                    beginAtZero: true,
                    maxTicksLimit: 5,
                    stepSize: Math.ceil(250 / 5),
                    max: 250
                  }
                }]
              },
              elements: {
                point: {
                  radius: 0,
                  hitRadius: 10,
                  hoverRadius: 4,
                  hoverBorderWidth: 3
                }
              },
              tooltips: {
                intersect: true,
                callbacks: {
                  labelColor: function(tooltipItem, chart) {
                    return { backgroundColor: chart.data.datasets[tooltipItem.datasetIndex].borderColor };
                  }
                }
              }
            }
          })
          
         }
       });

      google.charts.load('current', {
        'packages':['geochart'],
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var mydata = google.visualization.arrayToDataTable([
            ['Country', 'Popularity'],
                @foreach($data as $row)
                  <?php echo "['".$row[0]."', ".$row[1]."],"; ?>
                @endforeach
        ]);

        var options = {
          title: 'Popularity of Country',
        };

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(mydata, options);

      }

      drawRegionsMap();

    
      

      

       
      

    </script>
@endsection
