<?php

class New_tricycle
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
      redirect('');
    }

    $userModel = new User();
    $users = $userModel->where(['role' => 'operator']);
    $data['users'] = [];

    foreach ($users as $user) {
      $data['users'][$user->user_id] = [
        'user_id' => $user->user_id,
        'name' => $user->first_name . ' ' . $user->last_name
      ];
    }

    $tricycleModel = new Tricycle();
    $existingPlateNumbers = $tricycleModel->pluck('plate_no');
    if ($existingPlateNumbers !== false) {
      $allPlateNumbers = range(1, 2000);
      $data['availablePlateNumbers'] = array_diff($allPlateNumbers, $existingPlateNumbers);
    } else {
      $data['availablePlateNumbers'] = range(1, 2000);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $formData = [
        'make_model' => $_POST['make_model'] ?? '',
        'year_acquired' => $_POST['year_acquired'] ?? '',
        'color_code' => $_POST['color_code'] ?? '',
        'route_area' => $_POST['route_area'] ?? '',
        'plate_no' => $_POST['plate_no'] ?? '',
        'user_id' => $_POST['user_id'] ?? '',
        'or_no' => $_POST['or_no'] ?? '',
        'or_date' => $_POST['or_date'] ?? '',
        'tricycle_status' => $_POST['tricycle_status'] ?? '',
      ];

      $tricycleModel = new Tricycle();
      $errors = $tricycleModel->validateData($formData);

      if (!empty($errors)) {
        $errorMessage = $errors[0];
        set_flash_message($errorMessage, "error");

        // Only merge form data if there are errors
        $data['formData'] = $formData;
      } else {
        // Check if any files were uploaded
        if (!empty($_FILES['front_view_image']['name']) && !empty($_FILES['side_view_image']['name'])) {
          $imagePaths = $this->handleFileUploads($formData);

          if ($imagePaths === false) {
            set_flash_message("Failed to upload images.", "error");
            redirect('tricycles');
          }

          $formData['front_view_image_path'] = $imagePaths['front_view_image'];
          $formData['side_view_image_path'] = $imagePaths['side_view_image'];

          if ($tricycleModel->insert($formData)) {
            set_flash_message("Tricycle added successfully.", "success");
            redirect('tricycles');
          } else {
            set_flash_message("Failed to add tricycle. Please try again.", "error");
          }
        } else {
          if ($tricycleModel->insert($formData)) {
            set_flash_message("Tricycle added successfully.", "success");
            redirect('tricycles');
          } else {
            set_flash_message("Failed to add tricycle. Please try again.", "error");
          }
        }
      }
    }

    echo $this->renderView('new_tricycle', true, $data);
  }

  private function handleFileUploads($formData)
  {
    $uniqueId = uniqid();
    $uploadDirectory = 'public/uploads/tricycle_images/' . $uniqueId;

    $frontImageName = 'front_view_image';
    $sideImageName = 'side_view_image';

    // Define the file paths
    $frontImagePath = $uploadDirectory . basename($_FILES[$frontImageName]['name']);
    $sideImagePath = $uploadDirectory . basename($_FILES[$sideImageName]['name']);

    // Move uploaded files to destination
    if (
      move_uploaded_file($_FILES[$frontImageName]['tmp_name'], $frontImagePath) &&
      move_uploaded_file($_FILES[$sideImageName]['tmp_name'], $sideImagePath)
    ) {
      // Return file paths if upload is successful
      return [
        'front_view_image' => $frontImagePath,
        'side_view_image' => $sideImagePath,
      ];
    } else {
      // Return false if any of the file uploads fail
      return false;
    }
  }
}