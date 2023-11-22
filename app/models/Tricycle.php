<?php

class Tricycle
{
  use Model;

  protected $table = 'tricycles';
  protected $order_column = 'tricycle_id';
  protected $allowedColumns = ['make_model', 'year_acquired', 'color_code', 'route_area', 'plate_no', 'driver_id', 'or_no', 'or_date', 'tricycle_status'];

  public function validateData($data)
  {
    $errors = [];

    if (empty($data['make_model']) || empty($data['year_acquired']) || empty($data['color_code']) ||
      empty($data['route_area']) || empty($data['plate_no']) || empty($data['driver_id']) ||
      empty($data['or_no']) || empty($data['or_date'])) {
      $errors[] = 'All fields are required.';
    }

    return $errors;
  }
}