<?php

class MaintenanceLog
{
  use Model;

  protected $table = 'maintenance_logs';
  protected $order_column = 'maintenance_log_id';
  protected $allowedColumns = [
    'maintenance_log_id',
    'user_id',
    'tricycle_cin_number_id',
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
      'tricycle_cin_number_id' => 'Tricycle CIN',
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

  public function distinctYears()
  {
    $query = "SELECT DISTINCT YEAR(expense_date) as year FROM $this->table ORDER BY year DESC";
    
    $result = $this->query($query);

    if (!is_array($result)) {
      return [];
    }

    $years = [];
    foreach ($result as $row) {
      $years[] = $row->year;
    }

    return $years;
  }

  public function distinctOperators()
  {
    $query = "SELECT DISTINCT CONCAT(users.first_name, ' ', users.last_name) AS operator_name FROM $this->table JOIN tricycle_cin_numbers ON maintenance_logs.tricycle_cin_number_id = tricycle_cin_numbers.tricycle_cin_number_id JOIN users ON tricycle_cin_numbers.user_id = users.user_id";

    return $this->query($query);
  }

  public function getMaintenanceData($selectedYear)
  {
    $userId = $_SESSION['USER']->user_id;
    $whereClause = ($selectedYear != 'all') ? "WHERE YEAR(expense_date) = '$selectedYear' AND tricycle_cin_numbers.user_id = '$userId'" : "WHERE tricycle_cin_numbers.user_id = '$userId' AND maintenance_logs.user_id = '$userId'";   

    $query = "SELECT tricycle_cin_numbers.cin_number, CONCAT(users.first_name, ' ', users.last_name) AS operator_name, CONCAT(drivers.first_name, ' ', drivers.middle_name, ' ', drivers.last_name) AS driver_name, YEAR(expense_date) AS year, SUM(total_expenses) AS yearly_total_expenses FROM $this->table JOIN tricycle_cin_numbers ON maintenance_logs.tricycle_cin_number_id = tricycle_cin_numbers.tricycle_cin_number_id JOIN users ON tricycle_cin_numbers.user_id = users.user_id LEFT JOIN drivers ON maintenance_logs.driver_id = drivers.driver_id $whereClause GROUP BY tricycle_cin_numbers.cin_number, CONCAT(users.first_name, ' ', users.last_name), drivers.first_name ORDER BY tricycle_cin_numbers.cin_number, MAX(expense_date) DESC";

    return $this->query($query);
  }

  public function getMaintenanceDataWithFilters($selectedYear, $selectedOperatorName)
    {
      $whereClause = '';
    
      if ($selectedYear !== 'all') {
        $whereClause .= " YEAR(expense_date) = '$selectedYear'";
      }
      if ($selectedOperatorName !== 'all') {
        if (!empty($whereClause)) {
          $whereClause .= " AND ";
        }
        $whereClause .= " CONCAT(users.first_name, ' ', users.last_name) = '$selectedOperatorName'";
      }
    
      $query = "SELECT tricycle_cin_numbers.cin_number, CONCAT(users.first_name, ' ', users.last_name) AS operator_name, CONCAT(drivers.first_name, ' ', drivers.middle_name, ' ', drivers.last_name) AS driver_name, YEAR(expense_date) AS year, SUM(total_expenses) AS yearly_total_expenses FROM $this->table JOIN tricycle_cin_numbers ON $this->table.tricycle_cin_number_id = tricycle_cin_numbers.tricycle_cin_number_id JOIN users ON tricycle_cin_numbers.user_id = users.user_id LEFT JOIN drivers ON $this->table.driver_id = drivers.driver_id";
    
      $whereClause .= " maintenance_logs.user_id = users.user_id";
    
      if (!empty($whereClause)) {
        $query .= " WHERE $whereClause";
      }
    
      $query .= " GROUP BY tricycle_cin_numbers.cin_number, CONCAT(users.first_name, ' ', users.last_name), drivers.first_name ORDER BY tricycle_cin_numbers.cin_number, MAX(expense_date) DESC";
    
      return $this->query($query);
    }

  public function getCalculationData($selectedYear, $tricycleCIN)
  {
    $whereClause = "";
    if (!empty($selectedYear) && $selectedYear !== 'all') {
      $whereClause = "AND YEAR(expense_date) = $selectedYear";
    }

    $query = "SELECT YEAR(expense_date) as `year`, description, SUM(total_expenses) as total_expenses FROM $this->table WHERE tricycle_cin_number_id = $tricycleCIN $whereClause GROUP BY `year`, description ORDER BY `year` DESC";

    return $this->query($query);
  }
}