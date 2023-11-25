<?php

class Yellow_trike_info
{
  use Controller;

  public function index()
  {
    echo $this->renderView('yellow_trike_info', true);
  }
}
