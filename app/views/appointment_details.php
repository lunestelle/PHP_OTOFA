<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top" id="mainAppointmentForm">
      <h6 class="title-head">Schedule New Appointment</h6>
    </div>
    <div class="col-lg-12 mt-2">
      <div class="row">
        <div class="col-12 pt-2">
          <div class="container pt-3">
            <div id="newAppointmentForm">
              <div class="alert alert-info" role="alert">
                <strong>Note:</strong> You cannot schedule an appointment more than 15 days ahead from the current date (<?php echo date('F j, Y'); ?>).
              </div>
              <div class="content-container mt-2 mb-3" id="appointmentDate&TimeContainer">
                <div class="bckgrnd pt-2">
                  <h6 class="text-uppercase text-center text-light fs-6">Select Appointment Date & Time</h6>
                </div>
                <div class="row px-3 p-4">
                  <div class="col-12 d-flex flex-wrap py-3 px-5">
                    <?php $count = 0; ?>
                    <?php foreach ($details as $detail): ?>
                      <div class="col-4 mb-3 p-2">
                        <div class="text-center new-appointment-selection rounded-3">
                          <input type="radio" id="newFranchise<?php echo $count; ?>" name="appointmentType" value="<?php echo $detail['appointment_date']; ?>" data-bs-toggle="modal" data-bs-target="#appointmentModal" onclick="setAppointmentDate('<?php echo $detail['appointment_date']; ?>')">
                          <label for="newFranchise<?php echo $count; ?>">
                            <?php echo $detail['slots_message']; ?>
                          </label>
                        </div>
                      </div>
                      <?php $count++; ?>
                    <?php endforeach; ?>
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

<!-- Modal -->
<div class="modal fade" id="appointmentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered mx-auto" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Set Appointment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="default-form" method="POST" action="" id="appointmentDateFormModal">
        <div class="img-container">
          <div class="row p-2">
            <div class="col-6">  
              <div class="form-group">
                <label for="appointment_date">Preferred Date</label>
                <input type="text" name="appointment_date" id="appointment_date" class="form-control onlydatepicker" placeholder="Appointment Date" required readonly>
              </div>
            </div>
            <div class="col-6">  
              <div class="form-group">
                <label for="appointment_time">Preferred Time</label>
                <input type="time" name="appointment_time" id="appointment_time" class="form-control" placeholder="Appointment Time" required>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" name="appointmentDateModalBtn">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>

<script>
  function setAppointmentDate(date) {
    document.getElementById('appointment_date').value = date;
  }
</script>
