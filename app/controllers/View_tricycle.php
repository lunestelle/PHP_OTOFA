<?php

class View_tricycle
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    $tricycleId = isset($_GET['tricycle_id']) ? $_GET['tricycle_id'] : null;

    $tricycleModel = new Tricycle();
    $tricycleData = $tricycleModel->first(['tricycle_id' => $tricycleId]);

    if (!$tricycleData) {
      set_flash_message("Tricycle not found.", "error");
      redirect('operators');
    }

    $driverModel = new Driver();
    $driverData = $driverModel->first(['driver_id' => $tricycleData->driver_id]);

    $documentModel = new Document();
    $frontViewImageData = $documentModel->first([
      'tricycle_id' => $tricycleId,
      'document_type' => 'Image',
      'filename' => 'tricycle front view'
    ]);

    $backViewImageData = $documentModel->first([
      'tricycle_id' => $tricycleId,
      'document_type' => 'Image',
      'filename' => 'tricycle back view'
    ]);

    $sideViewImageData = $documentModel->first([
      'tricycle_id' => $tricycleId,
      'document_type' => 'Image',
      'filename' => 'tricycle side view'
    ]);

    $data = [
      'plate_no' => $tricycleData->plate_no,
      'make_model' => $tricycleData->make_model,
      'year_acquired' => $tricycleData->year_acquired,
      'color_code' => $tricycleData->color_code,
      'route_area' => $tricycleData->route_area,
      'tricycle_status' => $tricycleData->tricycle_status,
      'driver_name' => isset($driverData) ? $driverData->first_name . ' ' . $driverData->middle_name . ' ' . $driverData->last_name : '',
      'or_no' => $tricycleData->or_no,
      'or_date' => $tricycleData->or_date,
      'front_view_image' => $frontViewImageData,
      'back_view_image' => $backViewImageData,
      'side_view_image' => $sideViewImageData,
    ];

    echo $this->renderView('view_tricycle', true, $data);
  }
}