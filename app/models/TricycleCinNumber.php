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

  // Function to get CIN number by user ID
  public function getCinNumberIdByUserId($userId)
  {
    $record = $this->first(['user_id' => $userId, 'is_used' => true]);
    return $record ? $record->tricycle_cin_number_id : null;
  }

  public function generate_cin_number() {
    $lastCinNumberRecord = $this->query("SELECT cin_number FROM $this->table ORDER BY cin_number DESC LIMIT 1");
    $lastCinNumber = $lastCinNumberRecord ? $lastCinNumberRecord['cin_number'] : 2000; // Default starting value

    $newCinNumber = $lastCinNumber + 1;

    return $newCinNumber;
  }

  public function increaseCinAvailability($amount) {
    for ($i = 0; $i < $amount; $i++) {
      $this->insert([
        'cin_number' => $this->generate_cin_number(),
        'is_used' => false,
        'user_id' => null,
      ]);
    }
  }

  public function decreaseCinAvailability($amount) {
    $availableCinNumbers = $this->getAvailableCinNumbers();
    $count = count($availableCinNumbers);
    
    if ($count < $amount) {
      set_flash_message("Not enough available CIN numbers to decrease.", "error");
      redirect('cin_management');
    }

    // Delete the specified number of CIN number records
    for ($i = 0; $i < $amount; $i++) {
      $this->delete($availableCinNumbers[$i]);
    }
  }
}
