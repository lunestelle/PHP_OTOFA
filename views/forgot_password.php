<?php
require_once "../controller/db_connection.php";
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

function sendPasswordResetEmail($email, $token) {
  require_once "../views/email/reset_password_email.php";

  $mail = new PHPMailer;
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 465;
  $mail->SMTPSecure = 'ssl';
  $mail->SMTPAuth = true;
  $mail->Username = 'sakaycle@gmail.com';
  $mail->Password = 'hagfqeqlqdtyhqzi'; 

  $mail->setFrom('sakaycle@gmail.com', 'Sakaycle');
  $mail->addAddress($email);
  $mail->isHTML(true);
  $mail->Subject = 'Password Reset';
  $mail->Body = $emailContent;

  if (!$mail->send()) {
    echo 'Email could not be sent. Please try again later. Error: ' . $mail->ErrorInfo;
  } else {
    echo 'If your email address is correct, you will receive an email with instructions for how to reset your password in a few minutes.';
    header("Location: /PHP_Sakaycle/views/index.php");
    exit();
  }
}

if (isset($_POST['reset_password'])) {
  $email = $_POST['email'];

  $query = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($conn, $query);
  $count = mysqli_num_rows($result);

  if ($count > 0) {
    $token = generateToken();

    $expiration_time = time() + (30 * 60); // Token expiration time (30 minutes from now)
    $insert_query = "INSERT INTO password_resets (email, token, expiration_time) VALUES ('$email', '$token', '$expiration_time')";
    mysqli_query($conn, $insert_query);

    sendPasswordResetEmail($email, $token);

    header("Location: /PHP_Sakaycle/views/reset_password.php");
    exit();
  } else {
    $error_message = "Email not found in the system.";
  }
}

function generateToken($length = 32) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $token = '';

  for ($i = 0; $i < $length; $i++) {
    $token .= $characters[rand(0, strlen($characters) - 1)];
  }

  return $token;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sakaycle</title>
    <!-- Online -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" href="../stylesheet/user_signin_and_signup.css">
</head>
<body>
  <div class="split-section">
    <div class="split-left d-flex">
      <div>
        <h1>Forgot your password?</h1>
        <p>Enter your email address and we'll send a link to reset your password.</p>
        <form method="post" action="">
          <div class="field">
            <input type="email" id="email" autofocus name="email" placeholder="EMAIL" autocomplete="email" class="email_field" required>
          </div>
          <?php if (isset($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
          <?php } ?>
          <div class="actions_devise">
            <button type="submit" class="btn btn-block" name="reset_password">RESET PASSWORD</button>
          </div>
          <p class="text-center"><a href="../views/sign_in.php" class="back_btn">< Back</a></p>
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