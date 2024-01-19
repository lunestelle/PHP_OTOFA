<?php

class Tricycle
{
  use Model;

  protected $table = 'tricycles';
  protected $allowedColumns = [
    'user_id',
    'cin_id',
    'tricycle_application_id',
    'previous_tricycle_application_id',
    'mtop_requirements_new_franchise_id',
    'mtop_requirements_renewal_franchise_id',
    'mtop_requirements_transfer_ownership_id',
    'mtop_requirements_intent_of_transfer_id',
    'mtop_requirements_transfer_from_deceased_id',
    'mtop_requirements_change_motorcycle_id',
  ];

  protected $order_column = 'tricycle_id';
}