<?php

class Driver_data
{
  public function index()
  {
    header('Content-Type: application/json');

    $userId = $_SESSION['USER']->user_id ?? null;

    if ($userId) {
      $tricycleCinId = $_POST['tricycle_cin_number_id'] ?? '';

      if ($tricycleCinId) {
        $tricycleCinModel = new TricycleCinNumber();
        $driverModel = new Driver();

        $cinData = $tricycleCinModel->first(['tricycle_cin_number_id' => $tricycleCinId]);

        if ($cinData) {
          $query = "SELECT drivers.* 
                    FROM drivers 
                    JOIN driver_statuses ON drivers.driver_id = driver_statuses.driver_id 
                    WHERE drivers.tricycle_cin_number_id = :tricycle_cin_id 
                    AND driver_statuses.status = 'Active'
                    AND drivers.user_id = :user_id";

          $driverData = $driverModel->query($query, [
            ':tricycle_cin_id' => $tricycleCinId,
            ':user_id' => $userId
          ]);

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
    } else {
      // Handle case where user ID is not found in session
      $errorResponse = [
        'success' => false,
        'message' => 'User session not found',
      ];

      echo json_encode($errorResponse);
      exit;
    }
  }
}