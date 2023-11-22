<?php

class New_tricycle
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
      redirect('');
    }

    $driverModel = new Driver();
    $drivers = $driverModel->findAll();
    $data['drivers'] = [];

    foreach ($drivers as $driver) {
      $data['drivers'][$driver->driver_id] = [
        'driver_id' => $driver->driver_id,
        'name' => $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name
      ];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['add_tricycle'])) { // Check if the "Add Tricycle" button is clicked

        $tricycleData = [
          'make_model' => $_POST['make_model'] ?? '',
          'year_acquired' => $_POST['year_acquired'] ?? '',
          'color_code' => $_POST['color_code'] ?? '',
          'route_area' => $_POST['route_area'] ?? '',
          'plate_no' => $_POST['plate_no'] ?? '',
          'driver_id' => $_POST['driver_id'] ?? '',
          'or_no' => $_POST['or_no'] ?? '',
          'or_date' => $_POST['or_date'] ?? '',
          'tricycle_status' => $_POST['tricycle_status'] ?? 'Registration Pending'
        ];

        $tricycleModel = new Tricycle();
        $errors = $tricycleModel->validateData($tricycleData);

        if (!empty($errors)) {
          $errorMessage = $errors[0];
          set_flash_message($errorMessage, "error");
          $data = array_merge($tricycleData, $data);
          echo $this->renderView('new_tricycle', true, $data);
          return;
        } else {
          $tricycleId = $tricycleModel->insert($tricycleData);

          if ($tricycleId) {
            $imageData = [
              'tricycle_id' => $tricycleId,
              'front_view_image' => $this->uploadImage('front_view_image', $tricycleId),
              'back_view_image' => $this->uploadImage('back_view_image', $tricycleId),
              'side_view_image' => $this->uploadImage('side_view_image', $tricycleId)
            ];

            $imageModel = new TricycleImage();
            $imageErrors = $imageModel->validateData($imageData);

            if (empty($imageErrors)) {
              $imageModel->insert($imageData);
              set_flash_message("Tricycle added successfully.", "success");
              redirect('tricycles');
            } else {
              $errorMessage = $imageErrors[0];
              set_flash_message($errorMessage, "error");
              redirect('tricycles');
            }
          } else {
            set_flash_message("Failed to add tricycle. Please try again.", "error");
          }
        }
      } else {
        if (isset($_POST['route_area'])) {
          $taripasModel = new Taripas();
          $rateAdjustmentModel = new RateAdjustment();
          $recentTaripaData = [];
          $rate_adjustments_years = [];
    
          $routeArea = $_POST['route_area'];
          if ($routeArea === 'Free Zone & Zone 2') {
            $taripaData = $taripasModel->whereIn('route_area', ['Free Zone / Zone 1', 'Zone 2']);
          } else if ($routeArea === 'Free Zone & Zone 3') {
            $taripaData = $taripasModel->whereIn('route_area', ['Free Zone / Zone 1', 'Zone 3']);
          } else if ($routeArea === 'Free Zone & Zone 4') {
            $taripaData = $taripasModel->whereIn('route_area', ['Free Zone / Zone 1', 'Zone 4']);
          } else {
            $taripaData = $taripasModel->where(['route_area' => $routeArea]);
          }
          
    
          $taripa_years = array_unique(array_column($taripaData, 'effective_year'));
          $recentTaripaYear = max($taripa_years);
    
          if (!empty($rateAdjustmentModel->findAll())) {
            $rateAdjustmentsData = $rateAdjustmentModel->findAll();
            $rate_adjustments_years = array_unique(array_column($rateAdjustmentsData, 'effective_year'));
            $recentRateAdjustmentYear = max($rate_adjustments_years);
            $recentYear = max($recentTaripaYear, $recentRateAdjustmentYear);
          } else {
            $recentYear = $recentTaripaYear;
          }
    
          foreach ($taripaData as $index => $row) {
            // Check if the recent year is in the rate adjustments table
            $recentYearExists = in_array($recentYear, $rate_adjustments_years);
    
            if ($recentYearExists) {
              // Calculate regular_rate and student_rate for the recent year from rate adjustment data
              $recent_rate_adjustment = $rateAdjustmentModel->first(['effective_year' => $recentYear]);
              $recent_rate_action = $recent_rate_adjustment->rate_action;
              $recent_percentage = $recent_rate_adjustment->percentage;
              $recent_previous_year = $recent_rate_adjustment->previous_year;
    
              // If the previous year is in the rate adjustments table, get its rates
              if (in_array($recent_previous_year, $rate_adjustments_years)) {
                $previous_rate_adjustment = $rateAdjustmentModel->first(['effective_year' => $recent_previous_year]);
                $previous_percentage = $previous_rate_adjustment->percentage;
                $previous_rate_action = $previous_rate_adjustment->rate_action;
    
                // Calculate the rates for the previous year
                $regular_rate = $row->regular_rate;
                $student_rate = $row->student_rate;
                $senior_and_pwd_rate = $row->senior_and_pwd_rate;
    
                if ($previous_rate_action === 'increase') {
                  $previous_regular_rate = $regular_rate + ($regular_rate * $previous_percentage / 100);
                  $previous_student_rate = $student_rate + ($student_rate * $previous_percentage / 100);
                  $previous_senior_and_pwd_rate = $senior_and_pwd_rate + $senior_and_pwd_rate * $previous_percentage / 100;
                } elseif ($previous_rate_action === 'decrease') {
                  $previous_regular_rate = $regular_rate - ($regular_rate * $previous_percentage / 100);
                  $previous_student_rate = $student_rate - ($student_rate * $previous_percentage / 100);
                  $previous_senior_and_pwd_rate = $senior_and_pwd_rate - $senior_and_pwd_rate * $previous_percentage / 100;
                }
              } else {
                // If the previous year is not in the rate adjustments table,
                // fetch regular_rate and student_rate directly from the taripa table
                $previous_regular_rate = $row->regular_rate;
                $previous_student_rate = $row->student_rate;
                $previous_senior_and_pwd_rate = $row->senior_and_pwd_rate;
              }
    
              // Calculate regular_rate and student_rate for the recent year
              if ($recent_rate_action === 'increase') {
                $recent_regular_rate = $previous_regular_rate + ($previous_regular_rate * $recent_percentage / 100);
                $recent_student_rate = $previous_student_rate + ($previous_student_rate * $recent_percentage / 100);
                $recent_senior_and_pwd_rate = $previous_senior_and_pwd_rate + ($previous_senior_and_pwd_rate * $recent_percentage / 100);
              } elseif ($recent_rate_action === 'decrease') {
                $recent_regular_rate = $previous_regular_rate - ($previous_regular_rate * $recent_percentage / 100);
                $recent_student_rate = $previous_student_rate - ($previous_student_rate * $recent_percentage / 100);
                $recent_senior_and_pwd_rate = $previous_senior_and_pwd_rate - ($previous_senior_and_pwd_rate * $recent_percentage / 100);
              }
            } else {
              // If the recent year is not in the rate adjustments table,
              // fetch regular_rate, student_rate, and senior_and_pwd_rate directly from the taripa table
              $recent_regular_rate = $row->regular_rate;
              $recent_student_rate = $row->student_rate;
              $recent_student_rate = $row->senior_and_pwd_rate;
            }
    
            // Add the calculated rates to the recentTaripaData
            $recentTaripaData[] = [
              'route_area' => $row->route_area,
              'barangay' => $row->barangay,
              'regular_rate' => $recent_regular_rate,
              'student_rate' => $recent_student_rate,
              'senior_and_pwd_rate' => $recent_senior_and_pwd_rate,
            ];
          }
    
          echo json_encode($recentTaripaData);
          exit;
        }
      }
    }

    echo $this->renderView('new_tricycle', true, $data);
  }

  private function uploadImage($inputName, $tricycleId)
  {
    $uploadDir = 'uploads/tricycle_images/';
    $targetFile = $uploadDir . basename($_FILES[$inputName]['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $newFileName = $tricycleId . '_' . $inputName . '.' . $imageFileType;
    $targetPath = $uploadDir . $newFileName;

    move_uploaded_file($_FILES[$inputName]['tmp_name'], $targetPath);

    return $newFileName;
  }
}