<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 title-head text-uppercase">
      <h6>Schedule New Appointment</h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <div class="col-12 pt-2">
          <div class="container pt-4">
            <div id="newAppointmentForm">
              <form class="default-form" method="POST" action="">
                <div class="content-container mt-2 p-3">
                  <h6 class="pl-2 text-uppercase">Appointment Information</h6>
                  <div class="container">
                    <div class="d-flex justify-content-center">
                      <div class="row px-3">
                        <div class="col-12">
                          <div class="row mt-3">
                            <div class="col-4">
                              <label for="name" class="form-label">Full Name</label>
                              <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" required>
                            </div>

                            <div class="col-4">
                              <label for="phone_number" class="form-label">Phone Number</label>
                              <div class="input-group">
                                <span class="input-group-text">+63</span>
                                <input type="text" class="form-control phone-no" id="phone_number" name="phone_number" placeholder="e.g., 9123456789" value="<?php echo isset($_POST['phone_number']) ? $_POST['phone_number'] : ''; ?>" required>
                              </div>
                            </div>

                            <div class="col-4">
                              <label for="appointment_type" class="form-label">Appointment Type</label>
                              <select class="form-select" id="appointment_type" name="appointment_type" required>
                                <option value="" selected disabled>Select Appointment Type</option>
                                <option value="Inspection" <?php echo (isset($_POST['appointment_type']) && $_POST['appointment_type'] === 'Inspection') ? 'selected' : ''; ?>>Inspection</option>
                                <option value="Permit Renewal" <?php echo (isset($_POST['appointment_type']) && $_POST['appointment_type'] === 'Permit Renewal') ? 'selected' : ''; ?>>Permit Renewal</option>
                                <option value="Other" <?php echo (isset($_POST['appointment_type']) && $_POST['appointment_type'] === 'Other') ? 'selected' : ''; ?>>Other</option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="row mt-3">
                            <div class="col-4">
                              <label for="appointment_date" class="form-label">Preferred Date</label>
                              <input type="date" class="form-control" id="appointment_date" name="appointment_date" value="<?php echo isset($_POST['appointment_date']) ? $_POST['appointment_date'] : ''; ?>" required>
                            </div>

                            <div class="col-4">
                              <label for="appointment_time" class="form-label">Preferred Time</label>
                              <input type="time" class="form-control" id="appointment_time" name="appointment_time" value="<?php echo isset($_POST['appointment_time']) ? $_POST['appointment_time'] : ''; ?>" required>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="text-end my-3">
                  <button type="submit" class="sidebar-btnContent">Schedule Appointment</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>