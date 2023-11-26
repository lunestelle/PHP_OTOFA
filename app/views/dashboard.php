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
                <a href="./appointments" class="text-black">
                  <div class="overview-container">
                    <div class="image-bg rounded-circle"> </div>
                    <i class="fa-solid fa-truck-pickup fa-2xl" style="color: #ffffff; margin-right: 8px;"></i>
                    <h5>10</h5>
                    <p>Tricycles</p>
                  </div>
                </a>
                <a href="./drivers" class="text-black">
                  <div class="overview-container">
                    <div class="image-bg rounded-circle"> </div>
                    <i class="fa-solid fa-user fa-2xl" style="color: #ffffff;"></i>
                    <h5>10</h5>
                    <p>Drivers</p>
                  </div>
                </a>
                <a href="./appointments" class="text-black">
                 <div class="overview-container">
                    <div class="image-bg rounded-circle"> </div>
                    <i class="fa-solid fa-clock fa-2xl" style="color: #ffffff; margin-right: 4px;"></i>
                    <h5>15</h5>
                    <p>Appointments</p>
                  </div>
                 </a>
              </div>
            </div>
          </div>
        <?php } elseif ($userRole === 'admin') { ?>
          <div class="col-12">
            <div class="overview-wrapper">
              <div class="container overview-margin px-5 pb-3">
                <a href="./appointments" class="text-black">
                  <div class="overview-container mt-3">
                    <div class="image-bg rounded-circle"> </div>
                    <i class="fa-solid fa-truck-pickup fa-2xl" style="color: #ffffff; margin-right: 8px;"></i>
                    <h5>10</h5>
                    <p>Tricycles</p>
                  </div>
                </a>
                <a href="./drivers" class="text-black">
                  <div class="overview-container mt-3">
                    <div class="image-bg rounded-circle"> </div>
                    <i class="fa-solid fa-user fa-2xl" style="color: #ffffff;"></i>
                    <h5>10</h5>
                    <p>Drivers</p>
                  </div>
                </a>
                <a href="./appointments" class="text-black">
                 <div class="overview-container mt-3">
                    <div class="image-bg rounded-circle"> </div>
                    <i class="fa-solid fa-clock fa-2xl" style="color: #ffffff; margin-right: 4px;"></i>
                    <h5>15</h5>
                    <p>Appointments</p>
                  </div>
                 </a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="col-12 text-uppercase">
          <h6 class="text-secondary fw-bolder">Tricycle's Code </h6>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="d-block container-code mt-3 color-code-container animate">
              <a href="red_trike_info" class="text-decoration-none">
                <div class="color-code-red d-flex">
                  <div class="mt-2 center">
                    <img src="assets/images/red-trike.png" alt="Red Trike Image">
                    <p>Red Trike</p>
                  </div>
                  <div class="description">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit, Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
                  </div>
                </div>
              </a>
              <a href="blue_trike_info" class="text-decoration-none">
                <div class="color-code-blue d-flex mt-3">
                  <div class="mt-2 center">
                    <img src="assets/images/blue-trike.png" alt="Blue Trike Image">
                    <p>Blue Trike</p>
                  </div>
                  <div class="description">
                    <p class="">Lorem ipsum dolor sit amet consectetur, adipisicing elit, Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
                  </div>
                </div>
              </a>
              <a href="yellow_trike_info" class="text-decoration-none">
                <div class="color-code-yellow d-flex mt-3">
                  <div class="mt-2">
                    <img src="assets/images/yellow-trike.png" alt="Yellow Trike Image" class="center">
                    <p  class="pb-1">Yellow Trike</p>
                  </div>
                  <div class="description">
                    <p class="">Lorem ipsum dolor sit amet consectetur, adipisicing elit, Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
                  </div>
                </div>
              </a>
              <a href="green_trike_info" class="text-decoration-none">
                <div class="color-code-green d-flex mt-3">
                  <div class="mt-2 center">
                    <img src="assets/images/green-trike.png" alt="Green Trike Image">
                    <p>Green Trike</p>
                  </div>
                  <div class="description">
                    <p class="">Lorem ipsum dolor sit amet consectetur, adipisicing elit, Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="col-12 text-uppercase">
          <h6 class="text-secondary fw-bolder">Taripa</h6>
        </div>
        <div class="row">
          <div class="col-12">
           <div class="bg-white">
             <div class="mt-2">
              <h6>Fare Rate (2019-2023)</h6>
                <canvas id="fareChart"></canvas>
                <script>
                  document.addEventListener("DOMContentLoaded", function() {
                    // Data
                    const years = ['2019', '2020', '2021', '2022', '2023'];
                    const studentFare = [7, 7, 7, 7, 8]; // Fare for students
                    const pwdFare = [7, 7, 7, 7, 8];     // Fare for PWD
                    const seniorFare = [7, 7, 7, 7, 8];   // Fare for seniors
                    const regularFare = [10, 10, 10, 10, 10]; // Fare for regular passengers

                    // Chart Configuration
                    var ctx = document.getElementById('fareChart').getContext('2d');
                    var fareChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: years,
                        datasets: [
                          {
                            label: 'Student',
                            data: studentFare,
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                          },
                          {
                            label: 'PWD',
                            data: pwdFare,
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                          },
                          {
                            label: 'Senior',
                            data: seniorFare,
                            backgroundColor: 'rgba(255, 205, 86, 0.5)',
                            borderColor: 'rgba(255, 205, 86, 1)',
                            borderWidth: 1
                          },
                          {
                            label: 'Regular',
                            data: regularFare,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                          }
                        ]
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
                  });
                </script>
             </div>
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
  </script>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>