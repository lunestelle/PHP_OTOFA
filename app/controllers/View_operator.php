<?php

class View_operator
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    $operatorId = isset($_GET['operator_id']) ? $_GET['operator_id'] : null;

    $operatorModel = new User();
    $operatorData = $operatorModel->first(['user_id' => $operatorId]);

    if (!$operatorData) {
      set_flash_message("Operator not found.", "error");
      redirect('operators');
    }

    $profilePhotoPath = !empty($operatorData->uploaded_profile_photo_path)
    ? $operatorData->uploaded_profile_photo_path
    : $operatorData->generated_profile_photo_path;

    $data = [
      'profile_photo_path' => $profilePhotoPath,
      'first_name' => $operatorData->first_name,
      'last_name' => $operatorData->last_name,
      'address' => $operatorData->address,
      'phone_number' => $operatorData->phone_number,
      'email' => $operatorData->email,
    ];


    echo $this->renderView('view_operator', true, $data);
  }
}
