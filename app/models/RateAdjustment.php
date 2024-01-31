<?php

class RateAdjustment
{
  use Model;

  protected $table = 'rate_adjustments';
  protected $allowedColumns = [
    'rate_adjustment_id',
    'rate_action',
    'percentage',
    'effective_date',
    'previous_year',
    'created_at'
  ];
  protected $order_column = 'rate_adjustment_id';

  public function validate($data)
  {
    $errors = [];

    $requiredFields = ['rate_action', 'percentage', 'effective_date', 'previous_year'];

    foreach ($requiredFields as $field) {
      if (!isset($data[$field]) || empty($data[$field])) {
        $errors[] = "New taripa cannot be saved. Please try again.";
      }
    }

    return $errors;
  }

  public function getYear($year) {
    $query = "SELECT * FROM {$this->table} WHERE YEAR(effective_date) = :year";
    $params = array(':year' => $year);
  
    $result = $this->query($query, $params);

    if (!$result || empty($result)) {
      return false; 
    }

    return $result[0];
  }
}