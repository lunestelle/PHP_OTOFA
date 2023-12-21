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

    $cinModel = new TricycleCinNumber();
    $data['userHasCin'] = $cinModel->getCinNumberIdByUserId($_SESSION['USER']->user_id) !== null;
    

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
            // Check if the transfer type is selected
            if (isset($_POST['transferType'])) {
              $transferType = $_POST['transferType'];

              // Redirect based on the selected transfer type
              switch ($transferType) {
                case 'None':
                  redirect('transfer_of_ownership');
                  break;

                case 'Intent of Transfer':
                  redirect('intent_of_transfer');
                  break;

                case 'Transfer of Ownership from Deceased Owner':
                  redirect('ownership_transfer_from_deceased_owner');
                  break;

                default:
                  set_flash_message("Invalid transfer type selected.", "error");
                  break;
              }
            } else {
              set_flash_message("Please select a transfer type.", "error");
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
}