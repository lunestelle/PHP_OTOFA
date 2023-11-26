<?php

class Red_trike_info
{
  use Controller;

  public function index()
  {
    echo $this->renderView('red_trike_info', true);
  }
}
