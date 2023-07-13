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

    // Validate make_model (required)
    if (empty($data['make_model'])) {
      $errors[] = 'Make/Model is required.';
    }

    // Validate year_acquired (required, numeric)
    if (empty($data['year_acquired'])) {
      $errors[] = 'Year Acquired is required.';
    } elseif (!is_numeric($data['year_acquired'])) {
      $errors[] = 'Year Acquired must be a numeric value.';
    }

    // Validate color_code (required)
    if (empty($data['color_code'])) {
      $errors[] = 'Color Code is required.';
    }

    // Validate route_area (required)
    if (empty($data['route_area'])) {
      $errors[] = 'Route Area is required.';
    }

    // Validate plate_no (required)
    if (empty($data['plate_no'])) {
      $errors[] = 'Plate No. is required.';
    }

    // Validate driver_id (required, numeric)
    if (empty($data['driver_id'])) {
      $errors[] = 'Driver ID is required.';
    } elseif (!is_numeric($data['driver_id'])) {
      $errors[] = 'Driver ID must be a numeric value.';
    }

    // Validate or_no (required)
    if (empty($data['or_no'])) {
      $errors[] = 'OR No. is required.';
    }

    // Validate or_date (required, date format)
    if (empty($data['or_date'])) {
      $errors[] = 'OR Date is required.';
    } elseif (!strtotime($data['or_date'])) {
      $errors[] = 'OR Date must be a valid date.';
    }

    // Validate file uploads
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