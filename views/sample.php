<!DOCTYPE html>
<html>
<head>
  <title>Sidebar Example</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="..\stylesheet\sample.css" type="text/css">
  <link rel="stylesheet" href="..\stylesheet\flash_messages.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="..\flash_messages.js"></script>
</head>
<body>
<div id="wrapper">

<!-- Sidebar -->
<div class="container-fluid">
  <div class="row">
    <div class="col-xl-2 col-lg-3 side-bar">
      <div class="sidebar-nav text-white">
        <a href="..\views\index.php">
            <img src="../assets/images/logo-dashboard.png" alt="">
        </a>
        <div class="mt-5">
          <li>
            <a href="#"><i class="fa-solid fa-list mr-2"></i>Dashboard</a>
          </li>
          <li>
            <a href="#"><i class="fa-solid fa-truck-pickup mr-2"></i>Tricycles</a>
          </li>
          <li>
              <a href="#"><i class="fa-regular fa-id-card mr-2"></i>Drivers</a>
          </li>
          <li>
            <a href="#"><i class="fa-solid fa-folder mr-2"></i>Documents</a>
          </li>
          <li>
            <a href="#"> <i class="fa-solid fa-calendar-days mr-2"></i>Appointment</a>
          </li>
          <li>
            <a href="#"><i class="fa-solid fa-screwdriver-wrench"></i>Maintenance Log</a>
          </li>
          <li>
            <a href="#"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
          </li>
        </div>
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
          <table class="table table-bordered table-hover">
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
          <table class="table table-bordered table-hover">
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
</body>
</html>