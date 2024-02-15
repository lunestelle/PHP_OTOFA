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
    $tricycleApplicationData = $tricycleApplicationModel->first(['appointment_id' => $appointmentData->appointment_id]);

    $mtopRequirementModel = new MtopRequirement();
    $mtopRequirementData = $mtopRequirementModel->first(['appointment_id' => $appointmentData->appointment_id]);

    $tricycleCinModel = new TricycleCinNumber();
    $driverModel = new Driver();
    $tricycleCinData = $tricycleCinModel->first(['tricycle_cin_number_id' => $tricycleApplicationData->tricycle_cin_number_id]);

    if ($tricycleCinData) {
      $tricyclePlateNumber = $tricycleCinData->cin_number;
      $query = "SELECT drivers.* FROM drivers JOIN driver_statuses ON drivers.driver_id = driver_statuses.driver_id WHERE drivers.tricycle_cin_number_id = :tricycle_cin_id AND driver_statuses.status = 'Active'";
      $driverData = $driverModel->query($query, [':tricycle_cin_id' => $tricycleCinData->tricycle_cin_number_id]);
    } else {
      $tricyclePlateNumber = 'NO CIN';
      $driverData = [];
    }

    $data = []; 
    if (!empty($driverData)) {
      $driver = $driverData[0];
      $driver_name = $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name;
      $driver_license_no = $driver->license_no;
      $driver_license_expiry_date = $driver->license_expiry_date;
    } else {
      $driver_name = 'Selected CIN has no driver';
      $driver_license_no = '';
      $driver_license_expiry_date = '';
    }

    if (!$appointmentData) {
      set_flash_message("Appointment not found.", "error");
      redirect('appointments');
    }

    $data = [
      'appointment' => $appointmentData,
      'appointment_time' => $appointment_time,
      'tricycleApplication' => $tricycleApplicationData,
      'mtopRequirement' => $mtopRequirementData,
      'tricycle_cin' => $tricyclePlateNumber,
      'driver_name' => $driver_name,
      'driver_license_no' => $driver_license_no,
      'driver_license_expiry_date' => $driver_license_expiry_date,
    ];

    echo $this->renderView('view_appointment', true, $data);
  }
}