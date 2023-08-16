<header>
  <div class="d-flex">
    <a href="#home" class="d-flex text-decoration-none">
      <img class="logo" src="<?=ROOT?>/assets/images/logo.png" alt="Sakaycle Logo">
      <p>Sakay<span>cle</span></p>
    </a>
  </div>
  <nav class="navbar navbar-expand">
    <a href="#home" class="nav-link">HOME</a>
    <a href="#about" class="nav-link">ABOUT</a>
    <a href="#contact" class="nav-link">CONTACT</a>
  </nav>
</header>

<section class="home" id="home">
  <div class="background container">
    <img src="<?=ROOT?>/assets/images/oc_logo.png" alt="Ormoc Logo">
    <div class="text-container">
      <h1>ORMOC CITY <span></span></h1>
      <h1>LOCAL GOVERNMENT UNIT <span></span></h1>
    </div>
    <?php if (!is_authenticated()): ?>
      <a href="javascript:void(0)" id="sign_in_btn" class="cta">SIGN IN/REGISTER</a>
    <?php endif; ?>
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
          <img src="<?=ROOT?>/assets/images/registration.png" alt="Registration Icon">  
          <div class="item-title">          
            <h2>Registration</h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officia quis voluptate veritatis sint quisquam quo eum doloribus dolores rem,</p>
          </div>
        </div>
        <div class="about-item">
          <img src="<?=ROOT?>/assets/images/renewal.png" alt="Renewal Icon"> 
          <div class="item-title">
            <h2>Renewal</h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officia quis voluptate veritatis sint quisquam quo eum doloribus dolores rem,</p>
          </div>
        </div>
        <div class="about-item">
          <img src="<?=ROOT?>/assets/images/appointment.png" alt="Appointment Icon">
          <div class="item-title">
            <h2>Appointment</h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officia quis voluptate veritatis sint quisquam quo eum doloribus dolores rem,</p>
          </div>
        </div>
        <div class="about-item">
          <img src="<?=ROOT?>/assets/images/management.png" alt="Management Icon">
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