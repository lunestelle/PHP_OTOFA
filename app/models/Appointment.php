<?php

class Appointment
{
  use Model;

  protected $table = 'appointments';
  protected $allowedColumns = [
    'appointment_id',
    'name',
    'phone_number',
    'email',
    'appointment_type',
    'appointment_date',
    'appointment_time',
    'status'
  ];
  protected $order_column = 'appointment_id';

  public function validate($data)
  {
    $errors = [];

    $requiredFields = [
      'name' => 'Full Name',
      'appointment_type' => 'Appointment Type',
      'appointment_date' => 'Preferred Date',
      'appointment_time' => 'Preferred Time'
    ];

    foreach ($requiredFields as $field => $fieldName) {
      if (empty($data[$field])) {
        $errors[] = $fieldName . ' is required.';
      }
    }

    if (empty($data['phone_number'])) {
      $errors[] = "Appointment Phone Number is required.";
    } else {
      $phoneNumber = $data['phone_number'];
  
      if (strlen($phoneNumber) !== 10) {
        $errors[] = "Invalid Appointment phone number. Please <br> enter a valid 10-digit number after '+63'.";
      } elseif (!is_numeric(substr($phoneNumber, 3))) {
        $errors[] = "Invalid Appointment phone number. Please <br> enter only numeric digits (0-9) after '+63'.";
      } elseif (strpos($phoneNumber, '+63') === 0) {
        $errors[] = "Invalid Appointment phone number. Please <br> type only the next digit after '+63'.";
      }
    }

    if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'Invalid email format.';
    }

    if (!empty($data['appointment_date']) && !strtotime($data['appointment_date'])) {
      $errors[] = 'Preferred Date must be a valid date.';
    } elseif (!$this->isGovernmentWorkingDay($data['appointment_date'])) {
      $errors[] = 'Appointments can only be scheduled from Monday to Friday.';
    } elseif ($this->isPastDate($data['appointment_date'])) {
      $errors[] = 'Appointment date must be in the future.';
    } elseif (!$this->hasMinimumLeadTime($data['appointment_date'])) {
      $errors[] = 'Appointments must be scheduled at least one day in advance.';
    } elseif (!$this->isWithinMaximumAdvanceBooking($data['appointment_date'])) {
      $errors[] = 'Appointments cannot be scheduled more than 30 days in advance.';
    } elseif ($this->hasMaximumDailyAppointments($data['appointment_date'])) {
      $errors[] = 'Maximum appointments reached for this day. Please choose another date.';
    }

    if (empty($data['appointment_time'])) {
      $errors[] = 'Preferred Time is required.';
    } elseif (!$this->isWorkingHour($data['appointment_time'])) {
      $errors[] = 'Appointments can only be scheduled during government working hours (8:00 AM to 5:00 PM).';
    }

    if ($this->isSlotTaken($data['appointment_date'], $data['appointment_time'])) {
      $errors[] = '<strong>The preferred appointment slot is already taken.</strong> Please choose another available slot or select a different date.';
    }
   
  
    if ($this->hasDuplicatePhoneNumber($data['phone_number'], $data['appointment_date'], $data['appointment_time'])) {
      $errors[] = 'An appointment with this phone number already exists for the same date and time.';
    }

    if ($this->isBlackoutDate($data['appointment_date'])) {
      $errors[] = 'Appointments cannot be scheduled on this date due to a blackout period.';
    }

    return $errors;
  }

  private function isSlotTaken($date, $time)
  {
    $existingAppointment = $this->first(['appointment_date' => $date, 'appointment_time' => $time]);
    return !empty($existingAppointment);
  }

  public function canBeCanceled($appointment_id)
  {
    $appointment = $this->first(['appointment_id' => $appointment_id]);
  
    if (!$appointment) {
      return false; // Appointment not found
    }
  
    if ($appointment->status === 'Cancelled' || $appointment->status === 'Approved') {
      return false; // Already cancelled or approved
    }
  
    $currentTime = strtotime('now');
    $appointmentTime = strtotime($appointment->appointment_date . ' ' . $appointment->appointment_time);
    $timeDifference = $appointmentTime - $currentTime;
    $hoursDifference = $timeDifference / (60 * 60);
  
    if ($hoursDifference <= 24) {
      return false; // Cannot be canceled as per cancellation policy
    }
  
    return true; // Appointment can be canceled
  }
  
  public function cancelAppointment($appointment_id)
  {
    if (!$this->canBeCanceled($appointment_id)) {
      return false; // Appointment cannot be canceled
    }

    $this->update($appointment_id, ['status' => 'Cancelled']);
    return true; // Appointment successfully canceled
  }

  private function isGovernmentWorkingDay($date)
  {
    // Assume government working days are Monday to Friday
    $dayOfWeek = date('N', strtotime($date));
    return ($dayOfWeek >= 1 && $dayOfWeek <= 5);
  }

  private function isWorkingHour($time)
  {
    date_default_timezone_set('Asia/Manila');
    $startTime = strtotime('08:00 AM');
    $endTime = strtotime('05:00 PM');
    $appointmentTime = strtotime($time);

    return ($appointmentTime >= $startTime && $appointmentTime <= $endTime);
  }

  private function isPastDate($date)
  {
    $today = strtotime(date('Y-m-d'));
    $selectedDate = strtotime($date);
    return ($selectedDate < $today);
  }

  private function hasMinimumLeadTime($date)
  {
    // Minimum lead time: 1 day -> checks if the selected date is at least one day ahead of the current date
    $today = strtotime(date('Y-m-d'));
    $selectedDate = strtotime($date);
    $oneDayAhead = strtotime('+1 day', $today);
    return ($selectedDate >= $oneDayAhead);
  }

  private function isWithinMaximumAdvanceBooking($date)
  {
    // Maximum advance booking: 15 days
    $today = strtotime(date('Y-m-d'));
    $selectedDate = strtotime($date);
    $fifteenDaysAhead = strtotime('+15 days', $today);
    return ($selectedDate <= $fifteenDaysAhead);
  }

  private function hasMaximumDailyAppointments($date)
  {
    // Assuming the appointments are in 1-hour intervals
    $totalSlots = 12; // Total available slots in a day
    $appointments = $this->where(['appointment_date' => $date]);

    // Check if $appointments is a valid result set (array or object)
    if (is_array($appointments) || is_object($appointments)) {
      $numAppointments = 0;
      foreach ($appointments as $appointment) {
        if ($appointment->appointment_date === $date) {
          $numAppointments++;
        }
      }

      return ($numAppointments >= $totalSlots);
    } else {
      return false;
    }
  }

  private function hasDuplicatePhoneNumber($phone_number, $date, $time)
  {
    $existingAppointment = $this->first(['phone_number' => $phone_number, 'appointment_date' => $date, 'appointment_time' => $time]);
    return !empty($existingAppointment);
  }

  private function isBlackoutDate($date)
  {
    // Check if the date is in the array of blackout dates (e.g., holidays, maintenance days)
    $blackoutDates = ['2023-12-25', '2023-12-31'];
    return in_array($date, $blackoutDates);
  }
}