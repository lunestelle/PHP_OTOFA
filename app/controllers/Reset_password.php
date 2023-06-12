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

    $email = $_GET['email'] ?? '';
    $token = $_GET['token'] ?? '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];

        $user = new User();
        $passwordReset = new PasswordReset();

        if ($passwordReset->validateToken($email, $token)) {
            if ($user->emailExists($email)) {
                if ($user->validatePassword($newPassword, $confirmPassword)) {
                    $user->updatePassword($email, $newPassword);
                    $passwordReset->deleteExistingToken($email);

                    set_flash_message("Password reset successfully. You can now log in with your new password.", "success");
                    redirect('login');
                } else {
                    $data['errors'] = $user->getErrors();
                    $errorMessages = implode('<br>', $data['errors']);
                    set_flash_message("$errorMessages", "error");
                    redirect("reset_password?email=$email&token=$token");
                }
            } else {
                $data['errors'] = $user->getErrors();
                $errorMessages = implode('<br>', $data['errors']);
                set_flash_message("$errorMessages", "error");
                redirect("reset_password?email=$email&token=$token");
            }
        } else {
            set_flash_message("Invalid or expired token.", "error");
            redirect('');
        }
    }

    echo $this->renderView('reset_password', $data);
  }

  private function updatePassword($email, $newPassword)
  {
    $user = new User();
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); // Hash the new password
    $user->update(['email' => $email], ['password' => $hashedPassword]); // Update the hashed password in the database
  }

}