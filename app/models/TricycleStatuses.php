<?php

class TricycleStatuses
{
  use Model;

  protected $table = 'tricycle_statuses';
  protected $allowedColumns = [
    'tricycle_id',
    'user_id',
    'status',
  ];
  protected $order_column = 'created_at';
  protected $order_type = 'desc';

  public function deleteStatusesExceptDropped($tricycleId)
  {
    $query = "DELETE FROM {$this->table} WHERE tricycle_id = :tricycleId AND status NOT LIKE 'Dropped'";
    $params = [':tricycleId' => $tricycleId];

    try {
      $this->query($query, $params);
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  public function deleteStatus($tricycleId, $user_id, $status)
  {
    $query = "DELETE FROM {$this->table} WHERE tricycle_id = :tricycleId AND status = :status AND user_id = :user_id";
    $params = [':tricycleId' => $tricycleId, ':user_id' => $user_id, ':status' => $status];

    try {
      $this->query($query, $params);
      return true;
    } catch (Exception $e) {
      return false;
    }
  }
}