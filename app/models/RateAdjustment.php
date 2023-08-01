<?php

class RateAdjustment
{
  use Model;

  protected $table = 'rate_adjustments';
  protected $allowedColumns = [
    'rate_adjustment_id',
    'rate_action',
    'percentage',
    'effective_year',
    'previous_year',
    'created_at'
  ];
  protected $order_column = 'rate_adjustment_id';

  public function validate($data)
  {
    $errors = [];

    $requiredFields = ['rate_action', 'percentage', 'effective_year', 'previous_year'];

    foreach ($requiredFields as $field) {
      if (!isset($data[$field]) || empty($data[$field])) {
        $errors[] = "New taripa cannot be saved. Please try again.";
      }
    }

    return $errors;
  }
}