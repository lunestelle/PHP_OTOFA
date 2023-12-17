  <header>
    <div class="d-flex">
      <a href="<?=ROOT?>" class="d-flex text-decoration-none">
        <img class="logo-1" src="public/assets/images/logo.png" alt="Sakaycle Logo">
        <p>Sakay<span>cle</span></p>
      </a>
    </div>
    <nav class="navbar navbar-expand" id="navbar">
      <a href="#home" class="nav-link text-white scrollto active">HOME</a>
      <a href="#about" class="nav-link scrollto text-white">ABOUT</a>
      <a href="#team" class="nav-link scrollto text-white">TEAM</a>
      <a href="#contact" class="nav-link scrollto text-white">CONTACT</a>
      <?php if (is_authenticated()): ?>
        <a href="dashboard" class="nav-link">DASHBOARD</a>
      <?php endif; ?>
    </nav>
  </header>

  <section class="home" id="home">
    <div class="background container">
      <img class="logo" src="public/assets/images/oc_logo.png" alt="Ormoc Logo">
      <div class="text-container mt-4">
        <h1 class="text-uppercase">Transportation Development Franchising <span></span></h1>
        <h1 class="text-uppercase">and Regulatory office<span></span></h1>
      </div>
      <?php if (!is_authenticated()): ?>
        <a href="javascript:void(0)" id="sign_in_btn" class="cta">SIGN IN/REGISTER</a>
      <?php endif; ?>
    </div>
  </section>

  <div class="animate-on-scroll animated-section container color-code-container mt-5" id="about">
    <section class="">
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
                    <img src="public/assets/images/appointment.png" alt="Appointment Icon">
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
                    <img src="public/assets/images/notification.png" alt="Push Notification"> 
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
                  <img src="public/assets/images/management.png" alt="Management Icon">
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

  <div class="border border-2"></div>

  <div class="animate-on-scroll animated-section mt-5 our-team-bg color-code-container" id="team">
    <div class="container">
      <section>
      <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-lg-12">
          <!-- Section Heading-->
          <div class="section_heading text-center wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
            <h1>OUR <span class="text-warning">TEAM</span></h1>
            <p class="team-description">We are a group of BSIT students who are passionate and committed to using our various skills and knowledge to create innovative solutions through teamwork.</p>
          </div>
        </div>
        </div>
        <div class="row">
          <div class="d-flex justify-content-center gap-5">
            <!-- Single Advisor-->
            <div class="col-12 col-sm-9 col-lg-3 me-5">
              <div class="single_advisor_profile wow fadeInUp dashed-border" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                <!-- Team Thumb-->
                <div class="advisor_thumb"><img src="public/assets/images/team-shaina.png" alt="" style="width:200px;">
                  <!-- Social Info-->
                  <div class="social-info"><a href="https://www.facebook.com/shabshai/"><i class="fa-brands fa-facebook"></i></a><a href="https://www.instagram.com/shainamendoza_?igshid=OGQ5ZDc2ODk2ZA%3D%3D&utm_source=qr"><i class="fa-brands fa-square-instagram"></i></a><a href="#"><i class="fa-solid fa-envelope"></i></a></div>
                </div>
                <!-- Team Details-->
                <div class="single_advisor_details_info">
                  <h6>Shaina Mendoza</h6>
                  <p class="designation">Technical Writer</p>
                  <p class="designation">Front-end Developer</p>
                </div>
              </div>
            </div>
            <!-- Single Advisor-->
            <div class="col-12 col-sm-9 col-lg-3">
              <div class="single_advisor_profile wow fadeInUp dashed-border" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                <!-- Team Thumb-->
                <div class="advisor_thumb"><img src="public/assets/images/team-anna.jpg" alt="" style="width:200px;">
                  <!-- Social Info-->
                  <div class="social-info"><a href="https://www.facebook.com/annarose.limpangog"><i class="fa-brands fa-facebook"></i></i></a><a href="https://www.instagram.com/lunestelle_rosette?igshid=OGQ5ZDc2ODk2ZA=="><i class="fa-brands fa-square-instagram"></i></a><a href="#"><i class="fa-solid fa-envelope"></i></a></div>
                </div>
                <!-- Team Details-->
                <div class="single_advisor_details_info">
                  <h6>Anna Rose Limpangog</h6>
                  <p class="designation">Project Manager</p>
                  <p class="designation">Back-end Developer</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

  <footer class="text-white text-center text-lg-start" >
    <div class="p-4 m-auto gap-6 col-md-10" id="contact">
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
              <span class="fa-li"><i class="fas fa-envelope"></i></span><span class="ms-2">info@sakaycle.com</span>
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
      <a class="text-white" href="#">wlcresearch2023.com</a>
    </div>
  </footer>
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    // Smooth scrolling for anchor links
    document.querySelectorAll('a.scrollto').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();

        const targetId = this.getAttribute('href').substring(1);
        const targetSection = document.getElementById(targetId);

        if (targetSection) {
          targetSection.scrollIntoView({
            behavior: 'smooth'
          });

          // Add 'active' class to the clicked link
          document.querySelectorAll('a.scrollto').forEach(link => {
            link.classList.remove('active');
          });
          this.classList.add('active');
        }
      });
    });

    // Handle scroll animations for sections
    function handleScrollAnimations() {
      const elements = document.querySelectorAll('.animate-on-scroll');

      elements.forEach((el) => {
        const elementPosition = el.getBoundingClientRect().top;
        const windowHeight = window.innerHeight;

        if (elementPosition < windowHeight * 0.85) {
          el.classList.add('visible');
          const id = el.getAttribute('id');
          const correspondingLink = document.querySelector(`a[href="#${id}"]`);
          if (correspondingLink) {
            document.querySelectorAll('a.scrollto').forEach(link => {
              link.classList.remove('active');
            });
            correspondingLink.classList.add('active');
          }
        }
      });

      // Add 'active' class to HOME, ABOUT, TEAM, and CONTACT links based on sections
      const homeSection = document.getElementById('home');
      const aboutSection = document.getElementById('about');
      const teamSection = document.getElementById('team');
      const contactSection = document.getElementById('contact');
      const homeLink = document.querySelector('a[href="#home"]');
      const aboutLink = document.querySelector('a[href="#about"]');
      const teamLink = document.querySelector('a[href="#team"]');
      const contactLink = document.querySelector('a[href="#contact"]');

      const activeSection = findActiveSection(homeSection, aboutSection, teamSection, contactSection);
      
      switch (activeSection) {
        case 'home':
          removeAllActiveClasses();
          homeLink.classList.add('active');
          break;
        case 'about':
          removeAllActiveClasses();
          aboutLink.classList.add('active');
          break;
        case 'team':
          removeAllActiveClasses();
          teamLink.classList.add('active');
          break;
        case 'contact':
          removeAllActiveClasses();
          contactLink.classList.add('active');
          break;
        default:
          break;
      }
    }

    // Function to find the active section based on visibility
    function findActiveSection(homeSection, aboutSection, teamSection, contactSection) {
      if (isElementInViewport(homeSection)) {
        return 'home';
      } else if (isElementInViewport(aboutSection)) {
        return 'about';
      } else if (isElementInViewport(teamSection)) {
        return 'team';
      } else if (isElementInViewport(contactSection)) {
        return 'contact';
      }
      return '';
    }

    // Function to check if an element is in the viewport
    function isElementInViewport(el) {
      const rect = el.getBoundingClientRect();
      return (
        rect.top >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)
      );
    }

    // Function to remove 'active' class from all links
    function removeAllActiveClasses() {
      document.querySelectorAll('a.scrollto').forEach(link => {
        link.classList.remove('active');
      });
    }

    // Event listener for scroll
    window.addEventListener('scroll', () => {
      handleScrollAnimations();
    });

    // Initial check on page load
    window.addEventListener('load', () => {
      handleScrollAnimations();
    });

    // Scroll to top on page refresh
    window.addEventListener('beforeunload', () => {
      window.scrollTo(0, 0);
    });

    // Simulate click on HOME link when the page is refreshed
    const homeLink = document.querySelector('a[href="#home"]');
    homeLink.classList.add('active');
    homeLink.click();
  });

  // ORMOC CITY LOGO

  document.addEventListener('DOMContentLoaded', function () {
  // Smooth scrolling and other functions as previously defined

  // Function to play the logo animation
    function playAnimation() {
      const logo = document.querySelector('.logo');
      logo.classList.add('rotate-animation');

      setTimeout(() => {
        logo.classList.remove('rotate-animation');
        logo.classList.add('zoom-animation');
      }, 1000); // Rotate for 1 second, then add zoom animation

      setTimeout(() => {
        logo.classList.remove('zoom-animation');
        logo.classList.add('glow-animation');
      }, 3000); // Zoom animation for 2 seconds, then add glow

      setTimeout(() => {
        logo.classList.remove('glow-animation');
      }, 4000); // Remove glow after 1 second

      setTimeout(() => {
        logo.classList.add('zoomed-out'); // Set logo to initial state (if needed)
      }, 11000); // Return to the initial state after 10 seconds
    }

    // Play the animation initially and then every 10 seconds
    setInterval(() => {
      playAnimation();
    }, 10000); // Play the animation every 10 seconds

    // Initial animation trigger
    playAnimation();
  });
</script>
