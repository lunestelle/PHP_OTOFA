<?php

class Taripa
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
    $route_area = $_GET['route_area'] ?? null;
    $year = $_GET['year'] ?? null;
    $data['taripas'] = [];
    $data['index'] = 1;

    $rate_adjustments_years = [];

    $taripasData = $taripaModel->findAll();
    $taripa_years = array_unique(array_column($taripasData, 'effective_year'));

    // Check if there are rate adjustments available
    $rate_adjustments_exist = !empty($rateAdjustmentModel->findAll());

    // If rate adjustments exist, fetch years from the rate_adjustments table
    if ($rate_adjustments_exist) {
      $rateAdjustmentsData = $rateAdjustmentModel->findAll();
      $rate_adjustments_years = array_unique(array_column($rateAdjustmentsData, 'effective_year'));
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

    // If no route_area filter or 'All' is selected, fetch all data
    if (!$route_area || $route_area === 'All') {
      $taripasData = $taripaModel->findAll();
      $selectedFilter = 'All';
    } else {
      $taripasData = $taripaModel->where(['route_area' => $route_area]);
      $selectedFilter = $route_area;
    }

    // If no year filter is selected, set it to the latest available year
    if (!$year) {
      $year = reset($years);
    }

    // If a year filter is selected, get the data for that year
    if ($year) {
      $filteredData = [];

      // Loop through each taripa record to calculate regular_rate and discounted_rate
      foreach ($taripasData as $taripa) {
        // Check if the selected year is in the rate adjustments table
        $selected_year_index = array_search($year, $rate_adjustments_years);

        if ($selected_year_index !== false) {
          // Calculate regular_rate and discounted_rate for the selected year from rate adjustment data
          $rate_adjustment = $rateAdjustmentModel->first(['effective_year' => $year]);
          $rate_action = $rate_adjustment->rate_action;
          $percentage = $rate_adjustment->percentage;
          $previous_year = $rate_adjustment->previous_year;

          // If the previous year is in the rate adjustments table, get its rates
          if (in_array($previous_year, $rate_adjustments_years)) {
            $previous_rate_adjustment = $rateAdjustmentModel->first(['effective_year' => $previous_year]);
            $previous_percentage = $previous_rate_adjustment->percentage;
            $previous_rate_action = $previous_rate_adjustment->rate_action;

            // Calculate the rates for the previous year
            $previous_regular_rate = $taripa->regular_rate;
            $previous_discounted_rate = $taripa->discounted_rate;

            if ($previous_rate_action === 'increase') {
              $previous_regular_rate += $previous_regular_rate * $previous_percentage / 100;
              $previous_discounted_rate += $previous_discounted_rate * $previous_percentage / 100;
            } elseif ($previous_rate_action === 'decrease') {
              $previous_regular_rate -= $previous_regular_rate * $previous_percentage / 100;
              $previous_discounted_rate -= $previous_discounted_rate * $previous_percentage / 100;
            }
          } else {
            // If the previous year is not in the rate adjustments table,
            // fetch regular_rate and discounted_rate directly from the taripa table
            $previous_regular_rate = $taripa->regular_rate;
            $previous_discounted_rate = $taripa->discounted_rate;
          }

          // Calculate regular_rate and discounted_rate for the selected year
          if ($rate_action === 'increase') {
            $regular_rate = $previous_regular_rate + ($previous_regular_rate * $percentage / 100);
            $discounted_rate = $previous_discounted_rate + ($previous_discounted_rate * $percentage / 100);
          } elseif ($rate_action === 'decrease') {
            $regular_rate = $previous_regular_rate - ($previous_regular_rate * $percentage / 100);
            $discounted_rate = $previous_discounted_rate - ($previous_discounted_rate * $percentage / 100);
          }
        } else {
          // If the selected year is not in the rate adjustments table,
          // fetch regular_rate and discounted_rate directly from the taripa table
          $regular_rate = $taripa->regular_rate;
          $discounted_rate = $taripa->discounted_rate;
        }

        $filteredData[] = [
          'taripa_id' => $taripa->taripa_id,
          'route_area' => $taripa->route_area,
          'barangay' => $taripa->barangay,
          'regular_rate' => $regular_rate,
          'discounted_rate' => $discounted_rate,
        ];
      }

      $selectedFilter = $year;
      $taripasData = $filteredData;
    }

    if (!empty($taripasData)) {
      foreach ($taripasData as $taripa) {
        $data['taripas'][] = [
          'taripa_id' => $taripa['taripa_id'],
          'route_area' => $taripa['route_area'],
          'barangay' => $taripa['barangay'],
          'regular_rate' => $taripa['regular_rate'],
          'discounted_rate' => $taripa['discounted_rate'],
        ];
      }
    }

    $data['selectedFilter'] = $selectedFilter;
    $data['years'] = $years;
    echo $this->renderView('taripa', true, $data);
  }
}