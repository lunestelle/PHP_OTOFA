<header>
  <div class="d-flex">
    <a href="<?=ROOT?>" class="d-flex text-decoration-none">
      <img class="logo" src="<?=ROOT?>/assets/images/logo.png" alt="Sakaycle Logo">
      <p>Sakay<span>cle</span></p>
    </a>
  </div>
  <nav class="navbar navbar-expand">
    <a href="#home" class="nav-link">HOME</a>
    <a href="#about" class="nav-link">ABOUT</a>
    <a href="#contact" class="nav-link">CONTACT</a>
    <?php if (is_authenticated()): ?>
      <a href="dashboard" class="nav-link">DASHBOARD</a>
    <?php endif; ?>
  </nav>
</header>

<section class="home" id="home">
  <div class="background container">
    <img src="<?=ROOT?>/assets/images/oc_logo.png" alt="Ormoc Logo">
    <div class="text-container">
      <h1 class="text-uppercase">Transportation Development Franchising <span></span></h1>
      <h1 class="text-uppercase">and Regulatory office<span></span></h1>
    </div>
    <?php if (!is_authenticated()): ?>
      <a href="javascript:void(0)" id="sign_in_btn" class="cta">SIGN IN/REGISTER</a>
    <?php endif; ?>
  </div>
</section>

<div class="container">
  <section id="about">
    <div class="about">
      <div class="about-top">
        <h1 class="about-title">ABOUT <span>US</span></h1>
        <p class="text-justify">At the forefront of innovation, our Transportation Development Franchising and Regulatory Office (TDFRO) is dedicated to enhancing tricycle transportation through cutting-edge solutions. By embracing technology, we strive to enhance operational efficiency, reduce delay transactions, and provide tricycle operators with a modern way to navigate their administrative responsibilities swiftly and effortlessly.</p>
      </div>
      <div class="about-bottom">
        <div class="about-cta">
          <div class="row">
            <div class="col-md-4">
              <div class="about-item">
                <div class="item-title">
                  <img src="<?=ROOT?>/assets/images/appointment.png" alt="Appointment Icon">
                  <p class="mx-1">Appointment</p>
                </div>
                <div class="text-justify about-item-body">
                Experience effortless transaction appointments with TDFRO. Our online scheduling ensures convenience, saving tricycle operators time and eliminating queues. Simplify your interactions with the Transportation Development Franchising and Regulatory Office today.
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="about-item">
              <div class="item-title">
                  <img src="<?=ROOT?>/assets/images/notification.png" alt="Push Notification"> 
                  <p class="mx-1">Push Notifications</p>
                </div>
                <div class="text-justify about-item-body">
                Push notifications for franchise renewal are essential for tricycle operators to renew on time and prevent penalties. By receiving timely reminders, operators can efficiently complete the renewal process, ensuring compliance and avoiding unnecessary fines. These notifications enable operators to stay informed and promoting timely renewals.
                </div>
              </div>
            </div>
          
            <div class="col-md-4">
              <div class="about-item">
              <div class="item-title">
                <img src="<?=ROOT?>/assets/images/management.png" alt="Management Icon">
                <p class="mx-1">Management</p>
              </div>
              <div class="text-justify about-item-body">
              Promote hassle-free tricycle management through digital solutions, minimizing paperwork, optimizing licensing, scheduling, and maintenance processes. Simplify interactions between operators and authorities for a more efficient and organized transportation system.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<footer class="text-white text-center text-lg-start" id="contact">
  <div class="p-4 m-auto gap-6 col-md-10">
    <div class="row mt-4">
      <div class="col-lg-5 col-md-12 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-4">About department</h5>
        <p class="text-justify">
        The Transportation Development Franchising and Regulatory Office (TDFRO) is a government agency responsible for overseeing the franchising and regulation of tricycle transportation in a given area. It plays a crucial role in ensuring the safe and efficient operation of tricycles, which are often a vital mode of transportation in local communities.
        </p>
        <p class="text-justify">
        TDFRO is tasked with issuing and managing tricycle franchises, setting and enforcing standards for tricycle design and maintenance, and implementing regulations that promote road safety and environmental sustainability within the tricycle sector.
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
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-4">Opening hours</h5>
        <table class="table text-center text-white">
          <tbody class="font-weight-normal">
            <tr>
              <td>Mon - Fri:</td>
              <td>8am - 5pm</td>
            </tr>
            <tr>
              <td>Sat - Sun:</td>
              <td>Rest Day</td>
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