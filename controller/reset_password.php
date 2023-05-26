<?php
include "../controller/db_connection.php";
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email from the form
    $email = $_POST["email"];

    // Check if the email exists in the database
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Generate a new password
        $newPassword = generateRandomPassword(); // You need to implement this function

        // Update the password in the database
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateQuery = "UPDATE users SET password = '$hashedPassword' WHERE email = '$email'";
        mysqli_query($conn, $updateQuery);

        // Send the new password to the user via email
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->Port = 465; // Replace with the appropriate SMTP port
        $mail->SMTPAuth = true;
        $mail->Username = 'sakaycle@gmail.com'; // Gmail
        $mail->Password = 'hagfqeqlqdtyhqzi'; // Your Gmail app password
        $mail->SMTPSecure = 'ssl';

        $mail->setFrom('sakaycle@gmail.com'); // Replace with your name and email
        $mail->addAddress($email); // Email recipient
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset';
        $mail->Body = '
          <html>
          <head>
              <style>
                  /* CSS styles */
                  body {
                      font-family: Arial, sans-serif;
                      background-color: transparent;
                  }
                  .container {
                      max-width: 600px;
                      margin: 0 auto;
                      padding: 20px;
                      background-color: #ffffff;
                      border: 1px solid #dddddd;
                      border-radius: 8px;
                      box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
                  }
                  h1 {
                      color: #333333;
                      font-size: 24px;
                      margin-bottom: 20px;
                  }
                  p {
                      color: #555555;
                      font-size: 16px;
                      line-height: 1.5;
                  }
              </style>
          </head>
          <body>
              <div class="container">
                  <h1>Password Reset</h1>
                  <p>Dear User,</p>
                  <p>We have reset your password. Please use the following new password to log in:</p>
                  <p><strong>' . $newPassword . '</strong></p>
                  <p>If you did not initiate this password reset request, please contact us immediately.</p>
                  <p>Thank you,</p>
                  <p>The Sakaycle Team</p>
              </div>
          </body>
          </html>';

        if (!$mail->send()) {
            // Failed to send email
            echo 'Failed to send email. Error: ' . $mail->ErrorInfo;
        } else {
            // Display a success message to the user
            echo 'Your password has been reset. Please check your email for the new password.';
        }
    } else {
        // Email does not exist in the database
        echo "Email not found. Please try again.";
    }

    // Close the database connection
    mysqli_close($conn);
}

// Function to generate a random password
function generateRandomPassword() {
    $length = 8;
    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = "";

    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $password;
}
?>
