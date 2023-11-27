<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">View Appointment</h6>
    </div>
    <div class="col-lg-12 mx-auto">
      <div class="row">
        <div class="col-12 pt-2">
          <div class="container pt-4">
            <div id="newAppointmentForm">
              <form class="default-form" method="POST" action="">
                <div class="content-container">
                  <div class="bckgrnd pt-2">
                    <h6 class="pl-2 text-uppercase text-center text-dark fs-6">Appointment Details</h6>
                  </div>
                  <div class="container">
                    <div class="d-flex justify-content-center">
                      <div class="row px-3">
                        <div class="col-md-6">
                          <div class="row mt-3">
                            <p> <span class="fw-bolder mr-5">Name:</span> 
                            <p><span class="fw-bolder mr-5">Phone Number:</span> 
                            <p><span class="fw-bolder mr-5">Appointment Type:</span> 
                            <p><span class="fw-bolder mr-5">Date:</span> 
                            <p><span class="fw-bolder mr-5">Time:</span> 
                            <hr>
                          </div>
                        </div>
                        <!-- Second Column -->
                        <div class="col-md-6 mt-3">
                          <?php echo strtoupper($appointment->name); ?></p>
                          <?php echo strtoupper($appointment->phone_number); ?></p>
                          <?php echo strtoupper($appointment->appointment_type); ?></p>
                          <?php echo strtoupper($appointment->appointment_date); ?></p>
                          <?php echo strtoupper($appointment_time); ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="container">
                    <div class="d-flex justify-content-center">
                      <div class="row px-3">
                        <div class="col-md-6">
                          <div class="row mt-3">
                            <?php
                            if (!empty($tricycleApplication)) {
                              echo '<p class="d-flex align-items-center"><span class="fw-bolder mr-2">Name of Operator:</span>' . $tricycleApplication->operator_name . '</p>';
                              echo '<p class="d-flex align-items-center"><span class="fw-bolder mr-2">Address:</span>' . $tricycleApplication->address . '</p>';
                              echo '<p class="d-flex align-items-center"><span class="fw-bolder mr-2">MTOP Number:</span>' . $tricycleApplication->operator_name  . '</p>';
                              echo '<p class="d-flex align-items-center"><span class="fw-bolder mr-2">Color Code:</span>' . $tricycleApplication->color_code . '</p>';
                              echo '<p class="d-flex align-items-center"><span class="fw-bolder mr-2">Route Area:</span>' . $tricycleApplication->route_area . '</p>';
                              echo '<p class="d-flex align-items-center"><span class="fw-bolder mr-2">Make Model:</span>' . $tricycleApplication->operator_name  . '</p>';
                              echo '<p class="d-flex align-items-center"><span class="fw-bolder mr-2">Model Expiry Date:</span>' . $tricycleApplication->operator_name  . '</p>';
                            } else {
                              echo '<p class="d-flex align-items-center">Tricycle application not available</p>';
                            }
                            ?>
                          </div>
                        </div>
                        <!-- Second Column -->
                        <div class="col-md-6 mt-3">
                          <?php
                              if (!empty($tricycleApplication)) {
                                echo '<p><span class="fw-bolder mr-5">Motor Number:</span> ' . $tricycleApplication->motor_number . '</p>';
                                echo '<p><span class="fw-bolder mr-5">Insurer:</span> ' . $tricycleApplication->insurer . '</p>';
                                echo '<p><span class="fw-bolder mr-5">Chasis Number:</span> ' . $tricycleApplication->chasis_number . '</p>';
                                echo '<p><span class="fw-bolder mr-5">COC Number:</span> ' . $tricycleApplication->operator_name . '</p>';
                                echo '<p><span class="fw-bolder mr-5">COC Expiry Date:</span> ' . $tricycleApplication->operator_name . '</p>';
                              } else {
                                echo "Tricycle application not available"; // or some other default message
                              }
                            ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="container">
                    <div class="d-flex justify-content-center">
                      <div class="row px-3">
                        <div class="col-md-12">
                          <div class="row mt-3">
                            <?php
                              if (!empty($tricycleApplication)) {
                                echo '<p><span class="fw-bolder mr-5">Plate Number:</span> ' . $tricycleApplication->plate_number . '</p>';
                                echo '<p><span class="fw-bolder mr-5">LTO CR Number:</span> ' . $tricycleApplication->operator_name . '</p>';
                                echo '<p><span class="fw-bolder mr-5">LTO OR Number:</span> ' . $tricycleApplication->operator_name . '</p>';
                                echo '<p><span class="fw-bolder mr-5">Name of Driver:</span> ' . $tricycleApplication->operator_name . '</p>';
                                echo '<p><span class="fw-bolder mr-5">Driver License Number:</span> ' . $tricycleApplication->operator_name . '</p>';
                                echo '<p><span class="fw-bolder mr-5">License Expiry Date:</span> ' . $tricycleApplication->operator_name . '</p>';
                              } else {
                                echo "Tricycle application not available"; // or some other default message
                              }
                            ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div>
                  <a href="./appointments" class="sidebar-btnContent text-white px-3 mt-4">Back</a>
                </div>
              </form>

              <!-- Cancel Modal
              <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="cancelModalLabel">Cancel Appointment</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?php
                        $appointmentDate = date('l, F j, Y', strtotime($appointment->appointment_date));
                        $appointmentTime = date('h:i A', strtotime($appointment->appointment_time));
                      ?>
                      <p>Are you sure you want to cancel the appointment for <?php echo $appointment->name; ?> on <?php echo $appointmentDate; ?> at <?php echo $appointmentTime; ?>?</p>
                    </div>
                    <div class="modal-footer">
                      <form action="<?php echo 'cancel_appointment?appointment_id=' .$appointment->appointment_id; ?>" method="post">
                        <input type="submit" class="btn btn-danger" value="Yes, Cancel Appointment">
                      </form>
                    </div>
                  </div>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>