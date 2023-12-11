<?php

class Edit_new_franchise
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
    $tricycleApplicationData = $tricycleApplicationModel->first(['appointment_id' => $appointmentId]);

    $mtopRequirementModel = new MtopRequirement();
    $mtopRequirementData = $mtopRequirementModel->first(['appointment_id' => $appointmentId]);
    $mtopRequirementId = $mtopRequirementData->mtop_requirement_id;

    $data = [
      'name' => $appointmentData->name,
      'phone_number' => $this->formatPhoneNumber($appointmentData->phone_number),
      'email' => $appointmentData->email,
      'appointment_type' => $appointmentData->appointment_type,
      'appointment_date' => $appointmentData->appointment_date,
      'appointment_time' => $appointmentData->appointment_time,
      'status' => $appointmentData->status,
      'operator_name' => $tricycleApplicationData->operator_name,
      'tricycle_phone_number' => $this->formatPhoneNumber($tricycleApplicationData->tricycle_phone_number),
      'address' => $tricycleApplicationData->address,
      'mtop_no' => $tricycleApplicationData->mtop_no,
      'color_code' => $tricycleApplicationData->color_code,
      'route_area' => $tricycleApplicationData->route_area,
      'make_model' => $tricycleApplicationData->make_model,
      'make_model_expiry_date' => $tricycleApplicationData->make_model_expiry_date,
      'motor_number' => $tricycleApplicationData->motor_number,
      'insurer' => $tricycleApplicationData->insurer,
      'coc_no' => $tricycleApplicationData->coc_no,
      'coc_no_expiry_date' => $tricycleApplicationData->coc_no_expiry_date,
      'mc_lto_certificate_of_registration_path' => $mtopRequirementData->mc_lto_certificate_of_registration_path,
      'mc_lto_official_receipt_path' => $mtopRequirementData->mc_lto_official_receipt_path,
      'mc_plate_authorization_path' => $mtopRequirementData->mc_plate_authorization_path,
      'tc_insurance_policy_path' => $mtopRequirementData->tc_insurance_policy_path,
      'unit_front_view_image_path' => $mtopRequirementData->unit_front_view_image_path,
      'unit_side_view_image_path' => $mtopRequirementData->unit_side_view_image_path,
      'sketch_location_of_garage_path' => $mtopRequirementData->sketch_location_of_garage_path,
      'affidavit_of_income_tax_return_path' => $mtopRequirementData->affidavit_of_income_tax_return_path,
      'driver_cert_safety_driving_seminar_path' => $mtopRequirementData->driver_cert_safety_driving_seminar_path,
      'proof_of_id_path' => $mtopRequirementData->proof_of_id_path,
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        'coc_no' => $_POST['coc_no'] ?? '',
        'coc_no_expiry_date' => $_POST['coc_no_expiry_date'] ?? '',
      ];

      if (isset($_POST['confirm_delete_image'])) {
        $imageType = $_POST['image_type'];
        $imagePathColumn = "{$imageType}_path";
        
        // Check if the file exists before attempting to delete
        if (file_exists($_POST['original_image_path'])) {
          $deleted = unlink($_POST['original_image_path']);
          
          // Update the database column with an empty value if deletion was successful
          if ($deleted) {
            $mtopRequirementModel->update(['mtop_requirement_id' => $mtopRequirementId], [$imagePathColumn => null]);
            set_flash_message("Image deleted successfully.", "success");
            redirect('edit_new_franchise?appointment_id=' . $appointmentId);
          } else {
            set_flash_message("Failed to delete the image.", "error");
            redirect('edit_new_franchise?appointment_id=' . $appointmentId);
          }
        } else {
          set_flash_message("File not found. Image may have been deleted already.", "error");
          redirect('edit_new_franchise?appointment_id=' . $appointmentId);
        }
      }

      if (isset($_POST['update_new_franchise'])) {
        $formErrors = $this->validateAppointmentAndTricycleFormData($appointmentFormData, $tricycleApplicationFormData, $appointmentModel, $tricycleApplicationModel);

        if (!empty($formErrors)) {
          $firstError = reset($formErrors);
          set_flash_message($firstError[0], "error");
          $data = array_merge($data, $_POST);
          echo $this->renderView('edit_new_franchise', true, $data);
          return;
        } else {
          $formattedPhoneNumber = $appointmentFormData['phone_number'];
          $appointmentFormData['phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);
       
          $formattedPhoneNumber = $tricycleApplicationFormData['tricycle_phone_number'];
          $tricycleApplicationFormData['tricycle_phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);

          $mtopRequirementFormData = [
            'mc_lto_certificate_of_registration_path',
            'mc_lto_official_receipt_path',
            'mc_plate_authorization_path',
            'tc_insurance_policy_path',
            'unit_front_view_image_path',
            'unit_side_view_image_path',
            'sketch_location_of_garage_path',
            'affidavit_of_income_tax_return_path',
            'driver_cert_safety_driving_seminar_path',
            'proof_of_id_path',
          ];

          $fileUploads = $this->handleFileUploads($mtopRequirementFormData);

          if ($fileUploads['success']) {
            if ($appointmentModel->update(['appointment_id' => $appointmentId], $appointmentFormData) && $tricycleApplicationModel->update(['appointment_id' => $appointmentId], $tricycleApplicationFormData) && $mtopRequirementModel->update(['mtop_requirement_id' => $mtopRequirementId], $fileUploads['data'])) { 
              set_flash_message("Scheduled appointment updated successfully.", "success");
              redirect('appointments');
            } else {
              set_flash_message("Failed to update scheduled appointment. Please try again later.", "error");
              redirect('appointments');
            }
          } else {
            set_flash_message("Failed to update scheduled appointment. Please try again later.", "error");
            redirect('appointments');
          }
        }
      }

    }

    echo $this->renderView('edit_new_franchise', true, $data);
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