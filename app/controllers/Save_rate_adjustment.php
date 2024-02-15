<?php

class Save_rate_adjustment
{
  use Controller;

  public function index()
  {
    $data = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $rate_action = $_POST['rate_action'];
      $percentage = $_POST['percentage'];
      $year = $_POST['year'];
      $effective_date = $_POST['effective_date'];
      $previous_year = $_POST['previous_year'];

      $rateAdjustmentModel = new RateAdjustment();
      $data = [
        'rate_action' => $rate_action,
        'percentage' => $percentage,
        'effective_date' => $effective_date,
        'previous_year' => $previous_year,
        'created_at' => date('Y-m-d H:i:s'),
      ];

      $errors = $rateAdjustmentModel->validate($data);

      if (!empty($errors)) {
        foreach ($errors as $error) {
          set_flash_message($error, "error");
        }
        redirect("taripa");
      }

      $rateAdjustmentModel->insert($data);

      set_flash_message("New taripa has been saved successfully.", "success");
      unset($_SESSION['formInput']);
      unset($_SESSION['recentYear']);
      unset($_SESSION['calculatedRates']);
      redirect("taripa");
    }
  }
}