<?php 
// Database operations such as findAll(), where(), first(), insert(), update(), and delete(). 
Trait Model
{
  use Database;

  protected $order_type = "desc";
  public $errors = [];

  public function findAll()
  {
    $query = "SELECT * FROM {$this->table} ORDER BY {$this->order_column} {$this->order_type}";

    return $this->query($query);
  }

  public function where($data, $data_not = [])
  {
    $keys = array_keys($data);
    $keys_not = array_keys($data_not);
    $query = "SELECT * FROM {$this->table} WHERE ";

    foreach ($keys as $key) {
      $query .= $key . " = :". $key . " && ";
    }

    foreach ($keys_not as $key) {
      $query .= $key . " != :". $key . " && ";
    }

    $query = trim($query, " && ");

    $query .= " order by $this->order_column $this->order_type";
    $data = array_merge($data, $data_not);

    return $this->query($query, $data);
  }

  public function whereNot($data)
  {
    $keys = array_keys($data);
    $query = "SELECT * FROM {$this->table} WHERE ";

    foreach ($keys as $key) {
      $query .= $key . " != :" . $key . " AND ";
    }

    $query = rtrim($query, " AND ");
    $query .= " ORDER BY {$this->order_column} {$this->order_type}";

    return $this->query($query, $data);
  }

    public function whereIn($column, $values)
  {
    $placeholders = implode(', ', array_fill(0, count($values), '?'));
    $query = "SELECT * FROM {$this->table} WHERE {$column} IN ({$placeholders}) ORDER BY {$this->order_column} {$this->order_type}";

    return $this->query($query, $values);
  }

  public function first($data, $data_not = [])
  {
    $keys = array_keys($data);
    $keys_not = array_keys($data_not);
    $query = "SELECT * FROM {$this->table} WHERE ";

    foreach ($keys as $key) {
      $query .= $key . " = :". $key . " && ";
    }

    foreach ($keys_not as $key) {
      $query .= $key . " != :". $key . " && ";
    }   

    $query = trim($query, " && ");

    $query .= "";
    $data = array_merge($data, $data_not);

    $result = $this->query($query, $data);
    if (!empty($result)) {
      return $result[0];
    }

    return false;
  }

  public function insert($data)
  {
    /** remove unwanted data **/
    if (!empty($this->allowedColumns)) {
      foreach ($data as $key => $value) {
        if (!in_array($key, $this->allowedColumns)) {
          unset($data[$key]);
        }
      }
    }

    $keys = array_keys($data);
    $query = "INSERT INTO {$this->table} (" . implode(",", $keys) . ") VALUES (:" . implode(",:", $keys) . ")";

    try {
      $this->query($query, $data);
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  public function update($conditions, $data)
  {
    if (!empty($this->allowedColumns)) {
      foreach ($data as $key => $value) {
        if (!in_array($key, $this->allowedColumns)) {
          unset($data[$key]);
        }
      }
    }

    $query = "UPDATE {$this->table} SET ";

    $values = [];
    foreach ($data as $key => $value) {
      $values[] = "{$key} = :{$key}";
    }

    $query .= implode(", ", $values);
    $query .= " WHERE ";

    $conditionsValues = [];
    foreach ($conditions as $key => $value) {
      $conditionsValues[] = "{$key} = :{$key}";
    }

    $query .= implode(" AND ", $conditionsValues);

    $mergedData = array_merge($conditions, $data);
    $this->query($query, $mergedData);

    try {
      $this->query($query, $mergedData);
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  public function delete($conditions)
  {
    $query = "DELETE FROM {$this->table} WHERE ";

    $conditionsValues = [];
    foreach ($conditions as $key => $value) {
      $conditionsValues[] = "{$key} = :{$key}";
    }

    $query .= implode(" AND ", $conditionsValues);
    $this->query($query, $conditions);

    return false;
  }

  public function getLastInsertedRecord()
  {
    $query = "SELECT * FROM {$this->table} ORDER BY {$this->order_column} DESC LIMIT 1";
    return $this->query($query);
  }

  public function count($conditions = [])
  {
    $query = "SELECT COUNT(*) as count FROM {$this->table}";

    if (!empty($conditions)) {
      $query .= " WHERE ";
      $conditionsValues = [];
      foreach ($conditions as $key => $value) {
        $conditionsValues[] = "{$key} = :{$key}";
      }
      $query .= implode(" AND ", $conditionsValues);
    }

    $result = $this->query($query, $conditions);

    if (!empty($result)) {
      return $result[0]->count;
    }

    return 0;
  }

  public function countWithPattern($pattern)
  {
    $query = "SELECT COUNT(*) as count FROM {$this->table} WHERE ";
    
    // Assume $pattern is an associative array where keys represent column names
    // and values represent the patterns to match
    $conditions = [];
    foreach ($pattern as $column => $value) {
        $conditions[] = "$column LIKE :$column";
    }
    
    $query .= implode(" AND ", $conditions);

    $result = $this->query($query, $pattern);

    if (!empty($result)) {
        return $result[0]->count;
    }

    return 0;
  }

  public function distinct($column) {
    $query = "SELECT DISTINCT $column FROM {$this->table}";
    return $this->query($query);
  }


}