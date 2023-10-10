<?php

class Edit_operator
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $operatorId = isset($_POST['operator_id']) ? $_POST['operator_id'] : null;

      $userData = [
        'first_name' => ucwords($_POST['first_name']),
        'last_name' => ucwords($_POST['last_name']),
        'address' => ucwords($_POST['address']),
        'phone_number' => $_POST['phone_number'],
        'email' => $_POST['email'],
      ];

      $operatorModel = new User();
      $updateResult = $operatorModel->update(['user_id' => $operatorId], $userData);
  
      if ($updateResult) {
        set_flash_message("Operator information updated successfully.", "success");
        redirect('operators');
      } else {
        set_flash_message("Failed to update operator information.", "error");
        redirect('edit_operator?operator_id=' . $operatorId);
      }
    } else {
      $operatorId = isset($_GET['operator_id']) ? $_GET['operator_id'] : null;

      $operatorModel = new User();
      $operatorData = $operatorModel->first(['user_id' => $operatorId]);

      if (!$operatorData) {
        set_flash_message("Operator not found.", "error");
        redirect('operators');
      }

      $data = [
        'first_name' => $operatorData->first_name,
        'last_name' => $operatorData->last_name,
        'address' => $operatorData->address,
        'phone_number' => $operatorData->phone_number,
        'email' => $operatorData->email,
      ];

      echo $this->renderView('edit_operator', true, $data);
    }
  }
}