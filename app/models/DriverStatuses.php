<?php

class DriverStatuses
{
  use Model;

  protected $table = 'driver_statuses';
  protected $allowedColumns = [
    'driver_id',
    'status',
  ];
  protected $order_column = 'created_at';
}