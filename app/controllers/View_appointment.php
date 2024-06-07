<?php

class View_appointment
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    $appointment_id = $_GET['appointment_id'];
    $appointmentModel = new Appointment();
    $appointmentData = $appointmentModel->first(['appointment_id' => $appointment_id]);
    $appointment_time = formatTime($appointmentData->appointment_time);

    $tricycleApplicationModel = new TricycleApplication();
    $tricycleApplicationData = $tricycleApplicationModel->where(['appointment_id' => $appointmentData->appointment_id]);

    if (count($tricycleApplicationData) >= 1) {
      $tricycleCinModel = new TricycleCinNumber();
      $driverModel = new Driver();
      
      // Process each tricycle application
      foreach ($tricycleApplicationData as &$tricycleApplication) {
        $tricycleCinData = $tricycleCinModel->first(['tricycle_cin_number_id' => $tricycleApplication->tricycle_cin_number_id]);
        if ($tricycleCinData) {
          $tricycleApplication->tricyclePlateNumber = $tricycleCinData->cin_number;
          $query = "SELECT drivers.* FROM drivers JOIN driver_statuses ON drivers.driver_id = driver_statuses.driver_id WHERE drivers.tricycle_cin_number_id = :tricycle_cin_id AND driver_statuses.status = 'Active'";
          $driverData = $driverModel->query($query, [':tricycle_cin_id' => $tricycleCinData->tricycle_cin_number_id]);
          if (!empty($driverData)) {
            $driver = $driverData[0];
            $tricycleApplication->driver_name = $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name;
            $tricycleApplication->driver_license_no = $driver->license_no;
            $tricycleApplication->driver_license_expiry_date = $driver->license_expiry_date;
          } else {
            $tricycleApplication->driver_name = 'Selected CIN has no driver';
            $tricycleApplication->driver_license_no = '';
            $tricycleApplication->driver_license_expiry_date = '';
          }
        } else {
          $tricycleApplication->tricyclePlateNumber = 'NO CIN';
          $tricycleApplication->driver_name = 'Selected CIN has no driver';
          $tricycleApplication->driver_license_no = '';
          $tricycleApplication->driver_license_expiry_date = '';
        }
      }
    }

    $mtopRequirementModel = new MtopRequirement();
    $mtopRequirementData = $mtopRequirementModel->where(['appointment_id' => $appointmentData->appointment_id]);

    if (!$appointmentData) {
      set_flash_message("Appointment not found.", "error");
      redirect('appointments');
    }

    $data = [
      'appointment' => $appointmentData,
      'appointment_time' => $appointment_time,
      'tricycleApplications' => $tricycleApplicationData,
      'mtopRequirements' => $mtopRequirementData,
    ];

    echo $this->renderView('view_appointment', true, $data);
  }
}