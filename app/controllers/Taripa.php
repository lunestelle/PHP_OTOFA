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

    // Define the required permissions for accessing the edit user page
    $requiredPermissions = [
      "Can view taripas"
    ];

    // Check if the logged-in user has the required permissions, unless they are an operator
    $userPermissions = isset($_SESSION['USER']->permissions) ? explode(', ', $_SESSION['USER']->permissions) : [];
    $userRole = isset($_SESSION['USER']->role) ? $_SESSION['USER']->role : '';
    if (!hasAnyPermission($requiredPermissions, $userPermissions) && $userRole !== 'operator') {
      set_flash_message("Access denied. You don't have the required permissions.", "error");
      redirect('');
    }

    $taripaModel = new Taripas();
    $rateAdjustmentModel = new RateAdjustment();
    $route_area = $_GET['route_area'] ?? null;
    $year = $_GET['year'] ?? null;
    $data['taripas'] = [];

    $rate_adjustments_years = [];

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

      // Loop through each taripa record to calculate regular_fare, discounted_fare, and senior_and_pwd_rate
      foreach ($taripasData as $taripa) {
        // Check if the selected year is in the rate adjustments table
        $selected_year_index = in_array($year, $rate_adjustments_years);

        if ($selected_year_index !== false) {
          // Calculate regular_fare, discounted_fare, and senior_and_pwd_rate for the selected year from rate adjustment data
          $rate_adjustment = $rateAdjustmentModel->getrecentYearData($year);

          if ($rate_adjustment) {
            $rate_action = $rate_adjustment['rate_action'];
            $percentage = $rate_adjustment['percentage'];
            $previous_year = $rate_adjustment['previous_year'];

            // If the previous year is in the rate adjustments table, get its rates
            if (in_array($previous_year, $rate_adjustments_years)) {
              $previous_rate_adjustment = $rateAdjustmentModel->getpreviousYearData($previous_year);
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

    $data['index'] = 1;

    if (!empty($taripasData)) {
      // Sort $taripasData by 'taripa_id' in ascending order
      usort($taripasData, function ($a, $b) {
        $aArray = (array)$a;
        $bArray = (array)$b;
        return $aArray['taripa_id'] <=> $bArray['taripa_id'];
      });
    

      foreach ($taripasData as $taripa) {
        $taripaArray = (array) $taripa;
    
        $data['taripas'][] = [
          'taripa_id' => $taripaArray['taripa_id'],
          'route_area' => $taripaArray['route_area'],
          'barangay' => $taripaArray['barangay'],
          'regular_fare' => $taripaArray['regular_fare'],
          'discounted_fare' => $taripaArray['discounted_fare'],
        ];
      }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exportCsv'])) {
      $csvData = [];
      $csvData[] = [$year . ' Taripa'];
      $csvData[] = ['Route Area', 'Barangay', 'Regular Fare', 'Discounted Fare'];
  
      // Sort the taripasData by Route Area and then alphabetically by Barangay
      usort($taripasData, function ($a, $b) {
        $routeAreaOrder = [
          'Free Zone / Zone 1', 'Zone 2', 'Zone 3', 'Zone 4'
        ];
        $routeAreaComparison = array_search($a['route_area'], $routeAreaOrder) - array_search($b['route_area'], $routeAreaOrder);
        return $routeAreaComparison !== 0 ? $routeAreaComparison : strnatcasecmp($a['barangay'], $b['barangay']);
      });
  
      foreach ($taripasData as $taripa) {
        $csvData[] = [
          $taripa['route_area'],
          $taripa['barangay'],
          number_format($taripa['regular_fare'], 2),
          number_format($taripa['discounted_fare'], 2),
        ];
      }
      
      downloadCsv($csvData, $year . '_Taripa_Export');
    }
  
    $data['selectedFilter'] = $selectedFilter;
    $data['years'] = $years;
    echo $this->renderView('taripa', true, $data);
  }
}