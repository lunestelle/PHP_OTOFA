<?php

class Edit_transfer_of_ownership_2
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

    $selectedUserId = $appointmentData->user_id;
    
    $tricycleApplicationData = $tricycleApplicationModel->where(['appointment_id' => $appointmentId]);

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

    // Prepare an array to hold driver data for each tricycle application
    $driverDataArray = [];
    foreach ($tricycleApplicationData as $applicationData) {
      $selectedCinNumber = $applicationData->tricycle_cin_number_id;
      $cinData = $tricycleCinNumberModel->first(['tricycle_cin_number_id' => $selectedCinNumber]);
      $cin_number = $cinData->cin_number;

      $query = "SELECT drivers.* FROM drivers JOIN driver_statuses ON drivers.driver_id = driver_statuses.driver_id WHERE drivers.tricycle_cin_number_id = :tricycle_cin_id AND driver_statuses.status = 'Active'";
      $driverData = $driverModel->query($query, [':tricycle_cin_id' => $cinData->tricycle_cin_number_id]);

      if (!empty($driverData)) {
        $driver = $driverData[0];
        $driverInfo = [
          'driver_name' => $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name,
          'driver_license_no' => $driver->license_no,
          'driver_license_expiry_date' => $driver->license_expiry_date,
          'cin_number' => $cin_number,
        ];
      } else {
        $driverInfo = [
          'driver_name' => 'Selected CIN has no driver',
          'driver_license_no' => '',
          'driver_license_expiry_date' => '',
          'cin_number' => $cin_number,
        ];
      }

      $driverDataArray[] = $driverInfo;
    }

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
      'transfer_type' => $appointmentData->transfer_type,
      'appointment_date' => $appointmentData->appointment_date,
      'appointment_time' => $appointmentData->appointment_time,
      'status' => $appointmentData->status,
      'comments' => $appointmentData->comments,
      'driverDataArray' => $driverDataArray,
      'tricycleApplicationData' => $tricycleApplicationDataArray,
      'mtopRequirementData' => $mtopRequirementDataArray,
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
        'make_model_expiry_date' => $_POST['make_model_expiry_date1'] ?? '',
        'make_model_year_acquired' => $_POST['make_model_year_acquired1'] ?? '',
        'motor_number' => $_POST['motor_number1'] ?? '',
        'insurer' => $_POST['insurer1'] ?? '',
        'coc_no' => $_POST['coc_no1'] ?? '',
        'coc_no_expiry_date' => $_POST['coc_no_expiry_date1'] ?? '',
        'tricycle_cin_number_id' => $_POST['tricycle_cin_number_id1'] ?? '',
        'driver_id' => $_POST['driver_id1'] ?? '',
        'lto_cr_no' => $_POST['lto_cr_no1'] ?? '',
        'lto_or_no' => $_POST['lto_or_no1'] ?? '',
        'driver_license_no' => $_POST['driver_license_no1'] ?? '',
        'driver_license_expiry_date' => $_POST['driver_license_expiry_date1'] ?? '',
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
        'tricycle_cin_number_id' => $_POST['tricycle_cin_number_id2'] ?? '',
        'driver_id' => $_POST['driver_id2'] ?? '',
        'lto_cr_no' => $_POST['lto_cr_no2'] ?? '',
        'lto_or_no' => $_POST['lto_or_no2'] ?? '',
        'driver_license_no' => $_POST['driver_license_no2'] ?? '',
        'driver_license_expiry_date' => $_POST['driver_license_expiry_date2'] ?? '',
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

      if (isset($_POST['update_transfer_of_ownership'])) {
        $formErrors = $this->validateAppointmentAndTricycleFormData($appointmentFormData, $tricycleApplicationFormData1, $tricycleApplicationFormData2, $appointmentModel, $tricycleApplicationModel);

        if (!empty($formErrors)) {
          $firstError = reset($formErrors);
          set_flash_message($firstError[0], "error");
          // $data = array_merge($data, $_POST);
          echo $this->renderView('edit_transfer_of_ownership_2', true, $data);
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
            'latest_franchise_path' => '',
            'proof_of_id_path' => '',
            'sketch_location_of_garage_path' => '',
            'affidavit_of_income_tax_return_path' => '',
            'unit_front_view_image_path' => '',
            'unit_side_view_image_path' => '',
            'driver_cert_safety_driving_seminar_path' => '',
          ];

          $fileUploads1 = $this->handleFileUploads($mtopRequirementFormData, '1');
          $fileUploads2 = $this->handleFileUploads($mtopRequirementFormData, '2');

          if ($appointmentModel->update(['appointment_id' => $appointmentId], $appointmentFormData) && $tricycleApplicationModel->update(['tricycle_application_id' => $tricycleApplicationDataArray[0]->tricycle_application_id], $tricycleApplicationFormData1) && $tricycleApplicationModel->update(['tricycle_application_id' => $tricycleApplicationDataArray[1]->tricycle_application_id], $tricycleApplicationFormData2)) {

            if (!empty($fileUploads1) && !empty($fileUploads2)) {
              $mtopRequirementModel->update(['mtop_requirement_id' => $mtopRequirementDataArray[0]->mtop_requirement_id], $fileUploads1);
              $mtopRequirementModel->update(['mtop_requirement_id' => $mtopRequirementDataArray[1]->mtop_requirement_id], $fileUploads2);
            }

            if ($appointmentFormData['status'] === 'Completed') {
              $tricycleModel = new Tricycle();
              $tricycleData1 = $tricycleModel->first(['cin_id' => $tricycleApplicationDataArray[0]->tricycle_cin_number_id]);

              $tricycleData2 = $tricycleModel->first(['cin_id' => $tricycleApplicationDataArray[1]->tricycle_cin_number_id]);

              if (!empty($tricycleData1)) {
                $previousTricycleApplicationId1 = $tricycleData1->tricycle_application_id;
          
                $tricycleUpdateData1 = [
                  'tricycle_application_id' => $tricycleApplicationDataArray[0]->tricycle_application_id,
                  'previous_tricycle_application_id' => $previousTricycleApplicationId1,
                  'mtop_requirements_transfer_ownership_id' =>  $mtopRequirementDataArray[0]->mtop_requirement_id,
                  'user_id' => $appointmentData->user_id,
                ];
        
                $tricycleModel->update(['tricycle_id' => $tricycleData1->tricycle_id], $tricycleUpdateData1);
              }

              if (!empty($tricycleData2)) {
                $previousTricycleApplicationId2 = $tricycleData2->tricycle_application_id;
          
                $tricycleUpdateData2 = [
                  'tricycle_application_id' => $tricycleApplicationDataArray[1]->tricycle_application_id,
                  'previous_tricycle_application_id' => $previousTricycleApplicationId2,
                  'mtop_requirements_transfer_ownership_id' =>  $mtopRequirementDataArray[1]->mtop_requirement_id,
                  'user_id' => $appointmentData->user_id,
                ];
        
                $tricycleModel->update(['tricycle_id' => $tricycleData2->tricycle_id], $tricycleUpdateData2);
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
    echo $this->renderView('edit_transfer_of_ownership_2', true, $data);
  }

  private function validateAppointmentAndTricycleFormData($appointmentFormData, $tricycleApplicationFormData1, $tricycleApplicationFormData2, $appointmentModel, $tricycleApplicationModel) {
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

    // Check if the appointment status is "REJECTED"
    if ($appointmentFormData['status'] === 'Declined') {
      // Require comments for declined appointments
      $comments = trim($appointmentFormData['comments']);
      if (empty($comments)) {
        $errors['appointment'][] = 'Comments are required for declined appointments.';
      }
    }
    
    if (empty($tricycleApplicationFormData1['tricycle_cin_number_id'])) {
      $errors['tricycleApplication1'][] = 'Tricycle CIN is required';
    }

    if (!empty($tricycleApplicationFormData1['tricycle_cin_number_id'])) {
      $cinId = $tricycleApplicationFormData1['tricycle_cin_number_id'];
      $appointmentId = $appointmentData->appointment_id;
      $appointmentType = $appointmentFormData['appointment_type'];
      $currentYear = date('Y');
      $statuses = ['Approved', 'Pending', 'On Process'];
  
      $statusPlaceholders = implode(',', array_fill(0, count($statuses), '?'));
  
      $query = "SELECT COUNT(*) AS appointment_count 
                FROM appointments 
                INNER JOIN tricycle_applications 
                ON appointments.appointment_id = tricycle_applications.appointment_id 
                WHERE tricycle_applications.tricycle_cin_number_id = ? 
                AND YEAR(appointments.appointment_date) = ? 
                AND appointments.status IN ($statusPlaceholders)";
  
      $params = array_merge([$cinId, $currentYear], $statuses);
  
      $result = $appointmentModel->query($query, $params);
  
      if (!empty($result) && $result[0]->appointment_count > 0) {
          $query = "SELECT appointments.status, appointments.appointment_date, appointments.appointment_type 
                    FROM appointments 
                    INNER JOIN tricycle_applications 
                    ON appointments.appointment_id = tricycle_applications.appointment_id 
                    WHERE tricycle_applications.tricycle_cin_number_id = ? 
                    AND YEAR(appointments.appointment_date) = ? 
                    AND appointments.appointment_type = ? 
                    AND appointments.appointment_id != ? 
                    AND appointments.status IN ($statusPlaceholders)";
  
          $params = array_merge([$cinId, $currentYear, $appointmentType, $appointmentId], $statuses);
  
          $appointmentResult = $appointmentModel->query($query, $params);
  
          if (!empty($appointmentResult) && isset($appointmentResult[0])) {
              $tricycleCinModel = new TricycleCinNumber();
              $cinDataValidation = $tricycleCinModel->first(['tricycle_cin_number_id' => $cinId]);
  
              // Check if the CIN belongs to the same owner as in the first appointment record
              $cinNumber = $cinDataValidation->cin_number;
              $type = $appointmentResult[0]->appointment_type;
              $appointmentStatus = $appointmentResult[0]->status;
              $appointmentDate = date('F j, Y', strtotime($appointmentResult[0]->appointment_date));
              $errors['tricycleApplication1'][] = "There is an existing $type appointment for this tricycle CIN #$cinNumber with appointment <br> status '$appointmentStatus' and appointment date on $appointmentDate.";
          }
      }
    }

    if (!empty($tricycleApplicationFormData1['driver_id'])) {
      if (empty($tricycleApplicationFormData1['driver_license_no'])) {
        $errors['tricycleApplication1'][] = 'Driver License Number is required';
      } elseif (empty($tricycleApplicationFormData1['driver_license_expiry_date'])) {
        $errors['tricycleApplication1'][] = 'Driver License Expiry Date is required';
      }
    } elseif (empty($tricycleApplicationFormData1['driver_id'])) {
      $errors['tricycleApplication1'][] = 'Driver Name is required';
    }

    if (empty($tricycleApplicationFormData2['tricycle_cin_number_id'])) {
      $errors['tricycleApplication2'][] = 'Tricycle CIN is required';
    }

    if (!empty($tricycleApplicationFormData2['tricycle_cin_number_id'])) {
      $cinId = $tricycleApplicationFormData2['tricycle_cin_number_id'];
      $appointmentId = $appointmentData->appointment_id;
      $appointmentType = $appointmentFormData['appointment_type'];
      $currentYear = date('Y');
      $statuses = ['Approved', 'Pending', 'On Process'];
  
      $statusPlaceholders = implode(',', array_fill(0, count($statuses), '?'));
  
      $query = "SELECT COUNT(*) AS appointment_count 
                FROM appointments 
                INNER JOIN tricycle_applications 
                ON appointments.appointment_id = tricycle_applications.appointment_id 
                WHERE tricycle_applications.tricycle_cin_number_id = ? 
                AND YEAR(appointments.appointment_date) = ? 
                AND appointments.status IN ($statusPlaceholders)";
  
      $params = array_merge([$cinId, $currentYear], $statuses);
  
      $result = $appointmentModel->query($query, $params);
  
      if (!empty($result) && $result[0]->appointment_count > 0) {
          $query = "SELECT appointments.status, appointments.appointment_date, appointments.appointment_type 
                    FROM appointments 
                    INNER JOIN tricycle_applications 
                    ON appointments.appointment_id = tricycle_applications.appointment_id 
                    WHERE tricycle_applications.tricycle_cin_number_id = ? 
                    AND YEAR(appointments.appointment_date) = ? 
                    AND appointments.appointment_type = ? 
                    AND appointments.appointment_id != ? 
                    AND appointments.status IN ($statusPlaceholders)";
  
          $params = array_merge([$cinId, $currentYear, $appointmentType, $appointmentId], $statuses);
  
          $appointmentResult = $appointmentModel->query($query, $params);
  
          if (!empty($appointmentResult) && isset($appointmentResult[0])) {
              $tricycleCinModel = new TricycleCinNumber();
              $cinDataValidation = $tricycleCinModel->first(['tricycle_cin_number_id' => $cinId]);
  
              // Check if the CIN belongs to the same owner as in the first appointment record
              $cinNumber = $cinDataValidation->cin_number;
              $type = $appointmentResult[0]->appointment_type;
              $appointmentStatus = $appointmentResult[0]->status;
              $appointmentDate = date('F j, Y', strtotime($appointmentResult[0]->appointment_date));
              $errors['tricycleApplication2'][] = "There is an existing $type appointment for this tricycle CIN #$cinNumber with appointment <br> status '$appointmentStatus' and appointment date on $appointmentDate.";
          }
      }
    }

    if (!empty($tricycleApplicationFormData2['driver_id'])) {
      if (empty($tricycleApplicationFormData2['driver_license_no'])) {
        $errors['tricycleApplication2'][] = 'Driver License Number is required';
      } elseif (empty($tricycleApplicationFormData2['driver_license_expiry_date'])) {
        $errors['tricycleApplication2'][] = 'Driver License Expiry Date is required';
      }
    } elseif (empty($tricycleApplicationFormData2['driver_id'])) {
      $errors['tricycleApplication2'][] = 'Driver Name is required';
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
    return "1. LTO Certificate of Registration (MC of New Unit) (2 copies)<br>2. LTO Official Receipt (MC of New Unit) (2 copies)<br>3. Plate authorization (MC of New Unit) (2 copies)<br>4. Insurance Policy (TC) (New Owner) (2 copies)<br>5. Voters ID or Birth Certificate or Baptismal Certificate or Marriage Certificate or Brgy proof of residence (2 copies)<br>6. Sketch Location of Garage (2 copies)<br>7. Affidavit of No Income Or Latest Income Tax Return (2 copies)<br>8. Picture of New Unit (Front view & Side view) (2 copies)<br>9. Driver's Certificate of Safety Driving Seminar (2 copies)<br>10. Latest Franchise (2 copies)";
  }

  private function getRouteAreaByCin($cinNumber)
  {
    $tricycleApplicationModel = new TricycleApplication();
    $appointmentId = isset($_GET['appointment_id']) ? $_GET['appointment_id'] : null;
    $cinData = $tricycleApplicationModel->first(['tricycle_cin_number_id' => $cinNumber, 'appointment_id' => $appointmentId]);
    return $cinData ? $cinData->route_area : null;
  }
}