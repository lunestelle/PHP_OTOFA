<?php

class New_user
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }
  
    // Check if the user has the "admin" role
    $userRole = $_SESSION['USER']->role;
    if ($userRole !== 'admin') {
      set_flash_message("Access denied. You don't have the required role.", "error");
      redirect('');
    }
  
    $userModel = new User();
    $data = [];
  
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $errors = $userModel->adminUserValidate($_POST);
      if (empty($errors)) {
        // Proceed with data insertion if there are no errors
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $profilePhotoPath = generateProfilePicture(strtoupper($_POST['first_name'][0] . $_POST['last_name'][0]));

        $permissions = isset($_POST['permissions']) ? $_POST['permissions'] : [];
        
        // Convert permissions array to comma-separated string
        $permissionsString = implode(', ', $permissions);

        $userData = [
          'first_name' => ucwords($_POST['first_name']),
          'last_name' => ucwords($_POST['last_name']),
          'email' => $_POST['email'],
          'address' => ucwords($_POST['address']),
          'phone_number' => $_POST['phone_number'],
          'password' => $_POST['password'],
          'password_confirmation' => $_POST['password_confirmation'],
          'role' => $_POST['role'],
          'permissions' => $permissionsString,
          'verification_status' => $_POST['verification_status'],
          'phone_number_status' => $_POST['phone_number_status'],
          'generated_profile_photo_path' => $profilePhotoPath
        ];

        $formattedPhoneNumber = $userData['phone_number'];
				$userData['phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);
        $userData['password'] = $hashedPassword;

        if ($userModel->insert($userData)) {
          set_flash_message("User created successfully.", "success");
          redirect('users');
        }
      } else {
        $errorMessage = $errors[0];
        set_flash_message($errorMessage, "error");
        $data = array_merge($data, $_POST);
      }
    }

    echo $this->renderView('new_user', true, $data);
  }
}