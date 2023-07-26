<?php

class New_taripa
{
    use Controller;

    public function index()
    {
        if (!is_authenticated()) {
            set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
            redirect('');
        }

        // Initialize an empty array to hold any validation errors
        $validationErrors = [];

        // Check if the form has been submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the input data
            $taripaId = $_POST['id'] ?? null;
            $routeArea = $_POST['route_area'] ?? '';
            $barangay = $_POST['barangay'] ?? '';
            $regularRate = $_POST['regular_rate'] ?? '';
            $discountedRate = $_POST['discounted_rate'] ?? '';

            // Create an instance of the Taripas model
            $taripasModel = new Taripas();

            // Prepare the data to validate
            $data = [
                'route_area' => $routeArea,
                'barangay' => $barangay,
                'regular_rate' => $regularRate,
                'discounted_rate' => $discountedRate,
            ];

            // Call the validate function from the Taripas model
            $validationErrors = $taripasModel->validate($data);

            // If there are no validation errors, proceed to save the data to the database
            if (empty($validationErrors)) {
                if ($taripaId) {
                    // If $taripaId is provided, it means we are updating an existing record
                    if ($taripasModel->update($taripaId, $data)) {
                        set_flash_message("Taripa updated successfully.", "success");
                    } else {
                        set_flash_message("Oops! Something went wrong while updating. Please try again.", "error");
                    }
                } else {
                    // If $taripaId is not provided, it means we are inserting a new record
                    if ($taripasModel->insert($data)) {
                        set_flash_message("Taripa added successfully.", "success");
                    } else {
                        set_flash_message("Oops! Something went wrong while inserting. Please try again.", "error");
                    }
                }

                // Redirect back to the 'taripa' view with the selected filter retained
                $selectedRoute = $data['route_area'] ?? 'All';
                redirect('taripa?route_area=' . urlencode($selectedRoute));
            } else {
                if (count($validationErrors) > 1) {
                    $errorMessage = "Please fix the following errors:<br>";
                    foreach ($validationErrors as $error) {
                        $errorMessage .= "- $error<br>";
                    }
                } else {
                    $errorMessage = reset($validationErrors); // Get the first error message
                }

                set_flash_message($errorMessage, "error");
                $selectedRoute = $data['route_area'] ?? 'All';
                redirect('new_taripa?route_area=' . urlencode($selectedRoute));
            }
        }

        // Get the selected route from the query parameters
        $selectedRoute = $_GET['route_area'] ?? '';

        // Render the new_taripa view with any validation errors and the selected route
        $data = [
            'validationErrors' => $validationErrors,
            'selectedRoute' => $selectedRoute,
        ];
        echo $this->renderView('new_taripa', true, $data);
    }
}
