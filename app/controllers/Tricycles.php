<?php

class Tricycles
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
      redirect('');
    }

    $tricycleModel = new Tricycle();
    $tricyclesData = $tricycleModel->findAll();

    $driverModel = new Driver();
    $driversData = $driverModel->findAll();

    $data['tricycles'] = [];
    $data['index'] = 1;

    if (!empty($tricyclesData)) {
      foreach ($tricyclesData as $tricycle) {
        $driverName = '';
        foreach ($driversData as $driver) {
          if ($driver->driver_id === $tricycle->driver_id) {
            $driverName = $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name;
            break;
          }
        }

        $data['tricycles'][] = [
          'plate_no' => $tricycle->plate_no,
          'driver_name' => $driverName,
          'make_model' => $tricycle->make_model,
          'year_acquired' => $tricycle->year_acquired,
          'color_code' => $tricycle->color_code,
          'route_area' => $tricycle->route_area,
          'or_no' => $tricycle->or_no,
          'or_date' => $tricycle->or_date,
          'tricycle_status' => $tricycle->tricycle_status
        ];
      }
    }

    echo $this->renderView('tricycles', true, $data);
  }
}