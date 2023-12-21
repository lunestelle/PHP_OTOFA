<?php

class Operators
{
	use Controller;

	public function index()
	{
		if (!is_authenticated()) {
			set_flash_message("Oops! You need to be logged in to view this page.", "error");
			redirect('');
		}

		$userModel = new User();
		$tricycleCinModel = new TricycleCinNumber();
		$tricycleModel = new Tricycle();
		$driversModel = new Driver();
		$usersData = $userModel->where(['role' => 'operator']);
		$data['users'] = [];

		if (!empty($usersData)) {
			foreach ($usersData as $user) {
				$tricycleCinData = $tricycleCinModel->where(['user_id' => $user->user_id]);
				$driversData = $driversModel->where(['user_id' => $user->user_id]);
				$tricycles = [];
				$drivers = [];

				if (is_array($tricycleCinData) || is_object($tricycleCinData)) {
					foreach ($tricycleCinData as $tricycle) {
						$tricycleData = $tricycleModel->where(['cin_id' => $tricycle->tricycle_cin_number_id]);

						if (!empty($tricycleData)) {
							$tricycles[] = [
								'plate_no' => $tricycle->cin_number,
								'tricycle_cin_number_id' => $tricycle->tricycle_cin_number_id,
								'tricycle_id' => $tricycleData[0]->tricycle_id,
							];
						}
					}

					if (!empty($tricycles)) {
						array_multisort(array_column($tricycles, 'plate_no'), SORT_ASC, $tricycles);

						if (is_array($driversData) || is_object($driversData)) {
							foreach ($driversData as $driver) {
								$driverName = $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name;
								$drivers[] = [
									'driver_name' => $driverName,
									'driver_id' => $driver->driver_id,
								];
							}
						}

						usort($drivers, function ($a, $b) {
							return strcmp($a['driver_name'], $b['driver_name']);
						});

						$userData = [
							'user_id' => $user->user_id,
							'full_name' => $user->first_name . ' ' . $user->last_name,
							'phone_number' => $user->phone_number,
							'email' => $user->email,
							'address' => $user->address,
							'tricycles' => $tricycles,
							'drivers' => $drivers,
						];

						$data['users'][] = $userData;
					}
				}
			}
		}
		echo $this->renderView('operators', true, $data);
	}
}