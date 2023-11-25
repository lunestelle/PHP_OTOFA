<main class="dashboard-container col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">dashboard</h6>
    </div>
    <div class="col-lg-12 mt-5">
      <div class="row">
        <?php if ($userRole === 'operator') { ?>
          <div class="col-12">
            <div class="overview-wrapper">
              <div class="container gap-5 px-5 mb-4 pb-3">
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
        <?php } elseif ($userRole === 'admin') { ?>
          <div class="col-12">
            <div class="overview-wrapper">
              <div class="container gap-5 px-5 mb-4 pb-3">
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
    <div class="d-flex">
      <div class="col-lg-6">
        <div class="col-12 text-uppercase">
          <h6 class="text-secondary fw-bolder">Tricycle's Code </h6>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="d-block container-code mt-3">
              <a href="red_trike_info" class="text-decoration-none">
                <div class="color-code-red d-flex">
                  <div class="mt-2 center">
                    <img src="assets/images/red-trike.png" alt="Red Trike Image">
                    <p>Red Trike</p>
                  </div>
                  <div class="description">
                    <p class="truncate">Lorem ipsum dolor sit amet consectetur, adipisicing elit, Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
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
                    <p class="truncate">Lorem ipsum dolor sit amet consectetur, adipisicing elit, Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
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
                    <p class="truncate">Lorem ipsum dolor sit amet consectetur, adipisicing elit, Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
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
                    <p class="truncate">Lorem ipsum dolor sit amet consectetur, adipisicing elit, Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
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
           <div class="bg-white p-2">
             <div></div>
           </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>