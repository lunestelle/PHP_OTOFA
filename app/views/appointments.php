<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">Appointments</h6>
    </div>
    <div class="col-lg-12 mt-4">
      <div class="row">
        <?php if ($userRole === 'operator'): ?>  
          <div class="col-12">
            <div class="mt-3">
              <a href="new_appointment" class="text-uppercase sidebar-btnContent new-button">New</a>
            </div>
          </div>
        <?php endif; ?>  
        <div class="col-12">
          <div class="table-responsive pt-4">
            <table class="table table-hover" id="systemTable">
              <thead class="thead-custom">
                <tr class="text-uppercase">
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center">Name</th>
                  <th scope="col" class="text-center">Phone Number</th>
                  <th scope="col" class="text-center">Email</th>
                  <th scope="col" class="text-center">Appointment Type</th>
                  <th scope="col" class="text-center">Date</th>
                  <th scope="col" class="text-center">Time</th>
                  <th scope="col" class="text-center">Status</th>
                  <th scope="col" class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <?php foreach ($appointments as $appointment): ?>
                  <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $appointment['name']; ?></td>
                    <td><?php echo $appointment['phone_number']; ?></td>
                    <td><?php echo empty($appointment['email']) ? '----------------' : $appointment['email']; ?></td>
                    <td><?php echo $appointment['appointment_type']; ?></td>
                    <td><?php echo $appointment['appointment_date']; ?></td>
                    <td><?php echo $appointment['appointment_time']; ?></td>
                    <td>
                      <?php
                        $status = $appointment['status'];
                        $badgeColor = '';

                        switch ($status) {
                          case 'Pending':
                            $badgeColor = 'bg-info'; // Green color for pending
                            break;
                          case 'Rejected':
                            $badgeColor = 'bg-danger'; // Red color for rejected
                            break;
                          case 'Completed':
                            $badgeColor = 'bg-primary'; // Blue color for completed
                            break;
                          case 'Approved':
                            $badgeColor = 'bg-success'; // Light blue color for approved
                            break;
                          case 'Cancelled':
                            $badgeColor = 'bg-danger'; // Red color for cancelled
                            break;
                          // Add cases for other statuses as needed
                          default:
                            $badgeColor = 'bg-secondary'; // Default color
                            break;
                        }
                      ?>
                      <span class="badge status-badge text-uppercase p-2 <?php echo $badgeColor; ?>"><?php echo $status; ?></span>
                    </td>
                    <td>
                      <a href="<?php echo 'view_appointment?appointment_id=' . $appointment['appointment_id']; ?>" class="view_data px-1 me-1" style="color: #26CC00;" title="View Appointment Details"><i class="fa-solid fa-file-lines fa-lg"></i></a>
                      <?php
                        if ($userRole === 'operator' && $appointment['status'] === "Pending") {
                          // Operator can edit only if the status is pending
                          echo '<a href="' . (($appointment['appointment_type'] === 'New Franchise') ? 'edit_new_franchise?appointment_id=' : 'edit_renewal_franchise?appointment_id=') . $appointment['appointment_id'] . '" class="edit_data px-1 me-1" style="color: #ff6c36;" title="Edit Appointment"><i class="fa-solid fa-pencil fa-lg"></i></a>';
                        } elseif ($userRole === 'admin' && $appointment['status'] !== "Cancelled") {
                          // Admin can edit any status except cancelled
                          echo '<a href="' . (($appointment['appointment_type'] === 'New Franchise') ? 'edit_new_franchise?appointment_id=' : 'edit_renewal_franchise?appointment_id=') . $appointment['appointment_id'] . '" class="edit_data px-1 me-1" style="color: #ff6c36;" title="Edit Appointment"><i class="fa-solid fa-pencil fa-lg"></i></a>';

                        }
                      ?>
                      <?php if ($userRole === 'operator' && $appointment['status'] === "Pending"): ?>
                        <a href="#" class="cancel_data px-1 me-1" style="color: red;" title="Cancel Appointment" data-bs-toggle="modal" data-bs-target="#cancelModal" onclick="updateModalContent('<?php echo $appointment['name']; ?>', '<?php echo $appointment['appointment_date']; ?>', '<?php echo $appointment['appointment_time']; ?>')">
                          <i class="fa-solid fa-times fa-lg"></i>
                        </a>
                      <?php endif; ?>  
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

            <!-- Cancel Modal -->
            <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-title" id="cancelModalLabel">
                    <h5 class="modal-title text-center mt-2">Cancel Appointment</h5>
                  </div>
                  <div class="modal-body mx-2 text-center">
                    <p>Are you sure you want to cancel the appointment for <span id="appointmentName"></span> on <span id="appointmentDate"></span> at <span id="appointmentTime"></span>?</p>
                  </div>
                  <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Keep Appointment</button>
                    <form action="<?php echo 'cancel_appointment?appointment_id=' . $appointment['appointment_id'] ?>" method="post" id="cancelForm">
                      <input type="submit" class="btn btn-danger" value="Yes, Cancel Appointment">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
  function updateModalContent(name, date, time) {
    var appointmentName = document.getElementById('appointmentName');
    var appointmentDate = document.getElementById('appointmentDate');
    var appointmentTime = document.getElementById('appointmentTime');
    var appointmentIdInput = document.getElementById('appointmentIdInput');
    var cancelForm = document.getElementById('cancelForm');

    appointmentName.textContent = name;
    appointmentDate.textContent = date;
    appointmentTime.textContent = time;
    appointmentIdInput.value = appointmentId;

    // Update the form action URL to include the appointment_id
    cancelForm.action = 'cancel_appointment?appointment_id=' + <?php echo $appointment['appointment_id']; ?>;
  }

  function formatDate(date) {
    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString(undefined, options);
  }

  function formatTime(time) {
    return new Date('1970-01-01T' + time + 'Z').toLocaleTimeString([], { hour: 'numeric', minute: '2-digit', hour12: true });
  }
</script>