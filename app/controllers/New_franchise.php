<?php

class New_franchise
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
      redirect('');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['schedule_appointment'])) {
      $appointmentModel = new Appointment();
      $tricycleApplicationModel = new TricycleApplication();
      $mtopRequirementModel = new MtopRequirement();

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
        // 'tricycle_id' => $_POST['tricycle_id'] ?? '',
        // 'driver_id' => $_POST['driver_id'] ?? '',
        // 'lto_cr_no' => $_POST['lto_cr_no'] ?? '',
        // 'lto_or_no' => $_POST['lto_or_no'] ?? '',
        // 'driver_license_no' => $_POST['driver_license_no'] ?? '',
        // 'driver_license_expiry_date' => $_POST['driver_license_expiry_date'] ?? '',
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
        'coc_no' => $_POST['coc_no'] ?? '',
        'coc_no_expiry_date' => $_POST['coc_no_expiry_date'] ?? '',
      ];

      $formErrors = $this->validateFormFields($appointmentFormData, $tricycleApplicationFormData, $appointmentModel, $tricycleApplicationModel);

      if (!empty($formErrors)) {
        $firstError = reset($formErrors);
        set_flash_message($firstError[0], "error");
        $data = array_merge($data, $_POST);
        echo $this->renderView('new_franchise', true, $data);
        return;
      } else {
        $formattedPhoneNumber = $appointmentFormData['phone_number'];
        $appointmentFormData['phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);

        if ($appointmentModel->insert($appointmentFormData)) {
          $appointmentLastId = $appointmentModel->getLastInsertedRecord()[0]->appointment_id;
          $tricycleApplicationFormData['appointment_id'] = $appointmentLastId;

          $formattedPhoneNumber = $tricycleApplicationFormData['tricycle_phone_number'];
          $tricycleApplicationFormData['tricycle_phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);

          if ($tricycleApplicationModel->insert($tricycleApplicationFormData)) {
            $tricycleApplicationLastId = $tricycleApplicationModel->getLastInsertedRecord()[0]->tricycle_application_id;

            $mtopRequirementFormData = [
              'appointment_id' => $appointmentLastId,
              'tricycle_application_id' => $tricycleApplicationLastId,
              'mc_lto_certificate_of_registration_path' => '',
              'mc_lto_official_receipt_path' => '',
              'mc_plate_authorization_path' => '',
              'tc_insurance_policy_path' => '',
              'unit_front_view_image_path' => '',
              'unit_side_view_image_path' => '',
              'sketch_location_of_garage_path' => '',
              'affidavit_of_income_tax_return_path' => '',
              'driver_cert_safety_driving_seminar_path' => '',
              'proof_of_id_path' => '',
            ];

            $fileUploads = $this->handleFileUploads($mtopRequirementFormData);

            if ($fileUploads['success']) {
              $mtopRequirementModel = new MtopRequirement();
              $mtopRequirementModel->insert($fileUploads['data']);

              set_flash_message("Appointment scheduled successfully.", "success");
              redirect('appointments');
            } else {
              $appointmentModel->delete(['appointment_id' => $appointmentLastId]);
              $tricycleApplicationModel->delete(['tricycle_application_id' => $tricycleApplicationLastId]);
              set_flash_message("Failed to schedule appointment. Please try again later.", "error");
              redirect('appointments');
            }
          }
        } else {
          $appointmentModel->delete(['appointment_id' => $appointmentLastId]);
          set_flash_message("Failed to schedule appointment. Please try again later.", "error");
          redirect('appointments');
        }
      }
    }

    echo $this->renderView('new_franchise', true);
  }

  private function validateFormFields($appointmentFormData, $tricycleApplicationFormData, $appointmentModel, $tricycleApplicationModel)
  {
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

  private function handleFileUploads($mtopRequirementFormData)
  {
    $uniqueId = uniqid();
    $uploadDirectory = 'public/uploads/mtop_requirements_images/' . $uniqueId;

      foreach ($_FILES as $inputName => $file) {
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $columnName = $inputName . '_path';
        $targetFile = $uploadDirectory . '_' . $inputName . '.' . $extension;

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
          $mtopRequirementFormData[$columnName] = $targetFile;
        } else {
          return ['success' => false, 'error' => 'Failed to upload files. Please try again later.'];
        }
      }

    return ['success' => true, 'data' => $mtopRequirementFormData];
  }
}