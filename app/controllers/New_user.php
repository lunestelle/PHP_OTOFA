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

    echo $this->renderView('new_user', true);
  }
}
