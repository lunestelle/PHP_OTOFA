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

  public function getTricycleCinNumbersWithStatuses($userId, $appointmentType = null)
  {
    switch ($appointmentType) {
      case 'Renewal of Franchise':
        $statuses = ['Renewal Required', 'Expired Renewal (1st Notice)', 'Expired Renewal (2nd Notice)', 'Expired Renewal (3rd Notice)'];
        break;
      case 'Change of Motorcycle':
        $statuses = ['Change Motor Required', 'Expired Motor (1st Notice)', 'Expired Motor (2nd Notice)', 'Expired Motor (3rd Notice)'];
        break;
      default:
        $statuses = null;
        break;
    }

    if ($statuses !== null) {
      $statusString = "'" . implode("','", $statuses) . "'";

      $query = "SELECT DISTINCT tricycle_cin_numbers.cin_number FROM {$this->table}  INNER JOIN tricycles ON tricycle_statuses.tricycle_id = tricycles.tricycle_id INNER JOIN tricycle_cin_numbers ON tricycles.cin_id = tricycle_cin_numbers.tricycle_cin_number_id WHERE tricycle_statuses.user_id = ? AND tricycle_statuses.status IN ($statusString)";
        
      $params = [$userId];
    } else {
      // For Transfer of Ownership, show all tricycle CIN numbers
      $query = "SELECT DISTINCT cin_number FROM tricycle_cin_numbers WHERE user_id = ?";
      $params = [$userId];
    }

    return $this->query($query, $params);
  }
}