<?php

class Sign_up
{
  use Controller;

  public function index()
  {
    $data = [];

    if (is_authenticated()) {
      set_flash_message("You are already signed in.", "error");
      redirect('');
    }

    // Check if the request is an AJAX call by checking the 'HTTP_X_REQUESTED_WITH'
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
      set_flash_message("Invalid request method.", "error");
      redirect('');
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $user = new User();

      if ($user->validate($_POST)) {
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $profilePhotoPath = generateProfilePicture(strtoupper($_POST['first_name'][0] . $_POST['last_name'][0]));
        $formattedPhoneNumber = $user->formatPhoneNumber($_POST['phone_number']);

        // Set token expiration time (e.g., 24 hours from now)
        $tokenExpiration = date('Y-m-d H:i:s', strtotime('+24 hours'));

        
        $userData = [
          'email' => $_POST['email'],
          'phone_number' => $formattedPhoneNumber,
          'address' => ucwords($_POST['address']),
          'first_name' => ucwords($_POST['first_name']),
          'last_name' => ucwords($_POST['last_name']),
          'password' => $hashedPassword,
          'generated_profile_photo_path' => $profilePhotoPath,
          'verification_token' => $_POST['verification_token'],
          'token_expiration' => $tokenExpiration,
        ];

        if ($user->insert($userData)) {
          $_SESSION['verification_token'] = $_POST['verification_token'];
          $_SESSION['first_name'] = ucwords($_POST['first_name']);
          $_SESSION['verification_link'] = ROOT . '/verify_email?token=' . urlencode($_SESSION['verification_token']);

          $emailContent = $this->renderView('mailer/account_email_verification', false, $data);
          $subject = "Verify Your Email Address for OTOFA";
  
          $emailResult = sendEmail($_POST['email'], $subject, $emailContent);
  
          if ($emailResult === 'success') {
            $response = ['status' => 'success', 'msg' => 'Account created successfully! Check your email for verification.', 'redirect_url' => ''];
          } else {
            $response = ['status' => 'error', 'msg' => 'Failed to send verification email. Please try again later.'];
          }
  
          echo json_encode($response);
          exit;
        }
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
    }

    echo $this->renderView('sign_up', false, $data);
  }
}