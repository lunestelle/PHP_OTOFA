<?php

class Tricycle
{
  use Model;

  protected $table = 'tricycles';
  protected $allowedColumns = [
    'user_id',
    'tricycle_application_id',
    'previous_tricycle_application_id',
    'status',
  ];

  protected $order_column = 'tricycle_id';
}
