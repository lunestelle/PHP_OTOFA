<?php 

class View_new_franchise
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
    echo $this->renderView('view_new_franchise', true, $data);
  }
}