<?php

class Edit_new_franchise_2
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
      redirect('');
    }

    // Define the required permissions for accessing the edit user page
    $requiredPermissions = [
      "Can approve appointments",
      "Can decline appointments",
      "Can on process appointments",
      "Can completed appointments"
    ];

    // Check if the logged-in user has the required permissions, unless they are an operator
    $userPermissions = isset($_SESSION['USER']->permissions) ? explode(', ', $_SESSION['USER']->permissions) : [];
    $userRole = isset($_SESSION['USER']->role) ? $_SESSION['USER']->role : '';
    if (!hasAnyPermission($requiredPermissions, $userPermissions) && $userRole !== 'operator') {
      set_flash_message("Access denied. You don't have the required permissions.", "error");
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
    $tricycleApplicationData = $tricycleApplicationModel->where(['appointment_id' => $appointmentId]);

    $tricycleCinNumberModel = new TricycleCinNumber();
    $selectedUserId = $appointmentData->user_id;

    $tricycleApplicationDataArray = [];
    foreach ($tricycleApplicationData as $key => $data) {
      $tricycleApplicationDataArray[$key] = $data;
    }
    
    if (count($tricycleApplicationDataArray) > 1) {
      foreach ($tricycleApplicationDataArray as $key => $data) {
        $tricycleApplicationDataArray[$key] = $data;
      }
    } else {
      $tricycleApplicationData = reset($tricycleApplicationDataArray);
    }
    
    // Initialize arrays to hold selected and available CIN numbers
    $selectedCinNumbers = [];
    $availableCinNumbers = [];
    
    // Initialize an array to hold CIN numbers by ID
    $cinNumbersById = [];
    
    foreach ($tricycleApplicationData as $tricycleData) {
      $selectedCinNumberId = $tricycleData->tricycle_cin_number_id;
  
      // If tricycle_cin_number_id is set, get the selected CIN number
      if (!empty($selectedCinNumberId)) {
        $selectedCin = $tricycleCinNumberModel->first(['tricycle_cin_number_id' => $selectedCinNumberId]);
        $selectedCinNumbers[] = $selectedCin->cin_number;
      }
  
      // Get all available CIN numbers where is_used is false
      $availableCinNumbers = array_merge($availableCinNumbers, $tricycleCinNumberModel->getAvailableCinNumbers());
    }
    
    // Remove duplicate CIN numbers
    $selectedCinNumbers = array_unique($selectedCinNumbers);
    $availableCinNumbers = array_unique($availableCinNumbers);
    
    // Transform the availableCinNumbers to associate tricycle_cin_number_id with cin_number
    foreach ($availableCinNumbers as $cinNumberId) {
      $cinNumber = $tricycleCinNumberModel->first(['tricycle_cin_number_id' => $cinNumberId])->cin_number;
      $cinNumbersById[$cinNumberId] = $cinNumber;
    }
    
    // Sort the array in ascending order
    asort($cinNumbersById);    

    $mtopRequirementModel = new MtopRequirement();
    $mtopRequirementData = $mtopRequirementModel->where(['appointment_id' => $appointmentId]);

    $mtopRequirementDataArray = []; // Initialize MTOP requirement data array
    foreach ($mtopRequirementData as $key => $data) {
      $mtopRequirementDataArray[$key] = $data;
    }
    
    if (count($mtopRequirementDataArray) > 1) {
      foreach ($mtopRequirementDataArray as $key => $data) {
        $mtopRequirementDataArray[$key] = $data;
      }
    } else {
      $mtopRequirementData = reset($mtopRequirementDataArray);
    }
    
    $data = [
      'name' => $appointmentData->name,
      'phone_number' => $this->formatPhoneNumber($appointmentData->phone_number),
      'email' => $appointmentData->email,
      'appointment_type' => $appointmentData->appointment_type,
      'appointment_date' => $appointmentData->appointment_date,
      'appointment_time' => $appointmentData->appointment_time,
      'status' => $appointmentData->status,
      'comments' => $appointmentData->comments,
      'tricycle_phone_number_1' => isset($tricycleApplicationDataArray[0]) ? $this->formatPhoneNumber($tricycleApplicationDataArray[0]->tricycle_phone_number) : '',
      'tricycle_phone_number_2' => isset($tricycleApplicationDataArray[1]) ? $this->formatPhoneNumber($tricycleApplicationDataArray[1]->tricycle_phone_number) : '',
      'tricycleApplicationData' => $tricycleApplicationDataArray,
      'mtopRequirementData' => $mtopRequirementDataArray,
      'availableCinNumbers' => $cinNumbersById,
      'selectedCinNumberId' => $selectedCinNumberId,
      'selectedCinNumber' => $selectedCinNumbers,
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
        'appointment_time' => date("H:i", strtotime($_POST['appointment_time'])) ?? '',
        'status' => $_POST['status'] ?? $appointmentData->status,
        'comments' => $_POST['comments'] ?? '',
      ];

      $tricycleApplicationFormData1 = [
        'operator_name' => $_POST['operator_name1'] ?? '',
        'tricycle_phone_number' => $_POST['tricycle_phone_number1'] ?? '',
        'address' => $_POST['address1'] ?? '',
        'mtop_no' => $_POST['mtop_no1'] ?? '',
        'route_area' => $_POST['route_area1'] ?? '',
        'color_code' => $_POST['color_code1'] ?? '',
        'make_model' => $_POST['make_model1'] ?? '',
        'make_model_expiry_date' => $_POST['make_model_expiry_date1'] ?? '','make_model_year_acquired' => $_POST['make_model_year_acquired1'] ?? '',
        'motor_number' => $_POST['motor_number1'] ?? '',
        'insurer' => $_POST['insurer1'] ?? '',
        'coc_no' => $_POST['coc_no1'] ?? '',
        'coc_no_expiry_date' => $_POST['coc_no_expiry_date1'] ?? '',
        'tricycle_cin_number_id' => $_POST['tricycle_cin_number_id1'] ?? '',
      ];

      $tricycleApplicationFormData2 = [
        'operator_name' => $_POST['operator_name2'] ?? '',
        'tricycle_phone_number' => $_POST['tricycle_phone_number2'] ?? '',
        'address' => $_POST['address2'] ?? '',
        'mtop_no' => $_POST['mtop_no2'] ?? '',
        'route_area' => $_POST['route_area2'] ?? '',
        'color_code' => $_POST['color_code2'] ?? '',
        'make_model' => $_POST['make_model2'] ?? '',
        'make_model_expiry_date' => $_POST['make_model_expiry_date2'] ?? '','make_model_year_acquired' => $_POST['make_model_year_acquired2'] ?? '',
        'motor_number' => $_POST['motor_number2'] ?? '',
        'insurer' => $_POST['insurer2'] ?? '',
        'coc_no' => $_POST['coc_no2'] ?? '',
        'coc_no_expiry_date' => $_POST['coc_no_expiry_date2'] ?? '',
        'tricycle_cin_number_id' => $_POST['tricycle_cin_number_id2'] ?? '',
      ];

      if (isset($_POST['confirm_delete_image'])) {
        $mtopRequirementId = $_POST['mtop_id'];
        $imageType = $_POST['image_type'];
        $originalImagePath = $_POST['original_image_path'];

        if (file_exists($originalImagePath)) {
          $deleted = unlink($originalImagePath);

          if ($deleted) {
            $imagePathColumn = $imageType . '_path';
            $mtopRequirementModel->update(['mtop_requirement_id' => $mtopRequirementId], [$imagePathColumn => null]);
            set_flash_message("Image deleted successfully.", "success");
            redirect('edit_new_franchise_2?appointment_id=' . $appointmentId);
          } else {
            set_flash_message("Failed to delete the image.", "error");
            redirect('edit_new_franchise_2?appointment_id=' . $appointmentId);
          }
        } else {
          set_flash_message("File not found. Image may have been deleted already.", "error");
          redirect('edit_new_franchise_2?appointment_id=' . $appointmentId);
        }
      }
      
      if (isset($_POST['update_new_franchise'])) {
        $formErrors = $this->validateAppointmentAndTricycleFormData($appointmentFormData, $tricycleApplicationFormData1, $tricycleApplicationFormData2, $appointmentModel, $tricycleApplicationModel,  $availableCinNumbers);

        if (!empty($formErrors)) {
          $firstError = reset($formErrors);
          set_flash_message($firstError[0], "error");
          // $data = array_merge($data, $_POST);
          echo $this->renderView('edit_new_franchise_2', true, $data);
          return;
        } else {
          $formattedPhoneNumber = $appointmentFormData['phone_number'];
          $appointmentFormData['phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);

          // Check if the appointment status is "REJECTED"
          if ($appointmentFormData['status'] != 'Declined') {
            // Update comments to empty for declined appointments
            $appointmentFormData['comments'] = '';
          }

          $formattedPhoneNumber1 = $tricycleApplicationFormData1['tricycle_phone_number'];
          $tricycleApplicationFormData1['tricycle_phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber1);

          $formattedPhoneNumber2 = $tricycleApplicationFormData2['tricycle_phone_number'];
          $tricycleApplicationFormData2['tricycle_phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber2);

          $mtopRequirementFormData = [
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
      
          $fileUploads1 = $this->handleFileUploads($mtopRequirementFormData, '1');
          $fileUploads2 = $this->handleFileUploads($mtopRequirementFormData, '2');

          if ($appointmentModel->update(['appointment_id' => $appointmentId], $appointmentFormData) && $tricycleApplicationModel->update(['tricycle_application_id' => $tricycleApplicationDataArray[0]->tricycle_application_id], $tricycleApplicationFormData1) && $tricycleApplicationModel->update(['tricycle_application_id' => $tricycleApplicationDataArray[1]->tricycle_application_id], $tricycleApplicationFormData2)) {
            if (!empty($fileUploads1) && !empty($fileUploads2)) {
              $mtopRequirementModel->update(['mtop_requirement_id' => $mtopRequirementDataArray[0]->mtop_requirement_id], $fileUploads1);
              $mtopRequirementModel->update(['mtop_requirement_id' => $mtopRequirementDataArray[1]->mtop_requirement_id], $fileUploads2);
            }

            // Get the selected tricycle_cin_number_id
            $selectedCinNumberId1 = $tricycleApplicationFormData1['tricycle_cin_number_id'];
            $selectedCinNumberId2 = $tricycleApplicationFormData2['tricycle_cin_number_id'];

            // Check if tricycle_cin_number_id is not empty and is in the availableCinNumbers
            if (!empty($selectedCinNumberId1) && in_array($selectedCinNumberId1, $availableCinNumbers)) {
              // Update the tricycle_cin_numbers table
              $tricycleCinNumberModel->update(['tricycle_cin_number_id' => $selectedCinNumberId1], [
                'is_used' => true,
                'user_id' => $appointmentData->user_id,
                'ownership_date' => date('Y-m-d'),
              ]);
            }

            if (!empty($selectedCinNumberId2) && in_array($selectedCinNumberId2, $availableCinNumbers)) {
              // Update the tricycle_cin_numbers table
              $tricycleCinNumberModel->update(['tricycle_cin_number_id' => $selectedCinNumberId2], [
                'is_used' => true,
                'user_id' => $appointmentData->user_id,
                'ownership_date' => date('Y-m-d'),
              ]);
            }

            // Update the previous selected CIN number
            if (!empty($selectedCinNumberId1) && !empty($tricycleApplicationDataArray[0]->tricycle_cin_number_id) &&
            $selectedCinNumberId1 != $tricycleApplicationDataArray[0]->tricycle_cin_number_id) {
              // Update the previous tricycle_cin_numbers entry
              $tricycleCinNumberModel->update(['tricycle_cin_number_id' => $tricycleApplicationDataArray[0]->tricycle_cin_number_id], [
                'is_used' => false,
                'user_id' => null,
                'ownership_date' => null, 
              ]);
            }

            if (!empty($selectedCinNumberId2) && !empty($tricycleApplicationDataArray[1]->tricycle_cin_number_id) &&
            $selectedCinNumberId2 != $tricycleApplicationDataArray[1]->tricycle_cin_number_id) {
              // Update the previous tricycle_cin_numbers entry
              $tricycleCinNumberModel->update(['tricycle_cin_number_id' => $tricycleApplicationDataArray[1]->tricycle_cin_number_id], [
                'is_used' => false,
                'user_id' => null,
                'ownership_date' => null, 
              ]);
            }

            if ($appointmentFormData['status'] == 'Completed') {
              $tricycleModel = new Tricycle();
              $tricycleStatusesModel = new TricycleStatuses;

              $tricycleData1 = [
                'cin_id' =>  $tricycleApplicationDataArray[0]->tricycle_cin_number_id,
                'tricycle_application_id' => $tricycleApplicationDataArray[0]->tricycle_application_id,
                'mtop_requirements_new_franchise_id' => $mtopRequirementDataArray[0]->mtop_requirement_id,
                'user_id' => $appointmentData->user_id,
              ];

              $tricycleData2 = [
                'cin_id' =>  $tricycleApplicationDataArray[1]->tricycle_cin_number_id,
                'tricycle_application_id' => $tricycleApplicationDataArray[1]->tricycle_application_id,
                'mtop_requirements_new_franchise_id' => $mtopRequirementDataArray[1]->mtop_requirement_id,
                'user_id' => $appointmentData->user_id,
              ];

              if ($tricycleModel->insert($tricycleData1)) {
                $tricycleId = $tricycleModel->getLastInsertedRecord()[0]->tricycle_id;
                $tricycleStatusesModel->insert(['tricycle_id' => $tricycleId, 'user_id' => $appointmentData->user_id, 'status' => 'Active']);

                if ($tricycleModel->insert($tricycleData2)) {
                  $tricycleId2 = $tricycleModel->getLastInsertedRecord()[0]->tricycle_id;
                  $tricycleStatusesModel->insert(['tricycle_id' => $tricycleId2, 'user_id' => $appointmentData->user_id, 'status' => 'Active']);
                }
              }
            }

            $cinNumbers = [];

            // Iterate through each element in the tricycleApplicationDataArray
            foreach ($tricycleApplicationDataArray as $applicationData) {
              $cinNumber = null;
          
              if ($applicationData->tricycle_cin_number_id) {
                $cinDataForNotifs = $tricycleCinNumberModel->first(['tricycle_cin_number_id' => $applicationData->tricycle_cin_number_id]);
                $cinNumber = $cinDataForNotifs ? $cinDataForNotifs->cin_number : null;
              }
          
              // Store the CIN number in the array
              $cinNumbers[] = $cinNumber;
            }
            
            // Get the first three CIN numbers
            list($cinNumber1, $cinNumber2) = array_pad($cinNumbers, 2, null);
            
            if ($cinNumber1 === null) {
              $cinNumber1 = $tricycleApplicationFormData1['tricycle_cin_number_id'];
            }
            if ($cinNumber2 === null) {
              $cinNumber2 = $tricycleApplicationFormData2['tricycle_cin_number_id'];
            }

            // Format date and time
            $formattedDate = date('F j, Y', strtotime($appointmentFormData['appointment_date']));
            $formattedTime = date('h:i A', strtotime($appointmentFormData['appointment_time']));
            $rootPath = ROOT;
            
            // Generate custom text messages
            $customTextMessage = $this->generateCustomTextMessage($appointmentFormData['name'], $appointmentFormData['appointment_type'], $formattedDate, $formattedTime, $rootPath, [$cinNumber1, $cinNumber2]);
            
            $customEmailMessage = $this->generateCustomEmailMessage($formattedDate, $formattedTime, $appointmentFormData['appointment_type'], [$cinNumber1, $cinNumber2]);
            
            $customRequirementMessage = $this->generateCustomRequirementMessage();
            
            sendAppointmentNotifications($appointmentFormData, $data, $tricycleApplicationFormData1, [$cinNumber1, $cinNumber2], $customTextMessage, $customEmailMessage, $customRequirementMessage);

            set_flash_message("Scheduled appointment updated successfully.", "success");
            redirect('appointments');
          } else {
            set_flash_message("Failed to update scheduled appointment. Please try again later.", "error");
            redirect('appointments');
          }
        }
      }
    }

    echo $this->renderView('edit_new_franchise_2', true, $data);
  }

  private function validateAppointmentAndTricycleFormData($appointmentFormData, $tricycleApplicationFormData1, $tricycleApplicationFormData2, $appointmentModel, $tricycleApplicationModel,  $availableCinNumbers) {
    $errors = array();
    $appointmentErrors = $appointmentModel->updateValidation($appointmentFormData);

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

    if ($appointmentFormData['status'] === 'Declined') {
      // Require comments for declined appointments
      $comments = trim($appointmentFormData['comments']);
      if (empty($comments)) {
        $errors['appointment'][] = 'Comments are required for declined appointments.';
      }
    }

    if ($_SESSION['USER']->role === 'admin'){
      if ($appointmentFormData['status'] === 'Completed' || $appointmentFormData['status'] === 'Approved') {
        $cinNumber1 = ($tricycleApplicationFormData1['tricycle_cin_number_id']);
        $cinNumber2 = ($tricycleApplicationFormData2['tricycle_cin_number_id']);
        if (empty($cinNumber1)) {
          $errors['tricycleApplication1'][] = 'Tricycle CIN number is required and must <br> be selected from the available options to <br> update this appointment request.';
        } else if (empty($cinNumber2)) {
          $errors['tricycleApplication2'][] = 'Tricycle CIN number is required and must <br> be selected from the available options to <br> update this appointment request.';
        }
      }
    }

    return $errors;
  }

  private function formatPhoneNumber($phoneNumber) {
    return preg_replace('/[^0-9]/', '', str_replace('+63', '', $phoneNumber));
  }

  private function handleFileUploads($mtopRequirementFormData, $suffix)
  {
    $uniqueId = uniqid();
    $uploadDirectory = 'public/uploads/mtop_requirements_images/' . $uniqueId;

    $fileUploads = [];
  
    foreach ($_FILES as $inputName => $file) {
      if (strpos($inputName, $suffix) !== false) {
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $columnName = str_replace($suffix, '', $inputName) . '_path';
        $targetFile = $uploadDirectory . '_' . $inputName . '.' . $extension;
  
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
          $fileUploads[$columnName] = $targetFile;
        } else {
          return ['success' => false, 'error' => 'Failed to upload files. Please try again later.'];
        }
      }
    }
  
    return $fileUploads;
  }

  private function generateCustomTextMessage($name, $appointment_type, $formattedDate, $formattedTime, $rootPath, $cinNumbers)
  {
    $feeMessage = $this->generateFeeMessage($cinNumbers);
  
    $message = "Hello {$name},\n\nCongratulations! Your {$appointment_type} appointment for tricycle CIN #" . implode(', #', $cinNumbers) . " has been successfully approved for {$formattedDate} at {$formattedTime}. We look forward to welcoming you.\n\n";
  
    if (!empty($feeMessage)) {
      $message .= "To ensure a smooth process, kindly be informed that a processing fee " . $feeMessage . " and please bring the original documents corresponding to the uploaded images on the Mtop Requirements Images form. Below is a list of requirements for New Franchise.\n";
    } else {
      $message .= "To ensure a smooth process, please bring the original documents corresponding to the uploaded images on the Mtop Requirements Images form. Below is a list of requirements for New Franchise.\n";
    }
  
    $message .= $this->generateRequirementList();
    $message .= "\nFor more details, please check your appointment details on our website: {$rootPath}";
  
    return $message;
  }
  
  private function generateCustomEmailMessage($formattedDate, $formattedTime, $appointment_type, $cinNumbers)
  {
    $feeMessage = $this->generateFeeMessage($cinNumbers);
  
    $message = "<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>Congratulations! Your {$appointment_type} appointment for tricycle CIN #" . implode(', #', $cinNumbers) . " has been successfully approved for <strong>{$formattedDate}</strong> at <strong>{$formattedTime}</strong>. We look forward to welcoming you.</div>\n";
  
    if (!empty($feeMessage)) {
      $message .= "<div style='text-align: justify; color:#455056; font-size:15px;line-height:24px; margin:0;'>To ensure a smooth process, kindly be informed that a processing fee " . $feeMessage . " and please bring the original documents corresponding to the uploaded images on the MTOP Requirements Images form. Below is a list of requirements for New Franchise. </div>";
    } else {
      $message .= "<div style='text-align: justify; color:#455056; font-size:15px;line-height:24px; margin:0;'>To ensure a smooth process, please bring the original documents corresponding to the uploaded images on the MTOP Requirements Images form. Below is a list of requirements for New Franchise. </div>";
    }
  
    return $message;
  }
  
  private function generateFeeMessage($cinNumbers)
  {
    $fees = [];
    $totalFee = 0; // Initialize total fee
    foreach ($cinNumbers as $cinNumber) {
      $routeArea = $this->getRouteAreaByCin($cinNumber);
      $fee = ($routeArea === 'Free Zone / Zone 1') ? 43000 : 103000; // Represent fees in cents to avoid float precision issues
      $totalFee += $fee; // Add fee to total
      $fees[] = "for CIN #{$cinNumber} of ₱" . number_format($fee / 100, 2); // Format fee for display
    }

    $feeMessage = implode(', ', $fees);
    $totalFeeInPeso = number_format($totalFee / 100, 2); // Convert total fee back to peso format
    return "{$feeMessage} with a total of ₱{$totalFeeInPeso} is required for your appointment and please";
  }
  
  private function generateCustomRequirementMessage()
  {
    return "<div style='text-align: justify; color:#455056; font-size:15px;line-height:24px; margin:0;'>" . $this->generateRequirementList() . "</div>";
  }
  
  private function generateRequirementList()
  {
    return "1. LTO Certificate of Registration (MC of New Unit) (2 copies)<br>2. LTO Official Receipt (MC of New Unit) (2 copies)<br>3. Plate authorization (MC of New Unit) (2 copies)<br>4. Insurance Policy (TC) (New Owner) (2 copies)<br>5. Voters ID or Birth Certificate or Baptismal Certificate or Marriage Certificate or Brgy proof of residence (2 copies)<br>6. Sketch Location of Garage (2 copies)<br>7. Affidavit of No Income Or Latest Income Tax Return (2 copies)<br>8. Picture of New Unit (Front view & Side view) (2 copies)<br>9. Driver's Certificate of Safety Driving Seminar (2 copies)<br>10. Brown long envelope (1 pc.)";
  }
  
  private function getRouteAreaByCin($cinNumber)
  {
    $tricycleApplicationModel = new TricycleApplication();
    $appointmentId = isset($_GET['appointment_id']) ? $_GET['appointment_id'] : null;
    $cinData = $tricycleApplicationModel->first(['tricycle_cin_number_id' => $cinNumber, 'appointment_id' => $appointmentId]);
    return $cinData ? $cinData->route_area : null;
  }
}