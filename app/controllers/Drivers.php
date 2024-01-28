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
    $driverStatusesModel = new DriverStatuses();
    $tricycleCinModel = new TricycleCinNumber();

    // Get tricycle plate CIN numbers owned by the current user
    $userTricycleCinNumbers = $tricycleCinModel->where(['user_id' => $_SESSION['USER']->user_id]);

    // Extract tricycle CIN number IDs from the objects
    $userTricycleCinIds = array_map(function($tricycleCin) {
      return $tricycleCin->tricycle_cin_number_id;
    }, $userTricycleCinNumbers);

    // Convert array of tricycle CIN numbers to comma-separated string
    $userTricycleCinIdsString = implode(',', $userTricycleCinIds);

    $query = "SELECT DISTINCT drivers.tricycle_cin_number_id
              FROM drivers
              JOIN driver_statuses ON drivers.driver_id = driver_statuses.driver_id
              WHERE drivers.tricycle_cin_number_id IN ($userTricycleCinIdsString)
              AND driver_statuses.status = 'Active'";

    $assignedTricycleCinIds = $driverModel->query($query);

    // Extract tricycle CIN number IDs from the objects returned by the query
    $assignedTricycleCinIds = array_map(function($result) {
      return $result->tricycle_cin_number_id;
    }, $assignedTricycleCinIds);

    // Filter out the unassigned tricycle plate CIN numbers
    $unassignedTricycleCinNumbers = array_diff($userTricycleCinIds, $assignedTricycleCinIds);

    // Check if there are any unassigned tricycle plate CIN numbers
    $data['showNewButton'] = !empty($unassignedTricycleCinNumbers);

    $tricycleCinData = $tricycleCinModel->findAll();

    $driversData = $driverModel->where(['user_id' => $_SESSION['USER']->user_id]);

    $data['drivers'] = [];
    $data['index'] = 1;

    foreach ($driversData as $driver) {
      $statuses = [];
      $driverStatus = $driverStatusesModel->where(['driver_id' => $driver->driver_id]);

      if (is_array($driverStatus) || is_object($driverStatus)) {
        foreach ($driverStatus as $status) {
          $statuses[] = [
            'status' => $status->status,
          ];
        }
      }

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
        'license_expiry_date' => $driver->license_expiry_date,
        'tricycle_plate_number' => $tricyclePlateNo ?? '',
        'statuses' => $statuses,
      ];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exportCsv'])) {
      $csvData = [];
      $csvData[] = ['Drivers'];
      $csvData[] = [
        'Name', 'Birthdate', 'Address', 'Phone No.', 'License Number', 'License Expiry Date', 'Tricycle Plate No.', 'Status'
      ];

      foreach ($data['drivers'] as $driver) {
        foreach ($driver['statuses'] as $status) {
          $csvData[] = [
            $driver['name'],
            $driver['birthdate'],
            $driver['address'],
            $driver['phone_no'],
            $driver['license_no'],
            $driver['license_expiry_date'],
            $driver['tricycle_plate_number'],
            $status['status'],
          ];
        }
      }

      downloadCsv($csvData, 'Drivers_Export');
    }

    echo $this->renderView('drivers', true, $data);
  }
}