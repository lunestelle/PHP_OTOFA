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

        $data = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
          $exportData = $_POST['export_data'];

          switch ($exportData) {
              case 'operators':
                  $data = $this->fetchOperatorsData();
                  break;
              case 'drivers':
                  $data = $this->fetchDriversData();
                  break;
              case 'taripa':
                  $data = $this->fetchTaripaData();
                  break;
              default:
                  $data = $this->fetchOperatorsData(); // Default to operators
          }

          // Return the data as JSON
          echo json_encode($data);
          exit();
      }
  
    

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

    $customOrder = [
      'Free Zone / Zone 1',
      'Zone 2',
      'Zone 3',
      'Zone 4',
    ];

    $exportData = [];

    if (!empty($taripasData)) {
      // Sort the data based on custom order
      usort($taripasData, function ($a, $b) use ($customOrder) {
        $aIndex = array_search($a->route_area, $customOrder);
        $bIndex = array_search($b->route_area, $customOrder);
        return $aIndex - $bIndex;
      });

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


  private function exportDataToCSV($data)
    {
        // Implement logic to export data to CSV format
        // You can use fputcsv() function or any CSV library for this purpose

        // Example:
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="exported_data.csv"');

        $output = fopen('php://output', 'w');

        // Output CSV headers
        fputcsv($output, array_keys($data[0]));

        // Output CSV data
        foreach ($data as $row) {
            fputcsv($output, $row);
        }

        fclose($output);

        // Terminate script after exporting data
        exit();
    }
}
