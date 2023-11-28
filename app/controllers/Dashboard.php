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

		echo $this->renderView('dashboard', true, $data);
	}
}