<?php

class Edit_tricycle
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    $tricycleId = isset($_GET['tricycle_id']) ? $_GET['tricycle_id'] : null;

    $tricycleModel = new Tricycle();
    $tricycleData = $tricycleModel->first(['tricycle_id' => $tricycleId]);

    if (!$tricycleData) {
      set_flash_message("Tricycle not found.", "error");
      redirect('tricycles');
    }

    $userModel = new User();
    $users = $userModel->where(['role' => 'operator']);

    // Get available plate numbers
    $selectedPlateNumber = $tricycleData->plate_no;
    $availablePlateNumbers = $this->getAvailablePlateNumbers($tricycleModel, $selectedPlateNumber);

    $data = [
      'tricycleData' => [
        'make_model' => $tricycleData->make_model,
        'year_acquired' => $tricycleData->year_acquired,
        'color_code' => $tricycleData->color_code,
        'route_area' => $tricycleData->route_area,
        'plate_no' => $tricycleData->plate_no,
        'user_id' => $tricycleData->user_id,
        'or_no' => $tricycleData->or_no,
        'or_date' => $tricycleData->or_date,
        'tricycle_status' => $tricycleData->tricycle_status,
        'front_view_image_path' => $tricycleData->front_view_image_path,
        'back_view_image_path' => $tricycleData->back_view_image_path,
        'side_view_image_path' => $tricycleData->side_view_image_path,
      ],
      'users' => [],
      'availablePlateNumbers' => $availablePlateNumbers,
      'tricycleId' => $tricycleId,
    ];

    // Map users for the dropdown
    foreach ($users as $user) {
      $data['users'][$user->user_id] = [
        'user_id' => $user->user_id,
        'name' => $user->first_name . ' ' . $user->last_name,
      ];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $postData = [
        'make_model' => $_POST['make_model'] ?? '',
        'year_acquired' => $_POST['year_acquired'] ?? '',
        'color_code' => $_POST['color_code'] ?? '',
        'route_area' => $_POST['route_area'] ?? '',
        'plate_no' => $_POST['plate_no'] ?? '',
        'user_id' => $_POST['user_id'] ?? '',
        'or_no' => $_POST['or_no'] ?? '',
        'or_date' => $_POST['or_date'] ?? '',
        'tricycle_status' => $_POST['tricycle_status'] ?? '',
        'front_view_image' => $_FILES['front_view_image'] ?? '',
        'back_view_image' => $_FILES['back_view_image'] ?? '',
        'side_view_image' => $_FILES['side_view_image'] ?? '',
      ];

      if (isset($_POST['confirm_delete_image'])) {
        $imageType = $_POST['image_type'];
        $imagePathColumn = "{$imageType}_view_image_path";
        
        // Check if the file exists before attempting to delete
        if (file_exists($_POST['original_image_path'])) {
          $deleted = unlink($_POST['original_image_path']);
          
          // Update the database column with an empty value if deletion was successful
          if ($deleted) {
            $tricycleModel->update(['tricycle_id' => $tricycleId], [$imagePathColumn => null]);
            set_flash_message("Image deleted successfully.", "success");
            redirect('edit_tricycle?tricycle_id=' . $tricycleId);
          } else {
            set_flash_message("Failed to delete the image.", "error");
            redirect('edit_tricycle?tricycle_id=' . $tricycleId);
          }
        } else {
          set_flash_message("File not found. Image may have been deleted already.", "error");
          redirect('edit_tricycle?tricycle_id=' . $tricycleId);
        }
      }
      
      if (isset($_POST['update_tricycle'])) {
        $validationErrors = $tricycleModel->validateData($postData);

        if (!empty($validationErrors)) {
          set_flash_message($validationErrors[0], "error");
          $data['postData'] = $postData;
        } else {
          // Check if the images are removed
          $isFrontImageRemoved = empty($_FILES['front_view_image']['name']);
          $isBackImageRemoved = empty($_FILES['back_view_image']['name']);
          $isSideImageRemoved = empty($_FILES['side_view_image']['name']);

          // Check if new front view image is uploaded, otherwise use the original path
          $frontViewImagePath = $isFrontImageRemoved
            ? $_POST['original_front_view_image']
            : $this->handleFileUpload($postData['front_view_image'], 'front_view_image');

          // Similar checks for back and side view images
          $backViewImagePath = $isBackImageRemoved
            ? $_POST['original_back_view_image']
            : $this->handleFileUpload($postData['back_view_image'], 'back_view_image');

          $sideViewImagePath = $isSideImageRemoved
            ? $_POST['original_side_view_image']
            : $this->handleFileUpload($postData['side_view_image'], 'side_view_image');

          $postData['front_view_image_path'] = $frontViewImagePath;
          $postData['back_view_image_path'] = $backViewImagePath;
          $postData['side_view_image_path'] = $sideViewImagePath;

          // Update tricycle data
          if ($tricycleModel->update(['tricycle_id' => $tricycleId], $postData)) {
            set_flash_message("Tricycle updated successfully.", "success");
            redirect('tricycles');
          } else {
            set_flash_message("Failed to update tricycle.", "error");
            redirect('tricycles');
          }
        }
        
      }
      
    }
    echo $this->renderView('edit_tricycle', true, $data);
  }

  private function handleFileUpload($file, $imageName)
  {
    $uploadDirectory = '../uploads/tricycle_images/';
    
    // Check if the file was uploaded without errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
      // Handle the error appropriately (e.g., log it or return an error message)
      return '';
    }

    $imagePath = $uploadDirectory . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $imagePath)) {
      return $imagePath;
    } else {
      return '';
    }
  }


  private function getAvailablePlateNumbers($tricycleModel, $selectedPlateNumber)
  {
    // Get all plate numbers from the database
    $allPlateNumbers = $tricycleModel->pluck('plate_no');

    // Include the selected plate number in the dropdown options
    $availablePlateNumbers = [$selectedPlateNumber];

    // Generate a range of plate numbers from 0 to 2000
    $allPlateNumbersRange = range(0, 2000);

    // Exclude plate numbers that are in the database
    $availablePlateNumbers = array_merge($availablePlateNumbers, array_diff($allPlateNumbersRange, $allPlateNumbers));

    sort($availablePlateNumbers);
    return $availablePlateNumbers;
  }
}