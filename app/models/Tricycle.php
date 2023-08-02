<?php

class Tricycle
{
  use Model;

  protected $table = 'tricycles';
  protected $allowedColumns = [
    'make_model',
    'year_acquired',
    'color_code',
    'route_area',
    'plate_no',
    'driver_id',
    'or_no',
    'or_date',
    'tricycle_status'
  ];
  protected $order_column = 'tricycle_id';

  public function validate($data)
  {
    $errors = [];

    if (empty($data['make_model'])) {
      $errors[] = 'Make/Model is required.';
    }

    if (empty($data['year_acquired'])) {
      $errors[] = 'Year Acquired is required.';
    } elseif (!is_numeric($data['year_acquired'])) {
      $errors[] = 'Year Acquired must be a numeric value.';
    }

    if (empty($data['color_code'])) {
      $errors[] = 'Color Code is required.';
    }

    if (empty($data['route_area'])) {
      $errors[] = 'Route Area is required.';
    }

    if (empty($data['plate_no'])) {
      $errors[] = 'Plate No. is required.';
    } else {
      $existingPlate = $this->where(['plate_no' => $data['plate_no']]);
      if ($existingPlate) {
        $errors[] = 'Plate No. already exists in the system.';
      }
    }

    if (empty($data['driver_id'])) {
      $errors[] = 'Driver ID is required.';
    } elseif (!is_numeric($data['driver_id'])) {
      $errors[] = 'Driver ID must be a numeric value.';
    }

    if (empty($data['or_no'])) {
      $errors[] = 'OR No. is required.';
    } else {
      $existingOR = $this->where(['or_no' =>$data['or_no']]);
      if ($existingOR) {
        $errors[] = 'OR No. already exists in the system.';
      }
    }

    if (empty($data['or_date'])) {
      $errors[] = 'OR Date is required.';
    } elseif (!strtotime($data['or_date'])) {
      $errors[] = 'OR Date must be a valid date.';
    }

    if (empty($_FILES['tricycle_operator_permit']['tmp_name'])) {
      $errors[] = 'Tricycle Operator Permit file is required.';
    }

    if (empty($_FILES['tricycle_images']['tmp_name'][0])) {
      $errors[] = 'Tricycle Images files (Front, Back, & Sides) are required.';
    }

    if (empty($_FILES['certificate_of_registration']['tmp_name'])) {
      $errors[] = 'Certificate of Registration (CR) file is required.';
    }

    if (empty($_FILES['official_receipt']['tmp_name'])) {
      $errors[] = 'Official Receipt (OR) file is required.';
    }

    return $errors;
  }
}