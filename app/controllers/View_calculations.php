<?php

class View_calculations
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    $selectedYear = isset($_GET['year']) ? $_GET['year'] : '';
    $tricycleCIN = isset($_GET['cin']) ? $_GET['cin'] : '';

    $calculationData = $this->getCalculationData($selectedYear, $tricycleCIN);

    $data = [
      'selectedYear' => $selectedYear,
      'tricycleCIN' => $tricycleCIN,
      'calculationData' => $calculationData,
    ];

    echo $this->renderView('view_calculations', true, $data);
  }

  private function getCalculationData($selectedYear, $tricycleCIN)
  {
    $maintenanceLog = new MaintenanceLog();
    return $maintenanceLog->getCalculationData($selectedYear, $tricycleCIN);
  }
}
