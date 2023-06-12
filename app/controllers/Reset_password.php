<?php

class Reset_password
{
  use Controller;

  public function index()
  {
    $data = [];

    if (is_authenticated()) {
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
          $user->update(['email' => $email], ['password' => $hashedPassword], 'user_id'); 

          set_flash_message("Password reset successfully. <br>You can now log in with your new password.", "success");
          redirect('sign_in');
        } else {
          $data['errors'] = $user->getErrors();
          $errorMessages = implode('<br>', $data['errors']);
          set_flash_message("{$errorMessages}", "error");
          redirect("reset_password?email=$email&token=$token");
        }
      } else {
        set_flash_message("Invalid or expired token.", "error");
        redirect('');
      }
    }

    echo $this->renderView('reset_password', $data);
  }
}