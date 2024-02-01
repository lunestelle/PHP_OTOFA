<?php

class Print_taripa_content
{
  use Controller;

  public function index()
  {
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
      set_flash_message("Invalid request method.", "error");
      redirect('');
    }

    $year = $_GET['year'];

    $taripaModel = new Taripas();
    $rateAdjustmentModel = new RateAdjustment();
    $route_area = $_GET['route_area'] ?? null;
    $data['taripas'] = [];

    $taripasData = $taripaModel->findAll();
    if (!empty($taripasData)) {
      $taripa_years = array_unique(array_map(function ($item) {
        return (new DateTime($item->effective_date))->format('Y');
      }, $taripasData));
    }
    
    // Check if there are rate adjustments available
    $rate_adjustments_exist = !empty($rateAdjustmentModel->findAll());

    // If rate adjustments exist, fetch years from the rate_adjustments table
    if ($rate_adjustments_exist) {
      $rateAdjustmentsData = $rateAdjustmentModel->findAll();
      if (!empty($rateAdjustmentsData)) {
        $rate_adjustments_years = array_unique(array_map(function ($item) {
          return (new DateTime($item->effective_date))->format('Y');
        }, $rateAdjustmentsData));
      }
      // Merge and sort the years in descending order
      $years = array_unique(array_merge($taripa_years, $rate_adjustments_years));
      rsort($years);
    } else {
      $years = $taripa_years;
      rsort($years);
    }

    // Check if the selected year exists in the $years array,
    // if not, set it to the latest available year from the $years array
    if ($year && !in_array($year, $years)) {
      $year = reset($years);
    }

    // If no year filter is selected, set it to the latest available year
    if (!$year) {
      $year = reset($years);
    }

    // If a year filter is selected, get the data for that year
    if ($year) {
      $filteredData = [];

      // Loop through each taripa record to calculate regular_fare, discounted_fare, and senior_and_pwd_rate
      foreach ($taripasData as $taripa) {
        // Check if the selected year is in the rate adjustments table
        $selected_year_index = array_search($year, $rate_adjustments_years);

        if ($selected_year_index !== false) {
          // Calculate regular_fare, discounted_fare, and senior_and_pwd_rate for the selected year from rate adjustment data
          $rate_adjustment = $rateAdjustmentModel->getYear($year);
          
          $rate_action = $rate_adjustment->rate_action;
          $percentage = $rate_adjustment->percentage;
          $previous_year = $rate_adjustment->previous_year;

          // If the previous year is in the rate adjustments table, get its rates
          if (in_array($previous_year, $rate_adjustments_years)) {
            $previous_rate_adjustment = $rateAdjustmentModel->first(['effective_date' => $previous_year]);
            $previous_percentage = $previous_rate_adjustment->percentage;
            $previous_rate_action = $previous_rate_adjustment->rate_action;

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
            // fetch regular_fare, discounted_fare, and senior_and_pwd_rate directly from the taripa table
            $previous_regular_fare = $taripa->regular_fare;
            $previous_discounted_fare = $taripa->discounted_fare;
          }

          // Calculate regular_fare, discounted_fare, and senior_and_pwd_rate for the selected year
          if ($rate_action === 'increase') {
            $regular_fare = $previous_regular_fare + ($previous_regular_fare * $percentage / 100);
            $discounted_fare = $previous_discounted_fare + ($previous_discounted_fare * $percentage / 100);
          } elseif ($rate_action === 'decrease') {
            $regular_fare = $previous_regular_fare - ($previous_regular_fare * $percentage / 100);
            $discounted_fare = $previous_discounted_fare - ($previous_discounted_fare * $percentage / 100);
          }
        } else {
          // If the selected year is not in the rate adjustments table,
          // fetch regular_fare, discounted_fare, and senior_and_pwd_rate directly from the taripa table
          $regular_fare = $taripa->regular_fare;
          $discounted_fare = $taripa->discounted_fare;
        }

        $filteredData[] = [
          'taripa_id' => $taripa->taripa_id,
          'route_area' => $taripa->route_area,
          'barangay' => $taripa->barangay,
          'regular_fare' => $regular_fare,
          'discounted_fare' => $discounted_fare,
        ];
      }

      $selectedFilter = $year;
      $taripasData = $filteredData;
    }

    if (!empty($taripasData)) {
      // Sort $taripasData by 'taripa_id' in ascending order
      usort($taripasData, function ($a, $b) {
        $aArray = (array)$a;
        $bArray = (array)$b;
        return $aArray['taripa_id'] <=> $bArray['taripa_id'];
      });

      $first_container_data = [];
      $second_container_data = [];

      foreach ($taripasData as $taripa) {
        $taripaArray = (array)$taripa;

        // Determine if the taripa_id belongs to the first or second container
        if ($taripaArray['taripa_id'] >= 1 && $taripaArray['taripa_id'] <= 32) {
          $first_container_data[] = $taripaArray;
        } elseif ($taripaArray['taripa_id'] >= 33 && $taripaArray['taripa_id'] <= 63) {
          $second_container_data[] = $taripaArray;
        }
      }
    }

    // Fetch the effective date from the taripa table
    $effective_date = $this->fetchEffectiveDate($year, $rate_adjustments_years);

    $data = [
      'first_container_data' => $first_container_data,
      'second_container_data' => $second_container_data,
      'effective_date' => $effective_date,
    ];
    echo $this->renderView('print_taripa_content', true, $data);
  }

  private function fetchEffectiveDate($year, $rate_adjustments_years)
  {
    $taripaModel = new Taripas();
    $rateAdjustmentModel = new RateAdjustment();

    // Check if the year exists in the rate adjustments table
    if (in_array($year, $rate_adjustments_years)) {
      $rateAdjustment = $rateAdjustmentModel->getYear($year);
      return date('F d, Y', strtotime($rateAdjustment->effective_date));
    } else {
      // Fetch the effective date from the taripa table
      $query = "SELECT effective_date FROM taripa LIMIT 1";
      $result = $taripaModel->query($query);

      if (!empty($result)) {
        return date('F d, Y', strtotime($result[0]->effective_date));
      }
    }

    return null;
  }
}