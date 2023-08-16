<?php

class Edit_taripa
{
    use Controller;

    public function index()
    {
        if (!is_authenticated()) {
            set_flash_message("Oops! You need to be logged <br> in to view this page.", "error");
            redirect('');
        }

        $id = $_GET['id'] ?? null;

        // Initialize an empty array to hold any validation errors
        $validationErrors = [];

        // Fetch the existing taripa if 'id' is provided
        if ($id) {
            $taripasModel = new Taripas();
            $taripa = $taripasModel->first(['taripa_id' => $id]);

            // Check if the taripa exists
            if (!$taripa) {
                set_flash_message("Taripa not found.", "error");
                redirect('taripa'); // Redirect to the 'taripa' view
            }
        } else {
            $taripa = [];
        }

        echo $this->renderView('edit_taripa', true);
    }
}
