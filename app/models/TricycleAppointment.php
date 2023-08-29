<?php

class TricycleAppointment
{
  use Model;

  protected $table = 'tricycle_appointments';
  protected $allowedColumns = [
    'tricycle_appointment_id',
    'appointment_id',
    'operator_name',
    'tricycle_phone_number',
    'address',
    'mtop_no',
    'route_area',
    'color_code',
    'make_model',
    'make_model_expiry_date',
    'motor_number',
    'insurer',
    'chasis_number',
    'coc_no',
    'coc_no_expiry_date',
    'plate_number',
    'lto_cr_no',
    'lto_or_no',
    'driver_name',
    'driver_license_no',
    'driver_license_expiry_date',
  ];
  protected $order_column = 'tricycle_appointment_id';

  public function validate($data)
  {
    $errors = [];

    $requiredFields = [
      'operator_name' => 'Operator Name',
      'tricycle_phone_number' => 'Phone Number',
      'address' => 'Address',
      'mtop_no' => 'MTOP Number',
      'route_area' => 'Route Area',
      'color_code' => 'Color Code',
      'make_model' => 'Make Model',
      'make_model_expiry_date' => 'Make Model Expiry Date',
      'motor_number' => 'Motor Number',
      'insurer' => 'Insurer',
      'chasis_number' => 'Chasis Number',
      'coc_no' => 'COC Number',
      'coc_no_expiry_date' => 'COC Expiry Date',
      'plate_number' => 'Plate Number',
      'lto_cr_no' => 'LTO CR Number',
      'lto_or_no' => 'LTO OR Number',
      'driver_name' => 'Driver Name',
      'driver_license_no' => 'Driver License Number',
      'driver_license_expiry_date' => 'Driver License Expiry Date',
    ];

    foreach ($requiredFields as $field => $fieldName) {
      if (empty($data[$field])) {
        $errors[] = $fieldName . ' is required.';
      }
    }

    if (!empty($data['tricycle_phone_number']) && !preg_match('/^[0-9]{10}$/', $data['tricycle_phone_number'])) {
      $errors[] = 'Phone Number must be a valid 10-digit number after "+63".';
    }

    foreach (['make_model_expiry_date', 'coc_no_expiry_date', 'driver_license_expiry_date'] as $dateField) {
      if (!empty($data[$dateField]) && !strtotime($data[$dateField])) {
        $errors[] = ucfirst(str_replace('_', ' ', $dateField)) . ' must be a valid date.';
      }
    }

    return $errors;
  }
}