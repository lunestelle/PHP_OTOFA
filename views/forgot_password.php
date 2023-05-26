<?php
  include "../controller/db_connection.php";
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
  <link rel="stylesheet" href="../stylesheet/user_signin_and_signup.css">
  </head>
  <body>
    <div class="split-section">
      <div class="split-left d-flex">
      <div>
        <h1>Forgot your password?</h1>
        <p>Enter your email address and we'll send a link to <br> reset your password.</p>
        <form method="post" action="../controller/reset_password.php">
          <div class="field">
            <input type="email" id="email" autofocus name="email" placeholder="EMAIL" autocomplete="email" class="email_field" required>
          </div>
          <div class="actions_devise">
            <button class="btn btn-block">RESET PASSWORD</button>
          </div>
          <p class="text-center"><a href="../views/log_in.php" class="back_btn">< Back</a></p>
          </div>
        </form>
      </div>
      <div class="split-right d-flex">
        <div class="text-center">
          <img src="../images/logo.png" alt="Sakaycle Logo">
          <h1>Sakay<span>cle.</span></h1>
        </div>
      </div>
    </div>
</body>
</html>