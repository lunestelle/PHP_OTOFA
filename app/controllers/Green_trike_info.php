<?php

class Green_trike_info
{
  use Controller;

  public function index()
  {
    echo $this->renderView('green_trike_info', true);
  }
}
