<?php

class Print_taripa_content
{
  use Controller;

  public function index()
  {
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
      set_flash_message("Invalid request method.", "error");
      redirect('');
    }

    // Fetch data for first container (Barangay North, East to Licuma)
    $first_container_data = $this->fetchFirstContainerData();

    // Fetch data for second container (Lilo-an and Valencia)
    $second_container_data = $this->fetchSecondContainerData();

    // Fetch the effective date from the taripa table
    $effective_date = $this->fetchEffectiveDate();

    $data = [
      'first_container_data' => $first_container_data,
      'second_container_data' => $second_container_data,
      'effective_date' => $effective_date,
    ];

    echo $this->renderView('print_taripa_content', true, $data);
  }

  private function fetchFirstContainerData()
  {
    $taripaModel = new Taripas();
    $query = "SELECT * FROM taripa WHERE taripa_id BETWEEN 1 AND 32 ORDER BY taripa_id";
    $first_container_data = $taripaModel->query($query);
    return $first_container_data;
  }

  private function fetchSecondContainerData()
  {
    $taripaModel = new Taripas();
    $query = "SELECT * FROM taripa WHERE taripa_id BETWEEN 33 AND 63 ORDER BY taripa_id";
    $second_container_data = $taripaModel->query($query);
    return $second_container_data;
  }

  private function fetchEffectiveDate()
  {
    $taripaModel = new Taripas();
    $query = "SELECT effective_date FROM taripa LIMIT 1";
    $result = $taripaModel->query($query);
    
    if (!empty($result)) {
      $effectiveDate = date('F d, Y', strtotime($result[0]->effective_date));

      return $effectiveDate;
    }
    
    return null;
  }
}