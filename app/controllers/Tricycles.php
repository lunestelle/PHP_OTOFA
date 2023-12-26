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
        $whereConditions['status'] = 'Active';
      }
      $tricyclesData = $tricycleModel->where($whereConditions);
    }

    $userModel = new User();
    $usersData = $userModel->where(['role' => 'operator']);

    $tricycleApplicationModel = new TricycleApplication();
    $tricycleCinModel = new TricycleCinNumber();

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

        // Retrieve Tricycle Application data
        $tricycleApplicationData = $tricycleApplicationModel->first(['tricycle_application_id' => $tricycle->tricycle_application_id]);

        // Retrieve CIN data using the relationship method (replace 'yourRelationshipMethod' with the actual method name)
        $tricycleCinData =  $tricycleCinModel->first(['tricycle_cin_number_id' => $tricycleApplicationData->tricycle_cin_number_id]);

        $data['tricycles'][] = [
          'tricycle_id' => $tricycle->tricycle_id,
          'status' => $tricycle->status,
          'cin' => $tricycleCinData ? $tricycleCinData->cin_number : 'N/A',
          'tricycle_application_data' => $tricycleApplicationData,
        ];
      }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_tricycle_status'])) {
      $updatedStatus = $_POST['status'];
      $tricycleIdToUpdate = $_POST['tricycle_id'];
  
      if ($tricycleModel->update(['tricycle_id' => $tricycleIdToUpdate], ['status' => $updatedStatus])) {
        $updatedData = $tricycleModel->first(['tricycle_id' => $tricycleIdToUpdate]);
        
        if ($updatedStatus === 'Dropped') {
          $tricycleApplicationUpdate = $tricycleApplicationModel->first(['tricycle_application_id' => $updatedData->tricycle_application_id]);

          $tricycleCinData =  $tricycleCinModel->first(['tricycle_cin_number_id' => $tricycleApplicationUpdate->tricycle_cin_number_id]);
          
          $tricycleCinModel->update(['tricycle_cin_number_id' =>  $tricycleCinData->cin_number], ['is_used' => 0, 'user_id' => null]);
        }

        set_flash_message("Successfully updated tricycle status.", "success");
        redirect('tricycles');
      }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exportCsv'])) {
      $csvData = [];
      $csvData[] = ['Tricycles'];
      $csvData[] = ['Tricycle CIN', "Operator's Name", 'Make / Model', 'Motor Number', 'Color Code', 'Route Area', 'Status'];

      foreach ($data['tricycles'] as $tricycle) {
        $csvData[] = [
          $tricycle['cin'],
          $tricycle['tricycle_application_data']->operator_name,
          $tricycle['tricycle_application_data']->make_model,
          $tricycle['tricycle_application_data']->motor_number,
          $tricycle['tricycle_application_data']->color_code,
          $tricycle['tricycle_application_data']->route_area,
          $tricycle['status'],
        ];
      }

      downloadCsv($csvData, 'Tricycles_Export');
    }


    echo $this->renderView('tricycles', true, $data);
  }
}