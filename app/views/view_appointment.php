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
                  <div class="container mt-3">
                    <div class="d-flex justify-content-center">
                      <div class="row px-3">
                        <div class="col-md-3">
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
                        <div class="col-md-3 mt-3">
                          <?php echo strtoupper($appointment->name); ?></p>
                          <?php echo strtoupper($appointment->phone_number); ?></p>
                          <?php echo strtoupper($appointment->appointment_type); ?></p>
                          <?php echo strtoupper($appointment->appointment_date); ?></p>
                          <?php echo strtoupper($appointment_time); ?></p>
                        </div>
                        <div class="col-md-6">
                          <div class="row mt-3">
                            <?php
                              if (!empty($tricycleApplication)) {
                                echo '<div class="col-md-6">';
                                echo '<p><span class="fw-bolder mr-5">Name of Operator:</span></p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p>' . $tricycleApplication->operator_name . '</p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p><span class="fw-bolder mr-5">Address:</span></p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p>' . $tricycleApplication->address  . '</p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p><span class="fw-bolder mr-5">Color Code:</span></p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p>' . $tricycleApplication->color_code  . '</p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p><span class="fw-bolder mr-5">Route Area:</span></p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p>' . $tricycleApplication->route_area . '</p>';
                                echo '</div>';
                            } else {
                                echo '<p class="d-flex align-items-center">Tricycle application not available</p>';
                            }
                            ?>
                          </div>
                        </div>                        
                      </div>
                    </div>
                  </div>
                  <hr class="my-2" style="border-width: 1px; color: #000; background-color: #000;">
                  <div class="container">
                    <div class="d-flex justify-content-center">
                      <div class="row px-3">
                        <div class="col-md-6">
                          <div class="row mt-3">
                            <?php
                              if (!empty($tricycleApplication)) {
                                echo '<div class="col-md-6">';
                                echo '<p><span class="fw-bolder mr-5">Motor Number:</span></p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p>' . $tricycleApplication->motor_number . '</p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p><span class="fw-bolder mr-5">Insurer:</span></p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p>' . $tricycleApplication->insurer  . '</p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p><span class="fw-bolder mr-5">Chasis Number:</span></p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p>' . $tricycleApplication->chasis_number  . '</p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p><span class="fw-bolder mr-5">COC Number:</span></p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p>' . $tricycleApplication->coc_no . '</p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p><span class="fw-bolder mr-5">COC Expiry Date:</span></p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p>' . $tricycleApplication->coc_no_expiry_date . '</p>';
                                echo '</div>';
                            } else {
                                echo '<p class="d-flex align-items-center">Tricycle application not available</p>';
                            }
                            ?>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="row mt-3">
                            <?php
                              if (!empty($tricycleApplication)) {
                                echo '<div class="col-md-6">';
                                echo '<p><span class="fw-bolder mr-5">Tricycle CIN:</span></p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p>' . $tricycle_plate_number . '</p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p><span class="fw-bolder mr-5">LTO CR Number:</span></p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p>' . $tricycleApplication->lto_or_no . '</p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p><span class="fw-bolder mr-5">LTO OR Number:</span></p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p>' . $tricycleApplication->lto_or_no  . '</p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p><span class="fw-bolder mr-5">Name of Driver:</span></p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p>' . $tricycleApplication->operator_name. '</p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p><span class="fw-bolder mr-5">Driver License Number:</span></p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p>' . $tricycleApplication->driver_license_no . '</p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p><span class="fw-bolder mr-5">License Expiry Date:</span></p>';
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                echo '<p>' . $tricycleApplication->driver_license_expiry_date . '</p>';
                                echo '</div>';
                            } else {
                                echo '<p class="d-flex align-items-center">Tricycle application not available</p>';
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>