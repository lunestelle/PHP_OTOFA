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
        <h2>Change your password</h2>
        <form action="">
          <div class="field">
            <input type="password" id="password" autofocus name="password" placeholder="NEW PASSWORD" class="password_field" required>
          </div>
          <div class="field">
            <input type="password" id="password_confirmation" autofocus name="password_confirmation" placeholder="CONFIRM NEW PASSWORD" class="password_field" required>
          </div>
          <div class="field">
            <p class="password_validation">Your password must be over 8 characters long and include at least <br> 1 upper-case letter, 1 lower-case letter, 1 number and 1 special <br> character.</small>
          </div>
          <div class="actions_devise">
            <button class="btn btn-block">CHANGE PASSWORD</button>
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