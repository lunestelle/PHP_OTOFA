<?php
  include "..\controller\db_connection.php";
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Page</title>
  <!-- Online -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
  <link rel="stylesheet" href="../stylesheet/index.css" type="text/css">
  <link rel="stylesheet" href="../stylesheet/flash_messages.css">
  <script src="../flash_messages.js"></script>
</head>
<body>
  <header>
    <div class="d-flex">
      <a href="#home" class="d-flex text-decoration-none">
        <img class="logo" src="..\assets\images\logo.png" alt="">
        <p>Sakay<span>cle</span></p>
      </a>
    </div>
    <nav class="navbar">
      <?php
        if (!isset($_SESSION['user'])) {
          echo '<a href="..\views\sample.php" type="button" class="cta">DASHBOARD</a>';
        }
      ?>
      <a href="#home">HOME</a>
      <a href="#about">ABOUT</a>
      <a href="#contact">CONTACT</a>
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle text-uppercase" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
          Juan &nbsp;
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <li><a class="dropdown-item" href="#">Account</a></li>
          <li><a class="dropdown-item" href="">Logout</a></li>
        </ul>
      </div> &nbsp;
    </nav>
  </header>

  <section class="home" id="home">
    <div class="background container">
      <img src="..\assets\images\oc_logo.png" alt="Ormoc Logo">
      <div class="text-container"> <!-- Added a class to the parent div -->
        <h1>ORMOC CITY <span></span></h1>
        <h1>LOCAL GOVERNMENT UNIT <span></span></h1>
      </div>
      <?php
        if (isset($_SESSION['user'])) {
          echo '<a href="..\views\sign_in.php" type="button" class="cta">SIGN IN</a>';
        }
      ?>
    </div>
  </section>

  <section id="about">
    <div class="about container">
      <div class="about-top">
        <h1 class="about-title">ABOUT <span>US</span></h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni facilis tenetur expedita similique, magnam sint veritatis aliquid nemo reiciendis illo itaque nostrum minima sequi dolore vel eveniet, harum suscipit consequuntur.</p>
      </div>
      <div class="about-bottom">
        <div class="about-cta">
          <div class="about-item">
            <img src="..\assets\images\registration.png" alt="">  
            <div class="item-title">          
              <h2>Registration</h2>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officia quis voluptate veritatis sint quisquam quo eum doloribus dolores rem,</p>
            </div>
          </div>
          <div class="about-item">
            <img src="..\assets\images\renewal.png" alt=""> 
            <div class="item-title">
              <h2>Renewal</h2>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officia quis voluptate veritatis sint quisquam quo eum doloribus dolores rem,</p>
            </div>
          </div>
          <div class="about-item">
            <img src="..\assets\images\appointment.png" alt="">
            <div class="item-title">
              <h2>Appointment</h2>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officia quis voluptate veritatis sint quisquam quo eum doloribus dolores rem,</p>
            </div>
          </div>
          <div class="about-item">
            <img src="..\assets\images\management.png" alt="">
            <div class="item-title">
              <h2>Management</h2>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officia quis voluptate veritatis sint quisquam quo eum doloribus dolores rem,</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
 
  <footer class="text-white text-center text-lg-start" id="contact">
    <div class="p-4 m-auto gap-6 col-md-10">
      <div class="row mt-4">
        <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
          <h5 class="text-uppercase mb-4">About company</h5>
          <p>
            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
            voluptatum deleniti atque corrupti.
          </p>
          <p>
            Blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas
            molestias.
          </p>
          <div class="mt-4">
            <!-- Facebook -->
            <a type="button" class="btn btn-floating btn-warning btn-lg"><i class="fab fa-facebook-f"></i></a>
            <!-- Twitter -->
            <a type="button" class="btn btn-floating btn-warning btn-lg"><i class="fab fa-twitter"></i></a>
            <!-- Google + -->
            <a type="button" class="btn btn-floating btn-warning btn-lg"><i class="fab fa-google-plus-g"></i></a>
            <!-- Linkedin -->
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase mb-4 pb-1">Contact us</h5>
          <ul class="fa-ul" style="margin-left: 1.65em;">
            <li class="mb-3">
              <span class="fa-li"><i class="fas fa-home"></i></span><span class="ms-2">Aunubing St. Cogon, Ormoc City</span>
            </li>
            <li class="mb-3">
              <span class="fa-li"><i class="fas fa-envelope"></i></span><span class="ms-2">ormoc_cityhall@gmail.com</span>
            </li>
            <li class="mb-3">
              <span class="fa-li"><i class="fas fa-phone"></i></span><span class="ms-2">+ 561 2485 52416</span>
            </li>
            <li class="mb-3">
              <span class="fa-li"><i class="fas fa-print"></i></span><span class="ms-2">+ 01 234 567 89</span>
            </li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase mb-4">Opening hours</h5>
          <table class="table text-center text-white">
            <tbody class="font-weight-normal">
              <tr>
                <td>Mon - Thu:</td>
                <td>8am - 9pm</td>
              </tr>
              <tr>
                <td>Fri - Sat:</td>
                <td>8am - 1am</td>
              </tr>
              <tr>
                <td>Sunday:</td>
                <td>9am - 10pm</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="text-center p-1 " style="background-color: #FF4200;">
      © 2023 Copyright:
      <a class="text-white" href="https://mdbootstrap.com/">wlcresearch2023.com</a>
    </div>
  </footer>
</body>
</html>
