<?php
  include "db_connection.php";
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
	<!-- Bootstrap CSS
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"> -->
  <!-- Fontawesome CSS
  <link rel="stylesheet" href="Font-Awesome-master/css/all.min.css"> -->
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="stylesheet/index.css">
  <link rel="stylesheet" href="stylesheet/flash_messages.css">
  <!-- Bootstrap JS
  <script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script> -->
  <!-- Custom JS -->
  <script src="js/flash_messages.js"></script>
</head>
<body>
  <section class="vh-100 d-flex justify-content-center align-items-center">
  <?php 
    if (isset($_SESSION['flash_message'])) {  
      $message_type = $_SESSION['flash_message_type'] ?? 'default';
      $css_class = '';

      switch ($message_type) {
        case 'success':
          $css_class = 'success';
          break;
        case 'error':
          $css_class = 'error';
          break;
        default:
          $css_class = 'default';
          break;
      }
    ?>
    <p class="<?php echo $css_class; ?>" id="flash-message"> 
      <?php echo $_SESSION['flash_message']; ?>
    </p>
    <?php 
      unset($_SESSION['flash_message']);
      unset($_SESSION['flash_message_type']);
    }
    ?> 
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="draw2.png" class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form action="processlogin.php" method="post">
            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start mb-4">
              <p class="lead fw-normal me-3 mb-0">Sign in with</p>
              <button type="button" class="btn btn-floating mx-1 fbIcon">
                <i class="fab fa-facebook-f"></i>
              </button>

              <button type="button" class="btn btn-floating mx-1 twitterIcon">
                <i class="fab fa-twitter"></i>
              </button>

              <button type="button" class="btn btn-floating mx-1 linkedIn">
                <i class="fab fa-linkedin-in"></i>
              </button>
            </div>

            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="username" name="username" placeholder=" " required>
              <label for="username">Username</label>
            </div>

            <div class="form-floating mb-3 pass">
              <input type="password" class="form-control" id="password" name="password" placeholder=" " required>
              <label for="password">Password</label>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
              <div class="form-check">
                <input class="form-check-input me-2" type="checkbox" value="" id="rememberMe" />
                <label class="form-check-label rememberMe p-0 mb-1" for="rememberMe">
                  Remember me
                </label>
              </div>
              <a href="#!" class="text-body text-decoration-none forgotPass text-decoration-underline">Forgot password?</a>
            </div>

            <div class="text-center text-lg-start">
              <button type="submit" class="btn btn-lg btn-block mb-3 btnLogin">Login</button>
              <p class="small fw-bold mb-0 mt-2 text-center register">Don't have an account? <a href="#!" class="registerLink">Register</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</body>
</html>