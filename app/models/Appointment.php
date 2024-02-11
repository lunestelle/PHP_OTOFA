<?php

class Appointment
{
  use Model;

  protected $table = 'appointments';
  protected $allowedColumns = [
    'appointment_id',
    'user_id',
    'name',
    'phone_number',
    'email',
    'appointment_type',
    'transfer_type',
    'appointment_date',
    'appointment_time',
    'status',
    'comments',
    'date_created',
  ];
  protected $order_column = 'date_created';

  public function validate($data)
  {
    $errors = [];

    $requiredFields = [
      'name' => 'Full Name',
      'email' => 'Email',
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
      $errors[] = 'Appointments must be scheduled at <br> least one day in advance.';
    } elseif (!$this->isWithinMaximumAdvanceBooking($data['appointment_date'])) {
      $errors[] = 'Appointments cannot be scheduled more than <br> 30 days in advance.';
    } elseif ($this->hasMaximumDailyAppointments($data['appointment_date'])) {
      $errors[] = 'Maximum appointments reached for this day. Please choose another date.';
    }

    if (empty($data['appointment_time'])) {
      $errors[] = 'Preferred Time is required.';
    } elseif (!$this->isWorkingHour($data['appointment_time'])) {
      $errors[] = 'Appointments can only be scheduled <br> during government working hours (8:00 AM to 5:00 PM).';
    }

    if ($this->isSlotTaken($data['appointment_date'], $data['appointment_time'])) {
      $errors[] = '<strong>The preferred appointment slot is already taken.</strong> Please choose <br> another available slot or select a different date.';
    }
   
  
    if ($this->hasDuplicatePhoneNumber($data['phone_number'], $data['appointment_date'], $data['appointment_time'])) {
      $errors[] = 'An appointment with this phone number already exists for the same date and time.';
    }

    if ($this->isBlackoutDate($data['appointment_date'])) {
      $errors[] = 'Appointments cannot be scheduled on this date due to a blackout period.';
    }

    return $errors;
  }

  public function updateValidation($data)
  {
    $errors = [];

    $requiredFields = [
      'name' => 'Full Name',
      'email' => 'Email',
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
      $errors[] = 'Appointments must be scheduled at <br> least one day in advance.';
    } elseif (!$this->isWithinMaximumAdvanceBooking($data['appointment_date'])) {
      $errors[] = 'Appointments cannot be scheduled more than <br> 15 days in advance.';
    } elseif ($this->hasMaximumDailyAppointments($data['appointment_date'])) {
      $errors[] = 'Maximum appointments reached for this day. Please choose another date.';
    }

    if (empty($data['appointment_time'])) {
      $errors[] = 'Preferred Time is required.';
    } elseif (!$this->isWorkingHour($data['appointment_time'])) {
      $errors[] = 'Appointments can only be scheduled <br> during government working hours (8:00 AM to 5:00 PM).';
    }

    if ($this->isBlackoutDate($data['appointment_date'])) {
      $errors[] = 'Appointments cannot be scheduled on this date due to a blackout period.';
    }

    return $errors;
  }

  private function isSlotTaken($date, $time)
  {
    $existingAppointment = $this->first([
      'appointment_date' => $date,
      'appointment_time' => $time,
      'status' => 'Pending',
    ]);

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
    $endTime = strtotime('04:30 PM');
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
    $totalSlots = 100; // Total available slots in a day
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
    $blackoutDates = [
      '01-01', // New Year’s Day
      '01-02', // New Year’s Day
      '03-28', // Maundy Thursday
      '03-29', // Good Friday
      '04-09', // Araw ng Kagitingan
      '05-01', // Labor Day
      '06-12', // Independence Day
      '08-26', // National Heroes Day
      '11-30', // Bonifacio Day
      '12-25', // Christmas Day
      '12-26', // Christmas Day
      '12-30'  // Rizal Day
    ];

    $currentYear = date('Y');

    // Append the current year to blackout dates for comparison
    $blackoutDatesWithYear = array_map(function ($day) use ($currentYear) {
      return $currentYear . '-' . $day;
    }, $blackoutDates);

    return in_array($date, $blackoutDatesWithYear);
  }
  
  public function getUniqueYears()
  {
    $query = "SELECT DISTINCT YEAR(appointment_date) AS year FROM {$this->table} ORDER BY year DESC";
    $result = $this->query($query);

    if (!is_array($result)) {
      return [];
    }

    $years = [];
    foreach ($result as $row) {
      $years[] = $row->year;
    }

    return $years;
  }

  public function getAppointmentsReports($selectedYear)
  {
    $whereClause = ($selectedYear != 'all') ? "WHERE YEAR(a.appointment_date) = '$selectedYear'" : "";
    $query = "
      SELECT
        a.user_id,
        o.first_name,
        o.last_name,
        a.phone_number,
        COUNT(*) AS total_appointments,
        SUM(CASE WHEN a.status = 'Pending' THEN 1 ELSE 0 END) AS pending_appointments,
        SUM(CASE WHEN a.status = 'Completed' THEN 1 ELSE 0 END) AS completed_appointments,
        SUM(CASE WHEN a.status = 'Approved' THEN 1 ELSE 0 END) AS approved_appointments,
        SUM(CASE WHEN a.status = 'Rejected' THEN 1 ELSE 0 END) AS rejected_appointments,
        SUM(CASE WHEN a.status = 'On Process' THEN 1 ELSE 0 END) AS on_process_appointments,
        YEAR(a.appointment_date) AS year
      FROM {$this->table} a
      JOIN users o ON a.user_id = o.user_id
      $whereClause
      GROUP BY a.user_id
      ORDER BY a.user_id";

    $result = $this->query($query);

    if (!empty($result) && (is_array($result) || is_object($result))) {
      return $result;
    } else {
      return [];
    }
  }

  public function getAppointmentsByDateRangeAndStatus($startDate, $endDate, $statusFilter, $whereConditions = [])
  {
    $whereClause = '';

    if (!empty($whereConditions)) {
      foreach ($whereConditions as $column => $value) {
        $whereClause .= "AND $column = '$value'";
      }
    }

    if ($statusFilter !== 'all') {
      $whereClause .= "AND status = '$statusFilter'";
    }

    if (!empty($startDate) && !empty($endDate)) {
      $whereClause .= "AND appointment_date BETWEEN '$startDate' AND '$endDate'";
    }

    $query = "SELECT * FROM {$this->table} WHERE 1 $whereClause ORDER BY appointment_date DESC";
    return $this->query($query);
  }
  
  public function getAppointmentsForAdminWithSpecificUser($userId, $statusFilter, $startDate, $endDate)
  {
    $params = [':userId' => $userId];
    $query = "SELECT * FROM {$this->table} WHERE user_id = :userId";

    $whereClause = '';

    if ($statusFilter !== 'all') {
      $whereClause .= " AND status = :statusFilter";
      $params[':statusFilter'] = $statusFilter;
    }

    if (!empty($startDate) && !empty($endDate)) {
      $whereClause .= " AND appointment_date BETWEEN :startDate AND :endDate";
      $params[':startDate'] = $startDate;
      $params[':endDate'] = $endDate;
    }

    if (!empty($whereClause)) {
      $query .= $whereClause;
    }

    return $this->query($query, $params);
  }

  public function getAvailableSlotsByDate($date) {

    $query = "SELECT COUNT(*) AS numAppointments
              FROM {$this->table}
              WHERE appointment_date = '{$date}' AND status IN ('Approved', 'Pending');";

    $result = $this->query($query);

    if (!empty($result) && (is_array($result) || is_object($result))) {
        return $result[0]->numAppointments;
    } else {
        return 0;
    }
}



}