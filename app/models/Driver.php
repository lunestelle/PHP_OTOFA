<?php

class Driver
{
  use Model;

  protected $table = 'drivers';
  protected $allowedColumns = ['first_name', 'last_name', 'middle_name', 'address', 'phone_no', 'birth_date', 'license_no', 'license_expiry_date', 'user_id', 'tricycle_cin_number_id', 'last_notification_date'];
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
        $errors[] = "Invalid phone number. Please enter <br> only numeric digits (0-9) after '+63'.";
      } elseif (strpos($phoneNumber, '+63') === 0) {
        $errors[] = "Invalid phone number. Please type <br> only the next digit after '+63'.";
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
      $errors[] = "License Number is required.";
    }

    if (empty($formData['license_expiry_date'])) {
      $errors[] = "License Expiry Date is required.";
    } else {
      // Check if the license expiry date is not in the past
      $expiryDate = new DateTime($formData['license_expiry_date']);
      $currentDate = new DateTime();
      
      if ($expiryDate <= $currentDate) {
        $errors[] = "License Expiry Date must be in the future.";
      }
    }

    if (empty($formData['tricycle_cin_number_id'])) {
      $errors[] = "Tricycle CIN Number is required.";
    }
    
    return $errors;
  }
}