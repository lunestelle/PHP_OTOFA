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
}