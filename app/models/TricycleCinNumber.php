<?php

class TricycleCinNumber
{
  use Model;

  protected $table = 'tricycle_cin_numbers';
  protected $allowedColumns = [
    'cin_number',
    'is_used',
    'user_id',
  ];
  protected $order_column = 'tricycle_cin_number_id';

  // Function to get all CIN numbers
  public function getAllCinNumbers() {
    return $this->pluck('cin_number')->toArray();
  }

  // Function to get available CIN numbers
  public function getAvailableCinNumbers() {
    $result = $this->where(['is_used' => false]);
    return $result ? array_column($result, 'tricycle_cin_number_id') : [];
  }

  // Function to get user ID of a specific CIN number
  public function getCinUserId($cinNumber) {
    $record = $this->first(['cin_number' => $cinNumber]);
    return $record ? $record->user_id : null;
  }

  public function getCin($tricycleCinNumberId) {
    $record = $this->first(['tricycle_cin_number_id' => $tricycleCinNumberId]);
    return $record ? $record->cin_number : null;
  }

  public function updateCinNumberStatus($cinNumberId, $userId, $isUsed)
  {
    return $this->update(['tricycle_cin_number_id' => $cinNumberId], ['user_id' => $userId, 'is_used' => $isUsed]);
  }

}
