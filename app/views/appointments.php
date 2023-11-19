<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content overflow-scroll">
  <div class="row">
    <div class="col-12 title-head text-uppercase">
      <h6>Appointments</h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <?php if ($userRole === 'admin'): ?>  
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
                      <span class="badge status-badge text-uppercase p-2"><?php echo $appointment['status']; ?></span>
                    </td>
                    <td>
                      <a href="<?php echo 'view_appointment?appointment_id=' . $appointment['appointment_id']; ?>" class="view_data px-1 me-1" style="color: #26CC00;" title="View Appointment Details"><i class="fa-solid fa-file-lines fa-lg"></i></a>
                      <a href="#" class="cancel_data px-1 me-1" style="color: #ff6c36;" title="Cancel Appointment" data-bs-toggle="modal" data-bs-target="#cancelModal" onclick="updateModalContent('<?php echo $appointment['name']; ?>', '<?php echo $appointment['appointment_date']; ?>', '<?php echo $appointment['appointment_time']; ?>')">
                      <i class="fa-solid fa-times fa-lg"></i></a>
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
                    <p class="fs-4 text-center mt-2">Cancel Appointment</p>
                  </div>
                                
                  <div class="modal-body mx-2">
                    <p>Are you sure you want to cancel the appointment for <span id="appointmentName"></span> on <span id="appointmentDate"></span> at <span id="appointmentTime"></span>?</p>
                  </div>
                  <div class="modal-footer border-0">
                    <form action="<?php echo 'cancel_appointment?appointment_id=' . $appointment['appointment_id'] ?>" method="post" id="cancelForm">
                      <input type="submit" class="btn sidebar-btnContent" value="Yes, Cancel Appointment">
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
    var cancelForm = document.getElementById('cancelForm');

    appointmentName.textContent = name;
    appointmentDate.textContent = date;
    appointmentTime.textContent = time;

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