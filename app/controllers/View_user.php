<?php

class View_user
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
      set_flash_message("user not found.", "error");
      redirect('users');
    }

    $permissions = isset($userData->permissions) && $userData->permissions !== '' ? explode(', ', $userData->permissions) : null;

    $data = [
      'user_id' => $userData->user_id,
      'first_name' => $userData->first_name,
      'last_name' => $userData->last_name,
      'full_name' => $userData->first_name . ' ' . $userData->last_name,      
      'email' => $userData->email,
      'address' => $userData->address,
      'phone_number' => $userData->phone_number,
      'role' => $userData->role,
      'permissions' => $permissions
    ];
    

    echo $this->renderView('view_user', true, $data);
  }
}