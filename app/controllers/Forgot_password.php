<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'public/phpmailer/src/Exception.php';
require 'public/phpmailer/src/PHPMailer.php';
require 'public/phpmailer/src/SMTP.php';

class Forgot_password
{
  use Controller;

  public function index()
  {
    $data = [];

    if (is_authenticated()) {
      set_flash_message("You are already signed in.", "error");
      redirect('dashboard');
    }

    // checks if the request is an AJAX call by checking the 'HTTP_X_REQUESTED_WITH'
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest' || is_authenticated()) {
      set_flash_message("Invalid request method.", "error");
      redirect('');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $_POST['email'];

      $user = new User();
      $passwordReset = new PasswordReset();

      if ($user->emailExists($email)) {
        $token = $passwordReset->generateToken();

        $expiration_time = time() + (30 * 60); // Token expiration time (30 minutes from now)
        $passwordReset->saveResetToken($email, $token, $expiration_time);

        $this->sendPasswordResetEmail($email, $token);
      } else {
        echo json_encode(['status' => 'error', 'msg' => 'Email does not exist.']);
				exit;
      }
    }

    echo $this->renderView('forgot_password', false, $data);
  }

  private function sendPasswordResetEmail($email, $token)
  {

    $data = [
      'email' => $email,
      'token' => $token
    ];

    $passwordReset = new PasswordReset();
    $userEmail = $passwordReset->findEmailByToken($token);

    if ($userEmail === $email) {
      $_SESSION['reset_token'] = $token;
      $_SESSION['reset_email'] = $userEmail;
      $_SESSION['reset_link'] = ROOT . '?email=' . urlencode($_SESSION['reset_email']) . '&token=' . urlencode($_SESSION['reset_token']) . '&reset=true';

      $emailContent = $this->renderView('mailer/reset_password_email', false, $data);

      $mail = new PHPMailer();
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 465;
      $mail->SMTPSecure = 'ssl';
      $mail->SMTPAuth = true;
      $mail->Username = 'sakaycle@gmail.com';
      $mail->Password = 'hagfqeqlqdtyhqzi'; 

      $mail->setFrom('sakaycle@gmail.com', 'Sakaycle');
      $mail->addAddress($email); // Recipient email
      $mail->isHTML(true);
      $mail->Subject = 'Password Reset';
      $mail->Body = $emailContent;

      if (!$mail->send()) {
        echo json_encode(['status' => 'error', 'msg' => 'Email could not be sent. Please try again later.']);
				exit;
      } else {
        if (isset($_SESSION['reset_token'])) {
          unset($_SESSION['reset_token']);
        }
        if (isset($_SESSION['reset_email'])) {
          unset($_SESSION['reset_email']);
        }
        if (isset($_SESSION['reset_link'])) {
          unset($_SESSION['reset_link']);
        }
        $message = 'If your email address is correct, you will <br> receive an email with instructions for how to <br> reset your password in a few minutes.';
        $formattedMessage = str_replace('<br>', '', $message);
        $response = ['status' => 'success', 'msg' => $formattedMessage, 'redirect_url' => ''];
        echo json_encode($response);
        exit;
      }
    }
  }
}