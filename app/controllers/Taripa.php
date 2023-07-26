<?php

class Taripa
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
      redirect('');
    }

    $taripaModel = new Taripas();
    $route_area = $_GET['route_area'] ?? null;
    $data['taripas'] = [];
    $data['index'] = 1;

    if (!$route_area || $route_area === 'All') {
      $taripasData = $taripaModel->findAll();
      $selectedFilter = 'All';
    } else {
      $taripasData = $taripaModel->where(['route_area' => $route_area]);
      $selectedFilter = $route_area;
    }

    if (!empty($taripasData)) {
      foreach ($taripasData as $taripa) {
        $data['taripas'][] = [
          'taripa_id' => $taripa->taripa_id,
          'route_area' => $taripa->route_area,
          'barangay' => $taripa->barangay,
          'regular_rate' => $taripa->regular_rate,
          'discounted_rate' => $taripa->discounted_rate,
        ];
      }
    }

    $data['selectedFilter'] = $selectedFilter;
    echo $this->renderView('taripa', true, $data);
  }
}