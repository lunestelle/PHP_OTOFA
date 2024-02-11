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

		$cinModel = new TricycleCinNumber();
    $data['userHasCin'] = $cinModel->getCinNumberIdByUserId($_SESSION['USER']->user_id) !== null;
    // $data['tricycleCinNumbers'] = $cinModel->where(["is_used" => 1, "user_id" => $_SESSION['USER']->user_id]);

    // if (is_array($data['tricycleCinNumbers'])) {
    //   usort($data['tricycleCinNumbers'], function ($a, $b) {
    //     return strcmp($a->cin_number, $b->cin_number);
    //   });
    // } else {
    //   $data['tricycleCinNumbers'] = [];
    // }

    $tricycleStatusModel = new TricycleStatuses();
    $userTricycleStatuses = $tricycleStatusModel->where(["user_id" => $_SESSION['USER']->user_id]);
    $statuses = [];

    $userHasRenewalStatus = false;
    $userHasChangeMotorStatus = false;

    $renewalStatuses = ['Renewal Required', 'Expired Renewal (1st Notice)', 'Expired Renewal (2nd Notice)', 'Expired Renewal (3rd Notice)'];
    $changeMotorStatuses = ['Change Motor Required', 'Expired Motor (1st Notice)', 'Expired Motor (2nd Notice)', 'Expired Motor (3rd Notice)'];

    if (count($userTricycleStatuses)) {
      foreach ($userTricycleStatuses as $status) {
        $statuses[$status->status][] = $status;

        if (in_array($status->status, $renewalStatuses)) {
          $userHasRenewalStatus = true;
        } elseif (in_array($status->status, $changeMotorStatuses)) {
          $userHasChangeMotorStatus = true;
        }
      }
    }



    $data['userHasRenewalStatus'] = $userHasRenewalStatus;
    $data['userHasChangeMotorStatus'] = $userHasChangeMotorStatus;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['appointmentType'])) {
        $appointmentType = $_POST['appointmentType'];

        switch ($appointmentType) {
          case 'New Franchise':
            redirect('new_franchise');
            break;

          case 'Renewal of Franchise':
          case 'Change of Motorcycle':
          case 'Transfer of Ownership':
            $tricycleCin = isset($_POST['tricycleCin']) ? $_POST['tricycleCin'] : '';
            if ($this->checkTricycleCin($tricycleCin)) {
              if ($appointmentType === 'Transfer of Ownership') {
                $transferType = isset($_POST['transferType']) ? $_POST['transferType'] : '';
                if ($transferType === '') {
                  set_flash_message("Please select a transfer type.", "error");
                  redirect('new_appointment'); // Redirect back to the appointment page
                } elseif ($transferType == 'Transfer of Ownership from Deceased Owner') {
                  // Redirect to ownership_of_transfer_from_deceased_owner with the tricycle CIN
                  $this->redirectToPage('ownership_transfer_from_deceased_owner', $tricycleCin);
                } elseif ($transferType == 'Intent of Transfer') {
                  // Redirect to ownership_of_transfer_from_deceased_owner with the tricycle CIN
                  $this->redirectToPage('intent_of_transfer', $tricycleCin);
                } else {
                  // If transfer type is None, redirect to transfer_of_ownership
                  $this->redirectToPage('transfer_of_ownership', $tricycleCin);
                }
              } else {
                $this->redirectToPage(strtolower(str_replace(' ', '_', $appointmentType)), $tricycleCin);
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
    if (empty($tricycleCin)) {
      set_flash_message("Please select a tricycle CIN.", "error");
			redirect('new_appointment');
      return false;
    }
    return true;
  }

  private function redirectToPage($page, $tricycleCin = '')
  {
    redirect("$page?tricycleCin=$tricycleCin");
  }
}