<?php

class New_taripa
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
      redirect('');
    }

    $taripaModel = new Taripas();
    $rateAdjustmentModel = new RateAdjustment();
    $errors = [];
    $rate_adjustments_years = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $year = $_POST['year'];
      $rate_action = $_POST['rate_action'];
      $percentage = floatval($_POST['percentage']);

      // Find the recent year from both taripa and rate adjustment tables
      $taripasData = $taripaModel->findAll();
      $taripa_years = array_unique(array_column($taripasData, 'effective_year'));
      $recentTaripaYear = max($taripa_years);

      if (!empty($rateAdjustmentModel->findAll())) {
        $rateAdjustmentsData = $rateAdjustmentModel->findAll();
        $rate_adjustments_years = array_unique(array_column($rateAdjustmentsData, 'effective_year'));
        $recentRateAdjustmentYear = max($rate_adjustments_years);
        $data['minYear'] = min(array_merge($taripa_years, $rate_adjustments_years));
        $recent = max($recentTaripaYear, $recentRateAdjustmentYear);
      
        if ($recent < $year) {
          $recentYear = max($recentTaripaYear, $recentRateAdjustmentYear);
        } else if ($recent > $year) {
          $recentYear = min($recentTaripaYear, $recentRateAdjustmentYear);
        }
      } else {
        $recentYear = $recentTaripaYear;
        $data['minYear'] = min($taripa_years);
      }

      

      $data['currentYear'] = date('Y');

      if ($year < $data['minYear'] || $year > $data['currentYear']) {
        $errors['year'] = "Invalid year input. Year must be between {$data['minYear']} and {$data['currentYear']}.";
      }

      $existingTaripa = $taripaModel->first(['effective_year' => $year]);
      $existingRateAdjustment = $rateAdjustmentModel->first(['effective_year' => $year]);
      if ($existingTaripa || $existingRateAdjustment) {
        $errors['year'] = "A Taripa entry already exists for the year $year.";
      }

      if ($percentage < 0 || $percentage > 100) {
        $errors['percentage'] = "Invalid percentage input. Percentage <br> must be between 0 and 100.";
      }

      if (!empty($errors)) {
        $firstErrorKey = array_keys($errors)[0];
        $firstError = $errors[$firstErrorKey];

        $formData = [
          'year' => $year,
          'rate_action' => $rate_action,
          'percentage' => $percentage,
        ];
        $_SESSION['formInput'] = $formData;
        $_SESSION['formErrors'] = $errors;

        set_flash_message($firstError, "error");
        redirect('new_taripa');
      }

      $calculatedRates = [];
      foreach ($taripasData as $taripa) {
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
            $regular_rate = $taripa->regular_rate;
            $student_rate = $taripa->student_rate;
            $senior_and_pwd_rate = $taripa->senior_and_pwd_rate;

            if ($previous_rate_action === 'increase') {
              $previous_regular_rate = $regular_rate + $regular_rate * $previous_percentage / 100;
              $previous_student_rate = $student_rate + $student_rate * $previous_percentage / 100;
              $previous_senior_and_pwd_rate = $senior_and_pwd_rate + $senior_and_pwd_rate * $previous_percentage / 100;
            } elseif ($previous_rate_action === 'decrease') {
              $previous_regular_rate = $regular_rate - $regular_rate * $previous_percentage / 100;
              $previous_student_rate = $student_rate - $student_rate * $previous_percentage / 100;
              $previous_senior_and_pwd_rate = $senior_and_pwd_rate - $senior_and_pwd_rate * $previous_percentage / 100;
            }
          } else {
            // If the previous year is not in the rate adjustments table,
            // fetch regular_rate, student_rate, senior_and_pwd_rate directly from the taripa table
            $previous_regular_rate = $taripa->regular_rate;
            $previous_student_rate = $taripa->student_rate;
            $previous_senior_and_pwd_rate = $taripa->senior_and_pwd_rate;
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

          // Calculate regular_rate and student_rate for the new added year
          if ($rate_action === 'increase') {
            $new_regular_rate = $recent_regular_rate + ($recent_regular_rate * $percentage / 100);
            $new_student_rate = $recent_student_rate + ($recent_student_rate * $percentage / 100);
            $new_senior_and_pwd_rate = $recent_senior_and_pwd_rate + ($recent_senior_and_pwd_rate * $percentage / 100);
          } elseif ($rate_action === 'decrease') {
            $new_regular_rate = $recent_regular_rate - ($recent_regular_rate * $percentage / 100);
            $new_student_rate = $recent_student_rate - ($recent_student_rate * $percentage / 100);
            $new_senior_and_pwd_rate = $recent_senior_and_pwd_rate - ($recent_senior_and_pwd_rate * $percentage / 100);
          }
        } else {
          // If the recent year is not in the rate adjustments table,
          // fetch regular_rate and student_rate directly from the taripa table
          $recent_regular_rate = $taripa->regular_rate;
          $recent_student_rate = $taripa->student_rate;
          $recent_senior_and_pwd_rate = $taripa->senior_and_pwd_rate;

          if ($rate_action === 'increase') {
            $new_regular_rate = $recent_regular_rate + ($recent_regular_rate * $percentage / 100);
            $new_student_rate = $recent_student_rate + ($recent_student_rate * $percentage / 100);
            $new_senior_and_pwd_rate = $recent_senior_and_pwd_rate + ($recent_senior_and_pwd_rate * $percentage / 100);
          } elseif ($rate_action === 'decrease') {
            $new_regular_rate = $recent_regular_rate - ($recent_regular_rate * $percentage / 100);
            $new_student_rate = $recent_student_rate - ($recent_student_rate * $percentage / 100);
            $new_senior_and_pwd_rate = $recent_senior_and_pwd_rate - ($recent_senior_and_pwd_rate * $percentage / 100);
          }
        }

        $calculatedRates[] = [
          'route_area' => $taripa->route_area,
          'barangay' => $taripa->barangay,
          'previous_regular_rate' => $recent_regular_rate ?? null,
          'previous_student_rate' => $recent_student_rate ?? null,
          'previous_senior_and_pwd_rate' => $recent_senior_and_pwd_rate ?? null,
          'new_regular_rate' => $new_regular_rate ?? null,
          'new_student_rate' => $new_student_rate ?? null,
          'new_senior_and_pwd_rate' => $new_senior_and_pwd_rate ?? null,
        ];
      }
      $_SESSION['calculatedRates'] = $calculatedRates;
      $_SESSION['recentYear'] = $recentYear;

      // Save the form data to session to display on the back button click
      $formData = [
        'year' => $year,
        'rate_action' => $rate_action,
        'percentage' => $percentage,
      ];
      $_SESSION['formInput'] = $formData;
      redirect('new_taripa');
    } else {
      if (isset($_SESSION['calculatedRates']) && !empty($_SESSION['calculatedRates'])) {
        $formData = $_SESSION['formInput'];
        $recentYear = $_SESSION['recentYear'];

        // Render the view with the calculated rates from the session and form data
        echo $this->renderView('new_taripa', true, [
          'calculatedRates' => $_SESSION['calculatedRates'],
          'year' => $formData['year'],
          'rate_action' => $formData['rate_action'],
          'percentage' => $formData['percentage'],
          'recentYear' => $recentYear,
        ]);
      } else {
        // Render the view without the calculated rates
        $data['errors'] = isset($_SESSION['formErrors']) ? $_SESSION['formErrors'] : [];
        echo $this->renderView('new_taripa', true, $data);
      }

      unset($_SESSION['formErrors']);
    }
  }
}