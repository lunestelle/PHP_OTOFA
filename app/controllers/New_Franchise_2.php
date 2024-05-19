<?php

class New_franchise_2
{
  use Controller;

    public function index()
    {
      if (!is_authenticated()) {
        set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
        redirect('');
      }

      // Check if the user has the "admin" role
      $userRole = $_SESSION['USER']->role;
      if ($userRole !== 'operator') {
        set_flash_message("Access denied. You don't have the required role to access this page.", "error");
        redirect('');
      }

      $data = [];

      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['schedule_appointment'])) {
        $appointmentModel = new Appointment();
        $tricycleApplicationModel = new TricycleApplication();
        $mtopRequirementModel = new MtopRequirement();

        $appointmentFormData = [
          'name' => $_POST['name'] ?? '',
          'phone_number' => $_POST['phone_number'] ?? '',
          'email' => $_POST['email'] ?? '',
          'appointment_type' => 'New Franchise',
          'appointment_date' => $_POST['appointment_date'] ?? '',
          'appointment_time' => date("H:i", strtotime($_POST['appointment_time'])) ?? '',
          'status' => 'Pending',
          'user_id' => $_SESSION['USER']->user_id,
        ];

        $tricycleApplicationFormData1 = [
          'operator_name' => $_POST['operator_name'] ?? '',
          'tricycle_phone_number' => $_POST['tricycle_phone_number'] ?? '',
          'address' => $_POST['address'] ?? '',
          'mtop_no' => $_POST['mtop_no'] ?? '',
          'route_area' => $_POST['route_area'] ?? '',
          'color_code' => $_POST['color_code'] ?? '',
          'make_model' => $_POST['make_model'] ?? '',
          'make_model_expiry_date' => $_POST['make_model_expiry_date'] ?? '',
          'make_model_year_acquired' => $_POST['make_model_year_acquired'] ?? '',
          'motor_number' => $_POST['motor_number'] ?? '',
          'insurer' => $_POST['insurer'] ?? '',
          'coc_no' => $_POST['coc_no'] ?? '',
          'coc_no_expiry_date' => $_POST['coc_no_expiry_date'] ?? '',
        ];

        $tricycleApplicationFormData2 = [
          'operator_name' => $_POST['operator_name2'] ?? '',
          'tricycle_phone_number' => $_POST['tricycle_phone_number2'] ?? '',
          'address' => $_POST['address2'] ?? '',
          'mtop_no' => $_POST['mtop_no2'] ?? '',
          'route_area' => $_POST['route_area2'] ?? '',
          'color_code' => $_POST['color_code2'] ?? '',
          'make_model' => $_POST['make_model2'] ?? '',
          'make_model_expiry_date' => $_POST['make_model_expiry_date2'] ?? '',
          'make_model_year_acquired' => $_POST['make_model_year_acquired2'] ?? '',
          'motor_number' => $_POST['motor_number2'] ?? '',
          'insurer' => $_POST['insurer2'] ?? '',
          'coc_no' => $_POST['coc_no2'] ?? '',
          'coc_no_expiry_date' => $_POST['coc_no_expiry_date2'] ?? '',
        ];

        $formErrors = $this->validateFormFields($appointmentFormData, $tricycleApplicationFormData1, $tricycleApplicationFormData2, $appointmentModel, $tricycleApplicationModel);

        if (!empty($formErrors)) {
          $firstError = reset($formErrors);
          set_flash_message($firstError[0], "error");
          $data = array_merge($data, $_POST);
          echo $this->renderView('new_franchise_2', true, $data);
          return;
        } else {
          $formattedPhoneNumber = $appointmentFormData['phone_number'];
          $appointmentFormData['phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);

          if ($appointmentModel->insert($appointmentFormData)) {
            $appointmentLastId = $appointmentModel->getLastInsertedRecord()[0]->appointment_id;

            $tricycleApplicationFormData1['appointment_id'] = $appointmentLastId;
            $tricycleApplicationFormData2['appointment_id'] = $appointmentLastId;

            $formattedPhoneNumber1 = $tricycleApplicationFormData1['tricycle_phone_number'];
            $tricycleApplicationFormData1['tricycle_phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber1);

            $formattedPhoneNumber2 = $tricycleApplicationFormData2['tricycle_phone_number'];
            $tricycleApplicationFormData2['tricycle_phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber2);

            if ($tricycleApplicationModel->insert($tricycleApplicationFormData1)) {
              $tricycleApplicationLastId1 = $tricycleApplicationModel->getLastInsertedRecord()[0]->tricycle_application_id;

              if ($tricycleApplicationModel->insert($tricycleApplicationFormData2)) {
                $tricycleApplicationLastId2 = $tricycleApplicationModel->getLastInsertedRecord()[0]->tricycle_application_id;

                $mtopRequirementFormData1 = [
                  'appointment_id' => $appointmentLastId,
                  'tricycle_application_id' => $tricycleApplicationLastId1,
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
              
                $mtopRequirementFormData2 = [
                  'appointment_id' => $appointmentLastId,
                  'tricycle_application_id' => $tricycleApplicationLastId2,
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
              
              
                $fileUploads1 = $this->handleFileUploads($mtopRequirementFormData1, '1');
                $fileUploads2 = $this->handleFileUploads($mtopRequirementFormData2, '2');
              
                if ($fileUploads1['success'] && $fileUploads2['success']) {
                  $mtopRequirementModel = new MtopRequirement();
                  $mtopRequirementModel->insert($fileUploads1['data']);
                  $mtopRequirementModel->insert($fileUploads2['data']);
              
                  set_flash_message("Appointment scheduled successfully.", "success");
                  redirect('appointments');
                } else {
                  $appointmentModel->delete(['appointment_id' => $appointmentLastId]);
                  $tricycleApplicationModel->delete(['tricycle_application_id' => $tricycleApplicationLastId1]);
                  $tricycleApplicationModel->delete(['tricycle_application_id' => $tricycleApplicationLastId2]);
                  set_flash_message("Failed to schedule appointment. Please try again later.", "error");
                  redirect('appointments');
                }
              } else {
                $appointmentModel->delete(['appointment_id' => $appointmentLastId]);
                $tricycleApplicationModel->delete(['tricycle_application_id' => $tricycleApplicationLastId1]);
                set_flash_message("Failed to schedule appointment. Please try again later.", "error");
                redirect('appointments');
              }
            } else {
              $appointmentModel->delete(['appointment_id' => $appointmentLastId]);
              set_flash_message("Failed to schedule appointment. Please try again later.", "error");
              redirect('appointments');
            }
          } else {
            set_flash_message("Failed to schedule appointment. Please try again later.", "error");
            redirect('appointments');
          }
        }
      }

      echo $this->renderView('new_franchise_2', true);
    }

  private function validateFormFields($appointmentFormData, $tricycleApplicationFormData1, $tricycleApplicationFormData2, $appointmentModel, $tricycleApplicationModel)
  {
    $errors = array();

    $appointmentErrors = $appointmentModel->validate($appointmentFormData);
    if (!empty($appointmentErrors)) {
      $errors['appointment'] = $appointmentErrors;
    }

    $tricycleApplicationErrors1 = $tricycleApplicationModel->validate($tricycleApplicationFormData1);
    if (!empty($tricycleApplicationErrors1)) {
      $errors['tricycleApplication1'] = $tricycleApplicationErrors1;
    }

    $tricycleApplicationErrors2 = $tricycleApplicationModel->validate($tricycleApplicationFormData2);
    if (!empty($tricycleApplicationErrors2)) {
      $errors['tricycleApplication2'] = $tricycleApplicationErrors2;
    }

    return $errors;
  }

  private function handleFileUploads($mtopRequirementFormData, $suffix)
  {
    $uniqueId = uniqid();
    $uploadDirectory = 'public/uploads/mtop_requirements_images/' . $uniqueId;
  
    foreach ($_FILES as $inputName => $file) {
      if (strpos($inputName, $suffix) !== false) {
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $columnName = str_replace($suffix, '', $inputName) . '_path';
        $targetFile = $uploadDirectory . '_' . $inputName . '.' . $extension;
  
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
          $mtopRequirementFormData[$columnName] = $targetFile;
        } else {
          return ['success' => false, 'error' => 'Failed to upload files. Please try again later.'];
        }
      }
    }
  
    return ['success' => true, 'data' => $mtopRequirementFormData];
  }
}