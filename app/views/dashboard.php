<main class="dashboard-container col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">dashboard</h6>
    </div>
    <div class="col-lg-12 mt-3">
      <div class="row">
        <?php if ($userRole === 'operator') { ?>
          <div class="col-12">
            <div class="overview-wrapper">
              <div class="container gap-5 px-5 mb-4 pb-3">
                <?php if ($userHasCin) { ?>
                  <a href="./tricycles?status=Active" class="text-black">
                    <div class="overview-container">
                      <div class="image-bg rounded-circle"> </div>
                      <i class="fa-solid fa-truck-pickup fa-2xl" style="color: #ffffff; margin-right: 8px;"></i>
                      <h5><?php echo $userTricycleCount; ?></h5>
                      <p>Active Tricycles</p>
                    </div>
                  </a>
                  <a href="./drivers" class="text-black">
                    <div class="overview-container">
                      <div class="image-bg rounded-circle"> </div>
                      <i class="fa-solid fa-user fa-2xl" style="color: #ffffff;"></i>
                      <h5><?php echo $userDriverCount; ?></h5>
                      <p>Drivers</p>
                    </div>
                  </a>
                <?php } ?>
                <a href="./appointments?status=pending" class="text-black">
                  <div class="overview-container">
                    <div class="image-bg rounded-circle"> </div>
                    <i class="fa-solid fa-clock fa-2xl" style="color: #ffffff; margin-right: 4px;"></i>
                    <h5><?php echo $userPendingAppointmentCount; ?></h5>
                    <p>Pending Appointments</p>
                  </div>
                </a>
              </div>
            </div>
          </div>
        <?php } elseif ($userRole === 'admin') { ?>
          <div class="col-12">
            <div class="overview-wrapper">
              <div class="container overview-margin px-5 pb-3">
                <a href="./tricycles?status=Active" class="text-black">
                  <div class="overview-container mt-3">
                    <div class="image-bg rounded-circle"> </div>
                    <i class="fa-solid fa-truck-pickup fa-2xl" style="color: #ffffff; margin-right: 8px;"></i>
                    <h5><?php echo $activeTricycleCount; ?></h5>
                    <p>Active Tricycles</p>
                  </div>
                </a>
                <a href="./operators" class="text-black">
                  <div class="overview-container mt-3">
                    <div class="image-bg rounded-circle"> </div>
                    <i class="fa-solid fa-user fa-2xl" style="color: #ffffff;"></i>
                    <h5><?php echo $operatorCount; ?></h5>
                    <p>Operators</p>
                  </div>
                </a>
                <a href="./appointments?status=pending" class="text-black">
                  <div class="overview-container mt-3">
                    <div class="image-bg rounded-circle"> </div>
                    <i class="fa-solid fa-clock fa-2xl" style="color: #ffffff; margin-right: 4px;"></i>
                    <h5><?php echo $pendingAppointmentCount; ?></h5>
                    <p>Pending Appointments</p>
                  </div>
                </a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    <div class="col-12 text-uppercase">
      <h6 class="text-secondary fw-bolder">Tricycle's Zone</h6>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="row">
          <div class="col-12">
            <div class="d-block container-code mt-3 color-code-container animate">
              <a href="red_trike_info" class="text-decoration-none color-code-container custom-tooltip-container" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to see more">
                <div class="color-code-red d-flex">
                  <div class="col-2">
                    <div class="mt-2 center">
                      <img src="public/assets/images/red-trike.png" alt="Red Trike Image">
                      <p>Red Trike</p>
                    </div>
                  </div>
                  <div class="col-10">
                    <div class="description">
                      <p class="lh-1 mt-1">Ordinance No.153 Series of 2009 (Section 4) designates the shown areas as part of Zone 1 with color <span class="text-danger fw-bolder">RED </span>for the purposes of the operation of motorized tricycles in Ormoc City. This coverage is also a <span class="text-danger fw-bolder">FREE ZONE.</span></p>
                    </div>
                  </div>
                </div>
              </a>
              <a href="blue_trike_info" class="text-decoration-none color-code-container custom-tooltip-container" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to see more">
                <div class="color-code-blue d-flex mt-3">
                  <div class="col-2">
                    <div class="mt-2 center">
                      <img src="public/assets/images/blue-trike.png" alt="Blue Trike Image">
                      <p>Blue Trike</p>
                    </div>
                  </div>
                  <div class="col-10">
                    <div class="description">
                      <p class="lh-1 mt-1">Ordinance No.153 Series of 2009 (Section 4) designates the shown areas as part of Zone 2 with color <span class="text-primary fw-bolder">BlUE </span>for the purposes of the operation of motorized tricycles in Ormoc City.
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>  
      <div class="col-lg-6">
        <div class="row">
          <div class="col-12">
            <div class="d-block container-code color-code-container animate">
              <a href="yellow_trike_info" class="text-decoration-none color-code-container custom-tooltip-container" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to see more">
                <div class="color-code-yellow d-flex mt-3">
                  <div class="col-2">
                    <div class="mt-2">
                      <img src="public/assets/images/yellow-trike.png" alt="Yellow Trike Image" class="mx-3">
                      <p>Yellow Trike</p>
                    </div>
                  </div>
                  <div class="col-10">
                    <div class="description">
                      <p class="lh-1 mt-1 ms-2">Ordinance No.153 Series of 2009 (Section 4) designates the shown areas as part of Zone 3 with color <span class="text-warning fw-bolder">YELLOW </span>for the purposes of the operation of motorized tricycles in Ormoc City.
                    </div>
                  </div>
                </div>
              </a>
              <a href="green_trike_info" class="text-decoration-none color-code-container custom-tooltip-container" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to see more">
                <div class="color-code-green d-flex mt-3">
                  <div class="col-2">
                    <div class="mt-2 center">
                      <img src="public/assets/images/green-trike.png" alt="Green Trike Image">
                      <p>Green Trike</p>
                    </div>
                  </div>
                  <div class="col-10">
                    <div class="description">
                      <p class="lh-1 mt-1">Ordinance No.153 Series of 2009 (Section 4) designates the shown areas as part of Zone 4 with color <span class="text-success fw-bolder">GREEN </span>for the purposes of the operation of motorized tricycles in Ormoc City.
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mt-4">
        <div class="col-12 text-uppercase">
          <h6 class="text-secondary fw-bolder">Taripa</h6>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="bg-white">
              <div>
                <h6 style="font-size: 12px; color:gray;">Fare Rate (<?php $minYear = min($data['years']); $maxYear = max($data['years']); echo $minYear == $maxYear ? $minYear : $minYear . '-' . $maxYear; ?>)</h6>
                <canvas id="myChart"></canvas>
                <script>
                  let phpData = <?php echo $data['ratesByYear']; ?>;
                  let regularData = [];
                  let discountedData = [];
                  let years = <?php echo json_encode($data['years']); ?>;

                  years.forEach(function (year) {
                    regularData.push(phpData[year][1]['regular_fare']);
                    discountedData.push(phpData[year][1]['discounted_fare']);
                  });

                  let ctx = document.getElementById('myChart').getContext('2d');
                  let myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                      labels: years,
                      datasets: [
                        {
                          label: 'Regular Fare',
                          data: regularData,
                          borderColor: 'rgba(75, 192, 192, 1)',
                          borderWidth: 2,
                          backgroundColor: 'rgba(75, 192, 192, 0.2)',
                          fill: false,
                        },
                        {
                          label: 'Discounted Fare',
                          data: discountedData,
                          borderColor: 'rgba(255, 99, 132, 1)',
                          borderWidth: 2,
                          backgroundColor: 'rgba(255, 99, 132, 0.2)',
                          fill: false,
                        },
                      ],
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true,
                          title: {
                            display: true,
                            text: 'Fare Rate (₱)'
                          }
                        },
                        x: {
                          title: {
                            display: true,
                            text: 'Year'
                          }
                        }
                      }
                    }
                  });
                </script>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mt-4">
        <div class="col-12 text-uppercase">
          <h6 class="text-secondary fw-bolder">Franchise Availed</h6>
        </div>
        <div class="row">
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <div class="col-12">
            <h6 style="font-size: 12px; color:gray;">Allocation of Operators Who Got Franchise</h6>
            <div class="bg-white" style="text-align: center;">
              <div id="chart_div" style="width: 500px; height: 400px; margin: 0 auto;"></div> 
              <script type="text/javascript">
                google.charts.load("current", { packages: ["corechart"] });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                  var data = google.visualization.arrayToDataTable([
                    ['Year', 'Count'],
                    <?php
                    foreach ($data['chartData'] as $item) {
                      echo "['" . $item['year'] . "', " . $item['count'] . "],";
                    }
                    ?>
                  ]);

                  var options = {
                    is3D: true,
                    legend: {
                      position: 'top', 
                      alignment: 'center',
                      textStyle: { fontSize: 16 }
                    },
                    chartArea: { width: '80%', height: '80%' },
                    pieSliceText: 'percentage',
                    slices: {
                      0: { color: '#FF5733' },
                      1: { color: '#33FFC1' },
                      2: { color: '#3361FF' },
                      3: { color: '#B033FF' },
                      4: { color: '#FF33EA' }
                    },
                    pieSliceTextStyle: {
                      fontSize: 14
                    }
                  };

                  var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                  chart.draw(data, options);
                }
              </script>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Add the 'animate' class to trigger the animation for color code containers
      const colorCodeContainers = document.querySelectorAll('.color-code-container');
      colorCodeContainers.forEach(container => {
        container.classList.add('animate');
      });

      // Add the 'animate' class to trigger the animation for each overview container
      const overviewContainers = document.querySelectorAll('.overview-container');
      overviewContainers.forEach(container => {
        container.classList.add('animate');
      });
    });

    $(document).ready(function() {
      // Add a function to set the background color of the tooltip
      $('.custom-tooltip-container').on('shown.bs.tooltip', function() {
        $('.tooltip-inner').css('background-color', '#FF4200');
      });

      // Initialize Bootstrap tooltips
      $('[data-bs-toggle="tooltip"]').tooltip();
    });
  </script>
</main>