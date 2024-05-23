<?php

class Dashboard
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
      redirect('');
    }

    $tricycleModel = new Tricycle();
    $tricycleStatusesModel = new TricycleStatuses;
    $data['activeTricycleCount'] = $tricycleStatusesModel->count(['status' => 'Active']);
    $data['userTricycleCount'] = $tricycleStatusesModel->count(['status' => 'Active', 'user_id' => $_SESSION['USER']->user_id]);

    $userModel = new User();
    $data['operatorCount'] = $userModel->countOperatorsWithActiveOrDroppedTricycleStatus();

    $appointmentModel = new Appointment();
    $data['pendingAppointmentCount'] = $appointmentModel->count(['status' => 'Pending']);
    $data['userPendingAppointmentCount'] = $appointmentModel->count(['status' => 'Pending', 'user_id' => $_SESSION['USER']->user_id]);

    $driverModel = new Driver();
    $data['userDriverCount'] = $driverModel->count(['user_id' => $_SESSION['USER']->user_id]);

    $cinModel = new TricycleCinNumber();
    $data['userHasCin'] = $cinModel->getCinNumberIdByUserId($_SESSION['USER']->user_id) !== null;

    // DASHBOARD FRANCHISE AVAILED CHART DATA
    $usedYearsData = $cinModel->getUsedYears();
    $chartData = [];

    foreach ($usedYearsData as $year => $count) {
      $chartData[] = array(
        'count' => $count,
        'year' => $year
      );
    }

    $data['chartData'] = $chartData;

    $taripaModel = new Taripas();
    $rateAdjustmentModel = new RateAdjustment();

    // Fetch all taripas data
    $taripasData = $taripaModel->findAll();

    // Fetch all rate adjustments data
    $rateAdjustmentsData = $rateAdjustmentModel->findAll();

    // Extract unique years from both taripas and rate adjustments data effective date
    $taripaYears = [];
    $rateAdjustmentYears = [];
    if (!empty($taripasData)) {
      $taripaYears = array_unique(array_map(function ($item) {
        return (new DateTime($item->effective_date))->format('Y');
      }, $taripasData));
    }

    if (!empty($rateAdjustmentsData)) {
      $rateAdjustmentYears = array_unique(array_map(function ($item) {
        return (new DateTime($item->effective_date))->format('Y');
      }, $rateAdjustmentsData));
    }

    // Merge and sort the years in descending order
    $years = array_unique(array_merge($taripaYears, $rateAdjustmentYears));
    rsort($years);

    // Calculate rates for each year
    $ratesByYear = [];
    foreach ($years as $year) {
      $ratesByYear[$year] = $this->calculateRatesForYear($taripasData, $rateAdjustmentsData, $year);
    }

    $data['years'] = $years;
    $data['ratesByYear'] = json_encode($ratesByYear);

    echo $this->renderView('dashboard', true, $data);
  }

  private function calculateRatesForYear($taripasData, $rateAdjustmentsData, $year)
  {
    $rates = [];

    foreach ($taripasData as $taripa) {
      $regularRate = $taripa->regular_fare;
      $studentRate = $taripa->discounted_fare;

      // Check if $rateAdjustmentsData is an array before filtering
      if (is_array($rateAdjustmentsData)) {
        $filteredAdjustments = array_filter($rateAdjustmentsData, function ($adjustment) use ($year) {
          return (new DateTime($adjustment->effective_date))->format('Y') == $year;
        });

        if (!empty($filteredAdjustments)) {
          $rateAdjustment = reset($filteredAdjustments);
          $rateAction = $rateAdjustment->rate_action;
          $percentage = $rateAdjustment->percentage;
          $previousYear = $rateAdjustment->previous_year;

          // If there is a previous year, get the rates from that year
          $previousRates = [];
          foreach ($rateAdjustmentsData as $adjustment) {
            if ((new DateTime($adjustment->effective_date))->format('Y') == $previousYear) {
              $previousRates = $this->calculateRatesForYear($taripasData, $rateAdjustmentsData, $previousYear);
            }
          }

          // Calculate rates based on rate action
          if ($rateAction == 'increase') {
            $regularRate += $regularRate * ($percentage / 100);
            $studentRate += $studentRate * ($percentage / 100);
          } elseif ($rateAction == 'decrease') {
            $regularRate -= $regularRate * ($percentage / 100);
            $studentRate -= $studentRate * ($percentage / 100);
          }
        }
      }

      $rates[$taripa->taripa_id] = [
        'regular_fare' => $regularRate,
        'discounted_fare' => $studentRate,
      ];
    }

    return $rates;
  }
}