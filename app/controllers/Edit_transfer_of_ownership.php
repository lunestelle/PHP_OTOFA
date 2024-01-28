<?php

class Edit_transfer_of_ownership
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
      redirect('');
    }

    $driverModel = new Driver();
    $appointmentModel = new Appointment();
    $tricycleApplicationModel = new TricycleApplication();
    $tricycleCinNumberModel = new TricycleCinNumber();

    $appointmentId = isset($_GET['appointment_id']) ? $_GET['appointment_id'] : null;
    $appointmentData = $appointmentModel->first(['appointment_id' => $appointmentId]);

    if (!$appointmentData) {
      set_flash_message("Appointment not found.", "error");
      redirect('appointments');
    }
    
    $tricycleApplicationData = $tricycleApplicationModel->first(['appointment_id' => $appointmentId]);
    $selectedUserId = $appointmentData->user_id;
    $selectedCinNumber = $tricycleApplicationData->tricycle_cin_number_id;
    $cinData = $tricycleCinNumberModel->first(['tricycle_cin_number_id' => $selectedCinNumber]);

    $query = "SELECT drivers.* FROM drivers JOIN driver_statuses ON drivers.driver_id = driver_statuses.driver_id WHERE drivers.tricycle_cin_number_id = :tricycle_cin_id AND driver_statuses.status = 'Active'";
    $driverData = $driverModel->query($query, [':tricycle_cin_id' => $cinData->tricycle_cin_number_id]);

    if (!empty($driverData)) {
      $driver_name = $driverData->first_name . ' ' . $driverData->middle_name . ' ' . $driverData->last_name;
    } else {
      $driver_name = 'Selected CIN has no driver';
    }
    
    $mtopRequirementModel = new MtopRequirement();
    $mtopRequirementData = $mtopRequirementModel->first(['appointment_id' => $appointmentId]);
    $mtopRequirementId = $mtopRequirementData->mtop_requirement_id;

    $data = [
      'name' => $appointmentData->name,
      'phone_number' => $this->formatPhoneNumber($appointmentData->phone_number),
      'email' => $appointmentData->email,
      'appointment_type' => $appointmentData->appointment_type,
      'transfer_type' => $appointmentData->transfer_type,
      'appointment_date' => $appointmentData->appointment_date,
      'appointment_time' => $appointmentData->appointment_time,
      'status' => $appointmentData->status,
      'comments' => $appointmentData->comments,
      'operator_name' => $tricycleApplicationData->operator_name,
      'tricycle_phone_number' => $this->formatPhoneNumber($tricycleApplicationData->tricycle_phone_number),
      'address' => $tricycleApplicationData->address,
      'mtop_no' => $tricycleApplicationData->mtop_no,
      'color_code' => $tricycleApplicationData->color_code,
      'route_area' => $tricycleApplicationData->route_area,
      'make_model' => $tricycleApplicationData->make_model,
      'make_model_expiry_date' => $tricycleApplicationData->make_model_expiry_date,  
      'make_model_year_acquired' => $tricycleApplicationData->make_model_year_acquired,
      'motor_number' => $tricycleApplicationData->motor_number,
      'insurer' => $tricycleApplicationData->insurer,
      'coc_no' => $tricycleApplicationData->coc_no,
      'coc_no_expiry_date' => $tricycleApplicationData->coc_no_expiry_date,
      'driver_id' => $tricycleApplicationData->driver_id,
      'lto_cr_no' => $tricycleApplicationData->lto_cr_no,
      'lto_or_no' => $tricycleApplicationData->lto_or_no,
      'driver_license_no' => $tricycleApplicationData->driver_license_no,'driver_license_expiry_date' => $tricycleApplicationData->driver_license_expiry_date,
      'mc_lto_certificate_of_registration_path' => $mtopRequirementData->mc_lto_certificate_of_registration_path,
      'mc_lto_official_receipt_path' => $mtopRequirementData->mc_lto_official_receipt_path,
      'mc_plate_authorization_path' => $mtopRequirementData->mc_plate_authorization_path,
      'tc_insurance_policy_path' => $mtopRequirementData->tc_insurance_policy_path,
      'latest_franchise_path' => $mtopRequirementData->latest_franchise_path,
      'proof_of_id_path' => $mtopRequirementData->proof_of_id_path,
      'sketch_location_of_garage_path' => $mtopRequirementData->sketch_location_of_garage_path,
      'affidavit_of_income_tax_return_path' => $mtopRequirementData->affidavit_of_income_tax_return_path,
      'unit_front_view_image_path' => $mtopRequirementData->unit_front_view_image_path,
      'unit_side_view_image_path' => $mtopRequirementData->unit_side_view_image_path,
      'driver_cert_safety_driving_seminar_path' => $mtopRequirementData->driver_cert_safety_driving_seminar_path,
      'cin_number' => $cinData->cin_number,
      'driverData' => $driverData,
      'driver_name' => $driver_name,
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
        'transfer_type' => $_POST['transfer_type'],
        'appointment_date' => $_POST['appointment_date'] ?? '',
        'appointment_time' => $_POST['appointment_time'] ?? '',
        'status' => $_POST['status'] ?? $appointmentData->status,
        'comments' => $_POST['comments'] ?? '',
      ];

      $tricycleApplicationFormData = [
        'operator_name' => $_POST['operator_name'] ?? '',
        'tricycle_phone_number' => $_POST['tricycle_phone_number'] ?? '',
        'address' => $_POST['address'] ?? '',
        'mtop_no' => $_POST['mtop_no'] ?? '',
        'route_area' => $_POST['route_area'] ?? '',
        'color_code' => $_POST['color_code'] ?? '',
        'make_model' => $_POST['make_model'] ?? '',
        'make_model_expiry_date' => $_POST['make_model_expiry_date'] ?? '','make_model_year_acquired' => $_POST['make_model_year_acquired'] ?? '',
        'motor_number' => $_POST['motor_number'] ?? '',
        'insurer' => $_POST['insurer'] ?? '',
        'coc_no' => $_POST['coc_no'] ?? '',
        'coc_no_expiry_date' => $_POST['coc_no_expiry_date'] ?? '',
        'tricycle_cin_number_id' => $_POST['tricycle_cin_number_id'] ?? '',
        'driver_id' => $_POST['driver_id'] ?? '',
        'lto_cr_no' => $_POST['lto_cr_no'] ?? '',
        'lto_or_no' => $_POST['lto_or_no'] ?? '',
        'driver_license_no' => $_POST['driver_license_no'] ?? '','driver_license_expiry_date' => $_POST['driver_license_expiry_date'] ?? '',
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
            redirect('edit_transfer_of_ownership?appointment_id=' . $appointmentId);
          } else {
            set_flash_message("Failed to delete the image.", "error");
            redirect('edit_transfer_of_ownership?appointment_id=' . $appointmentId);
          }
        } else {
          set_flash_message("File not found. Image may have been deleted already.", "error");
          redirect('edit_transfer_of_ownership?appointment_id=' . $appointmentId);
        }
      }

      if (isset($_POST['update_transfer_of_ownership'])) {
        $formErrors = $this->validateAppointmentAndTricycleFormData($appointmentFormData, $tricycleApplicationFormData, $appointmentModel, $tricycleApplicationModel,  $availableCinNumbers);

        if (!empty($formErrors)) {
          $firstError = reset($formErrors);
          set_flash_message($firstError[0], "error");
          $data = array_merge($data, $_POST);
          echo $this->renderView('edit_transfer_of_ownership', true, $data);
          return;
        } else {
          $formattedPhoneNumber = $appointmentFormData['phone_number'];
          $appointmentFormData['phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);

          // Check if the appointment status is "REJECTED"
          if ($_POST['status'] != 'Rejected') {
            // Update comments to empty for rejected appointments
            $appointmentFormData['comments'] = '';
          }

          $formattedPhoneNumber = $tricycleApplicationFormData['tricycle_phone_number'];
          $tricycleApplicationFormData['tricycle_phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);

          $mtopRequirementFormData = [
            'mc_lto_certificate_of_registration_path' => '',
            'mc_lto_official_receipt_path' => '',
            'mc_plate_authorization_path' => '',
            'tc_insurance_policy_path' => '',
            'latest_franchise_path' => '',
            'proof_of_id_path' => '',
            'sketch_location_of_garage_path' => '',
            'affidavit_of_income_tax_return_path' => '',
            'unit_front_view_image_path' => '',
            'unit_side_view_image_path' => '',
            'driver_cert_safety_driving_seminar_path' => '',
          ];

          $fileUploads = $this->handleFileUploads($mtopRequirementFormData);

          if ($appointmentModel->update(['appointment_id' => $appointmentId], $appointmentFormData) && $tricycleApplicationModel->update(['appointment_id' => $appointmentId], $tricycleApplicationFormData)) {

            if (!empty($fileUploads)) {
              $mtopRequirementModel->update(['mtop_requirement_id' => $mtopRequirementId], $fileUploads);
            }

            if ($appointmentFormData['status'] === 'Completed') {
              $tricycleModel = new Tricycle();
              $tricycleData = $tricycleModel->first(['cin_id' => $tricycleApplicationData->tricycle_cin_number_id]);

              if (!empty($tricycleData)) {
                $previousTricycleApplicationId = $tricycleData->tricycle_application_id;
          
                $tricycleUpdateData = [
                  'tricycle_application_id' => $tricycleApplicationData->tricycle_application_id,
                  'previous_tricycle_application_id' => $previousTricycleApplicationId,
                  'mtop_requirements_transfer_ownership_id' => $mtopRequirementId,
                  'user_id' => $appointmentData->user_id,
                ];
        
                $tricycleModel->update(['tricycle_id' => $tricycleData->tricycle_id], $tricycleUpdateData);
              }
            }
          
            $formattedDate = date('F j, Y', strtotime($appointmentFormData['appointment_date']));
            $formattedTime = date('h:i A', strtotime($appointmentFormData['appointment_time']));
            $rootPath = ROOT;

            $customTextMessage = $this->generateCustomTextMessage($appointmentFormData['name'], $formattedDate, $formattedTime, $rootPath);
            $customEmailMessage = $this->generateCustomEmailMessage($formattedDate, $formattedTime);
            $customRequirementMessage = $this->generateCustomRequirementMessage();

            sendAppointmentNotifications($appointmentFormData, $data, $customTextMessage, $customEmailMessage, $customRequirementMessage);

            set_flash_message("Scheduled appointment updated successfully.", "success");
            redirect('appointments');;
          } else {
            set_flash_message("Failed to update scheduled appointment. Please try again later.", "error");
            redirect('appointments');
          }
        }
      }
    }
    echo $this->renderView('edit_transfer_of_ownership', true, $data);
  }

  private function validateAppointmentAndTricycleFormData($appointmentFormData, $tricycleApplicationFormData, $appointmentModel, $tricycleApplicationModel,  $availableCinNumbers) {
    $errors = array();
  
    $appointmentErrors = $appointmentModel->updateValidation($appointmentFormData);
    if (!empty($appointmentErrors)) {
      $errors['appointment'] = $appointmentErrors;
    }

    $tricycleApplicationErrors = $tricycleApplicationModel->validate($tricycleApplicationFormData);
    if (!empty($tricycleApplicationErrors)) {
      $errors['tricycleApplication'] = $tricycleApplicationErrors;
    }

    // Check if the appointment status is "REJECTED"
    if ($appointmentFormData['status'] === 'Rejected') {
      // Require comments for rejected appointments
      $comments = trim($appointmentFormData['comments']);
      if (empty($comments)) {
        $errors['appointment'][] = 'Comments are required for rejected appointments.';
      }
    }
    
    if (empty($tricycleApplicationFormData['tricycle_cin_number_id'])) {
      $errors['tricycleApplication'][] = 'Tricycle CIN is required';
    }

    if (!empty($tricycleApplicationFormData['driver_id'])) {
      if (empty($tricycleApplicationFormData['driver_license_no'])) {
        $errors['tricycleApplication'][] = 'Driver License Number is required';
      } elseif (empty($tricycleApplicationFormData['driver_license_expiry_date'])) {
        $errors['tricycleApplication'][] = 'Driver License Expiry Date is required';
      }
    } elseif (empty($tricycleApplicationFormData['driver_id'])) {
      $errors['tricycleApplication'][] = 'Driver Name is required';
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
    $fileUploads = [];

    foreach ($_FILES as $inputName => $file) {
      $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
      $columnName = $inputName . '_path';
      $targetFile = $uploadDirectory . '_' . $inputName . '.' . $extension;

      if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        $fileUploads[$columnName] = $targetFile;
      }
    }

    return $fileUploads;
  }

  private function generateCustomTextMessage($name, $formattedDate, $formattedTime, $rootPath)
  {
    $message = "Hello {$name},\n\nCongratulations! Your appointment has been successfully approved for {$formattedDate} at {$formattedTime}. We look forward to welcoming you.\n\nTo ensure a smooth process, kindly bring the original documents corresponding to the uploaded images on the MTOP Requirements Images form and prepare the following assessment fees.\n";
    
    // Assessment Fees
    $message .= "\nAssessment of Fees:\n";
    
    $message .= "a. Freezone fee: P400.00\n";
    $message .= "b. Filing Fee: P30.00\n";
    $message .= "Total: P430.00\n\n";

    $message .= "a. Zone 2, 3, & 4: P1000.00\n";
    $message .= "b. Filing Fee: P30.00\n";
    $message .= "Total: P1030.00\n\n";

    $message .= "Please be informed that you are required to prepare the necessary amount in cash for the assessment fees. This will help expedite the processing of your request. Also, below is the list of requirements for Change of Motorcycle.";

    $message .= $this->generateRequirementList();
    $message .= "\nFor more details, please check your appointment details on our website: {$rootPath}";

    return $message;  
  }


  private function generateCustomEmailMessage($formattedDate, $formattedTime)
  {
    $message = "<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>Congratulations! Your appointment has been successfully approved for <strong>{$formattedDate}</strong> at <strong>{$formattedTime}</strong>. We look forward to welcoming you.</div>\n";
    $message .= "<div style='text-align: justify; color:#455056; font-size:15px;line-height:24px; margin:0;'>To ensure a smooth process, kindly bring the original documents corresponding to the uploaded images on the MTOP Requirements Images form and prepare the following assessment fees.</div>";
    $message .= "<br>";

    // Assessment Fees
    $message .= "<div style='margin-top: 10px; text-align: start; color:#455056; font-size:15px; line-height:20px;'><strong>Assessment Fees:</strong></div>";
    
    $message .= "<div style='text-align: start; color:#455056; line-height:24px;'>a. Freezone: P400.00</div>";
    $message .= "<div style='text-align: start; color:#455056; line-height:24px;'>b. Filing Fee: P30.00</div>";
    $message .= "<div style='text-align: start; color:#455056; line-height:24px;'>Total: P430.00</div>";
    $message .= "<br>";

    $message .= "<div style='text-align: start; color:#455056; line-height:24px;'>a. Zone 2, 3, & 4: P1000.00</div>";
    $message .= "<div style='text-align: start; color:#455056; line-height:24px;'>b. Filing Fee: P30.00</div>";

    $message .= "<div style='text-align: start; color:#455056; line-height:24px;'>Total: P1030.00</div>";
    $message .= "<br>";

    // Additional information
    $message .= "<div style='text-align: justify; color:#455056; font-size:15px;line-height:24px; margin:0;'>Please be informed that you are required to prepare the necessary amount in cash for the assessment fees. This will help expedite the processing of your request. Also, below is the list of requirements for Transfer of Ownership.</div>";
    return $message;    
  }

  private function generateCustomRequirementMessage()
  {
    return "<div style='text-align: start; color:#455056'>" . $this->generateRequirementList() . "</div>";
  }

  private function generateRequirementList()
  {
    return "1. LTO Certificate of Registration (MC of New Unit) (2 copies)<br>2. LTO Official Receipt (MC of New Unit) (2 copies)<br>3. Plate authorization (MC of New Unit) (2 copies)<br>4. Insurance Policy (TC) (New Owner) (2 copies)<br>5. Voters ID or Birth Certificate or Baptismal Certificate or Marriage Certificate or Brgy proof of residence (2 copies)<br>6. Sketch Location of Garage (2 copies)<br>7. Affidavit of No Income Or Latest Income Tax Return (2 copies)<br>8. Picture of New Unit (Front view & Side view) (2 copies)<br>9. Driver's Certificate of Safety Driving Seminar (2 copies)<br>10. Latest Franchise (2 copies)";
  }
}