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

  public function generate_cin_number()
  {
    $lastCinNumberRecord = $this->getLastInsertedRecord()[0]->tricycle_cin_number_id;
    $lastCinNumber = $lastCinNumberRecord ? $lastCinNumberRecord : 0; // Default starting value

    $newCinNumber = $lastCinNumber + 1;

    return $newCinNumber;
  }

  public function increaseCinAvailability($amount)
  {
    $this->query("ALTER TABLE {$this->table} AUTO_INCREMENT = 1");
    for ($i = 0; $i < $amount; $i++) {
      $cinNumber = $this->generate_cin_number();
      $this->insert([
        'tricycle_cin_number_id' => $cinNumber,
        'cin_number' => $cinNumber,
        'is_used' => false,
        'user_id' => null,
      ]);
    }    
  }
  
  public function decreaseCinAvailability($amount)
  {
    $this->query("ALTER TABLE {$this->table} AUTO_INCREMENT = 1");

    $lastCinNumbers = $this->getLastInsertedCinNumbers($amount);

    if (count($lastCinNumbers) < $amount) {
      set_flash_message("Not enough available CIN numbers to decrease.", "error");
      redirect('cin_management');
    }

    foreach ($lastCinNumbers as $cinNumberId) {
      $this->delete(['tricycle_cin_number_id' => $cinNumberId]);
    }
  }
  
  public function getLastInsertedCinNumbers($amount)
  {
    $lastCinNumberRecord = $this->getLastInsertedRecord()[0];
    $lastCinNumber = $lastCinNumberRecord ? $lastCinNumberRecord->tricycle_cin_number_id : 0;

    // Get the last N Cin numbers to delete
    $lastCinNumbers = [];
    for ($i = $lastCinNumber; $i > $lastCinNumber - $amount; $i--) {
      if ($i < 1) {
        break; // Ensure not to go below 1
      }
      $lastCinNumbers[] = $i;
    }

    return $lastCinNumbers;
  }
}