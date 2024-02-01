<?php

class Taripas
{
  use Model;

  protected $table = 'taripa';
  protected $allowedColumns = [
    'route_area',
    'barangay',
    'regular_fare',
    'discounted_fare',
    'effective_date'
  ];
  protected $order_column = 'taripa_id';

  public function getRouteAreasByZone($zone)
  {
    $query = "SELECT barangay FROM {$this->table} WHERE route_area = ? ORDER BY taripa_id ASC";
    $result = $this->query($query, [$zone]);

    if (!is_array($result)) {
      return [];
    }

    $barangays = [];
    foreach ($result as $row) {
      $barangays[] = $row->barangay;
    }

    return $barangays;
  }
}