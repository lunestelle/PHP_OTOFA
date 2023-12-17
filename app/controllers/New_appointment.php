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
      if (isset($_POST['appointmentType'])) {
        $appointmentType = $_POST['appointmentType'];

        switch ($appointmentType) {
          case 'New Franchise':
            redirect('new_franchise');
            break;

          case 'Renewal of Franchise':
            redirect('renewal_of_franchise');
            break;
          
          case 'Change of Motorcycle':
            redirect('change_of_motorcycle');
            break;
          
          case 'Transfer of Ownership':
            redirect('transfer_of_ownership');
            break;

          default:
            break;
        }
      } else {
        set_flash_message("Appointment type is not set in the form. Please select <br> an appointment type before submitting the form.", "error");
      }
    }

    echo $this->renderView('new_appointment', true);
  }
}