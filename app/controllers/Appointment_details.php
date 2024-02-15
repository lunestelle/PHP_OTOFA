<?php

class Appointment_details
{
  use Controller;

  public function index()
  {
    $currentURL = $_SERVER['REQUEST_URI'];

    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    $appointmentModel = new Appointment();
    $startDate = date('Y-m-d', strtotime("+1 day"));
    $numberOfDays = 15;
    $data['details'] = [];

    $currentDate = $startDate;
    $daysProcessed = 0;
    $currentYear = date('Y');

    $holidays = [
      $currentYear . '-01-01', // New Year's Day
      $currentYear . '-01-02', // New Year's Day
      $currentYear . '-03-28', // Maundy Thursday
      $currentYear . '-03-29', // Good Friday
      $currentYear . '-04-09', // Araw ng Kagitingan
      $currentYear . '-05-01', // Labor Day
      $currentYear . '-06-12', // Independence Day
      $currentYear . '-08-26', // National Heroes Day
      $currentYear . '-11-30', // Bonifacio Day
      $currentYear . '-12-25', // Christmas Day
      $currentYear . '-12-26', // Christmas Day
      $currentYear . '-12-30'  // Rizal Day
    ];

    while ($daysProcessed < $numberOfDays) {
      // Skip weekends (Saturday and Sunday)
      $dayOfWeek = date('N', strtotime($currentDate));
      if ($dayOfWeek >= 6) { // 6 for Saturday, 7 for Sunday
        $currentDate = date('Y-m-d', strtotime("$currentDate +1 day"));
        continue;
      }

      // Skip holidays
      if (in_array($currentDate, $holidays)) {
        $currentDate = date('Y-m-d', strtotime("$currentDate +1 day"));
        continue;
      }

      $pendingAppointment = $appointmentModel->count(['appointment_date' => $currentDate, 'status' => 'Pending']);
      $approvedAppointment = $appointmentModel->count(['appointment_date' => $currentDate, 'status' => 'Approved']);

      $totalAppointment = $pendingAppointment + $approvedAppointment;
      $availableAppointmentsLeft = 100 - $totalAppointment;

      $slotsLeftMessage = $this->generateMessage(date('F j, Y', strtotime($currentDate)), $availableAppointmentsLeft);

      $data['details'][] = [
        'slots_message' => $slotsLeftMessage,
        'appointment_date' => $currentDate
      ];

      $currentDate = date('Y-m-d', strtotime("$currentDate +1 day"));
      $daysProcessed++;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['appointmentDateModalBtn'])) {
      // Validation logic for the modal form submission
      $appointment_date = date('Y-m-d', strtotime($_POST['appointment_date']));
      $appointment_time = date('H:i:00', strtotime($_POST['appointment_time']));

      $appointmentDateTimeErrors = $this->validateAppointmentDateTime($appointment_date, $appointment_time);

      // Example validation - You should implement your own validation logic
      if (!empty($appointmentDateTimeErrors)) {
        // Display validation errors
        foreach ($appointmentDateTimeErrors as $error) {
          set_flash_message($error, 'error');
        }

        // If validation passes, construct redirect URL
        $appointmentType = isset($_GET['appointmentType']) ? $_GET['appointmentType'] : '';
        $tricycleCin = isset($_GET['tricycleCin']) ? $_GET['tricycleCin'] : '';
        $transferType = isset($_GET['transferType']) ? $_GET['transferType'] : '';

        $redirectURL = "appointment_details";

				if ($appointmentType === "New Franchise") {
					$redirectURL .= "?appointmentType=$appointmentType";
				} else {
					$redirectURL .= "?appointmentType=$appointmentType&tricycleCin=$tricycleCin";
				}

        if (!empty($transferType)) {
          $redirectURL .= "&transferType=$transferType";
        }

        redirect($redirectURL);
      } else {
        // If validation passes, construct redirect URL
        $appointmentType = isset($_GET['appointmentType']) ? $_GET['appointmentType'] : '';
        $appointmentType = strtolower(str_replace(' ', '_', $appointmentType));
        $tricycleCin = isset($_GET['tricycleCin']) ? $_GET['tricycleCin'] : '';
        $transferType = isset($_GET['transferType']) ? $_GET['transferType'] : '';

        $redirectURL = "";

        switch ($appointmentType) {
          case 'transfer_of_ownership':
            if ($transferType == 'Intent of Transfer') {
              $redirectURL .= "intent_of_transfer";
            } elseif ($transferType == 'Transfer of Ownership from Deceased Owner') {
              $redirectURL .= "ownership_transfer_from_deceased_owner";
            } else {
              $redirectURL .= "transfer_of_ownership";
            }
            break;
          default:
            $redirectURL .= $appointmentType;
            break;
        }

        $redirectURL .= "?tricycleCin=$tricycleCin&appointmentDate=$appointment_date&appointmentTime=$appointment_time";

        redirect($redirectURL);
      }
    }

    echo $this->renderView('appointment_details', true, $data);
  }

  private function generateMessage($date, $availableAppointmentsLeft)
  {
    $slotsMessage = $availableAppointmentsLeft > 1 ? "Slots left are <strong>$availableAppointmentsLeft</strong>" : ($availableAppointmentsLeft === 1 ? "Slot left is <strong>1</strong>" : "No slots left");
    return "$date ($slotsMessage)";
  }

  private function validateAppointmentDateTime($appointment_date, $appointment_time)
  {
    $appointmentModel = new Appointment();
    $errors = [];

    // Validate appointment date
    if (empty($appointment_date) || !strtotime($appointment_date)) {
      $errors[] = 'Preferred Date must be a valid date.';
    } elseif (!$appointmentModel->isGovernmentWorkingDay($appointment_date)) {
      $errors[] = 'Appointments can only be scheduled from Monday to Friday.';
    } elseif ($appointmentModel->isPastDate($appointment_date)) {
      $errors[] = 'Appointment date must be in the future.';
    } elseif (!$appointmentModel->hasMinimumLeadTime($appointment_date)) {
      $errors[] = 'Appointments must be scheduled at least one day in advance.';
    } elseif (!$appointmentModel->isWithinMaximumAdvanceBooking($appointment_date)) {
      $errors[] = 'Appointments cannot be scheduled more than 15 weekdays in advance.';
    } elseif ($appointmentModel->hasMaximumDailyAppointments($appointment_date)) {
      $errors[] = 'Maximum appointments reached for this day. Please choose another date.';
    }

    if (empty($appointment_time)) {
      $errors[] = 'Preferred Time is required.';
    } elseif (!$appointmentModel->isWorkingHour($appointment_time)) {
      $errors[] = 'Appointments can only be scheduled during government working hours (8:00 AM to 5:00 PM).';
    }

    if ($appointmentModel->isSlotTaken($appointment_date, $appointment_time)) {
      $errors[] = 'The preferred appointment slot is already taken. Please choose another time.';
    }

    return $errors;
  }
}