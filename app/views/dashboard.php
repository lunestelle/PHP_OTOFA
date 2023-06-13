<div id="wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-2 col-lg-3 side-bar">
        <div class="sidebar-nav text-white">
          <a href="<?=ROOT?>">
            <img src="<?=ROOT?>/assets/images/logo-dashboard.png" alt="Sakaycle Logo">
          </a>
          <div class="mt-5">
            <li>
              <a href="..\public\dashboard"><i class="fa-solid fa-list"></i>Dashboard</a>
            </li>
            <li>
              <a href="..\public\tricycle"><i class="fa-solid fa-truck-pickup"></i>Tricycles</a>
            </li>
            <li>
              <a href="#"><i class="fa-regular fa-id-card"></i>Drivers</a>
            </li>
            <li>
              <a href="#"><i class="fa-solid fa-folder"></i>Documents</a>
            </li>
            <li>
              <a href="#"> <i class="fa-solid fa-calendar-days"></i>Appointment</a>
            </li>
            <li>
              <a href="#"><i class="fa-solid fa-screwdriver-wrench"></i>Maintenance Log</a>
            </li>
          </div>
        </div>
        <div class="dropdown">
          <button class="btn color dropdown-toggle text-uppercase" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $_SESSION['user_first_name']; ?> &nbsp;
            <i class="fa-solid fa-caret-up"></i>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-gear"></i>Account</a></li>
            <li>
              <form action="<?= ROOT ?>/sign_out" method="post" id="sign-out-form">
                <input type="hidden" name="sign_out" value="1">
                <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('sign-out-form').submit();">
                  <i class="fa-solid fa-right-from-bracket"></i>Logout
                </a>
              </form>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-xl-10 col-lg-9 p-2">
        <div class="title-head text-uppercase">
          <h6>Tricycles</h6>
        </div>
        <div class="mt-3">
          <a href="#" class="text-uppercase register">Export</a>
        </div>

        <div class="container gap-5 px-5 mb-4 pb-3">
          <div class="overview-container mt-3">
          <img src="assets/images/tricycle.png" alt="">
            <h5>10</h5>
            <p>Tricycles</p>
          </div>
          <div class="overview-container mt-3">
          <img src="assets/images/Driver.png" alt="">
          <h5>10</h5>
            <p>Drivers</p>
          </div>
          <div class="overview-container mt-3">
            <img src="assets/images/Cash.png" alt="">
            <h5>555</h5>
            <p>Boundaries</p>
          </div>
        </div>
       
        <div class="title-head text-uppercase mt-3">
          <h6>Tricycle's Code</h6>
        </div>
        <div class="container-code mt-3 mx-4">
          <div class="color-code-blue d-flex">
            <div>
              <img src="assets/images/blue-trike.png" alt="">
              <p>Blue Trike</p>
            </div>
            <div class="description">
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit, Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magnam voluptatum sunt ipsam, laborum, tenetur exercitationem at illum odit expedita nemo, quasi soluta id in quaerat numquam molestias eum nihil placeat.</p>
            </div>
          </div>
          <div class="color-code-green d-flex">
            <div>
              <img src="assets/images/green-trike.png" alt="">
              <p>Green Trike</p>
            </div>
            <div class="description">
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magnam voluptatum sunt ipsam, laborum, tenetur exercitationem at illum odit expedita nemo, quasi soluta id in quaerat numquam molestias eum nihil placeat.</p>
            </div>
          </div>
          <div class="color-code-red d-flex">
            <div>
              <img src="assets/images/red-trike.png" alt="">
              <p>Red Trike</p>
            </div>
            <div class="description">
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magnam voluptatum sunt ipsam, laborum, tenetur exercitationem at illum odit expedita nemo, quasi soluta id in quaerat numquam molestias eum nihil placeat.</p>
            </div>
          </div>
          <div class="color-code-yellow d-flex">
            <div>
              <img src="assets/images/yellow-trike.png" alt="">
              <p>YellowTrike</p>
            </div>
            <div class="description">
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magnam voluptatum sunt ipsam, adipisicing elit. Magnam voluptatum sunt ipsam, laborum, tenetur exercitationem at illum odit expedita nemo, quasi soluta id in quaerat numquam molestias eum nihil placeat.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>