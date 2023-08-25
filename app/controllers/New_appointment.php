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

    $data['currentSection'] = isset($_GET['section']) ? intval($_GET['section']) : 0;
    $totalSections = 2;

    if ($data['currentSection'] < 0 || $data['currentSection'] >= $totalSections) {
      set_flash_message("The URL you provided is not properly formatted or does<br>not exist. Please double-check the URL and try again.", "error");
      redirect('new_appointment');
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      // $appointmentData = [
      //   'name' => ucwords($_POST['name']),
      //   'phone_number' => $_POST['phone_number'],
      //   'appointment_type' => $_POST['appointment_type'],
      //   'appointment_date' => $_POST['appointment_date'],
      //   'appointment_time' => $_POST['appointment_time'],
      // ];
    
      $appointmentModel = new Appointment();
      $tricycleAppointmentModel = new TricycleAppointment();
      $appointmentErrors = $appointmentModel->validate($_POST);
      // $tricycleAppointmentErrors = $tricycleAppointmentModel->validate($tricycleAppointmentData);

      if (!empty($appointmentErrors)) {
        $errorMessage = $appointmentErrors[0];
        // set_flash_message($errorMessage, "error");
        // $data['currentSection'] = 0;
        $response = ['status' => 'error', 'msg' => $errorMessage, 'redirect_url' => 'new_appointment'];
        echo json_encode($response);
        exit;
      }
      // } else {
      //   $formattedPhoneNumber = $formData['phone_number'];
			// 	$formData['phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);

      //   if ($appointmentModel->insert($formData)) {
      //     set_flash_message("Appointment scheduled successfully.", "success");
      //     redirect('appointments');
      //   } else {
      //     set_flash_message("Failed to schedule appointment.", "error");
      //   }
      // }

      // if (!empty($tricycleAppointmentErrors)) {
      //   $errorMessage = $errors[0];
      //   set_flash_message($errorMessage, "error");
      //   $data = array_merge($tricycleAppointmentData);
      //   echo $this->renderView('new_appointment', true, $data);
      //   return;
      // } else {
      //   $formattedPhoneNumber = $formData['phone_number'];
			// 	$formData['phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);

      //   $insertedTricycleAppointment = $tricycleAppointmentModel->insert($tricycleAppointmentData);
      // }

      // if ($insertedTricycleAppointment && $insertedAppointment) {
      //   set_flash_message("Appointment scheduled successfully.", "success");
      //   redirect('appointments');
      // } else {
      //   set_flash_message("Failed to schedule appointment.", "error");
      // }
    }

    echo $this->renderView('new_appointment', true, $data);
  }
}