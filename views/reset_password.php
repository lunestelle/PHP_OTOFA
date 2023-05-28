<?php
require_once "../controller/db_connection.php";
session_start();

function validateToken($email, $token, $conn)
{
  $query = "SELECT * FROM password_resets WHERE email = '$email' AND token = '$token' AND expiration_time > " . time();
  $result = mysqli_query($conn, $query);
  $count = mysqli_num_rows($result);
  return $count > 0;
}

function validatePassword($password) {
  $length = strlen($password);
  $uppercase = preg_match('/[A-Z]/', $password);
  $lowercase = preg_match('/[a-z]/', $password);
  $number = preg_match('/\d/', $password);
  $specialChar = preg_match('/[^a-zA-Z\d]/', $password);

  return $length >= 8 && $uppercase && $lowercase && $number && $specialChar;
}

if (isset($_POST['reset_password'])) {
  $email = $_POST['email'];
  $token = $_POST['token'];

  if (validateToken($email, $token, $conn)) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
      if (validatePassword($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $update_query = "UPDATE users SET password = '$hashed_password' WHERE email = '$email'";
        mysqli_query($conn, $update_query);

        $delete_query = "DELETE FROM password_resets WHERE email = '$email' AND token = '$token'";
        mysqli_query($conn, $delete_query);

        header("Location: /PHP_Sakaycle/views/sign_in.php");
        exit();
      } else {
        $error_message = "Password must be over 8 characters long and include at least 1 upper-case letter, 1 lower-case letter, 1 number, and 1 special character.";
      }
    } else {
      $error_message = "Passwords do not match.";
    }
  } else {
      $error_message = "Invalid token or email. Please try again.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
        <h1>Reset your password</h1>
        <p>Enter your new password.</p>
        <form method="post" action="">
          <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
          <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
          <div class="field password-toggle">
            <input type="password" id="new_password" autofocus name="new_password" placeholder="New Password" autocomplete="new-password" class="password_field" required>
            <i id="new_password-toggle-icon" class="toggle-icon fas fa-eye" onclick="togglePassword('new_password')"></i>
          </div>
          <div class="field password-toggle">
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" autocomplete="new-password" class="password_field" required>
            <i id="confirm_password-toggle-icon" class="toggle-icon fas fa-eye" onclick="togglePassword('confirm_password')"></i>
          </div>
          <div class="field">
            <p class="password_validation">Your password must be over 8 characters long and include at least <br> 1 upper-case letter, 1 lower-case letter, 1 number and 1 special <br> character.</small>
          </div>
          <?php if (isset($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
          <?php } ?>
          <div class="actions_devise">
            <button type="submit" class="btn btn-block" name="reset_password">RESET PASSWORD</button>
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