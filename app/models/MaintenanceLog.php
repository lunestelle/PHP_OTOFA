<?php

class MaintenanceLog
{
  use Model;

  protected $table = 'maintenance_logs';
  protected $order_column = 'maintenance_log_id';
  protected $allowedColumns = [
    'maintenance_log_id',
    'user_id',
    'tricycle_id',
    'driver_id',
    'expense_date',
    'total_expenses',
    'description',
    'expenses_receipt_image_path',
    'created_at'
  ];

  public function validateData($data)
  {
    $errors = [];

    $requiredFields = [
      'tricycle_id' => 'Tricycle CIN',
      'driver_id' => 'Name of Driver',
      'expense_date' => 'Expense Date',
      'total_expenses' => 'Total Expenses',
      'description' => 'Description'
    ];

    foreach ($requiredFields as $field => $fieldName) {
      if (empty($data[$field])) {
        $errors[] = $fieldName . ' is required.';
      }
    }

    return $errors;
  }
}