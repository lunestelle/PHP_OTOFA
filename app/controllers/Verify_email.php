<?php

class Verify_email
{
  use Controller;

  public function index()
  {
    $verificationToken = $_GET['token'];
    $user = new User();
    $userData = $user->first(['verification_token' => $verificationToken]);

    if (empty($verificationToken) || (!$userData)) {
      set_flash_message("Invalid verification token.", "error");
      redirect('');
    }

    // Check if the token is expired
    $currentTimestamp = date('Y-m-d H:i:s');
    if ($userData->token_expiration && strtotime($userData->token_expiration) < strtotime($currentTimestamp)) {
      // Token is expired, generate a new one and update timestamp
      $newVerificationToken = bin2hex(random_bytes(8));
      $newTokenExpiration = date('Y-m-d H:i:s', strtotime('+24 hours'));

      $user->update(['verification_token' => $verificationToken], [
        'verification_token' => $newVerificationToken,
        'token_expiration' => $newTokenExpiration
      ], 'verification_token');

      $_SESSION['verification_token'] = $newVerificationToken;
      $_SESSION['first_name'] = ucwords($_POST['first_name']);
      $_SESSION['verification_link'] = ROOT . '/verify_email?token=' . urlencode($_SESSION['verification_token']);

      // Send a new verification email
      $emailContent = $this->renderView('mailer/account_email_verification', false, $data);
      $subject = "Verify Your Email Address for OTOFA";
      $emailResult = sendEmail($userData->email, $subject, $emailContent);

      if ($emailResult === 'success') {
        set_flash_message("New verification email sent. Please check your email to verify your account.", "success");
        redirect('');
      } else {
        set_flash_message("Failed to send a new verification email. Please try again later.", "error");
        redirect('');
      }
    } else if ($user->isVerificationTokenUsed($verificationToken)) {
      // this checked if the user is already verified
      set_flash_message("Verification token has already been used.", "error");
      redirect('');
    } else {
      // Update the user account as verified
      $updateData = ['verification_status' => 'verified'];
      $conditions = ['verification_token' => $verificationToken];

      if ($user->update($conditions, $updateData)) {
        set_flash_message("Email successfully verified. You can now log in.", "success");
        redirect('');
      } else {
        set_flash_message("Failed to update verification status.", "error");
        redirect('');
      }
    }
  }
}