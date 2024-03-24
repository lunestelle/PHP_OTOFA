<?php

class Cin_management
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    $tricycleCinNumberModel = new TricycleCinNumber();

    // Fetch total available CIN numbers
    $data['totalAvailableCin'] = count($tricycleCinNumberModel->getAvailableCinNumbers());
    $data['totalCinNumbers'] = $tricycleCinNumberModel->count();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Check if change type is set and valid
      $changeType = $_POST['changeType'] ?? '';
      if ($changeType !== 'increase' && $changeType !== 'decrease') {
        set_flash_message("Invalid change type.", "error");
        redirect('cin_management');
      }

      // Get the amount to change
      $amount = isset($_POST['increaseAmount']) ? $_POST['increaseAmount'] : $_POST['decreaseAmount'];

      // Validate the amount
      if (!is_numeric($amount) || $amount <= 0) {
          set_flash_message("Invalid amount.", "error");
          redirect('cin_management');
      }

      // Update the CIN availability based on the change type
      if ($changeType === 'increase') {
          // Perform increase operation
          $tricycleCinNumberModel->increaseCinAvailability($amount);
      } else {
          // Perform decrease operation
          $tricycleCinNumberModel->decreaseCinAvailability($amount);
      }

      set_flash_message("CIN availability updated successfully.", "success");
      redirect('cin_management');
    }

    echo $this->renderView('cin_management', true, $data);
  }
}