<?php

class MtopRequirement
{
  use Model;

  protected $table = 'mtop_requirements';
  protected $allowedColumns = [
    'appointment_id',
    'tricycle_application_id',
    'mc_lto_certificate_of_registration_path',
    'mc_lto_official_receipt_path',
    'mc_plate_authorization_path',
    'tc_insurance_policy_path',
    'unit_front_view_image_path',
    'unit_side_view_image_path',
    'sketch_location_of_garage_path',
    'affidavit_of_income_tax_return_path',
    'driver_cert_safety_driving_seminar_path',
    'proof_of_id_path',
    'tc_lto_certificate_of_registration_path',
    'tc_lto_official_receipt_path',
    'tc_plate_authorization_path',
    'tc_renewed_insurance_policy_path',
    'latest_franchise_path',
    'death_certificate_path',
    'agreement_amongst_heirs_path',
    'deed_of_donation_or_deed_of_sale_path',
    'or_of_return_plate_path',
  ];

  protected $order_column = 'mtop_requirement_id';
}