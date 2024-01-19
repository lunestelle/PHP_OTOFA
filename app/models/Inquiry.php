<?php

class Inquiry
{
  use Model;

  protected $table = 'inquiry';
  protected $allowedColumns = [
    'full_name',
    'email_or_phone',
    'message',
    'message_status',
    'response', 
    'response_status', 
  ];
  protected $order_column = 'id';

  public function validate($data)
  {
    $errors = [];

    $requiredFields = [
      'full_name' => 'Full Name',
      'email_or_phone' => 'Email or Phone',
      'message' => 'Message',
    ];

    foreach ($requiredFields as $field => $fieldName) {
      if (empty($data[$field])) {
        $errors[] = $fieldName . ' is required.';
      }
    }

    $emailOrPhone = $data['email_or_phone'];

    if (empty($emailOrPhone)) {
      $errors[] = "Email or Phone is required.";
    } elseif (!filter_var($emailOrPhone, FILTER_VALIDATE_EMAIL) && !preg_match('/^\+?63\d{10}$/', $emailOrPhone)) {
      $errors[] = "Invalid Email or Phone format. Please enter a valid email <br>address or a valid phone number (starting with +63).";
    }

    return $errors;
  }
}