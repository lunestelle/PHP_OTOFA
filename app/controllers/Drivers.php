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

  $tricycleCinModel = new TricycleCinNumber();
  $tricycleCinData = $tricycleCinModel->findAll();

  $data['drivers'] = [];
  $data['index'] = 1;

  if (!empty($driversData)) {
    foreach ($driversData as $driver) {
      $tricyclePlateNo = '';

      if (!empty($tricycleCinData)){
        foreach ($tricycleCinData as $tricycle) {
          if ($driver->tricycle_cin_number_id === $tricycle->tricycle_cin_number_id) {
            $tricyclePlateNo = $tricycle->cin_number;
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