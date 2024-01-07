<?php 

class Print_content
{
	use Controller;

	public function index()
	{
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
      set_flash_message("Invalid request method.", "error");
      redirect('');
    }
		
		$appointmentId = isset($_GET['appointment_id']) ? $_GET['appointment_id'] : null;

		$appointmentModel = new Appointment();
		$appointmentData = $appointmentModel->first(['appointment_id' => $appointmentId]);

		$tricycleApplicationModel = new TricycleApplication();
		$tricycleApplicationData = $tricycleApplicationModel->first(['appointment_id' => $appointmentId]);

		$tricycleCINModel = new TricycleCinNumber();
		$tricycleCINData = $tricycleCINModel->first(['tricycle_cin_number_id' => $tricycleApplicationData->tricycle_cin_number_id]);

		$driverModel = new Driver();
    $driverData = $driverModel->first(['driver_id' => $tricycleApplicationData->driver_id]);

		if (!$tricycleApplicationData) {
      set_flash_message("An error occured. Please try again.", "error");
      redirect('appointments');
    }

		$data = [
      'tricycleApplication' => $tricycleApplicationData,
			'cin' => $tricycleCINData->cin_number,
			'appointment_type' => $appointmentData->appointment_type,
    ];

		if ($driverData) {
      $data['driver_name'] = $driverData->first_name . ' ' . $driverData->middle_name . ' ' . $driverData->last_name;
    }


		echo $this->renderView('print_content', true, $data);
	}
}