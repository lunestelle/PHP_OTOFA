<?php

class Driver_data
{
  public function index()
  {
    header('Content-Type: application/json');

    $tricycleCinId = $_POST['tricycle_cin_number_id'] ?? '';

    if ($tricycleCinId) {
      $tricycleCinModel = new TricycleCinNumber();
      $driverModel = new Driver();

      $cinData = $tricycleCinModel->first(['tricycle_cin_number_id' => $tricycleCinId]);

      if ($cinData) {
        $driverData = $driverModel->first(['tricycle_cin_number_id' => $tricycleCinId]);

        $response = [
          'success' => true,
          'data' => [
            'driverData' => $driverData,
          ],
        ];

        echo json_encode($response);
        exit;
      }
    }

    $errorResponse = [
      'success' => false,
      'message' => 'Error fetching data',
    ];

    echo json_encode($errorResponse);
    exit;
  }
}