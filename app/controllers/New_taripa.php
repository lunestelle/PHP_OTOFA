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
      $effectiveDate = $_POST['year'];
      $rate_action = $_POST['rate_action'];
      $percentage = floatval($_POST['percentage']);

      $year = date('Y', strtotime($_POST['year']));

      // Find the recent year from both taripa and rate adjustment tables
      $taripasData = $taripaModel->findAll();

      // Sort the $taripasData array by taripa_id
      usort($taripasData, function($a, $b) {
        return $a->taripa_id - $b->taripa_id;
      });

      if (!empty($taripasData)) {
        $taripa_years = array_unique(array_map(function ($item) {
          return (new DateTime($item->effective_date))->format('Y');
        }, $taripasData));
      }

      $recentTaripaYear = max($taripa_years);

      // Find all rate adjustments
      $rateAdjustmentsData = $rateAdjustmentModel->findAll();

      if (!empty($rateAdjustmentsData)) {
        // Extract years from rate adjustments data
        $rate_adjustments_years = array_unique(array_map(function ($item) {
          return (new DateTime($item->effective_date))->format('Y');
        }, $rateAdjustmentsData));

        // Find the most recent rate adjustment year
        $recentRateAdjustmentYear = max($rate_adjustments_years);

        // Find the minimum year between Taripa and rate adjustments
        $data['minYear'] = min(array_merge($taripa_years, $rate_adjustments_years));

        // Determine the most recent year between Taripa and rate adjustments
        $recent = max($recentTaripaYear, $recentRateAdjustmentYear);

        // Adjust recentYear based on comparison with the given year
        if ($recent < $year) {
          $recentYear = max($recentTaripaYear, $recentRateAdjustmentYear);
        } else if ($recent > $year) {
          $recentYear = min($recentTaripaYear, $recentRateAdjustmentYear);
        }
      } else {
        // If there are no rate adjustments, fallback to Taripa year
        $recentYear = $recentTaripaYear;
        $data['minYear'] = min($taripa_years);
      }

      $data['currentYear'] = date('Y') + 3;

      if ($year < $data['minYear'] || $year > $data['currentYear']) {
        $errors['year'] = "Invalid year input. Year must be between {$data['minYear']} and {$data['currentYear']}.";
      }

      if (in_array($year, $taripa_years) || in_array($year, $rate_adjustments_years)) {
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
          'effective_date' => $effectiveDate,
        ];
        $_SESSION['formInput'] = $formData;
        $_SESSION['formErrors'] = $errors;

        set_flash_message($firstError, "error");
        redirect('new_taripa');
      }

      $calculatedRates = [];
      foreach ($taripasData as $taripa) {
        $taripa_effective_year = (new DateTime($taripa->effective_date))->format('Y');

        // Check if the recent year is in the rate adjustments table
        $recentYearExists = in_array($recentYear, $rate_adjustments_years);

        if ($recentYearExists) {
          // Calculate regular_fare and discounted_fare for the recent year from rate adjustment data
          $recent_rate_adjustment = $rateAdjustmentModel->getrecentYearData($recentYear);
          if ($recent_rate_adjustment) {
            $recent_rate_action = $recent_rate_adjustment['rate_action'];
            $recent_percentage = $recent_rate_adjustment['percentage'];
            $recent_previous_year = $recent_rate_adjustment['previous_year'];
        
            // If the previous year is in the rate adjustments table, get its rates
            if (in_array($recent_previous_year, $rate_adjustments_years)) {
              $previous_rate_adjustment = $rateAdjustmentModel->getpreviousYearData($recent_previous_year);
              $previous_percentage = $previous_rate_adjustment['percentage'];
              $previous_rate_action = $previous_rate_adjustment['rate_action'];
        
              // Calculate the rates for the previous year
              $previous_regular_fare = $taripa->regular_fare;
              $previous_discounted_fare = $taripa->discounted_fare;
        
              if ($previous_rate_action === 'increase') {
                $previous_regular_fare += $previous_regular_fare * $previous_percentage / 100;
                $previous_discounted_fare += $previous_discounted_fare * $previous_percentage / 100;
              } elseif ($previous_rate_action === 'decrease') {
                $previous_regular_fare -= $previous_regular_fare * $previous_percentage / 100;
                $previous_discounted_fare -= $previous_discounted_fare * $previous_percentage / 100;
              }
            } else {
              // If the previous year is not in the rate adjustments table,
              // fetch regular_fare, discounted_fare
              $previous_regular_fare = $taripa->regular_fare;
              $previous_discounted_fare = $taripa->discounted_fare;
            }
        
            // Calculate regular_fare and discounted_fare for the recent year
            if ($recent_rate_action === 'increase') {
              $recent_regular_fare = $previous_regular_fare + ($previous_regular_fare * $recent_percentage / 100);
              $recent_discounted_fare = $previous_discounted_fare + ($previous_discounted_fare * $recent_percentage / 100);
            } elseif ($recent_rate_action === 'decrease') {
              $recent_regular_fare = $previous_regular_fare - ($previous_regular_fare * $recent_percentage / 100);
              $recent_discounted_fare = $previous_discounted_fare - ($previous_discounted_fare * $recent_percentage / 100);
            }
        
            // Calculate regular_fare and discounted_fare for the new added year
            if ($rate_action === 'increase') {
              $new_regular_fare = $recent_regular_fare + ($recent_regular_fare * $percentage / 100);
              $new_discounted_fare = $recent_discounted_fare + ($recent_discounted_fare * $percentage / 100);
            } elseif ($rate_action === 'decrease') {
              $new_regular_fare = $recent_regular_fare - ($recent_regular_fare * $percentage / 100);
              $new_discounted_fare = $recent_discounted_fare - ($recent_discounted_fare * $percentage / 100);
            }
          }
        } else {
          // If the recent year is not in the rate adjustments table,
          // fetch regular_fare and discounted_fare directly from the taripa table
          $recent_regular_fare = $taripa->regular_fare;
          $recent_discounted_fare = $taripa->discounted_fare;
        
          if ($rate_action === 'increase') {
            $new_regular_fare = $recent_regular_fare + ($recent_regular_fare * $percentage / 100);
            $new_discounted_fare = $recent_discounted_fare + ($recent_discounted_fare * $percentage / 100);
          } elseif ($rate_action === 'decrease') {
            $new_regular_fare = $recent_regular_fare - ($recent_regular_fare * $percentage / 100);
            $new_discounted_fare = $recent_discounted_fare - ($recent_discounted_fare * $percentage / 100);
          }
        }
        

        $calculatedRates[] = [
          'route_area' => $taripa->route_area,
          'barangay' => $taripa->barangay,
          'previous_regular_fare' => $recent_regular_fare ?? null,
          'previous_discounted_fare' => $recent_discounted_fare ?? null,
          'new_regular_fare' => $new_regular_fare ?? null,
          'new_discounted_fare' => $new_discounted_fare ?? null,
        ];
      }
      $_SESSION['calculatedRates'] = $calculatedRates;
      $_SESSION['recentYear'] = $recentYear;

      // Save the form data to session to display on the back button click
      $formData = [
        'year' => $year,
        'rate_action' => $rate_action,
        'percentage' => $percentage,
        'effective_date' => $effectiveDate,
      ];

      $_SESSION['formInput'] = $formData;
      redirect('new_taripa');
    } else {
      if (isset($_SESSION['calculatedRates']) && !empty($_SESSION['calculatedRates'])) {
        $formData = $_SESSION['formInput'];
        $recentYear = $_SESSION['recentYear'];

        // Render the view with the calculated rates from the session and form data
        echo $this->renderView('new_taripa', true, [
          'index' => 1,
          'calculatedRates' => $_SESSION['calculatedRates'],
          'year' => $formData['year'],
          'rate_action' => $formData['rate_action'],
          'percentage' => $formData['percentage'],
          'recentYear' => $recentYear,
          'effective_date' => $formData['effective_date'],
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