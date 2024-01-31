<?php

class Yellow_trike_info
{
  use Controller;

  public function index()
  {
    $data = [];

    $zone = "Free Zone & Zone 3";

    $taripaModel = new Taripas();
    $data['routeAreas'] = $taripaModel->getRouteAreasByZone($zone);
    $data['zone'] = $zone;
    echo $this->renderView('yellow_trike_info', true, $data);
  }
}