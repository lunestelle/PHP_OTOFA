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

    $selectedFilter = isset($_GET['user_name']) ? $_GET['user_name'] : 'all';
    $userModel = new User();

    $data['users'] = [];
    $data['selectedFilter'] = $selectedFilter;

    if ($selectedFilter === 'all') {
      $usersData = $userModel->whereNot(['user_id' => $_SESSION['USER']->user_id]);
    } else {
      $usersData = $userModel->where(['first_name' => $selectedFilter]);
    }

    if (!empty($usersData)) {
      foreach ($usersData as $user) {
        $data['users'][] = [
          'first_name' => $user->first_name,
          'last_name' => $user->last_name,
          'phone_number' => $user->phone_number,
          'email' => $user->email,
          'address' => $user->address,
          'role' => $user->role,
          'permissions' => $user->permissions,
        ];
      }
    }

    echo $this->renderView('users', true, $data);
  }
}