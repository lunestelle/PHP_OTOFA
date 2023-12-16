<?php

class Sign_in
{
  use Controller;

  public function index()
  {
    if (is_authenticated()) {
      set_flash_message("You are already signed in.", "error");
      redirect('dashboard');
    }

    // checks if the request is an AJAX call by checking the 'HTTP_X_REQUESTED_WITH'
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
      set_flash_message("Invalid request method.", "error");
      redirect('');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user = new User();
      $emailOrPhone = $_POST['email_or_phone'];
      $password = $_POST['password'];

      if (filter_var($emailOrPhone, FILTER_VALIDATE_EMAIL)) {
        $row = $user->first(['email' => $emailOrPhone]);
      } else {
        $phone_number = $user->formatPhoneNumber($emailOrPhone);
        $row = $user->first(['phone_number' => $phone_number]);
      }

      if ($row && password_verify($password, $row->password)) {
        if ($row->verification_status === 'verified') {
          $_SESSION['USER'] = $row;
          $_SESSION['authenticated'] = true;

          if (isset($_POST['rememberMe'])) {
            setcookie('email_or_phone', $emailOrPhone, time() + (86400 * 30), '/'); // cookie is set to expire in 30 days
            setcookie('password', $password, time() + (86400 * 30), '/');
          } else {
            if (isset($_COOKIE['email_or_phone'])) {
              setcookie('email_or_phone', '', time() - 3600, '/');
            }
            if (isset($_COOKIE['password'])) {
              setcookie('password', '', time() - 3600, '/');
            }
          }

          $response = ['status' => 'success', 'msg' => 'Successfully signed in!', 'redirect_url' => 'dashboard'];
          echo json_encode($response);
          exit;
        } else {
          // Check if the token is expired
          $currentTimestamp = date('Y-m-d H:i:s');
          if ($row->token_expiration && strtotime($row->token_expiration) < strtotime($currentTimestamp) || $row->verification_status === 'not_verified') {
            // Token is expired, generate a new one and update timestamp
            $newVerificationToken = bin2hex(random_bytes(8));
            $newTokenExpiration = date('Y-m-d H:i:s', strtotime('+24 hours'));

            $user->update(['email' => $emailOrPhone], [
              'verification_token' => $newVerificationToken,
              'token_expiration' => $newTokenExpiration
            ], 'email');

            $_SESSION['verification_token'] = $newVerificationToken;
            $_SESSION['first_name'] = ucwords($row->first_name);
            $_SESSION['verification_link'] = ROOT . '/verify_email?token=' . urlencode($_SESSION['verification_token']);

            // Send a new verification email
            $emailContent = $this->renderView('mailer/account_email_verification', false);
            $subject = "Verify Your Email Address for Sakaycle";
            $emailResult = sendEmail($row->email, $subject, $emailContent);

            if ($emailResult === 'success') {
              echo json_encode(['status' => 'error', 'msg' => 'Your account is not verified. Check your email for verification instructions.']);
              exit;
            } else {
              echo json_encode(['status' => 'error', 'msg' => 'Failed to send verification email. Please try again later.']);
              exit;
            }
          }
        }
      } else {
        echo json_encode(['status' => 'error', 'msg' => 'Invalid credentials. Please try again.']);
        exit;
      }
    }

    echo $this->renderView('sign_in', false);
  }
}