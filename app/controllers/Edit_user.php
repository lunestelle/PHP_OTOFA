<?php

class Edit_user
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }
  
    // Define the required permissions for accessing the edit user page
    $requiredPermissions = [
      "Can create and edit users"
    ];

    // Check if the logged-in user has any of the required permissions
    $userPermissions = isset($_SESSION['USER']->permissions) ? explode(', ', $_SESSION['USER']->permissions) : [];
    if (!hasAnyPermission($requiredPermissions, $userPermissions)) {
      set_flash_message("Access denied. You don't have the required permissions.", "error");
      redirect('');
    }

    $userId = isset($_GET['user_id']) ? $_GET['user_id'] : null;
  
    $userModel = new User();
    $userData = $userModel->first(['user_id' => $userId]);

    if (!$userData) {
      set_flash_message("User not found.", "error");
      redirect('users');
    }

    $data = [];
  
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $errors = $userModel->adminUserValidate($_POST);
      if (empty($errors)) {
        $permissions = isset($_POST['permissions']) ? $_POST['permissions'] : [];

        // If the role is admin, update permissions to grant all permissions
        if ($_POST['role'] === 'admin') {
          $permissions = $this->getAllPermissions();
        }

        // Convert permissions array to comma-separated string
        $permissionsString = implode(', ', $permissions);

        $updatedData = [
          'user_id' => $_POST['user_id'],
          'first_name' => ucwords($_POST['first_name']),
          'last_name' => ucwords($_POST['last_name']),
          'email' => $_POST['email'],
          'address' => ucwords($_POST['address']),
          'phone_number' => $_POST['phone_number'],
          'role' => $_POST['role'],
          'permissions' => $permissionsString,
          'verification_status' => $_POST['verification_status'],
          'phone_number_status' => $_POST['phone_number_status']
        ];

        $formattedPhoneNumber = $updatedData['phone_number'];
        $updatedData['phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);

        // Check if password and password confirmation are provided
        if (!empty($_POST['password']) && !empty($_POST['password_confirmation'])) {
          $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

          // Add password and password confirmation to updated data
          $updatedData['password'] = $hashedPassword;
          $updatedData['password_confirmation'] = $_POST['password_confirmation'];
        }
  
        // Update the user data
        if ($userModel->update(['user_id' => $userId], $updatedData)) {
          set_flash_message("User updated successfully.", "success");
          redirect('users');
        }
      } else {
        $errorMessage = $errors[0];
        set_flash_message($errorMessage, "error");
        $data = array_merge($data, $_POST);
        redirect('edit_user?user_id=' . $userId);
      }
    }
  
    // Retrieve permissions from user data
    $permissions = isset($userData->permissions) ? explode(', ', $userData->permissions) : [];
  
    $data = array_merge($data, [
      'userData' => [
        'user_id' => $userData->user_id,
        'first_name' => $userData->first_name,
        'last_name' => $userData->last_name,
        'email' => $userData->email,
        'address' => $userData->address,
        'phone_number' => $this->formatPhoneNumber($userData->phone_number),
        'role' => $userData->role,
        'permissions' => $permissions
      ]
    ]);
  
    echo $this->renderView('edit_user', true, $data);
  }

  private function formatPhoneNumber($phoneNumber) {
    return preg_replace('/[^0-9]/', '', str_replace('+63', '', $phoneNumber));
  }

  private function getAllPermissions() {
    $permissions = [
      "Can approve appointments",
      "Can reject appointments",
      "Can on process appointments",
      "Can completed appointments",
      "Can view appointments reports",
      "Can view tricycles reports",
      "Can view cin reports",
      "Can view taripas",
      "Can generate taripa",
      "Can view and update tricycle statuses",
      "Can view list of tricycles",
      "Can update tricycle status",
      "Can create and edit users",
      "Can view list of operators",
      "Can view maintenance tracker"
    ];

    return $permissions;
  }
}
