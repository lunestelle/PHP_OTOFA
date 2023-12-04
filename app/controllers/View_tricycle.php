<?php

class View_tricycle
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    $tricycleId = isset($_GET['tricycle_id']) ? $_GET['tricycle_id'] : null;

    $tricycleModel = new Tricycle();
    $tricycleData = $tricycleModel->first(['tricycle_id' => $tricycleId]);

    if (!$tricycleData) {
      set_flash_message("Tricycle not found.", "error");
      redirect('tricycles');
    }

    $userModel = new User();
    $userData = $userModel->first(['user_id' => $tricycleData->user_id]);

    $data = [
      'plate_no' => $tricycleData->plate_no,
      'make_model' => $tricycleData->make_model,
      'year_acquired' => $tricycleData->year_acquired,
      'color_code' => $tricycleData->color_code,
      'route_area' => $tricycleData->route_area,
      'tricycle_status' => $tricycleData->tricycle_status,
      'user_name' => isset($userData) ? $userData->first_name . ' ' . $userData->last_name : '',
      'or_no' => $tricycleData->or_no,
      'or_date' => $tricycleData->or_date,
      'front_view_image_path' => $tricycleData->front_view_image_path,
      'side_view_image_path' => $tricycleData->side_view_image_path,
    ];

    $taripasModel = new Taripas();
    $rateAdjustmentModel = new RateAdjustment();
    $recentTaripaData = [];
    $rate_adjustments_years = [];
    $routeArea = $data['route_area'];

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
        $recent_senior_and_pwd_rate = $row->senior_and_pwd_rate;
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

    // Pass recentTaripaData to the view
    $data['recentTaripaData'] = $recentTaripaData;
    $data['recentYear'] = $recentYear;

    echo $this->renderView('view_tricycle', true, $data);
  }
}