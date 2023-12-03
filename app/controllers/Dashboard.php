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

		$userModel = new User();
    $data['operatorCount'] = $userModel->count(['role' => 'operator']);

    $tricycleModel = new Tricycle();
    $data['activeTricycleCount'] = $tricycleModel->count(['tricycle_status' => 'Active']);
		$data['userTricycleCount'] = $tricycleModel->count(['tricycle_status' => 'Active', 'user_id' => $_SESSION['USER']->user_id]);

		$appointmentModel = new Appointment();
    $data['pendingAppointmentCount'] = $appointmentModel->count(['status' => 'Pending']);
		$data['userPendingAppointmentCount'] = $appointmentModel->count(['status' => 'Pending', 'user_id' => $_SESSION['USER']->user_id]);
		
		$driverModel = new Driver();
		$data['userDriverCount'] = $driverModel->count(['user_id' => $_SESSION['USER']->user_id]);

		$taripaModel = new Taripas();
		$rateAdjustmentModel = new RateAdjustment();

		// Fetch all taripas data
		$taripasData = $taripaModel->findAll();

		// Fetch all rate adjustments data
		$rateAdjustmentsData = $rateAdjustmentModel->findAll();

		// Extract unique years from both taripas and rate adjustments data
		$taripaYears = array_unique(array_column($taripasData, 'effective_year'));
		$rateAdjustmentYears = array_unique(array_column($rateAdjustmentsData, 'effective_year'));

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
			$regularRate = $taripa->regular_rate;
			$studentRate = $taripa->student_rate;
			$seniorAndPwdRate = $taripa->senior_and_pwd_rate;
			
			$rateAdjustment = array_filter($rateAdjustmentsData, function ($adjustment) use ($year) {
				return $adjustment->effective_year == $year;
			});

			if (!empty($rateAdjustment)) {
				$rateAdjustment = reset($rateAdjustment);
				$rateAction = $rateAdjustment->rate_action;
				$percentage = $rateAdjustment->percentage;
				$previousYear = $rateAdjustment->previous_year;

				// If there is a previous year, get the rates from that year
				if (in_array($previousYear, array_column($rateAdjustmentsData, 'effective_year'))) {
					$previousRates = $this->calculateRatesForYear($taripasData, $rateAdjustmentsData, $previousYear);
					$previousRegularRate = $previousRates[$taripa['taripa_id']]['regular_rate'];
					$previousStudentRate = $previousRates[$taripa['taripa_id']]['student_rate'];
					$previousSeniorAndPwdRate = $previousRates[$taripa['taripa_id']]['senior_and_pwd_rate'];
				} else {
					// If no previous year or the previous year is not in rate adjustments, use the taripa data
					$previousRegularRate = $taripa->regular_rate;
					$previousStudentRate = $taripa->student_rate;
					$previousSeniorAndPwdRate = $taripa->senior_and_pwd_rate;
				}

				// Calculate rates based on rate action
				if ($rateAction == 'increase') {
					$regularRate += $previousRegularRate * ($percentage / 100);
					$studentRate += $previousStudentRate * ($percentage / 100);
					$seniorAndPwdRate += $previousSeniorAndPwdRate * ($percentage / 100);
				} elseif ($rateAction == 'decrease') {
					$regularRate -= $previousRegularRate * ($percentage / 100);
					$studentRate -= $previousStudentRate * ($percentage / 100);
					$seniorAndPwdRate -= $previousSeniorAndPwdRate * ($percentage / 100);
				}
			}

			$rates[$taripa->taripa_id] = [
				'regular_rate' => $regularRate,
				'student_rate' => $studentRate,
				'senior_and_pwd_rate' => $seniorAndPwdRate,
			];
		}

		return $rates;
	}
}