<?php

class Tricycles
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
      redirect('');
    }

    $statusFilter = isset($_GET['status']) ? $_GET['status'] : '';

    $tricycleModel = new Tricycle();

    if ($_SESSION['USER']->role === 'admin') {
      // Fetch all tricycles data for Admin
      $tricyclesData = $statusFilter !== 'active' ? $tricycleModel->findAll() : $tricycleModel->where(['tricycle_status' => 'Active']);
    } else {
      // Fetch tricycles data based on the user ID for non-Admin users
      $whereConditions = ['user_id' => $_SESSION['USER']->user_id];
      if ($statusFilter === 'active') {
        $whereConditions['tricycle_status'] = 'Active';
      }
      $tricyclesData = $tricycleModel->where($whereConditions);
    }

    $userModel = new User();
    $usersData = $userModel->where(['role' => 'operator']);

    $data['tricycles'] = [];
    $data['index'] = 1;

    if (!empty($tricyclesData)) {
      foreach ($tricyclesData as $tricycle) {
        $userName = '';
        foreach ($usersData as $user) {
          if ($user->user_id === $tricycle->user_id) {
            $userName = $user->first_name . ' ' . $user->last_name;
            break;
          }
        }

        $data['tricycles'][] = [
          'tricycle_id' => $tricycle->tricycle_id,
          'plate_no' => $tricycle->plate_no,
          'operator_name' => $userName,
          'make_model' => $tricycle->make_model,
          'year_acquired' => $tricycle->year_acquired,
          'color_code' => $tricycle->color_code,
          'route_area' => $tricycle->route_area,
          'or_no' => $tricycle->or_no,
          'or_date' => $tricycle->or_date,
          'tricycle_status' => $tricycle->tricycle_status
        ];
      }
    }

    echo $this->renderView('tricycles', true, $data);
  }
}