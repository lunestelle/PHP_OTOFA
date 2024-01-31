<?php

class Blue_trike_info
{
  use Controller;

  public function index()
  {
    $data = [];

    $zone = "Free Zone & Zone 2";

    $taripaModel = new Taripas();
    $data['routeAreas'] = $taripaModel->getRouteAreasByZone($zone);
    $data['zone'] = $zone;
    echo $this->renderView('blue_trike_info', true, $data);
  }
}