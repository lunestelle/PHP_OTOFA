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
    $tricycleModel = new Tricycle();
    $tricycleCinModel = new TricycleCinNumber();
    $tricycleStatusModel = new TricycleStatuses();
    $driversModel = new Driver();
    $usersData = $userModel->where(['role' => 'operator']);
    $data['users'] = [];

    if (!empty($usersData)) {
      foreach ($usersData as $user) {
        $tricycles = [];
        $drivers = [];

        // Get tricycles for this operator
        $userTricycles = $tricycleModel->where(['user_id' => $user->user_id]);

        if (!empty($userTricycles)) {
          foreach ($userTricycles as $tricycle) {
            // Get cin_number for this tricycle from TricycleCinNumber model
            $tricycleCin = $tricycleCinModel->first(['tricycle_cin_number_id' => $tricycle->cin_id]);

            $tricycleStatuses = $tricycleStatusModel->where(['tricycle_id' => $tricycle->tricycle_id]);
            $statuses = [];

            // Filter statuses for Active or Dropped
            foreach ($tricycleStatuses as $status) {
              if ($status->status === 'Active' || $status->status === 'Dropped') {
                $statuses[] = $status->status;
              }
            }

            // If statuses array is not empty, it means it has Active or Dropped status and append status if it exists
            if (!empty($statuses)) {
              $statusString = implode(', ', $statuses);
              $tricycles[] = [
                'cin_number' => $tricycleCin->cin_number . ($statuses ? " ($statusString)" : ""),
                'tricycle_id' => $tricycle->tricycle_id,
              ];
            }
          }
        }

        if (!empty($tricycles)) {
          usort($tricycles, function ($a, $b) {
            return strcmp($a['cin_number'], $b['cin_number']);
          });

          $driversData = $driversModel->where(['user_id' => $user->user_id]);

          if (!empty($driversData)) {
            foreach ($driversData as $driver) {
              $driverName = $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name;
              $drivers[] = [
                'driver_name' => $driverName,
                'driver_id' => $driver->driver_id,
              ];
            }

            usort($drivers, function ($a, $b) {
              return strcmp($a['driver_name'], $b['driver_name']);
            });
          }

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

		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exportCsv'])) {
			$csvData = [];
			$csvData[] = ['List of Tricycle Operators'];
			$csvData[] = ['Full Name', 'Phone Number', 'Email', 'Address', 'Tricycles CIN', 'Drivers'];
	
			foreach ($data['users'] as $user) {
				$tricyclesCsv = empty($user['tricycles']) ? 'No Registered Tricycle' : implode(", ", array_column($user['tricycles'], 'cin_number'));
				$driversCsv = empty($user['drivers']) ? 'No Registered Driver' : implode(", ", array_column($user['drivers'], 'driver_name'));
				$csvData[] = [
					$user['full_name'],
					empty($user['phone_number']) ? '----------------' : $user['phone_number'],
					empty($user['email']) ? '' : $user['email'],
					empty($user['address']) ? '----------------' : $user['address'],
					$tricyclesCsv,
					$driversCsv,
				];
			}
		
			downloadCsv($csvData, 'Operators_Export');
		}
	
    echo $this->renderView('operators', true, $data);
  }
}