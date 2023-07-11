<?php

class Account
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    $user = new User();
    $userData = $user->first(['user_id' => $_SESSION['USER']->user_id]);

    $data = [
      'email' => $userData->email,
      'first_name' => $userData->first_name,
      'last_name' => $userData->last_name,
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Update account logic goes here
      $post_email = $_POST['email'];
      $post_first_name = $_POST['first_name'];
      $post_last_name = $_POST['last_name'];

      // Update password only if the fields are not empty
      
      if (!empty($_POST['old-password']) && !empty($_POST['new-password'])) {
        $old_password = $_POST['old-password'];
        $new_password = $_POST['new-password'];

        // Validate old password
        if (password_verify($old_password, $userData->password)) {
          // Validate new password
          if ($user->accountValidatePassword($new_password)) {
            // Hash and update the new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $user->update(['email' => $post_email], ['password' => $hashed_password], 'user_id');

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
          echo json_encode(['status' => 'error', 'msg' => 'Incorrect old password. Please try again.']);
          exit;
        }
      } elseif (empty($_POST['old-password']) && !empty($_POST['new-password'])) {
        echo json_encode(['status' => 'error', 'msg' => 'Please provide the old password.']);
        exit;
      } elseif (!empty($_POST['old-password']) && empty($_POST['new-password'])) {
        echo json_encode(['status' => 'error', 'msg' => 'Please provide a new password.']);
        exit;
      }
      

      $user->update(['email' => $post_email], ['first_name' => $post_first_name], ['last_name' => $post_last_name], 'user_id');

      // Update the sharedData with the updated user information
      $_SESSION['USER']->email = $post_email;
      $_SESSION['USER']->first_name = $post_first_name;
      $_SESSION['USER']->last_name = $post_last_name;

      $response = ['status' => 'success', 'msg' => 'Account successfully updated.', 'redirect_url' => ROOT];
      echo json_encode($response);
      exit;
    }

    echo $this->renderView('account', false, $data);
  }
}
