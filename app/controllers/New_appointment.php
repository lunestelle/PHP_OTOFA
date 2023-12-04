<?php

// require '../vendor/autoload.php';

// use SMSGatewayMe\Client\ApiClient;
// use SMSGatewayMe\Client\Configuration;
// use SMSGatewayMe\Client\Api\MessageApi;
// use SMSGatewayMe\Client\Model\SendMessageRequest;

class New_appointment
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
      redirect('');
    }

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

    $tricycleModel = new Tricycle();
		$tricycles = $tricycleModel->where(['user_id' => $_SESSION['USER']->user_id]);
		$data['tricycles'] = [];

		if (is_array($tricycles) || is_object($tricycles)) {
			foreach ($tricycles as $tricycle) {
				$data['tricycles'][$tricycle->tricycle_id] = [
					'tricycle_id' => $tricycle->tricycle_id,
					'plate_no' => $tricycle->plate_no
				];
			}
		} else {
			$data['tricycles'] = [];
		}

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
        'status' => 'Pending',
        'user_id' => $_SESSION['USER']->user_id,
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
        'tricycle_id' => $_POST['tricycle_id'] ?? '',
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
        echo $this->renderView('new_appointment', true, $data);
        return;
      } else {
        $formattedPhoneNumber = $appointmentFormData['phone_number'];
				$appointmentFormData['phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);

        if (!empty($_FILES['mc_lto_certificate_of_registration']['name']) && !empty($_FILES['mc_lto_official_receipt']['name']) && !empty($_FILES['mc_plate_authorization']['name']) && !empty($_FILES['tc_insurance_policy']['name']) && !empty($_FILES['front_view_image']['name']) && !empty($_FILES['side_view_image']['name']) && !empty($_FILES['sketch_location_of_garage']['name']) && !empty($_FILES['affidavit_of_income_tax_return']['name']) && !empty($_FILES['driver_cert_safety_driving_seminar']['name']) && !empty($_FILES['proof_of_id']['name'])) {
          $imagePaths = $this->handleFileUploads($formData);

          if ($imagePaths === false) {
            set_flash_message("Failed to upload images.", "error");
            redirect('tricycles');
          }

          $formData['mc_lto_certificate_of_registration_path'] = $imagePaths['mc_lto_certificate_of_registration'];
          $formData['mc_lto_official_receipt_path'] = $imagePaths['mc_lto_official_receipt'];
          $formData['mc_plate_authorization_path'] = $imagePaths['mc_plate_authorization'];
          $formData['tc_insurance_policy_path'] = $imagePaths['tc_insurance_policy'];

          if ($appointmentModel->insert($appointmentFormData)) {
            $lastId = $appointmentModel->getLastInsertedRecord()[0]->appointment_id;
            $tricycleApplicationFormData['appointment_id'] = $lastId;
            
            $formattedPhoneNumber = $tricycleApplicationFormData['tricycle_phone_number'];
            $tricycleApplicationFormData['tricycle_phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);
  
            if ($tricycleApplicationModel->insert($tricycleApplicationFormData)){
              set_flash_message("Appointment scheduled successfully.", "success");
              redirect('appointments');
            } else {
              $appointmentModel->delete($lastId);
              set_flash_message("Failed to schedule appointment. Please try again later.", "error");
              redirect('appointments');
            }
          } else {
            set_flash_message("Failed to schedule appointment. Please try again later.", "error");
            redirect('appointments');
          }
        }

       
      }
    }

    echo $this->renderView('new_appointment', true, $data);
  }

  private function validateAppointmentAndTricycleFormData($appointmentFormData, $tricycleApplicationFormData, $appointmentModel, $tricycleApplicationModel) {
    $errors = array();
   
    $appointmentErrors = $appointmentModel->validate($appointmentFormData);
    if (!empty($appointmentErrors)) {
      $errors['appointment'] = $appointmentErrors;
    }
   
    $tricycleApplicationErrors = $tricycleApplicationModel->validate($tricycleApplicationFormData);
    if (!empty($tricycleApplicationErrors)) {
      $errors['tricycleApplication'] = $tricycleApplicationErrors;
    }
   
    return $errors;
  }

  private function sendSMS($to, $message) {
    $accountSid = 'your_twilio_account_sid';
    $authToken  = 'your_twilio_auth_token';
    $twilioNumber = 'your_twilio_phone_number';

    $client = new Client($accountSid, $authToken);

    $client->messages->create(
      $to,
      [
        'from' => $twilioNumber,
        'body' => $message,
      ]
    );
  }
}