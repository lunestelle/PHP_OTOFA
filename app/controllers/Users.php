<?php

class Users
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

    $selectedFilter = $_GET['user_name'] ?? 'all';
    $selectedRoleFilter = $_GET['role'] ?? 'all';

    $userModel = new User();
    $data['users'] = [];
    $data['selectedFilter'] = $selectedFilter;
    $data['selectedRoleFilter'] = $selectedRoleFilter;

    // Initialize $usersData as an empty array
    $usersData = [];

    if ($selectedFilter === 'all' && $selectedRoleFilter === 'all') {
      $usersData = $userModel->whereNot(['user_id' => $_SESSION['USER']->user_id]);
    } else {
      $usersData = $userModel->getFilteredUsers($selectedFilter, $selectedRoleFilter);
    }

    // Check if $usersData is an array or object before proceeding
    if (!is_array($usersData) && !is_object($usersData)) {
      $usersData = [];
    }

    // Populate $userNames array for dropdown
    $userNames = [];
    $userNamesData = $userModel->whereNot(['user_id' => $_SESSION['USER']->user_id]);
    foreach ($userNamesData as $user) {
      $fullName = $user->first_name . ' ' . $user->last_name;
      $userNames[$fullName] = $user->first_name . ' ' . $user->last_name;
    }
    $data['userNames'] = $userNames;

    $roles = ['admin', 'operator', 'personnel'];
    $data['roles'] = $roles;

    if (!empty($usersData)) {
      foreach ($usersData as $user) {
        $permissions = isset($user->permissions) && $user->permissions !== '' ? explode(', ', $user->permissions) : null;
        
        $data['users'][] = [
          'user_id' => $user->user_id,
          'first_name' => $user->first_name,
          'last_name' => $user->last_name,
          'phone_number' => $user->phone_number,
          'email' => $user->email,
          'address' => $user->address,
          'role' => $user->role,
          'permissions' => $permissions
        ];
      }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exportCsv'])) {
      $csvData = [];
      $csvData[] = ['Users'];
      $csvData[] = ['First Name', 'Last Name', 'Phone Number', 'Email', 'Address', 'Role', 'Permissions'];

      foreach ($data['users'] as $user) {
        $csvData[] = [
          $user['first_name'],
          $user['last_name'],
          $user['phone_number'],
          $user['email'],
          $user['address'],
          $user['role'],
          $user['permissions'],
        ];
      }

      downloadCsv($csvData, 'Users_Export');
    }

    echo $this->renderView('users', true, $data);
  }
}
