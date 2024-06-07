<?php

class New_appointment
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
    if ($userRole !== 'operator') {
      set_flash_message("Access denied. You don't have the required role to access this page.", "error");
      redirect('');
    }

    $cinModel = new TricycleCinNumber();
    $data['userHasCin'] = $cinModel->getCinNumberIdByUserId($_SESSION['USER']->user_id) !== null;

    $data["totalAvailableCins"] = count($cinModel->getAvailableCinNumbers());

    // Check if all CIN numbers are used
    $allCinNumbersUsed = empty($cinModel->getAvailableCinNumbers());
    $data['allCinNumbersUsed'] = $allCinNumbersUsed;

    // Count the number of tricycles owned by the user with is_used = 1
    $tricycleCountQuery = "SELECT COUNT(*) as count FROM tricycle_cin_numbers WHERE user_id = :user_id AND is_used = 1";
    $tricycleCountResult = $cinModel->query($tricycleCountQuery, ['user_id' => $_SESSION['USER']->user_id]);
    $data['tricycleCount'] = $tricycleCountResult[0]->count;

    $tricycleStatusModel = new TricycleStatuses();
    $userTricycleStatuses = $tricycleStatusModel->where(["user_id" => $_SESSION['USER']->user_id]);
    $statuses = [];

    $userHasRenewalStatus = false;
    $userHasChangeMotorStatus = false;

    $renewalStatuses = ['Renewal Required', 'Expired Renewal (1st Notice)', 'Expired Renewal (2nd Notice)', 'Expired Renewal (3rd Notice)'];
    $changeMotorStatuses = ['Change Motor Required', 'Expired Motor (1st Notice)', 'Expired Motor (2nd Notice)', 'Expired Motor (3rd Notice)'];

    // Check if $userTricycleStatuses is an array before using count
    if (!empty($userTricycleStatuses)) {
      foreach ($userTricycleStatuses as $status) {
        $statuses[$status->status][] = $status;
        if (in_array($status->status, $renewalStatuses)) {
          $userHasRenewalStatus = true;
        } elseif (in_array($status->status, $changeMotorStatuses)) {
          $userHasChangeMotorStatus = true;
        }
      }
    } else {
      $statuses = [];
      $userHasRenewalStatus = false;
      $userHasChangeMotorStatus = false;
    }

    $data['userHasRenewalStatus'] = $userHasRenewalStatus;
    $data['userHasChangeMotorStatus'] = $userHasChangeMotorStatus;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['appointmentType'])) {
        $appointmentType = $_POST['appointmentType'];
        $numberOfTricycles = $_POST['numberOfTricycles'];
        $tricycleCin = isset($_POST['tricycleCin']) ? $_POST['tricycleCin'] : '';

        // Check if tricycleCin is an array or a single value
        if (is_array($tricycleCin)) {
          // Convert array to comma-separated string if it's not empty
          $tricycleCinString = !empty($tricycleCin) ? implode(',', $tricycleCin) : '';
        } else {
          // Use the single value directly
          $tricycleCinString = $tricycleCin;
        }

        switch ($appointmentType) {
          case 'New Franchise':
            redirect('appointment_details?appointmentType=' . urlencode($appointmentType) . '&numberOfTricycles=' . $numberOfTricycles);
            break;

          case 'Renewal of Franchise':
          case 'Change of Motorcycle':
          case 'Transfer of Ownership':
            if ($this->checkTricycleCin($tricycleCin)) {
              if ($appointmentType === 'Transfer of Ownership') {
                $transferType = isset($_POST['transferType']) ? $_POST['transferType'] : '';
                if ($transferType === '') {
                  set_flash_message("Please select a transfer type.", "error");
                  redirect('new_appointment'); // Redirect back to the appointment page
                } elseif ($transferType == 'Transfer of Ownership from Deceased Owner' || $transferType == 'Intent of Transfer') {
                  $this->redirectToPage('appointment_details', $appointmentType, $transferType, $tricycleCinString, $numberOfTricycles);
                } else {
                  // If transfer type is None, redirect to transfer_of_ownership
                  redirect('appointment_details?appointmentType=' . urlencode($appointmentType) . '&tricycleCin=' . urlencode($tricycleCinString) . '&numberOfTricycles=' . $numberOfTricycles);
                               
                }
              } else {
                redirect('appointment_details?appointmentType=' . urlencode(strtolower(str_replace(' ', '_', $appointmentType))) . '&tricycleCin=' . urlencode($tricycleCinString) . '&numberOfTricycles=' . $numberOfTricycles);
              }
            }
            break;

          default:
            set_flash_message("Invalid appointment type selected.", "error");
            break;
        }
      } else {
        set_flash_message("Appointment type is not set in the form. Please select <br> an appointment type before submitting the form.", "error");
      }
    }

    echo $this->renderView('new_appointment', true, $data);
  }

  private function checkTricycleCin($tricycleCin)
  {
    if (empty($tricycleCin) || (is_array($tricycleCin) && empty(array_filter($tricycleCin)))) {
      set_flash_message("Please select at least one tricycle CIN.", "error");
      redirect('new_appointment');
      return false;
    }
    return true;
  }

  private function redirectToPage($page, $appointmentType, $transferType, $tricycleCin, $numberOfTricycles)
  {
    redirect("$page?appointmentType=" . urlencode($appointmentType) . "&transferType=" . urlencode($transferType) . "&tricycleCin=" . urlencode($tricycleCin) . "&numberOfTricycles=" . $numberOfTricycles);
  }
}