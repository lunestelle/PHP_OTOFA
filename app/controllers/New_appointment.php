<?php

class New_appointment
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
      redirect('');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $appointmentType = $_POST['appointment_type'];

      switch ($appointmentType) {
        case 'New Franchise':
          redirect('new_franchise');
          break;

        case 'Renewal of Franchise':
          redirect('renewal_franchise');
          break;

        default:
          break;
      }
    }
    echo $this->renderView('new_appointment', true);
  }
}