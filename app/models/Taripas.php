<?php

class Taripas
{
  use Model;

  protected $table = 'taripa';
  protected $allowedColumns = [
    'taripa_id',
    'route_area',
    'barangay',
    'regular_rate',
    'student_rate',
    'senior_and_pwd_rate',
    'effective_year'
  ];
  protected $order_column = 'taripa_id';
}