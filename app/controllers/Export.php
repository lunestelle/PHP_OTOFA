<?php

class Export
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
      redirect('');
    }

    $selectedData = isset($_POST['export_data']) ? $_POST['export_data'] : 'operators';

    $showOperatorFilter = true;
    $showDriverFilter = true;
    $showTaripaFilter = true;

    switch ($selectedData) {
      case 'operators':
        $exportData = $this->fetchOperatorsData();
        $showDriverFilter = false; // Hide Driver filter
        $showTaripaFilter = false; // Hide Taripa filter
        break;
      case 'drivers':
        $exportData = $this->fetchDriversData();
        $showOperatorFilter = false; // Hide Operator filter
        $showTaripaFilter = false; // Hide Taripa filter
        break;
      case 'taripa':
        $exportData = $this->fetchTaripaData();
        $showOperatorFilter = false; // Hide Operator filter
        $showDriverFilter = false; // Hide Driver filter
        break;
      default:
        $showOperatorFilter = true;
        $showDriverFilter = true;
        $showTaripaFilter = true;
    }

    $data = [
      'selectedData' => $selectedData,
      'exportData' => $exportData,
      'showOperatorFilter' => $showOperatorFilter,
      'showDriverFilter' => $showDriverFilter,
      'showTaripaFilter' => $showTaripaFilter,
    ];

    echo $this->renderView('export', true, $data);
  }



  private function fetchOperatorsData() {
    $userModel = new User();
    $operatorData = $userModel->where(['role' => 'operator']);

    $exportData = [];

    if (!empty($operatorData)) {
      foreach ($operatorData as $user) {
        $exportData[] = [
          'full_name' => $user->first_name . ' ' . $user->last_name,
          'phone_number' => $user->phone_number,
          'email' => $user->email,
          'address' => $user->address,
        ];
      }
    }

    return $exportData;
  }

  private function fetchDriversData() {
    $driverModel = new Driver();
    $driversData = $driverModel->findAll();

    $exportData = [];

    if (!empty($driversData)) {
      foreach ($driversData as $driver) {
        $exportData[] = [
          'name' => $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name,
          'birthdate' => $driver->birth_date,
          'address' => $driver->address,
          'phone_no' => $driver->phone_no,
          'license_no' => $driver->license_no,
        ];
      }
    }

    return $exportData;
  }

  private function fetchTaripaData() {
    $taripaModel = new Taripas();
    $taripasData = $taripaModel->findAll();

    $exportData = [];

    if (!empty($taripasData)) {
      foreach ($taripasData as $taripa) {
        $exportData[] = [
          'route_area' => $taripa->route_area,
          'barangay' => $taripa->barangay,
          'regular_rate' => $taripa->regular_rate,
          'student_rate' => $taripa->student_rate,
          'senior_and_pwd_rate' => $taripa->senior_and_pwd_rate,
        ];
      }
    }

    return $exportData;
  }
}
