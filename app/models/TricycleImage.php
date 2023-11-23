<?php

class TricycleImage
{
  use Model;

  protected $table = 'tricycle_images';
  protected $order_column = 'tricycle_image_id';
  protected $allowedColumns = ['tricycle_id', 'front_view_image', 'back_view_image', 'side_view_image'];

  public function validateData($data)
  {
    $errors = [];

    if (empty($data['front_view_image']) || empty($data['back_view_image']) || empty($data['side_view_image'])) {
      $errors[] = 'All tricycle images are required.';
    }

    return $errors;
  }
}