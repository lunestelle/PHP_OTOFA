<?php

class Driver
{
  use Model;

  protected $table = 'drivers';
  protected $allowedColumns = ['first_name', 'last_name', 'middle_name', 'address', 'phone_no', 'birth_date', 'license_no', 'license_validity'];
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
    } else {
      $phoneNumber = $formData['phone_no'];

      if (strlen($phoneNumber) !== 10) {
        $errors[] = "Invalid phone number. Please enter <br> a valid 10-digit number after '+63'.";
      } elseif (!is_numeric(substr($phoneNumber, 3))) {
        $errors[] = "Invalid phone number. Please enter <br> only numeric digits (0-9).";
      }
    }

    if (empty($formData['birth_date'])) {
      $errors[] = "Birth Date is required.";
    } else {
      // Validate age is at least 18 years old
      $now = new DateTime();
      $birthDate = new DateTime($formData['birth_date']);
      $age = $now->diff($birthDate)->y;
      if ($age < 18) {
        $errors[] = "Driver must be at least 18 years old.";
      }
    }

    if (empty($formData['license_no'])) {
      $errors[] = "License No. is required.";
    }

    if (empty($formData['license_validity'])) {
      $errors[] = "License Validity is required.";
    }

    return $errors;
  }
}