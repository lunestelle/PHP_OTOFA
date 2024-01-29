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

  public function getTricyclesForAdmin($statusFilter, $routeAreaFilter)
  {
      $params = [];
  
      $query = "SELECT * FROM {$this->table} WHERE 1 ";
  
      if ($statusFilter !== 'all') {
          $query .= "AND tricycle_id IN (SELECT tricycle_id FROM tricycle_statuses WHERE status = :status) ";
          $params[':status'] = $statusFilter;
      }
  
      if ($routeAreaFilter !== 'all') {
          $query .= "AND tricycle_application_id IN (SELECT tricycle_application_id FROM tricycle_applications WHERE route_area = :routeArea) ";
          $params[':routeArea'] = $routeAreaFilter;
      }
  
      return $this->query($query, $params);
  }
  

  public function getTricyclesForUser($userId, $statusFilter, $routeAreaFilter)
  {
      $params = [':userId' => $userId];
      $query = "SELECT DISTINCT t.* 
                FROM {$this->table} t
                JOIN tricycle_applications ta ON t.tricycle_application_id = ta.tricycle_application_id
                LEFT JOIN tricycle_statuses ts ON t.tricycle_id = ts.tricycle_id
                WHERE t.user_id = :userId ";
  
      if ($statusFilter !== 'all') {
          $query .= "AND ts.status = :status ";
          $params[':status'] = $statusFilter;
      }
  
      if ($routeAreaFilter !== 'all') {
          $query .= "AND ta.route_area = :routeArea ";
          $params[':routeArea'] = $routeAreaFilter;
      }
  
      return $this->query($query, $params);
  }
  
  

  
  
}