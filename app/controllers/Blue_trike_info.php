<?php

class Blue_trike_info
{
  use Controller;

  public function index()
  {
    echo $this->renderView('blue_trike_info', true);
  }
}
