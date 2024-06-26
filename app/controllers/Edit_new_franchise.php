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
      $tricycleApplicationData = $tricycleApplicationModel->first(['appointment_id' => $appointmentId]);

      $tricycleCinNumberModel = new TricycleCinNumber();
      $selectedUserId = $appointmentData->user_id;
      $selectedCinNumberId = $tricycleApplicationData->tricycle_cin_number_id;

      // If tricycle_cin_number_id is set, get the selected CIN number and other available CIN numbers
      if (!empty($selectedCinNumberId)) {
        $selectedCin = $tricycleCinNumberModel->first(['tricycle_cin_number_id' => $selectedCinNumberId]);
        $selectedCinNumber = $selectedCin->cin_number;
        $availableCinNumbers = $tricycleCinNumberModel->getAvailableCinNumbers();
      } else {
        // If tricycle_cin_number_id is not set, show all available CIN numbers where is_used is false
        $availableCinNumbers = $tricycleCinNumberModel->getAvailableCinNumbers();
        $selectedCinNumber = null; // No pre-selected CIN number
      }

      // Transform the availableCinNumbers to associate tricycle_cin_number_id with cin_number
      $cinNumbersById = [];
      foreach ($availableCinNumbers as $cinNumberId) {
        $cinNumber = $tricycleCinNumberModel->first(['tricycle_cin_number_id' => $cinNumberId])->cin_number;
        $cinNumbersById[$cinNumberId] = $cinNumber;
      }

      // Sort the array in ascending order
      asort($cinNumbersById);

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
        'mtop_requirement_id' => $mtopRequirementId,
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
        'availableCinNumbers' => $cinNumbersById,
        'selectedCinNumberId' => $selectedCinNumberId,
        'selectedCinNumber' => $selectedCinNumber,
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
          $formErrors = $this->validateAppointmentAndTricycleFormData($appointmentFormData, $tricycleApplicationFormData, $appointmentModel, $tricycleApplicationModel,  $availableCinNumbers);

          if (!empty($formErrors)) {
            $firstError = reset($formErrors);
            set_flash_message($firstError[0], "error");
            // $data = array_merge($data, $_POST);
            echo $this->renderView('edit_new_franchise', true, $data);
            return;
          } else {
            $formattedPhoneNumber = $appointmentFormData['phone_number'];
            $appointmentFormData['phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);

            // Check if the appointment status is "REJECTED"
            if ($appointmentFormData['status'] != 'Declined') {
              // Update comments to empty for declined appointments
              $appointmentFormData['comments'] = '';
            }

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

            if ($appointmentModel->update(['appointment_id' => $appointmentId], $appointmentFormData) && $tricycleApplicationModel->update(['appointment_id' => $appointmentId], $tricycleApplicationFormData)) {
              if (!empty($fileUploads)) {
                $mtopRequirementModel->update(['mtop_requirement_id' => $mtopRequirementId], $fileUploads);
              }

              // Get the selected tricycle_cin_number_id
              $selectedCinNumberId = $tricycleApplicationFormData['tricycle_cin_number_id'];

              // Check if tricycle_cin_number_id is not empty and is in the availableCinNumbers
              if (!empty($selectedCinNumberId) && in_array($selectedCinNumberId, $availableCinNumbers)) {
                // Update the tricycle_cin_numbers table
                $tricycleCinNumberModel->update(['tricycle_cin_number_id' => $selectedCinNumberId], [
                  'is_used' => true,
                  'user_id' => $appointmentData->user_id,
                  'ownership_date' => date('Y-m-d'),
                ]);
              }

              // Update the previous selected CIN number
              if (!empty($selectedCinNumberId) && !empty($tricycleApplicationData->tricycle_cin_number_id) &&
              $selectedCinNumberId != $tricycleApplicationData->tricycle_cin_number_id) {
                // Update the previous tricycle_cin_numbers entry
                $tricycleCinNumberModel->update(['tricycle_cin_number_id' => $tricycleApplicationData->tricycle_cin_number_id], [
                  'is_used' => false,
                  'user_id' => null,
                  'ownership_date' => null, 
                ]);
              }

              if ($appointmentFormData['status'] == 'Completed') {
                $tricycleModel = new Tricycle();
                $tricycleStatusesModel = new TricycleStatuses;

                $tricycleData = [
                  'cin_id' => $tricycleApplicationData->tricycle_cin_number_id,
                  'tricycle_application_id' => $tricycleApplicationData->tricycle_application_id,
                  'mtop_requirements_new_franchise_id' => $mtopRequirementId,
                  'user_id' => $appointmentData->user_id,
                ];

                if ($tricycleModel->insert($tricycleData)) {
                  $tricycleId = $tricycleModel->getLastInsertedRecord()[0]->tricycle_id;
                  $tricycleStatusesModel->insert(['tricycle_id' => $tricycleId, 'user_id' => $appointmentData->user_id, 'status' => 'Active']);
                }
              }

              $cinNumber = null; // Default value in case tricycle_cin_number_id is not set

              if ($tricycleApplicationData->tricycle_cin_number_id) {
                $cinDataForNotifs = $tricycleCinNumberModel->first(['tricycle_cin_number_id' => $tricycleApplicationData->tricycle_cin_number_id]);

                if ($cinDataForNotifs) {
                  $cinNumber = $cinDataForNotifs->cin_number;
                } else {
                  // Handle the case where $cinDataForNotifs is false (not found in the database)
                  // You can set a default value or handle the absence of $cinDataForNotifs in a way appropriate for your application logic.
                  $cinNumber = null; // Or any default value you prefer
                }
              }

              $formattedDate = date('F j, Y', strtotime($appointmentFormData['appointment_date']));
              $formattedTime = date('h:i A', strtotime($appointmentFormData['appointment_time']));
              $rootPath = ROOT;
              $routeArea = isset($tricycleApplicationFormData['route_area']) && !empty($tricycleApplicationFormData['route_area'])
              ? $tricycleApplicationFormData['route_area']
              : (!empty($tricycleApplicationData->route_area) ? $tricycleApplicationData->route_area : '');          

              $customTextMessage = $this->generateCustomTextMessage($appointmentFormData['name'], $appointmentFormData['appointment_type'], $formattedDate, $formattedTime, $rootPath, $cinNumber, $routeArea);
              $customEmailMessage = $this->generateCustomEmailMessage($formattedDate, $formattedTime, $appointmentFormData['appointment_type'], $cinNumber, $routeArea);
              $customRequirementMessage = $this->generateCustomRequirementMessage();

              sendAppointmentNotifications($appointmentFormData, $data, $tricycleApplicationData, $cinNumber, $customTextMessage, $customEmailMessage, $customRequirementMessage);
              set_flash_message("Scheduled appointment updated successfully.", "success");
              redirect('appointments');
            } else {
              set_flash_message("Failed to update scheduled appointment. Please try again later.", "error");
              redirect('appointments');
            }
          }
        }
      }

      echo $this->renderView('edit_new_franchise', true, $data);

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
      if ($appointmentFormData['status'] === 'Declined') {
        // Require comments for declined appointments
        $comments = trim($appointmentFormData['comments']);
        if (empty($comments)) {
          $errors['appointment'][] = 'Comments are required for declined appointments.';
        }
      }

    
      if ($_SESSION['USER']->role === 'admin'){
        if ($appointmentFormData['status'] === 'Completed' || $appointmentFormData['status'] === 'Approved') {
          $cinNumber = ($tricycleApplicationFormData['tricycle_cin_number_id']);
          if (empty($cinNumber)) {
            $errors['tricycleApplication'][] = 'Tricycle CIN number is required and must <br> be selected from the available options to <br> update this appointment request.';
          }
        }
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

    private function generateCustomTextMessage($name, $appointment_type, $formattedDate, $formattedTime, $rootPath, $cinNumber, $routeArea)
    {
      $feeMessage = "";
      if (!empty($routeArea)) {
        $feeMessage = $this->generateFeeMessage($routeArea);
      }

      $message = "Hello {$name},\n\nCongratulations! Your {$appointment_type} appointment for tricycle CIN #{$cinNumber} has been successfully approved for {$formattedDate} at {$formattedTime}. We look forward to welcoming you.\n\n";

      if (!empty($feeMessage)) {
        $message .= "To ensure a smooth process, kindly {$feeMessage} bring the original documents corresponding to the uploaded images on the Mtop Requirements Images form. Below is a list of requirements for New Franchise.\n";
      } else {
        $message .= "To ensure a smooth process, please bring the original documents corresponding to the uploaded images on the Mtop Requirements Images form. Below is a list of requirements for New Franchise.\n";
      }

      $message .= $this->generateRequirementList();
      $message .= "\nFor more details, please check your appointment details on our website: {$rootPath}";

      return $message;
    }

    private function generateCustomEmailMessage($formattedDate, $formattedTime, $appointment_type, $cinNumber, $routeArea)
    {
      $feeMessage = "";
      if (!empty($routeArea)){
        $feeMessage = $this->generateFeeMessage($routeArea);
      }

      $message = "<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>Congratulations! Your {$appointment_type} appointment for tricycle CIN #{$cinNumber} has been successfully approved for <strong>{$formattedDate}</strong> at <strong>{$formattedTime}</strong>. We look forward to welcoming you.</div>\n";

      if (!empty($feeMessage)) {
        $message .= "<div style='text-align: justify; color:#455056; font-size:15px;line-height:24px; margin:0;'>To ensure a smooth process, kindly {$feeMessage} bring the original documents corresponding to the uploaded images on the MTOP Requirements Images form. Below is a list of requirements for New Franchise. </div>";
      } else {
        $message .= "<div style='text-align: justify; color:#455056; font-size:15px;line-height:24px; margin:0;'>To ensure a smooth process, please bring the original documents corresponding to the uploaded images on the MTOP Requirements Images form. Below is a list of requirements for New Franchise. </div>";
      }

      return $message;
    }

    private function generateFeeMessage($routeArea)
    {
      $fee = ($routeArea === 'Free Zone / Zone 1') ? '430.00' : '1,030.00';
      $feeMessage = "be informed that a processing fee of &#8369;{$fee} is required for your appointment and please";

      return $feeMessage;
    }

    private function generateCustomRequirementMessage()
    {
      return "<div style='text-align: justify; color:#455056; font-size:15px;line-height:24px; margin:0;'>" . $this->generateRequirementList() . "</div>";
    }

    private function generateRequirementList()
    {
      return "1. LTO Certificate of Registration (MC of New Unit) (2 copies)<br>2. LTO Official Receipt (MC of New Unit) (2 copies)<br>3. Plate authorization (MC of New Unit) (2 copies)<br>4. Insurance Policy (TC) (New Owner) (2 copies)<br>5. Voters ID or Birth Certificate or Baptismal Certificate or Marriage Certificate or Brgy proof of residence (2 copies)<br>6. Sketch Location of Garage (2 copies)<br>7. Affidavit of No Income Or Latest Income Tax Return (2 copies)<br>8. Picture of New Unit (Front view & Side view) (2 copies)<br>9. Driver's Certificate of Safety Driving Seminar (2 copies)<br>10. Brown long envelope (1 pc.)";
    }
  }