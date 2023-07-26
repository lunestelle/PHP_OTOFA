<?php

class Taripas
{
    use Model;

    protected $table = 'taripa';
    protected $allowedColumns = [
        'taripa_id',
        'route_area',
        'barangay',
        'regular_rate',
        'discounted_rate'
    ];
    protected $order_column = 'taripa_id';

    public function validate($data)
    {
        $errors = [];

        // Validate route_area (required)
        if (empty($data['route_area'])) {
            $errors[] = 'Route Area is required.';
        }

        // Validate barangay (required and not existing in the database)
        if (empty($data['barangay'])) {
            $errors[] = 'Barangay is required.';
        } 

        // Validate regular_rate (required, numeric)
        if (empty($data['regular_rate'])) {
            $errors[] = 'Regular Rate is required.';
        } elseif (!is_numeric($data['regular_rate'])) {
            $errors[] = 'Regular Rate must be a numeric value.';
        }

        // Validate discounted_rate (required, numeric)
        if (empty($data['discounted_rate'])) {
            $errors[] = 'Discounted Rate is required.';
        } elseif (!is_numeric($data['discounted_rate'])) {
            $errors[] = 'Discounted Rate must be a numeric value.';
        }

        // Additional validation rules can be added as needed.

        return $errors;
    }
}
