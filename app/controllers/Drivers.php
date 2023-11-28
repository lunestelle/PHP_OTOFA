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
  $driversData = $driverModel->where(['user_id' => $_SESSION['USER']->user_id]);

  $tricycleModel = new Tricycle();
  $tricyclesData = $tricycleModel->findAll();

  $data['drivers'] = [];
  $data['index'] = 1;

  if (!empty($driversData)) {
    foreach ($driversData as $driver) {
      $tricyclePlateNo = '';

      if (!empty($tricyclesData)){
        foreach ($tricyclesData as $tricycle) {
          if ($driver->tricycle_id === $tricycle->tricycle_id) {
            $tricyclePlateNo = $tricycle->plate_no;
            break;
          }
        }
      }
      
      $data['drivers'][] = [
        'driver_id' => $driver->driver_id,
        'name' => $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name,
        'birthdate' => $driver->birth_date,
        'address' => $driver->address,
        'phone_no' => $driver->phone_no,
        'license_no' => $driver->license_no,
        'license_validity' => $driver->license_validity,
        'tricycle_plate_number' => $tricyclePlateNo ?? '',
      ];
    }
  }

    echo $this->renderView('drivers', true, $data);
  }
}