<?php

class Sign_in
{
  use Controller;

  public function index()
  {
    $data = [];

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

        if (isset($_POST['rememberMe'])) {
          setcookie('email', $email, time() + (86400 * 30), '/'); // cookie is set to expire in 30 days
          setcookie('password', $password, time() + (86400 * 30), '/'); 
        } else {
          if (isset($_COOKIE['email'])){
            setcookie('email', '', time() - 3600, '/');
          }
          if (isset($_COOKIE['password'])){
            setcookie('password', '', time() - 3600, '/');
          }
        }

        set_flash_message("Successfully signed in!", "success");
        redirect('');
      } else {
        set_flash_message('Invalid credentials. Please try again.', 'error');
        redirect('sign_in');
      }
    }

    echo $this->renderView('sign_in', $data);
  }
}