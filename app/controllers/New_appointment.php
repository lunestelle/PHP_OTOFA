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
    $data['tricycleCinNumbers'] = $cinModel->where(["is_used" => 1, "user_id" => $_SESSION['USER']->user_id]);

    if (is_array($data['tricycleCinNumbers'])) {
      usort($data['tricycleCinNumbers'], function ($a, $b) {
        return strcmp($a->cin_number, $b->cin_number);
      });
    } else {
      $data['tricycleCinNumbers'] = [];
    }

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
                  break;
                }
              }

              $this->redirectToPage(strtolower(str_replace(' ', '_', $appointmentType)), $tricycleCin);
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