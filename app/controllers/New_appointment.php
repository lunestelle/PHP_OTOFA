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
      $formData = [
        'name' => $_POST['name'],
        'phone_number' => $_POST['phone_number'],
        'appointment_type' => $_POST['appointment_type'],
        'appointment_date' => $_POST['appointment_date'],
        'appointment_time' => $_POST['appointment_time'],
      ];

      $appointmentModel = new Appointment();
      $errors = $appointmentModel->validate($formData);

      if (!empty($errors)) {
        $errorMessage = $errors[0];
        set_flash_message($errorMessage, "error");
        $data = array_merge($formData);
        echo $this->renderView('new_appointment', true, $data);
        return;
      } else {
        $formattedPhoneNumber = $formData['phone_number'];
				$formData['phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);

        if ($appointmentModel->insert($formData)) {
          set_flash_message("Appointment scheduled successfully.", "success");
          redirect('appointments');
        } else {
          set_flash_message("Failed to schedule appointment.", "error");
        }
      }
    }

    echo $this->renderView('new_appointment', true);
  }
}