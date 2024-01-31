<?php

class Green_trike_info
{
  use Controller;

  public function index()
  {
    $data = [];

    $zone = "Free Zone & Zone 4";

    $taripaModel = new Taripas();
    $data['routeAreas'] = $taripaModel->getRouteAreasByZone($zone);
    $data['zone'] = $zone;
    echo $this->renderView('green_trike_info', true, $data);
  }
}