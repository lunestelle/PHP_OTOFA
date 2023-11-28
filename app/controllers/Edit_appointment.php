<?php

class Edit_appointment
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
      redirect('');
    }

    $appointmentId = isset($_GET['appointment_id']) ? $_GET['appointment_id'] : null;

    $appointmentModel = new Appointment();
    $appointmentData = $appointmentModel->first(['appointment_id' => $appointmentId]);

    if (!$appointmentData) {
      set_flash_message("Appointment not found.", "error");
      redirect('appointments');
    }

    $tricycleApplicationModel = new TricycleApplication();
    $tricycleApplicationFormData = $tricycleApplicationModel->first(['appointment_id' => $appointmentId]);

    $driverModel = new Driver();
    $drivers = $driverModel->where(['user_id' => $_SESSION['USER']->user_id]);
    $data['drivers'] = [];

    if (is_array($drivers) || is_object($drivers)) {
      foreach ($drivers as $driver) {
        $data['drivers'][$driver->driver_id] = [
          'driver_id' => $driver->driver_id,
          'name' => $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name,
        ];
      }
    } else {
      $data['drivers'] = [];
    }

    $data = [
      'name' => $appointmentData->name,
      'phone_number' => $this->formatPhoneNumber($appointmentData->phone_number),
      'email' => $appointmentData->email,
      'appointment_type' => $appointmentData->appointment_type,
      'appointment_date' => $appointmentData->appointment_date,
      'appointment_time' => $appointmentData->appointment_time,
      'status' => $appointmentData->status,
      'operator_name' => $tricycleApplicationFormData->operator_name,
      'tricycle_phone_number' => $this->formatPhoneNumber($tricycleApplicationFormData->tricycle_phone_number),
      'address' => $tricycleApplicationFormData->address,
      'mtop_no' => $tricycleApplicationFormData->mtop_no,
      'color_code' => $tricycleApplicationFormData->color_code,
      'route_area' => $tricycleApplicationFormData->route_area,
      'make_model' => $tricycleApplicationFormData->make_model,
      'make_model_expiry_date' => $tricycleApplicationFormData->make_model_expiry_date,
      'motor_number' => $tricycleApplicationFormData->motor_number,
      'insurer' => $tricycleApplicationFormData->insurer,
      'chasis_number' => $tricycleApplicationFormData->chasis_number,
      'coc_no' => $tricycleApplicationFormData->coc_no,
      'coc_no_expiry_date' => $tricycleApplicationFormData->coc_no_expiry_date,
      'plate_number' => $tricycleApplicationFormData->plate_number,
      'lto_cr_no' => $tricycleApplicationFormData->lto_cr_no,
      'lto_or_no' => $tricycleApplicationFormData->lto_or_no,
      'driver_id' => $tricycleApplicationFormData->driver_id,
      'driver_license_no' => $tricycleApplicationFormData->driver_license_no,
      'driver_license_expiry_date' => $tricycleApplicationFormData->driver_license_expiry_date,
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['schedule_appointment'])) {
      $appointmentModel = new Appointment();
      $tricycleApplicationModel = new TricycleApplication();

      $appointmentFormData = [
        'name' => $_POST['name'] ?? '',
        'phone_number' => $_POST['phone_number'] ?? '',
        'email' => $_POST['email'] ?? '',
        'appointment_type' => $_POST['appointment_type'] ?? '',
        'appointment_date' => $_POST['appointment_date'] ?? '',
        'appointment_time' => $_POST['appointment_time'] ?? '',
        'status' => $_POST['status'] ?? '',
      ];

      $tricycleApplicationFormData = [
        'operator_name' => $_POST['operator_name'] ?? '',
        'tricycle_phone_number' => $_POST['tricycle_phone_number'] ?? '',
        'address' => $_POST['address'] ?? '',
        'mtop_no' => $_POST['mtop_no'] ?? '',
        'route_area' => $_POST['route_area'] ?? '',
        'color_code' => $_POST['color_code'] ?? '',
        'make_model' => $_POST['make_model'] ?? '',
        'make_model_expiry_date' => $_POST['make_model_expiry_date'] ?? '',
        'motor_number' => $_POST['motor_number'] ?? '',
        'insurer' => $_POST['insurer'] ?? '',
        'chasis_number' => $_POST['chasis_number'] ?? '',
        'coc_no' => $_POST['coc_no'] ?? '',
        'coc_no_expiry_date' => $_POST['coc_no_expiry_date'] ?? '',
        'plate_number' => $_POST['plate_number'] ?? '',
        'lto_cr_no' => $_POST['lto_cr_no'] ?? '',
        'lto_or_no' => $_POST['lto_or_no'] ?? '',
        'driver_id' => $_POST['driver_id'] ?? '',
        'driver_license_no' => $_POST['driver_license_no'] ?? '',
        'driver_license_expiry_date' => $_POST['driver_license_expiry_date'] ?? '',
      ];

      $formErrors = $this->validateAppointmentAndTricycleFormData($appointmentFormData, $tricycleApplicationFormData, $appointmentModel, $tricycleApplicationModel);
   
      if (!empty($formErrors)) {
        $firstError = reset($formErrors);
        set_flash_message($firstError[0], "error");
        $data = array_merge($data, $_POST);
        echo $this->renderView('edit_appointment', true, $data);
        return;
      } else {
        $formattedPhoneNumber = $appointmentFormData['phone_number'];
				$appointmentFormData['phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);

        if ($appointmentModel->update(['appointment_id' => $appointmentId], $appointmentFormData)) {          
          $formattedPhoneNumber = $tricycleApplicationFormData['tricycle_phone_number'];
				  $tricycleApplicationFormData['tricycle_phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);

          if ($tricycleApplicationModel->update(['appointment_id' => $appointmentId], $tricycleApplicationFormData)){
            set_flash_message("Scheduled appointment updated successfully.", "success");
            redirect('appointments');
          } else {
            $appointmentModel->delete($lastId);
            set_flash_message("Failed to update scheduled appointment. Please try again later.", "error");
            redirect('appointments');
          }
        } else {
          set_flash_message("Failed to update scheduled appointment. Please try again later.", "error");
          redirect('appointments');
        }
      }
    }

    echo $this->renderView('edit_appointment', true, $data);
  }

  private function validateAppointmentAndTricycleFormData($appointmentFormData, $tricycleApplicationFormData, $appointmentModel, $tricycleApplicationModel) {
    $errors = array();
   
    $appointmentErrors = $appointmentModel->updateValidation($appointmentFormData);
    if (!empty($appointmentErrors)) {
      $errors['appointment'] = $appointmentErrors;
    }
   
    $tricycleApplicationErrors = $tricycleApplicationModel->validate($tricycleApplicationFormData);
    if (!empty($tricycleApplicationErrors)) {
      $errors['tricycleApplication'] = $tricycleApplicationErrors;
    }
   
    return $errors;
  }
  
  private function formatPhoneNumber($phoneNumber) {
    return preg_replace('/[^0-9]/', '', str_replace('+63', '', $phoneNumber));
  }
}