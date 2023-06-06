<?php

class Sign_in
{
  use Controller;

  public function index()
  {
    $data = [
      'rememberEmail' => '',
    ];

    if (is_authenticated()) {
      redirect('');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user = new User();
      $email = $_POST['email'];
      $password = $_POST['password'];
      $row = $user->first(['email' => $email]);

      if ($row && password_verify($password, $row->password)) {
        $_SESSION['USER'] = $row;
        $_SESSION['authenticated'] = true;
        $_SESSION['user_first_name'] = $row->first_name;

        if (isset($_POST['rememberMe']) && $_POST['rememberMe'] === 'on') {
          setcookie('remember_email', $row->email, time() + (86400 * 30), '/');
        } elseif (isset($_COOKIE['remember_email'])) {
          setcookie('remember_email', '', time() - 3600, '/');
        }

        set_flash_message("Successfully signed in!", "success");
        redirect('');
      } else {
        set_flash_message('Invalid credentials. Please try again.', 'error');
        redirect('sign_in');
      }

      $data['rememberEmail'] = $email;
    } elseif (isset($_COOKIE['remember_email'])) {
      $data['rememberEmail'] = $_COOKIE['remember_email'];
    }

    echo $this->renderView('sign_in', $data);
  }
}