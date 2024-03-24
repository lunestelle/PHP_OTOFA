<?php

class Transfer_of_ownership
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

    $tricycleCin = isset($_GET['tricycleCin']) ? $_GET['tricycleCin'] : '';

    $tricycleCinModel = new TricycleCinNumber();
    $tricycleModel = new Tricycle();
    $driverModel = new Driver();
    $appointmentModel = new Appointment();
    $tricycleApplicationModel = new TricycleApplication();
    $mtopRequirementModel = new MtopRequirement();

    $cinData = $tricycleCinModel->first(['cin_number' => $tricycleCin]);
    $existingTricycleData = $tricycleModel->first(['cin_id' => $cinData->tricycle_cin_number_id]);

    $query = "SELECT drivers.* FROM drivers JOIN driver_statuses ON drivers.driver_id = driver_statuses.driver_id WHERE drivers.tricycle_cin_number_id = :tricycle_cin_id AND driver_statuses.status = 'Active'";
    $data['driverData'] = $driverModel->query($query, [':tricycle_cin_id' => $cinData->tricycle_cin_number_id]);
    
    $data['existingTricycleApplicationData'] = $tricycleApplicationModel->first(['tricycle_application_id' => $existingTricycleData->tricycle_application_id]);
    $data['cin_number'] = $cinData->cin_number;

    if (!empty($data['driverData'])) {
      $driver = $data['driverData'][0];
      $data['driver_name'] = $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name;
      $data['driver_license_no'] = $driver->license_no;
      $data['driver_license_expiry_date'] = $driver->license_expiry_date;
    } else {
      $data['driver_name'] = 'Selected CIN has no driver';
      $data['driver_license_no'] = '';
      $data['driver_license_expiry_date'] = '';
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['schedule_appointment'])) {
      $appointmentFormData = [
        'name' => $_POST['name'] ?? '',
        'phone_number' => $_POST['phone_number'] ?? '',
        'email' => $_POST['email'] ?? '',
        'appointment_type' => 'Transfer of Ownership',
        'transfer_type' => 'None',
        'appointment_date' => $_POST['appointment_date'] ?? '',
        'appointment_time' => date("H:i", strtotime($_POST['appointment_time'])) ?? '',
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
        'make_model_expiry_date' => $_POST['make_model_expiry_date'] ?? '','make_model_year_acquired' => $_POST['make_model_year_acquired'] ?? '',
        'motor_number' => $_POST['motor_number'] ?? '',
        'insurer' => $_POST['insurer'] ?? '',
        'tricycle_cin_number_id' => $_POST['tricycle_cin_number_id'] ?? '',
        'coc_no' => $_POST['coc_no'] ?? '',
        'coc_no_expiry_date' => $_POST['coc_no_expiry_date'] ?? '',
        'driver_id' => $_POST['driver_id'] ?? '',
        'lto_cr_no' => $_POST['lto_cr_no'] ?? '',
        'lto_or_no' => $_POST['lto_or_no'] ?? '',
        'driver_license_no' => $_POST['driver_license_no'] ?? '',
        'driver_license_expiry_date' => $_POST['driver_license_expiry_date'] ?? '',
      ];

      $formErrors = $this->validateFormFields($appointmentFormData, $tricycleApplicationFormData, $appointmentModel, $tricycleApplicationModel);

      if (!empty($formErrors)) {
        $firstError = reset($formErrors);
        set_flash_message($firstError[0], "error");
        $data = array_merge($data, $_POST);
        echo $this->renderView('transfer_of_ownership', true, $data);
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
              'latest_franchise_path' => '',
              'proof_of_id_path' => '',
              'sketch_location_of_garage_path' => '',
              'affidavit_of_income_tax_return_path' => '',
              'unit_front_view_image_path' => '',
              'unit_side_view_image_path' => '',
              'driver_cert_safety_driving_seminar_path' => '',
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

    echo $this->renderView('transfer_of_ownership', true, $data);
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

    if (empty($tricycleApplicationFormData['tricycle_cin_number_id'])) {
      $errors['tricycleApplication'][] = 'Tricycle CIN is required';
    }

    if (!empty($tricycleApplicationFormData['tricycle_cin_number_id'])) {
      $cinId = $tricycleApplicationFormData['tricycle_cin_number_id'];
      $userId =  $appointmentFormData['user_id'];
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
                    AND appointments.user_id != ? 
                    AND appointments.status IN ($statusPlaceholders)";
  
          $params = array_merge([$cinId, $currentYear, $appointmentType, $userId], $statuses);
  
          $appointmentResult = $appointmentModel->query($query, $params);
  
          if (!empty($appointmentResult) && isset($appointmentResult[0])) {
              $tricycleCinModel = new TricycleCinNumber();
              $cinDataValidation = $tricycleCinModel->first(['tricycle_cin_number_id' => $cinId]);
  
              // Check if the CIN belongs to the same owner as in the first appointment record
              $cinNumber = $cinDataValidation->cin_number;
              $type = $appointmentResult[0]->appointment_type;
              $appointmentStatus = $appointmentResult[0]->status;
              $appointmentDate = date('F j, Y', strtotime($appointmentResult[0]->appointment_date));
              $errors['tricycleApplication'][] = "There is an existing $type appointment for this tricycle CIN #$cinNumber with appointment <br> status '$appointmentStatus' and appointment date on $appointmentDate.";
          }
      }
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