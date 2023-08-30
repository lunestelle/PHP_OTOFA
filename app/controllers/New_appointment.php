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
        $appointmentData = [
          'name' => $_POST['name'],
          'phone_number' => '+63' . preg_replace('/[^0-9]/', '', $_POST['phone_number']),
          'appointment_type' => $_POST['appointment_type'],
          'appointment_date' => $_POST['appointment_date'],
          'appointment_time' => $_POST['appointment_time']
        ];
        

        $tricycleAppointmentData = [
          'operator_name' => $_POST['operator_name'],
          'tricycle_phone_number' => '+63' . preg_replace('/[^0-9]/', '', $_POST['tricycle_phone_number']),
          'address' => $_POST['address'],
          'mtop_no' => $_POST['mtop_no'],
          'route_area' => $_POST['route_area'],
          'color_code' => $_POST['color_code'],
          'make_model' => $_POST['make_model'],
          'make_model_expiry_date' => $_POST['make_model_expiry_date'],
          'motor_number' => $_POST['motor_number'],
          'insurer' => $_POST['insurer'],
          'chasis_number' => $_POST['chasis_number'],
          'coc_no' => $_POST['coc_no'],
          'coc_no_expiry_date' => $_POST['coc_no_expiry_date'],
          'plate_number' => $_POST['plate_number'],
          'lto_cr_no' => $_POST['lto_cr_no'],
          'lto_or_no' => $_POST['lto_or_no'],
          'driver_name' => $_POST['driver_name'],
          'driver_license_no' => $_POST['driver_license_no'],
          'driver_license_expiry_date' => $_POST['driver_license_expiry_date']
        ];

        $insertedAppointmentInfo = $appointmentModel->insert($appointmentData);
        $insertedTricycleAppointment = $tricycleAppointmentModel->insert($tricycleAppointmentData);
  
        if ($insertedAppointmentInfo && $insertedTricycleAppointment) {
          echo json_encode(['status' => 'success', 'msg' => 'Appointment scheduled successfully.', 'redirect_url' => 'appointments']);
            exit;
        } else {
          echo json_encode(['status' => 'error', 'msg' => 'Failed to schedule appointment. Please try again.', 'redirect_url' => 'appointments']);
          exit;
        }
      }
    }
    echo $this->renderView('new_appointment', true, $data);
  }
}