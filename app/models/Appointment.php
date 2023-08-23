<?php

class Appointment
{
  use Model;

  protected $table = 'appointments';
  protected $allowedColumns = [
    'appointment_id',
    'name',
    'phone_number',
    'appointment_type',
    'appointment_date',
    'appointment_time',
    'status'
  ];
  protected $order_column = 'appointment_id';

  public function validate($data)
  {
    $errors = [];

    if (empty($data['name'])) {
      $errors[] = 'Name is required.';
    }

    if (empty($data['phone_number'])) {
      $errors[] = 'Phone Number is required.';
    } elseif (!preg_match('/^[0-9]{10}$/', $data['phone_number'])) {
      $errors[] = 'Phone Number must be a valid 10-digit number after "+63".';
    }

    if (empty($data['appointment_type'])) {
      $errors[] = 'Appointment Type is required.';
    }

    if (empty($data['appointment_date'])) {
      $errors[] = 'Preferred Date is required.';
    } elseif (!strtotime($data['appointment_date'])) {
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
      $alternativeDates = $this->getAlternativeDates($data['appointment_date']);
      if (!empty($alternativeDates)) {
        $alternativeDatesFormatted = array_map(function ($date) {
          return date('F j, Y', strtotime($date));
        }, $alternativeDates);
    
        $alternativeDatesMessage = "Alternative available dates: <br>-" . implode("<br>- ", $alternativeDatesFormatted);
        $errors[] = 'Maximum appointments reached for this day. Please <br> choose an alternative date. ' . $alternativeDatesMessage;
      } else {
        $errors[] = 'Maximum appointments reached for this day. <br> Please choose an alternative date.';
      }
    }

    if (empty($data['appointment_time'])) {
      $errors[] = 'Preferred Time is required.';
    } elseif (!$this->isWorkingHour($data['appointment_time'])) {
      $errors[] = 'Appointments can only be scheduled during government working hours (8:00 AM to 5:00 PM).';
    }

    // Check for overbooking
    if ($this->isSlotTaken($data['appointment_date'], $data['appointment_time'])) {
      $alternativeSlots = $this->getAlternativeSlots($data['appointment_date'], $data['appointment_time']);

      if (!empty($alternativeSlots)) {
        $formattedSlots = array_map(function ($time) {
          return date('h:i A', strtotime($time));
        }, $alternativeSlots);

        $alternativeSlotsMessage = "Alternative available slots: <br>-" . implode("<br>- ", $formattedSlots);
        $errors[] = 'The preferred appointment slot is already taken. Please choose an alternative slot.' . $alternativeSlotsMessage;
      } else {
        $errors[] = 'Maximum appointments reached for this day. <br> Please choose an alternative date.';
      }
    }

    // Check for unique phone number
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

  private function getAlternativeSlots($date, $time)
  {
    // Assuming the appointments are in 1-hour intervals
    $availableSlots = [];
    $totalSlots = 12; // Total available slots in a day

    for ($i = 1; $i <= $totalSlots; $i++) {
      $nextSlot = date('H:i', strtotime("+$i hour", strtotime("$date $time")));
      if (!$this->isSlotTaken($date, $nextSlot)) {
        $availableSlots[] = $nextSlot;
      }
    }

    return $availableSlots;
  }

  public function canBeCanceled($appointment_id)
  {
    $appointment = $this->where(['appointment_id' => $appointment_id]);

    if (!$appointment) {
      return false;
    }

    if ($appointment['status'] === 'Cancelled') {
      return false; // Already cancelled
    }

    // Implement your cancelation policy here
    // For example, allow cancelation up to 24 hours before the appointment
    $currentTime = strtotime('now');
    $appointmentTime = strtotime($appointment['appointment_date'] . ' ' . $appointment['appointment_time']);
    $timeDifference = $appointmentTime - $currentTime;
    $hoursDifference = $timeDifference / (60 * 60);

    if ($hoursDifference <= 24) {
      return false; // Cannot be canceled as per cancelation policy
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
    // Assume government working hours are from 8:00 AM to 5:00 PM
    date_default_timezone_set('Asia/Manila');
    $startTime = strtotime('08:00');
    $endTime = strtotime('17:00');
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
    // Minimum lead time: 1 day
    $today = strtotime(date('Y-m-d'));
    $selectedDate = strtotime($date);
    $oneDayAhead = strtotime('+1 day', $today);
    return ($selectedDate >= $oneDayAhead);
  }

  private function isWithinMaximumAdvanceBooking($date)
  {
    // Maximum advance booking: 30 days
    $today = strtotime(date('Y-m-d'));
    $selectedDate = strtotime($date);
    $thirtyDaysAhead = strtotime('+30 days', $today);
    return ($selectedDate <= $thirtyDaysAhead);
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
      // Handle the case when $appointments is not a valid result set
      // For example, you could log an error or return false if there was a problem with the query
      return false;
    }
  }

  private function getAlternativeDates($date)
  {
    // Get alternative dates within the maximum advance booking limit
    $today = strtotime(date('Y-m-d'));
    $selectedDate = strtotime($date);
    $thirtyDaysAhead = strtotime('+30 days', $today);

    $availableDates = [];
    $currentDate = $selectedDate;
    while ($currentDate <= $thirtyDaysAhead) {
      $formattedDate = date('Y-m-d', $currentDate);
      if ($this->isGovernmentWorkingDay($formattedDate) && !$this->hasMaximumDailyAppointments($formattedDate)) {
        $availableDates[] = $formattedDate;
      }
      $currentDate = strtotime('+1 day', $currentDate);
    }

    return $availableDates;
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