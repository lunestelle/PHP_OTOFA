<?php 

class Drivers
{
	use Controller;

	public function index()
	{
		if (!is_authenticated()) {
			set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
			redirect('');
		}

		$driverModel = new Driver();
    $driversData = $driverModel->findAll();

    $data['drivers'] = [];
		$data['index'] = 1;

		if (!empty($driversData)) {
      foreach ($driversData as $driver) {
        $data['drivers'][] = [
          'name' => $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name,
          'birthdate' => $driver->birth_date,
          'address' => $driver->address,
          'phone_no' => $driver->phone_no,
          'license_no' => $driver->license_no,
          'license_validity' => $driver->license_validity
        ];
      }
    }

		echo $this->renderView('drivers', true, $data);
	}
}