<?php

class Reset_password
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
      $token = $_POST['token'];
      $password = $_POST['new_password'];
      $password_confirmation = $_POST['confirm_password'];
      $expiration_time = time(); // Get the current time

      $user = new User();
      $passwordReset = new PasswordReset();

      if ($passwordReset->validateToken($email, $token, $expiration_time)) {
        if ($user->validatePassword($password, $password_confirmation)) {
          $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
          $user->update(['email' => $email], ['password' => $hashedPassword], 'email');

          // Automatically remove the email and token from the password_resets table
          $passwordReset->deleteToken($email);

          $response = ['status' => 'success', 'msg' => 'Password reset successfully. You can now log in with your new password.', 'redirect_url' => ROOT];
          echo json_encode($response);
          exit;
        } else {
          $data['errors'] = $user->getErrors();
          $errorCount = count($data['errors']);
          $errorMessages = implode(($errorCount > 1 ? ', ' : ''), $data['errors']);
          if ($errorCount > 1) {
            $errorMessages = str_replace('.', '', $errorMessages);
          }
          $errorMessages = str_replace('<br>', '', $errorMessages);
          echo json_encode(['status' => 'error', 'msg' => $errorMessages]);
          exit;
        }
      } else {
        echo json_encode(['status' => 'error', 'msg' => 'Invalid or expired token.']);
        exit;
      }
    }

    echo $this->renderView('reset_password', false, $data);
  }
}