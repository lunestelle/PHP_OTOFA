<?php 

class Manage_account
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
      'address' => $userData->address,
      'phone_number' => $userData->phone_number,
      'profile_photo' => $userData->uploaded_profile_photo_path ?: $userData->generated_profile_photo_path,
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $postData = [
        'email' => $_POST['email'],
        'address' => $_POST['address'],
        'phone_number' => $_POST['phone_number'],
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'new_profile' => $_POST['selected-profile-photo'],
        'current_password' => $_POST['current_password'],
        'new_password' => $_POST['new_password'],
        'password_confirmation' => $_POST['password_confirmation'],
      ];

      if (isset($_POST['profile_info_save_btn'])) {
        if ($user->validate_profile_info($postData)) {
          $this->profile_info($user, $postData);
        } else {
          $data['errors'][0] = $user->getErrors();
          $errorMessages = implode('', $data['errors'][0]);
          set_flash_message($errorMessages, "error");
          redirect("manage_account");
        } 
      }

      if (isset($_POST['remove_profile'])){
        $updateUser = $user->update(['user_id' => $_SESSION['USER']->user_id], ['uploaded_profile_photo_path' => null]);
    
        if ($updateUser) {
          set_flash_message("Profile photo removed successfully.", "success");
          $_SESSION['USER'] = $user->first(['user_id' =>  $_SESSION['USER']->user_id]);
          redirect('manage_account');
        } else {
          set_flash_message("Failed to remove profile photo. Please try again.", "error");
          redirect('manage_account');
        }
      }

      if (isset($_POST['update_password_save_btn'])) {
        $this->update_password($user, $postData);
      }
    }

    echo $this->renderView('manage_account', true, $data);
  }

  protected function profile_info($user, $postData)
  { 
    $updateData = [
      'email' => $postData['email'],
      'phone_number' => $postData['phone_number'],
      'address' => ucwords($postData['address']),
      'first_name' => ucwords($postData['first_name']),
      'last_name' => ucwords($postData['last_name'])
    ];

    if (!empty($postData['new_profile'])) {
      list($imageType, $imageData) = explode(';', $postData['new_profile']);
      list(, $imageData) = explode(',', $imageData);
      $imageExtension = strtolower(substr($imageType, strrpos($imageType, '/') + 1));
      $uniqueFileName = md5(uniqid(rand(), true)) . '_' . time() . '.' . $imageExtension;
      $uploadedFilePath = '../profile_photos/uploaded_profile/' . $uniqueFileName;
      $decodedImageData = base64_decode($imageData);
      
      if (file_put_contents($uploadedFilePath, $decodedImageData)) {
        $updateData['uploaded_profile_photo_path'] = $uploadedFilePath;

        $row = $user->first(['user_id' => $_SESSION['USER']->user_id]);

        if ($row->first_name != $updateData['first_name'] || $row->last_name != $updateData['last_name']){
          $profilePhotoPath = generateProfilePicture(strtoupper($updateData['first_name'][0] . $updateData['last_name'][0]));
          $updateData['generated_profile_photo_path'] = $profilePhotoPath;
          $updateUser = $user->update(['user_id' => $_SESSION['USER']->user_id], $updateData);
          $_SESSION['USER']->generated_profile_photo_path = $profilePhotoPath;
        } else {
          $updateUser = $user->update(['user_id' => $_SESSION['USER']->user_id], $updateData);
        }
        
        if ($updateUser) {
          $_SESSION['USER']->email = $updateData['email'];
          $_SESSION['USER']->first_name = $updateData['first_name'];
          $_SESSION['USER']->last_name = $updateData['last_name'];
          $_SESSION['USER']->uploaded_profile_photo_path = $uploadedFilePath;

          set_flash_message("Profile information has been updated successfully.", "success");
          redirect("manage_account");
        } else {
          set_flash_message("Error updating profile information. Please try again.", "error");
          redirect("manage_account");
        }
      } else {
        set_flash_message("Error uploading profile photo. Please try again.", "error");
        redirect("manage_account");
      }
    } else {
      if ($row->first_name != $updateData['first_name'] || $row->last_name != $updateData['last_name']){
        $profilePhotoPath = generateProfilePicture(strtoupper($updateData['first_name'][0] . $updateData['last_name'][0]));
        $updateData['generated_profile_photo_path'] = $profilePhotoPath;
        $updateUser = $user->update(['user_id' => $_SESSION['USER']->user_id], $updateData);
        $_SESSION['USER']->generated_profile_photo_path = $profilePhotoPath;
      } else {
        $updateUser = $user->update(['user_id' => $_SESSION['USER']->user_id], $updateData);
      }
        
      if ($updateUser) {
        $_SESSION['USER']->email = $updateData['email'];
        $_SESSION['USER']->first_name = $updateData['first_name'];
        $_SESSION['USER']->last_name = $updateData['last_name'];

        set_flash_message("Profile information has been updated successfully.", "success");
        redirect("manage_account");
      } else {
        set_flash_message("Error updating profile information. Please try again.", "error");
        redirect("manage_account");
      }
    }
  }

  protected function update_password($user, $postData)
  {
    $row = $user->first(['user_id' => $_SESSION['USER']->user_id]);
   
    if ($user->validatePassword($postData['new_password'], $postData['password_confirmation'])) {
      if (!empty($postData['current_password'])){
        if ($row && password_verify($postData['current_password'], $row->password)) {
          $hashedNewPassword = password_hash($postData['new_password'], PASSWORD_DEFAULT);
  
          if ($user->update(['user_id' => $_SESSION['USER']->user_id], ['password' => $hashedNewPassword])) {
            set_flash_message("Password updated successfully.", "success");
            redirect('manage_account');
          } else {
            set_flash_message("Failed to update password. Please try again.", "error");
            redirect('manage_account');
          }
  
        } else {
          set_flash_message("The current password you provided is incorrect. Please<br>double-check the current password and try again", "error");
          redirect('manage_account');
        }
      } else {
        set_flash_message("Current Password is required.", "error");
        redirect('manage_account');
      }
    } else {
      $data['errors'][0] = $user->getErrors();
      $errorMessages = implode('', $data['errors'][0]);
      set_flash_message($errorMessages, "error");
      redirect("manage_account");
    } 
  }
}