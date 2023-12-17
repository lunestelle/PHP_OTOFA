<?php

class TricycleApplication
{
  use Model;

  protected $table = 'tricycle_applications';
  protected $allowedColumns = [
    'appointment_id',
    'driver_id',
    'tricycle_cin_number_id',
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
    'coc_no',
    'coc_no_expiry_date',
    'lto_cr_no',
    'lto_or_no',
    'driver_license_no',
    'driver_license_expiry_date'
  ];
  protected $order_column = 'tricycle_application_id';

  public function validate($data)
  {
    $errors = [];

    $requiredFields = [
      'operator_name' => 'Operator Name',
      'address' => 'Address',
      'mtop_no' => 'MTOP Number',
      'make_model' => 'Make Model',
      'make_model_expiry_date' => 'Model Expiry Date',
      'motor_number' => 'Motor Number',
      'insurer' => 'Insurer',
      // 'chasis_number' => 'Chassis Number',
      'coc_no' => 'COC Number',
      'coc_no_expiry_date' => 'COC Expiry Date',
      'route_area' => 'Route Area / Zone',
      'color_code' => 'Color Code',
      // ------- Didn't require the following because there are instances of tricycles that still have no driver like New Franchise -------
      // 'driver_id' => 'Driver Name',
      // 'driver_license_no' => 'Driver License Number',
      // 'driver_license_expiry_date' => 'Driver License Expiry Date',
    ];

    foreach ($requiredFields as $field => $fieldName) {
      if (empty($data[$field])) {
        $errors[] = $fieldName . ' is required.';
      }
    }

    if (empty($data['tricycle_phone_number'])) {
      $errors[] = "Tricycle Application Phone Number is required.";
    } else {
      $phoneNumber = $data['tricycle_phone_number'];
  
      if (strlen($phoneNumber) !== 10) {
        $errors[] = "Invalid tricycle application phone number. Please <br> enter a valid 10-digit number after '+63'.";
      } elseif (!is_numeric(substr($phoneNumber, 3))) {
        $errors[] = "Invalid tricycle application phone number. Please <br> enter only numeric digits (0-9) after '+63'.";
      } elseif (strpos($phoneNumber, '+63') === 0) {
        $errors[] = "Invalid tricycle application phone number. Please <br> type only the next digit after '+63'.";
      }
    }

    foreach (['make_model_expiry_date', 'coc_no_expiry_date', 'driver_license_expiry_date'] as $dateField) {
      if (!empty($data[$dateField]) && !strtotime($data[$dateField])) {
        $errors[] = ucfirst(str_replace('_', ' ', $dateField)) . ' must be a valid date.';
      }
    }

    // Check if a driver is chosen before validating driver's license details
    if (!empty($data['driver_id']) || !empty($data['driver_name'])) {
      $requiredDriverFields = [
        'driver_license_no' => 'Driver License Number',
        'driver_license_expiry_date' => 'Driver License Expiry Date',
      ];

      foreach ($requiredDriverFields as $field => $fieldName) {
        if (empty($data[$field])) {
          $errors[] = $fieldName . ' is required for the selected driver.';
        }
      }
    }

    // if (!empty($data['tricycle_cin_number_id'])) {
    //   $requiredTricycleFields = [
    //     'lto_cr_no' => 'LTO CR Number',
    //     'lto_or_no' => 'LTO OR Number',
    //   ];

    //   foreach ($requiredTricycleFields as $field => $fieldName) {
    //     if (empty($data[$field])) {
    //       $errors[] = $fieldName . ' is required for the selected tricycle CIN.';
    //     }
    //   }
    // }

    return $errors;
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