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
        echo json_encode(['status' => 'error', 'msg' => 'Invalid credentials. Please try again.']);
        exit;
      }
    }

    echo $this->renderView('sign_in', false);
  }
}