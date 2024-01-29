<?php

class Tricycle
{
  use Model;

  protected $table = 'tricycles';
  protected $allowedColumns = [
    'user_id',
    'cin_id',
    'tricycle_application_id',
    'previous_tricycle_application_id',
    'mtop_requirements_new_franchise_id',
    'mtop_requirements_renewal_franchise_id',
    'mtop_requirements_transfer_ownership_id',
    'mtop_requirements_intent_of_transfer_id',
    'mtop_requirements_transfer_from_deceased_id',
    'mtop_requirements_change_motorcycle_id',
    'expired_notification_sent_at',
    'expired_change_motor_notification_sent_at',
  ];

  protected $order_column = 'tricycle_id';

  public function getTricyclesForAdmin($statusFilter)
  {
    if ($statusFilter !== 'active') {
      return $this->findAll();
    } else {
      $query = "SELECT * FROM {$this->table} 
                WHERE tricycle_id IN (SELECT tricycle_id FROM tricycle_statuses WHERE status = 'Active')";
      return $this->query($query);
    }
  }

  public function getTricyclesForUser($userId, $statusFilter)
  {
    $query = "SELECT DISTINCT t.* 
              FROM {$this->table} t
              JOIN tricycle_statuses ts ON t.tricycle_id = ts.tricycle_id
              WHERE t.user_id = :userId";

    $params = [':userId' => $userId];

    if ($statusFilter === 'active') {
      $query .= " AND ts.status = 'Active'";
    }

    return $this->query($query, $params);
  }
}