<?php

class TricycleAppointment
{
  use Model;

  protected $table = 'tricycle_appointments';
  protected $order_column = 'tricycle_appointment_id';
  protected $allowedColumns = [
    'tricycle_appointment_id',
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

  public function validate($data)
  {
    $errors = [];

    if (empty($data['operator_name'])) {
      $errors[] = 'Operator Name is required.';
    }

    if (empty($data['tricycle_phone_number'])) {
      $errors[] = 'Phone Number is required.';
    } elseif (!preg_match('/^[0-9]{10}$/', $data['tricycle_phone_number'])) {
      $errors[] = 'Phone Number must be a valid 10-digit number after "+63".';
    }

    if (empty($data['address'])) {
      $errors[] = 'Address is required.';
    }

    if (empty($data['mtop_no'])) {
      $errors[] = 'MTOP Number is required.';
    }

    if (empty($data['route_area'])) {
      $errors[] = 'Route Area is required.';
    }

    if (empty($data['color_code'])) {
      $errors[] = 'Color Code is required.';
    }

    if (empty($data['make_model'])) {
      $errors[] = 'Make Model is required.';
    }

    if (empty($data['make_model_expiry_date'])) {
      $errors[] = 'Make Model Expiry Date is required.';
    } elseif (!strtotime($data['make_model_expiry_date'])) {
      $errors[] = 'Make Model Expiry Date must be a valid date.';
    }

    if (empty($data['motor_number'])) {
      $errors[] = 'Motor Number is required.';
    }

    if (empty($data['insurer'])) {
        $errors[] = 'Insurer is required.';
    }

    if (empty($data['chasis_number'])) {
      $errors[] = 'Chasis Number is required.';
    }

    if (empty($data['coc_no'])) {
      $errors[] = 'COC Number is required.';
    }

    if (empty($data['coc_no_expiry_date'])) {
      $errors[] = 'COC Expiry Date is required.';
    } elseif (!strtotime($data['coc_no_expiry_date'])) {
      $errors[] = 'COC Expiry Date must be a valid date.';
    }

    if (empty($data['plate_number'])) {
      $errors[] = 'Plate Number is required.';
    }

    if (empty($data['lto_cr_no'])) {
      $errors[] = 'LTO CR Number is required.';
    }

    if (empty($data['lto_or_no'])) {
      $errors[] = 'LTO OR Number is required.';
    }

    if (empty($data['driver_name'])) {
      $errors[] = 'Driver Name is required.';
    }

    if (empty($data['driver_license_no'])) {
      $errors[] = 'Driver License Number is required.';
    }

    if (empty($data['driver_license_expiry_date'])) {
      $errors[] = 'Driver License Expiry Date is required.';
    } elseif (!strtotime($data['driver_license_expiry_date'])) {
      $errors[] = 'Driver License Expiry Date must be a valid date.';
    }

    return $errors;
  }
}