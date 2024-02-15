<?php

class Fetch_tricycle_cin_numbers
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["appointmentType"])) {
      $appointmentType = $_POST["appointmentType"];
      $tricycleStatusModel = new TricycleStatuses();
      $tricycleCinNumbers = $tricycleStatusModel->getTricycleCinNumbersWithStatuses($_SESSION['USER']->user_id, $appointmentType);

      $response = ["tricycleCinNumbers" => $tricycleCinNumbers];
      echo json_encode($response);
      exit();
    }
  }
}