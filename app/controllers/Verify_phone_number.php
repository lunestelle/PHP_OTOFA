<?php

class Verify_phone_number
{
  use Controller;

  public function index()
  {
    $user = new User();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['phone_no_verification_code_btn'])) {
        $verificationCode = $_POST['verification_code'];

        $isVerificationCodeCorrect = $this->validateVerificationCode($verificationCode);

        if ($isVerificationCodeCorrect) {
          $user->update(['user_id' => $_SESSION['USER']->user_id], ['phone_number_status' => 'Verified']);

          set_flash_message("Phone number verified successfully.", "success");
        } else {
          set_flash_message("Incorrect verification code. Please try again.", "error");
        }

        redirect('manage_account');
      } else {
        $phoneNumber = $_POST['phoneNumber'];

        $verificationCode = $this->generateVerificationCode();
        $smsResult = sendSms($phoneNumber, "Your verification code for OTOFA is: $verificationCode");

        if ($smsResult) {
          $user->update(['user_id' => $_SESSION['USER']->user_id], ['phone_verification_code' => $verificationCode]);

          echo json_encode(['status' => 'success', 'message' => 'Verification code sent successfully!']);
        } else {
          echo json_encode(['status' => 'error', 'message' => 'Failed to send verification code. Please try again.']);
        }

        exit();
      }
    }
  }

  private function generateVerificationCode($length = 6)
  {
    $characters = '0123456789';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
      $code .= $characters[random_int(0, strlen($characters) - 1)];
    }

    return $code;
  }

  private function validateVerificationCode($enteredCode)
  {
    $user = new User();
    $userData = $user->first(['user_id' => $_SESSION['USER']->user_id]);
    $savedCode = $userData->phone_verification_code;
    return $enteredCode === $savedCode;
  }
}