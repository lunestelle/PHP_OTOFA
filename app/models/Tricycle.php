<?php

class Tricycle
{
  use Model;

  protected $table = 'tricycles';
  protected $order_column = 'tricycle_id';
  protected $allowedColumns = ['tricycle_id', 'make_model', 'year_acquired', 'color_code', 'route_area', 'plate_no', 'user_id', 'or_no', 'or_date', 'tricycle_status', 'front_view_image_path', 'back_view_image_path', 'side_view_image_path'];

  public function validateData($data)
  {
    $errors = [];

    if (empty($data['make_model'])) {
      $errors[] = 'Make/Model is required.';
    }

    if (empty($data['year_acquired'])) {
      $errors[] = 'Year Acquired is required.';
    } elseif (!is_numeric($data['year_acquired']) || $data['year_acquired'] > date('Y')) {
      $errors[] = 'Year Acquired should be a valid year and should not exceed the current year.';
    }

    if (empty($data['color_code'])) {
      $errors[] = 'Color Code is required.';
    }

    if (empty($data['route_area'])) {
      $errors[] = 'Route/Area is required.';
    }

    if (empty($data['plate_no'])) {
      $errors[] = 'Plate No. is required.';
    }

    if (empty($data['user_id'])) {
      $errors[] = 'Driver is required.';
    }

    if (empty($data['or_no'])) {
      $errors[] = 'OR No. is required.';
    }

    if (empty($data['or_date'])) {
      $errors[] = 'OR Date is required.';
    }

    if (empty($data['tricycle_status'])) {
      $errors[] = 'Tricycle Status is required.';
    }

    return $errors;
  }

  public function plateNumberExists($plateNo, $excludeTricycleId = null)
  {
    $conditions = ['plate_no' => $plateNo];

    // Exclude the current tricycle ID if available
    if ($excludeTricycleId !== null) {
      $conditions['tricycle_id !='] = $excludeTricycleId;
    }

    $result = $this->where($conditions);
    return !empty($result);
  }

  public function pluck($column)
  {
    $query = "SELECT {$column} FROM {$this->table}";
    $result = $this->query($query);

    if ($result !== false) {
      return array_column($result, $column);
    } else {
      return [];
    }
  }
}