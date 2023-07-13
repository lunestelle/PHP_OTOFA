<?php

class Driver
{
  use Model;

  protected $table = 'drivers';
  protected $allowedColumns = ['first_name', 'last_name', 'middle_name', 'address', 'phone_no', 'birth_date', 'license_no', 'license_validity', 'tricycle_id'];
  protected $order_column = 'driver_id';

  public function validateData($formData)
  {
    $errors = [];

    if (empty($formData['first_name'])) {
      $errors[] = "First Name is required.";
    }

    if (empty($formData['last_name'])) {
      $errors[] = "Last Name is required.";
    }

    if (empty($formData['middle_name'])) {
      $errors[] = "Middle Name is required.";
    }

    if (empty($formData['address'])) {
      $errors[] = "Address is required.";
    }

    if (empty($formData['phone_no'])) {
      $errors[] = "Phone No. is required.";
    } elseif (!preg_match('/^[0-9]{10}$/', $formData['phone_no'])) {
      $errors[] = "Phone No. must be a 10-digit number.";
    }

    if (empty($formData['birth_date'])) {
      $errors[] = "Birth Date is required.";
    } elseif (!strtotime($formData['birth_date'])) {
      $errors[] = "Birth Date is invalid.";
    }

    if (empty($formData['license_no'])) {
      $errors[] = "License No. is required.";
    }

    if (empty($formData['license_validity'])) {
      $errors[] = "License Validity is required.";
    }

    if (empty($formData['tricycle_id'])) {
      $errors[] = "Plate No. is required.";
    }

    return $errors;
  }
}