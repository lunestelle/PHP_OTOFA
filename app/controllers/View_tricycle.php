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

    $tricycleApplicationModel = new TricycleApplication();
    $tricycleApplicationData = $tricycleApplicationModel->first(['tricycle_application_id' => $tricycleData->tricycle_application_id]);

    $tricycleCinModel = new TricycleCinNumber();
    $tricycleCinData =  $tricycleCinModel->first(['tricycle_cin_number_id' => $tricycleApplicationData->tricycle_cin_number_id]);

    $mtopModel = new MtopRequirement();
    $mtopNewFranchiseData =  $mtopModel->first(['mtop_requirement_id' => $tricycleData->mtop_requirements_new_franchise_id]);
    $mtopRenewalFranchiseData =  $mtopModel->first(['mtop_requirement_id' => $tricycleData->mtop_requirements_renewal_franchise_id]);
    $mtopTransferOwnershipData =  $mtopModel->first(['mtop_requirement_id' => $tricycleData->mtop_requirements_transfer_ownership_id]);
    $mtopIntentTransferData =  $mtopModel->first(['mtop_requirement_id' => $tricycleData->mtop_requirements_intent_of_transfer_id]);
    $mtopTransferFromDeceasedData =  $mtopModel->first(['mtop_requirement_id' => $tricycleData->mtop_requirements_transfer_from_deceased_id]);
    $mtopChangeMotorcycleData =  $mtopModel->first(['mtop_requirement_id' => $tricycleData->mtop_requirements_change_motorcycle_id]);

    $appointmentModel = new Appointment();
    $appointmentData =  $appointmentModel->first(['appointment_id' => $tricycleApplicationData->appointment_id]);

    $driverModel = new Driver();
    $driverData = $driverModel->first(['driver_id' => $tricycleApplicationData->driver_id]);

    $tricycleStatusesModel = new TricycleStatuses();
    $tricycleStatusesData = $tricycleStatusesModel->where(['tricycle_id' => $tricycleData->tricycle_id]);
    
    $statuses = [];
    foreach ($tricycleStatusesData as $tricycleStatusData) {
      $status = $tricycleStatusData->status;
      $statuses[] = $status;
    }
    
    $statusText = (count($statuses) > 1) ? implode(', ', $statuses) : (count($statuses) == 1 ? $statuses[0] : 'No Status');
    
    if (!$tricycleData) {
      set_flash_message("Tricycle not found.", "error");
    } elseif (!$tricycleApplicationData) {
      set_flash_message("Tricycle application data not found.", "error");
    } elseif (!$tricycleCinData) {
      set_flash_message("Tricycle CIN data not found.", "error");
    } elseif (!$appointmentData) {
      set_flash_message("Appointment data not found.", "error");
    }

    if (!$tricycleData || !$tricycleApplicationData || !$tricycleCinData || !$appointmentData) {
      redirect('tricycles');
    }

    $userModel = new User();
    $userData = $userModel->first(['user_id' => $tricycleData->user_id]);

    $data = [
      'tricycle_id' => $tricycleData->tricycle_id,
      'statuses' => $statusText,
      'cin' => $tricycleCinData ? $tricycleCinData->cin_number : 'N/A',
      'tricycleApplicationData' => $tricycleApplicationData,
      'appointmentType' => $appointmentData->appointment_type,
      'transferType' => $appointmentData->transfer_type,
      'mtopNewFranchiseData' => $mtopNewFranchiseData,
      'mtopRenewalFranchiseData' => $mtopRenewalFranchiseData,
      'mtopTransferOwnershipData' => $mtopTransferOwnershipData,
      'mtopIntentTransferData' => $mtopIntentTransferData,
      'mtopTransferFromDeceasedData' => $mtopTransferFromDeceasedData,
      'mtopChangeMotorcycleData' => $mtopChangeMotorcycleData,
    ];

    if ($driverData) {
      $data['driver_name'] = $driverData->first_name . ' ' . $driverData->middle_name . ' ' . $driverData->last_name;
    }

    $taripasModel = new Taripas();
    $rateAdjustmentModel = new RateAdjustment();
    $recentTaripaData = [];
    $rate_adjustments_years = [];
    $routeArea = $tricycleApplicationData->route_area;

    if ($routeArea === 'Free Zone & Zone 2') {
      $taripaData = $taripasModel->whereIn('route_area', ['Free Zone / Zone 1', 'Zone 2']);
    } else if ($routeArea === 'Free Zone & Zone 3') {
      $taripaData = $taripasModel->whereIn('route_area', ['Free Zone / Zone 1', 'Zone 3']);
    } else if ($routeArea === 'Free Zone & Zone 4') {
      $taripaData = $taripasModel->whereIn('route_area', ['Free Zone / Zone 1', 'Zone 4']);
    } else {
      $taripaData = $taripasModel->where(['route_area' => $routeArea]);
    }

    if (!empty($taripaData)) {
      $taripa_years = array_unique(array_map(function ($item) {
        return (new DateTime($item->effective_date))->format('Y');
      }, $taripaData));
    }

    $recentTaripaYear = max($taripa_years);

    if (!empty($rateAdjustmentModel->findAll())) {
      $rateAdjustmentsData = $rateAdjustmentModel->findAll();
      if (!empty($rateAdjustmentsData)) {
        $rate_adjustments_years = array_unique(array_map(function ($item) {
          return (new DateTime($item->effective_date))->format('Y');
        }, $rateAdjustmentsData));
      }
      $recentRateAdjustmentYear = max($rate_adjustments_years);
      $recentYear = max($recentTaripaYear, $recentRateAdjustmentYear);
    } else {
      $recentYear = $recentTaripaYear;
    }

    foreach ($taripaData as $index => $row) {
      // Check if the recent year is in the rate adjustments table
      $recentYearExists = in_array($recentYear, $rate_adjustments_years);

      if ($recentYearExists) {
        // Calculate regular_fare and discounted_fare for the recent year from rate adjustment data
        $recent_rate_adjustment = $rateAdjustmentModel->getYear($recentYear);
        $recent_rate_action = $recent_rate_adjustment->rate_action;
        $recent_percentage = $recent_rate_adjustment->percentage;
        $recent_previous_year = $recent_rate_adjustment->previous_year;

        // If the previous year is in the rate adjustments table, get its rates
        if (in_array($recent_previous_year, $rate_adjustments_years)) {
          $previous_rate_adjustment = $rateAdjustmentModel->first(['effective_date' => $recent_previous_year]);
          $previous_percentage = $previous_rate_adjustment->percentage;
          $previous_rate_action = $previous_rate_adjustment->rate_action;

          // Calculate the rates for the previous year
          $regular_fare = $row->regular_fare;
          $discounted_fare = $row->discounted_fare;

          if ($previous_rate_action === 'increase') {
            $previous_regular_fare = $regular_fare + ($regular_fare * $previous_percentage / 100);
            $previous_discounted_fare = $discounted_fare + ($discounted_fare * $previous_percentage / 100);
          } elseif ($previous_rate_action === 'decrease') {
            $previous_regular_fare = $regular_fare - ($regular_fare * $previous_percentage / 100);
            $previous_discounted_fare = $discounted_fare - ($discounted_fare * $previous_percentage / 100);
          }
        } else {
          // If the previous year is not in the rate adjustments table,
          // fetch regular_fare and discounted_fare directly from the taripa table
          $previous_regular_fare = $row->regular_fare;
          $previous_discounted_fare = $row->discounted_fare;
        }

        // Calculate regular_fare and discounted_fare for the recent year
        if ($recent_rate_action === 'increase') {
          $recent_regular_fare = $previous_regular_fare + ($previous_regular_fare * $recent_percentage / 100);
          $recent_discounted_fare = $previous_discounted_fare + ($previous_discounted_fare * $recent_percentage / 100);
        } elseif ($recent_rate_action === 'decrease') {
          $recent_regular_fare = $previous_regular_fare - ($previous_regular_fare * $recent_percentage / 100);
          $recent_discounted_fare = $previous_discounted_fare - ($previous_discounted_fare * $recent_percentage / 100);
        }
      } else {
        // If the recent year is not in the rate adjustments table,
        // fetch regular_fare, discounted_fare, and senior_and_pwd_rate directly from the taripa table
        $recent_regular_fare = $row->regular_fare;
        $recent_discounted_fare = $row->discounted_fare;
      }

      // Add the calculated rates to the recentTaripaData
      $recentTaripaData[] = [
        'route_area' => $row->route_area,
        'barangay' => $row->barangay,
        'regular_fare' => $recent_regular_fare,
        'discounted_fare' => $recent_discounted_fare,
      ];
    }

    // Pass recentTaripaData to the view
    $data['recentTaripaData'] = $recentTaripaData;
    $data['recentYear'] = $recentYear;

    echo $this->renderView('view_tricycle', true, $data);
  }
}