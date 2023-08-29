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
      $appointmentModel = new Appointment();
      $tricycleAppointmentModel = new TricycleAppointment();

      if (isset($_POST['formType']) && $_POST['formType'] === 'appointmentForm') {
        $appointmentErrors = $appointmentModel->validate($_POST);

        if (!empty($appointmentErrors)) {
          $errorMessage = $appointmentErrors[0];
          $response = ['status' => 'error', 'msg' => $errorMessage];
          echo json_encode($response);
          exit;
        } else {
          echo json_encode(['status' => 'success']);
          exit;
        }
      } else if (isset($_POST['formType']) && $_POST['formType'] === 'tricycleApplicationForm') {
        $tricycleAppointmentErrors = $tricycleAppointmentModel->validate($_POST);

        if (!empty($tricycleAppointmentErrors)) {
          $errorMessage = $tricycleAppointmentErrors[0];
          $response = ['status' => 'error', 'msg' => $errorMessage];
          echo json_encode($response);
          exit;
        } else {
          echo json_encode(['status' => 'success']);
          exit;
        }
      } else if (isset($_POST['formType']) && $_POST['formType'] === 'bothForms') {
        $insertedAppointmentInfo = $appointmentModel->insert($appointmentFormData);
        $insertedTricycleAppointment = $tricycleAppointmentModel->insert($tricycleFormData);
  
        if ($insertedAppointmentInfo && $insertedTricycleAppointment) {
          echo json_encode(['status' => 'success', 'msg' => 'Appointment scheduled successfully.', 'redirect_url' => 'appointments']);
            exit;
        } else {
          echo json_encode(['status' => 'success', 'msg' => '"Failed to schedule appointment. Please try again.', 'redirect_url' => 'appointments']);
          exit;
        }
      }
    }
    echo $this->renderView('new_appointment', true, $data);
  }
}