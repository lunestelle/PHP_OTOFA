<?php

class Red_trike_info
{
  use Controller;

  public function index()
  {
    $data = [];

    $zone = "Free Zone / Zone 1";

    $taripaModel = new Taripas();
    $data['routeAreas'] = $taripaModel->getRouteAreasByZone($zone);
    $data['zone'] = $zone;
    echo $this->renderView('red_trike_info', true, $data);
  }
}