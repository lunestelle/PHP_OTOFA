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

    $statusFilter = $_GET['status'] ?? '';

    $tricycleModel = new Tricycle();
    $userModel = new User();
    $usersData = $userModel->where(['role' => 'operator']);

    $tricycleApplicationModel = new TricycleApplication();
    $tricycleCinModel = new TricycleCinNumber();
    $tricycleStatusesModel = new TricycleStatuses();

    $data['tricycles'] = [];
    $data['index'] = 1;

    if ($_SESSION['USER']->role === 'admin') {
      // Fetch all tricycles data for Admin
      $tricyclesData = $tricycleModel->getTricyclesForAdmin($statusFilter);
    } else {
      // Fetch tricycles data based on the user ID for non-Admin users
      $tricyclesData = $tricycleModel->getTricyclesForUser($_SESSION['USER']->user_id, $statusFilter);
    }
  

    if (!empty($tricyclesData)) {
      foreach ($tricyclesData as $tricycle) {
        $userName = '';
        foreach ($usersData as $user) {
          if ($user->user_id === $tricycle->user_id) {
            $userName = $user->first_name . ' ' . $user->last_name;
            break;
          }
        }

        $tricycleApplicationData = $tricycleApplicationModel->first(['tricycle_application_id' => $tricycle->tricycle_application_id]);
        $tricycleCinData =  $tricycleCinModel->first(['tricycle_cin_number_id' => $tricycleApplicationData->tricycle_cin_number_id]);
        $tricycleStatusesData = $tricycleStatusesModel->where(['tricycle_id' => $tricycle->tricycle_id]);

        $statuses = [];

        foreach ($tricycleStatusesData as $tricycleStatusData) {
          $status = $tricycleStatusData->status;
          $badgeColor = '';
      
          switch ($status) {
            case 'Active':
              $badgeColor = 'bg-success';
              break;
            case 'Dropped':
              $badgeColor = 'bg-danger';
              break;
            case 'Renewal Required':
              $badgeColor = 'bg-warning';
              break;
            case 'Expired Renewal':
              $badgeColor = 'bg-warning';
              break;
            case 'Change Motor Required':
              $badgeColor = 'bg-info';
              break;
            default:
              $badgeColor = 'bg-danger';
              break;
          }
      
          $statuses[] = [
            'status' => $status,
            'badgeColor' => $badgeColor,
          ];
        }
        
        $data['tricycles'][] = [
          'tricycle_id' => $tricycle->tricycle_id,
          'statuses' => $statuses,
          'cin' => $tricycleCinData ? $tricycleCinData->cin_number : 'N/A',
          'operator_name' => $userName,
          'tricycle_application_data' => $tricycleApplicationData,
        ];
      }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_tricycle_status'])) {
      $insertedStatus = $_POST['status']; 
      $tricycleIdToUpdate = $_POST['tricycle_id'];
  
      // Fetch the tricycle data, including the owner's user_id
      $tricycleData = $tricycleModel->first(['tricycle_id' => $tricycleIdToUpdate]);
      $tricycleOwnerId = $tricycleData->user_id;

      if ($insertedStatus === 'Dropped') {
        // If the selected status is "Dropped", delete other statuses for the tricycle and only status "Dropped" remains
        if ($tricycleStatusesModel->deleteStatusesExceptDropped($tricycleIdToUpdate)) {
          if ($tricycleStatusesModel->insert(['tricycle_id' => $tricycleIdToUpdate, 'user_id' => $tricycleOwnerId, 'status' => $insertedStatus])) {
            $tricycleApplicationUpdate = $tricycleApplicationModel->first(['tricycle_application_id' => $tricycleData->tricycle_application_id]);
            $tricycleCinData = $tricycleCinModel->first(['tricycle_cin_number_id' => $tricycleApplicationUpdate->tricycle_cin_number_id]);
            $tricycleCINNumber = $tricycleCinData ? $tricycleCinData->cin_number : 'N/A';

            $userDetails = $userModel->first(['user_id' => $tricycleOwnerId]);
            $phoneNumber = $userDetails->phone_number;
            $userName = $userDetails->first_name . ' ' . $userDetails->last_name;
            $email = $userDetails->email;

            $subject = "Tricycle CIN #{$tricycleCINNumber} Ownership Dropped";
            $customTextMessage = "Hello {$userName},\n\nWe would like to inform you that the ownership of Tricycle CIN #{$tricycleCINNumber} associated with your account has been dropped\n\nThank you for choosing our services.";
            $customEmailMessage = "<div style='text-align: justify; margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>We would like to inform you that the ownership of Tricycle CIN #{$tricycleCINNumber} associated with your account has been dropped. Thank you for choosing our services.</div>";

            systemNotifications($phoneNumber, $userName, $email, $subject, $customTextMessage, $customEmailMessage);
          
            if ($tricycleCinData) {
              $tricycleCinModel->update(
                ['cin_number' => $tricycleCinData->cin_number],
                ['is_used' => 0, 'user_id' => null]
              );
            }

            set_flash_message("Successfully updated tricycle status.", "success");
            redirect('tricycles');
          } else {
            set_flash_message("failed insert.", "error");
            redirect('tricycles');
          }
        } else {
          set_flash_message("Failed Delete.", "error");
          redirect('tricycles');
        }
      } elseif ($insertedStatus != "Dropped") {
        if ($tricycleStatusesModel->insert(['tricycle_id' => $tricycleIdToUpdate, 'user_id' => $tricycleOwnerId, 'status' => $insertedStatus])) {
          set_flash_message("Successfully updated tricycle status.", "success");
          redirect('tricycles');
        } else {
          set_flash_message("Failed to update tricycle statasdasus.", "error");
          redirect('tricycles');
        }
      }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exportCsv'])) {
      $csvData = [];
      $csvData[] = ['Tricycles'];
      $csvData[] = ['Tricycle CIN', "Operator's Name", 'Make / Model', 'Motor Number', 'Color Code', 'Route Area', 'Status'];

      foreach ($data['tricycles'] as $tricycle) {
        $csvStatuses = [];
        foreach ($tricycle['statuses'] as $status) {
          $csvStatuses[] = $status['status'];
        }

        $statusForCsv = (count($csvStatuses) > 1) ? implode(', ', $csvStatuses) : $csvStatuses[0];

        $csvData[] = [
          $tricycle['cin'],
          $tricycle['operator_name'],
          $tricycle['tricycle_application_data']->make_model,
          $tricycle['tricycle_application_data']->motor_number,
          $tricycle['tricycle_application_data']->color_code,
          $tricycle['tricycle_application_data']->route_area,
          $statusForCsv,
        ];
      }

      downloadCsv($csvData, 'Tricycles_Export');
    }

    echo $this->renderView('tricycles', true, $data);
  }
}