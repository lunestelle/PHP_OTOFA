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

  public function getrecentYearData($recentYear) {
    $query = "SELECT * FROM {$this->table} WHERE YEAR(effective_date) = :recentYear LIMIT 1;";
    $params = array(':recentYear' => $recentYear);

    $result = $this->query($query, $params);
    
    if (!is_array($result)) {
      return [];
    }
    
    $recent_rate_adjustment = [
      'rate_action' => $result[0]->rate_action,
      'percentage' => $result[0]->percentage,
      'previous_year' => $result[0]->previous_year,
    ];

    return $recent_rate_adjustment;
  }

  public function getpreviousYearData($recent_previous_year) {
    $query = "SELECT * FROM {$this->table} WHERE YEAR(effective_date) = :recent_previous_year LIMIT 1;";
    $params = array(':recent_previous_year' => $recent_previous_year);

    $result = $this->query($query, $params);
    
    if (!is_array($result)) {
      return [];
    }
    
    $previous_rate_adjustment = [
      'rate_action' => $result[0]->rate_action,
      'percentage' => $result[0]->percentage,
      'previous_year' => $result[0]->previous_year,
    ];

    return $previous_rate_adjustment;
  }
}