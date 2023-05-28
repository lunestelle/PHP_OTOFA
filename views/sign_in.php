<?php
  include "../controller/db_connection.php";
  session_start();

  if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    header('Location: sample.php');
    exit();
  }
  
  if (isset($_COOKIE['remember_email'])) {
    $rememberEmail = $_COOKIE['remember_email'];
  } else {
    $rememberEmail = '';
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {

      if ($email === $email && $password === $password) {
        $_SESSION['authenticated'] = true;
        header('Location: sample.php');
        exit();
      } else {
        $errorMessage = 'Invalid email or password.';
      }
    } else {
      $errorMessage = 'Please enter both email and password.';
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <!-- Online -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" href="../stylesheet/user_signin_and_signup.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="../javascript/password_toggle.js"></script>
    <style>
      .form-check-input.me-2:checked {
        background-color: #FF4200;
        border-color: #FF4200;
      }
      .split-left .field input[type="email"], .split-left .field input[type="password"] {
        width: 370px;
      }
    </style>
  </head>
  <body>
    <div class="split-section">
      <div class="split-left d-flex">
        <div>
          <h1>Login</h1>
          <p>Don't have an account? <a href="sign_up.php">Sign up</a></p>
          <form method="POST" action="">
            <div class="field">
              <input type="email" id="email" autofocus name="email" placeholder="EMAIL" class="email_field" required value="<?php echo $rememberEmail; ?>">
            </div>
            <div class="field password-toggle">
              <input type="password" id="password" autofocus name="password" placeholder="PASSWORD" autocomplete="password" class="password_field" required>
              <i id="password-toggle-icon" class="toggle-icon fas fa-eye" onclick="togglePassword('password')"></i>
            </div>
            <div class="form-check">
              <input class="form-check-input me-2" style="border: 1px solid #828282" type="checkbox" value="" id="rememberMe" <?php if (isset($_COOKIE['remember_email'])) { echo 'checked'; } ?>/>
              <label class="form-check-label rememberMe p-0 mb-1" for="rememberMe" style="font-size: 12px; font-weight: 400;">REMEMBER ME</label>
            </div>
            <div class="actions_devise">
              <button class="btn btn-block">SIGN IN</button>
            </div>
            <div class="forgot_password pb-2 text-center">
              <a href="../views/forgot_password.php">Forgot Your Password?</a>
            </div>
          </form>
        </div>
      </div>
      <div class="split-right d-flex">
        <div class="text-center">
          <img src="..\assets\images\logo.png" alt="Sakaycle Logo">
          <h1>Sakay<span>cle.</span></h1>
        </div>
      </div>
    </div>
  </body>
</html>