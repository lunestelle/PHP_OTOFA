<?php

class Transfer_of_ownership_3
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
    $tricycleCinArray = !empty($tricycleCin) ? explode(',', $tricycleCin) : [];

    $tricycleCinModel = new TricycleCinNumber();
    $tricycleModel = new Tricycle();
    $driverModel = new Driver();
    $appointmentModel = new Appointment();
    $tricycleApplicationModel = new TricycleApplication();
    $mtopRequirementModel = new MtopRequirement();

    $tricycleCinData = [];

    foreach ($tricycleCinArray as $cin) {
      $cinData = $tricycleCinModel->first(['cin_number' => $cin]);
      if ($cinData) {
        $existingTricycleData = $tricycleModel->first(['cin_id' => $cinData->tricycle_cin_number_id]);

        $query = "SELECT drivers.* FROM drivers JOIN driver_statuses ON drivers.driver_id = driver_statuses.driver_id WHERE drivers.tricycle_cin_number_id = :tricycle_cin_id AND driver_statuses.status = 'Active'";
        $driverData = $driverModel->query($query, [':tricycle_cin_id' => $cinData->tricycle_cin_number_id]);

        $existingTricycleApplicationData = $tricycleApplicationModel->first(['tricycle_application_id' => $existingTricycleData->tricycle_application_id]);

        $cinInfo = [
          'cin_number' => $cinData->cin_number,
          'existingTricycleApplicationData' => $existingTricycleApplicationData,
          'driverData' => $driverData,
        ];

        if (!empty($driverData)) {
          $driver = $driverData[0];
          $cinInfo['driver_name'] = $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name;
          $cinInfo['driver_license_no'] = $driver->license_no;
          $cinInfo['driver_license_expiry_date'] = $driver->license_expiry_date;
        } else {
          $cinInfo['driver_name'] = 'Selected CIN has no driver';
          $cinInfo['driver_license_no'] = '';
          $cinInfo['driver_license_expiry_date'] = '';
        }

        $tricycleCinData[] = $cinInfo;
      }
    }

    $data['tricycleCinData'] = $tricycleCinData;

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
        'tricycle_cin_number_id' => $_POST['tricycle_cin_number_id1'] ?? '',
        'coc_no' => $_POST['coc_no1'] ?? '',
        'coc_no_expiry_date' => $_POST['coc_no_expiry_date1'] ?? '',
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
        'make_model_expiry_date' => $_POST['make_model_expiry_date2'] ?? '','make_model_year_acquired' => $_POST['make_model_year_acquired2'] ?? '',
        'motor_number' => $_POST['motor_number2'] ?? '',
        'insurer' => $_POST['insurer2'] ?? '',
        'tricycle_cin_number_id' => $_POST['tricycle_cin_number_id2'] ?? '',
        'coc_no' => $_POST['coc_no2'] ?? '',
        'coc_no_expiry_date' => $_POST['coc_no_expiry_date2'] ?? '',
        'driver_id' => $_POST['driver_id2'] ?? '',
        'lto_cr_no' => $_POST['lto_cr_no2'] ?? '',
        'lto_or_no' => $_POST['lto_or_no2'] ?? '',
        'driver_license_no' => $_POST['driver_license_no2'] ?? '',
        'driver_license_expiry_date' => $_POST['driver_license_expiry_date2'] ?? '',
      ];

      $tricycleApplicationFormData3 = [
        'operator_name' => $_POST['operator_name3'] ?? '',
        'tricycle_phone_number' => $_POST['tricycle_phone_number3'] ?? '',
        'address' => $_POST['address3'] ?? '',
        'mtop_no' => $_POST['mtop_no3'] ?? '',
        'route_area' => $_POST['route_area3'] ?? '',
        'color_code' => $_POST['color_code3'] ?? '',
        'make_model' => $_POST['make_model3'] ?? '',
        'make_model_expiry_date' => $_POST['make_model_expiry_date3'] ?? '','make_model_year_acquired' => $_POST['make_model_year_acquired3'] ?? '',
        'motor_number' => $_POST['motor_number3'] ?? '',
        'insurer' => $_POST['insurer3'] ?? '',
        'tricycle_cin_number_id' => $_POST['tricycle_cin_number_id3'] ?? '',
        'coc_no' => $_POST['coc_no3'] ?? '',
        'coc_no_expiry_date' => $_POST['coc_no_expiry_date3'] ?? '',
        'driver_id' => $_POST['driver_id3'] ?? '',
        'lto_cr_no' => $_POST['lto_cr_no3'] ?? '',
        'lto_or_no' => $_POST['lto_or_no3'] ?? '',
        'driver_license_no' => $_POST['driver_license_no3'] ?? '',
        'driver_license_expiry_date' => $_POST['driver_license_expiry_date3'] ?? '',
      ];

      $formErrors = $this->validateFormFields($appointmentFormData, $tricycleApplicationFormData1, $tricycleApplicationFormData2, $tricycleApplicationFormData3, $appointmentModel, $tricycleApplicationModel);

      if (!empty($formErrors)) {
        $firstError = reset($formErrors);
        set_flash_message($firstError[0], "error");
        // $data = array_merge($data, $_POST);
        echo $this->renderView('transfer_of_ownership_3', true, $data);
        return;
      } else {
        $formattedPhoneNumber = $appointmentFormData['phone_number'];
        $appointmentFormData['phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber);

        if ($appointmentModel->insert($appointmentFormData)) {
          $appointmentLastId = $appointmentModel->getLastInsertedRecord()[0]->appointment_id;
          $tricycleApplicationFormData1['appointment_id'] = $appointmentLastId;
          $tricycleApplicationFormData2['appointment_id'] = $appointmentLastId;
          $tricycleApplicationFormData3['appointment_id'] = $appointmentLastId;

          $formattedPhoneNumber1 = $tricycleApplicationFormData1['tricycle_phone_number'];
          $tricycleApplicationFormData1['tricycle_phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber1);

          $formattedPhoneNumber2 = $tricycleApplicationFormData2['tricycle_phone_number'];
          $tricycleApplicationFormData2['tricycle_phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber2);

          $formattedPhoneNumber3 = $tricycleApplicationFormData3['tricycle_phone_number'];
          $tricycleApplicationFormData3['tricycle_phone_number'] = '+63' . preg_replace('/[^0-9]/', '', $formattedPhoneNumber3);

          if ($tricycleApplicationModel->insert($tricycleApplicationFormData1)) {
            $tricycleApplicationLastId1 = $tricycleApplicationModel->getLastInsertedRecord()[0]->tricycle_application_id;

            if ($tricycleApplicationModel->insert($tricycleApplicationFormData2)) {
              $tricycleApplicationLastId2 = $tricycleApplicationModel->getLastInsertedRecord()[0]->tricycle_application_id;

              if ($tricycleApplicationModel->insert($tricycleApplicationFormData3)) {
                $tricycleApplicationLastId3 = $tricycleApplicationModel->getLastInsertedRecord()[0]->tricycle_application_id;

                $mtopRequirementFormData1 = [
                  'appointment_id' => $appointmentLastId,
                  'tricycle_application_id' => $tricycleApplicationLastId1,
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
  
                $mtopRequirementFormData2 = [
                  'appointment_id' => $appointmentLastId,
                  'tricycle_application_id' => $tricycleApplicationLastId2,
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

                $mtopRequirementFormData3 = [
                  'appointment_id' => $appointmentLastId,
                  'tricycle_application_id' => $tricycleApplicationLastId3,
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
    
                $fileUploads1 = $this->handleFileUploads($mtopRequirementFormData1, '1');
                $fileUploads2 = $this->handleFileUploads($mtopRequirementFormData2, '2');
                $fileUploads3 = $this->handleFileUploads($mtopRequirementFormData3, '3');
    
                if ($fileUploads1['success'] && $fileUploads2['success'] && $fileUploads3['success']) {
                  $mtopRequirementModel = new MtopRequirement();
                  $mtopRequirementModel->insert($fileUploads1['data']);
                  $mtopRequirementModel->insert($fileUploads2['data']);
                  $mtopRequirementModel->insert($fileUploads3['data']);
    
                  set_flash_message("Appointment scheduled successfully.", "success");
                  redirect('appointments');
                } else {
                  $appointmentModel->delete(['appointment_id' => $appointmentLastId]);
                  $tricycleApplicationModel->delete(['tricycle_application_id' => $tricycleApplicationLastId1]);
                  $tricycleApplicationModel->delete(['tricycle_application_id' => $tricycleApplicationLastId2]);
                  $tricycleApplicationModel->delete(['tricycle_application_id' => $tricycleApplicationLastId3]);
                  set_flash_message("Failed to schedule appointment. Please try again later.", "error");
                  redirect('appointments');
                }
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

    echo $this->renderView('transfer_of_ownership_3', true, $data);
  }

  private function validateFormFields($appointmentFormData, $tricycleApplicationFormData1, $tricycleApplicationFormData2, $tricycleApplicationFormData3, $appointmentModel, $tricycleApplicationModel)
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

    if (empty($tricycleApplicationFormData1['tricycle_cin_number_id'])) {
      $errors['tricycleApplication1'][] = 'Tricycle CIN is required';
    }

    if (!empty($tricycleApplicationFormData1['tricycle_cin_number_id'])) {
      $cinId = $tricycleApplicationFormData1['tricycle_cin_number_id'];
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
    }

    $tricycleApplicationErrors2 = $tricycleApplicationModel->validate($tricycleApplicationFormData2);
    if (!empty($tricycleApplicationErrors2)) {
      $errors['tricycleApplication2'] = $tricycleApplicationErrors2;
    }

    if (empty($tricycleApplicationFormData2['tricycle_cin_number_id'])) {
      $errors['tricycleApplication2'][] = 'Tricycle CIN is required';
    }

    if (!empty($tricycleApplicationFormData2['tricycle_cin_number_id'])) {
      $cinId = $tricycleApplicationFormData2['tricycle_cin_number_id'];
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
    } 

    $tricycleApplicationErrors3 = $tricycleApplicationModel->validate($tricycleApplicationFormData3);
    if (!empty($tricycleApplicationErrors3)) {
      $errors['tricycleApplication3'] = $tricycleApplicationErrors3;
    }

    if (empty($tricycleApplicationFormData3['tricycle_cin_number_id'])) {
      $errors['tricycleApplication3'][] = 'Tricycle CIN is required';
    }

    if (!empty($tricycleApplicationFormData3['tricycle_cin_number_id'])) {
      $cinId = $tricycleApplicationFormData3['tricycle_cin_number_id'];
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
              $errors['tricycleApplication3'][] = "There is an existing $type appointment for this tricycle CIN #$cinNumber with appointment <br> status '$appointmentStatus' and appointment date on $appointmentDate.";
          }
      }
    }

    if (!empty($tricycleApplicationFormData3['driver_id'])) {
      if (empty($tricycleApplicationFormData3['driver_license_no'])) {
        $errors['tricycleApplication3'][] = 'Driver License Number is required';
      } elseif (empty($tricycleApplicationFormData3['driver_license_expiry_date'])) {
        $errors['tricycleApplication3'][] = 'Driver License Expiry Date is required';
      }
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