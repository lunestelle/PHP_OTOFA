<?php

class Print_taripa_content
{
    use Controller;

    public function index()
    {
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
            set_flash_message("Invalid request method.", "error");
            redirect('');
        }

        // Load the Taripas model
        $taripasModel = new Taripas();
        // Fetch all taripas data
        $taripasData = $taripasModel->findAll();

        // Initialize data array
        $data = [];

        if (!empty($taripasData)) {
            // Convert each object in $taripasData to an array
            $taripasData = array_map(function ($taripa) {
                return (array)$taripa;
            }, $taripasData);

            // Sort $taripasData by 'taripa_id' in ascending order
            usort($taripasData, function ($a, $b) {
                return $a['taripa_id'] <=> $b['taripa_id'];
            });

            foreach ($taripasData as $taripa) {
                $data['taripas'][] = [
                    'taripa_id' => $taripa['taripa_id'],
                    'route_area' => $taripa['route_area'],
                    'barangay' => $taripa['barangay'],
                    'regular_fare' => $taripa['regular_fare'],
                    'discounted_fare' => $taripa['discounted_fare'],
                ];
            }
        }

        // Render the view with data
        echo $this->renderView('print_taripa_content', true, $data);
    }
}
