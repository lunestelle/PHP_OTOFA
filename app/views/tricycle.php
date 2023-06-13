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
          <h6>Dashboard</h6>
        </div>
        <div class="mt-3">
          <a href="" class="text-uppercase register">Register</a>
        </div>
        <div class="container table-responsive pt-4"> 
          <table class="table-bordered table-hover">
            <thead class="thead-custom">
              <tr class="text-center text-uppercase">
                <th scope="col">#</th>
                <th scope="col">Plate No.</th>
                <th scope="col">Color Code</th>
                <th scope="col">Driver's Name</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>123</td>
                <td>Red</td>
                <td>Juan Dela Cruz</td>
                <td>Actions</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>456</td>
                <td>Green</td>
                <td>Pedro Kalungsod</td>
                <td>Actions</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>789</td>
                <td>Yellow</td>
                <td>Mario Bugsay</td>
                <td>Actions</td>
              </tr>
              <tr>
                <th scope="row">4</th>
                <td>012</td>
                <td>Blue</td>
                <td>Lito Gaspi</td>
                <td>Actions</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="title-head text-uppercase mt-3">
          <h6>Renewal of tricycle permits</h6>
        </div>
          <div class="container table-responsive pt-4"> 
          <table class="table-bordered table-hover">
            <thead class="thead-custom">
              <tr class="text-center text-uppercase">
                <th scope="col">#</th>
                <th scope="col">Plate No.</th>
                <th scope="col">Color Code</th>
                <th scope="col">Driver's Name</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>123</td>
                <td>Red</td>
                <td>Juan Dela Cruz</td>
                <td>Actions</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>456</td>
                <td>Green</td>
                <td>Pedro Kalungsod</td>
                <td>Actions</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>789</td>
                <td>Yellow</td>
                <td>Mario Bugsay</td>
                <td>Actions</td>
              </tr>
              <tr>
                <th scope="row">4</th>
                <td>012</td>
                <td>Blue</td>
                <td>Lito Gaspi</td>
                <td>Actions</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>