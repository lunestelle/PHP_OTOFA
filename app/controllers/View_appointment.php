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
    $tricyleApplicationData = $tricycleApplicationModel->first(['appointment_id' => $appointmentData->appointment_id]);

    $mtopRequirementModel = new MtopRequirement();
    $mtopRequirementData = $mtopRequirementModel->first(['appointment_id' => $appointmentData->appointment_id]);

    $tricycleCinModel = new TricycleCinNumber();
    $tricycleCinData = $tricycleCinModel->first(['tricycle_cin_number_id' => $tricyleApplicationData->tricycle_cin_number_id]);
    $tricyclePlateNumber = $tricycleCinData !== false ? $tricycleCinData->cin_number : '';

    $driverModel = new Driver();
    $driverData = $driverModel->first(['driver_id' => $tricyleApplicationData->driver_id]);

    if (!$appointmentData) {
      set_flash_message("Appointment not found.", "error");
      redirect('appointments');
    }

    $data = [
      'appointment' => $appointmentData,
      'appointment_time' => $appointment_time,
      'tricycleApplication' => $tricyleApplicationData,
      'mtopRequirement' => $mtopRequirementData,
      'tricycle_cin' => $tricyclePlateNumber,
    ];
    
    if ($driverData) {
      $data['driver_name'] = $driverData->first_name . ' ' . $driverData->middle_name . ' ' . $driverData->last_name;
    }

    echo $this->renderView('view_appointment', true, $data);
  }
}