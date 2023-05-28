<?php
include "../controller/db_connection.php";
session_start();

if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
  header('Location: sample.php');
  exit();
}

function validatePassword($password) {
  $length = strlen($password);
  $uppercase = preg_match('/[A-Z]/', $password);
  $lowercase = preg_match('/[a-z]/', $password);
  $number = preg_match('/\d/', $password);
  $specialChar = preg_match('/[^a-zA-Z\d]/', $password);

  return $length >= 8 && $uppercase && $lowercase && $number && $specialChar;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $first_name = $_POST["first_name"];
  $last_name = $_POST["last_name"];
  $password = $_POST["password"];
  $password_confirmation = $_POST["password_confirmation"];

  if (validatePassword($password)) {
    if ($password == $password_confirmation) {
      $existingEmailQuery = "SELECT * FROM users WHERE email = '$email'";
      $existingEmailResult = mysqli_query($conn, $existingEmailQuery);

      if (mysqli_num_rows($existingEmailResult) > 0) {
        $email_error = "This email is already registered.";
      } else {
        $existingNameQuery = "SELECT * FROM users WHERE first_name = '$first_name' AND last_name = '$last_name'";
        $existingNameResult = mysqli_query($conn, $existingNameQuery);

        if (mysqli_num_rows($existingNameResult) > 0) {
          $name_error = "This name combination is already registered.";
        } else {
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
          $insertQuery = "INSERT INTO users (email, first_name, last_name, password) VALUES ('$email', '$first_name', '$last_name', '$hashed_password')";
          $insertResult = mysqli_query($conn, $insertQuery);

          if ($insertResult) {
            $_SESSION['authenticated'] = true;
            header("Location: sample.php");
            exit();
          } else {
            $database_error = "Failed to store user information in the database.";
          }
        }
      }
    } else {
      $password_error = "Password and password confirmation do not match.";
    }
  } else {
    $password_error = "password validation is not correct";
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <!-- Online -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" href="../stylesheet/user_signin_and_signup.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="../javascript/password_toggle.js"></script>
  </head>
  <body>
    <div class="split-section">
      <div class="split-left d-flex">
        <div>
          <h1>Sign up</h1>
          <p>Already signed up? <a href="sign_in.php">Log in</a></p>
          <form method="POST" action="">
            <div class="field">
              <input type="email" id="email" autofocus name="email" placeholder="EMAIL" autocomplete="email" class="email_field" required>
            </div>
            <div class="row">
              <div class="col">
                <div class="field">
                  <input type="text" id="first_name" autofocus name="first_name" placeholder="FIRST NAME" autocomplete="given-name" class="name_field" required>
                </div>
              </div>
              <div class="col">
                <div class="field">
                  <input type="text" id="last_name" autofocus name="last_name" placeholder="LAST NAME" autocomplete="family-name" class="name_field" required>
                </div>
              </div>
            </div>
            <div class="field password-toggle">
              <input type="password" id="password" autofocus name="password" placeholder="PASSWORD" autocomplete="password" class="password_field" required>
              <i id="password-toggle-icon" class="toggle-icon fas fa-eye" onclick="togglePassword('password')"></i>
            </div>
            <div class="field password-toggle">
              <input type="password" id="password_confirmation" autofocus name="password_confirmation" placeholder="PASSWORD CONFIRMATION" class="password_field" required>
              <i id="password_confirmation-toggle-icon" class="toggle-icon fas fa-eye" onclick="togglePassword('password_confirmation')"></i>
            </div>
            <div class="field">
              <p class="password_validation">Your password must be over 8 characters long and include at least <br> 1 upper-case letter, 1 lower-case letter, 1 number and 1 special <br> character.</small>
            </div>
            <div class="field">
              <p class="password_validation"><?php if (isset($password_error)) echo $password_error; ?></p>
            </div>
            <div class="actions_devise">
              <button type="submit" class="btn btn-block">SIGN UP</button>
            </div>
          </form>
        </div>
      </div>
      <div class="split-right d-flex">
        <div class="text-center">
          <img src="../assets/images/logo.png" alt="Sakaycle Logo">
          <h1>Sakay<span>cle.</span></h1>
        </div>
      </div>
    </div>
  </body>
</html>
